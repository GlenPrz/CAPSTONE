<?php
session_start();
include("Navbar_login.html");
include("conn.php");

// unset($_SESSION['Discount']);

$sqlInfoData = "SELECT * FROM u896821908_bts.course_enrolled;";
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
	$VechileArray[] = $row['Vechile(Type)'];
	$InfoArray[] = $row['Info'];
	$PriceArray[] = number_format($row['Price'], 2);
}


$flagM_Manual = false;
$flagM_Auto = false;
$flagC_Manual = false;
$flagC_Auto = false;

$PDCM_ACost = 0;
$PDCM_MCost = 0; 
$PDCC_MCost = 0; 
$PDCC_ACost = 0;

$EnrollingforM = '';
$EnrollingforCM = '';

// echo $_POST['PDCCar'] ?? '';
// echo $_POST['PDCMotor'] ?? '';

function convertToFloat($value) {
    $cleanedValue = str_replace(',', '', $value);
    return floatval($cleanedValue);
}

if (isset($_POST['PDCMotor'])) {
    if ($_POST['PDCMotor'] == 'Motorcycle_Manual') {
        $PDCM_MCost = convertToFloat($PriceArray[0]);
        $flagM_Manual = true;
        $EnrollingforM = 'Motorcycle_Manual';
    } elseif ($_POST['PDCMotor'] == 'Motorcycle_Automatic') {
        $PDCM_ACost = convertToFloat($PriceArray[2]);
        $flagM_Auto = true;
        $EnrollingforM = 'Motorcycle_Automatic';
    }
}

if (isset($_POST['PDCCar'])) {
    if ($_POST['PDCCar'] == 'Car_Manual') {
        $PDCC_MCost = convertToFloat($PriceArray[1]);
        $flagC_Manual = true;
        $EnrollingforCM = 'Car_Manual';
    } elseif ($_POST['PDCCar'] == 'Car_Automatic') {
        $PDCC_ACost = convertToFloat($PriceArray[3]);
        $flagC_Auto = true;
        $EnrollingforCM = 'Car_Automatic';
    }
}

$TotalPdc = $PDCM_MCost + $PDCC_MCost + $PDCM_ACost + $PDCC_ACost;
$Discount = $_SESSION["Discount"] ?? 0;
            
            $TotalPdc = $TotalPdc - ($TotalPdc * ($Discount / 100));
            
$stdperNum1 = $_POST["StdperNum1"];
$stdperNum2 = $_POST["StdperNum2"];
$stdperNum3 = $_POST["StdperNum3"];

$combinedValue = $stdperNum1 . $stdperNum2 . $stdperNum3;


if (isset($_FILES['StudentPermit']) && $_FILES['StudentPermit']['error'] === UPLOAD_ERR_OK) {
    $filenamepdf = $_FILES["StudentPermit"]["name"];
    // Specify the desired filename
    $folder = "./uploads/pdf_Student/" . $filenamepdf;
    // Check if the uploaded file is a PDF
    $file_extension = pathinfo($filenamepdf, PATHINFO_EXTENSION);
    if ($file_extension === "pdf") {
        if (move_uploaded_file($_FILES["StudentPermit"]["tmp_name"], $folder)) {
            $pdfPath = $folder;
			$_SESSION['pdfPathPDC'] = $pdfPath;
			// echo  $_SESSION['pdfPathPDC'];

        } else {
            // echo "Failed to upload PDF.";
        }
    } else {
        // echo "Invalid file format. Please upload a PDF file.";
    }
} else {
    // echo "No PDF uploaded or an error occurred.";
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

/* Remove background color for the voucher container */
.voucher {
    padding: 20px;
    border-radius: 8px;
}

/* Style for the form within the voucher container */
#voucher_pdc_apply {
    display: flex;
    flex-direction: column;
}

/* Style for the hidden input fields */
#voucher_pdc_apply input[type="hidden"] {
    margin-bottom: 10px;
}

/* Style for the voucher code input field */
#voucher_pdc_apply input[name="voucherCode"] {
    padding: 25px; /* Increased padding */
    font-size: 20px;
    margin-bottom: 15px;
    border: 1px solid #2E7D32; /* Darker green border */
    border-radius: 6px;
}

