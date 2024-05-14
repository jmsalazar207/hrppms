<?php
	 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	
	include 'conn.php';

	if(!isset($_SESSION['user_id']) || trim($_SESSION['user_id']) == ''){
		header('location: index.php');
	}

	$sql = "SELECT * FROM pds_personal_information WHERE empno = '".$_SESSION['user_id']."'";
	$query = $conn->query($sql);
	$user = $query->fetch_assoc();

	$count_sql = "SELECT COUNT(updated) AS total FROM userprofile WHERE updated = '0'";
	$count_query = $conn->query($count_sql);
	$total = $count_query->fetch_assoc();
	
?>