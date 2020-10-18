<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname ="digital_design";

$con = new PDO("mysql:host=$servername;dbname=$dbname;", $username, $password);
	
session_start();
?>