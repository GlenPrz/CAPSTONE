<?php
session_start();

include("conn.php");

try {

  $sqlInfoData = "SELECT * FROM u896821908_bts.course_enrolled where Course = 'TDC'";
  $stmtInfoData = $conn->query($sqlInfoData);
  
  $idCourse_EnrolledArray = [];
  $CourseArray = [];
  $Course_infoArray = [];
  $VechileArray = [];
  $InfoArray = [];
  $PriceArray = [];
  
   // Fetch and store values in arrays
   while ($row = $stmtInfoData->fetch(PDO::FETCH_ASSOC)) {
    $idCourse_EnrolledArray[] = $row['idCourse_Enrolled'];
    $CourseArray[] = $row['Course'];
    $Course_infoArray[] = $row['Course_info'];
    $InfoArray[] = $row['Info'];
    $PriceArray[] = number_format(intval($row['Price']), 0, '', ',');
  }
  
  
  }catch (PDOException $e) {
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
  <link href="./modalsStyle/textbox.css?version=1" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./design/general/index.css">
  <link rel="stylesheet" href="./design/general/navbar.css">
</head>

<style>
  .User_data_container {

    width: 100%;
    display: block;
  }

  .Right_user_data {

    width: 100%;
    display: flex;
    column-gap: 1%;
  }

  .Right_user_data input[type='text'] {
    width: 45%;
  }

  .Enrollment_Detail {
    margin-top: 15px;
    display: flex;
  }

  .CashPayment_Detail_Container {
    margin-top: 15px;
    display: block;

  }

  .Registration_container_form {

    display: block;
    margin: auto;
    margin-top: 3%;
    width: 95%;
  }

  .Registration_container_form_title {
    text-align: center;
  }

  .NoteRed {
    color: red;
  }

  .Payment_firstRow {
    font-weight: bold;
    width: 45%;
    display: inline-block;
  }

  .Payment_secondRow {
    width: 45%;
    display: inline-block;
  }

  .box_container_TDC {
    margin: auto 3% auto 7%;
  }

  .box_container_TDC:nth-child(1) {
    width: 30%;
    margin: auto;
  }

  .box_container_TDC:nth-child(2) {
    width: 50%;
    margin: auto;
  }

  .box_container_TDC:nth-child(3) {
    width: 12%;
    margin: auto;
  }

  .box_container_TDC:nth-child(4) {
    margin: auto;
  }

  .box_container_TDC:nth-child(5) {
    margin: auto;
  }

  .gender {
    margin-left: 1%;
  }

  .label_bday {
    margin-left: 1%;
  }

  .bday {
    font-size: 20px;
    width: 34.7%;
    height: 50px;
    width: 12%;
    margin-bottom: 2%;
    height: 50px;
    font-size: 20px;
  }

  .TDC_enrollment_btn {
    background-color: green;
    color: white;
    width: 30%;
    font-family: inherit;
    padding: 1.1rem;
    margin: 10px 0 0 0;
    align-items: center;
    text-align: center;
    border-radius: 10px;
    margin-left: 1%;
    margin-bottom: 1%;
    font-size: 18px;
  }

  .TDC_Reset_btn {
    background-color: red;
    color: white;
    width: 10%;
    font-family: inherit;
    padding: 1.1rem;
    margin: 10px 0 0 0;
    align-items: center;
    text-align: center;
    border-radius: 10px;
    font-size: 18px;
  }
  .TDC_Reset_btn:hover{
      background-color: darkred;
  }

  .input_Date {
    width: 10%;
    padding: 13px;
    font-size: 16px;
    background-color: #d9d9d9;
  }

  .wid_med {
    width: 15%;
    margin-left:1%;
  }

  .Long_inputs {
   width: 100%;
    display: flex;
    margin-top: 1%;
    margin-bottom: 1%;
    column-gap: 1%;
  }

  .Long_inputs input[type="text"] {
    width: 40%;
  }

  input[type="email"] {
    padding: 10px;
    margin-left: 1%;
    width: 100%;
    font-size: 20px;
    background-color: #d9d9d9;
  }

  .Contact_Person {
    width: 100%;
    display: flex;
    flex-direction: row;
    column-gap: 1%;
  }

  .Contact_Person input[type="text"] {
    width: 40%;
  }

  .inner_box {
    margin-left: 2%;
    height: 90px;
    width: 90%;
    padding: 0 1%;
    background-color: rgba(137, 245, 150, .2);
    display: flex;
    flex-direction: row;
    gap: 2%;
    box-shadow: 2px 7px 8px rgba(0, 0, 0, 0.3);
  }

  .Btn_FsubmitShowM {
    background-color: green;
    color: white;
    width: 10%;
    font-family: inherit;
    padding: 1.1rem;
    margin: 10px 0 0 0;
    align-items: center;
    text-align: center;
    border-radius: 10px;
    margin-left: 1%;
    margin-bottom: 1%;
    font-size: 18px;
  }
  .Btn_FsubmitShowM:hover{
      background-color: darkgreen;
  }
  .stud_RegDet{
    width: 100%;
    display: flex;
    margin-top: 1%;
    margin-bottom: 1%;
    column-gap: 1%;

  }

  .stud_RegDet input[type="text"],input[type="date"] {
    width: 50%;
  }.stud_RegDet select {
    width: 50%;
  }.button_Container_Registration{
    margin-bottom: 5%;
    margin-top: 3%;
  }.file {
   display: flex;
   width: 100%;
   column-gap: 1%;
  }input[type="file"]{
     background-color: #4CAF50;
    
    color: white;
    border: none;
    padding: 15px 20px;
    border-radius: 20px;
    font-size: 18px;
    cursor: pointer;
    width: 18%;
  }.large-radio {
        transform: scale(2); /* Increase the size */
        margin-right: 10px; /* Add some spacing between them */
        }

 /* Style for stacking them vertically */
   .radio-container {
        display: flex; /* Make the container a block element */
        grid-column-gap: 1%;
        width: 100%;

        }

</style>



<body>
  <div class="Registration_container_form">
    <h2 class="Registration_container_form_title">
      ENROLLMENT REGISTRATION FORM FOR THEORETICAL DRIVING COURSE</h2>
    <h2>Registration Details</h2>
    <div class="User_data_container">
    <!-- id="SignUp_StudentTDC" -->

      <form action="payment_TDC.php" method="post" enctype="multipart/form-data">
        <div class="Right_user_data">

     <input type="text" 
       id="lastNameInput" 
       name="LastName" 
       placeholder="&nbsp;Last Name*" 
       pattern="[A-Za-z]{2,}" 
       title="Enter a Valid Last Name (no spaces or numbers)" 
       oninput="this.value = capitalizeWords(this.value.slice(0, 25))"
       maxlength="25" 
       required>

        <input type="text" 
       name="FirstName" 
       placeholder="&nbsp;First Name*" 
       pattern="[A-Za-z ]{2,}" 
       title="Enter a Valid First Name (letters and spaces only, at least 2 characters)"
       oninput="this.value = capitalizeWords(this.value.slice(0, 25))"
       maxlength="25" 
       required>

          <input type="text" name="MiddleName" placeholder="&nbsp Middle Name(optional)" pattern="[A-Za-z]+"
            title="Should only contain letters" oninput="this.value = capitalizeWords(this.value.slice(0, 25))"
            maxlength="25">

          <input type="text" name="Suffix" placeholder="&nbsp Suffix (optional)" pattern="[A-Za-z]+"
            title="Should only contain letters" oninput="this.value = capitalizeWords(this.value.slice(0, 25))"
            maxlength="25">
          </div>
          <br>
          <span class="exp_date" style="font-size: 20px;">Birthdate:*</span>
          <div class="stud_RegDet">
            
            <input type="date"  name="Birthdate" id="birthdate" placeholder="&nbsp;Birthdate*"
              max="2005-06-20" style="margin: 0 0 0 0;" required>


            <select class="wid_med" name="CivilStatus" id="civil-status" style="margin: 0 0 0 0;" required>
              <option value="" disabled selected hidden>Civil Status*</option>
              <option value="Single">Single</option>
              <option value="Married">Married</option>
              <option value="Widowed">Widowed</option>
              <option value="Divorced">Divorced</option>
            </select>

            <select name="SEX" style="margin: 0 0 0 0;" required>
              <option value="" disabled selected hidden>Choose Gender*</option>
              <option value="MALE">MALE</option>
              <option value="FEMALE">FEMALE</option>
            </select>
            
            <input type="text" class="ConNum" name="ContactNumber" placeholder="&nbsp Contact Number*" pattern="09\d{9}"
              title="Should only contain 11 digits starting with 09" maxlength="11" minlength="11" required>
              
        </div>
            <div class="Long_inputs">

            <input type="text" name="CompleteAddress" placeholder="&nbsp;Address"
       pattern="[A-Za-z0-9,-.\s]{5,}" title="Should only contain letters, numbers, and spaces, and have at least 5 characters"
       oninput="this.value = capitalizeWords(this.value.slice(0, 150))"
       minlength="5" maxlength="150" required>


            <input type="text" name="City" placeholder="&nbsp City" class="Address*"
       pattern="[A-Za-z\s]{4,}" title="Should only contain letters and spaces, and have at least 4 characters"
       oninput="this.value = capitalizeWords(this.value.slice(0, 50))"
       minlength="4" maxlength="50" required>

              <input type="text" name="ZipCode" placeholder="&nbsp Zip Code*" pattern="[0-9]{4}"
                title="Should only contain 4 digits" maxlength="4" minlength="4" required>

             <input type="text" name="Citizenship" placeholder="&nbsp Citizenship*"
       pattern="[A-Za-z ]{4,}" title="Should only contain letters and have at least 4 characters"
       oninput="this.value = capitalizeWords(this.value.slice(0, 15))"
       maxlength="15" required>
          </div>
            <br>
            <h3>In case of emergency contact person</h3>
            <div class="Contact_Person">
             <input type="text" name="ContactPerson" placeholder="&nbsp Fullname of Contact Person*"
       pattern="[A-Za-z ]{4,}" title="Should only contain letters and have at least 4 characters"
       oninput="this.value = capitalizeWords(this.value.slice(0, 25))"
       maxlength="25" required>

              <input type="text" class="ConPersonNum" name="ConPerson" placeholder="&nbsp Contact Number*"
                pattern="09\d{9}" title="Should only contain 11 digits starting with 09" maxlength="11"
                minlength="11" required>
                <br><br>

							<select name="Relationship" style="margin: 0 0 0 0;" required>
									<option value="" disabled selected>Select Relationship*</option>
    								<?php

    // SQL query to retrieve relationships from the database
    $queryStdRelationship = "SELECT Relationship FROM std_emergency_relationship";
    $stmtStdRelationship = $conn->prepare($queryStdRelationship);
    $stmtStdRelationship->execute();

    // Fetch the options and populate the dropdown
    while($rowStdRelationship = $stmtStdRelationship->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value='".$rowStdRelationship['Relationship']."'>".$rowStdRelationship['Relationship']."</option>";
    }
    ?>
								</select>

            </div><br>
          </div>

          <div class="radio-container">
    <input type="radio" class="large-radio" name="radio-group" value="Birth Certificate" required>
    <h3 style="margin-top: 1%; margin-right: 2.5%;">Birth Certificate*</h3>
    <div class="file">
        <input id="birthcert_radio" type="file" name="BirthcertOrId" accept=".pdf" required disabled>
        <h3 style="margin-top: 1%; color: red;">Note:</h3>
        <h3 style="margin-top: 1%;">Upload pdf file only</h3>
    </div>
</div>
<br>
<br>
<div class="radio-container">
    <input type="radio" class="large-radio" name="radio-group" value="Id" required>
    <h3 style="margin-top: .5%;">Identification Card ID*</h3>
    <div class="file">
        <input id="id_radio" type="file" name="BirthcertOrId" accept=".pdf" required disabled>
        <h3 style="margin-top: 1%; color: red;">Note:</h3>
        <h3 style="margin-top: 1%;">Upload pdf file only</h3>
    </div>
</div>

    <div class="Enrollment_Detail">
      <div class="inner_box">
        <div class="box_container_TDC">
          <h3><?php echo $Course_infoArray[0] ?></h3>
          <input type="hidden" value="Enrolling" name="TDC_Enrolling">
        </div>
        <div class="box_container_TDC">
        <h3><?php echo $InfoArray[0] ?></h3>
        </div>
        <div class="box_container_TDC">
        <input type="hidden" value="<?php echo $PriceArray[0]; ?>" name="TDC_EnrollPrice">

          <h3><?php echo "Php " . $PriceArray[0] ?></h3>
        </div>
        <div class="box_container_TDC">

        </div>
      </div>
    </div>


    <center><div class="button_Container_Registration">
      <input type="submit" value="Enroll" class="Btn_FsubmitShowM" id="TDC_Registration"></input>
      <input type="Reset" name="TDC_Reset" class="TDC_Reset_btn" value="Cancel"  id="cancelButton">
    </div></center>

    </form>

  </div>
  </div>



</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="modal_script_index.js"></script>
<!-- <script src="script_login_TDC.js"></script> -->


<script>


  var birthCertRadio = document.querySelector('input[value="Birth Certificate"]');
    var idRadio = document.querySelector('input[value="Id"]');
    var birthCertInput = document.getElementById('birthcert_radio');
    var idInput = document.getElementById('id_radio');

    // Add change event listener to the radio buttons
    birthCertRadio.addEventListener('change', function() {
        if (this.checked) {
            birthCertInput.disabled = false;
            idInput.disabled = true;
        }
    });

    idRadio.addEventListener('change', function() {
        if (this.checked) {
            idInput.disabled = false;
            birthCertInput.disabled = true;
        }
    });

birthCertInput.addEventListener('change', function() {
    var fileSize = this.files[0].size; // in bytes
    var maxSize = 4 * 1024 * 1024; // 4 MB

    if (fileSize > maxSize) {
        alert('File size exceeds the limit of 4 MB. Please choose a smaller file.');
        this.value = ''; // Clear the file input
        this.disabled = true; // Disable the input
        birthCertRadio.checked = false;

    }
});
idInput.addEventListener('change', function() {
  var fileSize = this.files[0].size; // in bytes
    var maxSize = 4 * 1024 * 1024; // 4 MB

    if (fileSize > maxSize) {
        alert('File size exceeds the limit of 4 MB. Please choose a smaller file.');
        this.value = ''; // Clear the file input
        this.disabled = true; // Disable the input
        idRadio.checked = false;

    }
});

// Capitalize first letter of each word
  function capitalizeWords(str) {
    return str.replace(/\b\w/g, l => l.toUpperCase());
  }

  // Capitalize first letter of each word
  function capitalizeWords(str) {
    return str.replace(/\b\w/g, l => l.toUpperCase());
  }

  function capitalizeWords(value) {
    // Replace consecutive spaces with a single space
    value = value.replace(/\s{2,}/g, ' ');

    return value.replace(/\b\w/g, function (match) {
      return match.toUpperCase();
    }).replace(/\b\w+/g, function (match) {
      return match.charAt(0).toUpperCase() + match.slice(1).toLowerCase();
    });
  }
$(document).ready(function(){
	     
    // Attach a click event handler to the button with id "cancelButton"
  $("#cancelButton").click(function(){
     
    if (<?php echo json_encode(!$isTrue); ?>) {
        $.ajax({
            url: 'Session_destroying.php',
            type: 'POST',
            data: { /* Your AJAX data */ },
            success: function(response) {
                // Handle success if needed
                window.location.href = "login.php"; // Redirect to login.php
            },
            error: function() {
                // Handle error if needed
            }
        });
    } else {
        // Navigate back in the browser's history
        history.back();
    }
});
  });
//   // Get references to the date input field
// const datePicker = document.getElementById("datePicker");

// // Calculate the next Monday and Friday dates
// const today = new Date();
// let nextMonday = new Date();
// let nextFriday = new Date();

// while (nextMonday.getDay() !== 1) {
//     nextMonday.setDate(nextMonday.getDate() + 1);
// }

// while (nextFriday.getDay() !== 5) {
//     nextFriday.setDate(nextFriday.getDate() + 1);
// }

// // Format the dates as YYYY-MM-DD
// const formattedMonday = nextMonday.toISOString().split('T')[0];
// const formattedFriday = nextFriday.toISOString().split('T')[0];

// // Set the min and max attributes of the date input field
// datePicker.setAttribute("min", formattedMonday);
// datePicker.setAttribute("max", formattedFriday);


  // var genderField = document.querySelector('.gender');
  // genderField.setCustomValidity('Choose your gender');

  // // Reset validation message when an option is selected
  // genderField.addEventListener('change', function () {
  //   this.setCustomValidity('');
  // });
</script>

</html>