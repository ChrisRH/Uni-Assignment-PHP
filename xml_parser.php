<?php
	// xml_parser.php will load staff.xml file and format into html table
	// Code adopted from SimpleXML www.w3schools.com

	$xml = simplexml_load_file("staff.xml")
	or die("Error: XML document cannot be loaded!");

	// Put all xml elements present in an array
	$element_name = array();
	foreach ($xml->children()->children() as $value) {
		// Gets all the elements present
		$element_name[] = $value->getName();
		// We use the attribute 'name' for column display headings
		$element_attributes[] = $value->attributes();
	}

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

	// Display each staff row
	foreach ($xml->children() as $value) { 
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

	echo "</tbody>";
	echo "</table>";
?>