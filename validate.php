<?php

	/* 
	validate.php checks all login requirements before either
	letting user proceed to welcome page or sending them back to login page.
	
	Three validations are checked server side:
	#1 Captcha
	#2 Username
	#3 Password
	
	Custom error messages are passed to the login page to show what failed.
	N.B. This page does not output anything to the browser.
	
	Also if database or SQL errors are encountered the user is redirected to a custom error page
	where they can navigate back to the login page to try again.
	*/
	
	session_save_path("temp");
	session_start();

	// Set validation variables as required
	$_SESSION["login_failed"] = "false";
	$_SESSION["username_error"] = "";
	$_SESSION["password_error"] = "";
	$_SESSION["captcah_error"] = "";
	$_SESSION["user_role"] = "";
	$_SESSION["user_valid"] = false;
	$captcha_ok = false;
	$username_ok = false;
	$password_ok = false;
	$user_ok = false;

	// First check the easiest input - the Captcha
	if($_POST['captcha'] == $_SESSION['digit'])
	{
		// Captcha input is valid
		$captcha_ok = true;
	}
	else
	{
		// Capture failed
		$_SESSION["captcah_error"] = "<span style='color:#CA0505'> - Captcha did not match </span>";
	}

	// Next we check user login input
	$username = $_REQUEST["username"];
	$password = $_REQUEST["password"];

	// Login to Oracle to check user input with database values
	$dbuser="test";
	$dbpass="test123";
	$db="SSID";
	$connect=OCILogon($dbuser, $dbpass, $db);

	if (!$connect)
	{
		// Issue connecting to database - redirect to custom error page
		header("Location: error.php");
		exit;
	}

	// build sql statement
	$query="SELECT * FROM userlogin WHERE username='".$username. "' OR password='".$password."'";

	// Check the sql statement for errors and if there are errors report them.
	$stmt=OCIParse($connect, $query);

	if(!$stmt)
	{
		// Error occurred in parsing the SQL string - redirect to custom error page
		header("Location: error.php");
		exit;
	}

	OCIExecute($stmt);

	while(OCIFetch($stmt))
	{	
		if((OCIResult($stmt,"USERNAME") == $username) && (OCIResult($stmt,"PASSWORD") == $password))
		{
			// Success - user validated against database - set needed values
			$_SESSION["user_role"] = OCIResult($stmt,"ROLE");
			$_SESSION["user_name"] = $username;
			$_SESSION["user_valid"] = true;
			$username_ok = true;
			$password_ok = true;
			$user_ok = true;
			break;
		}
		
		if (OCIResult($stmt,"USERNAME") == $username)
		{
			$username_ok = true;
		}
		
		if (OCIResult($stmt,"PASSWORD") == $password)
		{
			$password_ok = true;
		}
	}

	//close the database connection
	OCILogOff($connect);

	// Navigate to welcome page if all validated
	if ($captcha_ok == true && $user_ok == true)
	{
		// All ok to proceed
		header("Location: home.php");
		exit;
	}
	else
	{
		// User has not been validated server side - set feedback messages to show user
		$_SESSION["login_failed"] = "true";
		if ($username_ok == false) { $_SESSION["username_error"] = "<span style='color:#CA0505'> - Username does not exist </span><br/>"; }
		if ($password_ok == false) { $_SESSION["password_error"] = "<span style='color:#CA0505'> - Password does not exist </span><br/>"; }
		// Send back to login page
		header("Location: index.php");
		exit;
	}
?>