<?php
session_start();
include("../conn.php");

// echo $_POST['LastName'];
// echo $_POST['FirstName'];
// echo $_POST['MiddleName'];
// echo $_POST['Suffix'];

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
	<link href="../modalsStyle/textbox.css?version=1" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../design/general/index.css">
	<link rel="stylesheet" href="../design/general/navbar.css">
</head>
<style>
	.Submit_btn{
		background-color: #4CAF50;
		color:white;
		font-size: 20px;
		padding: 10px 25px;
		border-radius: 10px;
	}
	.Cancel_btn{
		background-color: maroon;
		color:white;
		font-size: 20px;	
		padding: 10px 25px;
		border-radius: 10px;
	}

	.QR {
		width: 30%;
		float: right;
		margin-top: 5%;
		margin-bottom: 5%;
		display: flex;
		margin-right: 5%;
	}

	.QR img {
		width: 100%
	}

	.fillup {
		width: 60%;
		height: 100%;
		float: left;
		margin-top: 5%;
		margin-bottom: 5%;
		margin-left: 1%;
		display: block;
		font-size: 24px;
	}

	.file {
		background-color: #4CAF50;
		color: white;
		border: none;
		padding: 15px 20px;
		border-radius: 20px;
		font-size: 18px;
		cursor: pointer;
		width: 30%;
	}

	input[type="file"].file  {
		display: hidden;
	}

	.inside {
		margin-left: 1%;
		margin-right: 1%;
		margin-bottom: 1%;
	}

	.main_body {
		width: 100%;
	}
</style>

<body>
	<div class="main_body">
		<div class="QR">
			<center><img src="..\img\drive-download-20230614T125330Z-001\gcash.jpg" alt="tdc Image"></center>
		</div>
		<div class="fillup">
			<div class="inside">
				<h2>Online Payment</h2>
				<p>Please fill up the form and scan the QR code to pay</p><br><br>
				
				<form id="GCASH_Form" enctype="multipart/form-data">
					<label for="student_name">Student Name:</label>
					<input type="hidden" name="student_id_GCASH" value="<?php echo $_SESSION['idStudent']?>">
					<input type="hidden" name="student_username_GCASH" value="<?php echo $_SESSION['username']?>">

					<input type="text" id="student_name" name="student_name"
						value="<?php echo $_SESSION['STD_Fullname']; ?>" readonly>
					<br><br>

<label for="Reference_number">Reference Number:</label>
				<input type="text" id="Reference_number" name="Reference_number" pattern="[^\s]{3,13}" title="Should be between 3 and 13 characters, no spaces" maxlength="13" minlength="3" required><br><br>

					<label for="Gcash_number">Gcash Number:</label>
					<input type="text" id="Gcash_number" name="gcash_number" pattern="09\d{9}"
              title="Should only contain 11 digits starting with 09" maxlength="11" minlength="11" required><br><br>

					<center>
						<label for="Gcash_receipt">Upload the Screenshot of your reciept here</label>
						<br><br>
						<div class="file">
							<label for="Gcash_receipt">Upload File</label>
							<input type="file" name="profile_picture" id="profile_picture" accept="image/*" required>

						</div>
						<br><br>
						<input type="submit" class="Submit_btn" name = "GCASH_Submit_btn" value = "SUBMIT">
						<input type="reset" class="Cancel_btn" name="GCASH_Cancel_btn" value="CANCEL" id="backButton">

					</center>
					<br><br>
					<center>
						<h3>Note: </h3>
						<p>If you failed to upload your reciept you can send an email to:
							besttrainingschool101@gmail.com</p>
					</center>
				</form>

			</div>
		</div>
	</div>

</body>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script>
  $(document).ready(function () {
  $("#GCASH_Form").submit(function (event) {
    event.preventDefault(); // Prevent the default form submission

    // Create a FormData object
    var formData = new FormData(this);

    // Log the form data to the console (including files)
    // for (var pair of formData.entries()) {
    //   console.log(pair[0] + ": " + pair[1]);
    // }

    // Perform the AJAX request
    $.ajax({
      url: "../uploading_GCASH_Receipt.php", // Replace with your server-side script URL
      type: "POST", // Change this to "GET" if your server-side script expects GET requests
      data: formData,
      contentType: false, // Required for FormData
      processData: false, // Required for FormData
      success: function (response) {
        // Handle the response from the server here
        console.log(response); // You can log the response or update the page accordingly

        // Example: Display a message on success
        if (response.includes("success")) {
          alert("Form submitted successfully!");
          // You can also redirect or reload the page if needed
          window.location.href = './STD_ACC_PAYABLE.php';
        } else {
          alert("Form submission failed. Please try again.");
        }
      },
      error: function (error) {
        // Handle the error here
        console.error("Error:", error);
      },
    });
});


$("#backButton").click(function(){
      // Call the history.back() function when the button is clicked
      history.back();
    });
});



</script>


</html>