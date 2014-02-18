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
<script>
	function disablePassengers()
	{
		var passengers = document.getElementById('passengersTextBox');
		passengers.disabled = true;
	}
	function enablePassengers()
	{
		var passengers = document.getElementById('passengersTextBox');
		passengers.disabled = false;
	}
</script>

<hr class="featurette-divider">
<div class="container" >
	<div class="row">
	
		<div class="col-md-4">
		</div>				
		
		<div class="col-md-4">
			<form class="form-signin" role="form" id="createListingForm" method="post" action="createListingProcessing.php">
				<h2 class="form-signin-heading">Create Listing</h2>
				
				<div class="form-group">
					<input name="startingLocation" type="text" class="form-control" placeholder="Starting Location" required autofocus>
				</div>

				<div class="form-group" id="test">
					<input name="destination" type="text" class="form-control" placeholder="Destination" required autofocus>
				</div>
				
				<div class="form-group">
					<div class='input-group date' id='dateTimerPicker'>
						<input name="departureDateTime" type='text' class="form-control" placeholder="Desired Departure Date" required autofocus />
						<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
						</span>
					</div>
				</div>	
				
				<div class="form-group">
					<input type="radio" name="isRequest" value="1" onClick="enablePassengers()" checked> Looking for a Ride 
					<input type="radio" name="isRequest" value="0" onClick="disablePassengers()"> Hosting a Ride 			
				</div>
				
				<div class="form-group">
					<input id="passengersTextBox" name="numberOfPassengers" type="text" class="form-control" placeholder="Number of Passangers" required autofocus>
				</div>		
				
				<script type="text/javascript">
					$(function () {
						$('#dateTimerPicker').datetimepicker();
					});
				</script>

				<button class="btn btn-lg btn-primary btn-block" type="submit" id="submitButton">Submit</button>
			</form>
		</div> <!-- col-md-4 -->
		
	</div> <!-- row -->
</div> <!-- /container -->
