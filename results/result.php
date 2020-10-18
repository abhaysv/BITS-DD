<head> <link rel="stylesheet" type="text/css" href="style.css"> <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<title>Your Result</title></head>
<body>
  <center>
    <div class="txt">Entrance Result Fall 2019 </div>
    <div class="content">
      <div class="content3" style="height: 45%">
        <div class="max">Your Entrance Result.</div>

        <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "result";
$roll = $_POST["roll"];
$class = $_POST["class"] ;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT name, roll, class, language , math, physics, remarks, chemistry  GPA FROM result WHERE roll = $roll AND class = $class LIMIT 1 " ;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<div class="list"> FULL NAME: ' . $row["name"]. '</div>
        <div class="list">ROLL: ' . $row["roll"]. '</div>
        <div class="list">CLASS: ' . $row["class"]. '</div>
        <div class="list">LANGUAGE: ' . $row["language"]. '</div>
         <div class="list">MATH: ' . $row["math"]. '</div>
         <div class="list">PHYSICS: ' . $row["physics"]. '</div>
         <div class="list">REMARKS: ' . $row["remarks"]. '</div>'
         

          ;
    }
} else {
    echo '<center><font size="3" color="red"> Sorry No Record Found</font></center>';
}

$conn->close();
?>




</div></div></center></body>