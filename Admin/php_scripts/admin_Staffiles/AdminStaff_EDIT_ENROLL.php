<!DOCTYPE html>
<html lang="en">
<?php

$userdataret = isset($_GET['Username']) ? $_GET['Username'] : '';

$stmt = $conn->prepare("SELECT * FROM u896821908_bts.di WHERE Username = :studentUsername");
$stmt->bindParam(':studentUsername', $userdataret); // Replace $studentId with the actual student ID
$stmt->execute();
$studentData = $stmt->fetch(PDO::FETCH_ASSOC);

$lastName = $studentData['Lastname'] ?? '';
$firstName = $studentData['Firstname'] ?? '';
$middleName = $studentData['Middlename'] ?? '';
$suffix = $studentData['Suffix'] ?? '';
$birthdate = $studentData['Birthdate'] ?? '';
$civilStatus = $studentData['Civilstatus'] ?? '';
$contactNumber = $studentData['ContactNumber'] ?? '';
$sex = $studentData['Sex'] ?? '';
$completeAddress = $studentData['Address'] ?? '';
$city = $studentData['City'] ?? '';
$zipCode = $studentData['ZipCode'] ?? '';
$citizenship = $studentData['Citizenship'] ?? '';
$emailAddress = $studentData['Email'] ?? '';
$password = $studentData['Password'] ?? '';
$username = $studentData['Username'] ?? '';
$enrollStatus = $studentData['Enroll_Status'] ?? '';
$role = $studentData['Role'] ?? '';
$profilePicture = $studentData['DI_profile_pic'] ?? '';
?>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>BTS Driving school</title>
	<link rel="icon" type="image/x-icon" href="../img/favicon.ico">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../modalsStyle/modal_signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-glCJ6IBN5q+YUqKEBrCrRM7DA4GPJ4QGiFJMAF9iMxSYELRtXQ8aQqg5dP2ANwvb" crossorigin="anonymous">

</head>
<style>
    #message p {
  font-size: 16px;
  position: relative;
}

#message span {
  display: none;
  position: absolute;
  right: -20px;
}

#message span#check-icon {
  color: green;
}

#message span#x-icon {
  color: red;
}
.input-error {
  box-shadow: 0 0 5px red;
}.modal_SignUp input[type="text"],input[type="email"],input[type="password"]{
    width: 100%;
    font-size: 20px;
    background-color: white;
    outline: solid green 1px;
    border-radius: 20px;
    padding: 15px;
    margin-bottom: 1%;
    }
    select{
    font-size: 20px;
    margin-top: .7%;
    background-color: white;
    outline: solid green 1px;
    border-radius: 20px;
   width: 100%;
    padding: 15px;
    height: 20%;
     margin-bottom: 1%;
}
input[type="date"]{
     font-size: 20px;
    margin-top: .7%;
    background-color: white;
    outline: solid green 1px;
    border-radius: 20px;
   width: 100%;
    padding: 15px;
    height: 20%;
    margin-right: 1%;
     margin-bottom: 1%;
}
    .password-container {
        position: relative;
    }

    .password-input {
        padding-right: 40px; /* Adjust the padding based on the larger icon size */
    }

    .toggle-password {
        position: absolute;
        right: 5px; /* Adjust the right position based on the larger icon size and padding */
        top: 50%;
        margin-right: 5%;
        margin-bottom: 5%;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 20px; /* Adjust the font size for a larger icon */
        color: black; /* Initial color */
        transition: color 0.3s; /* Add transition for smooth color change */
    }

    .toggle-password:hover,
    .toggle-password:active {
        color: green; /* Color when hovered or clicked */
    }
