<?php
session_start();

include("Navbar_login.html");
include("conn.php");

// echo $_POST['LastName'];
// echo $_POST['FirstName'];
// echo $_POST['MiddleName'];
// echo $_POST['Suffix'];

// unset($_SESSION['Discount']);

if (isset($_FILES['BirthcertOrId']) && $_FILES['BirthcertOrId']['error'] === UPLOAD_ERR_OK) {
    $filenamepdf = $_FILES["BirthcertOrId"]["name"];
    // Specify the desired filename
    $folder = "./uploads/pdf_Student/" . $filenamepdf;
    // Check if the uploaded file is a PDF
    $file_extension = pathinfo($filenamepdf, PATHINFO_EXTENSION);
    if ($file_extension === "pdf") {
        if (move_uploaded_file($_FILES["BirthcertOrId"]["tmp_name"], $folder)) {
           
            
            $pdfPath = $folder;
            $_SESSION['pdfPath'] = $pdfPath;
        } else {
            echo "Failed to upload PDF.";
        }
    } else {
        echo "Invalid file format. Please upload a PDF file.";
    }
} else {
    echo "No PDF uploaded or an error occurred.";
}


 $sqlTDCPrice = "SELECT * FROM `course_enrolled` WHERE `Course` = 'TDC'";

    // Prepare and execute the query
    $stmtTDCPrice = $conn->prepare($sqlTDCPrice);
    $stmtTDCPrice->execute();
    $resultTDCPrice = $stmtTDCPrice->fetchAll(PDO::FETCH_ASSOC);

  foreach ($resultTDCPrice as $rowTDCPrice) {
        // Access the "Course" column value
        $coursePrice = $rowTDCPrice["Price"];
    }
            $Discount = $_SESSION["Discount"] ?? 0;
            
            $Price = $coursePrice - ($coursePrice * ($Discount / 100));
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PDC-Enrollment</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="./modalsStyle/textbox.css?version=1" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="./design/general/index.css">
	<link rel="stylesheet" href="./design/general/navbar.css">
</head>
<style>
/* Remove background color for the voucher container */
.voucher {
    width: 21%;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 2%;
}

/* Style for the form within the voucher container */
#voucher_tdc_apply {
    display: flex;
    flex-direction: column;
}

/* Style for the hidden input fields */
#voucher_tdc_apply input[type="hidden"] {
    margin-bottom: 10px;
}

/* Style for the voucher code input field */
#voucher_tdc_apply input[name="voucherCode"] {
    padding: 12px; /* Increased padding */
    font-size: 20px;
    margin-bottom: 15px;
    border: 1px solid #2E7D32; /* Darker green border */
    border-radius: 6px;
}

/* Style for the voucher submit button */
#voucher_tdc_apply input[name="Voucher_Submit"] {
    background-color: #2E7D32; /* Dark green background color */
    color: #FFFFFF; /* White text color */
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

