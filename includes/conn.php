<?php
	$conn = new mysqli('localhost', 'root', '', 'dtr');
	//$conn = new mysqli('172.31.32.22', 'aics_staging', 'P@ssw0rd1.', 'dtr');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>