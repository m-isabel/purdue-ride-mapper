<!DOCTYPE html>
<html>
<body>
<hr class="featurette-divider">
<div class="row">
		<div id="map_canvas" style="height: 400px; width: 100%"></div>
		<hr class="featurette-divider">
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
		<br>
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
	<div>
	<?php
		session_start();
		if (!isset($_SESSION['user']))
		{
		}
		else
		{

			$con=mysqli_connect("localhost","collegecarpool","collegecarpool","purdue_test");

			if(mysqli_connect_errno())
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			else
			{
				$sql = "SELECT * FROM listings";
				$result = mysqli_query($con,$sql);
				echo "<table class='table table-striped'>
				<thead>
				<tr>
				<th> StartingAddress </th>
				<th> EndingAddress </th>
				<th> Request? </th>
				<th> Passengers </th>
				<th> Date of Departure </th>
				<th> Test1 </th>
				<th> Test2 </th>
				</tr>
				</thead>";
				while($row = mysqli_fetch_array($result))
				{
					echo "<tr>";
					echo "<td>". $row['startingAddress'] . "</td>";
					echo "<td>". $row["endingAddress"] . "</td>";
					if($row["isRequest"] == 0)
					{
						echo "<td> No </td>";
					}
					else
					{
						echo "<td> Yes </td>";
					}

					echo "<td>". $row["passengers"] . "</td>";
					echo "<td>". $row["dateOfDeparture"] . "</td>";
					//echo "</tr>";
					
					$start_lat1 = $row["start_lat"];
					$end_lon1 = $row["start_long"];
					$start_lat2 = $row["end_lat"];
					$end_lon2 = $row["end_long"];
				}
				echo "<td>". $start_lat1 . "</td>";
				echo "<td>". $end_long1 . "</td>";
				echo "</tr>";
				echo "</table>";
			}
			mysqli_close($con);
		}
	?>
	</div>
</body>
</html>