/* Hover effect for the submit button */
#voucher_tdc_apply input[name="Voucher_Submit"]:hover {
    background-color: #1B5E20; /* Darker green on hover */
    color: #FFFFFF; /* White text color on hover */
}


	.nav_left {
		display: flex;
		width: 50%;
		height: 100%;
		margin: 0% 2%;
	}

	.User_data_container {
		width: 100%;
		display: block;
	}

	.Right_user_data {
		width: 100%;
		display: inline-block;
	}

	.User_Full_Name {
		display: flex;
		width: 100%;
	}

	.User_Full_Name .User_fllName {
		width: 23%;
		margin: auto;
	}

	.StudentPermitNum {
		display: flex;
		width: 100%;
	}
	.PermitNum{
		width: 23%;
		margin: 0 50% 0 1%;
	}
	.input_Date {
		width: 10%;
		padding: 10px;
		font-size: 16px;
		background-color: #d9d9d9;
		height: 50%;
	}

	.stud_RegDet {
		margin-left: 1%
	}

	.wid_med {
		margin-top: 1%;
		width: 15%;
		padding: 13px;
		font-size: 16px;
		background-color: #d9d9d9;
	}

	.Enrollment_Detail {
		margin-top: 15px;
		display: flex;
	}

	.Registration_container_form {
		display: block;
		margin: auto;
		margin-top: 3%;
		width: 95%;
	}

	.Registration_container_form_title {
		text-align: center;
		font-size: 26px;
		padding-bottom: 5px;
	}

	.small_title {
		margin-top: 1%;
	}

	.box_container_pdc1 {
		display: inline-block;
	}

	input[type="checkbox"] {
		width: 25px;
		height: 25px;
	}

	.box_container_pdc1_box {
		margin: auto 3% auto 7%;
	}

	.box_container_pdc1:nth-child(1) {
		width: 25%;
		margin: auto;
	}

	.box_container_pdc1:nth-child(2) {
		width: 5%;
		margin: auto;
	}

	.box_container_pdc1:nth-child(3) {
		width: 30%;
		margin: auto;
	}

	.box_container_pdc1:nth-child(4) {
		margin: auto;
	}

	.box_container_pdc1:nth-child(5) {
		margin: auto;
	}

	.inner_box {
		height: 90px;
		width: 100%;
		padding: 0 1%;
		background-color: rgba(137, 245, 150, .2);
		display: flex;
		flex-direction: row;
		gap: 2%;
		box-shadow: 2px 7px 8px rgba(0, 0, 0, 0.3);
	}

	.time_date {
		padding: 10px;
		font-size: 16px;
		border: 1px solid #ccc;
		border-radius: 5px;
		width: 250px;
	}

	/* Style for the option elements */
	.time_date option {
		font-size: 16px;
	}

	.box_container_pdc2_box {
		margin: auto 3% auto 7%;
	}

	.box_container_pdc2:nth-child(1) {
		width: 25%;
		margin: auto;
	}

	.box_container_pdc2:nth-child(2) {
		width: 12%;
		margin: auto;
	}

	.box_container_pdc2:nth-child(3) {
		width: 30%;
		margin: auto;
	}

	.box_container_pdc2:nth-child(4) {
		margin: auto;
	}

	.box_container_pdc2:nth-child(5) {
		margin: auto;
	}
	.box_container_pdc3_box {
		margin: auto 3% auto 7%;
	}

	.box_container_pdc3:nth-child(1) {
		width: 25%;
		margin: auto;
	}

	.box_container_pdc3:nth-child(2) {
		width: 12%;
		margin: auto;
	}

	.box_container_pdc3:nth-child(3) {
		width: 30%;
		margin: auto;
	}

	.box_container_pdc3:nth-child(4) {
		margin: auto;
	}

	.box_container_pdc3:nth-child(5) {
		margin: auto;
	}
	.box_container_pdc4_box {
		margin: auto 3% auto 7%;
	}

	.box_container_pdc4:nth-child(1) {
		width: 25%;
		margin: auto;
	}

	.box_container_pdc4:nth-child(2) {
		width: 12%;
		margin: auto;
	}

	.box_container_pdc4:nth-child(3) {
		width: 30%;
		margin: auto;
	}

	.box_container_pdc4:nth-child(4) {
		margin: auto;
	}

	.box_container_pdc4:nth-child(5) {
		margin: auto;
	}

	.Long_inputs {
		margin-top: 1%;
		width: 100%;
		display: flex;
		flex-direction: row;
		gap: 1%;
	}

	.Long_inputs input[type="text"] {
		width: 40%;

	}

	input[type="email"] {
		padding: 10px;
		width: 100%;
		font-size: 20px;
		background-color: #d9d9d9;
	}

	.zip_Cit {
		margin-top: 1%;
		width: 50%;
		display: flex;
		flex-direction: row;
		gap: 2%;
	}

	.zip_Cit input[type="text"] {
		width: 49%;
	}

	.CashPayment_Detail_Container {
		width: 100%;
		margin-top: 15px;
		display: block;
	}

	.NoteRed {
		color: red;
	}

	.Payment_First_Col {
		width: 70%;
	}

	.in_payment {
		display: flex;
	}

	.in_payment .Installment_Payment {
		margin-left: 10%;
		width: 200px;
		padding: 10px;
		font-size: 16px;
		border: 1px solid #ccc;
		border-radius: 5px;
		background-color: #fff;
	}

	.Installment_Payment option {
		font-size: 16px;
	}

	.Payment_Second_Col {
		width: 30%;
		display: inline-block;
	}

	label {
		display: block;
		font-size: 25px;
		/* You can adjust the font size as needed */
		font-weight: bold;
	}

	/* Style for radio buttons */
	input[type="radio"] {
		transform: scale(1.5);
		/* You can adjust the scale factor as needed */
		margin-right: 5px;
		/* Add spacing between the radio button and the label text */
	}

	.button_Container_Registration {
		text-align: center;
		/* Center-align the buttons */
		padding: 2%;
	}input[type="file"]{
		background-color: lightgray;
    color: white;
    width: 10%;
    font-family: inherit;
    padding: 1.1rem;
    margin: 10px 0 0 0;
    align-items: center;
    text-align: center;
    border-radius:10px;
    margin-left: 1%;
    margin-bottom: 1%;
    font-size: 10px;
	}

	.PDC_enrollment_btn,
	.PDC_Reset_btn {
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
		width: 150px;
		/* Set a specific width for consistency */
	}

	.PDC_enrollment_btn {
		background-color: green;
		/* Green background color for the Enroll button */
	}

	.PDC_enrollment_btn:hover {
		background-color: #064706;
	}

	.PDC_Reset_btn {
		background-color: red;
		/* Red background color for the Cancel button */
	}

	.PDC_Reset_btn:hover {
		background-color: #520808;
	}
	.Contact_Person{
    width: 100%;
     display: flex;
     flex-direction: row;
     column-gap: 1%;
  }.Contact_Person input[type="text"]{
  width: 40%;
  }.aviSched{
		width: 90%;
		padding: 8px;
		font-size: 14px;
		background-color: none;
		height: 50%;
  }
  .large-radio {
        transform: scale(2); /* Increase the size */
        margin-right: 10px; /* Add some spacing between them */
        }

 /* Style for stacking them vertically */
   .radio-container {
        display: block; /* Make the container a block element */
        margin-bottom: 10px; /* Add spacing between the radio buttons */
        }
