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
		<title>Staff Search</title>
    </head>
    <body class="staff_search">
	
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
		<form role="search" action="staff_search.php" method="post">
			<div class="row">
				<div class="col-md-5">
					<h3>Staff Search</h3>
					<h4>Search by Given Name or Surname</h4>
					<p>All records containing query will be returned; eg 'Geoff' will also return 'Geoffery' etc. 'h' will return all names containing 'h'.</p>
					<p>Search is not case sensitive.</p>
						<div class="input-group add-on">
							<input class="form-control" placeholder="Enter surname or given name - not both" name="srch-term" id="srch-term" type="text">
							<div class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
							</div>					
						</div>
				</div>
				<div class="col-md-5">
				</div>
			</div>
			<div class="row">
				<div class="col-md-9">
					<?php require_once('search_xml_parser.php');  ?>
				</div>
			</div>
		</form>
	</body>
</html>