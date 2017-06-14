<?php
	// Totally clean-up session values
	session_save_path("temp");
	session_start();
    session_unset();
    session_destroy();
    session_write_close();
    setcookie(session_name(),'',0,'/');
    session_regenerate_id(true);
?>

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
		<title>Custom Error Page</title>
    </head>
    <body class="error">
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
		<div class="navbar-header">
		 <a class="navbar-brand" href="index.php">Highport Staff Portal</a>
		</div>
		<ul class="nav navbar-nav">
		  <li><a href="index.php">Go back to login page to try again</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			  <li><a href="index.php"><span class="glyphicon glyphicon-log-in"></span> Log in</a></li>
		</ul>
	  </div>
	</nav>
	
	<div style="margin-left:50px;">
		<div class="well" style="max-width:600px;">
			<h2>Opps ... an error has occured!</h2>
			<p>Use the navigation options above to try again.</p>
			<p>Sorry for any inconvenience.</p>
		</div>
	</div>

	</body>
</html>