</style>
</style>

<body>
	<div class="Registration_container_form">
		<h2 class="Registration_container_form_title">
			ENROLLMENT INFORMATION
		</h2>
		
		   <div class="voucher">
            <form id = "voucher_tdc_apply">
        <input type="hidden" name="UsernameVouchered" placeholder="&nbsp Voucher Code" value = '<?php echo $_SESSION['username'] ?>'>
        <input type="hidden" name="voucherType" placeholder="&nbsp Voucher Type" value = "TDCvoucher">

        <input type="text" name="voucherCode" placeholder="&nbsp Voucher Code">
        <input type="submit" name="Voucher_Submit" class="tdc_voucher" value="Apply" style>
        </form>
        </div>
		
		<h2 class="small_title">Name:</h2>
		
		<div class="User_data_container">
		<!-- id="SignUp_StudentPDC" -->
			<form id="SignUp_StudentTDC_Payment" method="post" enctype="multipart/form-data">
				<div class="Right_user_data">
					<div class="User_Full_Name">
						<input type="text" class="User_fllName" name="PLastName" placeholder="&nbsp Last Name"
							pattern="[A-Za-z ]+" title="Should only contain letters"
							oninput="this.value = capitalizeWords(this.value.slice(0, 25))" maxlength="25" readonly value=<?php echo $_POST['LastName'] ?>>

						<input type="text" class="User_fllName" name="PFirstName" placeholder="&nbsp First Name"
							pattern="[A-Za-z ]+" title="Should only contain letters"
							oninput="this.value = capitalizeWords(this.value.slice(0, 25))" maxlength="25" readonly value=<?php echo $_POST['FirstName']?>>

						<input type="text" class="User_fllName" name="PMiddleName" placeholder="&nbsp Middle Name"
							pattern="[A-Za-z ]+" title="Should only contain letters"
							oninput="this.value = capitalizeWords(this.value.slice(0, 25))" maxlength="25" readonly value=<?php echo $_POST['MiddleName']?>>

						<input type="text" class="User_fllName" name="PSuffix" placeholder="&nbsp Suffix (optional)"
							pattern="[A-Za-z ]+" title="Should only contain letters"
							oninput="this.value = capitalizeWords(this.value.slice(0, 25))" maxlength="25" readonly value=<?php echo $_POST['Suffix']?>>
					</div>

				</div>
		</div><br><br><br>
		<h2>Course Enrolled:</h2>
		<div class="Enrollment_Detail">
			<div class="box_container_pdc1_box">
			</div>
			<div class="inner_box">
				<div class="box_container_pdc1">
					<h3>Theoretical Driving Course (TDC)</h3>
				</div><div class="box_container_pdc1">
				</div>
				<div class="box_container_pdc1">
					Aspiring drivers are now required to attend 15-hour Theoretical Driving Course before applying for student permits.
				</div>
				<div class="box_container_pdc1">
				Php 1,000
				</div>
				<div class="box_container_pdc1">
				<select class="aviSched" name="sched" id="available-schedule" required>
   					 <?php
   					 $querySched = "SELECT * FROM u896821908_bts.tdc_schedule WHERE Slot >= 1";
   					 $stmtSched = $conn->prepare($querySched);
   					 $stmtSched->execute();
   					 $scheduleData = $stmtSched->fetchAll(PDO::FETCH_ASSOC);
   					 ?>


    				<?php if (count($scheduleData) > 0) : ?>
						<option value="" disabled selected hidden>Choose Schedule</option>
    				    <?php foreach ($scheduleData as $row) :
    				        $formattedOption = "{$row['schedule1']} -- {$row['schedule2']} | {$row['time1']} -- {$row['time2']}";
    				    ?>
    				        <option><?= $formattedOption; ?></option>

    				    <?php endforeach; ?>
    				<?php else : ?>
        <option value="" disabled>No slot available</option>
    				<?php endif; ?>

					</select>

				</div>
			</div>
		</div>


		<div class="CashPayment_Detail_Container">
		    
     
        
        <h2 class="small_title">Total Payment:</h2><br>
			<div class="Payment_info">
			<!--DITO DETAIL NG BABAYRAN NI STUDENT DITO DETAIL NG BABAYRAN NI STUDENT DITO DETAIL NG BABAYRAN NI STUDENT DITO 
			DETAIL NG BABAYRAN NI STUDENT DITO DETAIL NG BABAYRAN NI STUDENT DITO DETAIL NG BABAYRAN NI STUDENT-->
			<input type = "hidden" value = '<?php echo $Price ?>' name = "TDC_Price">
					<h3>Php <?php echo $Price ?></h3>
					<br>
		</div>
			
			  <div class="radio-container">
					<label>
						<input type="radio" class="large-radio" name="radio-group" value = "GCASH" required> GCASH
					</label>
				</div>

				<div class="radio-container">
					<label>
						<input type="radio" class="large-radio" name="radio-group" value = "OnPersonCash" required> Cash via Branch in-Person Payment
					</label>
				</div>
		</div>

		<div>		
		<input type="hidden" value="<?php echo $_POST['Birthdate']; ?>" name="BirthdateP">
