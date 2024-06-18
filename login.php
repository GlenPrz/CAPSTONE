<?php
session_start();
include("Navbar_login.html");
include("conn.php");
unset($_SESSION['availability_updated']);
unset($_SESSION['AdminSessionDash']);
unset($_SESSION['StudentSessionDash']);
unset($_SESSION['Discount']);

session_destroy();

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
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./design/general/index.css">
  <link rel="stylesheet" href="./design/general/navbar.css">
  <link rel="stylesheet" href="./modalsStyle/modal_signup.css">
  <link rel="stylesheet" href="./modalsStyle/modal_contactUs.css">
  
<style>
    .input-error {
  box-shadow: 0 0 5px red;
}
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
body {
  width: 100%;
  height: 100vh; /* This ensures the gradient covers the entire screen */
  background: rgb(79, 130, 77);
  background: linear-gradient(
    335deg, /* Change the angle to 0 degrees for bottom to top */
    rgba(44, 117, 41, 1) 1%,
    rgba(59, 149, 56, 1) 7%, /* Dark green at the bottom */
    rgba(197, 249, 188, 1) 20%, /* Light green at 15% */
    rgba(243, 255, 238, 1) 30%, /* Very light green at 30% */
    rgba(243, 255, 238, 1) 40%, /* Very light green at 30% */
    rgba(255, 255, 255, 1) 45%, /* Additional white at 45% */
    rgba(255, 255, 255, 1) 60%, /* Additional white at 60% */
    rgba(255, 255, 255, 1) 100% /* Additional white at 75% */
  );
}


}
.User_login{
   color: black;
}
.User_forgot{
   color: black;
   font-weight: 400;
}
.Email_forgot{
   color: black;
   font-weight: 400;
}
.forgot_mdl_content {
      width: 100%;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
	  text-align: center;
    }

    .forgot_mdl_content h2 {
	  margin-bottom: 5%;
      text-align: center;
      color: #333;
    }

	.cancel-btn,
    .submit-btn {
      padding: 15px;
	  font-size: 16px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 20%;
    }
    .cancel-btn {
      background-color: red;
      color: #fff;
    }

    .cancel-btn:hover {
      background-color: darkred;
    }

    .submit-btn {
      background-color: #4CAF50;
      color: #fff;
    }

    .submit-btn:hover {
      background-color: #224f24;
    }
	.close-button_forgot {
      font-size: 22px;
      cursor: pointer;
      color: #aaa;
      float: right;
      padding: 4px;
    }

    .close-button_forgot:hover {
      color: #000;
    }
	.modal-content{
		border-radius: 8px;
	}

  </style>

</head>

<body>
  <div class="Content_container">
    <div class="Content_left">
      <div>
        <img src="img/drive-download-20230614T125330Z-001/LOGIN PAGE.png">
        <h2>Need to Learn to Drive?</h2>
        <h2>Sign Up Now!</h2>
        <!-- <button id="myBtn_popUPQuestion">Open Modal</button> -->
        <center>
          <button class="SignUp_btn" id="btn_sign">Sign Up</button>
        </center>
      </div>
    </div>
    <div class="Content_right">
      <div>
      <form id = "loginForm" action="STD_login.php" method="POST">
  <input type="text" name="username" placeholder="&nbsp Username" class="User_login">
  <br>
    <input type="password" name="password" placeholder="&nbsp; Password" class="Pass_login password-input">
    
  <center>
    <a onclick="openForgot_modal()" id="ForgotPassModal">Forgot Password</a>
    <button type="submit" class="Login_btn" id="">Login</button>
  </center>

