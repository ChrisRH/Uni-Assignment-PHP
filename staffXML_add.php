<?php

	/*
	staffXML_add.php adds a new staff member to the existing staff.xml file
	The newly added nodes are also formatted so they don't appear on one line
	*/
	   
	// Only process if user has hit the submit button
	if (!empty($_POST)) {
		// Get new staff values entered
		$newID = $_POST['staff-id'];
		$surname = $_POST['surname'];
		$givenname = $_POST['given-name'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$userMessage = "<h5>New staff member successfully added.  You can <a href='staff_view.php' target='_self'>View Staff</a> to check results.</h5>";
		$proceed = true;
		// Regular expressoin to check email address
		$pattern = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
		
		// Check email address is well formed
		if (preg_match($pattern, $email) === 1) {
			$proceed = true;
		}
		else
		{
			$userMessage = "<p style='color:#CA0505'>Input issue: Invalid email format. Please try again!</hp>"; 
			$proceed = false;
		}
		
		// Check if any fields have missing input
		if (empty($newID) || empty($surname) || empty($givenname) || empty($address) || empty($email)) {
			$userMessage = "<p style='color:#CA0505'>All fields must include a value - please resubmit details!</p>";
			$proceed = false;
		}
		
		// Only proceed if no issues
		if ($proceed == true) 
		{
			// Load existing xml file 
			$xmlfile = 'staff.xml';
			$xml = simplexml_load_file($xmlfile);
			
			// Build new elements and attributes as required. N.B. we use element attribute 'name' for display purposes only
			$newMember = $xml->addChild('member', '');
			// staff_id element
			$newID = $newMember->addChild('staff_id', $newID);
			$newID->addAttribute('name', 'Staff ID');
			$newID->addAttribute('email', $email);
			// surname element
			$newSurname = $newMember->addChild('surname', $surname);
			$newSurname->addAttribute('name', 'Surname');
			// givenname element
			$newGivenname = $newMember->addChild('givenname', $givenname);
			$newGivenname->addAttribute('name', 'Given Name');
			// address element
			$newAddress = $newMember->addChild('address', $address);
			$newAddress->addAttribute('name', 'Address');
			
			//Format XML before saving
			$dom = new DOMDocument('1.0');
			$dom->preserveWhiteSpace = false;
			$dom->formatOutput = true;
			$dom->loadXML($xml->asXML());
			//Save newly formatted XML to file
			$dom->save($xmlfile);
			
			// Alert user all good
			echo $userMessage;
		}
		else
		{
			// User input issues - alert user
			echo $userMessage;
		}
	}
?>