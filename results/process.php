<?php

try{

$conn = new PDO("mysql:host=localhost;dbname=exam",'root','');

$regno=$_POST['regno'];
$result= $conn->query("select * from sub where regno='$regno'");
$result->setFetchMode(PDO::FETCH_ASSOC);
while($row=$result->fetch()){


	echo $row['regno']."<br>";
	echo $row['name']."<br>";
	echo $row['php']."<br>";
	echo $row['java']."<br>";
	echo $row['python']."<br>";
}

}catch(PDOException $e){

	echo "Error:".$e->getMessage();
}




?>