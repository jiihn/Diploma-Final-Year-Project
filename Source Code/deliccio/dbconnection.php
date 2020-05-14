<?php
if(!isset($_SESSION)) 
{ 
	session_start(); 
} 


$host = "localhost";
$user = "root";
$password = "12345";
$database = "exampledb";

$conn = mysqli_connect($host, $user, $password, $database);

?>