/* Style for the voucher submit button */
#voucher_pdc_apply input[name="Voucher_Submit"] {
    background-color: #2E7D32; /* Dark green background color */
    color: #FFFFFF; /* White text color */
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

/* Hover effect for the submit button */
#voucher_pdc_apply input[name="Voucher_Submit"]:hover {
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
		width: 12%;
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
		.Hidder_Enrolled{
		display: none;
	}.voucher{
	    display:flex;
	    width:50%;
	}
</style>
</style>

<body>
	<div class="Registration_container_form">
		<h2 class="Registration_container_form_title">
			ENROLLMENT INFORMATION 
		</h2>
		
		<div class="voucher">
            <form id = "voucher_pdc_apply">
        <input type="hidden" name="UsernameVouchered" placeholder="&nbsp Voucher Code" value = '<?php echo $_SESSION['username'] ?>'>
        <input type="hidden" name="voucherType" placeholder="&nbsp Voucher Type" value = "PDCvoucher">

        <input type="text" name="voucherCode" placeholder="&nbsp Voucher Code">
        <input type="submit" name="Voucher_Submit" class="pdc_voucher" value="Apply">
        </form>
        </div>
		
		<h2 class="small_title">Name:</h2>
		<div class="User_data_container">
			
			<form id="SignUp_StudentPDC" method="post" enctype="multipart/form-data">
				<div class="Right_user_data">
					<div class="User_Full_Name">
						<input type="text" class="User_fllName" name="LastName" placeholder="&nbsp Last Name"
							pattern="[A-Za-z ]+" title="Should only contain letters"
							oninput="this.value = capitalizeWords(this.value.slice(0, 25))" maxlength="25" readonly value = <?php echo $_POST['LastName']; ?> >

						<input type="text" class="User_fllName" name="FirstName" placeholder="&nbsp First Name"
							pattern="[A-Za-z ]+" title="Should only contain letters"
							oninput="this.value = capitalizeWords(this.value.slice(0, 25))" maxlength="25" readonly value = <?php echo $_POST['FirstName'];?> >

						<input type="text" class="User_fllName" name="MiddleName" placeholder="&nbsp Middle Name"
							pattern="[A-Za-z ]+" title="Should only contain letters"
							oninput="this.value = capitalizeWords(this.value.slice(0, 25))" maxlength="25" readonly value = <?php echo $_POST['MiddleName'];?> >

						<input type="text" class="User_fllName" name="Suffix" placeholder="&nbsp Suffix (optional)"
							pattern="[A-Za-z ]+" title="Should only contain letters" readonly
							oninput="this.value = capitalizeWords(this.value.slice(0, 25))" maxlength="25" value = <?php echo $_POST['Suffix'];?>>
					</div>

					<h2 class="small_title">Student Permit Number:</h2>
					<div class="StudentPermitNum">
							<input type="text" class="PermitNum" name="PermitNum" placeholder="&nbsp Student Permit"
							pattern="[A-Za-z ]+" title="Should only contain letters"
							oninput="this.value = capitalizeWords(this.value.slice(0, 25))" maxlength="25" value = <?php echo $combinedValue;?> readonly>
					</div>

				
				</div>
		</div><br>
		<h2>Course Enrolled:</h2>
		<div class="Enrollment_Detail Hidder_Enrolled" id="PDC_motor_manual">
			<div class="box_container_pdc1_box">
			</div>
			<div class="inner_box">
				<div class="box_container_pdc1">
					<h3>Practical Driving Course Motorcycle</h3>
				</div><div class="box_container_pdc1">
					<h3>Manual</h3>
				</div>
				<div class="box_container_pdc1">
					an eight hours of actual driving, it means you're driving a manual transmission motorcycle to get the driver's license code or restriction code.
				</div>
				<div class="box_container_pdc1">
				Php 2,500
				</div>
				<div class="box_container_pdc1">
					<select class="aviSched" name="sched_motor_manual" id="available-schedule-pdc1">
			<?php
                $querySched = "SELECT * FROM pdc_schedule WHERE Slot >= 1";
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

		<div class="Enrollment_Detail Hidder_Enrolled" id="PDC_motor_automatic">
			<div class="box_container_pdc2_box">
			</div>
			<div class="inner_box">
				<div class="box_container_pdc2">
					<h3>Practical Driving Course Motorcycle</h3>
				</div>
				<div class="box_container_pdc2">
					<h3>Automatic</h3>
				</div>
				<div class="box_container_pdc2">
					an eight hours of actual driving, it means you're driving a real manual transmission light vehicle to get the driver's license code or restriction code.
				</div>
				<div class="box_container_pdc2">
				Php 2,500
				</div>
				<div class="box_container_pdc2">
					<select class="aviSched" name="sched_motor_automatic" id="available-schedule_pdc2">
					<?php
                $querySched = "SELECT * FROM pdc_schedule WHERE Slot >= 1";
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

		<div class="Enrollment_Detail Hidder_Enrolled" id="PDC_Car_manual">
			<div class="box_container_pdc2_box">
			</div>
			<div class="inner_box">
				<div class="box_container_pdc2">
					<h3>Practical Driving Course Car</h3>
				</div>
				<div class="box_container_pdc2">
					<h3>Manual</h3>
				</div>
				<div class="box_container_pdc2">
					an eight hours of actual driving, it means you're driving a real manual transmission light vehicle to get the driver's license code or restriction code.
				</div>
				<div class="box_container_pdc2">
					Php 4000
				</div>
				<div class="box_container_pdc2">
					<select class="aviSched" name="sched_car_manual" id="available-schedule_pdc3">
					<?php
                $querySched = "SELECT * FROM pdc_schedule WHERE Slot >= 1";
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

		<div class="Enrollment_Detail Hidder_Enrolled" id="PDC_Car_Automatic">
			<div class="box_container_pdc2_box">
			</div>
			<div class="inner_box">
				<div class="box_container_pdc2">
					<h3>Practical Driving Course Car</h3>
				</div>
				<div class="box_container_pdc2">
					<h3>Automatic</h3>
				</div>
				<div class="box_container_pdc2">
					an eight hours of actual driving, it means you're driving a real manual transmission light vehicle to get the driver's license code or restriction code.
				</div>
				<div class="box_container_pdc2">
					Php 4000
				</div>
				<div class="box_container_pdc2">
					<select class="aviSched" name="sched_car_automatic" id="available-schedule_pdc4">
					<?php
                $querySched = "SELECT * FROM pdc_schedule WHERE Slot >= 1";
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
      
       <br>
	  <br>
	  
		<div class="CashPayment_Detail_Container">
			<h2 class="small_title">Total Payment:</h2><br>
			<div class="Payment_info">
			<!--DITO DETAIL NG BABAYRAN NI STUDENT DITO DETAIL NG BABAYRAN NI STUDENT DITO DETAIL NG BABAYRAN NI STUDENT DITO DETAIL NG BABAYRAN NI STUDENT DITO DETAIL NG BABAYRAN NI STUDENT DITO DETAIL NG BABAYRAN NI STUDENT-->
			<br>
			<br>

			<h1><?php echo $TotalPdc?></h1>
			</div>
				
			
			  <div class="radio-container">
					<label>
						<input type="radio" class="large-radio" name="radio-group" value="GCASH" required> GCASH
					</label>
				</div>

				<div class="radio-container">
					<label>
						<input type="radio" class="large-radio" name="radio-group" value="OnPersonCash" required> Cash via Branch in-Person Payment
					</label>
				</div>
		</div>

		
		<div class="button_Container_Registration">
			<input type="submit" name="TDC_Submit" class="PDC_enrollment_btn" value="Enroll">
			<input type="Reset" name="TDC_Reset" class="PDC_Reset_btn" value="Cancel" id = "CANCEL_BTN">
		</div>

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

		<div>		
