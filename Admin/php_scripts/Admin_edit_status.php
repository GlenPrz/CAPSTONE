<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
    include "../conn.php";
    $userdataCstatus = $_GET['CStatus'] ?? '';

    $queryEnrollStatus = "SELECT Enroll_Status FROM u896821908_bts.student WHERE Username = :Username";
    $stmtEnrollStatus = $conn->prepare($queryEnrollStatus);
    $stmtEnrollStatus->bindParam(':Username', $userdataCstatus);
    $stmtEnrollStatus->execute();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if (isset($_POST["Confirm_Cstatus"]) && !empty($_POST["Confirm_Cstatus"])) {
            try {
              $enrollStatus = $_POST['enroll-status'];
              $queryUpdateEnrollStatus = "UPDATE u896821908_bts.student SET Enroll_Status = :EnrollStatus WHERE Username = :Username";
              $stmtUpdateEnrollStatus = $conn->prepare($queryUpdateEnrollStatus);
              $stmtUpdateEnrollStatus->bindParam(':EnrollStatus', $enrollStatus);
              $stmtUpdateEnrollStatus->bindParam(':Username', $userdataCstatus);
              $stmtUpdateEnrollStatus->execute();

            // After successful Cstatusetion, you may return some response to the AJAX request (e.g., "User Cstatuseted successfully")
            $isUserCstatuseted = true;
            if ($isUserCstatuseted) {
                echo "<script>
                    var currentURL = new URL(window.location.href);
                    currentURL.searchParams.delete('CStatus');
                    window.history.replaceState({}, document.title, currentURL.href);
                    window.location.reload();
                    </script>";
            }
        } catch (PDOException $e) {
            echo "Error Cstatuseting user: " . $e->getMessage();
        }
    } 

}
?>

<style>
/* The modal_Cstatus (background) */
.modal_Cstatus {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* modal_Cstatus Content */
.modal_Cstatus-content {
  position: relative;
  background-color: whitesmoke;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  color:white;
  width: 25%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close_Cstatus {
  color: black;
  float: right;
  font-size: 28px;
  font-weight: bold;
  margin-right: 5px;
}

.close_Cstatus:hover,
.close_Cstatus:focus {
  color: red;
  text-decoration: none;
  cursor: pointer;
}

.modal_Cstatus-header {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

.modal_Cstatus-body {padding: 2px 16px;}

.modal_Cstatus-footer {
  padding: 2px 16px;
  background-color: green;
  color: white;
}
.modal_Cstatus-content h3{
  border-bottom: 2px solid black;
  padding:10px;
  color: black;
}
.modal_Cstatus-content h4{
  padding-right:2px;
  padding-left:2px;
  padding-top:10px;
  padding-bottom:10px;
}
.modal_Cstatus-content p{
  padding-right:2px;
  padding-left:10px;
  padding-top:10px;
  padding-bottom:10px;
  color: black;
}
.modal_Cstatus-content h4,p{
  display:inline-block;
  color: black;
}
.button_container{
  display:flex;
  justify-content: flex-end;
}
.button_container .Confirm_Submit{
  display:inline-block;
  padding:8px;
  border-radius:5px;
  margin: 4px 5px 10px 0;
  background-color: green;
}
.button_container .Reset_Submit{
  display:inline-block;
  padding:8px;
  border-radius:5px;
  margin: 4px 10px 10px 0;
  background-color: red;
}.enroll-status{
   margin-top: 1%;
   margin-left: 2%;
    width: 30%;
    padding: 10px;
    font-size: 16px;
    background-color: #d9d9d9;
    display: inline-block;
}
</style>
<body>
<div id="modal_Cstatus" class="modal_Cstatus">
        <!-- modal_Cstatus content -->
        <div class="modal_Cstatus-content">
        <form action="#" method="post">
            <span class="close_Cstatus">&times;</span>
            <h3>Change User Status </h3>
            <hr>
            <p>This will Changing Status User: </p><h4><?php echo $userdataCstatus; ?></h4><br>
              <?php
                if ($rowEnrollStatus = $stmtEnrollStatus->fetch(PDO::FETCH_ASSOC)) {
                  $enrollStatus = $rowEnrollStatus['Enroll_Status'];
                  echo '<select class="enroll-status" name="enroll-status" data-id="' . $rowEnrollStatus['Enroll_Status'] . '">';
                  echo '<option value="pending"' . ($enrollStatus === 'pending' ? ' selected' : '') . '>Pending</option>';
                  echo '<option value="enrolled"' . ($enrollStatus === 'enrolled' ? ' selected' : '') . '>Enrolled</option>';
                  echo '<option value=""' . ($enrollStatus === 'Not enrolled' ? ' selected' : '') . '>Not Enrolled</option>';
                  echo '</select>';
                }
              ?>

            <div class ="button_container">
            <input type="hidden" value="<?php echo $userdataCstatus;?>">
            <input type = "Submit" name = "Confirm_Cstatus" value="Confirm" class = "Confirm_Submit"></input>
            <input type="reset" value="Cancel" id="cancelButtonChangeStatus" class = "Reset_Submit"></input>
            </div>
        </form>
        </div>
    </div>
</body>
<script>
var modal_Cstatus = document.getElementById('modal_Cstatus');
var btnCstatus = document.getElementById('btn_Cstatus');
var span_Cstatus = document.getElementsByClassName('close_Cstatus')[0];

$(document).ready(function() {
  // Bind a click event to the Cancel button
  $("#cancelButtonChangeStatus").click(function() {
    var currentURL = new URL(window.location.href);
    currentURL.searchParams.delete('CStatus');
    window.history.replaceState({}, document.title, currentURL.href);
    window.location.reload();
  });
});

</script>

</html>