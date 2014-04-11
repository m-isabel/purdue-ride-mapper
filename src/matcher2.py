import datetime
import json
import math
import operator
import re
import sys
import MySQLdb as mysql
import urllib2

# Circle class to represent a geometric Circle object
class Circle:
	def __init__(self, lat, lon, rad):
		if lat is not None:
			self.lat = lat
		else:
			self.lat = 0

		if lon is not None:
			self.lon = lon
		else:
			self.lon = 0
		
		# Default search radius is 10 miles
		# We multiply by 4 since we only do the crude straight line matching
		if rad is not None and rad != 0:
			self.rad = rad * 4
		else:
			self.rad = 10 * 4

class Line:
	def __init__(self, start_lat, start_lon, end_lat, end_lon):
		if start_lat is not None:
			self.start_lat = start_lat
		else:
			self.start_lat = 0

		if start_lon is not None:
			self.start_lon = start_lon
		else:
			self.start_lon = 0

		if end_lat is not None:
			self.end_lat = end_lat
		else:
			self.end_lat = 0

		if end_lon is not None:
			self.end_lon = end_lon
		else:
			self.end_lon = 0

		if self.start_lat == self.end_lat:
			self.end_lat += 1
		
		if self.start_lon == self.end_lon:
			self.end_lon += 1

class User:
	def __init__(self, start_lat, start_lon, end_lat, end_lon):
		if start_lat is not None:
			self.start_lat = start_lat
		else:
			self.start_lat = 0

		if start_lon is not None:
			self.start_lon = start_lon
		else:
			self.start_lon = 0

		if end_lat is not None:
			self.end_lat = end_lat
		else:
			self.end_lat = 0

		if end_lon is not None:
			self.end_lon = end_lon
		else:
			self.end_lon = 0


class Matcher:
	def __init__(self):
		#self.db = mysql.connect('localhost', 'collegecarpool', 'collegecarpool', 'purdue_test')
		self.db = mysql.connect('collegecarpool.us', 'root', 'collegecarpool', 'purdue_test')
	
	def get(self, start_coords, end_coords):
		return User(start_coords[0], start_coords[1], end_coords[0], end_coords[1])
	
	def match(self, user):
		matches = self.match_to_any(user)
		for match in matches:
			if match == 'OFFERS':
				print match
			else:
				print int(match[0] * 100), int(match[1])
	
	def match_to_any(self, user):
		request_matches = self.match_offer_to_request(user)
		offer_matches = self.match_request_to_offer(user)
		return request_matches + ['OFFERS'] + offer_matches
		
	def match_request_to_offer(self, request):
		circle = Circle(request.end_lat, request.end_lon, None)
		cursor = self.db.cursor()
		cursor.execute('SELECT * FROM listings WHERE isRequest=0')
		offers = []
		for _ in range(cursor.rowcount):
			row = cursor.fetchone()
			offers.append(row)
		cursor.close()

		scores = []
		for offer in offers:
			# Only look at matches if the start locations are close and the departure dates are within one day of each other
			if self.startLocProximity(request.start_lat, request.start_lon, offer[2], offer[3]) < 2 * circle.rad:
				line = Line(offer[2], offer[3], offer[5], offer[6])
				score = self.score(self.dist(circle, line), circle.rad)
				scores.append([score, offer[0]])
		return sorted(scores, key=lambda score: score[0], reverse=True)
	
	def match_offer_to_request(self, offer):
		line = Line(offer.start_lat, offer.start_lon, offer.end_lat, offer.end_lon)
		cursor = self.db.cursor()
		cursor.execute('SELECT * FROM listings WHERE isRequest=1')
		requests = []
		for _ in range(cursor.rowcount):
			row = cursor.fetchone()
			requests.append(row)
		cursor.close()

		scores = []
		for request in requests:
			# Only look at matches if the start locations are close and the departure dates are within one day of each other
			radius = request[8] * 3
			if radius == 0:
				radius = 10 * 3
			if self.startLocProximity(request[2], request[3], offer.start_lat, offer.start_lon) < 2 * radius:
				print 'Start location is close.'
				circle = Circle(request[5], request[6], request[8])
				score = self.score(self.dist(circle, line), circle.rad)
				scores.append([score, request[0]])
				print 'Score:', score
		return sorted(scores, key=lambda score: score[0], reverse=True)

	def startLocProximity(self, lat1, lon1, lat2, lon2):
		dlon = lon2 - lon1
		dlat = lat2 - lat1

		# Convert a latitude/longitude distance into miles
		a = math.sin(dlat / 2.0) ** 2 + math.cos(lat1) * math.cos(lat2) * (math.sin(dlon / 2.0) ** 2)
		c = 2 * math.atan2(math.sqrt(a), math.sqrt(1-a))
		d = 100 * c
		return d

	def dist(self, circle, line):
		px = line.end_lon - line.start_lon
		py = line.end_lat - line.start_lat

		u = ((circle.lon - line.start_lon) * px + (circle.lat - line.start_lat) * py) / float(px ** 2 + py ** 2)

		if u > 1:
			u = 1
		elif u < 0:
			u = 0

		lon = line.start_lon + u * px
		lat = line.start_lat + u * py
		dlon = lon - circle.lon
		dlat = lat - circle.lat

		# Convert a latitude/longitude distance into miles
		a = math.sin(dlat / 2.0) ** 2 + math.cos(line.end_lat) * math.cos(circle.lat) * (math.sin(dlon / 2.0) ** 2)
		c = 2 * math.atan2(math.sqrt(a), math.sqrt(1-a))
		distance = 100 * c
		return distance
	
	# Score a ride based on its distance from a destination and desired drop-off radius
	#	distance = 0:				match score of 100%
	#	distance = desired_radius:		match score of  75%
	#	distance = 2 * desired_radius:		match score of  30%
	#	distance = 2.5 * desired_radius:	match score of   1%
	def score(self, distance, desired_radius):
		result = 1 - 0.25 * (distance / desired_radius) ** 1.5

		if result < 0:
			result = 0
		return result

def address2Coordinate(address):
	if re.match('Purdue(\\s+)University/i', address):
		address = '1275 Third St West Lafayette Indiana 47906'
	address = address.replace(' ', '%20')
	mapquest = 'http://www.mapquestapi.com/geocoding/v1/address?&key=Fmjtd%7Cluur210znh%2Cb0%3Do5-90ys0a&location='
	mapquest_result = urllib2.urlopen(mapquest + address)
	html = mapquest_result.read()
	vals = json.loads(html)
	lat_long = vals['results'][0]['locations'][0]['latLng'];
	return [lat_long['lat'], lat_long['lng']]


def main():
	if len(sys.argv) != 3:
		sys.exit('Usage: python matcher.py <starting location> <ending location>')
	
	start_address = sys.argv[1]
	end_address = sys.argv[2]

	startcoords = address2Coordinate(start_address)
	endcoords = address2Coordinate(end_address)

	matcher = Matcher()
	user = matcher.get(startcoords, endcoords)
	matcher.match(user)

main()
