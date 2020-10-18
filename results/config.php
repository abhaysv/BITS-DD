<?php

$servername = "localhost";
$username = "dumbledore";
$password = "qwzxcvbnqq";
$dbname ="wg";

$con = new PDO("mysql:host=$servername;dbname=$dbname;", $username, $password);
	
session_start();
?>