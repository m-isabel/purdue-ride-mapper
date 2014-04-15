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
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/justified-nav.css" rel="stylesheet">
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
		<script src="js/gmaps.js"></script>				
		<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="js/moment.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>



<!-- Custom styles for this template -->
<link href="signin.css" rel="stylesheet">
	</head>

	<body>
		<script type="text/javascript">
			function showModal()
			{
				$('#signInModal').modal('show');
			}
			
			function hideAll(sender)
			{
				if (document.getElementById("about")) {
					document.getElementById('about').parentNode.className = "inactive";
				}
				if (document.getElementById("contact")) {
					document.getElementById('contact').parentNode.className = "inactive";
				}
				if (document.getElementById("findARide")) {
					document.getElementById('findARide').parentNode.className = "inactive";
				}
				if (document.getElementById("listARide")) {
					document.getElementById('listARide').parentNode.className = "inactive";
				}
				if (document.getElementById("login")) {
					document.getElementById('login').parentNode.className = "inactive";
				}
				if (document.getElementById("home")) {
					document.getElementById('home').parentNode.className = "inactive";
				}
				if (document.getElementById("manageUsers")) {
					document.getElementById('manageUsers').parentNode.className = "inactive";
				}
				if (document.getElementById("editListings")) {
					document.getElementById('editListings').parentNode.className = "inactive";
				}
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
						<li><a href="#" id="about" onclick="hideAll(this);">About Us</a></li>
						<li><a href="#" id="contact" onclick="hideAll(this);">Contact Us</a></li>
						<li><a href="#" id="findARide" onclick="hideAll(this);">Find a Ride</a></li>
						<?php
							session_start();
							if (!isset($_SESSION['user']))
							{
								echo '<li><a href="#" id="loginModal" onclick="showModal()">Log In Modal</a></li>';
								echo '<li><a href="#" id="login" onclick="hideAll(this);">Log In</a></li>';
							}
							else
							{
								echo '<li><a href="#" id="manageUsers" onclick="hideAll(this);">Manage Users</a></li>';
								echo '<li><a href="#" id="editListings" onclick="hideAll(this);">My Listings</a></li>';
								echo '<li><a href="#" id="listARide" onclick="hideAll(this);">Create a Ride</a></li>';
								echo '<li><a href="#" id="logout" onclick="location.href = \'modules/signin/signoutProc.php\';">Log Out</a></li>';
							}

							function logout()
							{
								session_destroy();
								echo "<script type='text/javascript'>alert('logged out'); location.reload();</script>";
							}
						?>

					</ul>
				</div>

				<div id="content">
					<hr class="featurette-divider">
					<!-- Jumbotron -->
					<div class="jumbotron">
						<h1>Welcome to College Carpool!</h1>
						<p class="lead">Many students who attend college live far away from home.
						Many of those students do not own vehicles on campus. When it comes time to take trips home or to other places,
						some students need rides or are looking for people to share with to help pay for gas. But sometimes finding people
						in a student population of 40,000 can be difficult or even impossible.
						College Carpool is here to make it easier!
						</p>

						<p><a class="btn btn-lg btn-success" id="register" href="#" role="button" onclick="hideAll(this);">Register Now!</a></p>
					</div>

					<!-- Example row of columns -->
					<div class="row">
						<div class="col-lg-4">
							<h2>Find a Ride</h2>
							<p>
							Once you register or sign in, you will be able to see a list of all available rides.
							</p>
							<p><a class="btn btn-primary" id="findARideAlternative" href="#" role="button" onclick="hideAll(this);">Find a ride</a></p>
						</div>
						<div class="col-lg-4">
							<h2>Create a Ride</h2>
							<p>
							Once you sign in, you will be able to create your own rides.
							</p>
							<p><a class="btn btn-primary" id="listARideAlternative" href="#" role="button" onclick="hideAll(this);">List a ride</a></p>
						</div>
						<div class="col-lg-4">
							<h2>Questions?</h2>
							<p>
							Concerns? Not sure how this works? Found a bug? Feel free to email us!
							</p>
							<p><a class="btn btn-primary" id="contactAlternative" href="#" role="button" onclick="hideAll(this);">Contact us</a></p>
						</div>
					</div>
				</div>

				<script type="text/javascript">
					$("#editListings").click(function()
					{
						$( "#content" ).load( "modules/editListings/editListings.php" );
					});
					$("#manageUsers").click(function()
					{
						$( "#content" ).load( "modules/manageUsers/manageUsers.php" );
					});
					$("#login").click(function()
					{
						$( "#content" ).load( "modules/signin/signin.php" );
					});
					$("#contact").click(function()
					{
						$( "#content" ).load( "modules/contact/contact.php" );
					});
					$("#contactAlternative").click(function()
					{
						$( "#content" ).load( "modules/contact/contact.php" );
					});
					$("#home").click(function()
					{
						$( "#content" ).load( "home.php" );
					});
					$("#listARide").click(function()
					{
						$( "#content" ).load( "modules/createListing/createListing.php" );
					});
					$("#findARideAlternative").click(function()
					{
						$( "#content" ).load( "modules/findListing/findListing.php" );
					});
					$("#listARideAlternative").click(function()
					{
						$( "#content" ).load( "modules/createListing/createListing.php" );
					});
					$("#findARide").click(function()
					{
						$( "#content" ).load( "modules/findListing/findListing.php" );
					});
					$("#about").click(function()
					{
						$( "#content" ).load( "modules/about/about.php" );
					});
					$("#register").click(function()
					{
						$( "#content" ).load( "modules/register/register.php" );
					});
				</script>

				<?php if ($_GET["page"] == "editListings") { ?>
					<script type='text/javascript'> 
						$(document).ready(function() {
							$("#editListings").click();
						});
					</script>
				<?php } ?>


				<!-- Site footer -->
				<div class="footer">
					<p>&copy; College Carpool 2014</p>
				</div>
			</div>
		</div> <!-- /container -->
	</body>
	
	<script>
		var emailValid = false;
		var passwordValid = false;

		function registerRedirect()
		{
			location.replace("modules/register/register.php");
		}

		/**
		* showPwModal()
		*
		* bring up the modal to submit email for resetting password
		*/
		function showPwModal()
		{
			$('#signInModal').modal('hide');
			var delay=1000;//1 seconds
			setTimeout(function(){
				$('#modalPwReset').modal('show');
			},delay); 
			
		}

		/**
		* submitEmail
		*
		* process the email to inform user how to reset the password
		*/
		function submitEmail()
		{
			var elm = document.getElementById('txtEmail');
			var patt = /[A-Za-z0-9]+@([A-Za-z0-9]+\.[A-Za-z0-9])+/i

			if (txtEmail.value.trim() == "") 
			{
				alert("Please enter an email address");
				return;
			}

			if (! patt.test(txtEmail.value)) 
			{
				alert("Please enter a valid email address!");
				return;
			}

			$.ajax ({ 
				type: "POST",
						url: "/modules/signin/forgotPassword.php", 
							dataType: 'json',
							data: {"email" : txtEmail.value.trim()}, 
					success: function(data) {

							if (data.retval == "ERR") 
					{
								alert("Error: No such email / database connection failed");
								$('#modalPwReset').modal('hide');
						return;
							}

						alert("An email has been sent to your account, please check for details");
							$('#modalPwReset').modal('hide');
					}	
				}); 
			

		}

		function validateEmail(sender)
		{
			var parent = sender.parentNode;
			var textBoxValue = sender.value;
			var atPos= textBoxValue.indexOf("@");
			var dotPos= textBoxValue.lastIndexOf(".");
			var edu = textBoxValue.split(".").pop();

			if (atPos < 1 || dotPos < atPos + 2 || dotPos + 2 >= textBoxValue.length || edu != "edu")
			{
				parent.className = "form-group has-error";
				emailValid = false;
				validateForm();
			}
			else
			{
				parent.className = "form-group has-success";
				emailValid = true;
				validateForm();
			}
		}

		function validatePassword(sender)
		{
			var parent = sender.parentNode;
			var textBoxValue = sender.value;

			if(textBoxValue.length >= 6 && textBoxValue.length <= 24)
			{
				parent.className = "form-group has-success";
				passwordValid = true;
				validateForm();
			}
			else
			{
				parent.className = "form-group has-error";
				passwordValid = false;
				validateForm();
			}
		}

		function validateForm()
		{
			var button =  document.getElementById('loginButton');
			if(emailValid && passwordValid)
			{
				button.disabled = false;
			}
			else
			{
				button.disabled = true;
			}
		}
	</script>

	<!-- Login Modal -->
	<div class="modal fade" id="signInModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-signin" action="/modules/signin/signinProc.php" method="post" role="form">		
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
						<h3>Please Sign In</h3>
					</div>
					<div class = "modal-body">
						<div class="form-group has-error">	
							<input type="text" class="form-control" name="email" placeholder="Email" onkeyup="validateEmail(this)" required autofocus>
						</div>

						<div class="form-group has-error">
							<input type="password" class="form-control" name="pass" placeholder="Password" onkeyup="validatePassword(this)" required>
						</div>

						<div class="form-group">
							<label class="checkbox">
								<input type="checkbox" value="remember-me">Remember me
							</label>
						</div>

						<div class="form-group">
							<button class="btn btn-lg btn-primary btn-block" type="submit" id="loginButton" disabled>Sign in</button>
						</div>

						<div class="form-group">
							<button class="btn btn-lg btn-primary btn-block" onclick="registerRedirect()" type = "button" id="registerButton">Register</button>
						</div>

						<div class="form-group">
						</div>
							
						<button class="btn btn-lg btn-primary btn-block" onclick="showPwModal()" type="text" id="pwModalButton">Forgot Password?</button>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!-- Password reset modal -->
	<div class="modal fade" id="modalPwReset" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Send Reset Password Link</h4>
				</div>
				<div class="modal-body">
					<b>Email</b>      <input type="text" class="form-control" name="email" id="txtEmail"><br>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onClick="submitEmail()">Submit</button>
				</div>
			</div>
		</div>
	</div>
</html>
