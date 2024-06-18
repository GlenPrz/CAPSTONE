<?php
include "../conn.php";
session_start();
include "./php_scripts/admin_Staffiles/AdminStaff_EDIT_ENROLL.php";
include "./php_scripts/admin_Staffiles/AdminStaff_DEL.php";

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
<style>
	body{
		background-color: #f7f7f7;
	}
    .main_content{
    display: block;
    width: 100%;
    margin-left: 2%;
    margin-top: 2%;
    height: 100%;
    float: left;
    }.main_cointainer{
    display: block;
    width: 100%;	
    }
    .User_Full_Name{
    display: flex;
    width: 100%;
    column-gap: 2%;
    }
    .secondRowOutput{
      display: flex;
    width: 100%;
    column-gap: 2%;  
    }

	.search-bar {
		margin: 0 auto;
		display: flex;
		border-radius: 10px; /* Rounded corners */
		background-color: #f7f7f7;
		border: 1px solid #ddd;
		width: 70%; /* Adjust the width as needed */
	}

	/* Style the search input field */
	.search-input {
		flex: 1;
		border: none;
		padding: 10px;
		border-radius: 10px 0 0 10px; /* Rounded left corner */
		width: 50%; /* Equal width for both input and button */
	}

	/* Style the search button */
	.srchBtn {
		border: none;
		background-color: #007bff; /* Blue color for the button */
		color: #fff;
		padding: 10px;
		cursor: pointer;
		border-radius: 0 10px 10px 0; /* Rounded right corner */
		width: 50%; /* Equal width for both input and button */
	}
	.srchBtn:hover {
		background-color: #082f59;
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
        width: 150px;
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
    }
	h3{
		font-weigtt: 300;
	}

	.DI_info{
		margin: 0 auto 2%;
		width: 70%;
		padding: 30px;
		border-radius: 10px;
		background-color: white;
		box-shadow: 2px 7px 8px rgba(0, 0, 0, .2); 
	}
	.STD_info{
		margin: 2% auto;
		width: 70%;
		padding: 30px;
		border-radius: 10px;
		background-color: white;
		box-shadow: 2px 7px 8px rgba(0, 0, 0, .2); 
	}
	.button_Container_Registration{
		margin: auto;
		width: 70%;
		text-align: center;
	}
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AssignStudent</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
    <link href="admin_styles/admin_nav.css" rel="stylesheet">
    <link href="./admin_styles/admin_Staff.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
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
			$Username = '';
			$Lastname = '';
			$Firstname = '';
			$Middlename = '';
			$Suffix = '';
			$Birthdate = '';
			$Civil_status = '';
			$Sex = '';
			$ContactNumber = '';
			$Address = '';
			$City = '';
			$DI_Training = '';

			$servername = "localhost";
            $username = "u896821908_bts";
            $password = "a*5E4UEhsHa]";
            $dbname = "u896821908_bts";
            
			$conn = new mysqli($servername, $username, $password, $dbname);

			// Check the connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			if (isset($_GET['id'])) {
				// Get the id_DI value from the URL
				$id_DI = $_GET['id'];

				// SQL query to retrieve all data of the Driver Instructor with the specified id
				$sql = "SELECT * FROM u896821908_bts.di WHERE id_DI = '$id_DI'";

				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					// Fetch and display the data
					$row = $result->fetch_assoc();
					$Username = $row['Username'];
					$Lastname = $row['Lastname'];
					$Firstname = $row['Firstname'];
					// Check if Middlename exists in the result before accessing it
					if (isset($row['Middlename'])) {
						$Middlename = $row['Middlename'];
					}
					$Suffix = $row['Suffix'];
					$Birthdate = $row['Birthdate'];
					$Civil_status  = $row['Civil_status'];
					$Sex = $row['Sex'];
					$ContactNumber = $row['ContactNumber'];
					$Address = $row['Address'];
					$City = $row['City'];
					$DI_Training = $row['DI_Training'];

					// Add more fields as needed
				} else {
					echo "Driver Instructor not found.";
				}
			} else {
				// If the id parameter is not set in the URL, handle the error or redirect as needed
				echo "id parameter not set in the URL";
			}

			// Close the database connection

			?>
			<div class="main_cointainer">
				<div class="DI_info">
					<output><h1>Driver Instructor Information:</h1></output><br>
					<label for="DI_name"><h2>Name:</h2></label>
					<div class="User_Full_Name" name="DI_name">
						<output><h3>&emsp;&emsp;<?php echo $Lastname; ?>,</h3></output>
						<output><h3><?php echo $Firstname; ?></h3></output>
						<output><h3><?php echo $Middlename; ?></h3></output>
						<output><h3><?php echo $Suffix; ?></h3></output>   
					</div><br>

					<output><h2>Birthdate:</h2></output>
					<div class="secondRowOutput">
						<output><h3>&emsp;&emsp;<?php echo $Birthdate; ?></h3></output>
						<output><h3><?php echo $Civil_status; ?></h3></output>
						<output><h3><?php echo $Sex; ?></h3></output>
						<output><h3><?php echo $ContactNumber; ?></h3></output>  
					</div><br>

					<output><h2>Address:</h2></output>
					<output><h3>&emsp;&emsp;<?php echo $Address . ', '. $City;  ?></h3></output><br>

					<output><h2>Nature of Accreditation:</h2></output>
					<output><h3>&emsp;&emsp;<?php echo $DI_Training; ?></h3></output> 
					<br><br>
				</div>

				<div class="STD_info">
				<?php
				 $diAssignQuery = "SELECT * FROM u896821908_bts.di_assign_tbl WHERE DI_id = '$id_DI' AND status = 'pending'";

					$diAssignResult = $conn->query($diAssignQuery);

					if ($diAssignResult->num_rows > 0) {
						$diAssignRow = $diAssignResult->fetch_assoc();
						$stud_id = $diAssignRow['Student_id'];

						// Query to retrieve additional student information from the students table
						$studentQuery = "SELECT * FROM u896821908_bts.student WHERE idStudent = '$stud_id'";
						$studentResult = $conn->query($studentQuery);

						if ($studentResult->num_rows > 0) {
							$studentRow = $studentResult->fetch_assoc();
							$lastname = $studentRow['Lastname'];
							$firstname = $studentRow['Firstname'];
							$middlename = $studentRow['Middlename'];
							$suffix = $studentRow['Suffix'];
							$student_permit_number = $studentRow['Student_permit_number'];

							// Now, you can fetch and display the data.
						}
				
						echo '<output><h2>Student Name:</h2></output>';
						echo '<output><h3>&emsp;&emsp;' . $lastname . ', ' . $firstname . ' ' . $middlename . ' ' . $suffix .'</h3></output><br>';
						echo '<output><h2>Student Permit Number:</h2></output>';
						echo '<output><h3>&emsp;&emsp;' . $student_permit_number . '</h3></output>';
					}	
				?>	
						</div><br>
					<div class="button_Container_Registration">
					<button onclick="goBack()" class="DI_Reset_btn">Back</button> 
					</div>
			 </div>
</div>

<script>
function goBack() {
            window.location.href = "./admin_Assign.php";
}
</script>
</body>
</html>