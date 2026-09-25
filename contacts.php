<?php
$file = file_get_contents('http://www.ubsfueltrading.com/assets/php/xml/contact.xml');
$contacts = new SimpleXMLElement($file);

echo "<h2>Contact from Website</h2>";
echo "<table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<td bgcolor='#FF9933'>&nbsp;</td>";
echo "<td bgcolor='#FF9933'><b>Name</b></td>";
echo "<td bgcolor='#FF9933'><b>Email</b></td>";
echo "<td bgcolor='#FF9933'><b>Phone</b></td>";
echo "<td bgcolor='#FF9933'><b>Message</b></td>";
echo "<td bgcolor='#FF9933'><b>Date</b></td>";
echo "</tr>";

	
	foreach ($contacts->contact as $record) {
		echo "<tr>";
		echo "<td>" . $record->id . "</td>";
		echo "<td>" . $record->Name . "</td>";
		echo "<td>" . $record->Email . "</td>";
		echo "<td>" . $record->Phone . "</td>";
		echo "<td>" . $record->Message . "</td>";
		echo "<td>" . $record->Date . " (GMT)</td>";
		echo "</tr>";
	}
echo "</table>";
?>