</form>

      </div>
    </div>
  </div>



 <!-- Forgot pass modal -->

	<div id="modalforgot" class="modal">
	  <div class="modal-content">
		<br>
		<div class="forgot_mdl_content">
		<span class="close-button_forgot" onclick="closeForgot_modal()">&times;</span>
		<center>
		<h2>FORGOT PASSWORD </h2>
		 <form id="forgotForm">
          <input type="text" name="username" placeholder=" Username" class="User_forgot"><br><br>
          <input type="text" name="email" placeholder=" Email" class="Email_forgot"><br><br>
          <button type="button" class="cancel-btn" onclick="closeForgot_modal()">Cancel</button>
          <button type="button" class="submit-btn" onclick="checkAndSubmit()">Submit</button>
        </form>
		</center>
		</div>
	  </div>
	</div>

   	<!-- The contact modal -->
	<div id="modal_cntct" class="modal">
	    <form id = "contact_form">
		<div class="modal-content">
			<span class="close-button">&times;</span>
			<div class="inputs">
        <h2>Contact Us</h2>
        <div class="form-group">
            <label for="first-name">First Name:</label>
            <input type="text" id="first-name" name="first-name" required pattern="[A-Za-z]+" title="First Name should contain only letters">
        </div>
        <div class="form-group">
            <label for="last-name">Last Name:</label>
            <input type="text" id="last-name" name="last-name" required pattern="[A-Za-z]+" title="Last Name should contain only letters>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
<input type="email" id="email" name="email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Enter a valid email address">
        </div>
        <div class="form-group">
            <label for="contact-number">Contact Number:</label>
<input type="text" id="contact-number" name="contact-number" required pattern="09\d{9}" title="Enter a valid 11-digit number starting with 09" maxlength="11">
        </div>
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea id="message" name="message" required maxlength="255"></textarea>
        </div>
        <center><button type="submit">Submit</button></center>
    </div><br>
			<div class="contact">
			    <div class="contact-info">
				<img class="contact-icon" src="./img/caller.png" alt="Contact Number Icon">
				<p>09215447612 / 02-87230574</p>
			</div>
			<div class="contact-info">
				<img class="contact-icon" src="./img/fbitch.png" alt="Facebook Icon">
				<p>BTS Driving School-Pateros</p>
			</div>
			<div class="contact-info">
				<img class="contact-icon" src="./img/mapa.png" alt="Address Icon">
				<p>C & N BLDG. ALMEDA ST. SAN ROQUE, PATEROS,
					METRO MANILA</p>
			</div>
			<div class="contact-info">
				<img class="contact-icon" src="./img/emoil.png" alt="Email Icon">
				<p>besttrainingschool101@gmail.com</p>
			</div>
			</div>
		</div>
		</form>
	</div>

 

  <!-- The Modal Signup-->
 <center>
   <div id="myModal" class="modal_SignUp">
    <!-- Modal content -->
    <div class="modal-content_Signup">
      <div class="modal-header_SignUp">
        <span class="close_SignUp">&times;</span>
      </div>
      <div class="modal-body_SignUp">
        <div class="container">
          <form id="SignUp_Student" method="post" enctype="multipart/form-data">
            <div class="Personal Data">
            <header2>
              <p class="headers">Register</p>
              <p class="headers">Accounts Credentials</p>
            </header2>
            <div class="fourth_row_input">

<input type="email" name="EmailAdd" id="emailInput" placeholder="&nbsp;Email Address" pattern="[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}" title="Invalid email address" required>
              
<input type="text" name="Username" placeholder="&nbsp;Username" pattern="^[^\s]+$" maxlength="10" class="signupUser" required title="Username must be at least 3 characters long and should not contain spaces.">
              <input type="password" name="pass" id="password" placeholder="&nbsp Password">
              <input type="password" name="Cpass" id="confirmPassword" placeholder="&nbsp Confirm Password">
				<br><br>
              <div id="message">
				  <h3>Password must contain the following:</h3>
				  <p id="letter" class="invalid">A <b>lowercase</b> letter <span id="x-icon">✖</span><span id="check-icon">✔</span></p>
				  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter <span id="x-icon">✖</span><span id="check-icon">✔</span></p>
				  <p id="number" class="invalid">A <b>number</b> <span id="x-icon">✖</span><span id="check-icon">✔</span></p>
				  <p id="length" class="invalid">Minimum <b>8 characters</b> <span id="x-icon">✖</span><span id="check-icon">✔</span></p>
			  </div>


              <div class="imgPrev" id="defaultProfileImage">
              </div>
              <div>
                <h3 class="UploadPic_Header">Upload your Profile Picture</h3>
                <br>
                <input type="file" name="profile_picture" id="profile_picture" accept="image/*" required>
              </div>
            </div>
				<input type="hidden" name="otp" value=1 placeholder=1>      
            <div class="modal-footer_SignUp">
              <button class="Cancel" onclick="cancelingForm()">CANCEL</button>
              <button type="submit" class="Submit">SUBMIT</button>
              <div class="loader"></div>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
 </center> 
