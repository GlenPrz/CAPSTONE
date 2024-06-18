<?php
include "../conn.php";
include "./php_scripts/admin_Staffiles/AdminStaff_EDIT_ENROLL.php";
include "./php_scripts/admin_Staffiles/AdminStaff_DEL.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Driver Instructor</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
    <link href="admin_styles/admin_nav.css" rel="stylesheet">
    <link href="./admin_styles/admin_Staff.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<style>
    input[type="text"],input[type="email"],input[type="password"]{
    width: 100%;
    height: 30%;
    font-size: 20px;
    background-color: white;
    outline: solid green 1px;
    border-radius: 10px;
    padding: 15px;
    }
    select{
    font-size: 20px;
    background-color: white;
    outline: solid green 1px;
    border-radius: 10px;
   width: 100%;
    padding: 15px;
    height: 20%;
    margin-top: 1%;
}input[type="date"]{
     font-size: 20px;
    margin-top: .7%;
    background-color: white;
    outline: solid green 1px;
    border-radius: 10px;
   width: 100%;
    padding: 15px;
    height: 20%;
    margin-right: 1%;
}
    .main_content {
        display: block;
        width: 60%;
        margin-left: 25%;
        margin-top: 5%;
        height: 100%;
        float: left;
    }

    .User_Full_Name {
        display: flex;
        width: 100%;
        column-gap: 1%;
    }

    .row2 {
        display: flex;
        width: 100%;
        column-gap: 1%;
        margin-top: 1%;
    }

    .row2 span {
        margin-top: .5%;
    }

    .wid_med {
        width: 30%;
        padding: 13px;
        font-size: 16px;
    }

    .row3 {
        display: flex;
        width: 100%;
        column-gap: 1%;
        margin-top: 1%;
    }
    .Account{
        display: flex;
        width: 100%;
        column-gap: 1%;
        margin-top: 1%;
    }

    .Attainment {
        display: flex;
        width: 100%;
        column-gap: 1%;
    }

    .Experience {
        display: flex;
        width: 100%;
        column-gap: 1%;
    }

    .License {
        display: flex;
        width: 100%;
        column-gap: 1%;
    }

    input[type="file"] {
        color: black;
        width: 100%
        font-family: inherit;
        padding: 1.1rem;
        margin: 10px 0 0 0;
        align-items: center;
        text-align: center;
        border-radius: 10px;
        margin-left: 1%;
        margin-bottom: 1%;
        font-size: 20px;
    }

    .UploadPic_Header {
        margin-left: 0px;
        font-size: 14px;
        font-family: 'Inter';
        font-style: normal;
        font-weight: 600;
    }

    .DI_enrollment_btn,
    .DI_Reset_btn {
        padding: 15px 30px;
        /* Increase padding for a larger button */
        font-size: 18px;
        /* Increase font size */
        border-radius: 20px;
        /* Add rounded edges */
        border: none;
        cursor: pointer;
        color: white;
        /* White text color */
        margin: 10px;
        width: 20%;
        /* Set a specific width for consistency */
    }

    .DI_enrollment_btn {
        background-color: green;
        /* Green background color for the Enroll button */
    }

    .DI_enrollment_btn:hover {
        background-color: #064706;
    }

    .DI_Reset_btn {
        background-color: red;
        /* Red background color for the Cancel button */
    }

    .DI_Reset_btn:hover {
        background-color: #520808;
    }.licensefile{
        display: flex;
    }


</style>