<input type="hidden" value="<?php echo $_POST['CivilStatus']; ?>" name="CivilStatusP">
<input type="hidden" value="<?php echo $_POST['ContactNumber']; ?>" name="ContactNumberP">
<input type="hidden" value="<?php echo $_POST['SEX']; ?>" name="SEXP">
<input type="hidden" value="<?php echo $_POST['CompleteAddress']; ?>" name="CompleteAddressP">
<input type="hidden" value="<?php echo $_POST['City']; ?>" name="CityP">
<input type="hidden" value="<?php echo $_POST['ZipCode']; ?>" name="ZipCodeP">
<input type="hidden" value="<?php echo $_POST['Citizenship']; ?>" name="CitizenshipP">
<input type="hidden" value="<?php echo $_POST['ContactPerson']; ?>" name="ContactPersonP">
<input type="hidden" value="<?php echo $_POST['ConPerson']; ?>" name="ConPersonNumP">
<input type="hidden" value="<?php echo $_POST['Relationship']; ?>" name="RelationshipP">
<input type="hidden" value="<?php echo $_POST['radio-group']; ?>" name="BirthCertype">

		</div>	
  
		<div class="button_Container_Registration">
			<input type="submit" name="TDC_Submit" class="PDC_enrollment_btn" value="Enroll">
			<input type="Reset" name="TDC_Reset" class="PDC_Reset_btn" value="Cancel" id="cancelButton2">
		</div>
		</form>

		<!-- The contact modal -->
		<div id="modal_cntct" class="modal">
			<div class="modal-content">
				<span class="close-button">&times;</span>
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
					<p>btspateros@gmail.com</p>
				</div>
			</div>
		</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="modal_script_index.js"></script>
<script src="script_login_TDC.js"></script> 
<script>

$(document).ready(function(){
    $("#voucher_tdc_apply").submit(function(e){
        e.preventDefault(); // Prevent the default form submission

        // Serialize form data
        var formData = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "voucher.php", // Replace with your backend script URL
            data: formData, // Send the serialized form data
            success: function(response){
                // Handle the response from the server
                console.log(response);
              if (response.includes("This voucher is for PDC")) {
                 alert("This voucher is for PDC");
                }
                
                if (response.includes("No slot")) {
                 alert("No more slot for this voucher");
                }
                
                 if (response.includes("Already Have Voucher")) {
                 alert("Already Have Voucher for TDC");
                }
                 if (response.includes("Voucher Applied")){
                 alert("Voucher Applied");
                 }

// Wait for the alert to be dismissed, then reset and reload
setTimeout(function() {
    $("#voucher_tdc_apply")[0].reset();
    location.reload();
}, 500);

                // You can update the DOM or perform other actions based on the response
            },
             error: function(jqXHR, textStatus, errorThrown) {
        // handle error
        console.log("AJAX Error:", textStatus, errorThrown);
    }
        });
    });
});



document.getElementById("cancelButton2").addEventListener("click", function() {
    var isTrue = true;

    if (isTrue) {
        // Clear the form data by replacing the current state
        var newState = {};
        history.replaceState(newState, document.title, window.location.href);

        // Use location.replace for immediate navigation
        location.replace("../Enrollment_TDC.php");
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
</script>

</html>