<input type="hidden" value="<?php echo $_POST['Birthdate']; ?>" name="BirthdatePDC">
<input type="hidden" value="<?php echo $_POST['CivilStatus']; ?>" name="CivilStatusPDC">
<input type="hidden" value="<?php echo $_POST['ContactNumber']; ?>" name="ContactNumberPDC">
<input type="hidden" value="<?php echo $_POST['SEX']; ?>" name="SEXPDC">
<input type="hidden" value="<?php echo $_POST['CompleteAddress']; ?>" name="CompleteAddressPDC">
<input type="hidden" value="<?php echo $_POST['City']; ?>" name="CityPDC">
<input type="hidden" value="<?php echo $_POST['ZipCode']; ?>" name="ZipCodePDC">
<input type="hidden" value="<?php echo $_POST['Citizenship']; ?>" name="CitizenshipPDC">
<input type="hidden" value="<?php echo $_POST['ContactPerson']; ?>" name="ContactPersonPDC">
<input type="hidden" value="<?php echo $_POST['ConPersonNum']; ?>" name="ConPersonNumPDC">
<input type="hidden" value="<?php echo $_POST['Relationship']; ?>" name="RelationshipPDC">
<input type="hidden" value="<?php echo $_POST['clientID']; ?>" name="clientID">
<input type="hidden" value="<?php echo isset($_POST['Exp_Date']) ? $_POST['Exp_Date'] : ''; ?>" name="EXPDATE">
<input type="hidden" value="<?php echo $TotalPdc; ?>" name="TotalPdc">
<input type="hidden" value="<?php echo $EnrollingforCM; ?>" name="Enrolling_PDC_Car">
<input type="hidden" value="<?php echo $EnrollingforM; ?>" name="Enrolling_PDC_Motor">
		</div>	
				</form>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="modal_script_index.js"></script>
