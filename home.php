<?php
// Set custom session save path 
session_save_path("temp");
session_start();

// Prevent non-logged in user viewing page
if ($_SESSION["user_valid"] != true)
{
	// Not validated - don't allow!
	header("Location: clear_all.php");
	exit;
}

// Load all staff details into session for search functionality
include('search_xml_parser.php');

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>		
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="styles/master.css">
		<title></title>
    </head>
    <body class="home">
		<?php
			// Load navigation options based on user login level
			switch($_SESSION['user_role']) 
			{
				case "normal": 
					require_once('navbar_normal.php');
					break;
				case "administrator": 
					require_once('navbar_admin.php');
					break;
				default: // Non logged in user
					require_once('navbar_default.php');
					break;
			}
		?>
		
		<div class="row">
			<div class="col-md-5">
				<h2>Welcome to Highport's Staff Portal</h2>
				<h4>You are logged in as:</h4>
				<p>User Name: <?php echo $_SESSION["user_name"] ?></p>
				<p>User Role: <?php echo $_SESSION["user_role"]; ?></p>
				<hr/>
				<p>Your login priviledges gives you access to all the areas available via the navagation bar above.</p>
				<p>You can logout at anytime via the 'log out' link, top right of screen</p>
				<p><span style="font-weight:bold">Pleae note:</span>  your use of this portal is governed by the corporate privacy guidelines.  Please respect staff privacy and do not share this information without following the correct procedures.</p>
			</div>
			<div class="col-md-7 promo-image-1">
				<h2>Highport staff are passionate about our boating customers</h2>
			</div>
		</div>
    </body>
</html>