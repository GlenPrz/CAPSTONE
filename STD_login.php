<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BTS Driving school</title>
	<link rel="icon" type="image/x-icon" href="../img/favicon.ico">
	<link rel="stylesheet" href="index.css">
</head>
<style>
   .yes{
  width: 20%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 20px;
}.no {
  width: 20%;
  background-color: red;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 20px;
}
.yes:hover {
  background-color: #45a049;
}
.no:hover {
  background-color: #45a049;
}
</style>

<body>
  <div id="myModal_popUPQuestion" class="modal_popUPQuestion">

    <!-- Modal content -->
    <div class="modal-content_popUPQuestion">
      <div class="modal-body_popUPQuestion">
        <center>
          <img src=".\img\drive-download-20230614T125330Z-001\ques.png" alt="tdc Image"><br>
          <h2 class="Content_PopUpTxt">Do you already have a Student License permit </h2></center>
      </div>
      <div class="popUPQuestion_containerbtn">
        <center>
          <input type="hidden" value="<?php echo $_POST['username'] ?>" name="UserNameLog">
          <button class="yes" id="YesPopup" name="YesBtn" value="Yes" onclick="redirectToEnrollmentPDC()">YES</button>
          <button class="no" id="NoPopup" name="NoBtn" value="No" onclick="redirectToEnrollmentTDC()">NO</button>
        </center>
      </div>
    </div>
  </div>
</body>

<?php
session_start();
include "conn.php";
$username = $_POST['username'];
$_SESSION['username'] = $username;
$_SESSION["UsernameTDC"] = $username;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
if (empty($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}
  $YesBtn = isset($_POST['YesBtn']) ? $_POST['YesBtn'] : '';
  $NoBtn = isset($_POST['NoBtn']) ? $_POST['NoBtn'] : '';
  $username = $_POST['username'];
  $password = $_POST['password'];
  
  try {
    // Check if the user exists in the student table with the role of 'student'
    $stmt = $conn->prepare("SELECT * FROM student WHERE Username = :username AND Password = :password AND (Role = 'student' OR Role = 'admin' OR Role = 'DI')");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    $stmtStaff = $conn->prepare("SELECT * FROM u896821908_bts.admin WHERE Username = :usernameStaff AND Password = :passwordStaff AND (Role = 'admin' OR Role = 'Teller' OR Role = 'Sup_Admin')");
    $stmtStaff->bindParam(':usernameStaff', $username);
    $stmtStaff->bindParam(':passwordStaff', $password);
    $stmtStaff->execute();

    $stmtDi = $conn->prepare("SELECT * FROM u896821908_bts.di WHERE Username = :usernameStaff AND Password = :passwordStaff");
    $stmtDi->bindParam(':usernameStaff', $username);
    $stmtDi->bindParam(':passwordStaff', $password);
    $stmtDi->execute();

    if ($stmt->rowCount() > 0) {
      // User exists, set session variables based on the role and redirect to the respective home page
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $role = $row['Role'];
      
      $_SESSION['role'] = $role;
      
      if ($role === 'Student') {
        $studentStatus = $row['Enroll_Status'];
        if ($studentStatus === 'enrolled') {
          header("Location: ./Student/STD_HOME.php");
        } elseif($studentStatus === 'pending') {
          header("Location: ./WelcomePage(Pending).php");
        }else{
          if ($YesBtn === 'Yes') {
            echo "<script>console.log('Session Username:', '" . $_SESSION['username'] . "');</script>";
            header("Location: ./Enrollment_PDC.php");
        } elseif ($NoBtn === 'No') {
            echo "<script>console.log('Session Username:', '" . $_SESSION['username'] . "');</script>";
            header("Location: ./Enrollment_TDC.php");
        }else{
          echo "<script>
          function redirectToEnrollmentPDC() {
            window.location.href = './Enrollment_PDC.php';
          }
        
          function redirectToEnrollmentTDC() {
            window.location.href = './Enrollment_TDC.php';
          }
          var modalPOP = document.getElementById('myModal_popUPQuestion');
    modalPOP.style.display = 'block';
          </script>";
          echo "<script>console.log('Session Username:', '" . $username . "');</script>";

        }
      
        }
      }
      exit();
    }else if($stmtStaff->rowCount() > 0) {
      $rowStaff = $stmtStaff->fetch(PDO::FETCH_ASSOC);
      $roleStaff = $rowStaff['Role'];
      $adminId = $rowStaff['idadmin'];
       
      $_SESSION['username'] = $username;
      $_SESSION['role'] = $roleStaff;
      $_SESSION['Adminid'] = $adminId;

      if ($roleStaff === 'Admin') {
               header("Location: ./Admin/admin_dash.php");
      }elseif($roleStaff === 'Teller') {
               header("Location: ./Admin/admin_dash.php");
      }elseif($roleStaff === 'Sup_Admin') {
               header("Location: ./Admin/admin_dash.php");
      }elseif($roleStaff === 'DI') {
        header("Location: ./public_html/DrivingInstructor/DI_assess_welcome.php");
        echo "<script>
            window.location.href = './di_dashboard.php';
          </script>";
      }elseif(isset($roleStaff)) {
        echo "<script>
        var modalPOP = document.getElementById('myModal_popUPQuestion');
        modalPOP.style.display = 'none';
        </script>";
        echo "<script>alert('Invalid username or password. Please try again.');</script>";
        echo "<script>setTimeout('history.back();', 100);</script>";
      }
      exit(); 
      
    } else if($stmtDi->rowCount() > 0) {
      header("Location: ../DrivingInstructor/di_dashboard.php");
      $_SESSION['username'] = $username;
    }
    
    
    else{
        echo "<script>
        var modalPOP = document.getElementById('myModal_popUPQuestion');
        modalPOP.style.display = 'none';
        </script>";
        echo "<script>alert('Invalid Username or password. Please try again.');</script>";
        echo "<script>setTimeout('history.back();', 100);</script>";
    
  }
  } catch (PDOException $e) {
    echo "Error occurred: " . $e->getMessage();
  }

  // Close the database connection
  $conn = null;
}

?>
<script>
// window.onload = function() {
//     // Reload the page after it has finished loading
//     window.location.reload();
//   };

//     window.location.reload();

  function openModal() {
    var modalPOP = document.getElementById("myModal_popUPQuestion");
    modalPOP.style.display = "block";
  }

  // Close the modal
  function closeModal() {
    var modalPOP = document.getElementById("myModal_popUPQuestion");
    modalPOP.style.display = "none";
  }

  function redirectToEnrollmentPDC() {
    window.location.href = './Enrollment_PDC.php';
  }

  function redirectToEnrollmentTDC() {
    window.location.href = './Enrollment_TDC.php';
  }
</script>

</html>