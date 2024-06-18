<?php
session_start();
if (empty($_SESSION['username'])) {
    header("Location: ../login.php");
}

include "../conn.php";
include "php_scripts/admin_Staffiles/AdminStaff_EDIT_ENROLL.php";
include "php_scripts/admin_Staffiles/AdminStaff_DEL.php";

//Dito ichecheck if teller or admin. pag teller then magiging none ang value nung $none
$none = '';
?>
<!DOCTYPE html>
<html lang="en">
<style>
.row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -15px;
    margin-bottom: 1%;
}

.col {
    flex: 0 0 calc(50% - 15px);
    padding: 0 15px;
    box-sizing: border-box;
}

#pdc_car {
    margin: 3% auto;
    border-radius: 10px;
    padding: 12px;
    background: #c6f7ba;
    box-shadow: 7px 7px 14px #8c9888, -3px -3px 10px #afb8ad;
}

.title {
    font-weight: bold;
    margin-bottom: 5px;
}

.val,
input[type="text"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
}

input[readonly] {
    background-color: #fff;
    border: none;
    box-shadow: none;
    color: #333;
    border-radius: 10px;
    background-color: white;
}

.assess {
    background-color: #eefaeb;
    margin-bottom: 3%;
    padding: 3%;
    width: 60%;
    box-shadow: 2px 10px 8px rgba(0, 0, 0, 0.2);
}

.Large_buttons {
    display: flex;
    text-align: center;
    align-items: center;
    justify-content: center;
}

.large-button {
    display: inline-block;
    padding: 18px 50px;
    font-size: 24px;
    color: white;
    font-weight: 600;
    text-decoration: none;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    margin: 0;
}

#session1 {
    background-color: #2ed162;
    margin-right: 5%;
}

#session2 {
    background-color: #f51616;
}

#session1:hover {
    background-color: #15612d;
    margin-right: 5%;
}

#session2:hover {
    background-color: #4f0808;
}

select {
    padding: 10px;
    font-size: 16px;
    border: 1px solid transparent;
    border-radius: 10px;
    width: 28.5%;
    box-sizing: border-box;
    margin: 2% 0;
}

select option {
    background-color: #fff;
    color: #333;
}

select option:checked {
    background-color: #007bff;
    color: #fff;
}



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
      flex-direction: row;
    }
   .outputItem {
        display: flex;
        flex-direction: column;
        margin-bottom: 10px; /* Adjust as needed */
    }
    
    .outputLabel {
        font-weight: bold;
        margin-bottom: 5px; /* Adjust as needed */
    }
	.search-bar {
		margin: 0 auto;
		display: flex;
		border-radius: 10px; /* Rounded corners */
		background-color: #f7f7f7;
		border: 1px solid #ddd;
		width: 100%; /* Adjust the width as needed */
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
		width: 100%;
		padding: 30px;
		border-radius: 10px;
		background-color: white;
		box-shadow: 2px 7px 8px rgba(0, 0, 0, .2); 
	}
	.STD_info{
		margin: 2% auto;
		width: 100%;
		padding: 30px;
		border-radius: 10px;
		background-color: white;
		box-shadow: 2px 7px 8px rgba(0, 0, 0, .2); 
	}
	.button_Container_Registration{
		text-align: center; 
		display: flex;
		margin: auto;
		width: 30%;
		text-align: center;
	}
	h3{
		color: green;
	}.main_cointainer{
	    width:70%;
	}
	
    .PDC_RESCHED_MSG {
        border: 2px solid red;
        padding: 15px;
        border-radius: 10px;
        background-color: #ffe6e6; /* Light red background color */
        margin: 20px 0; /* Add some margin for spacing */
    }

    .PDC_RESCHED_MSG h1 {
        color: red;
    }
    
    .PDC_NOTMATCH_MSG {
        border: 2px solid #ffcc00; /* Yellow border for warning */
        padding: 15px;
        border-radius: 10px;
        background-color: #ffeb99; /* Light yellow background color */
        margin: 20px 0; /* Add some margin for spacing */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a subtle box shadow for depth */
    }
    
    .PDC_NOTMATCH_MSG h2 {
        color: #ff6600; /* Darker orange text color for warning */
    }