<body>
    <div class="Container_nav">
        <div class="nav_admin">
            <nav>
                <center>
                    <div class="logo_container">
                        <img src="../img/bts_logo.png" class="admin_logo">
                    </div>
                    <div class="nav_links">
                        <a href="admin_dash.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="admin_sched.php"><i class="far fa-calendar"></i> Schedule</a>
    <a href="admin_enroll.php"><i class="fas fa-user-plus"></i> Enrollment</a>
    <a href="admin_Pupdate.php"><i class="fas fa-bullhorn"></i> Post Updates</a>
    <a href="admin_reports.php"><i class="fas fa-chart-bar"></i> Reports</a>
    <a href="admin_Staff.php"><i class="fas fa-users"></i> Staff</a>
    <a href="admin_Assign.php"><i class="fas fa-tasks"></i> Assign</a>
    <a href="admin_view_feedback.php"><i class="fas fa-comment"></i> View Feedback</a>
    <a href="admin_module_exam.php"><i class="fas fa-book"></i> Module/Exam</a>
    <a href="" id="logoutLink"><i class="fas fa-sign-out-alt"></i> Log Out</a>


                    </div>
                </center>
            </nav>
        </div>
        <div class="main_content">
            <div class="Registration_container_form">
                <h2 class="Registration_container_form_title">
                    DRIVER INSTRUCTOR REGISTRATION FORM
                </h2>
                <form id="SignUp_DI" method="post" enctype="multipart/form-data" onsubmit="return validateFormCheck()">
                    <br>
                    <h3>Personal Details</h3><br>
                    <div class="User_Full_Name">
                        <input type="text" name="DI_LastName" placeholder="&nbsp Last Name"
       pattern="[A-Za-z ]{3,}" title="Should only contain letters"
       oninput="this.value = capitalizeWords(this.value.slice(0, 25))" maxlength="25" required>

                        <input type="text"  name="DI_FirstName" placeholder="&nbsp First Name"
       pattern="[A-Za-z ]{3,}" title="Should only contain letters"
                            oninput="this.value = capitalizeWords(this.value.slice(0, 25))" maxlength="25" required>

                        <input type="text"  name="DI_MiddleName" placeholder="&nbsp Middle Name"
       pattern="[A-Za-z ]{3,}" title="Should only contain letters"
                            oninput="this.value = capitalizeWords(this.value.slice(0, 25))" maxlength="25">

                        <input type="text"  name="DI_Suffix" placeholder="&nbsp Suffix (optional)"
       pattern="[A-Za-z ]{2,}" title="Should only contain letters"
                            oninput="this.value = capitalizeWords(this.value.slice(0, 25))" maxlength="25">
                    </div>
                    <div class="row2">
                        <span class="exp_date" style="font-size: 20px;">Birthdate:</span>

                        <input type="date"  name="DI_Birthdate" id="DI_birthdate"
                            placeholder="&nbsp Birthdate" max="2005-06-20" style="margin: 0 0 0 1%;" required>

                        <select  name="DI_CivilStatus" id="DI_civil-status" style="margin: 0 0 0 1%;" required>
                            <option value="" disabled selected>Choose Civil Status</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Widowed">Widowed</option>
                            <option value="Divorced">Divorced</option>
                        </select>
                        <select name="SEX" id="SEX" style="margin: 0 0 0 1%;" required>
                            <option value="" disabled selected hidden>Choose Gender</option>
                            <option value="MALE">MALE</option>
                            <option value="FEMALE">FEMALE</option>
                        </select>
                        <br>
                        <input type="text"  name="DI_ContactNumber" placeholder="&nbsp Contact Number"
                            pattern="09\d{9}" title="Should only contain 11 digits starting with 09" maxlength="11"
                            minlength="11" required>
                            <br>
                    </div>
                    <div class="row3">
                       <input type="text" name="DI_CompleteAddress" placeholder="&nbsp;Address" class="Address"
       pattern="[A-Za-z0-9,-. ]{3,}" title="Should only contain letters and numbers"
       oninput="this.value = capitalizeWords(this.value.slice(0, 150))" maxlength="150" required>


                    <input type="text" name="DI_City" placeholder="&nbsp;City" class="Address"
       pattern="[A-Za-z0-9, -.]{3,}" title="Should only contain letters"
       oninput="this.value = capitalizeWords(this.value.slice(0, 50))" maxlength="50" required>


                        <input type="text" name="DI_ZipCode" placeholder="&nbsp Zip Code" pattern="[0-9]{4}"
                            title="Should only contain 4 digits" maxlength="4" minlength="4" required>

                       <input type="text" name="DI_Citizenship" placeholder="&nbsp;Citizenship" pattern="[A-Za-z ]{3,}" 
       title="Should only contain letters" 
       oninput="this.value = capitalizeWords(this.value.slice(0, 15))" maxlength="15" required>

                    </div><br>
                    <div class="Account">
                        <input type="email" name="DI_EmailAdd" id="DI_emailInput" placeholder="&nbsp;Email Address"
                            pattern="[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}" title="Invalid email address" required>
                       
