<?php

// Set oracle user login and password info
$dbuser = "test";
$dbpass = "test123";
$db = "SSID";
$connect = OCILogon($dbuser, $dbpass, $db);
if (!$connect) 
{
	echo "<p style='color:#CA0505'>An error occurred connecting to the database</p>";
	exit;
}

// Process user input only if submit button pressed
if (!empty($_POST)) {
	// Get user input from the form
	$id = $_REQUEST['delete']; //get id information
	
	// For this system we prevent deletion of test user accounts
	if (($id != "1") && ($id != "2"))
	{
		// OK to delete the selected user from database
		$query = "delete from userlogin where id=$delete";
		$stmt_del = OCIParse($connect, $query);
		if(!$stmt_del) {
			echo "<p>An error occurred in parsing the sql string.</p>";
			exit;
		}
		OCIExecute($stmt_del);
		// Alert user of success
		echo "<p style='color:#CA0505'>Success! Selected user was deleted</p>";
	}
	else
	{
		// Selected user is a test account - we don't delete it
		echo "<p style='color:#CA0505'>Sorry: selected user is a test account - it cannot be deleted</p>";
	}
}

// Get all users to display in html table format
$query = "SELECT * FROM userlogin ORDER BY id";

// check the sql statement for errors and if errors report them 
$stmt = OCIParse($connect, $query);

if(!$stmt) {
	echo "An error occurred in parsing the sql string.\n";
	exit;
}
OCIExecute($stmt);
echo "<table class='table'>";
echo "<thead>";
echo "<tr> <th width='50'> </th> <th> ID </th> <th> Username </th> <th> Password</th> <th>Role</th></tr>";
echo "</thead>";
while(OCIFetch($stmt)) {
	$id=OCIResult($stmt,1);
	echo "<tr>";
	echo "<td width='50'>";
	echo "<input type='radio' name='delete' value='$id'>";
	echo "</td><td>";
	echo "$id";
	echo "</td><td>";
	echo OCIResult($stmt,2);
	echo "</td><td>";
	echo OCIResult($stmt,3);
	echo "</td><td>";
	echo OCIResult($stmt,4);
	echo "</td></tr>";
}
echo "</table>";

//close the database connection
OCILogoff($connect);

?>