</div>


	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="modal_script_index.js"></script>
  <script src="script_login_index.js"></script>

  <!--For capitalization of every word-->
  <script>

    function capitalizeWords(value) {
      value = value.replace(/\s{2,}/g, ' '); // Replace consecutive spaces with a single space

      return value.replace(/\b\w/g, function (match) {
        return match.toUpperCase();
      }).replace(/\b\w+/g, function (match) {
        return match.charAt(0).toUpperCase() + match.slice(1).toLowerCase();
      });
    }

    var passwordInput = document.getElementById("password");
var checkIcons = document.querySelectorAll("#check-icon");
var xIcons = document.querySelectorAll("#x-icon");

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

  </script>
  
	<script>
	
$(document).ready(function(){
    $("#contact_form").submit(function(event){
        // Prevent the default form submission
        event.preventDefault();

        // Serialize form data
        var formData = $(this).serialize();

        // Send the form data to the server using AJAX
        $.ajax({
            type: "POST",
            url: "../contact_us_insert.php",
            data: formData,
            success: function(response){
                // Handle the successful AJAX request here
                console.log(response);

                // Check the response from the server
                if(response.trim() === "success"){
                    // Show success alert
                    alert("Data inserted successfully!");
$("#modal_cntct").hide();

                    // Clear the form
                    $("#contact_form")[0].reset();
                } else {
                    // Handle other responses if needed
                    alert("Insert failed. Please try again.");
                }
            },
            error: function(error){
                // Handle errors here
                console.error(error);
                alert("An error occurred. Please try again later.");
            }
        });
    });
});
	
	
	
	
	
	  function openForgot_modal() {
		var modal = document.getElementById("modalforgot");
		modal.style.display = "block";
		  }

	  function closeForgot_modal() {
		var modal = document.getElementById("modalforgot");
		modal.style.display = "none";
	  }

	  function checkAndSubmit() {
		var username = document.querySelector('.User_forgot').value;
		var email = document.querySelector('.Email_forgot').value;

		// Check if the provided username and email exist in the student table
		$.ajax({
			type: 'POST',
			url: 'forgotP_process_form.php',
			data: { username: username, email: email },
			success: function (response) {
				if (response === 'exists') {
					// Data exists
					alert('Wait for the temporary password that we will email to you');

					// Redirect to another page passing the form values as parameters
					window.location.href = 'Forgot_pass.php?username=' + encodeURIComponent(username) + '&email=' + encodeURIComponent(email);

					// Alternatively, you can submit the form if needed
					// $('#forgotForm').submit();
				} else {
					// Data does not exist
					alert('Username and Email do not exist.\nPlease try again.');
				}
			},
			error: function () {
				alert('Error checking data.');
			}
		});
	}

	</script>

  <script>
        // Function to prevent navigation via the back button
        function disableBackButton() {
            window.history.pushState(null, '', window.location.href);
            window.onpopstate = function(event) {
                window.history.pushState(null, '', window.location.href);
            };
        }

        // Call the function when the page loads
        window.onload = function() {
            disableBackButton();
        };

   
    </script>
	<script>
	function cancelingForm() {
            // Get the form element
            var form = document.getElementById("SignUp_Student");

            // Reset the form
            form.reset();
            location.reload();
        }
	
	
	
	 function data_success() {
            // Your JavaScript function logic here
            alert("You're now registered. You can now login.");

		// Reset the URL to the original state (without "success") after 2 seconds
            setTimeout(function() {
                history.replaceState({}, document.title, window.location.pathname);
            }, 1);
        }
		 function data_failed() {
            // Your JavaScript function logic here
            alert("Data didn't store to the database.");

		// Reset the URL to the original state (without "success") after 2 seconds
            setTimeout(function() {
                history.replaceState({}, document.title, window.location.pathname);
            }, 1);
        }
        // Check if the URL contains "success" and trigger the function
        if (window.location.href.indexOf("inserted") !== -1) {
             data_success();
        }else if(window.location.href.indexOf("!inserted") !== -1) {
            data_failed();
        }
	</script>
</body>

</html>