<script src="script_login_PDC.js"></script>
<script>

        var flagM_manual = <?php echo $flagM_Manual ? 'true' : 'false'; ?>;
        var flagM_auto = <?php echo $flagM_Auto ? 'true' : 'false'; ?>;
        var flagC_Manual = <?php echo $flagC_Manual ? 'true' : 'false'; ?>;
        var flagC_Auto = <?php echo $flagC_Auto ? 'true' : 'false'; ?>;

		var enrollmentM_manual = document.getElementById('PDC_motor_manual');
		var enrollmentM_auto = document.getElementById('PDC_motor_automatic');
		var enrollmentC_Manual = document.getElementById('PDC_Car_manual');
		var enrollmentC_Auto = document.getElementById('PDC_Car_Automatic');

		var selectM_manual = document.getElementById('available-schedule-pdc1');
		var selectM_auto = document.getElementById('available-schedule_pdc2');
		var selectC_Manual = document.getElementById('available-schedule_pdc3');
		var selectC_Auto = document.getElementById('available-schedule_pdc4');


	if (flagM_manual) {
        enrollmentM_manual.style.display = 'block';
		selectM_manual.setAttribute('required', 'required');
    }
	if (flagM_auto) {
        enrollmentM_auto.style.display = 'block';
		selectM_auto.setAttribute('required', 'required');
    }
	if (flagC_Manual) {
        enrollmentC_Manual.style.display = 'block';
		selectC_Manual.setAttribute('required', 'required');
    }
	if (flagC_Auto) {
        enrollmentC_Auto.style.display = 'block';
		selectC_Auto.setAttribute('required', 'required');
    }

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

  var noSlot_Motorcycle_Automatic = <?php echo isset($_SESSION['No_slot_Motorcycle_Automatic']) ? 'true' : 'false'; ?>;
  var noSlot_Motorcycle_Manual = <?php echo isset($_SESSION['No_slot_Motorcycle_Manual']) ? 'true' : 'false'; ?>;
  var noSlot_Car_Manual = <?php echo isset($_SESSION['No_slot_Car_Manual']) ? 'true' : 'false'; ?>;
  var noSlot_Car_Automatic = <?php echo isset($_SESSION['No_slot_Car_Automatic']) ? 'true' : 'false'; ?>;


  var divToRemove_motor_manual = document.getElementById("PDC_motor_manual");
  var divToRemove_motor_automatic = document.getElementById("PDC_motor_automatic");
  var divToRemove_Car_manual = document.getElementById("PDC_Car_manual");
  var divToRemove_Car_Automatic = document.getElementById("PDC_Car_Automatic");

  var flagnoSlot_Motorcycle_Automatic = false
  var flagnoSlot_Motorcycle_Manual = false
  var flagnoSlot_Car_Manual = false
  var flagnoSlot_Car_Automatic = false

