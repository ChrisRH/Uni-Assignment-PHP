<?php
// Set custom session save path 
session_save_path("temp");
session_start();
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto">
		<link rel="stylesheet" type="text/css" href="styles/master.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<title>Login Page</title>
    </head>
    <body class="index">
		<form action="validate.php" method="post" onsubmit="return checkInput(this);">
			<?php
				// Load default navigation menu for non-logged in user
				require_once('navbar_default.php');
			?>
			<div class="row">
				<div class="col-md-5">
					<h3>Please enter your login details</h3>
					<div class="form-group">
					  <label for="usr">User Name:</label>
					  <input type="text" class="form-control" id="usr" name="username" style="max-width:350px;">
					</div>
					<div class="form-group">
					  <label for="pwd">Password:</label>
					  <input type="password" class="form-control" id="pwd" name="password" style="max-width:350px;">
					</div>
					
					<div>
						<span>Enter numbers to confirm you are not a bot</span><br/>
						<input name="captcha" type="text">
						<img src="captcha.php" /><br/><br/>
						<input type="submit" class="btn btn-primary" style="width:200px;" value="Submit">
						<button type="button" class="btn btn-md"><a href="clear_all.php">Reset Form</a></button>
					</div>
					<div>
						<?php 
						// Show login/captcha issues if not validated server side
						if ($_SESSION["login_failed"] == "true")
							{
								echo "<h4>Your login attempt failed:</h4>";
								echo $_SESSION["username_error"];
								echo $_SESSION["password_error"];
								echo $_SESSION["captcah_error"]; 
								echo "<h5>Please try again.</h5>";
							}
						?>
					</div>
				</div>
				<div class="col-md-7">
					<h2>Access Limited</h2>
					<p>This function is available for authorised use only.</p>
					<p>You must log in first before using</p>
					<hr/>
					<h4>Access for testing</h4>
					<p>Admin username: admin<br/>
					Admin password: SIT780</p>
					<p>Guest username: guest<br/>
					Guest password: SIT780</p>
					<br/>
					<p style="font-size:12px"><span style="font-weight: bold">Please Note:</span> All input on this form will only accept alphanumeric characters for security reasons</p>
				</div>
			</div>
		</form>
		
		<script type="text/javascript">
		
		// Client side validation - check user input
		  function checkInput(form)
			{
				// Check Captcha input are numeric and 5 characters long
				if(!form.captcha.value.match(/^\d{5}$/)) {
				  // Captcha input not OK
				  alert('Opps, Captcha details need attention!');
				  form.captcha.focus();
				  return false;
				}
				
				// Check username input is supplied and is valid input - only alphanumeric characters allowed
				if (!form.username.value.match(/^([0-9]|[a-z])+([0-9a-z]+)$/i)) {
					alert('Opps, Username input needs attention - cannot be empty and must be alphanumeric characters only!');
					form.username.focus();
					return false;
				}
				
				// Check password input is supplied and is valid input - only alphanumeric characters allowed
				if (!form.password.value.match(/^([0-9]|[a-z])+([0-9a-z]+)$/i)) {
					alert('Opps, Password input needs attention - cannot be empty and must be alphanumeric characters only!');
					form.password.focus();
					return false;
				}
				
				// All input OK - continue
				return true;
			}

		</script>
    </body>
</html>