</style>
<body>
	<div id="EditProf" class="modal_SignUp">
		<!-- Modal content -->
		<div class="modal-content_Signup">
			<div class="modal-header_SignUp">
				<span class="close_SignUp">&times;</span>
				<h1>Update Staff</h1>
				<br>
			</div>
			<div class="modal-body_SignUp">
				<div class="container">
                <form id="SignUp_Student" method="post" enctype="multipart/form-data">
                        <div class="Personal Data">
                            <span class="Title">
                                <p class="headers">Personal Data <?php echo $userdataret?></p>
                            </span>
                            <div class="fields">
                                <div class="input-fields">
                                    <div class="first_row_input">

                                       <input type="text" name="LastName" placeholder="&nbsp Last Name"
       pattern="[A-Za-z ]{3,}" title="Should only contain letters and be at least 3 characters long"
       oninput="this.value = capitalizeWords(this.value.slice(0, 25))"
       maxlength="25" value="<?php echo $lastName;?>" required>


                                       <input type="text" name="FirstName" placeholder="&nbsp First Name"
       pattern="[A-Za-z ]{3,}" title="Should only contain letters and be at least 3 characters long"
       oninput="this.value = capitalizeWords(this.value.slice(0, 25))"
       maxlength="25" value="<?php echo $firstName; ?>" required>


                                        <input type="text" name="MiddleName" placeholder="&nbsp Middle Name"
                                            pattern="[A-Za-z ]+" title="Should only contain letters"
                                            oninput="this.value = capitalizeWords(this.value.slice(0, 25))"
                                            maxlength="25" value="<?php echo $middleName; ?>">

                                        <input type="text" name="Suffix" placeholder="&nbsp Suffix (optional)"
                                            pattern="[A-Za-z ]+" title="Should only contain letters"
                                            oninput="this.value = capitalizeWords(this.value.slice(0, 25))"
                                            maxlength="25" value="<?php echo $suffix; ?>">
                                    </div>
                                </div>
                                <br>
                                <div class="second_row_input">
                                    <label class="label_bday">Birth date:</label>
                                    <input type="date" name="Birthdate" id="birthdate" placeholder="&nbsp Birthdate"
                                        max="2005-06-20" value="<?php echo $birthdate; ?>">
                                    <select name="CivilStatus" id="civil-status" class="civ_stat">
                                        <option value="Single" <?php if ($civilStatus === 'Single') echo 'selected'; ?>>
                                            Single</option>
                                        <option value="Married"
                                            <?php if ($civilStatus === 'Married') echo 'selected'; ?>>Married</option>
                                        <option value="Widowed"
                                            <?php if ($civilStatus === 'Widowed') echo 'selected'; ?>>Widowed</option>
                                        <option value="Divorced"
                                            <?php if ($civilStatus === 'Divorced') echo 'selected'; ?>>Divorced</option>
                                    </select>
                                    <input type="text" name="ContactNumber" placeholder="&nbsp Contact Number"
                                        class="Cnum" pattern="09\d{9}"
                                        title="Should only contain 11 digits starting with 09" maxlength="11"
                                        minlength="11" value="<?php echo $contactNumber; ?>" required>

                                    <select name="SEX" class="gender">
                                        <option value="<?php echo $sex;?>" selected hidden><?php echo $sex;?></option>
                                        <option value="MALE">MALE</option>
                                        <option value="FEMALE">FEMALE</option>
                                    </select>
                                </div>
                                <br>
                                <div class="add_input">
                                <input type="text" name="CompleteAddress" placeholder="&nbsp Complete Address"
       class="Address" pattern="[A-Za-z0-9,-. ]{3,}" title="Should contain at least 3 characters, and may include letters, numbers, and special characters"
       oninput="this.value = capitalizeWords(this.value.slice(0, 30))"
       maxlength="30" value="<?php echo $completeAddress; ?>" required>

                                        
                                    <input type="text" name="City" placeholder="&nbsp City" class="Address"
       pattern="[A-Za-z ]{3,}" title="Should contain at least 3 letters"
       oninput="this.value = capitalizeWords(this.value.slice(0, 50))"
       maxlength="50" value="<?php echo $city; ?>" required>

                                </div>
                                <div class="third_row_input">
                                    <input type="text" name="ZipCode" placeholder="&nbsp Zip Code" pattern="[0-9]{4}"
                                        title="Should only contain 4 digits" maxlength="4" minlength="4"
                                        value="<?php echo $zipCode; ?>" required>
                                    <input type="text" name="Citizenship" placeholder="&nbsp Citizenship"
                                       pattern="[A-Za-z ]{3,}" title="Should contain at least 3 letters"
                                        oninput="this.value = capitalizeWords(this.value.slice(0, 15))" maxlength="15"
                                        value="<?php echo $citizenship; ?>" required>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <header2>
                            <p class="headers">Account Credentials</p>
                        </header2>
                        <div class="fourth_row_input">

                        <input type="hidden" name="CurrentEmail" id="currentEmailInput" value="<?php echo $emailAddress; ?>">

                        <input type="email" name="EmailAdd" id="emailInput" placeholder="&nbsp;Email Address"
                        pattern="[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}" title="Invalid email address"
                       value="<?php echo $emailAddress; ?>" required>
            <input type="hidden" name="CurrentUsername" placeholder="&nbsp New Username" class="username" maxlength="10" value="<?php echo $username; ?>" required>

