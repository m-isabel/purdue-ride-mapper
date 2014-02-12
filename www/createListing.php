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

<?php
// define variables and set to empty values
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	alert("BAM!");
}
?>

<hr class="featurette-divider">
<div class="container" >
	<div class="row">
	
		<div class="col-md-4">
		</div>				
		
		<div class="col-md-4">
			<form class="form-signin" role="form" id="createListingForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<h2 class="form-signin-heading">Create Listing</h2>
				
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Starting Location" required autofocus>
				</div>

				<div class="form-group" id="test">
					<input type="text" class="form-control" placeholder="Destination" required autofocus>
				</div>
				
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Number of Passangers" required autofocus>
				</div>						
				
				<div class="form-group">
					<div class='input-group date' id='datetimepicker1'>
						<input type='text' class="form-control" placeholder="Desired Departure Date"/>
						<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
						</span>
					</div>
				</div>

				<script type="text/javascript">
					$(function () {
						$('#datetimepicker1').datetimepicker();
					});
				</script>

				<button class="btn btn-lg btn-primary btn-block" type="submit" id="submitButton">Submit</button>
			</form>
		</div> <!-- col-md-4 -->
		
	</div> <!-- row -->
</div> <!-- /container -->
