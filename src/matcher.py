import math
import operator
import MySQLdb as mysql

# Circle class to represent a geometric Circle object
class Circle:
	def __init__(self, x, y, radius):
		self.x = x
		self.y = y
		self.radius = radius
	
	def getX(self):
		return self.x
	
	def getY(self):
		return self.y
	
	def getRadius(self):
		return self.radius
		
# Line class to represent a geometric Line object
class Line:
	def __init__(self, x1, y1, x2, y2):
		self.x1 = x1
		self.y1 = y1
		self.x2 = x2
		self.y2 = y2
		
	def getX1(self):
		return self.x1
	
	def getY1(self):
		return self.y1
	
	def getX2(self):
		return self.x2
	
	def getY2(self):
		return self.y2


class Matcher:
	def __init__(self):
		try:
			self.db = mysql.connect('localhost', 'collegecarpool', 'collegecarpool', 'purdue_test')
			self.cursor = self.db.cursor()
		except _mysql.Error as e:
			sys.exit(1)
		finally:
			if (self.db):
				self.db.close()

	# Match a user to a list of rides of the opposite type
	def match(self, user):
		if user.getType() == "Request":
			match_request_to_offer(user)
		else:
			match_offer_to_request(user)
			
	# Match a request to a list of scored offers
	def match_request_to_offer(self, request):
		circle = Circle(request.long, request.lat, request.radius)
		
		#offers = get list of offers from database
		self.cursor.execute('SELECT * FROM listings WHERE isRequest=0')
		offers = []
		for _ in range(self.cursor.rowcount):
			row = self.cursor.fetchone()
			offers.append(row)
			print row

		scores = {}
		for offer in offers:
			line = Line(offer.startlong, offer.startlat, offer.endlong, offer.endlat)
			scores[offer] = score(dist_function(circle, line), circle.radius)
		
		sorted_scores = sorted(scores.items(), key=operator.itemgetter(1))
		return sorted_scores
	
	# Match an offer to a list of scored requests
	def match_offer_to_request(self, offer):
		line = Line(offer.startlong, offer.startlat, offer.endlong, offer.endlat)
		
		#requests = get list of requests from database
		self.cursor.execute('SELECT * FROM listings WHERE isRequest=1')
		requests = []
		for _ in range(self.cursor.rowcount):
			row = self.cursor.fetchone()
			requests.append(row)
			print row

		scores = {}
		for request in requests:
			circle = Circle(request.long, request.lat, request.radius)
			scores[request] = score(dist_function(circle, line), circle.radius)
		
		sorted_scores = sorted(scores.items(), key=operator.itemgetter(1))
		return sorted_scores
	
	# Uses the geometric formula for the minimum distance from a point to a line.
	def dist_function(self, circle, line):
		px = line.getX2() - line.getX1()
		py = line.getY2() - line.getY1()
		
		u = ((circle.getX() - line.getX1()) * px + (circle.getY() - line.getY1()) * py) / float(px * px + py * py)
		
		if u > 1:
			u = 1
		elif u < 0:
			u = 0
		
		dx = line.getX1() + u * px - circle.getX()
		dy = line.getY1() + u * py - circle.getY()
		
		return math.sqrt(dx * dx + dy * dy)
		
	# Score a result by its distance to a given match
	# Currently uses a naive probabilistic function where...
	#	if distance == 0: 100% match
	#	if distance is at boundary of desired_radius: 75% match
	#	if distance is twice the desired_radius: 50% match
	#	if distance is 3x the desired_radius: 25% match
	#	if distance is 4+ times the desired radius: 0% match
	# TODO: this is probably a bad scoring function
	def score(self, distance, desired_radius):
		result = 1 - 0.25 * distance / desired_radius

		if result < 0:
			result = 0
		
		return result

class User:
	def __init__(self):
		self.type = "Request"
	def getType():
		return self.type

matcher = Matcher()
matcher.match(User())