<input type="text" name="NewUsername" placeholder="&nbsp New Username" class="username" 
       maxlength="10" value="<?php echo $username; ?>" 
       pattern="^(?!\s*$).+" title="Username must not be empty or consist only of spaces" 
       required>

                            <br>
                            <br>
                            <!-- Add a font-awesome link in your head section -->

                            <div class="password-container">
                                <input type="password" name="pass" id="password" class="password-input" placeholder="&nbsp; New Password" value="<?php echo $password; ?>">
                                <span class="toggle-password" onclick="togglePassword('#password')"><i class="fas fa-eye"></i></span>
                            </div>
                            
                            <div class="password-container">
                                <input type="password" id="confirmPassword" class="password-input" value="<?php echo $password; ?>" placeholder="&nbsp; Confirm New Password">
                                <span class="toggle-password" onclick="togglePassword('#confirmPassword')"><i class="fas fa-eye"></i></span>
                            </div>

                            <div id="message">
                              <h3>Password must contain the following:</h3>
                              <p id="letter" class="invalid">A <b>lowercase</b> letter <span id="x-icon">✖</span><span id="check-icon">✔</span></p>
                              <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter <span id="x-icon">✖</span><span id="check-icon">✔</span></p>
                              <p id="number" class="invalid">A <b>number</b> <span id="x-icon">✖</span><span id="check-icon">✔</span></p>
                              <p id="length" class="invalid">Minimum <b>8 characters</b> <span id="x-icon">✖</span><span id="check-icon">✔</span></p>
                            </div>
                            
                            <div class="imgPrev" id="defaultProfileImage">
                              <!-- <img src ="../uploads/Di_uploads/<?php echo basename($profilePicture); ?>" alt ="tested"> -->
                            </div>


                                <h3 class="UploadPic_Header">Upload your Profile Picture<?php echo basename($profilePicture); ?></h3>
                                <br>
                                <input type="file" name="profile_picture" id="profile_picture" accept="image/*">
                            </div>
                        </div>
                        <div class="modal-footer_SignUp" id="imageContainer">
                            <button class="Cancel">CANCEL</button>
                            <button type="submit" class="Submit">SUBMIT</button>
                            <div class="loader"></div>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
    function togglePassword(inputId) {
        var input = document.querySelector(inputId);
        if (input.type === 'password') {
            input.type = 'text';
        } else {
            input.type = 'password';
        }
    }
