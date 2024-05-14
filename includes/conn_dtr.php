<?php
	$conn1 = new mysqli('localhost', 'root', '', 'dtr');

	if ($conn1->connect_error) {
	    die("Connection failed: " . $conn1->connect_error);
	}
	
?>