<?php
$proceed = true;
$errorMessage = "";
$savedSuccess = false;
// Set oracle user login and password info
$dbuser = "test";
$dbpass = "test123";
$db = "SSID";
$connect = OCILogon($dbuser, $dbpass, $db);
if (!$connect) {
echo "<p style='color:#CA0505'>An error occurred connecting to the database</p>";
exit;
}

// Process user input only if submit button pressed
if (!empty($_POST)) {
	// Get user input from the form
	$id = $_REQUEST['user-id']; //get id information
	$username = $_REQUEST['user-name']; //get username information
	$password = $_REQUEST['user-password']; //get password information
	$role = $_REQUEST['user-role']; //get role information
	
	// Check all fields have a value
	if (empty($id) || empty($username) || empty($password) || empty($role )) {
			$errorMessage = "<p style='color:#CA0505'>Sorry: all fields must include a value - please resubmit details!</p>";
			$proceed = false;
	}
	
	// Check ID supplied is an integer value
	if ($proceed == true)
	{
		// Using regular expression to validate user input
		if( ! preg_match('/^\d+$/', $id) ){
			$errorMessage = "<p style='color:#CA0505'>Sorry: user ID must be an integer value - please try again!</p>";
			$proceed = false;
		}
	}
	
	// Check if input contains non-alphanumeric values only
	if ($proceed == true)
	{
		// Combing all input into one string to check once
		$allInput = $id . $username . $password . $role;
		// Check combined string
		if (!ctype_alnum($allInput))
		{
			// Invalid character/s detected
			$errorMessage = "<p style='color:#CA0505'>Sorry: your input contains some invalid characters - please resubmit details!</p>";
			$proceed = false;
		}
	}
	
	// Proceed if all input exists
	if (proceed == true)
	{
		// check if the ID value exists, if yes, show error message, otherwise insert 
		// build sql statement 
		$query = "SELECT id FROM userlogin";

		// check the sql statement for errors and if errors report them 
		$stmt = OCIParse($connect, $query);
		if(!$stmt) {
			$errorMessage = "<p style='color:#CA0505'>Sorry: an error occurred in parsing the sql string.</p>";
			$proceed = false;
		}
	}
	
	// Proceed if query OK
	if (proceed == true)
	{
		OCIExecute($stmt);

		$exist=false; //indicate whether the form ID already exists
		while(OCIFetch($stmt))
		{
			if(OCIResult($stmt,'ID') == $id)
				$exist = true;
		}

		if($exist)
		{
			$errorMessage = "<p style='color:#CA0505'>Sorry: the ID you supplied already exists.  Please try again.</p>";
			$proceed = false;
		}
		else
		{
			$id = intval($id); //convert the string ID into integer ID

			// build sql statement
			$query = "INSERT INTO userlogin VALUES($id, '$username', '$password', '$role')";

			// check the sql statement for errors and if errors report them
			$stmt = OCIParse($connect, $query);
			if(!$stmt) {
				$errorMessage = "<p style='color:#CA0505'>Sorry: an error occurred in parsing the sql string.</p>";
				$proceed = false;
			}
			if ($proceed == true) 
			{
				OCIExecute($stmt);
				$savedSuccess = true;
			}
		}
	}
}

// Display all existing first including if any new entries from above
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

// Check what, if any, alerts to show user
if ($proceed == false) 
{
	// Alert user of error
	echo $errorMessage;
}
else if ($savedSuccess == true)
{
	// Alert user of success
	echo "<p style='color:#CA0505'>Success! New user added</p>";
}

//close the database connection
OCILogoff($connect);

?>