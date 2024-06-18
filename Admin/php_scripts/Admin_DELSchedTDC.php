<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
    include "../conn.php";
    $userdatadel = $_GET['DELTDCID'] ?? '';

    $stmt_Sched = $conn->prepare("SELECT * FROM u896821908_bts.tdc_schedule WHERE TDC_SchedID = :DELID");
    $stmt_Sched->bindParam(':DELID', $userdatadel);
    $stmt_Sched->execute();
    $schedules = $stmt_Sched->fetchAll(PDO::FETCH_ASSOC);
    
  
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if (isset($_POST["Confirm_DelTDC"]) && !empty($_POST["Confirm_DelTDC"])) {
            try {
            // Prepare the SQL statements
            $stmt_student = $conn->prepare("DELETE FROM u896821908_bts.tdc_schedule WHERE TDC_SchedID = :DELID");
           
            // Bind parameters and execute the statements
             $stmt_student->bindParam(':DELID', $userdatadel);
             

             $stmt_student->execute();

            if (true) {
                  echo "<script>
                var currentURL = new URL(window.location.href);
                currentURL.searchParams.delete('DELTDCID');
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
  background-color: white;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  color:black;
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
.close_delTDC {
  color: black;
  float: right;
  font-size: 28px;
  font-weight: bold;
  margin-right: 5px;
}

.close_delTDC:hover,
.close_delTDC:focus {
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
<div id="modal_Del_DelTDC" class="modal_Del">
        <!-- modal_Del content -->
        <div class="modal_Del-content">
        <form action="#" method="post">
            <span class="close_delTDC">&times;</span>
            <h3>DELETING USER? </h3>
            <hr>
            <p>This will delete </p>
            <br>
            <?php 
            if (!empty($schedules)) {
              $SchedDate = $schedules[0]['schedule1'];
              $SchedDate1 = $schedules[0]['schedule2'];

              $SchedTime1 = $schedules[0]['time1'];
              $SchedTime2 = $schedules[0]['time2'];
          
              // Rest of your code here...
              ?>
              <h4><?php echo $SchedDate; ?></h4>
              <h4><?php echo $SchedDate1; ?></h4>
              <h4><?php echo $SchedTime1; ?></h4>
              <h4><?php echo $SchedTime2; ?></h4>
              <?php
            }
            ?>
            <div class ="button_container">
            <input type="hidden" value="<?php echo $userdatadel;?>">
            <input type = "Submit" name = "Confirm_DelTDC" value="Confirm" class = "Confirm_Submit"></input>
            <input type="reset" value="Cancel" id="cancelButtonTDC" class = "Reset_Submit"></input>
            </div>
        </form>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>





var modal_Del_DelTDC = document.getElementById('modal_Del');
var btndel = document.getElementById('btn_del');
var span_delTDC = document.getElementsByClassName('close_delTDC')[0];

$(document).ready(function() {
  // Bind a click event to the Cancel button
  $("#cancelButtonTDC").click(function() {
    var currentURL = new URL(window.location.href);
    currentURL.searchParams.delete('DELTDCID');
    window.history.replaceState({}, document.title, currentURL.href);
    window.location.reload();
  });





});

</script>

</html>