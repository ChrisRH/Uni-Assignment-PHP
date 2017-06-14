<?php

	/*
	search_xml_parser.php will display all records found that contain query results for surname or given names
	It is optimised to return results that contain that search query and is not case sensitive
	*/

	// Only process search if user has hit the submit button
	if (!empty($_POST)) {
		// Get search value entered
		$search_value = $_POST['srch-term'];
		// Only proceed if entered value is not empty
		if ($search_value != "")
		{
			// Load xml file
			$xml = simplexml_load_file("staff.xml") or die("Error: XML document cannot be loaded!");
			
			// Put all xml elements present in an array
			$element_name = array();
			foreach ($xml->children()->children() as $value) {
				// Gets all the elements present
				$element_name[] = $value->getName();
				// We use the attribute 'name' for column display headings
				$element_attributes[] = $value->attributes();
			}
			
			// Enable case insensitive search via xpath
			$upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
			$lower = "abcdefghijklmnopqrstuvwxyz123456789";
			// Set search values for xpath to use
			$arg_givenname = "translate(givenname, '$upper', '$lower')";
			$arg_surname = "translate(surname, '$upper', '$lower')";
			$arg_query    = "translate('$search_value', '$upper', '$lower')";
			
			// Search match can be surname or given name
			$staff = $xml->xpath("/staff/member[contains($arg_givenname, $arg_query) or contains($arg_surname, $arg_query)]");
			//Display each record found
			$count = 0;
			foreach($staff as $person) {
				// Build search results only once 
				if ($count == 0)
				{
					echo "<table class='table'>";
					echo "<thead>";
					echo "<tr>";
					// Display the column headings
					foreach ($element_attributes as $value) {
						echo "<th>{$value}</th>";
					}
					echo "<th>Email Address</th>";
					echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
					// Now display the complete staff record
					foreach ($staff as $value) { 
						echo "<tr>";  
						
						for ($i = 0; $i < count($element_name); $i++) {
							if ($i == 3)
							{
								// Address field - enable google maps link
								$address = $value->children()->$element_name[$i];
								$addressLink = "https://maps.google.com/?q=" . $address;
								echo "<td><a href='{$addressLink}' target='_blank'>{$address}</a></td>";
							}
							else
							{
								// Normal output without map link
								echo "<td>{$value->children()->$element_name[$i]}</td>";
							}
						}
						// Find email element and format as clickable
						echo "<td><a href='mailto:{$value->staff_id['email']}'>{$value->staff_id['email']}</a></td>";
						echo "</tr>";
					}
				}
				// Increment counter
				$count = ++$count;
			}
			// Insert table end tags if opening tags exist
			if ($count > 0)
			{
				echo "</tbody>";
				echo "</table>";
			}
			
			// If no results found alert user
			if ($count <= 0)
			{
				echo "<p>Sorry, no results found for search query \"{$search_value}\". Please try again.";
			}
		}
		else
		{
			// User hit submit button without entering a value
			echo "<p>Please enter a search value and try again...</p>";	
		}
	}
?>