</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AssignStudent</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
    <link href="admin_styles/admin_nav.css" rel="stylesheet">
    <link href="./admin_styles/admin_Assign.css" rel="stylesheet">
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
                    <a href="admin_sched.php" style="Display:<?php echo $none;?>;"><i class="far fa-calendar"></i> Schedule</a>
                    <a href="admin_enroll.php"><i class="fas fa-user-plus"></i> Enrollment</a>
                    <a href="admin_Pupdate.php" style="Display:<?php echo $none;?>;"><i class="fas fa-bullhorn"></i> Post Updates</a>
                    <a href="admin_reports.php" style="Display:<?php echo $none;?>;"><i class="fas fa-chart-bar"></i> Reports</a>
                    <a href="admin_Staff.php" style="Display:<?php echo $none;?>;"><i class="fas fa-users"></i> Staff</a>
                    <a href="admin_Assign.php"><i class="fas fa-tasks"></i> Assign</a>
                    <a href="admin_view_feedback.php" style="Display:<?php echo $none;?>;"><i class="fas fa-comment"></i> View Feedback</a>
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

				<div class="secondRowOutput">
                    <div class="outputItem">
                        <h2><div class="outputLabel">Birthdate:</div></h2>
                        <output><h3>&emsp;&emsp;<?php echo $Birthdate; ?></h3></output>
                    </div>
                
                    <div class="outputItem">
                        <h2><div class="outputLabel">Civil Status:</div></h2>
                        <output><h3><?php echo $Civil_status; ?></h3></output>
                    </div>
                
                    <div class="outputItem">
                        <h2><div class="outputLabel">Sex:</div></h2>
                        <output><h3><?php echo $Sex; ?></h3></output>
                    </div>
                
                    <div class="outputItem">
                        <h2><div class="outputLabel">Contact Number:</div></h2>
                        <output><h3><?php echo $ContactNumber; ?></h3></output>
                    </div>
                </div>

					<output><h2>Address:</h2></output>
					<output><h3>&emsp;&emsp;<?php echo $Address . ', '. $City;  ?></h3></output><br>

					<output><h2>Nature of Accreditation:</h2></output>
					<output><h3>&emsp;&emsp;<?php echo $DI_Training; ?></h3></output> 
					<br><br>
				</div>

				<form method="POST" action="">
					<div class="search-bar">
						<input type="text" name="search_bar" class="search-input" placeholder="Student Id">
						<input type="submit" name="search" class="srchBtn" value="Search">
					</div>
				</form>
				<div class="STD_info">
				<?php
					// Retrieve the Student ID from the form

				// Check if the form was submitted
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
				    					$student_id = $_POST['search_bar'];

				    //Sched Student
				    
				  try {
    // Database connection details
    $servername = "localhost";
    $username = "u896821908_bts";
    $password = "a*5E4UEhsHa]";
    $dbname = "u896821908_bts";

    // Create a connection
    $conn2 = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception
    $conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the SQL statement
    $sqlDate = "SELECT idStudent, Username, Lastname, Firstname, Middlename, Suffix, Birthdate, Contactnumber, 
                EmailAddress, Sex, Student_permit_number, `PDC-MOTOR`, `PDC-CAR`
                FROM u896821908_bts.student
                WHERE idStudent = :stud_id";

    // Prepare the SQL statement
    $stmtDate = $conn2->prepare($sqlDate);

    // Bind the parameter
    $stmtDate->bindParam(':stud_id', $student_id, PDO::PARAM_INT);

    // Execute the query
    if ($stmtDate->execute()) {
        // Fetch the data into variables
        $rowDate = $stmtDate->fetch(PDO::FETCH_ASSOC);

        if ($rowDate) {
            $idStudent = $rowDate['idStudent'];
            $Username = $rowDate['Username'];
            $Lastname = $rowDate['Lastname'];
            $Firstname = $rowDate['Firstname'];
            $Middlename = $rowDate['Middlename'];
            $Suffix = $rowDate['Suffix'];
            $Birthdate = $rowDate['Birthdate'];
            $Contactnumber = $rowDate['Contactnumber'];
            $EmailAddress = $rowDate['EmailAddress'];
            $Sex = $rowDate['Sex'];
            $Student_permit_number = $rowDate['Student_permit_number'];
            $PDC_MOTOR = $rowDate['PDC-MOTOR'];
            $PDC_CAR = $rowDate['PDC-CAR'];
            // Set the timezone to Philippines
            date_default_timezone_set('Asia/Manila');
            $currentDate = date("Y-m-d");

            if (!empty($PDC_MOTOR)) {
                $PDCmotor = '';
                // Prepare the SQL statement with a WHERE clause
                $sql_motor = "SELECT Student_Id, Username, PDC_Vechicle, schedule1, schedule2, Time1, Time2
                            FROM student_schedule_pdc
                            WHERE Student_Id = :idStudent AND PDC_Vechicle LIKE 'Motorcycle%'
                            ORDER BY idstudent_schedule DESC
                            LIMIT 1";

                $stmt_motor = $conn2->prepare($sql_motor);

                if (!$stmt_motor) {
                    throw new Exception("Error in SQL statement: " . implode(", ", $conn2->errorInfo()));
                }

                $stmt_motor->bindParam(':idStudent', $idStudent, PDO::PARAM_INT);

                if (!$stmt_motor->execute()) {
                    throw new Exception("Error executing query: " . implode(", ", $stmt_motor->errorInfo()));
                }

                $result_motor = $stmt_motor->fetchAll(PDO::FETCH_ASSOC);

                // Fetch the results
                foreach ($result_motor as $row_motor) {
                    // Access the columns
                    $pdcVehicle_motor = $row_motor['PDC_Vehicle'];
                    $schedule1_motor = $row_motor['schedule1'];
                    $schedule2_motor = $row_motor['schedule2'];
                    $time1_motor = $row_motor['Time1'];
                    $time2_motor = $row_motor['Time2'];
                    
                    $PDC_M = false;

                    if ($currentDate > $schedule2_motor) {
                            $PDC_M = true;
                    }
                    
                }
            } else {
                $PDCmotor = 'none';
            }

            if (!empty($PDC_CAR)) {
                $PDCcar = '';
                // Prepare the SQL statement with a WHERE clause
                $sql_car = "SELECT Student_Id, Username, PDC_Vechicle, schedule1, schedule2, Time1, Time2
                            FROM student_schedule_pdc
                            WHERE Student_Id = :idStudent AND PDC_Vechicle LIKE 'Car%'
                            ORDER BY idstudent_schedule DESC
                            LIMIT 1";

                $stmt_car = $conn2->prepare($sql_car);

                if (!$stmt_car) {
                    throw new Exception("Error in SQL statement: " . implode(", ", $conn2->errorInfo()));
                }

                $stmt_car->bindParam(':idStudent', $idStudent, PDO::PARAM_INT);

                if (!$stmt_car->execute()) {
                    throw new Exception("Error executing query: " . implode(", ", $stmt_car->errorInfo()));
                }

                $result_car = $stmt_car->fetchAll(PDO::FETCH_ASSOC);

                // Fetch the results
                foreach ($result_car as $row_car) {
                    // Access the columns
                    $pdcVehicle_car = $row_car['PDC_Vehicle'];
                    $schedule1_car = $row_car['schedule1'];
                    $schedule2_car = $row_car['schedule2'];
                    $time1_car = $row_car['Time1'];
                    $time2_car = $row_car['Time2'];
                    
                    $PDC_C = false;

                    if ($currentDate > $schedule2_car) {
                            $PDC_C = true;
                    }
                }
            } else {
                $PDCcar = 'none';
            }
        }
        $disable_btn = "";
        $expire_msg = "none";
            if ($PDC_C || $PDC_M) {
                $expire_msg = "block";
                $disable_btn = "disabled";
            }
    } else {
        echo "Error executing query.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    // Close the connection
    $conn2 = null;
}
				    
				    
				    //Sched Student
				     
				

					// Establish a database connection
					$conn = new mysqli($servername, $username, $password, $dbname);

					// Check the connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}

					// SQL query to search for the student based on the Student ID
					$sql = "SELECT * FROM student WHERE idStudent = '$student_id' AND (`PDC-MOTOR` IS NOT NULL OR `PDC-CAR` IS NOT NULL);";
					
					$result = $conn->query($sql);

                  $LTOCodeM = "A(L1, L2, L3)";
                  $LTOCodeC = "B(M1)";

					if ($result->num_rows > 0) {
						// Student found, display the student details
						$row = $result->fetch_assoc();
						$std_id = $row['idStudent']; 
						$lastname = $row['Lastname'];
						$firstname = $row['Firstname'];
						$middlename = $row['Middlename'];
						$suffix = $row['Suffix'];
						$student_permit_number = $row['Student_permit_number'];
						$motor = $row['PDC-MOTOR'];
						$car = 'and ' . $row['PDC-CAR'];
						// Output the student details
						
						if ($motor === null){
							$motor = '';
						}
						if ($car === 'and '){
							$car = '';
						}
						
						$notcorrect_course = "none";
			            if ($DI_Training !== "Motorcyle_and_light_vehicle") {
                               if (strpos($Std_PDC_vehicle, $DI_Training) === false) {
                                // Embedding JavaScript to show an alert
                                $notcorrect_course = "block";
                                // echo '<script type="text/javascript">';
                                // echo 'alert("The Nature of Accreditation of the DI is not applicable to the student\'s course.");';
                                // echo '</script>';
                            } 
                        } 
						
						 $LTOCodeM = "A(L1, L2, L3)";
                  $LTOCodeC = "B(M1)";
                  
                  if (!empty($motor)) {
                      $motorC = $LTOCodeM;
                  }
                    
                    if (!empty($car)) {
                      $carC = $LTOCodeC;
                  }
						
						
						
						
						echo '<div style="display: flex;">
    						<div clas="left" style="width: 40%; margin-left: 3%;">';
        						echo '<output><h2>Student Name:</h2></output>';
        						echo '<output><h3>&emsp;&emsp;' . $lastname . ', ' . $firstname . ' ' . $middlename . ' ' . $suffix .'</h3></output><br>';
        						echo '<output><h2>Student Permit Number:</h2></output>';
        						echo '<output><h3>&emsp;&emsp;' . $student_permit_number . '</h3></output>';
        						echo '<output><h2>PDC Enrolled:</h2></output>';
        						echo '<output><h3>&emsp;&emsp;' . $motor .' '. $motorC .'<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $car .' '. $carC. '</h3></output>';
        					echo '</div>';
        					
    					   $Std_PDC_vehicle = $motor . ' ' . $car;
                         
                            echo '
                            <div class="right" style="width: 40%;">
                                <div class="PDC_NOTMATCH_MSG" style="display: '.$notcorrect_course.';">
                                    <h2>Accreditation mismatched Student Course</h2><br>
                                    <p>&nbsp;&nbsp;The Nature of Accreditation of the DI is not applicable to the student\'s course. You can still assign the student to the DI if you think the DI is capable of teaching the course.</p>
                                </div>
                                <div class="PDC_RESCHED_MSG" style="display: '.$expire_msg.';">
                                    <h1>Expired PDC Schedule</h1>
                                    <p>&nbsp;&nbsp; You can&rsquo;t assign this student to any Driving instructor because the student&rsquo;s schedule for PDC has expired. The student can reschedule on the dashboard of their portal.</p>
                                </div>
                            </div>
                        </div>
                        ';
     
                   

                            
                            
                        	echo '
			<div class="row">
			    <!--For PDC MOTOR -->
				<div class="col" style="display:'.$PDCmotor.';" id="pdc_car">
				
					<label class="title">PDC MOTOR:</label>
					<input type="text" class="val" placeholder="&nbsp;N/A" value="&nbsp;' . $PDC_MOTOR .' '.$LTOCodeM . '" readonly>
					
					<div class="row">
        				<div class="col">
        					<label class="title">Sched 1:</label>
        					<input type="text" class="val" value="&nbsp;' . $schedule1_motor . '" readonly>
        				</div>
        				<div class="col">
        					<label class="title">Time:</label>
        					<input type="text" class="val" value="&nbsp;' . $time1_motor . '" readonly>
        				</div>
        			</div>
        			<div class="row">
        				<div class="col">
        					<label class="title">Sched 2:</label>
        					<input type="text" class="val" value="&nbsp;' . $schedule2_motor . '" readonly>
        				</div>
        				<div class="col">
        					<label class="title">Time:</label>
        					<input type="text" class="val" value="&nbsp;' . $time2_motor . '" readonly>
        				</div>
        			</div>
				</div>
				
				<!--For PDC CAR -->
				<div class="col" style="display:'.$PDCcar.';" id="pdc_car">
				
					<label class="title">PDC CAR:</label>
					<input type="text" class="val" placeholder="&nbsp;N/A"  value="&nbsp;' . $PDC_CAR .' '.$LTOCodeC . '" readonly>
					
					<div class="row">
        				<div class="col">
        					<label class="title">Sched 1:</label>
        					<input type="text" class="val" value="&nbsp;' . $schedule1_car . '" readonly>
        				</div>
        				<div class="col">
        					<label class="title">Time:</label>
        					<input type="text" class="val" value="&nbsp;' . $time1_car . '" readonly>
        				</div>
        			</div>
        			<div class="row">
        				<div class="col">
        					<label class="title">Sched 2:</label>
        					<input type="text" class="val" value="&nbsp;' . $schedule2_car . '" readonly>
        				</div>
        				<div class="col">
        					<label class="title">Time:</label>
        					<input type="text" class="val" value="&nbsp;' . $time2_car . '" readonly>
        				</div>
        			</div>
  
				</div>
			</div>';  
		            	
					} else {
						echo '<output><h2>Student not found.</h2></output>';
						
					}

					// Close the database connection
					$conn->close();
				}
				?>
						
					<div class="button_Container_Registration">
					<?php
					if (isset($std_id) && !empty($std_id)) {
						// Display the form only if $std_id has a value
						echo '<form method="POST" action="php_scripts/assign_std.php" onsubmit="return confirm(\'Are you sure you want to assign this student to this DI?\');">';
						echo '<input type="hidden" name="DI_id" value="' . $id_DI . '">';
						echo '<input type="hidden" name="di_username" value="' . $Username . '">';
						echo '<input type="hidden" name="std_id" value="' . $std_id . '">';
						echo '<input type="submit" name="DI_Submit" class="DI_enrollment_btn" '. $disable_btn  .'>';
						echo '</form>';

						echo '<button onclick="goBack2()" class="DI_Reset_btn">Back</button>';
					} else {
						?>
						<button onclick="validate()" class="DI_enrollment_btn">Submit</button>
						<button onclick="goBack()" class="DI_Reset_btn">Back</button>
								<script>
									// Get the button element by its class name
									var button = document.querySelector('.DI_enrollment_btn');

									// Add a click event listener to the button
									button.addEventListener('click', function() {
										// Display an alert when the button is clicked
										alert('You have to choose a student first.');
									});
								</script>
					<?php	
					}
					
					?>	
					</div>
					</div><br>
			 </div>
</div>

<script>
function goBack() {
       window.location.href = 'admin_Assign.php';

}
function goBack2() {
        window.history.go(-2);

}

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

</body>
</html>
			