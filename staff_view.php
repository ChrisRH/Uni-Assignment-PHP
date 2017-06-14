<?php
	// Set custom session save path 
	session_save_path("temp");
	session_start();

	// Prevent non-logged in users viewing page
	if ($_SESSION["user_valid"] != true)
	{
		// Not validated - don't allow!
		header("Location: clear_all.php");
		exit;
	}
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
		<title>View Staff</title>
    </head>
    <body class="staff_view">
	
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
			
			echo "<div class='row staff-list'>";
			echo "<h2>Active Staff List</h2>";
			// Load staff xml to display records
			require_once('xml_parser.php');
			echo "</div>";
		?>
		
	</body>
</html>