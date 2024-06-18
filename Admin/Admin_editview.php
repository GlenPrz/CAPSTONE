<?php
session_start();
if (empty($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}
include "../conn.php";
include "./php_scripts/Admin_EDIT_ENROLL.php";
include "./php_scripts/Admin_DEL.php";
include "./php_scripts/Admin_Payment.php";
include "./php_scripts/Admin_StdEnroll.php";
include "./php_scripts/Admin_edit_status.php";


$roleStaff = $_SESSION['role'];
$admin_username = $_SESSION['username'];
//Dito ichecheck if teller or admin. pag teller then magiging none ang value nung $none
$none='';
if ($roleStaff === "Teller") {
          $none='none';
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
    <link href="admin_styles/admin_nav.css" rel="stylesheet">
    <link href="./admin_styles/admin_enroll.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
</head>
<style>
    .nav_left {
        display: flex;
        width: 50%;
        height: 100%;
        margin: 0% 2%;
    }

    .left_h1 {
        margin: 14% 0% 0% 0%;
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
        column-gap: 1% 
        
    }

    .User_Full_Name .User_fllName {
        width: 23%;
        column-gap: 1%;
    }


    .stud_RegDet {
        display: flex;
        column-gap: 1%;
    }

    .wid_med {
        width: 15%;
        padding: 5px
        font-size: 16px;
    }

    .Enrollment_Detail {
        margin-top: 15px;
        display: block;
    }

    .Registration_container_form {
        width: 100%;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 1%;
            margin-bottom: 2%;
            margin-right: 5%;
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
      input[type="date"] {
        width: 30%;
        outline:none;
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
		margin-right: 1%;
    }
	
	
	 .clientID input[type="text"] {
        width: 50%;
		margin-right: none;
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
        padding: 1%;
    }
	.inner_button_Container_Registration{
		margin: auto;
		display: flex;
		width: 30%;
	}
    input[type="file"] {
        background-color: lightgray;
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
        font-size: 10px;
    }

    .PDC_enrollment_btn,
    .PDC_Reset_btn, .PDC_Back_btn {
        padding: 15px 30px;
        font-size: 22px;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        color: white;
        margin: 10px;
        width: 150px;
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
	
	 .PDC_Back_btn {
       background-color: #f5de31;
	   color: black;
    }

    .PDC_Back_btn:hover {
        background-color: #695f14;
		color: white;
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

    .aviSched {
        width: 15%;
        padding: 13px;
        font-size: 16px;
        background-color: #d9d9d9;
        height: 50%;
    }
    .main_content{
        display: flex;
    width: 100%;
    margin-left: 2%;
    margin-top: 2%;
    height: 100%;
    float: left;
    width: 75%;
    display: flex;
    flex-flow: row wrap;
    margin-left: 22%;
    margin-bottom: 5%;
    }
    .permit{
        margin-top: 1%;
        width: 100%;
        display: flex;
        gap: 1%;
    }.pdfpermit{
        margin-top: 1%;
        width: 100%;
        display: flex;
        flex-direction: row;
        gap: 1%;
    }
	
	/*		PROGRESS		*/
	.progress_container{
		height: 100%;
		width: 100%;
		text-align: center;
		align-items: center;
	}
	.circle_prog_con{
		display: flex;
		border-radius: 5px;
	}
	.progress-bar-container {
		  width: 45%;
		  margin: 10px;
    }

    .progress-bar {
      position: relative;
      width: 100%;
      background-color: #ddd;
      border-radius: 4px;
      overflow: hidden;
    }

    .progress {
      height: 40px;
      background-color: #4CAF50;
      color: #fff;
      line-height: 40px;
      text-align: center;

    }

    .progress-value {
      display: block;
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      color: #000;
      font-weight: bold;
    }
    	
    .progress_sirkol2 {
      position: relative;
      text-align: left;
	  width: 100;
	  height: 100;
	  margin-left: 10%;
	   margin-top: 5%;    
	 }
    	
    .progress_sirkol3 {
      position: relative;
      text-align: left;
	  width: 100;
	  height: 100;
	  margin-left: 10%;
	   margin-top: 5%;
    }

  .progress-bar-svg, .progress2-bar-svg, .progress3-bar-svg {
      transform: rotate(-90deg);
    }

    .progress-bar-track {
      fill: none;
      stroke: #eaeaea;
      stroke-width: 38;
  
      position: relative;
      margin-top: 50%;
    }

    .progress-bar-fill , .progress2-bar-fill , .progress3-bar-fill {
      fill: none;
      stroke: #31e060;
      stroke-width: 38;
      stroke-dasharray: 630;
      transition: stroke-dashoffset 0.3s ease;
    }
	
	.progress2-bar-fill{
		stroke: #e8cc2e;

	}
	
	.progress3-bar-fill{
		stroke: #ed422f;
	}
    .progress-bar-text, .progress2-bar-text , .progress3-bar-text {
      position: absolute;
      top: 55%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 30px; /* Adjust the font size */
      font-weight: bold;
      color: #000;
    }
	
	.progress-bar-title {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 2%;

    }
	.PDC_TDCprog_cont1 {
		text-align: center; /* Center-align the text within the container */
		display: flex;
		flex-direction: column;
		align-items: center; /* Center-align child elements horizontally */
		width: 30%; /* Optionally, set a width to center within the parent container */
		margin: 0 1% 0 10%;
	}
	.PDC_TDCprog_cont2 {
		text-align: center; /* Center-align the text within the container */
		display: flex;
		flex-direction: column;
		align-items: center; /* Center-align child elements horizontally */
		width: 30%; /* Optionally, set a width to center within the parent container */
		margin: 0 30% 0 1%;
	}
	.certBtn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #3498db;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 22px;
		font-weight: 600;
        cursor: pointer;
		margin: 4% 0 0 11%;
    }

    .certBtn:hover {
        background-color: #2980b9;
    }

	.cID_validateBtn {
		display: inline-block;
		padding: 3px 40px;
		background-color: #1763b0;
		color: #fff;
		border: none;
		border-radius: 5px;
		font-size: 16px;
		font-weight: 600;
		cursor: pointer;
		margin-left: 1%;
		text-decoration: none;
		text-align: center; /* Center-align the text horizontally */
		line-height: 40px; /* Adjust line-height to center vertically */
	}

	/* Hover effect */
	.cID_validateBtn:hover {
		background-color: #0a2847;
	}
		.BirtStudBtn {
		padding: 3px 40px;
		background-color: #1763b0;
		color: #fff;
		border: none;
		border-radius: 5px;
		font-size: 14px;
		font-weight: 600;
		cursor: pointer;
		margin-left: 1%;
		text-decoration: none;
		text-align: center; /* Center-align the text horizontally */
/* Adjust line-height to center vertically */
	}

	/* Hover effect */
	.BirtStudBtn:hover {
		background-color: #0a2847;
	}
	
	
	.center-text{
		margin: auto;
		font-size: 25px;
		font-weight: 500;
	}
     .approve {
        color: #ffffff; /* White text color for better visibility on colored background */
        background-color: green; /* Green background color for the "Approve" link */
        border-radius: 5px; /* Rounded corners */
        padding: 5px 10px; /* Add padding for better spacing */
        margin-right: 10px; /* Add some right margin for spacing */
        text-decoration: none; /* Remove underline */
        display: inline-block; /* Make it an inline-block to apply padding and margin */
    }

    .RecDel {
        color: #ffffff; /* White text color for better visibility on colored background */
        background-color: #f50202; /* Red background color for the "Delete" link */
        border-radius: 5px; /* Rounded corners */
        padding: 5px 10px; /* Add padding for better spacing */
        text-decoration: none; /* Remove underline */
        display: inline-block; /* Make it an inline-block to apply padding and margin */
    }

    /* Optional: Add hover styles for better user feedback */
    .approve:hover {
        background-color:#1e4214;
    }

    .RecDel:hover {
        background-color:#590d0d;
    }

.TDC_Reset {
    margin-right: 10px; /* Adjust the value to your preference */
}
.notification-icon {
            position: relative;
            display: inline-block;
        }

        .badge {
            position: absolute;
            top: 0;
            right: 0;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 4px 8px;
            )
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
                        <a href="admin_Pupdate.php" style="Display:<?php echo $none;?>;"><i class="fas fa-bullhorn"></i> Post Updates</a>
                        <a href="admin_reports.php"><i class="fas fa-chart-bar"></i> Reports</a>
                        <a href="admin_Staff.php" style="Display:<?php echo $none;?>;"><i class="fas fa-users"></i> Staff</a>
                        <a href="admin_Assign.php"><i class="fas fa-tasks"></i> Assign</a>
                        <a href="admin_view_feedback.php"><i class="fas fa-comment"></i> View Feedback</a>
                        <a href="admin_module_exam.php" style="Display:<?php echo $none;?>;"><i class="fas fa-book"></i> Module/Exam</a>
                        <a href="" id="logoutLink"><i class="fas fa-sign-out-alt"></i> Log Out</a>

                    </div>
                </center>
            </nav>

        </div>
    </div>
    <div class="main_content">
          <?php
        // Check if the 'id' parameter exists in the URL
        if (isset($_GET['id'])) {
            // Get the ID from the URL
            $studentId = $_GET['id'];

            // Database connection configuration
            $servername = "localhost";
            $username = "u896821908_bts";
            $password = "a*5E4UEhsHa]";
            $dbname = "u896821908_bts";

            // Create a connection to the database
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check the connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare and execute a SQL query to fetch the student's data
            $sql = "SELECT * FROM student WHERE idStudent = $studentId";
            $result = $conn->query($sql);

            // Check if a record was found
            if ($result->num_rows > 0) {
                // Fetch the data
                $row = $result->fetch_assoc();
				$USERNAME = $row['Username'];
                $lastname = $row['Lastname'];
                $firstname = $row['Firstname'];
                $middlename = $row['Middlename'];
                $suffix = $row['Suffix'];
                $birthdate = $row['Birthdate'];
                $civilstatus = $row['Civilstatus'];
                $sex = $row['Sex'];
                $contactnum = $row['Contactnumber'];
                $address = $row['Address'];
                $city = $row['City'];
                $zipcode = $row['ZipCode'];
                $citizenship = $row['Citizenship'];
                $student_permit_number = $row['Student_permit_number'];
                $expiration_student_permit = $row['Expiration_student_permit'];
                $student_permit_img = $row['Student_permit_img'];
                $birthcert = $row['BirthCert'];
                $contact_person = $row['Contact_person'];
                $contact_person_number = $row['Contact_person_number'];
                $relationship = $row['Relationship'];
                $total_amount = $row['total_amount'];
                $balance = $row['balance'];
				$ClientID = $row['LTO_Client_ID'];


            } else {
                // Handle the case where no student with the specified ID was found
                echo "No student found with ID: $studentId";
            }

            // Close the database connection
            $conn->close();
        } else {
            // If 'id' parameter is not set in the URL, handle the error or provide a message
            echo "Invalid request. Please go back to the student list.";
        }
        ?>
        <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this student?");
        }
        </script>
        <div class="Registration_container_form">
        <h2 class="Registration_container_form_title">
            ENROLLMENT REGISTRATION FORM
        </h2>
        <h2 class="small_title">Please fill up the details</h2>
        <div class="User_data_container">
            <!-- SignUp_StudentPDC -->
            <form method="post" enctype="multipart/form-data" action="./php_scripts/Admin_student_update.php"  onsubmit="return confirmEdit();">
			   <input type="hidden" name="studentId" value="<?php echo $studentId;?>">
                <div class="Right_user_data">
                    <div class="User_Full_Name">
                        <input type="text" class="User_fllName" name="LastName" placeholder="<?php echo $lastname;?>" value="<?php echo $lastname;?>"
                            pattern="[A-Za-z ]+" title="Should only contain letters"
                            oninput="this.value = capitalizeWords(this.value.slice(0, 25))" maxlength="25">

                        <input type="text" class="User_fllName" name="FirstName" placeholder="<?php echo $firstname;?>" value="<?php echo $firstname;?>"
                            pattern="[A-Za-z ]+" title="Should only contain letters"
                            oninput="this.value = capitalizeWords(this.value.slice(0, 25))" maxlength="25">

                        <input type="text" class="User_fllName" name="MiddleName" placeholder="<?php echo $middlename;?>" value="<?php echo $middlename;?>"
                            pattern="[A-Za-z ]+" title="Should only contain letters"
                            oninput="this.value = capitalizeWords(this.value.slice(0, 25))" maxlength="25">

                        <input type="text" class="User_fllName" name="Suffix" placeholder="<?php echo $suffix;?>" value="<?php echo $suffix;?>"
                            pattern="[A-Za-z ]+" title="Should only contain letters"
                            oninput="this.value = capitalizeWords(this.value.slice(0, 25))" maxlength="25">
                    </div>

                    <p style="margin-top: 1%; font-size: 20px;">Student Permit Number:</p>
                    <div class="permit">
                        
                        <input type="text" style="width: 30%; name="StdperNum" placeholder="<?php echo $student_permit_number;?>" value="<?php echo $student_permit_number;?>">
                      
                        <h2 style=" font-size: 14px; padding: 5px;">Expiration Date:</h2>
                        <input type="date" name="exp_date" id="exp_date" value="<?php echo $expiration_student_permit; ?>" style="margin: 0 0 0 0">
                        
                    <a href="../uploads/pdf_Student/<?php echo basename($birthcert); ?>" target="_blanks">
                    <button type="button" class="BirtStudBtn">Birth Certificate</button>
                    </a>
                    <a href="../uploads/pdf_Student/<?php echo basename($student_permit_img); ?>" target="_blanks">
                    <button type="button" class="BirtStudBtn">Student Permit</button>
                    </a>
                        
                    </div>
                     <p style="margin-top: 1%; font-size: 20px;">LTO Client ID:</p>
                    
                    <div class="clientID">
							<input type="text" class="ClientID" name="ClientID" placeholder="<?php echo $ClientID;?>" value="<?php echo $ClientID;?>" maxlength="30" minlength="15">
							<a class="cID_validateBtn" href="https://driving.lto.direct/ords/f?p=APP_DL_USER_MGMT_SCREENS%3ALOGIN_DESKTOP%3A%3A%3A%3A%3AP101_REFERING_APPLICATION%2CP101_APPLICATION_TITLE%3A1700%2CDriving%20Schools%20Portal&fbclid=IwAR1Acp13m4YKHtf-17ut6437spcG9eFQu6ycV6w6ve3mtiFdzVxcbNA8qRo" target="_blank">Check ID</a>
						</div>
                        
                     
                   
                    
                    <h2 class="small_title">Registration Details</h2>
                    <div class="stud_RegDet">
                        <span class="exp_date" style="font-size: 20px;">Birthdate:</span>
                        <input type="date" name="Birthdate" id="birthdate"
                            placeholder="<?php echo $birthdate;?>" value="<?php echo $birthdate;?>" max="2005-06-20" >
                        
                        <select class="wid_med" name="CivilStatus" id="civil-status" placeholder="<?php echo $civilstatus;?>" value="<?php echo $civilstatus;?>">
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Widowed">Widowed</option>
                            <option value="Divorced">Divorced</option>
                        </select>

                        <select name="SEX" class="wid_med" placeholder="<?php echo $sex;?>" >
                            <option value="<?php echo $sex;?>" selected hidden><?php echo $sex;?></option>
                            <option value="MALE">MALE</option>
                            <option value="FEMALE">FEMALE</option>
                        </select><br>
                        </div>

                        <div class="Long_inputs">
                            <input type="text" class="ConNum" name="ContactNumber" placeholder="<?php echo $contactnum;?>" value="<?php echo $contactnum;?>"
                                pattern="09\d{9}" title="Should only contain 11 digits starting with 09" maxlength="11"
                                minlength="11"><br><br>
                            <input type="text" name="CompleteAddress" placeholder="<?php echo $address;?>" value="<?php echo $address;?>" class="Address"
                                pattern="[A-Za-z0-9,-. ]+" title="Should only contain letters and numbers"
                                oninput="this.value = capitalizeWords(this.value.slice(0, 150))"
                                maxlength="150"><br><br>

                            <input type="text" name="City" placeholder="<?php echo $city;?>" value="<?php echo $city;?>" class="Address"
                                pattern="[A-Za-z0-9,-. ]+" title="Should only contain letters"
                                oninput="this.value = capitalizeWords(this.value.slice(0, 50))" maxlength="50"><br><br>
                        </div>
                        <div class="zip_Cit">
                            <input type="text" name="ZipCode" placeholder="<?php echo $zipcode;?>" value="<?php echo $zipcode;?>" pattern="[0-9]{4}"
                                title="Should only contain 4 digits" maxlength="4" minlength="4">

                            <input type="text" name="Citizenship" placeholder="<?php echo $citizenship;?>" value="<?php echo $citizenship;?>" pattern="[A-Za-z ]+"
                                title="Should only contain letters"
                                oninput="this.value = capitalizeWords(this.value.slice(0, 15))" maxlength="15">
								
                        </div>
						
  
                        <br>
                        <h3>In case of emergency contact person</h3>
                        <div class="Contact_Person">
                            <input type="text" name="ContactPerson" placeholder="<?php echo $contact_person;?>" value="<?php echo $contact_person;?>"
                                pattern="[A-Za-z ]+" title="Should only contain letters"
                                oninput="this.value = capitalizeWords(this.value.slice(0, 25))" maxlength="25">
                            <input type="text" class="ConPersonNum" name="ConPersonNum"
                                placeholder="<?php echo $contact_person_number;?>" value="<?php echo $contact_person_number;?>" pattern="09\d{9}"
                                title="Should only contain 11 digits starting with 09" maxlength="11"
                                minlength="11"><br><br>
                            <input type="text" name="Relationship" placeholder="<?php echo $relationship;?>" value="<?php echo $relationship;?>" pattern="[A-Za-z ]+"
                                title="Should only contain letters"
                                oninput="this.value = capitalizeWords(this.value.slice(0, 25))" maxlength="25">
                        </div>

                    
                </div>
        </div>
        <br>
        <h2>Enrollment Details:</h2>
       
        <div class="Enrollment_Detail">
        <div id="TDCtable_Container">
        <label for="TDCtable">TDC Results</label>
			<table id="TDCtable">
				<tr style="background-color: #f7f5f5; font-size: 20px; font-weight: 600;">
					<td>Session</td>
					<td>Score</td>
					<td>Wrong Answer</td>
					<td>Result</td>
				</tr>
				<tr style="font-size: 18px; font-weight: 500;">
					<?php
					// Establish a database connection (replace with your database credentials)
					$servername = "localhost";
                    $username = "u896821908_bts";
                    $password = "a*5E4UEhsHa]";
                    $dbname = "u896821908_bts";

					$conn = new mysqli($servername, $username, $password, $dbname);

					// Check the connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}
					// Retrieve data from the "student" table where idStudent is equal to $studentId
					$sql = "SELECT Session_num, Score, num_of_wrong_ans, result FROM student_result WHERE Username = '$USERNAME '";
					$result1 = $conn->query($sql);

					if ($result1->num_rows > 0) {
						// Student data found
					while($row1 = $result1->fetch_assoc()){
						// Echo the total fee and remaining balance in the table cells
						echo "<tr>";
                        echo "<td>" . $row1['Session_num'] . "</td>";
						echo "<td>" . $row1['Score'] . "</td>";
						echo "<td>" . $row1['num_of_wrong_ans'] . "</td>";
						echo "<td>" . $row1['result'] . "</td>";
                        echo "</tr>";
                    }
					} else {
						// Student not found, handle the error appropriately
						echo "<tr class='center-text'><td colspan='4'>No results found</td></tr>";
					}

					// Close the database connection
					?>
				</tr>
			</table>
				<br>
				<?php
// Assuming $notificationCount is the variable containing the notification count
$notificationCount = 0;

// Only display the badge if the count is greater than 0
if ($notificationCount > 0) {
    echo "<div class='notification-icon'>";
    echo "<i class='fas fa-bell'></i>";
    echo "<span class='badge'>$notificationCount</span>";
    echo "</div>";
}
?>
				<h2>Exam Retake Request</h2>
				<div style="overflow-x: auto; height: 300px">
    				<table id="TDCtable2">
                        <tr style="background-color: #f7f5f5; font-size: 20px; font-weight: 600;">
                            <td>Session</td>
                            <td>Date</td>
                            <td></td>
                        </tr>
                        <?php
                        // Establish a database connection (replace with your database credentials)
                        $servername = "localhost";
                        $username = "u896821908_bts";
                        $password = "a*5E4UEhsHa]";
                        $dbname = "u896821908_bts";
                    
                        $conn = new mysqli($servername, $username, $password, $dbname);
                    
                        // Check the connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Retrieve data from the "request_for_TDC_attempts" table where student_id is equal to $studentId
                        $sql = "SELECT request_id, session, date_request FROM request_for_TDC_attempts WHERE student_id = '$studentId' AND status LIKE 'pending'";
                        $result = $conn->query($sql);
                    
                        if ($result->num_rows > 0) {
                            // Data found
                            while ($row = $result->fetch_assoc()) {
                                // Echo the session and date_request in the table cells
                                echo "<tr>";
                                 echo "<td>" . $row['session'] . "</td>";
                                 echo "<td>" . $row['date_request'] . "</td>";
                                 echo "<td>
                                     <div style='margin-left: 30%;'>
                                        <a class='approve' href='#' onclick='confirmAction(\"approve\", " . $row['request_id'] . ", \"" . $USERNAME . "\", " . $row['session'] . ")'><center>Approve</center></a>
                                        <a class='RecDel' href='#' onclick='confirmAction(\"delete\", " . $row['request_id'] . ", \"" . $USERNAME . "\", " . $row['session'] . ")'><center>Delete</center></a>
                                     </div>
                                 </td>";

                                echo "</tr>";
                            }
                        } else {
                            // No results found
                            echo "<tr class='center-text'><td colspan='2'>No results found</td></tr>";
                        }
                    
                        // Close the database connection
                        $conn->close();
                        ?>
                    </table>
                </div>

			</div>
			
		<div id="PDCtable_Container">
			<label for="PDCtable">PDC Results</label>
			<table id="PDCtable">
				<tr style="background-color: #f7f5f5; font-size: 20px; font-weight: 600;">
					<td>Session</td>
					<td>Course Enrolled</td>
					<td>Date</td>
					<td>Assessment</td>
				</tr>
				<tr style="font-size: 18px; font-weight: 500;">
					<?php
					// Establish a database connection (replace with your database credentials)
					$servername = "localhost";
                    $username = "u896821908_bts";
                    $password = "a*5E4UEhsHa]";
                    $dbname = "u896821908_bts";

					$conn = new mysqli($servername, $username, $password, $dbname);

					// Check the connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}
					// Retrieve data from the "student" table where idStudent is equal to $studentId
					$sql = "SELECT * FROM pdc_result WHERE Username = '$USERNAME '";
					$result1 = $conn->query($sql);

					if ($result1->num_rows > 0) {
						// Student data found
					while($row1 = $result1->fetch_assoc()){
						// Echo the total fee and remaining balance in the table cells
						echo "<tr>";
                        echo "<td>" . $row1['session'] . "</td>";
						echo "<td>" . $row1['PDC_Course_enrolled'] . "</td>";
						echo "<td>" . $row1['Date'] . "</td>";
						echo "<td>" . $row1['Assessment'] . "</td>";
                        echo "</tr>";
                    }
					} else {
						// Student not found, handle the error appropriately
						echo "<tr class='center-text'><td colspan='4'>No results found</td></tr>";
					}

					// Close the database connection
					?>
				</tr>
			</table>
		</div>
		</div>
        <br>
        <h2>Outstanding Balance:</h2>
        <div class="Balance">
    <table>
        <tr style="background-color: #f7f5f5; font-size: 20px; font-weight: 600;">
            <td>Total Fee</td>
            <td>Remaining Balance</td>
        </tr>
        <tr style="font-size: 18px; font-weight: 500;">
            <?php
            // Establish a database connection (replace with your database credentials)
            $servername = "localhost";
            $username = "u896821908_bts";
            $password = "a*5E4UEhsHa]";
            $dbname = "u896821908_bts";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check the connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            // Retrieve data from the "student" table where idStudent is equal to $studentId
            $select_student_sql = "SELECT total_amount, balance FROM student WHERE idStudent = '$studentId'";
            $result = $conn->query($select_student_sql);

            if ($result->num_rows > 0) {
                // Student data found
                $row = $result->fetch_assoc();
                $totalFee = $row['total_amount'];
                $remainingBalance = $row['balance'];

                // Echo the total fee and remaining balance in the table cells
                echo "<td>$totalFee</td>";
                echo "<td>$remainingBalance</td>";
            } else {
                // Student not found, handle the error appropriately
                echo "<tr class='center-text'><td colspan='4'>No results found</td></tr>";
            }

            // Close the database connection
            ?>
        </tr>
    </table>
</div>
	
	<div class="Tdc_Pdc_Con">
	
		<?php
		//FOR TDC//FOR TDC//FOR TDC//FOR TDC//FOR TDC//FOR TDC//FOR TDC//FOR TDC//FOR TDC//FOR TDC//FOR TDC//FOR TDC//FOR TDC//FOR TDC//FOR TDC//FOR TDC			
				
			$TDC_progress = 0;
			$isTrue_TDC = false;
			$stmt_tdc_exist = $conn->prepare("SELECT * FROM student WHERE  username LIKE ? AND TDC IS NOT NULL ");
			$stmt_tdc_exist->bind_param("s", $USERNAME);
			$stmt_tdc_exist->execute();
			$result_tdc_exist = $stmt_tdc_exist->get_result();
			
			if ($row_tdc_exist = $result_tdc_exist->fetch_assoc()) {	
			// FOR SESSION 1
				$stmt = $conn->prepare("SELECT * FROM student_result WHERE Session_num = 1 AND result = 'Passed' AND username = ?");
				$stmt->bind_param("s", $USERNAME);
				$stmt->execute();
				// Check for any SQL errors
				if ($stmt->errno) {
					die("SQL Error: " . $stmt->error);
				}
				// Get the result
				$result = $stmt->get_result();

				// Check if any rows are returned
				if ($result->num_rows > 0) {
					// Data exists, do something with the results
					$Session_1_status = 33; // Move this line outside the loop if you want to set it to 33 only once.
				} else {
					$Session_1_status = 0;
				}

				// Close the statement
				$stmt->close();

			// FOR SESSION 2
				$stmt = $conn->prepare("SELECT * FROM student_result WHERE 
				Session_num = 2 AND result = 'Passed' AND username LIKE ?");
				$stmt->bind_param("s", $USERNAME);
				$stmt->execute();
				$result = $stmt->get_result();

				// Fetch the result
				if ($row = $result->fetch_assoc()) {
					$Session_2_status = 33;
				} else {
					// No data in the table, variable remains 0
					$Session_2_status = 0;
				}
				$stmt->close();
				
			// FOR SESSION 3
				$stmt = $conn->prepare("SELECT * FROM student_result WHERE 
				Session_num = 3  AND result = 'Passed' AND username LIKE ?");
				$stmt->bind_param("s", $USERNAME);
				$stmt->execute();
				$result = $stmt->get_result();

				// Fetch the result
				if ($row = $result->fetch_assoc()) {
					$Session_3_status = 34;
					$Filler = 16.67;
				} else {
					// No data in the table, variable remains 0
					$Session_3_status = 0;
					$Filler = 0;
				}
				$stmt->close();
			}else {
				$isTrue_TDC= true; 
			}	
				$stmt_tdc_exist->close();
		//END OF TDC//END OF TDC//END OF TDC//END OF TDC//END OF TDC//END OF TDC//END OF TDC//END OF TDC//END OF TDC//END OF TDC//END OF TDC//END OF TDC//END OF TDC//END OF TDC//END OF TDC			
		
		// FOR PDC// FOR PDC// FOR PDC// FOR PDC// FOR PDC// FOR PDC// FOR PDC// FOR PDC// FOR PDC// FOR PDC// FOR PDC// FOR PDC// FOR PDC// FOR PDC// FOR PDC// FOR PDC// FOR PDC// FOR PDC
			
			
			//CODE TO CHECK IF STUDENT IS ENROLLED TO ANY PDC
			$isTrue_PDC= false; 
			$PDC_progress = 0;
			$stmt_pdc_exist = $conn->prepare("SELECT * FROM student WHERE username LIKE ? AND (`PDC-MOTOR` IS NOT NULL OR `PDC-CAR` IS NOT NULL)");
			$stmt_pdc_exist->bind_param("s", $USERNAME);
			$stmt_pdc_exist->execute();
			$result_pdc_exist = $stmt_pdc_exist->get_result();
			
			if ($row_pdc_exist = $result_pdc_exist->fetch_assoc()) {
				
					$PDC_MS_1 = 0;
					$PDC_MS_2  = 0;
					$PDC_CS_1 = 0;
					$PDC_CS_2  = 0;
					
					// If student is enrolled in BOTH car and motorcylce PDC
					$stmt2 = $conn->prepare("SELECT * FROM student WHERE 
					`PDC-MOTOR` LIKE 'Motorcycle%' AND `PDC-CAR` LIKE 'Car%' AND username LIKE ?");
					$stmt2->bind_param("s", $USERNAME);
					$stmt2->execute();
					$result2 = $stmt2->get_result();

					// Fetch the result
					if ($row = $result2->fetch_assoc()) {
							//MS1 = Motorcycle Session 1
							$sql_MS1 = "SELECT * FROM pdc_result WHERE 
							Username = '$USERNAME' AND PDC_Course_enrolled LIKE 'Motorcycle%' 
							AND session = 1 AND Assessment = 'pass'";
							$result_MS1 = $conn->query($sql_MS1);
							$row_MS1 = $result_MS1->fetch_assoc();
							if ($row_MS1) {
								$PDC_MS_1 = 25;
							};
							
							 //MS2 = Motorcycle Session 2
							$sql_MS2 = "SELECT * FROM pdc_result WHERE 
							Username = '$USERNAME' AND PDC_Course_enrolled 
							LIKE 'Motorcycle%' AND session = 2 AND Assessment = 'pass'";
							
							$result_MS2 = $conn->query($sql_MS2);
							$row_MS2 = $result_MS2->fetch_assoc();
							if ($row_MS2) {
								$PDC_MS_2  = 25;
							};
						
							// checking if done with the sessions for CAR(mt/at)     //CS1 = CAR Session 1
							$sql_CS1 = "SELECT * FROM pdc_result WHERE Username = '$USERNAME' AND PDC_Course_enrolled LIKE 'Car%' AND session = 1 AND Assessment = 'pass'";
							$result_CS1 = $conn->query($sql_CS1);
							$row_CS1 = $result_CS1->fetch_assoc();
							if ($row_CS1) {
								$PDC_CS_1 = 25;
							};
							 //CS2 = CAR Session 2
							$sql_CS2 = "SELECT * FROM pdc_result WHERE Username = '$USERNAME' AND PDC_Course_enrolled LIKE 'Car%' AND session = 2 AND Assessment = 'pass'";
							$result_CS2 = $conn->query($sql_CS2);
							$row_CS2 = $result_CS2->fetch_assoc();
							if ($row_CS2) {
								$PDC_CS_2 = 25;
							};
							$stmt2->close();
					} else {
						// If student is enrolled in Motorcylce PDC ONLY
						$stmt2 = $conn->prepare("SELECT * FROM student WHERE `PDC-MOTOR` LIKE 'Motorcycle%' AND username LIKE ?");
						$stmt2->bind_param("s", $USERNAME);
						$stmt2->execute();
						$result2 = $stmt2->get_result();

						// Fetch the result
						if ($row = $result2->fetch_assoc()) {
								//MS1 = Motorcycle Session 1
								$sql_MS1 = "SELECT * FROM pdc_result WHERE Username = '$USERNAME' AND PDC_Course_enrolled LIKE 'Motorcycle%' AND session = 1 AND Assessment = 'pass'";
								$result_MS1 = $conn->query($sql_MS1);
								$row_MS1 = $result_MS1->fetch_assoc();
								if ($row_MS1) {
									$PDC_MS_1 = 50;
								};
								
								 //MS2 = Motorcycle Session 2
								$sql_MS2 = "SELECT * FROM pdc_result WHERE Username = '$USERNAME' AND PDC_Course_enrolled LIKE 'Motorcycle%' AND session = 2 AND Assessment = 'pass'";
								$result_MS2 = $conn->query($sql_MS2);
								$row_MS2 = $result_MS2->fetch_assoc();
								if ($row_MS2) {
									$PDC_MS_2  = 50;
								};
								$stmt2->close();	
						} else {
							// If student is enrolled in CAR PDC only
								$stmt2 = $conn->prepare("SELECT * FROM student WHERE `PDC-CAR` LIKE 'Car%' AND username LIKE ?");
								$stmt2->bind_param("s", $USERNAME);
								$stmt2->execute();
								$result2 = $stmt2->get_result();

								// Fetch the result
								if ($row = $result2->fetch_assoc()) {
										// checking if done with the sessions for CAR(mt/at)     //CS1 = CAR Session 1
										$sql_CS1 = "SELECT * FROM pdc_result WHERE Username = '$USERNAME' AND PDC_Course_enrolled LIKE 'Car%' AND session = 1 AND Assessment = 'pass'";
										$result_CS1 = $conn->query($sql_CS1);
										$row_CS1 = $result_CS1->fetch_assoc();
										if ($row_CS1) {
											$PDC_CS_1 = 50;
										};
										 //CS2 = CAR Session 2
										$sql_CS2 = "SELECT * FROM pdc_result WHERE Username = '$USERNAME' AND PDC_Course_enrolled LIKE 'Car%' AND session = 2 AND Assessment = 'pass'";
										$result_CS2 = $conn->query($sql_CS2);
										$row_CS2 = $result_CS2->fetch_assoc();
										if ($row_CS2) {
											$PDC_CS_2 = 50;
										};
										$stmt2->close();
								} else {
									// No data in the table, variable remains 0
								}
						}
					}
					
								
								

							
			} else {
				$isTrue_PDC= true; 
				
			}
								// value for TDC
								if ($isTrue_TDC && !$isTrue_PDC){
									$PDC_progress = ($PDC_MS_1 + $PDC_MS_2) + ($PDC_CS_1 + $PDC_CS_2);
									
								}else if ($isTrue_PDC && !$isTrue_TDC){
									$TDC_progress = $TDC_progress + $Session_1_status + $Session_2_status + $Session_3_status;
								}
								else{
									$TDC_progress = $Session_1_status + $Session_2_status + $Session_3_status;
									$PDC_progress = ($PDC_MS_1 + $PDC_MS_2) + ($PDC_CS_1 + $PDC_CS_2);
								}
			$stmt_pdc_exist->close();
			
		// END OF PDC // END OF PDC // END OF PDC // END OF PDC // END OF PDC // END OF PDC // END OF PDC // END OF PDC // END OF PDC // END OF PDC // END OF PDC // END OF PDC 
		?>
	
	
					<div class="progress_container">
						<div class="circle_prog_con">
							<div class="PDC_TDCprog_cont1" id="progress_TDC">
								<div class="progress_sirkol3" >
									<center>
										<div class="progress-bar-title">TDC PROGRESS</div>
									</center>
                                    <center>
                                        <svg class="progress3-bar-svg" width="250" height="250">
                                        <circle class="progress-bar-track" cx="120" cy="120" r="100"></circle>
                                        <circle class="progress3-bar-fill" cx="120" cy="120" r="100"></circle>
                                    </svg>
                                    </center>
									<span class="progress3-bar-text">0%</span>
								</div>
								<a class="certBtn" id="tdcCertificateBtn">TDC Certificate</a>
							</div>

							<div class="PDC_TDCprog_cont2" id="progress_PDC">
								<div class="progress_sirkol2">
									<center>
										<div class="progress-bar-title">PDC PROGRESS</div>
									</center>
                                    <center>
                                        <svg class="progress2-bar-svg" width="250" height="250">
                                        <circle class="progress-bar-track" cx="120" cy="120" r="100"></circle>
                                        <circle class="progress2-bar-fill" cx="120" cy="120" r="100"></circle>
                                    </svg>
                                    </center>
									<span class="progress2-bar-text">0%</span>
								</div>
								<a class="certBtn" id="pdcCertificateBtn">PDC Certificate</a> 
							</div>
						</div>
					</div>
	</div>
        
        
		<br><br>
        <div class="button_Container_Registration">
			<div class="inner_button_Container_Registration">
			<input type="submit" name="TDC_Submit" class="PDC_enrollment_btn" value="Edit" style="Display:<?php echo $none;?>;">
		</form>
			
			<form action="./php_scripts/Admin_stud_rec_del.php" method="post" onsubmit="return confirmDelete();">
				<input type="hidden" name="student_id" value="<?php echo $studentId; ?>">
				 <input type="submit" name="TDC_Reset" class="PDC_Reset_btn" value="Delete" style="Display:<?php echo $none;?>;">
			</form>
			
			<!-- For TDC Cert Approval -->
			<form action="./php_scripts/Cert_approval.php" method="post" onsubmit="return validateForm_TDC();">
			  <input type="hidden" name="student_id" value="<?php echo $studentId; ?>">
			  <input type="hidden" name="course" value="TDC">
			  <input type="submit" name="TDC_btn" class="TDC_btn" style="display: none;">
			</form>
			<!-- For PDC Cert Approval -->
			<form action="./php_scripts/Cert_approval.php" method="post" onsubmit="return validateForm_PDC();">
				<input type="hidden" name="student_id" value="<?php echo $studentId; ?>">
				<input type="hidden" name="course" value="PDC">
				<input type="submit" name="PDC_btn" class="PDC_btn" style="display: none;">
			</form>
			
			<!-- Add a "Back" button that navigates to the previous page -->
			<button onclick="goBack()" class="PDC_Back_btn">Back</button>

			</div>
		</div>
		
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function confirmAction(action, requestId, username, session) {
        var confirmation = false;
        if (action === 'approve') {
            confirmation = confirm('Are you sure you want to approve this request?');
        } else if (action === 'delete') {
            confirmation = confirm('Are you sure you want to delete this request?');
        }
        if (confirmation) {
            window.location.href = './php_scripts/approve_delete_process.php?' + action + '=' + requestId + '&username=' + username + '&session=' + session;
        }
    }


function submitForm(formId) {
    document.getElementById(formId).submit();
}

 $(document).ready(function() {
    // Attach click event to the "TDC Certificate" link
    $("#tdcCertificateBtn").on("click", function() {
      // Trigger the submit button click
      $(".TDC_btn").click();
    });

    // Attach click event to the "PDC Certificate" link (assuming you have it in your HTML)
    $("#pdcCertificateBtn").on("click", function() {
      // Trigger the submit button click
      $(".PDC_btn").click();
    });
  });

	   function validateForm_TDC() {
			// Assuming $balance and $TDC_progress are PHP variables
			var balance = <?php echo $balance; ?>;
			var TDC_progress = <?php echo $TDC_progress; ?>;

			// Perform validation
			if (balance !== 0) {
			  alert("The student must settle a remaining balance before being eligible to receive the certificate.");
			  return false; // Prevent form submission
			}

			if (TDC_progress !== 100) {
			  alert("The student is unable to obtain their certificates because they haven't completed their TDC requirements.");
			  return false; // Prevent form submission
			}

			return true; // Allow form submission
		  }
	
	 function validateForm_PDC() {
      // Assuming $balance and $PDC_progress are PHP variables
      var balance = <?php echo $balance; ?>;
      var PDC_progress = <?php echo $PDC_progress; ?>;

      // Perform validation
      if (balance !== 0) {
        alert("The student must settle a remaining balance before being eligible to receive the certificate.");
        return false; // Prevent form submission
      }

      if (PDC_progress !== 100) {
        alert("The student is unable to obtain their certificates because they haven't completed their PDC requirements.");
        return false; // Prevent form submission
      }

      return true; // Allow form submission
    }
	
</script>

<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this student?");
}

function confirmEdit() {
    return confirm("Are you sure you want to Edit this student?");
}

// JavaScript function to navigate back to the previous page
function goBack() {
    window.location.href = "./admin_enroll.php";
}
</script>
<!-- SCRIPT FOR HIDING TDC IF STUDENT IS NOT ENROLLED IN TDC-->

	<script>
    // Get the PHP variable value using PHP injection
    const isTrue_TDC = <?php echo json_encode($isTrue_TDC); ?>;

    // Get the container element TDC
    let container2 = document.getElementById("progress_TDC");
    const TDCtable = document.getElementById("TDCtable_Container");

    // Get the PHP variable value using PHP injection
    const isTrue_PDC = <?php echo json_encode($isTrue_PDC); ?>;

    // Get the container1 element PDC
    let container1 = document.getElementById("progress_PDC");
    const PDCtable = document.getElementById("PDCtable_Container");

    // Check the PHP variable value and set the CSS display property accordingly
    if (isTrue_TDC) {
        TDCtable.style.display = "none";
        container2.style.display = "none";
        container1.style.marginLeft = "auto";
        container1.style.marginRight = "auto";
    } else {
        container2.style.display = "block";
    }

    // Check the PHP variable value and set the CSS display property accordingly
    if (isTrue_PDC) {
        PDCtable.style.display = "none";
        container1.style.display = "none";
        container2.style.marginLeft = "auto";
        container2.style.marginRight = "auto";
    } else {
        container1.style.display = "block";
    }
</script>

	



<!--Script PDC progress bar-->
	<script>
		function updateProgressBar(percentage) {
			const progressBar = document.querySelector(".progress2-bar-fill");
			const progressBarText = document.querySelector(".progress2-bar-text");

			// Limit the percentage value between 0 and 100
			percentage = Math.min(100, Math.max(0, percentage));

			// Calculate the circumference of the circle (2 * π * radius)
			const circumference = 2 * Math.PI * parseInt(progressBar.getAttribute("r"));

			// Calculate the offset to fill the progress bar
			const offset = circumference - (percentage / 100) * circumference;

			// Update the progress bar's stroke-dashoffset property
			progressBar.style.strokeDashoffset = offset;

			// Update the progress bar text
			progressBarText.textContent = `${percentage}%`;
		}

		// Example: Call the function with a value (e.g., 50%)
		// Replace this value with the dynamic value you want to display
		const dynamicValue2 = <?php echo $PDC_progress ?? 1; ?> ;
		updateProgressBar(dynamicValue2);
	</script>


	<!--Script TDC progress bar-->
	<script>
		function updateProgressBar(percentage) {
			const progressBar = document.querySelector(".progress3-bar-fill");
			const progressBarText = document.querySelector(".progress3-bar-text");

			// Limit the percentage value between 0 and 100
			percentage = Math.min(100, Math.max(0, percentage));

			// Calculate the circumference of the circle (2 * π * radius)
			const circumference = 2 * Math.PI * parseInt(progressBar.getAttribute("r"));

			// Calculate the offset to fill the progress bar
			const offset = circumference - (percentage / 100) * circumference;

			// Update the progress bar's stroke-dashoffset property
			progressBar.style.strokeDashoffset = offset;

			// Update the progress bar text
			progressBarText.textContent = `${percentage}%`;
		}

		// Example: Call the function with a value (e.g., 50%)
		// Replace this value with the dynamic value you want to display
		const dynamicValue3 = <?php echo $TDC_progress ?? 1; ?> ;
		updateProgressBar(dynamicValue3);
		
		
		$(document).ready(function() {

		$('#logoutLink').click(function(event) {
				event.preventDefault(); // Prevent the default link behavior
				$.ajax({
					url: '../logout.php', // The URL of your PHP script to handle logout
					type: 'POST', // You can also use 'GET' if your server configuration allows
					success: function(response) {
						// Redirect to login.php on successful logout
						window.location.href = '../login.php';
					},
					error: function(xhr, status, error) {
						console.error(error); // Log any errors to the console
					}
				});
		  });
		});
		
	</script>


</body>
</html>