<input type="text" class="username" name="Username" placeholder="&nbsp;Username" pattern="[A-Za-z0-9]{4,}" 
       title="Should contain at least four alphanumeric characters" maxlength="10" required>


                        <input type="password" name="DI_pass" id="Ppassword" placeholder="&nbsp;Password" required>
                        <input type="password" name="DI_Cpass" id="CconfirmPassword" placeholder="&nbsp;Confirm Password">
                        </div>
                        <br> 
                        <br>
                        <div id="message">
                        <h3>Password must contain the following:</h3>
        <p class="invalid letter">A <b>lowercase</b> letter <span class="x-icon">✖</span><span class="check-icon">✔</span></p>  <br>
        <p class="invalid capital">A <b>capital (uppercase)</b> letter <span class="x-icon">✖</span><span class="check-icon">✔</span></p>  <br>
        <p class="invalid number">A <b>number</b> <span class="x-icon">✖</span><span class="check-icon">✔</span></p>  <br>
        <p class="invalid length">Minimum <b>8 characters</b> <span class="x-icon">✖</span><span class="check-icon">✔</span></p>  <br>
          </div>
                        <br>
                    
                    <h3>Highest Educational Attainment </h3><br>
                    <div class="Attainment ">
                        <select  name="DI_Education" id="educ_level" required>
                            <option value="" disabled selected>Choose Education Level</option>
                            <option value="Elementary">Elementary</option>
                            <option value="HighSchool">High School</option>
                            <option value="College">College</option>
                            <option value="GraduateSchool">Graduate School</option>
                        </select>
                        <label>Year</label>
                        <input type="date" name="DI_Year" placeholder="&nbsp Year Graduate" pattern="[0-9]{4}"
                            title="Should only contain 4 digits" maxlength="4" minlength="4" required>

                      <input type="text" name="DI_School" placeholder="&nbsp;School" style="margin: 1% 0 0 0;"
       pattern="[A-Za-z ]{5,}" title="Should only contain letters and have a minimum length of 5 characters" 
       oninput="this.value = capitalizeWords(this.value.slice(0, 25))" maxlength="25" required>



                       <input type="text" name="DI_Degree" placeholder="&nbsp;Degree" style="margin: 1% 0 0 0;"
       pattern="[A-Za-z ]{3,}" title="Should only contain letters and have a minimum length of 5 characters" 
       oninput="this.value = capitalizeWords(this.value.slice(0, 25))" maxlength="50" required>

                    </div><br>

                    <h3>Driver Instructor Training</h3><br>
                    <div class="Attainment ">
                        <select  name="DI_Accreditation" id="acc_level" required>
                            <option value="" disabled selected>Choose Accreditation </option>
                            <option value="Motorcycle">Motorcyle</option>
                            <option value="light_vehicle">Light Vehicle</option>
                            <option value="Motorcyle_and_light_vehicle">Motorcyle and Light Vehicle</option>
                        </select>
                        <label>Year Graduate</label>
                        <input type="date" name="DI_YearGrad" placeholder="&nbsp Year Graduate" pattern="[0-9]{4}"
                            title="Should only contain 4 digits" maxlength="4" minlength="4" required>

                      <input type="text" name="DI_Center" placeholder="&nbsp;Name of Training Center"
       pattern="[A-Za-z ]{3,}" title="Should only contain letters" 
       oninput="this.value = capitalizeWords(this.value.slice(0, 25))" maxlength="25" required>
    
<input type="text" name="AcredNum" placeholder="&nbsp;Accreditation Number"
       pattern="[A-Za-z]{3}[0-9]{10}" title="This Field is required" 
       oninput="this.value = capitalizeWords(this.value.replace(/\s+/g, '').slice(0, 25))" maxlength="25" required>

                    </div><br>
                    <h3>Experience as Driver Instructor</h3><br>
                    <div class="Experience">
                        <label>From</label>
                        <input type="date" name="DI_FromYear" placeholder="&nbsp;From" pattern="[0-9]{4}"
                            title="Should only contain 4 digits" maxlength="4" minlength="4" >

                        <label>To</label>
                        <input type="date" name="DI_ToYear" placeholder="&nbsp;To" pattern="[0-9]{4}"
                            title="Should only contain 4 digits" maxlength="4" minlength="4" >

                       <input type="text" name="DI_Position" placeholder="&nbsp;Position" style="margin: 1% 0 0 0;"
       pattern="[A-Za-z ]{5,}" title="Should only contain letters" 
       oninput="this.value = capitalizeWords(this.value.slice(0, 25))" maxlength="25">


                      <input type="text" name="DI_Driving_School" placeholder="&nbsp;Name of Driving School" 
       style="margin: 1% 0 0 0;" pattern="[A-Za-z0-9 ]{3,}" 
       title="Should only contain letters or numbers" 
       oninput="this.value = capitalizeWords(this.value.slice(0, 25))" maxlength="25">


                    </div><br>
                    <h3>Current Drivers License</h3><br>
                    <div class="License">
                        <select  name="DI_DriverLicense" id="DL-status" required>
                            <option value="" disabled selected>Choose License </option>
                            <option value="Professional">Professional</option>
                            <option value="Non_Pro">Non Professional</option>
                        </select>
                        <span class="exp_date" style="margin: auto 0 auto .5%; font-size: 20px;">Expiration Date:</span>
                        <input type="date" name="DI_LCExpirationDate" min="<?php echo date('Y-m-d'); ?>" required>
                        
                    </div>
                    <div class="licensefile">
                        <span class="exp_date" style="margin-top: 3%; font-size: 20px;">Drivers License:</span>
