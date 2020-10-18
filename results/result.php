<?php
include 'config.php';
if(isset($_POST['Name']) && isset($_POST['IdNo']))
{
$name = $_POST["Name"];
$IdNo = $_POST["IdNo"];
}else die("Name and ID No Required");

function validate_input($IdNo, $name)
{
  global $con, $masterData;
  //---------------------------------- TOTAL REG ACC---------------------------------------------------
  $query = $con->prepare("SELECT * FROM `master_list` WHERE `IdNo` = $IdNo AND `Name` LIKE '%$name%' LIMIT 1");
  $query->execute();
  $sData = $query->fetch();

  if (is_null($sData['IdNo'])) {
    $masterData = array(
      'IdNo' => NULL,
      'RollNo' => NULL,
      'Name' => NULL,
      'Branch' => NULL,
      'LECTURE' => NULL,
      'TUTORIAL' => NULL,
      'LAB' => NULL,
      'Email_Address' => NULL,
    );
    return 0;
  } else {
    $masterData = array(
      'IdNo' => $sData['IdNo'],
      'RollNo' => $sData['RollNo'],
      'Name' => $sData['Name'],
      'Branch' => $sData['Subject'],
      'LECTURE' => $sData['LECTURE'],
      'TUTORIAL' => $sData['TUTORIAL'],
      'LAB' => $sData['LAB'],
      'Email_Address' => $sData['Email_Address'],
    );
    return $sData['IdNo'];
  }
}

function get_marks($IdNo)
{
  global $con, $sData;
  //---------------------------------- T1 Marks---------------------------------------------------
  $query = $con->prepare("SELECT `IdNo`,`Score` FROM `test_t1` WHERE `IdNo` = $IdNo LIMIT 1");
  $query->execute();
  $t1Data = $query->fetch();
  //---------------------------------- T2 Marks---------------------------------------------------
  $query = $con->prepare("SELECT `IdNo`,`Score` FROM `test_t2` WHERE `IdNo` = $IdNo LIMIT 1");
  $query->execute();
  $t2Data = $query->fetch();
  //---------------------------------- LAB Marks---------------------------------------------------
  $query = $con->prepare("SELECT * FROM `dd_lab` WHERE `IdNo` = $IdNo LIMIT 1");
  $query->execute();
  $labData = $query->fetch();

  $sData = array(
    'IdNo' => $IdNo,
    't1_score' => $t1Data['Score'],
    't2_score' => $t2Data['Score'],
    'lab_exp1' => $labData['EXP-1'],
    'lab_exp2' => $labData['EXP-1'],
    'lab_exp3' => $labData['EXP-1'],
    'lab_exp4' => $labData['EXP-1'],
    'lab_exp5' => $labData['EXP-1'],
    'lab_exp6' => $labData['EXP-1'],
  );
}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>BITS Pilani Hyderbad Campus - Digital Design Results</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="./style_result.css">

</head>
<body>
<br>
<h1 style="text-align:center;color:brown"> DIGITAL DESIGN <br><br> CS F215 /ECE F215 /EEE F215 /INSTR F215</h1>  
<!-- partial:index.partial.html -->
<?php
$id = validate_input($IdNo, $name);
if(!$id) die('<h2 style="text-align:center;color:red">!!! IdNo and Name combination incorrect, please re-check and try again !!! <a href="index.php">Click to Retry</a></h2>');
get_marks($id);
echo '
<div class="wrapper">
  
  <div class="table">
    
    <div class="row header">
      <div class="cell">
        Student Details
      </div>
      <div class="cell">
        
      </div>
      <div class="cell">
        
      </div>
      <div class="cell">
        
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        Name
      </div>
      <div class="cell">
       ' . $masterData['Name'] . '
      </div>
      <div class="cell">
        Tutorial
      </div>
      <div class="cell">
      ' . $masterData['TUTORIAL'] . '
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        Id No
      </div>
      <div class="cell">
      ' . $masterData['IdNo'] . '
      </div>
      <div class="cell">
        Lecture
      </div>
      <div class="cell">
      ' . $masterData['LECTURE'] . '
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        Roll No
      </div>
      <div class="cell">
      ' . $masterData['RollNo'] . '
      </div>
      <div class="cell">
        Lab
      </div>
      <div class="cell">
      ' . $masterData['LAB'] . '
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        Email Address
      </div>
      <div class="cell">
      ' . $masterData['Email_Address'] . '
      </div>
      <div class="cell">
        Branch
      </div>
      <div class="cell">
      ' . $masterData['Branch'] . '
      </div>
    </div>
    
  </div>
  
  <div class="table">
    
    <div class="row header green">
      <div class="cell">
        Theory Exams
      </div>
      <div class="cell">
        Max Marks
      </div>
      <div class="cell">
        Marks Obtained
      </div>
      <div class="cell">
        Class Average
      </div>
      
    </div>
    
    <div class="row">
      <div class="cell">
        T1
      </div>
      <div class="cell">
        30
      </div>
      <div class="cell">
      ' . $sData['t1_score']*1.5 . '
      </div>
      <div class="cell">
        26.06
      </div>
    </div>
    
    <div class="row">
      <div class="cell" data-title="Product">
        T2
      </div>
      <div class="cell" data-title="Unit Price">
        30
      </div>
      <div class="cell" data-title="Quantity">
      ' . $sData['t2_score']*1.5 . '
      </div>
      <div class="cell" data-title="Date Sold">
        21.69
      </div>
    </div>
    
    
  </div>
  
  <div class="table">
    
    <div class="row header blue">
      <div class="cell">
        Lab Marks
      </div>
      <div class="cell">
        &nbsp;
      </div>
      <div class="cell">
        &nbsp;
      </div>
      <div class="cell">
        &nbsp;
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        EXP 1
      </div>
      <div class="cell">
        ' . $sData['lab_exp1'] . '
      </div>
      <div class="cell">
        EXP 2
      </div>
      <div class="cell">
        ' . $sData['lab_exp2'] . '
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        EXP 3
      </div>
      <div class="cell">
        ' . $sData['lab_exp3'] . '
      </div>
      <div class="cell">
        EXP 4
      </div>
      <div class="cell">
        ' . $sData['lab_exp4'] . '
      </div>
    </div>
    
    <div class="row">
      <div class="cell">
        EXP 5
      </div>
      <div class="cell">
        ' . $sData['lab_exp5'] . '
      </div>
      <div class="cell">
        EXP 6
      </div>
      <div class="cell">
        ' . $sData['lab_exp6'] . '
      </div>
    </div>
    
    
    
  </div>
  
</div>';
?>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>
</html>
