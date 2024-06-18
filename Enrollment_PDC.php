<?php
include("conn.php");

try {

$sqlInfoData = "SELECT * FROM u896821908_bts.course_enrolled where Course = 'PDC'";
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
	$PriceArray[] = number_format(intval($row['Price']), 0, '', ',');
}

//Data prep when the student is done with TDC
$Lname = "";
$Fname = "";
$Mname = "";
$suffix = "";
$std_permit_num = "";
$exp_date = "";
$stud_perm_img = "";
$lto_client_id = "";
$birthdate = "";
$cvl_stats = "";
$sex = "";
$conNum = "";
$Address = "";
$City = "";
$zipcode = "";
$citizenship = "";
$con_per_Flname = "";
$con_per_num = "";
$con_per_rel = "";
$isTrue= "false";
if(isset($_GET['Student_id'])) {
    // Retrieve the value of Student_id
    $isTrue = "true";
    $studentId = $_GET['Student_id'];

    
    //GET THE DATA OF STUDENT IF THEY ARE COMING FROM BEING ENROLLED IN TDC
  $sqlGetStd_data = "SELECT * FROM u896821908_bts.student WHERE idStudent = :studentId";
        $stmt = $conn->prepare($sqlGetStd_data);

        // Bind the parameter
        $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            // Fetch the data
            $row_Std_PDC = $stmt->fetch(PDO::FETCH_ASSOC);
    
           // Assign values to variables
            $Lname = $row_Std_PDC['Lastname'];
            $Fname = $row_Std_PDC['Firstname'];
            $Mname = $row_Std_PDC['Middlename'];
            $suffix = $row_Std_PDC['Suffix'];
            $birthdate = $row_Std_PDC['Birthdate'];
            $cvl_stats = $row_Std_PDC['Civilstatus'];
            $sex = $row_Std_PDC['Sex'];
            $conNum = $row_Std_PDC['Contactnumber'];
            $Address = $row_Std_PDC['Address'];
            $City = $row_Std_PDC['City'];
            $zipcode = $row_Std_PDC['ZipCode'];
            $citizenship = $row_Std_PDC['Citizenship'];
            $con_per_Flname = $row_Std_PDC['Contact_person'];
            $con_per_num = $row_Std_PDC['Contact_person_number'];
            $con_per_rel = $row_Std_PDC['Relationship'];
        } else {
            echo "No student found with ID: " . $studentId;
        }
        
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
	.nav_left {
		display: flex;
		width: 50%;
		height: 100%;
		margin: 0% 2%;
	}

	.left_h1 {
		margin: 7% % 0% 0%;
		font-size: 25px;
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
		column-gap: 1%;
	}

	.User_Full_Name .User_fllName {
		width: 25%;

	}

	.StudentPermitNum {
		display: flex;
	}

	.input_Date {
		width: 10%;
		padding: 10px;
		font-size: 16px;
		background-color: #d9d9d9;
		height: 50%;
	}

	.stud_RegDet {
		margin-top: 1%;
		width: 100%;
		display: flex;
		flex-direction: row;
		gap: 1%;
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
		width: 80%;
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
		margin-left: 5%;
		height: 100px;
		width: 90%;
		margin-top: 15px;
		display: block;
		display: flex;
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
	}

	input[type="file"] {
		background-color: #4CAF50;
    display: flex;
    color: white;
    border: none;
    padding: 15px 20px;
    border-radius: 20px;
    font-size: 18px;
    cursor: pointer;
    width: 20%;
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

	.Contact_Person {
		margin-top: 1%;
		width: 100%;
		display: flex;
		flex-direction: row;
		gap: 2%;
	}
	.aviSched {
		width: 15%;
		padding: 13px;
		font-size: 16px;
		background-color: #d9d9d9;
		height: 50%;
	}.permit{
		margin-top: 1%;
		width: 100%;
		display: flex;
		flex-direction: row;
		gap: 1%;
	}.pdfpermit{
		margin-top: 1%;
		width: 100%;
		display: flex;
		flex-direction: row;
		gap: 1%;
	} 
</style>

<body>
	<div class="Registration_container_form">
		<h2 class="Registration_container_form_title">
			ENROLLMENT REGISTRATION FORM PRACTICAL DRIVING COURSE
		</h2>
		<h2 class="small_title">Please fill up the details</h2>
		<div class="User_data_container">
			<!-- SignUp_StudentPDC -->
<form method="post" enctype="multipart/form-data" action="payment_PDC.php" onsubmit="return validateFormCheck()">
				<div class="Right_user_data">
					<div class="User_Full_Name">
					    
					<input type="text" class="User_fllName" name="LastName" placeholder="&nbsp; <?php echo empty($Lname) ? 'Last Name *' : $Lname; ?>"
        value="<?php echo empty($Lname) ? '' : $Lname; ?>"
        pattern="[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]{3,}"
        title="Should only contain letters and special characters with a minimum length of 3 characters"
        oninput="this.value = capitalizeWords(this.value.slice(0, 25))"
        maxlength="25" required >


						<input type="text" class="User_fllName" name="FirstName" placeholder="&nbsp; <?php echo empty($Fname) ? 'First Name *' : $Fname; ?>"
        value="<?php echo empty($Fname) ? '' : $Fname; ?>"
        pattern="[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]{3,}"
        title="Should only contain letters and special characters with a minimum length of 3 characters"
        oninput="this.value = capitalizeWords(this.value.slice(0, 25))"
        maxlength="25" required >


						<input type="text" class="User_fllName" name="MiddleName" 
					    	placeholder="&nbsp; <?php echo empty($Mname) ? 'Middle Name (optional)' : $Mname; ?>"
					    	value="<?php echo empty($Mname) ? '' : $Mname; ?>"
        pattern="[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]{3,}"
							title="Should only contain letters and special characters"
							oninput="this.value = capitalizeWords(this.value.slice(0, 25))" maxlength="25">

						<input type="text" class="User_fllName" name="Suffix"
						    placeholder="&nbsp; <?php echo empty($suffix) ? 'Suffix (optional)' : $suffix; ?>"
					    	value="<?php echo empty($suffix) ? '' : $suffix; ?>"
        pattern="[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]{2,}"
							title="Should only contain letters and special characters"
							oninput="this.value = capitalizeWords(this.value.slice(0, 25))" maxlength="25">
					</div>

					<p style="margin-top: 1%; font-size: 20px;">Student Permit Number</p>
						<div class="permit">

						<input type="text" name="StdperNum1" maxlength="3" pattern="[A-Za-z0-9]{3}" title="Please enter exactly 3 alphanumeric characters" placeholder="&nbsp *" required>

						<h4 style="margin: auto .7%;">=</h4>

						<input type="text" name="StdperNum2" maxlength="3" pattern="[A-Za-z0-9]{3}" 
						title="Please enter exactly 3 alphanumeric characters" placeholder="&nbsp *" required>

						<h4 style="margin: auto .7%;">=</h4>

						<input type="text"  name="StdperNum3" maxlength="6" pattern="[A-Za-z0-9]{6}" 
						title="Please enter exactly 6 alphanumeric characters" placeholder="&nbsp *" required>


						<span class="exp_date"
							style=" margin: auto 0 auto .5%; font-size: 20px;">Expiration Date:</span><h5 style="margin-top: 1%; font-size: 20px;  color: red;">*</h5>

							<input type="date" style="margin: 0 1%;" name="Exp_Date" required min="<?php echo date('Y-m-d'); ?>">
						</div>
						
						
<br>
						<span class="exp_date" style=" margin: auto 0 auto .5%;margin-top: 1%; font-size: 20px;">Student Permit:</span>

						<div class="pdfpermit">
						<input type="file" name="StudentPermit" id="StudentPermit" accept=".pdf" required>
						<span id="fileSizeError" style="color: red;"></span>


						<h5 style="margin-top: 1%; font-size: 20px; margin-left: 1%; color: red;">Note:</h5>
						<p style="margin-top: 1%; font-size: 20px; margin-left: 1%;">Upload pdf file only only</p>

						<input type="text" name="clientID" pattern="[0-9-]+" placeholder="LTO Client ID *" style="width: 60%;" 
       						title="Please enter your LTO client ID (numbers and hyphens only)" maxlength="30" required>

						</div>
						

					<h2 class="small_title">Registration Details</h2>
					<div class="stud_RegDet">
						<span class="exp_date" style="font-size: 20px;">Birthdate*</span>

						<input type="date" name="Birthdate" id="birthdate"
							placeholder="&nbsp; <?php echo empty($birthdate ) ? 'Birthdate' : $birthdate ; ?>"
					    	value="<?php echo empty($birthdate ) ? '' : $birthdate ; ?>"
							max="2005-06-20" style="margin: 0 0 0 .5%;" required>
                    <?php
                $cvl_stats_selected = empty($cvl_stats) ? 'Choose Civil Status*' : $cvl_stats;
$isDisabled1 = empty($cvl_stats) ? 'disabled' : '';

echo '<select name="CivilStatus" id="civil-status" style="margin: 0 0 0 1%;" required>';
echo '<option value="'. $cvl_stats_selected .'" ' . $isDisabled1 . ' selected hidden>' . $cvl_stats_selected . '</option>';
echo '<option value="Single">Single</option>';
echo '<option value="Married">Married</option>';
echo '<option value="Widowed">Widowed</option>';
echo '<option value="Divorced">Divorced</option>';
echo '</select>';
    
                        $gender_selected = empty($sex) ? 'Choose Gender*' : $sex;
                        $isDisabled2 = empty($sex) ? 'disabled' : '';
                        
                        echo '<select id="SEX" name="SEX" style="margin: 0 0 0 1%;">';
                        echo '<option value="'. $gender_selected .'" ' . $isDisabled2 . ' selected hidden>' . $gender_selected . '</option>';
                        echo '<option value="MALE">MALE</option>';
                        echo '<option value="FEMALE">FEMALE</option>';
                        echo '</select><br>';
                    ?>


					</div>

						<div class="Long_inputs">
							<input type="text" class="ConNum" name="ContactNumber" 
								placeholder="&nbsp; <?php echo empty($conNum) ? 'Contact Number*' : $conNum; ?>"
					        	value="<?php echo empty($conNum) ? '' : $conNum; ?>"
								pattern="09\d{9}" title="Should only contain 11 digits starting with 09" maxlength="11"
								minlength="11" required>

								<br>
								<br>

						<input type="text" name="CompleteAddress" class="Address"
        placeholder="&nbsp; <?php echo empty($Address) ? 'Address*' : $Address; ?>"
        value="<?php echo empty($Address) ? '' : $Address; ?>"
        pattern="[A-Za-z0-9,-. ]{5,}"
        title="Should only contain at least 5 alphanumeric characters (letters and numbers)"
        oninput="this.value = capitalizeWords(this.value.slice(0, 150))"
        maxlength="150" required>

								
								<br>
								<br>

							<input type="text" name="City" class="Address"
        placeholder="&nbsp; <?php echo empty($City) ? 'City*' : $City; ?>"
        value="<?php echo empty($City) ? '' : $City; ?>"
        pattern="[A-Za-z0-9,-. ]{3,}"
        title="Should only contain letters and numbers with a minimum length of 3 characters"
        oninput="this.value = capitalizeWords(this.value.slice(0, 50))"
        maxlength="50" required>

								
								<br>
								<br>
<
						</div>

						<div class="zip_Cit">
							<input type="text" name="ZipCode"
								placeholder="&nbsp; <?php echo empty($zipcode) ? 'Zip Code*' : $zipcode; ?>"
					        	value="<?php echo empty($zipcode) ? '' : $zipcode; ?>"
						    	pattern="[0-9]{4}"
								title="Should only contain 4 digits" maxlength="4" minlength="4" required>

						<input type="text" name="Citizenship"
        placeholder="&nbsp; <?php echo empty($citizenship) ? 'Citizenship*' : $citizenship; ?>"
        value="<?php echo empty($citizenship) ? '' : $citizenship; ?>"
        pattern="[A-Za-z ]{3,}"
        title="Should only contain letters"
        oninput="this.value = capitalizeWords(this.value.slice(0, 15))"
        maxlength="15" required>

						</div>

						<br>
						<h3>In case of emergency contact person</h3>
						<div class="Contact_Person">
						<input type="text" name="ContactPerson"
        placeholder="&nbsp; <?php echo empty($con_per_Flname) ? 'Fullname of Contact Person*' : $con_per_Flname; ?>"
        value="<?php echo empty($con_per_Flname) ? '' : $con_per_Flname; ?>"
        pattern="[A-Za-z ]{2,}"
        title="Should only contain letters"
        oninput="this.value = capitalizeWords(this.value.slice(0, 25))"
        maxlength="25" required>



							<input type="text" name="ConPersonNum"
								pattern="09\d{9}"
								placeholder="&nbsp; <?php echo empty($con_per_num) ? 'Contact Number*' : $con_per_num; ?>"
					        	value="<?php echo empty($con_per_num) ? '' : $con_per_num; ?>"
								title="Should only contain 11 digits starting with 09" maxlength="11"
								minlength="11" required>
								
								<br>
								
                           <?php 
                                $con_per_rel_selected = empty($con_per_rel) ? 'Select Relationship*' : $con_per_rel;
                                $isDisabled3 = empty($con_per_rel) ? 'disabled' : '';
                                
                                echo '<select name="Relationship" style="margin: 0 0 0 0;" required>';
                                echo '<option value="' . $con_per_rel_selected . '" ' . $isDisabled3 . ' selected hidden>' . $con_per_rel_selected . '</option>';
                              
                                 // SQL query to retrieve relationships from the database
                                $queryStdRelationship = "SELECT Relationship FROM std_emergency_relationship";
                                $stmtStdRelationship = $conn->prepare($queryStdRelationship);
                                $stmtStdRelationship->execute();

                                // Fetch the options and populate the dropdown
                                while($rowStdRelationship = $stmtStdRelationship->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value='".$rowStdRelationship['Relationship']."'>".$rowStdRelationship['Relationship']."</option>";
                                }
                                echo '</select>';
                            ?>

						</div>

					</div>
				</div>
		</div>
		<br>
		<h2 style="margin-left: 2% ;">Enrollment Details:</h2>
		<div class="Enrollment_Detail">
			<div class="box_container_pdc1_box">
				<input type="radio" name="PDCMotor" value="Motorcycle_Manual">
			</div>

			<div class="inner_box">
				<div class="box_container_pdc1">
					<h3><?php echo $Course_infoArray[0] ?></h3>
				</div>
				<div class="box_container_pdc1">
					<h3><?php echo $VechileArray[0] ?></h3>
				</div>
				<div class="box_container_pdc1">
					<p><?php echo $InfoArray[0] ?></p>

				</div>
				<div class="box_container_pdc1">
					<h3><?php echo "Php " . $PriceArray[0] ?></h3>
				</div>
			</div>
		</div>
		<br>
		<div class="Enrollment_Detail">
			<div class="box_container_pdc3_box">
				<input type="radio" name="PDCMotor" value="Motorcycle_Automatic">
			</div>
			<div class="inner_box">
				<div class="box_container_pdc3">
					<h3><?php echo $Course_infoArray[2] ?></h3>
				</div>
				<div class="box_container_pdc3">
					<h3><?php echo $VechileArray[2] ?></h3>
				</div>
				<div class="box_container_pdc3">
					<p><?php echo $InfoArray[2] ?></p>

				</div>
				<div class="box_container_pdc3">
					<h3><?php echo "Php " . $PriceArray[2] ?></h3>
				</div>
			</div>
		</div>
		<br>
		<div class="Enrollment_Detail">
			<div class="box_container_pdc2_box">
				<input type="radio" name="PDCCar" value="Car_Manual">
			</div>
			<div class="inner_box">
				<div class="box_container_pdc2">
					<h3><?php echo $Course_infoArray[1] ?></h3>
				</div>
				<div class="box_container_pdc2">
					<h3><?php echo $VechileArray[1] ?></h3>
				</div>
				<div class="box_container_pdc2">
					<p><?php echo $InfoArray[1] ?></p>

				</div>
				<div class="box_container_pdc2">
					<h3><?php echo "Php " . $PriceArray[1] ?></h3>
				</div>
			</div>
		</div>
		<br>
		<div class="Enrollment_Detail">
			<div class="box_container_pdc4_box">
				<input type="radio" name="PDCCar" value="Car_Automatic">
			</div>
			<div class="inner_box">
				<div class="box_container_pdc4">
					<h3><?php echo $Course_infoArray[3] ?></h3>
				</div>
				<div class="box_container_pdc4">
					<h3><?php echo $VechileArray[3] ?></h3>
				</div>
				<div class="box_container_pdc4">
					<p><?php echo $InfoArray[3] ?></p>

				</div>
				<div class="box_container_pdc4">
					<h3><?php echo "Php " . $PriceArray[3] ?></h3>
				</div>
			</div>
		</div>
		<br>
	</div>

	<br>
	<br>




	<div class="button_Container_Registration">
		<input type="submit" name="TDC_Submit" class="PDC_enrollment_btn" value="Enroll">
        <input type="Reset" name="TDC_Reset" class="PDC_Reset_btn" value="Cancel" id="cancelButton2">
	</div>
	</form>


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="modal_script_index.js"></script>
<!-- <script src="script_login_PDC.js"></script> -->

<script>




    document.getElementById("cancelButton2").addEventListener("click", function() {
        // Check the value of the $isTrue variable
        var isTrue = <?php echo json_encode($isTrue); ?>;

        if (isTrue === "true") {
            // Go back in the browser's history
            history.back();
        } else if (isTrue === "false") {
            // Redirect to login.php
            window.location.href = "login.php";
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

function validateFormCheck() {
    var genderSelect = document.getElementById('SEX');
    var selectedGender = genderSelect.value;

    var civilStatusSelect = document.getElementById('civil-status');
    var selectedCivilStatus = civilStatusSelect.value;

    var relationshipSelect = document.getElementsByName('Relationship')[0]; // Assuming the select name is 'Relationship'
    var selectedRelationship = relationshipSelect.value;

    // Check if the selected values are the default ("Choose Gender*", "Choose Civil Status*", or "Select Relationship*")
    if (selectedGender === "" || selectedGender === 'Choose Gender*') {
        alert("Please select a valid gender.");
        return false;
    }

    if (selectedCivilStatus === "" || selectedCivilStatus === 'Choose Civil Status*') {
        alert("Please select a valid civil status.");
        return false;
    }

    if (selectedRelationship === "" || selectedRelationship === 'Select Relationship*') {
        alert("Please select a valid relationship.");
        return false;
    }

    // Get all radio buttons with name "PDCMotor" and "PDCCar"
    var motorcycleRadios = document.querySelectorAll('input[name="PDCMotor"]');
    var carRadios = document.querySelectorAll('input[name="PDCCar"]');

    // Check if at least one radio button is checked
    var motorcycleChecked = Array.from(motorcycleRadios).some(radio => radio.checked);
    var carChecked = Array.from(carRadios).some(radio => radio.checked);

    // Return true if at least one radio button for each group is checked, otherwise show an alert and return false
    if (motorcycleChecked || carChecked) {
        return true;
    } else {
        alert("Please select at least one option.");
        return false;
    }

    // Add additional validation logic if needed

    return true; // Return true if the form is valid and can be submitted
}




function validateForm() {
    var fileInput = document.getElementById('StudentPermit');
    var fileSize = fileInput.files[0].size; // in bytes
    var maxSize = 4 * 1024 * 1024; // 4 MB in bytes

    if (fileSize > maxSize) {
        document.getElementById('fileSizeError').textContent = 'File size exceeds 4 MB limit.';
        return false; // Prevent form submission
    } else {
        document.getElementById('fileSizeError').textContent = '';
        return true; // Allow form submission
    }
}



    // Optional: You can also add an event listener to validate the file size when the user selects a file
    document.getElementById('StudentPermit').addEventListener('change', function(event) {
        validateForm();
    });


</script>

</html>