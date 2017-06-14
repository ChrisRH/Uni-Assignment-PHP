<?php

// Set oracle user login and password info
$dbuser = "test";
$dbpass = "test123";
$db = "SSID";
$connect = OCILogon($dbuser, $dbpass, $db);
if (!$connect) {
	echo "<p style='color:#CA0505'>An error occurred connecting to the database</p>";
	exit;
}

// Display all existing users
$query = "SELECT * FROM userlogin ORDER BY id";
$stmt = OCIParse($connect, $query);
if(!$stmt) {
	echo "<p style='color:#CA0505'>Sorry: an error occurred in parsing the sql string.</p>";
	exit;
}

OCIExecute($stmt);

echo "<table class='table'>";
echo "<thead>";
echo "<tr> <th> ID </th> <th> Username </th> <th> Password</th> <th> Role </th></tr>";
echo "</thead>";
while(OCIFetch($stmt)) {
	$id=OCIResult($stmt,1);
	echo "<tr>";
	echo "<td>";
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