<?php

ini_set('display_errors',1); // enable php error display for easy trouble shooting
error_reporting(E_ALL); // set error display to all

include "conn.php";
   
if (ISSET($_POST['user'])) {

    $ref = $_POST['user'];
    $query = $conn->query("SELECT *FROM pds_personal_information WHERE empno = '$ref' LIMIT 1");
    $row = $query->fetch_assoc();

    $fname = $row['firstname'];
    $mname = $row['middlename'];
    $sname = $row['surname'];

   
    
    //$json = array('fname' => $fname);
    $json = array('firstname' => $fname, 'middlename' => $mname, 'surname'=> $sname);
    echo json_encode($json);
}


?>