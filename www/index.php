<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>College Carpool</title>

		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="css/justified-nav.css" rel="stylesheet">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
		<script src="js/gmaps.js"></script>
	</head>

	<body>		
		<script type="text/javascript">
			function hideAll(sender) 
			{				
				document.getElementById('about').parentNode.className = "inactive";
				document.getElementById('contact').parentNode.className = "inactive";
				document.getElementById('findARide').parentNode.className = "inactive";
				document.getElementById('listARide').parentNode.className = "inactive";
				document.getElementById('login').parentNode.className = "inactive";
				document.getElementById('home').parentNode.className = "inactive";
				sender.parentNode.className = "active";
			}
		</script>
		
		<div class="container">
			<div id="#body">
				<div class="masthead">
					<div align=middle>
						<img src="images/LogoHiRes.png" align="middle" width="600" alt="College-Carpool-Banner">
					</div>
					<ul class="nav nav-justified">
						<li class="active"><a href="#" id="home" onClick="hideAll(this);">Home</a></li>
						<li><a href="#" id="about" onclick="hideAll(this);">About</a></li>
						<li><a href="#" id="contact" onclick="hideAll(this);">Contact</a></li>
						<li><a href="#" id="findARide" onclick="hideAll(this);">Find a Ride</a></li>
						<li><a href="#" id="listARide" onclick="hideAll(this);">List a Ride</a></li>
						<li><a href="#" id="login" onclick="hideAll(this);">Log In</a></li>
					</ul>
				</div>
				
				<div id="content">
				<hr class="featurette-divider">
					<!-- Jumbotron -->
					<div class="jumbotron">
						<h1>Welcome to College Carpool!</h1>
						<p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet.</p>
						<p><a class="btn btn-lg btn-success" href="#" role="button">Register Now!</a></p>
					</div>

					<!-- Example row of columns -->
					<div class="row">
						<div class="col-lg-4">
							<h2>Heading</h2>
							<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
							<p><a class="btn btn-primary" href="#" role="button">View details &raquo;</a></p>
						</div>
						<div class="col-lg-4">
							<h2>Heading</h2>
							<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
							<p><a class="btn btn-primary" href="#" role="button">View details &raquo;</a></p>
						</div>
						<div class="col-lg-4">
							<h2>Heading</h2>
							<p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
							<p><a class="btn btn-primary" href="#" role="button">View details &raquo;</a></p>
						</div>
					</div>
				</div>
				
				<script type="text/javascript">    
					$("#login").click(function()
					{
						$( "#content" ).load( "signin.html" );
					});
					$("#contact").click(function()
					{
						$( "#content" ).load( "contact.html" );
					});
					$("#home").click(function()
					{
						$( "#content" ).load( "home.html" );
					});
					$("#listARide").click(function()
					{
						$( "#content" ).load( "createListing.php" );
					});
					$("#findARide").click(function()
					{
						$( "#content" ).load( "findListing.html" );
					});
					$("#about").click(function()
					{
						$( "#content" ).load( "about.html" );
					});
				</script>
				

				<!-- Site footer -->
				<div class="footer">
					<p>&copy; College Carpool 2014</p>
				</div>
			</div>
		</div> <!-- /container -->
	</body>
</html>
