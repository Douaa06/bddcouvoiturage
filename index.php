<?php 
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

 $host='localhost';
 $user='root';
 $pass='';
 $db='couvoiturage';
 $conn = new mysqli($host, $user, $pass, $db);
 if ($conn->connect_error)  die('Error : ('.mysqli_connect_errno().')'.mysqli_connect_error());

