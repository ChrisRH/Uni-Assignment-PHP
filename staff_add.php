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
// Only admin allowed on this page
else if ($_SESSION["user_role"] != "administrator")
{
	// Logged in user is not admin
	header("Location: home.php");
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
		<title>Staff Add</title>
    </head>
    <body class="staff_add">
	
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
	<form action="staff_add.php" method="post">
		<div class="row">
			<div class="col-md-5">
				<div class="">
					<h3>Add a new staff member</h3>
					<h4>Enter details for new staff member</h4>
				</div>
				
				<div class="form-group">
					<label for="staff-id">Staff ID:</label>
					<input type="text" class="form-control" id="staff-id" name="staff-id">
				</div>
				<div class="form-group">
					<label for="surname">Surname:</label>
					<input type="text" class="form-control" id="surname" name="surname">
				</div>
				<div class="form-group">
					<label for="given-name">Given Name:</label>
					<input type="text" class="form-control" id="given-name" name="given-name">
				</div>
				<div class="form-group">
					<label for="address">Address:</label>
					<input type="text" class="form-control" id="address" name="address">
				</div>
				<div class="form-group">
					<label for="email">Email Address:</label>
					<input type="text" class="form-control" id="email" name="email">
				</div>
				<div class="form-group">
					<div class="input-group-btn" style="float:right; width:auto">
						<button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-save"></i> Save New Staff Member</button>
					</div>							
				</div>
			</div>
		</div>
			<div class="row">
				<div class="col-md-5">
						<?php require_once('staffXML_add.php'); ?>
				</div>
			</div>
		</div>
	</form>
	</body>
</html>