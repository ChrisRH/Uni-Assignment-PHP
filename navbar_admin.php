
<nav class="navbar navbar-default">
  <div class="container-fluid">
	<div class="navbar-header">
	  <a class="navbar-brand" href="home.php">Highport Staff Portal</a>
	</div>
	<ul class="nav navbar-nav">
	  <li class="home"><a href="home.php">Home</a></li>
	  <li class="staff_view"><a href="staff_view.php">View Staff</a></li>
	  <li class="staff_search"><a href="staff_search.php">Search Staff</a></li>
	  <li class="staff_add"><a href="staff_add.php">Add Staff</a></li>
	  <li class="user_add"><a href="user_add.php">Add User</a></li>
	  <li class="user_delete"><a href="user_delete.php">Delete User</a></li>
	  <li class="user_view"><a href="user_view.php">Veiw Users</a></li>
	</ul>
	<ul class="nav navbar-nav navbar-right">
	  <li><a href="clear_all.php"><span class="user-logged"><?php echo "Welcome  ". $_SESSION["user_name"]. "   "; ?></span> <span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
	</ul>
  </div>
</nav>