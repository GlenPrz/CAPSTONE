<?php
session_start();

unset($_SESSION['Discount']);

include("Navbar_login.html");
include("conn.php");

try {
  $username = $_SESSION['UsernameTDC'] ?? '';
  $username = $_SESSION['UsernameTDC'] ?? '';  
  

$stmtSTD_ID = $conn->prepare("SELECT idStudent FROM u896821908_bts.student WHERE Username = :username");
$stmtSTD_ID->bindParam(':username', $username, PDO::PARAM_STR);
$stmtSTD_ID->execute();

$result = $stmtSTD_ID->fetch(PDO::FETCH_ASSOC);
if ($result) {
  $idStudent = $result['idStudent'];
  // echo "Student ID: " . $idStudent;
} else {
  // echo "No student found with the given username.";
}
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>BTS Driving school</title>
	<link rel="icon" type="image/x-icon" href="../img/favicon.ico">
	<link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="./modalsStyle/modal_signup.css?version=1" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./design/general/index.css">
  <link rel="stylesheet" href="./design/general/navbar.css">
</head>
<style>
  .Welcome_Container{
    float: left;
    display: inline-block;
    width: 40%;
    text-align: center;
    font-size: 32px;
    margin-left: 1%;
    margin-top: 10%;
    background-color: white;
    color: #0E8341;
    font-family: 'Inter', sans-serif;
  }
  .Welcome_Container h1{
    float: left;
    display: inline-block;
    text-align: center;
    width: 70%;
    font-size: 25px;
    margin-left: 5%;
    margin-top: 10%;
    background-color: white;
    color: black;
    font-family: 'Inter', sans-serif;
    font-weight: 300;
  }.image img {
    float: right;
        width: 40%;
        height: 35%;
        margin-top: 10%;
        margin-right: 5%;

    }
    .Welcome_Container button{
       float: left; 
       margin-left:40%;
    }
    .buttonTDC{
        margin-left:50%;
        margin-right:;
    }
</style>
<body>
  <div class="Welcome_Container">
    <h2>Welcome To Best
      Training School! <br>
      Where the best
      drivers are trained</h2>
<button id='reschedbtn' name='resched' class="buttonTDC" onclick="redirectToReschedule('<?php echo $idStudent; ?>')">RESCHEDULE</button>
      <h1>Student ID: <?php echo $idStudent?></h1>
    
      <h1>Your Application is on Process 
    please wait for an Email or kindly 
  check your spam folder once the 
administrator approved your enrollment

</h1>

  </div>
    
    <div class="image"><img src="img/drive-download-20230614T125330Z-001/LOGIN PAGE.png"><br>

</div>
    
    <script>
    function redirectToReschedule(id) {
            // Assuming you want to redirect to a page named reschedule.php
            window.location.href = 'Student/reschedule.php?id=' + id;
        }
    </script>
</body>
</html>