</script>
<script>
  // Capitalize every word
  function capitalizeWords(value) {
    value = value.replace(/\s{2,}/g, ' '); // Replace consecutive spaces with a single space

    return value.replace(/\b\w/g, function (match) {
      return match.toUpperCase();
    }).replace(/\b\w+/g, function (match) {
      return match.charAt(0).toUpperCase() + match.slice(1).toLowerCase();
    });
  }

  // Password validation
  var passwordInput = document.getElementById("password");
  var confirmPasswordInput = document.getElementById("confirmPassword");

  passwordInput.addEventListener("input", validatePassword);
  confirmPasswordInput.addEventListener("input", validatePassword);

  function validatePassword() {
    var password = passwordInput.value;
    var confirmPassword = confirmPasswordInput.value;

    // Regex pattern to check for at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character
    var regexPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/;

    if (regexPattern.test(password) && regexPattern.test(confirmPassword)) {
      // Passwords match and meet the validation requirements
      // You can perform additional logic here if needed
      console.log("Passwords are valid.");
    } else {
      // Passwords do not match or do not meet the validation requirements
      console.log("Passwords are invalid.");
    }
  }

  // Profile picture preview
  $("#profile_picture").change(function () {
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

  // Default profile picture preview
  var defaultImage = $('<img id="defaultProfileImage">');
    defaultImage.attr("src", "../uploads/Di_uploads/<?php echo basename($profilePicture); ?>");
    defaultImage.addClass("preview-image");
    defaultImage.css("max-width", "150px");
    defaultImage.css("max-height", "150px");
    defaultImage.css("border-radius", "50%");
    defaultImage.css("object-fit", "cover");
    defaultImage.css("border", "2px solid black"); // Add black border
    $(".imgPrev").empty();
    $(".imgPrev").append(defaultImage);

    // Test if file is selected
    $("#profile_pictureStaff").change(function () {
      var file = this.files[0];
      if (file) {
        console.log('File selected:', file.name);
      } else {
        console.log('No file selected.');
      }
    });

  var passwordInput = document.getElementById("password");
  var checkIcons = document.querySelectorAll("#check-icon");
  var xIcons = document.querySelectorAll("#x-icon");

  // When the user interacts with the password input
  passwordInput.addEventListener("focus", function () {
    document.getElementById("message").style.display = "block";
  });

  passwordInput.addEventListener("blur", function () {
    document.getElementById("message").style.display = "none";
  });

  passwordInput.addEventListener("keyup", function () {
    var lowercaseRegex = /[a-z]/;
    var uppercaseRegex = /[A-Z]/;
    var numberRegex = /[0-9]/;
    var minLength = 8;

    var lowercaseValid = lowercaseRegex.test(passwordInput.value);
    var uppercaseValid = uppercaseRegex.test(passwordInput.value);
    var numberValid = numberRegex.test(passwordInput.value);
    var lengthValid = passwordInput.value.length >= minLength;

    document.getElementById("letter").classList.toggle("invalid", !lowercaseValid);
    document.getElementById("capital").classList.toggle("invalid", !uppercaseValid);
    document.getElementById("number").classList.toggle("invalid", !numberValid);
    document.getElementById("length").classList.toggle("invalid", !lengthValid);

    for (var i = 0; i < checkIcons.length; i++) {
      checkIcons[i].style.display = "none";
    }
    for (var i = 0; i < xIcons.length; i++) {
      xIcons[i].style.display = "inline-block";
    }

    if (lowercaseValid) {
      document.getElementById("letter").querySelector("#check-icon").style.display = "inline-block";
      document.getElementById("letter").querySelector("#x-icon").style.display = "none";
    }
    if (uppercaseValid) {
      document.getElementById("capital").querySelector("#check-icon").style.display = "inline-block";
      document.getElementById("capital").querySelector("#x-icon").style.display = "none";
    }
    if (numberValid) {
      document.getElementById("number").querySelector("#check-icon").style.display = "inline-block";
      document.getElementById("number").querySelector("#x-icon").style.display = "none";
    }
    if (lengthValid) {
      document.getElementById("length").querySelector("#check-icon").style.display = "inline-block";
      document.getElementById("length").querySelector("#x-icon").style.display = "none";
    }
  });

  $(document).ready(function () {
    // Display the current profile picture as the default preview image
    // var defaultProfilePicture = $('<img id="defaultProfileImage">');
    // defaultImage.attr("src", "../uploads/Di_uploads/<?php echo basename($profilePicture); ?>");
    // defaultProfilePicture.addClass("preview-image");
    // defaultProfilePicture.css("max-width", "150px");
    // defaultProfilePicture.css("max-height", "150px");
    // defaultProfilePicture.css("border-radius", "50%");
    // defaultProfilePicture.css("object-fit", "cover");
    // defaultProfilePicture.css("border", "2px solid black");
    // $(".imgPrev").empty();
    // $(".imgPrev").append(defaultProfilePicture);

    // Update the preview image when a new file is selected
    $("#profile_picture").change(function () {
      var file = this.files[0];
      if (file) {
        var reader = new FileReader();
        reader.onload = function (e) {
          var previewImage = $("<img>");
          previewImage.attr("src", e.target.result);
          previewImage.addClass("preview-image");
          previewImage.css("max-width", "150px");
          previewImage.css("max-height", "150px");
          previewImage.css("border-radius", "50%");
          previewImage.css("object-fit", "cover");
          previewImage.css("border", "2px solid black");
          $("#profilePicturePreview").empty();
          $("#profilePicturePreview").append(previewImage);
        };
        reader.readAsDataURL(file);
      } else {
        // No file selected, display the default profile picture
        // var defaultImage = $("<img id='defaultProfileImage'>");
        // defaultImage.attr("src", "../uploads/Di_uploads/<?php echo basename($profilePicture); ?>");
        // defaultImage.addClass("preview-image");
        // defaultImage.css("max-width", "150px");
        // defaultImage.css("max-height", "150px");
        // defaultImage.css("border-radius", "50%");
        // defaultImage.css("object-fit", "cover");
        // defaultImage.css("border", "2px solid black");
        // $("#profilePicturePreview").empty();
        // $("#profilePicturePreview").append(defaultImage);
      }
    });

    $("#SignUp_Student").submit(function (event) {
  event.preventDefault();

  var username = $('#username').val();
  var password = $('#password').val();
  var confirmPassword = $('#confirmPassword').val();

  // Validate all input fields
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

  if (password !== confirmPassword) {
    alert("Passwords do not match");
    isValid = false;
  }

  // Check password requirements
  var lowercaseRegex = /[a-z]/;
  var uppercaseRegex = /[A-Z]/;
  var numberRegex = /[0-9]/;
  var minLength = 8;

  var isLowerCaseValid = lowercaseRegex.test(password);
  var isUpperCaseValid = uppercaseRegex.test(password);
  var isNumberValid = numberRegex.test(password);
  var isLengthValid = password.length >= minLength;

  if ((password !== '' || confirmPassword !== '') && (!isLowerCaseValid || !isUpperCaseValid || !isNumberValid || !isLengthValid)) {
    alert("Password does not meet the requirements");
    isValid = false;
  }

  if (isValid) {
    var formData = new FormData(this);

    // Get the current email from the hidden input
    var currentEmail = $('#currentEmailInput').val();
  formData.append('CurrentEmail', currentEmail);

  // Get the username and add it to the formData
  var username = $('#username').val();
  formData.append('Username', username);

    // Disable the submit button and show loading text
    var submitButton = $('.Submit');
    submitButton.prop('disabled', true);
    submitButton.html('<span class="loading-spinner"></span>Loading...');

    $.ajax({
      url: "./php_scripts/admin_Staffiles/check_existingStaff_Enrolled.php",
      type: "POST",
      data: formData, // Pass the formData object directly here
      dataType: "html",
      contentType: false, // Set contentType to false when using FormData
      processData: false, // Set processData to false when using FormData
      success: function (response) {
        console.log("Server response:", response);

        if (response.trim() === "username_conflict") {
          alert("The username already exists. Please choose a different one.");
          submitButton.prop('disabled', false);
          submitButton.text('SUBMIT');
          location.reload();
        } else if (response.trim() === "email_conflict") {
          alert("The email already exists. Please choose a different one.");
          submitButton.prop('disabled', false);
          submitButton.text('SUBMIT');
          location.reload();
        } else if (response.trim() === "success") {
          // No conflicts, proceed with form submission
          formSubmit(formData); // Pass the formData object to formSubmit function
        } else {
          // Unexpected response, display an error message
          alert("Error occurred during validation. Please try again.");
          submitButton.prop('disabled', false);
          submitButton.text('SUBMIT');
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error during validation AJAX call:", textStatus, errorThrown);
        alert("Error occurred during validation. Please try again.");
        submitButton.prop('disabled', false);
        submitButton.text('SUBMIT');
      }
    });
  }
});



// Function to handle form submission
function formSubmit(formData) {
  var submitButton = $('.Submit');
  $.ajax({
    url: "./php_scripts/admin_Staffiles/Edit_NEnrollStaff_update.php?email=" + encodeURIComponent(formData.get('EmailAdd')),
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      console.log("Server response after submission:", response); // Debugging: Check the response after form submission

      if (response.trim() === "username_conflict") {
        // New username already exists, show an alert
        alert('The new username already exists. Please choose a different one.');
        submitButton.prop('disabled', false);
        submitButton.text('SUBMIT');
        location.reload();

      } else {
        // Display success message
        alert("Update successful");
        // Refresh the screen
        location.reload();
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.error("Error during form submission:", textStatus, errorThrown); // Debugging: Check the error during form submission
      // Display error message
      alert("Update failed");
      submitButton.prop('disabled', false);
      submitButton.text('SUBMIT');
    }
  });
}


$(".Cancel").click(function() {
    var currentURL = new URL(window.location.href);
    currentURL.searchParams.delete('Username');
    window.history.replaceState({}, document.title, currentURL.href);
    window.location.reload();
  });
  });
  

</script>



</body>

</html>