<input type="file" name="DI_DriverLicense" accept="application/pdf" required onchange="validateFileSize(this, 4194304)">
                        <h5 style="margin-top: 3%; font-size: 20px; margin-left: 1%; color: red;">Note:</h5>
                        <p style="margin-top: 3%; font-size: 20px; margin-left: 1%;">Upload pdf file only</p>
                    </div>
                    <br>
                    <div class="imgPrev" id="defaultProfileImage">
              </div>
                    <div>
                    <h3 class="UploadPic_Header">Upload your Profile Picture</h3>
                <br>
                <input type="file" name="profile_picture" id="DI_profile_picture" accept="image/*" required>
               </div>
            </div>
          

            <div class="button_Container_Registration">
                <input type="submit" name="DI_Submit" class="DI_enrollment_btn" value="Add Instructor">
                <input type="reset" name="DI_Reset" class="DI_Reset_btn" id="cancelBtn" value="Cancel">
            </div>
            </form>

        </div>
    </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>


function validateFileSize(input, maxSize) {
    if (input.files && input.files[0]) {
        var fileSize = input.files[0].size; // in bytes
        var maxSizeInBytes = maxSize;
        var maxSizeInMB = maxSizeInBytes / (1024 * 1024);

        if (fileSize > maxSizeInBytes) {
            alert("File size exceeds the maximum allowed size of " + maxSizeInMB + " MB.");
            input.value = ''; // Reset the file input
            return false;
        }
    }

    return true;
}

