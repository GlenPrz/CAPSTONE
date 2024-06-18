<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$_SESSION['username'];
include "conn.php";
$query = "SELECT
    idadmin_schedule,
    schedule,
    CONCAT(
        TIME_FORMAT(admin_scheduleTime, '%H:%i:%s'),
        ' to ',
        TIME_FORMAT(admin_scheduleTime2, '%H:%i:%s')
    ) AS concatenated_time
    FROM u896821908_bts.admin_schedule;";

$stmt = $conn->prepare($query);
$stmt->execute();
$resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
    
</head>
<style>
    * {
        font-family: 'Inter', sans-serif;
    }

    main {
        margin-top: -3%;
    }

    nav {
        width: 90%;
        margin: auto;
    }

    .logo {
        width: 140px;
        height: 150px;
        display: inline-block;
    }

    nav h2 {
        font-size: 50px;
        display: inline-block;
        transform: translateY(-90%);
        margin-left: 2%;
        margin-right: 2%;

    }

    nav hr {
        width: 40%;
        border: none;
        height: 15px;
        background: #018203;
        display: inline-block;
        margin-bottom: 5%;

    }

    h2 {
        display: inline-block;
    }
    .right-box {
        width: 32%;
        display: block;
        float: left;
        outline: solid 2px red;

    }

    .right-box h3 {
        display: inline-block;
    }

    .right-box input[type="checkbox"]:first-of-type {
        margin-left: 2%;
    }

    .right-box input[type="checkbox"] {
        margin-left: 10%;
    }
    .left-box {
        width: 32%;
        float: left;
        outline: solid 2px red;
    }

    .left-box input[type="checkbox"] {
        margin-left: 3%;
    }

    .left-box select:first-of-type {
        margin-left: 13%;
    }

    .left-box select {
        margin-left: 6%;
    }

    .left-box input[type="text"] {
        margin: 2%;
        font-size: 25px;
        color: black;
        width: 80%;
        margin-left: 3%;

    }

    .submit-box {
        width: 100%;
        display: inline-block;
        margin-top: 1%;
    }

    .submit-box .contained-buttons {
        width: 60%;
        margin: auto;
        display: flex;
        justify-content: center;

    }

    .submit-box input[type="Submit"] {
        background-color: #4ABB2E;
    }

    .submit-box input[type="reset"] {
        background-color: #E00D0D;

    }

    .submit-box input[type="Submit"],
    input[type="reset"] {
        margin: 1%;
        width: 20%;
        border: none;
        border-radius: 10px;
        padding: 10px 20px 10px 20px;
        text-align: center;
        font-size: 20px
    }
    .Available_Sched{
        display:block;
    }
</style>

<body>
    <nav>
        <img src="img/bts_logo.png" class="logo">
        <h2>Enrollment Form</h2>
        <hr>
    </nav>
    <main>
    <h1>Enrolling for:</h1>

        <form method="POST" action="Account_payable.php" id="enrollmentForm">
 
    <div class="left-box">
        <input type="checkbox" name="tdcOnline" value="Enrolling">
            <h2>Theoretical Driving Course</h2>
        <br>
        <input type="checkbox" name="depStatus" value="Enrolling">
            <h2>Driving Enhancement Program</h2>
        <br>
        <input type="text" placeholder="License Number:" name="licenseNumber">
        <br>
        <input type="text" placeholder="Expiration Date:" name="expirationDate">
  </div>

  <div class="right-box">
        <input type="checkbox" name="PDC" value="PDC">
            <h3>Practical Driving Course</h3>
    <br>
        <input type="radio" name="PDC_Motor" value="Motorcycle(Automatic)">
            <h3>Motorcycle (Automatic)</h3>
    <br>
        <input type="radio" name="PDC_Motor" value="Motorcycle(Manual)">
            <h3>Motorcycle (Manual)</h3>
    <br>
        <input type="radio" name="PDC_Car" value="CAR(Automatic)">
            <h3>Car (Automatic)</h3>
    <br>
        <input type="radio" name="PDC_Car" value="CAR(Manual)">
            <h3>Car (Manual)</h3>
  </div>

  <div class="right-box Available_Sched">
            <h3>&nbsp;Select Available Schedule:</h3>
            <select name="schedule_options">
    <option value="">Select an option</option>
    <?php foreach ($resultSet as $row): ?>
        <option value="<?= $row['idadmin_schedule'] ?>">
           <?= $row['schedule'] ?>
        </option>
    <?php endforeach; ?>
</select>
<select name="schedule_options">
    <option value="">Select an option</option>
    <?php foreach ($resultSet as $row): ?>
        <option value="<?= $row['idadmin_schedule'] ?>">
           <?= $row['concatenated_time'] ?>
        </option>
    <?php endforeach; ?>
</select>

  </div>

  <div class="submit-box">
    <div class="contained-buttons">
      <input type="reset" value="Cancel">
      <input type="Submit" value="Submit" onclick="submitForm()";>
    </div>
  </div>
</form>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
   $(document).ready(function() {
  $('input[name="PDC"]').change(function() {
    var isChecked = $(this).is(':checked');
    
    $('input[name="PDC_Motor"]').prop('disabled', !isChecked);
    $('input[name="PDC_Car"]').prop('disabled', !isChecked);
    
    if (!isChecked) {
      $('input[name="PDC_Motor"]').prop('checked', false);
      $('input[name="PDC_Car"]').prop('checked', false);
    }
  });
  
  $('input[name="PDC_Motor"]').change(function() {
    $('input[name="PDC"]').prop('checked', true);
  });
  
  $('input[name="PDC_Car"]').change(function() {
    $('input[name="PDC"]').prop('checked', true);
  });

  $('input[type="reset"]').click(function() {
                window.location.href = 'WelcomePage(NotEnroll).php';
            });
});

function submitForm() {
      var formData = new FormData(document.getElementById("enrollmentForm"));
      var formData = new FormData(document.getElementById("enrollmentForm"));
  console.log("TDC Online:", formData.get("tdcOnline"));
  console.log("Dep Status:", formData.get("depStatus"));
  console.log("License Number:", formData.get("licenseNumber"));
  console.log("Expiration Date:", formData.get("expirationDate"));
  console.log("PDC:", formData.get("PDC"));
  console.log("PDC Motor:", formData.get("PDC_Motor"));
  console.log("PDC Car:", formData.get("PDC_Car"));

       $.ajax({
        type: "POST",
        url: "update_enrollment_profile.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
        },
        error: function () {
          // Handle errors if the request fails
          alert("An error occurred while updating enrollment data.");
        }
      });
    }


</script>
</body>
</html>