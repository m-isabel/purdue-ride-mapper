<!DOCTYPE html>
<html>
<body>
<hr class="featurette-divider">
<div class="row">
	<div class="col-lg-6">
		<div>
		<h2 class="form-signin-heading">Search for a ride:</h2>
			<form class="form-inline" role="form">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Starting Address">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Destination Address">
				</div>
				<button type="submit" class="btn btn-default" onclick="calcRoute();" >Search</button>
			</form>
		</div>		
		<div>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Starting Location</th>
						<th>Destination</th>
						<th>Capacity</th>
						<th>Date of Departure</th>
						<th>Request</th>
						<th>User</th>
					</tr>
				</thead>
					<tr>
						<td>2243 US HWY 52 W, West Lafayette IN 47906</td>
						<td>Purdue University, West Lafayette IN 47906</td> 
						<td>0</td>
						<td>2/25/2014</td>
						<td>Yes</td>
						<td>evan@purdue.edu</td>
					</tr>
					<tr>
						<td>Brookston IN 47906</td>
						<td>Indianapolis, IN</td> 
						<td>3</td>
						<td>2/27/2014</td>
						<td>No</td>
						<td>logan@purdue.edu</td>
					</tr>
			</table>
		</div>
	</div>
	<div class="col-lg-6">
		<div id="map_canvas" style="height: 500px; width: 400px"></div>
		<script>
			//This script create the map with a default address.
			//Its current location is somewhere by College Station
			$(document).ready(function () 
			{
				var map = new GMaps
				({
					div: '#map_canvas',
					lat: 40.463666,
					lng: -86.945828,
					position: 'bottom_center',
					zoomControl : true,
					zoomControlOpt: 
					{
						style : 'SMALL',
					},
					panControl : false,
				});
				
				//This add the start address marker
				map.addMarker
				({
					lat:40.463666,
					lng: -86.945828,
				});
				
				//This will add the route drawing from start to destination
				//Colors can be changed (Its in Hex)
				map.drawRoute
				({
					origin: [40.463666,-86.945828],
					destination: [40.422906,-86.910637],
					travelMode: 'driving',
					strokeColor: '#0000FF',
					strokeOpacity: 0.6,
					strokeWeight: 6
				});
				
				//This add the destination address marker
				map.addMarker
				({
					lat:40.422906,
					lng:-86.910637,
				});
				
				map.addMarker
				({
					lat:40.602875,
					lng:-86.874245,
				});			
				
				map.addMarker
				({
					lat:39.772659,
					lng:-86.167359,
				});
								
				map.drawRoute
				({
					origin: [40.602875,-86.874245],
					destination: [39.772659,-86.167359],
					travelMode: 'driving',
					strokeColor: '#E9BBC1',
					strokeOpacity: 0.6,
					strokeWeight: 6
				});
				
				map.fitZoom();
			});
		</script>
	</div>
</div>
<?php
	$con=mysqli_connect("localhost","collegecarpool","collegecarpool","purdue_test");
	
	if(mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	else
	{
		$sql = "SELECT * FROM listings";
		$result = mysqli_query($con,$sql);
		while($row = mysqli_fetch_array($result))
		{
			$start = $row["startingAddress"];
			$end = $row["endingAddress"];
		}
	}
	mysqli_close($con);
	header('Location: ../../index.php');
	exit();
?>
</body>
</html>