if (noSlot_Motorcycle_Automatic) {

	divToRemove_motor_automatic.style.display = "none";
	divToRemove_Car_manual.style.display = "none";
	divToRemove_motor_automatic.style.display = "none";
	divToRemove_motor_manual.style.display = "none";


	flagnoSlot_Motorcycle_Automatic = true
    // Clear the session variable
}

if (noSlot_Motorcycle_Manual) {
	
	
	divToRemove_motor_automatic.style.display = "none";
	divToRemove_Car_manual.style.display = "none";
	divToRemove_motor_automatic.style.display = "none";
	divToRemove_motor_manual.style.display = "none";

	flagnoSlot_Motorcycle_Manual = true
}

if (noSlot_Car_Manual) {

	divToRemove_motor_automatic.style.display = "none";
	divToRemove_Car_manual.style.display = "none";
	divToRemove_motor_automatic.style.display = "none";
	divToRemove_motor_manual.style.display = "none";



	flagnoSlot_Car_Manual = true

    // Clear the session variable
}

if (noSlot_Car_Automatic) {

	
	divToRemove_motor_automatic.style.display = "none";
	divToRemove_Car_manual.style.display = "none";
	divToRemove_motor_automatic.style.display = "none";
	divToRemove_motor_manual.style.display = "none";
	
	flagnoSlot_Car_Automatic = true
    // Clear the session variable
}


if(flagnoSlot_Car_Automatic){
	divToRemove_motor_automatic.style.display = "block";
    <?php unset($_SESSION['No_slot_Car_Automatic']); ?>

}
if(flagnoSlot_Car_Manual){
	divToRemove_Car_manual.style.display = "block";
    <?php unset($_SESSION['No_slot_Car_Manual']); ?>

}
if(flagnoSlot_Motorcycle_Automatic){
	divToRemove_motor_automatic.style.display = "block";
	<?php unset($_SESSION['No_slot_Motorcycle_Automatic']); ?>
}
if(flagnoSlot_Motorcycle_Manual){
	divToRemove_motor_manual.style.display = "block";
    <?php unset($_SESSION['No_slot_Motorcycle_Manual']); ?>
}

if (divToRemove_motor_automatic.style.display === "none") {
	divToRemove_motor_automatic.remove();
}
if (divToRemove_Car_manual.style.display === "none") {
	divToRemove_Car_manual.remove();
}
if (divToRemove_motor_automatic.style.display === "none") {
	divToRemove_motor_automatic.remove();
}
if (divToRemove_motor_manual.style.display === "none") {
	divToRemove_motor_manual.remove();
}





$(document).ready(function(){
    // Attach a click event handler to the button with id "cancelButton"
    $("#CANCEL_BTN").click(function(){
			window.location.href = "Enrollment_PDC.php"
    });
  });


$(document).ready(function(){
    $("#voucher_pdc_apply").submit(function(e){
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
              if (response.includes("This voucher is for TDC")) {
                 alert("This voucher is for TDC");
                }
                
                if (response.includes("No slot")) {
                 alert("No more slot for this voucher");
                }
                
                 if (response.includes("Already Have Voucher")) {
                 alert("Already Have Voucher for PDC");
                }
                 if (response.includes("Voucher Applied")){
                 alert("Voucher Applied");
                 }

// Wait for the alert to be dismissed, then reset and reload
setTimeout(function() {
    $("#voucher_pdc_apply")[0].reset();
    location.reload();
}, 200);

                // You can update the DOM or perform other actions based on the response
            },
             error: function(jqXHR, textStatus, errorThrown) {
        // handle error
        console.log("AJAX Error:", textStatus, errorThrown);
    }
        });
    });
});


</script>

</html>