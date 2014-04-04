<!DOCTYPE html>
<html>
	<head>
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.css" rel="stylesheet">


		<!-- Custom styles for this template -->
		<link href="signin.css" rel="stylesheet">

		<!-- Custom scripts for the datatimepicker -->
		<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css" />
		<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>		
		<script type="text/javascript" src="js/moment.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
	</head>
	<body>
		<h1 align="center">Processing your request...</h1>
		<h2 align="center">You will be redirected once your request has been processed.</h2>

		<?php
			
			function test_input($data)
			{
			   $data = trim($data);
			   $data = stripslashes($data);
			   $data = htmlspecialchars($data);
			   return $data;
			}
			
			function qualityCodeCheck($qualityCode)
			{
				if(strpos($qualityCode,'C') !== false)//If the quality code contains 'C' it is bad
				{
					return false;
				}
				if(strpos($qualityCode,'P1') !== false || strpos($qualityCode,'A5') !== false || strpos($qualityCode,'Z') !== false || strpos($qualityCode,'L1AAA') !== false)//If the quality code indicates an exact point or city, it's good
				{
					return true;
				}
				return false; //When in doubt, assume it's a bad code
			}
			
			$startingAddress = $destinationAddress = $passengers = $dateTime = $isRequest = $user_id = "";
			
			$startingAddress = test_input($_POST["startingAddress"]);
			$destinationAddress = test_input($_POST["destinationAddress"]);
			$passengers = test_input($_POST["passengers"]);
			$dateTime = test_input($_POST["dateTime"]);
			$isRequest = test_input($_POST["isRequest"]);
			
						
			session_start();
			$user_id = $_SESSION['user'];
			$con=mysqli_connect("localhost", "collegecarpool", "collegecarpool", "purdue_test");
			
			if($isRequest == 1)
			{
				$passengers = 0;
			}
			
			// Check connection
			if (mysqli_connect_errno())
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			else
			{				
				//THIS IS WHERE THE MAPQUEST API IS CALLED
				//@author Evan Arnold <arnold4@purdue.edu>
				//Sets the start/end lats and longs to their real-world values, and 0.0 if there is bad input (like just a state or gibberish)
				//Start Location:
				$lookupStartingAddress = str_replace(' ', '%20', $startingAddress);
				$lookupDestinationAddress = str_replace(' ', '%20', $destinationAddress);
				
				//If address is Purdue, add better address.
				if(preg_match('/Purdue(\\s*)University/i',$startingAddress) === 1)
				{
					$lookupStartingAddress = str_replace(' ', '%20', "1275 Third Street West Lafayette Indiana 47906");
				}
				if(preg_match('/Purdue(\\s*)University/i',$destinationAddress) === 1)
				{
					$lookupDestinationAddress = str_replace(' ', '%20', "1275 Third Street West Lafayette Indiana 47906");
				}				
				
				$mapquestResult = file_get_contents("http://www.mapquestapi.com/geocoding/v1/address?&key=Fmjtd%7Cluur210znh%2Cb0%3Do5-90ys0a&location=" . $lookupStartingAddress ."");
				$parsedResult = json_decode($mapquestResult);
				//debug_to_console("test");
				//debug_to_console($parsedResult);
				//Only parse result if the input address is good.
				$addressQualityCode = $parsedResult->results[0]->locations[0]->geocodeQualityCode;
				if(qualityCodeCheck($addressQualityCode) === false)//If the quality code is bad
				{
					//GUYS WHAT DO WE DO IF IT IS BAD?
					$startLatitude = 0.0;
					$startLongitude = 0.0;
				}				
				else//If the quality of the input is good enough
				{
					$startLatitude = $parsedResult->results[0]->locations[0]->latLng->lat;//Add dat tab
					$startLongitude = $parsedResult->results[0]->locations[0]->latLng->lng;//Add dat tab
				}
				
				//EndLocation
				$mapquestResult2 = file_get_contents("http://www.mapquestapi.com/geocoding/v1/address?&key=Fmjtd%7Cluur210znh%2Cb0%3Do5-90ys0a&location=" . $lookupDestinationAddress ."");
				$parsedResult2 = json_decode($mapquestResult2);
				//Only parse result if the input address is good.
				$addressQualityCode2 = $parsedResult2->results[0]->locations[0]->geocodeQualityCode;
				if(qualityCodeCheck($addressQualityCode2) === false)//If the quality code is bad
				{
					//GUYS WHAT DO WE DO IF IT IS BAD?
					$endLatitude = 0.0;
					$endLongitude = 0.0;
				}				
				else//If the quality of the input is good enough
				{
					$endLatitude = $parsedResult2->results[0]->locations[0]->latLng->lat;//Add dat tab
					$endLongitude = $parsedResult2->results[0]->locations[0]->latLng->lng;//Add dat tab
				}				
				//At this point the start and end Latitudes and Longitudes /should/ be correct.... if there was bad input they are 0.0. We need to handle 0.0 though.


				$sql="INSERT INTO listings (startingAddress, start_lat, start_long, endingAddress, end_lat, end_long, isRequest, passengers, dateOfDeparture, user_id)
				VALUES
				('$startingAddress','$startLatitude','$startLongitude','$destinationAddress','$endLatitude','$endLongitude','$isRequest','$passengers','$dateTime', '$user_id')";

				if (!mysqli_query($con,$sql))
				{
					die('Error: ' . mysqli_error($con));
					mysqli_close($con);
				}
				else
				{
					mysqli_close($con);
					header('Location: ../../index.php?page=editListings');
					exit();
				}		
			}			
		?>
	</body>
</html>
