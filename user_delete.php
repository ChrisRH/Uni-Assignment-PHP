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
		<title>User Delete</title>
    </head>
    <body class="user_delete">
	
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
	<form action="user_delete.php" method="post">
		<div class="row">
			<div class="col-md-5">
				<div>
					<h3>Delete a User</h3>
					<h4>Select a user to delete</hr>
				</div>
				<div>
					<?php require_once('user_delete_code.php'); ?>
				</div>
				<div class="form-group">
					<div class="input-group-btn" style="float:right; width:auto">
						<button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-erase"></i> Delete Selected User</button>
					</div>	
					<div>
						<p>Records are permanently erased!</p>
					</div>
				</div>
			</div>
			<div class="col-md-5">

			</div>
		</div>
			<div class="row">
				<div class="">

				</div>
			</div>
		</div>
	</form>
	</body>
</html>