function validateFormCheck() {
        var genderSelect = document.getElementById('SEX');
        var selectedGender = genderSelect.value;

        var civilStatusSelect = document.getElementById('DI_civil-status');
        var selectedCivilStatus = civilStatusSelect.value;

        var relationshipSelect = document.getElementsByName('Relationship')[0]; // Assuming the select name is 'Relationship'
        var selectedRelationship = relationshipSelect.value;

        // Check if the selected values are the default ("Choose Gender*", "Choose Civil Status*", or "Select Relationship*")
        if (selectedGender === "" || selectedGender === 'Choose Gender') {
            alert("Please select a valid gender.");
            return false;
        }

        if (selectedCivilStatus === "" || selectedCivilStatus === 'Choose Civil Status') {
            alert("Please select a valid civil status.");
            return false;
        }

        if (selectedRelationship === "" || selectedRelationship === 'Select Relationship*') {
            alert("Please select a valid relationship.");
            return false;
        }

        // Additional validations can be added here if needed

        return true; // Form will submit if all validations pass
    }




    $(document).ready(function () {

        $("#DI_profile_picture").change(function () {
      var file = this.files[0];
      if (file instanceof Blob) {
        var reader = new FileReader();
        reader.onload = function (e) {
          var imgElement = $("<img>");
          imgElement.attr("src", e.target.result);
          imgElement.addClass("preview-image");
          imgElement.css("max-width", "150px");
          imgElement.css("max-height", "150px");
          imgElement.css("border-radius", "50%");
          imgElement.css("object-fit", "cover");
          imgElement.css("border", "2px solid black"); // Add black border
          $(".imgPrev").empty();
          $(".imgPrev").append(imgElement);
        };
        reader.readAsDataURL(file);
      } else {
        console.error("Invalid file object.");
      }
    });

    var defaultImage = $('<img id="defaultProfileImage">');
    defaultImage.attr("src", "../uploads/Di_uploads/DI_icon.png"); // Replace "default-image.png" with the path to your default image
    defaultImage.addClass("preview-image");
    defaultImage.css("max-width", "150px");
    defaultImage.css("max-height", "150px");
    defaultImage.css("border-radius", "50%");
    defaultImage.css("object-fit", "cover");
    defaultImage.css("border", "2px solid black"); // Add black border
    $(".imgPrev").empty();
    $(".imgPrev").append(defaultImage);

    // Test if file is selected
    $("#DI_profile_picture").change(function () {
      var file = this.files[0];
      if (file) {
        console.log('File selected:', file.name);
      } else {
        console.log('No file selected.');
      }
    });

    //PASSWORD CHECKING

    // Check if passwords match on input change
    $('#CconfirmPassword').on('input', function () {
      var password = $('#Ppassword').val();
      var confirmPassword = $(this).val();

      if (password !== confirmPassword) {
        $(this).get(0).setCustomValidity("Passwords do not match");
      } else {
        $(this).get(0).setCustomValidity("");
      }
    });

    var passwordInput = $("#Ppassword");
    var confirmPasswordInput = $("#CconfirmPassword");

    passwordInput.on("input", validatePassword);
    confirmPasswordInput.on("input", validatePassword);

    function validatePassword() {
      var password = passwordInput.value;
      var confirmPassword = confirmPasswordInput.value;

      var regexPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/;

      if (regexPattern.test(password) && regexPattern.test(confirmPassword)) {
        console.log("Passwords are valid.");
      } else {
        console.log("Passwords are invalid.");
      }
    }

    var passwordInput = document.getElementById("Ppassword");
    var checkIcons = document.querySelectorAll(".check-icon");
    var xIcons = document.querySelectorAll(".x-icon");

            // When the user interacts with the password input
    passwordInput.addEventListener("focus", function() {
    document.getElementById("message").style.display = "block";
    });

    passwordInput.addEventListener("blur", function() {
    document.getElementById("message").style.display = "none";
    });

    passwordInput.addEventListener("keyup", function() {
                var lowercaseRegex = /[a-z]/;
                var uppercaseRegex = /[A-Z]/;
                var numberRegex = /[0-9]/;
                var minLength = 8;

                var lowercaseValid = lowercaseRegex.test(passwordInput.value);
                var uppercaseValid = uppercaseRegex.test(passwordInput.value);
                var numberValid = numberRegex.test(passwordInput.value);
                var lengthValid = passwordInput.value.length >= minLength;

                document.querySelector(".letter").classList.toggle("invalid", !lowercaseValid);
                document.querySelector(".capital").classList.toggle("invalid", !uppercaseValid);
                document.querySelector(".number").classList.toggle("invalid", !numberValid);
                document.querySelector(".length").classList.toggle("invalid", !lengthValid);

                for (var i = 0; i < checkIcons.length; i++) {
                    checkIcons[i].style.display = "none";
                }
                for (var i = 0; i < xIcons.length; i++) {
                    xIcons[i].style.display = "inline-block";
                }

                if (lowercaseValid) {
                    document.querySelector(".letter .check-icon").style.display = "inline-block";
                    document.querySelector(".letter .x-icon").style.display = "none";
                }
                if (uppercaseValid) {
                    document.querySelector(".capital .check-icon").style.display = "inline-block";
                    document.querySelector(".capital .x-icon").style.display = "none";
                }
                if (numberValid) {
                    document.querySelector(".number .check-icon").style.display = "inline-block";
                    document.querySelector(".number .x-icon").style.display = "none";
                }
                if (lengthValid) {
                    document.querySelector(".length .check-icon").style.display = "inline-block";
                    document.querySelector(".length .x-icon").style.display = "none";
                }
});
    //PASSWORD CHECKING    //PASSWORD CHECKING    //PASSWORD CHECKING    //PASSWORD CHECKING

    //
    $("#SignUp_DI").submit(function (event) {
        event.preventDefault(); 
        var passwordDI = $('#Ppassword').val();
      var confirmPasswordDI = $('#CconfirmPassword').val();
    

    var inputs = $(this).find('input');
      var isValid = true;
      inputs.each(function () {
        if (!$(this)[0].checkValidity()) {
          isValid = false;
          $(this).addClass('input-error');
        } else {
          $(this).removeClass('input-error');
        }
      });
    
      if (passwordDI !== confirmPasswordDI) {
        alert("Passwords do not match");
        isValid = false;
      }
    
       // Check password requirements
      var lowercaseRegex = /[a-z]/;
      var uppercaseRegex = /[A-Z]/;
      var numberRegex = /[0-9]/;
      var minLength = 8;
    
      var isLowerCaseValid = lowercaseRegex.test(passwordDI);
      var isUpperCaseValid = uppercaseRegex.test(passwordDI);
      var isNumberValid = numberRegex.test(passwordDI);
      var isLengthValid = passwordDI.length >= minLength;
    
      if (!isLowerCaseValid || !isUpperCaseValid || !isNumberValid || !isLengthValid) {
        alert("Password does not meet the requirements");
        isValid = false;
      }

      if (isValid) {
        var formData = new FormData(this);
    
        // Disable the submit button and show loading text
        var submitButton = $('.Submit');
        submitButton.prop('disabled', true);
        submitButton.html('<span class="loading-spinner"></span>Loading...');
    
        $.ajax({
          url: "../Admin/php_scripts/check_existingDI.php",
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          success: function (response) {
            if (response.trim() === "email_conflict") {
              alert("Email already exists");
              $('#emailInput').addClass('input-error');
            } else if (response.trim() === "username_conflict") {
              alert("Username already exists");
              $('.username').addClass('input-error');
            } else if (response.trim() === "success") {
              // Show checkmarks for each requirement
              $('#letter').addClass('valid');
              $('#capital').addClass('valid');
              $('#number').addClass('valid');
              $('#length').addClass('valid');
        
              submitForm();

             // Redirect to the desired URL after a successful submission
              clearInputFields();

              $('#emailInput').removeClass('input-error');
              $('.username').removeClass('input-error');
        
              window.location.href = "admin_Staff.php?Added";
            } else {
              console.log("Checking Exist"+response);
            }
          },
          error: function (xhr, status, error) {
            console.error(error);
            alert("Error occurred");
          },
          complete: function () {
            // Enable the submit button and restore the original text
            submitButton.prop('disabled', false);
            submitButton.text('SUBMIT');
          }
        });
      } else {
        // Remove checkmarks for each requirement
        $('#letter').removeClass('valid');
        $('#capital').removeClass('valid');
        $('#number').removeClass('valid');
        $('#length').removeClass('valid');
        
        return false; // Prevent form submission
      }
    });
    //

    //

    function clearInputFields() {
      var inputFields = $("#SignUp_DI").find("input");
      inputFields.val("");
    }

    function submitForm() {
      var formData = new FormData($("#SignUp_DI")[0]);
  //     formData.forEach(function(value, key){
  //   console.log(key + ': ' + value);
  // });
      $.ajax({
        url: "./php_scripts/Admin_AddingDi.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          console.log("DI Adding"+response);
        },
        error: function (xhr, status, error) {
          console.error(error);
          // Handle form submission error
        }
      });
    }


    //


//CANCEL BTN GO BACK CANCEL BTN GO BACK CANCEL BTN GO BACK CANCEL BTN GO BACK CANCEL BTN GO BACK CANCEL BTN GO BACK
    $("#cancelBtn").click(function() {
      // Specify the URL you want to redirect to
      var specificURL = "./admin_Staff.php"; // Replace with your desired URL
      
      // Redirect to the specific URL
      window.location.href = specificURL;
    });
//CANCEL BTN GO BACK CANCEL BTN GO BACK CANCEL BTN GO BACK CANCEL BTN GO BACK CANCEL BTN GO BACK CANCEL BTN GO BACK




    var emailInput = $('#DI_emailInput');

    emailInput.on('input', function () {
      var email = emailInput.val();
      var emailRegex = /^[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$/;

      if (emailRegex.test(email)) {
        emailInput[0].setCustomValidity('');
      } else {
        emailInput[0].setCustomValidity('Please enter a valid email address.');
      }
    });

    })
    
    
    $('#logoutLink').click(function(event) {
    event.preventDefault(); // Prevent the default link behavior
    
    var userConfirmed = window.confirm("To confirm Logging out, click Ok");
    
    if (userConfirmed) {
        $.ajax({
            url: '../logout.php',
            type: 'POST',
            success: function(response) {
                // Redirect to login.php on successful logout
                window.location.href = '../login.php';
            },
            error: function(xhr, status, error) {
                console.error(error); // Log any errors to the console
            }
        });
    }
    // If the user clicks "No" or cancels, do nothing
});
</script>

</html>