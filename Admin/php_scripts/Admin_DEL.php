<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
    include "../conn.php";
    $userdatadel = $_GET['DelUsername'] ?? '';
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if (isset($_POST["Confirm_Del"]) && !empty($_POST["Confirm_Del"])) {
            try {
            // Prepare the SQL statements
            $stmt_student = $conn->prepare("DELETE FROM u896821908_bts.student WHERE username = :username");
            $stmt_student_enrolled = $conn->prepare("DELETE FROM u896821908_bts.student_enrolled WHERE username = :username");
            $stmt_student_payment = $conn->prepare("DELETE FROM u896821908_bts.student_payment WHERE username = :username");

            // Bind parameters and execute the statements
             $stmt_student->bindParam(':username', $userdatadel);
             $stmt_student_enrolled->bindParam(':username', $userdatadel);
             $stmt_student_payment->bindParam(':username', $userdatadel);

             $stmt_student->execute();
             $stmt_student_enrolled->execute();
             $stmt_student_payment->execute();

            // After successful deletion, you may return some response to the AJAX request (e.g., "User deleted successfully")
            $isUserDeleted = true;
            if ($isUserDeleted) {
                echo "<script>
                    var currentURL = new URL(window.location.href);
                    currentURL.searchParams.delete('DelUsername');
                    window.history.replaceState({}, document.title, currentURL.href);
                    window.location.reload();
                    </script>";
            }
        } catch (PDOException $e) {
            echo "Error deleting user: " . $e->getMessage();
        }
    } 

}
?>

<style>
/* The modal_Del (background) */
.modal_Del {
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

/* modal_Del Content */
.modal_Del-content {
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
.close_del {
  color: black;
  float: right;
  font-size: 28px;
  font-weight: bold;
  margin-right: 5px;
}

.close_del:hover,
.close_del:focus {
  color: red;
  text-decoration: none;
  cursor: pointer;
}

.modal_Del-header {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

.modal_Del-body {padding: 2px 16px;}

.modal_Del-footer {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}
.modal_Del-content h3{
  border-bottom: 2px solid black;
  padding:10px;
  color: red;
}
.modal_Del-content h4{
  padding-right:2px;
  padding-left:2px;
  padding-top:10px;
  padding-bottom:10px;
}
.modal_Del-content p{
  padding-right:2px;
  padding-left:10px;
  padding-top:10px;
  padding-bottom:10px;
}
.modal_Del-content h4,p{
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
}
</style>
<body>
<div id="modal_Del_Del" class="modal_Del">
        <!-- modal_Del content -->
        <div class="modal_Del-content">
        <form action="#" method="post">
            <span class="close_del">&times;</span>
            <h3>DELETING USER? </h3>
            <hr>
            <p>This will delete </p><h4><?php echo $userdatadel; ?></h4>
            <div class ="button_container">
            <input type="hidden" value="<?php echo $userdatadel;?>">
            <input type = "Submit" name = "Confirm_Del" value="Confirm" class = "Confirm_Submit"></input>
            <input type="reset" value="Cancel" id="cancelButton" class = "Reset_Submit"></input>
            </div>
        </form>
        </div>
    </div>
</body>
<script>
var modal_Del_Del = document.getElementById('modal_Del');
var btndel = document.getElementById('btn_del');
var span_del = document.getElementsByClassName('close_del')[0];

$(document).ready(function() {
  // Bind a click event to the Cancel button
  $("#cancelButton").click(function() {
    var currentURL = new URL(window.location.href);
    currentURL.searchParams.delete('DelUsername');
    window.history.replaceState({}, document.title, currentURL.href);
    window.location.reload();
  });
});

</script>

</html>