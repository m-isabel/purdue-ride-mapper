<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Sign in to College Carpool</title>

		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="signin.css" rel="stylesheet">
	</head>

	<body>
	<script>
	var emailValid = false;
	var usernameValid = false;
	var passwordValid = false;
	var passwordRepeatValid = false;
	var universityValid = false;
	var termsOfServiceValid = false;
	
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
	
	function validateUsername(sender)
	{
		var parent = sender.parentNode;		
		var textBoxValue = sender.value;
		
		if(textBoxValue.length >= 6 && textBoxValue.length <= 24)
		{
			parent.className = "form-group has-success";
			usernameValid = true;
			validateForm();
		}
		else
		{
			parent.className = "form-group has-error";
			usernameValid = false;
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

	function validatePasswordMatcher(sender)
	{
		var parent = sender.parentNode;		
		var textBoxValue = sender.value;
		var textBoxValueTwo =  document.getElementById('password').value;
		
		if(textBoxValue == textBoxValueTwo)
		{
			parent.className = "form-group has-success";
			passwordRepeatValid = true;
			validateForm();
		}
		else
		{
			parent.className = "form-group has-error";
			passwordRepeatValid = false;
			validateForm();
		}
	}
	
	function validateUniversity(sender)
	{
		var parent = sender.parentNode;		
		var textBoxValue = sender.value;
		
		if(textBoxValue.length > 0)
		{
			parent.className = "form-group has-success";
			universityValid = true;
			validateForm();
		}
		else
		{
			parent.className = "form-group has-error";
			universityValid = false;
			validateForm();
		}
	}
	
	function validateTermsOfService(sender)
	{
		var parent = sender.parentNode.parentNode;		
		if(sender.checked)
		{
			parent.className = "form-group has-success";
			termsOfServiceValid = true;
			validateForm();
		}
		else
		{
			parent.className = "form-group has-error";
			termsOfServiceValid = false;
			validateForm();
		}
	}
	
	function validateForm()
	{
		var button =  document.getElementById('submitButton');
		
		if(termsOfServiceValid && universityValid && passwordRepeatValid &&
			usernameValid && usernameValid)
		{
			button.disabled = false;
		}
		else
		{
			button.disabled = true;
		}
	}
	
	</script>
	
	
		<div class="container" >
			<div class="row">
			
				<div class="col-md-4">
				</div>				
				
				<div class="col-md-4">
					<form class="form-signin" role="form" id="registerForm">
						<h2 class="form-signin-heading">Register here</h2>
						
						<div class="form-group has-error">
							<input type="text" class="form-control" placeholder="Username" onkeyup="validateUsername(this);" required autofocus>
						</div>

						<div class="form-group has-error" id="test">
							<input type="text" class="form-control" placeholder="Email" onkeyup="validateEmail(this);" required autofocus>
						</div>
						
						<div class="form-group has-error">
							<input type="password" class="form-control" placeholder="Password" id="password" onkeyup="validatePassword(this);" required autofocus>
						</div>
						
						<div class="form-group has-error">
							<input type="password" class="form-control" placeholder="Retype Password" onkeyup="validatePasswordMatcher(this);" required autofocus>
						</div>
						
						<div class="form-group has-error">
							<input type="text" class="form-control" placeholder="University" onkeyup="validateUniversity(this);" required autofocus>
						</div>
						
						<div class="form-group has-error">
							<label class="checkbox">
								<input type="checkbox" value="agree" onclick="validateTermsOfService(this);">Agree to Terms of Service
							</label>		
						</div>	
						
						<button class="btn btn-lg btn-primary btn-block" type="submit" id="submitButton" disabled>Submit</button>
					</form>
				</div> <!-- col-md-4 -->
				
			</div> <!-- row -->
		</div> <!-- /container -->
	</body>
</html>