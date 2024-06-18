<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BTS Driving school</title>
	<link rel="icon" type="image/x-icon" href="../img/favicon.ico">
	</head>
<style>
	body{
	background-color: rgba(200, 255, 189, 0.2);
	}
	.hidden_form{
	display: none;
	}
    .hidden-input {
        display: none;
    }
.otp-container {
    text-align: center;
    margin: 8% auto;
    width: 30%;
	height: 550px;
    padding: 20px;
    border-radius: 10px;
    background-color: #ffff;
	box-shadow: 1px 6px 10px rgba(0, 0, 0, 0.3);
}

.digits{
margin: 15% auto 5%;
}
.otp-input {
    width: 9%;
    height: 53px;
    text-align: center;
    font-size: 22px;
    margin: 0 1.5%;
    border: 2px solid #4CAF50; /* Green border color */
    border-radius: 5px;
    background-color: #fff;
}

.submit_OTP {
    padding: 10px 25%;
	margin: 0 1% 2%;
	font-size: 18px;
    background-color: #4CAF50; /* Green background color */
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.submit_OTP:hover{
	background-color:#0b470d;
}
p {
	font-size: 18px;
}

#sendButton {
	  background: none;
	  border: none;
	  padding: 0 10px;
	  border-radius: 5px;
	  font: inherit;
	  color: #199e1e; /* You can change the color to match your design */
	  cursor: pointer;
	  font-size: 20px;
}
#sendButton:hover{
		color:white;
		background-color: #37873b;
}
.back-button {
    text-decoration: none;
    padding: 10px 20px;
    background-color: #e81c1c;
    color: #fff;
    border-radius: 5px;
	border: none;
	float: left;
	margin-top: 14%;
	margin-left: 2%;
  }

  .back-button:hover {
    background-color: #4f0909;
	color: #fff;
  }
  b{
  color: #29992f; 
  }
  </style>
  
<body>
<button id="generateButton" class="hidden-input">Generate Random Value</button>
    <p id="randomValue" class="hidden-input"></p>
    
    

<?php
session_start();
	$username = $_SESSION['Username_EV'] ?? '';
    $email = $_SESSION['EmailAdd_EV'] ?? '';
    $pass = $_SESSION['pass_EV'] ?? '';
    $profpic = $_SESSION['profilepicture_EV'] ?? '';
	$otp = $_SESSION['otp_EV'] ?? '';
	
	

if (isset($_POST['send'])) {
    // Get the random value from the URL parameter
    $randomValue = $_GET['value'];

}
?>



<form id="insert_data" method="post" class="hidden_form" action="sign_in_dataInsert.php">
	<input type="hidden" name="email" value="<?php echo $email; ?>">
    <input type="hidden" name="username" value="<?php echo $username; ?>">
    <input type="hidden" name="password" value="<?php echo $pass; ?>">
	<input type="hidden" name="pic" value="<?php echo $profpic; ?>">
    <input type="submit" value="Submit">
</form>





    
    <?php
    $Sesh_otp = $_SESSION['otp'] ?? '';
	

    ?>
	<div class="otp-container"><br><br>
	<h2>Verify Your Gmail</h2>
	<p>We emailed you the six(6) digit code to <b><?php echo $email;?></b><br>Enter the code below to verify your email address.</p>
		<form class="" action="" method="post">
		<div class="digits">
				<input type="text" name="digit1" class="otp-input" maxlength="1" required oninput="this.value = this.value.replace(/[^0-9]/g, '')" >
                <input type="text" name="digit2" class="otp-input" maxlength="1" required oninput="this.value = this.value.replace(/[^0-9]/g, '')" disabled>
                <input type="text" name="digit3" class="otp-input" maxlength="1" required oninput="this.value = this.value.replace(/[^0-9]/g, '')" disabled>
                <input type="text" name="digit4" class="otp-input" maxlength="1" required oninput="this.value = this.value.replace(/[^0-9]/g, '')" disabled> 
                <input type="text" name="digit5" class="otp-input" maxlength="1" required oninput="this.value = this.value.replace(/[^0-9]/g, '')" disabled>
                <input type="text" name="digit6" class="otp-input" maxlength="1" required oninput="this.value = this.value.replace(/[^0-9]/g, '')" disabled>
		</div>	
			<button type="submit" name="compareOTP" class ="submit_OTP">Submit</button>
		</form>
	
	
		 <form class="" action="send.php" method="post" id="Send_form">
			<input type="hidden" class="hidden-input" name="email" value="<?php echo $email; ?>">
			<input type="hidden" class="hidden-input" name="subject" value="BTS Driving School: OTP">
			<input type="hidden" class="hidden-input" name="message" value="000000">
			<p style="margin:0 auto 1%;">Didn't get any code from us?</p>
			<?php echo'<button type="submit" name="send" id="sendButton">Resend Code</button>';
				if ($otp == 1) 
				{
					echo "<script>
						window.onload = function() {
							generateRandomNumber(); // Generate a random number when the page loads
						};

						// Generate a random 6-digit number
						function generateRandomNumber() {
							var randomValue = Math.floor(Math.random() * 1000000); // Generates a number between 0 and 999999
							randomValue = randomValue.toString().padStart(6, '0'); // Ensure it's a 6-digit number
							document.getElementById('randomValue').textContent = 'Random Value: ' + randomValue;

							// Set the random value as the value of the 'message' input field
							document.querySelector('input[name=\"message\"]').value = randomValue;
						}
						
						generateRandomNumber();

						function submitFormIfCondition() {
							// Your condition here, for example:
							if (true) {
								document.getElementById('sendButton').click(); // Trigger button click
							}
						}

						submitFormIfCondition();
					</script>";

					
					$_SESSION['otp_EV'] = 0;
				}
			?>
		</form>
		<button id="backButton" class="back-button">Back</button>
	</div>
    <?php
    if (isset($_POST['compareOTP'])) {
		
        $userOTP = $_POST['digit1'] . $_POST['digit2'] . $_POST['digit3'] . $_POST['digit4'] . $_POST['digit5'] . $_POST['digit6'];
		
        if ($userOTP === $Sesh_otp) {
			echo "<script>alert('OTP Matched!');</script>";
			echo "<script>document.getElementById('insert_data').submit();</script>";
		} else {
			echo "OTP Did Not Match.";
			echo "<script>alert('OTP Did Not Match.');</script>";
		}
    }
    ?>
	<script>
	document.getElementById("backButton").addEventListener("click", function() {
	  window.location.href = "../login.php";
	});
	</script>
	
	<script>
    const inputFields = document.querySelectorAll('.otp-input');
    const submitButton = document.querySelector('.submit-button');

    inputFields.forEach((input, index) => {
        input.addEventListener('input', () => {
            if (input.value.length === 1) {
                inputFields[index + 1]?.removeAttribute('disabled');
                inputFields[index + 1]?.focus();
            }

            // Check if the Backspace key was pressed
            if (event.inputType === 'deleteContentBackward') {
                // If Backspace key is pressed, go back to the previous field
                if (index > 0) {
                    inputFields[index - 1].removeAttribute('disabled');
                inputFields[index - 1].focus();
                }
            } else if (input.value.length === 0 && index < 6)  {
                // If the field is empty and not the first field, go back to the previous field
                inputFields[index - 1].removeAttribute('disabled');
                inputFields[index - 1].focus();
            }

            if (inputFields.every(field => field.value.length === 1)) {
                submitButton.removeAttribute('disabled');
            } else {
                submitButton.setAttribute('disabled', 'disabled');
            }
        });
    });

    // Enable the last input when any input is focused
    inputFields.forEach((input, index) => {
        input.addEventListener('focus', () => {
            inputFields[5].removeAttribute('disabled');
        });
    });
</script>



<script>
        window.onload = function() {
    generateRandomNumber(); // Generate a random number when the page loads
};

// Generate a random 6-digit number
function generateRandomNumber() {
    var randomValue = Math.floor(Math.random() * 1000000); // Generates a number between 0 and 999999
    randomValue = randomValue.toString().padStart(6, '0'); // Ensure it's a 6-digit number
    document.getElementById('randomValue').textContent = 'Random Value: ' + randomValue;

    // Set the random value as the value of the "message" input field
    document.querySelector('input[name="message"]').value = randomValue;
}

    </script>


</body>
</html>