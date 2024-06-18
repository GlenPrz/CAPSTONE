<?php
session_start();
include "../conn.php";
include("EDIT_PROFILE_MDL.php");
// Set the timezone to Philippines
date_default_timezone_set('Asia/Manila');


$query = "SELECT * FROM u896821908_bts.newupdate;";
$stmt = $conn->prepare($query);
$stmt->execute();

$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
$STDdashStraight = $_SESSION['username'];
$_SESSION['StudentSessionDash'] = $STDdashStraight;



?>

<script>
 if (screen.width <= 1000) {
        window.location = "../login.php";
    }
</script>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>BTS Driving school</title>
	<link rel="icon" type="image/x-icon" href="../img/favicon.ico">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="STUDENT_PORTAL.css">
	<link href="studentstyle/stdhome.css" rel="stylesheet">
	<link rel="stylesheet" href="STD_NAV.css">
	<link rel="stylesheet" href="../modalsStyle/modal_signup.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<style>
.titleNews{
    display:inline-block;
}
    .AnnHistory{
        margin-left:5%;
            display:inline-block;
        font-size:35px;
        padding:1%;
    }
        .AnnHistory:hover{
            color:orange;
cursor: pointer;
            
        }
     .PDC_RESCHED_MSG {
        text-align: center;
        padding: 20px;
        background-color: #d4edda;
        border: 2px solid #28a745;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        width: 70%;
        margin: auto;
        margin-top: 2%;
        margin-bottom: 4%;
    }

    .PDC_RESCHED_MSG h1 {
        color: #28a745;
        font-size: 28px;
    }

    .PDC_RESCHED_MSG p {
        text-align: justify;
        font-size: 18px;
        margin-bottom: 15px;
    }

    .PDC_RESCHED_MSG button {
        padding: 10px 20px;
        background-color: #28a745;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 18px;
        cursor: pointer;
    }
     .PDC_RESCHED_MSG button:hover {
        background-color: #218838;
    }
</style>

<body>

	<?php
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
			//Get the username value
			$USERNAME = $_SESSION['username'];
			$TDC_progress = 0;
			
			$sql = "SELECT idStudent FROM u896821908_bts.student WHERE username = ?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("s", $USERNAME);
			$stmt->execute();
			$stmt->bind_result($std_id); // Assign the value to the variable $std_id

			if ($stmt->fetch()) {
				// Set the idStudent value in the session
				$_SESSION['idStudent'] = $std_id;
			} 
			$stmt->close();
			
//FOR TDC//FOR TDC//FOR TDC//FOR TDC//FOR TDC//FOR TDC//FOR TDC//FOR TDC//FOR TDC//FOR TDC//FOR TDC//FOR TDC//FOR TDC//FOR TDC//FOR TDC//FOR TDC			
			
			$TDC_progress = 0;
			$isTrue_TDC = false;
			$stmt_tdc_exist = $conn->prepare("SELECT * FROM u896821908_bts.student WHERE  username LIKE ? AND TDC IS NOT NULL ");
			$stmt_tdc_exist->bind_param("s", $USERNAME);
			$stmt_tdc_exist->execute();
			$result_tdc_exist = $stmt_tdc_exist->get_result();
			
			if ($row_tdc_exist = $result_tdc_exist->fetch_assoc()) {	
			// FOR SESSION 1
				$stmt = $conn->prepare("SELECT * FROM u896821908_bts.student_result WHERE Session_num = 1 AND result = 'Passed' AND username = ?");
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
				$stmt = $conn->prepare("SELECT * FROM u896821908_bts.student_result WHERE 
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
				$stmt = $conn->prepare("SELECT * FROM u896821908_bts.student_result WHERE 
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
			$stmt_pdc_exist = $conn->prepare("SELECT * FROM u896821908_bts.student WHERE `PDC-MOTOR` IS NOT NULL AND `PDC-CAR` IS NOT NULL AND username LIKE ?");
			$stmt_pdc_exist->bind_param("s", $USERNAME);
			$stmt_pdc_exist->execute();
			$result_pdc_exist = $stmt_pdc_exist->get_result();
			$isTrue_PDC = false;
			
			if ($row_pdc_exist = $result_pdc_exist->fetch_assoc()) {
				
					$PDC_MS_1 = 0;
					$PDC_MS_2  = 0;
					$PDC_CS_1 = 0;
					$PDC_CS_2  = 0;
					
					// If student is enrolled in BOTH car and motorcylce PDC
					$stmt2 = $conn->prepare("SELECT * FROM u896821908_bts.student WHERE 
					`PDC-MOTOR` LIKE 'Motorcycle%' AND `PDC-CAR` LIKE 'Car%' AND username LIKE ?");
					$stmt2->bind_param("s", $USERNAME);
					$stmt2->execute();
					$result2 = $stmt2->get_result();

					// Fetch the result
					if ($row = $result2->fetch_assoc()) {
							//MS1 = Motorcycle Session 1
							$sql_MS1 = "SELECT * FROM u896821908_bts.pdc_result WHERE 
							Username = '$USERNAME' AND PDC_Course_enrolled LIKE 'Motorcycle%' 
							AND session = 1 AND Assessment = 'pass'";
							$result_MS1 = $conn->query($sql_MS1);
							$row_MS1 = $result_MS1->fetch_assoc();
							if ($row_MS1) {
								$PDC_MS_1 = 25;
							};
							
							 //MS2 = Motorcycle Session 2
							$sql_MS2 = "SELECT * FROM u896821908_bts.pdc_result WHERE 
							Username = '$USERNAME' AND PDC_Course_enrolled 
							LIKE 'Motorcycle%' AND session = 2 AND Assessment = 'pass'";
							
							$result_MS2 = $conn->query($sql_MS2);
							$row_MS2 = $result_MS2->fetch_assoc();
							if ($row_MS2) {
								$PDC_MS_2  = 25;
							};
						
							// checking if done with the sessions for CAR(mt/at)     //CS1 = CAR Session 1
							$sql_CS1 = "SELECT * FROM u896821908_bts.pdc_result WHERE Username = '$USERNAME' AND PDC_Course_enrolled LIKE 'Car%' AND session = 1 AND Assessment = 'pass'";
							$result_CS1 = $conn->query($sql_CS1);
							$row_CS1 = $result_CS1->fetch_assoc();
							if ($row_CS1) {
								$PDC_CS_1 = 25;
							};
							 //CS2 = CAR Session 2
							$sql_CS2 = "SELECT * FROM u896821908_bts.pdc_result WHERE Username = '$USERNAME' AND PDC_Course_enrolled LIKE 'Car%' AND session = 2 AND Assessment = 'pass'";
							$result_CS2 = $conn->query($sql_CS2);
							$row_CS2 = $result_CS2->fetch_assoc();
							if ($row_CS2) {
								$PDC_CS_2 = 25;
							};
							$stmt2->close();
					} else {
						// If student is enrolled in Motorcylce PDC ONLY
						$stmt2 = $conn->prepare("SELECT * FROM u896821908_bts.student WHERE `PDC-MOTOR` LIKE 'Motorcycle%' AND username LIKE ?");
						$stmt2->bind_param("s", $USERNAME);
						$stmt2->execute();
						$result2 = $stmt2->get_result();

						// Fetch the result
						if ($row = $result2->fetch_assoc()) {
								//MS1 = Motorcycle Session 1
								$sql_MS1 = "SELECT * FROM u896821908_bts.pdc_result WHERE Username = '$USERNAME' AND PDC_Course_enrolled LIKE 'Motorcycle%' AND session = 1 AND Assessment = 'pass'";
								$result_MS1 = $conn->query($sql_MS1);
								$row_MS1 = $result_MS1->fetch_assoc();
								if ($row_MS1) {
									$PDC_MS_1 = 50;
								};
								
								 //MS2 = Motorcycle Session 2
								$sql_MS2 = "SELECT * FROM u896821908_bts.pdc_result WHERE Username = '$USERNAME' AND PDC_Course_enrolled LIKE 'Motorcycle%' AND session = 2 AND Assessment = 'pass'";
								$result_MS2 = $conn->query($sql_MS2);
								$row_MS2 = $result_MS2->fetch_assoc();
								if ($row_MS2) {
									$PDC_MS_2  = 50;
								};
								$stmt2->close();	
						} else {
							// If student is enrolled in CAR PDC only
								$stmt2 = $conn->prepare("SELECT * FROM u896821908_bts.student WHERE `PDC-CAR` LIKE 'Car%' AND username LIKE ?");
								$stmt2->bind_param("s", $USERNAME);
								$stmt2->execute();
								$result2 = $stmt2->get_result();

								// Fetch the result
								if ($row = $result2->fetch_assoc()) {
										// checking if done with the sessions for CAR(mt/at)     //CS1 = CAR Session 1
										$sql_CS1 = "SELECT * FROM u896821908_bts.pdc_result WHERE Username = '$USERNAME' AND PDC_Course_enrolled LIKE 'Car%' AND session = 1 AND Assessment = 'pass'";
										$result_CS1 = $conn->query($sql_CS1);
										$row_CS1 = $result_CS1->fetch_assoc();
										if ($row_CS1) {
											$PDC_CS_1 = 50;
										};
										 //CS2 = CAR Session 2
										$sql_CS2 = "SELECT * FROM u896821908_bts.pdc_result WHERE Username = '$USERNAME' AND PDC_Course_enrolled LIKE 'Car%' AND session = 2 AND Assessment = 'pass'";
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
				$isTrue_PDC = true; 
			}
			$stmt_pdc_exist->close();
			
			if ($isTrue_TDC){
				$PDC_progress = ($PDC_MS_1 + $PDC_MS_2) + ($PDC_CS_1 + $PDC_CS_2);
				$OVERALL_progress =	$PDC_progress;				
			}else if($isTrue_PDC){
				$TDC_progress = $TDC_progress + $Session_1_status + $Session_2_status + $Session_3_status;
				$OVERALL_progress = $TDC_progress ;
			}else if(!$isTrue_PDC AND !$isTrue_TDC){
				$TDC_progress = $Session_1_status + $Session_2_status + $Session_3_status;
				$PDC_progress = ($PDC_MS_1 + $PDC_MS_2) + ($PDC_CS_1 + $PDC_CS_2);
				$OVERALL_progress = ROUND(($TDC_progress / 3 + $Filler) + ($PDC_progress / 2), 2);
								
			}
			//FOR PDC ENROLLMENT BUTTON	
			$disableButton = ($TDC_progress !== 100) ? 'disabled' : '';
			$_SESSION['TDC_progress'] = $TDC_progress;
			
			$querySTDname = "SELECT Lastname, Firstname FROM u896821908_bts.student WHERE Username = ?";
			$stmtSTDname = $conn->prepare($querySTDname);
			
			if ($stmtSTDname) {
				$stmtSTDname->bind_param('s', $_SESSION['username']);
				$stmtSTDname->execute();
				$stmtSTDname->bind_result($lastname, $firstname);
				
				if ($stmtSTDname->fetch()) {
				
					$_SESSION['STD_Fullname'] = $lastname. " " . $firstname;
				} else {
				}
			
				$stmtSTDname->close(); // Close the statement when done.
			}

			?>



	<div class="stud_Container">
		<div class="nav_student">
			<div class="profile" id="profile-box">
				<img src="../uploads/<?php echo basename($profilePicture); ?>" alt="Profile Picture" />
				<div class="namecon">
					<span class="username"><?php echo $lastname . ", " .$firstname?></span><br>
					<span class="email">Student Id: <?php echo $std_id ?></span>
				</div>
				<!--DITO USERNAME VARIABLE NG STUDENT-->
			</div>
			<?php

			if ($isTrue_TDC) {
				echo'
					<nav>
						<div class="nav_links" id="navslist">
							<a href="STD_HOME.php"><i class="fas fa-home"></i> Home</a>
							<a href="STD_ACC_PAYABLE.php"><i class="fas fa-money-bill"></i> Transaction</a>
							<a href="STD_EVALUATION_FORM.php"><i class="fas fa-comment"></i> Feedback</a>
							<a href="#" id="EditProf_btn"><i class="fas fa-user"></i> Edit Profile</a>
							<a href="" id="logoutLink"><i class="fas fa-sign-out-alt"></i> Log Out</a>
						</div>
						<center>
							<div class="logo_container">
								<img src="../img/bts_logo.png" class="admin_logo">
							</div><br>
							<h2 style="color: green;">Best Training School</h2>
						</center>
					</nav>';		
			} else {
				echo'
						<nav>
						<div class="nav_links" id="navslist">
							<a href="STD_HOME.php"><i class="fas fa-home"></i> Home</a>
							<a href="STD_ACC_PAYABLE.php"><i class="fas fa-money-bill"></i> Transaction</a>
							<a href="STD_MODULE_EXAM.php"><i class="fas fa-book"></i> Module / Exam</a>
							<a href="STD_EVALUATION_FORM.php"><i class="fas fa-comment"></i> Feedback</a>
							<a href="#" id="EditProf_btn"><i class="fas fa-user"></i> Edit Profile</a>
							<a href="" id="logoutLink"><i class="fas fa-sign-out-alt"></i> Log Out</a>
						</div>
						<center>
							<div class="logo_container">
								<img src="../img/bts_logo.png" class="admin_logo">
							</div><br>
							<h2 style="color: green;">Best Training School</h2>
						</center>
					</nav>';	
			}
			?>
		</div>
		<div>

			<h4 class="description">Home</h4>
			
			<br>
			<br>
            
           
			<div class="main_content">
				<center>
				    
         <?php
// Set the timezone to Philippines
date_default_timezone_set('Asia/Manila');
$currentDate = date("Y-m-d");

// SQL SELECT query for student_schedule_pdc
$sqlSchedMotor = "SELECT schedule1, schedule2 FROM student_schedule_pdc WHERE Student_Id = '$std_id' AND PDC_Vechicle LIKE 'Motor%'";
$resultSchedMotor = mysqli_query($conn, $sqlSchedMotor);

// Check if there are results
if (mysqli_num_rows($resultSchedMotor) > 0) {
    // Fetch data and output schedules
    while ($row = mysqli_fetch_assoc($resultSchedMotor)) {
        $schedule1 = $row["schedule1"];
        $schedule2 = $row["schedule2"];

        $PDC_M = false;

        if ($currentDate > $schedule2) {
            if ($PDC_progress != 100) {
                $PDC_M = true;
            }
        }
    }
}

$sqlCar = "SELECT schedule1, schedule2 FROM student_schedule_pdc WHERE Student_Id = '$std_id' AND PDC_Vechicle LIKE 'Car%'";
$resultCar = mysqli_query($conn, $sqlCar);

// Check if there are results
if (mysqli_num_rows($resultCar) > 0) {
    // Fetch data and output schedules
    while ($rowCar = mysqli_fetch_assoc($resultCar)) {
        $schedule1Car = $rowCar["schedule1"];
        $schedule2Car = $rowCar["schedule2"];
        $PDC_C = false;

        if ($currentDate > $schedule2Car) {
            if ($PDC_progressCar != 100) {
                $PDC_C = true;
            }
        }
    }
}

$pdc_display = "none";
if ($PDC_C || $PDC_M) {
    $pdc_display = "block";
}

?>


                <div class="PDC_RESCHED_MSG" style="display: <?php echo $pdc_display;?>">
                    <h1>Missed PDC Schedule</h1>
                    <p>Dear student, we noticed that you missed your scheduled PDC session. Don't worry, you have the opportunity to reschedule.</p>
                    <p>Please note that the reschedule is available only once, and there is no additional fee for rescheduling.</p>
                    <button id='reschedbtn' name='resched' onclick="redirectToReschedule('<?php echo $std_id; ?>')">Reschedule Now</button>
                </div>

     

                
                
				<div class="slide_show">
			<div class="slideshow-container">
				<?php foreach ($images as $key => $image): ?>
				<div class="mySlides fade">
					<div class="numbertext"><?php echo $key + 1; ?> / <?php echo count($images); ?></div>
					<img 
					src="../img/drive-download-20230614T125330Z-001/<?php echo basename($image['PICTURE']); ?>"
						class="Img_design_slider" data-id="<?php echo basename($image['PICTURE']); ?>"
						data-count="<?php echo $key + 1; ?>">
				</div>
				<?php endforeach; ?>
			</div>
		</div>
				</center>
				
				<br>

				<center>
					<header><center><h1>My Progress</h1></center></header>
				</center>
				<div class="Tdc_Pdc_Con">
					<div class="progress_container">


				
							<div class="circle_prog_con">
							<div class="progress_sirkol1">
								<center>
									<div class="progress-bar-title">OVERALL PROGRESS</div>
								</center>
								<center>
									<svg class="progress-bar-svg" width="250" height="250">
									<circle class="progress-bar-track" cx="120" cy="120" r="100"></circle>
									<circle class="progress-bar-fill" cx="120" cy="120" r="100"></circle>
								</svg>
								</center>
								
								<span class="progress-bar-text">0%</span>
							</div>

							<div class="progress_sirkol2" id="progress_sirkol2">
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


							<div class="progress_sirkol3" id="progress_sirkol3">
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
						</div>
						

					</div>
		
				</div>
				
				<center><button id="enrollButton" name='PDC_enroll' <?php echo $disableButton; ?> onclick='GoToPDCenrollment(<?php echo $std_id;?>)'>ENROLL TO PDC</button></center>
				<br><br>
				<div>
                <!--TDC RESULT PHP-->
                    <?php 
				       $stmtTDCResu = $conn->prepare("SELECT * FROM student_result WHERE Username = ?");
    $stmtTDCResu->bind_param("s", $USERNAME);
    $stmtTDCResu->execute();
    $resultsTDCResu = $stmtTDCResu->get_result();
				    ?>
				    
				    <!--TDC RESULT PHP-->
				    <header><h2>TDC RESULT</h2></header>
				    <table>
				        <tr>
				            <th>Session <?php echo $USERNAME; ?></th>
				            <th>Score</th>
				            <th>Wrong Answer</th>
				            <th>Result</th>
				        </tr>
				        <?php
				         while ($rowTDCResu = $resultsTDCResu->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $rowTDCResu['Session_num'] . "</td>";
                                echo "<td>" . $rowTDCResu['Score'] . "</td>";
                                echo "<td>" . $rowTDCResu['num_of_wrong_ans'] . "</td>";
                                echo "<td>" . $rowTDCResu['result'] . "</td>";
                                echo "</tr>";
                            }
                                ?>
				    </table>
				</div>
				
				<!--//ANN MODAL-->
				<div id="Modal_AnnouncementHistory" class="modal">

  <!-- Modal content -->
  <div class="modal-content_AnnouncementHistory">
    <div class="modal-header_AnnouncementHistory">
      <span class="close_AnnouncementHistory">&times;</span>
      <h2>Announcement History</h2>
      
       <label for="searchDate">Search by Date:</label>
    <input type="date" id="searchDate" name="searchDate">
    <button type="button" id="searchButton" class = "buttonSearch-5">Search</button>
    <button type="button" id="resetButton" class = "buttonReset-5">Reset</button>

    </div>
    <div class="modal-body_AnnouncementHistory">
      <?php
      // Fetch data from the table
$sql = "SELECT * FROM admin_updatepostdesc";
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Output data of each row
    echo "    <table border='1' id='dataTable'>
    <tr>
    <th>Date</th>
    <th>Title</th>
    <th>Description</th>
    </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>".$row["Date"]."</td>
        <td>".$row["Title"]."</td>
        <td>".$row["Description"]."</td>
        </tr>";
    }

    echo "</table>";
} else {
    echo "No result found";
}
      
      ?>
    </div>
    <div class="modal-footer_AnnouncementHistory">
      <h3>&nbsp</h3>
    </div>
  </div>

</div>
				
				
				
				<br><br>
				
				<center>
					<header>
					    <center><h1 class = "titleNews">NEWS ANNOUNCEMENTS AND SCHEDULES</h1> 					<i class="fa fa-history AnnHistory" aria-hidden="true" id = "Announcement_History"></i>
</center> 						
                    </header>
				</center>
				<div class="second-row-content">
					<center>
						<div class="Announcement">
						<h1 style="color: green; ">Daily Announcements</h1>

					
						<?php
						$today = date("Y-m-d"); 

				$query = "SELECT Title, Description FROM u896821908_bts.admin_updatepostdesc WHERE Date >= '$today' ORDER BY Date ASC";
				$result = $conn->query($query);

				if ($result !== false) {
    				if ($result->num_rows > 0) {
      				  while ($row = $result->fetch_assoc()) {
        				    echo "<div>";
       				    	echo "<br><h2>" . $row['Title'] . "</h2>";
         					echo "<p>" . $row['Description'] . "</p>";
        				    echo "</div>";
       				}
    					} else {
        				echo '<div><p>No posted Announcements for today.</p></div>';
   					 }
				} else {
    				echo "Error executing the query: " . $conn->error;
				}
					?>
							
							

						</div>
					</center><br><br>

					<div class="StudSched">

						<div class="sched_box">
							<header><center><h3>TDC Schedule</h3></center></header>
							<table class="result">
								<tr class="column_head">
									<td>Start</td>
									<td>End</td>
									<td>From</td>
									<td>To</td>
								</tr>
								<?php
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
						// Prepare and execute a query to retrieve the schedule data
						$sql = "SELECT schedule1, schedule2, Time1, Time2 FROM u896821908_bts.student_schedule_tdc WHERE Student_Id = ?";
						$stmt = $conn->prepare($sql);
						$stmt->bind_param("i", $std_id);
						$stmt->execute();
						$stmt->bind_result($schedule1, $schedule2, $Time1, $Time2);

						// Loop through the results and display them in the table
						if ($stmt->fetch()) {
							echo "<tr>";
							echo "<td>$schedule1</td>";
							echo "<td>$schedule2</td>";
							echo "<td>$Time1</td>";
							echo "<td>$Time2</td>";
							echo "</tr>";
						}else {
							// Handle the case where the student's ID doesn't exist in the database
							echo "<tr><td colspan='2' style='color:#f22424;'><b>Not Enrolled.</b></td></tr>";
						}
						$stmt->close();
						?>
							</table>
						</div>
						<div class="sched_box">
							<header><center><h3>PDC Schedule</h3></center></header>
							<table class="result">
								<tr class="column_head">
									<td>Start</td>
									<td>End</td>
									<td>From</td>
									<td>To</td>
								</tr>
								<?php
						// Prepare and execute a query to retrieve the schedule data
						$sql = "SELECT schedule1, schedule2, Time1, Time2 FROM u896821908_bts.student_schedule_pdc WHERE Student_Id = ?";
						$stmt = $conn->prepare($sql);
						$stmt->bind_param("i", $std_id);
						$stmt->execute();
						$stmt->bind_result($schedule1, $schedule2, $Time1, $Time2);

						// Loop through the results and display them in the table
						if ($stmt->fetch()) {
							echo "<tr>";
							echo "<td>$schedule1</td>";
							echo "<td>$schedule2</td>";
							echo "<td>$Time1</td>";
							echo "<td>$Time2</td>";
							echo "</tr>";
						}else {
							// Handle the case where the student's ID doesn't exist in the database
							echo "<tr><td colspan='2' style='color:#f22424;'><b>Not Enrolled.</b></td></tr>";
						}
						$stmt->close();
						?>
							</table>
						</div>
						<div class="sched_box">
							<header><center><h3>Remaining balance</h3></center></header>
							<table class="result">
								<tr class="column_head">
									<td>Total Fee</td>
									<td>Remaining Balance</td>
								</tr>
								<?php
					// Prepare and execute a query to retrieve the total_amount and balance
					$sql = "SELECT total_amount, balance FROM u896821908_bts.student WHERE idStudent = ?";
					$stmt = $conn->prepare($sql);
					$stmt->bind_param("i", $std_id);
					$stmt->execute();
					$stmt->bind_result($total_amount, $balance);

					// Fetch and display the data in the table
					if ($stmt->fetch()) {
						echo "<tr>";
						echo "<td>$total_amount</td>";
						echo "<td>$balance</td>";
						echo "</tr>";
					} else {
						// Handle the case where the student's ID doesn't exist in the database
						echo "<tr><td colspan='2' style='color:#f22424;'><b>Record not found.</b></td></tr>";
					}
					$stmt->close();
					?>
							</table>
						</div>


					</div>

				</div>
				<br><br>
				<center>
					<h2></h2>
				</center>
				
				
                
                <br><br>
				<center>
					<h2>MY CERTIFICATES</h2>
				</center>
				<div class="certi">
				<?php 
			
					$stmt = $conn->prepare("SELECT * FROM u896821908_bts.student WHERE username = ?");
					$stmt->bind_param("s", $USERNAME);
					$stmt->execute();
					$result = $stmt->get_result();
					
					if ($row = $result->fetch_assoc()) {
						// Set the idStudent value in the session
						$_SESSION['idStudent'] = $row['idStudent'];
						
						$TDCcert_isTrue = false;
						$PDCcert_isTrue = false;
						if($row['TDC_Cert_approve'] !== NULL){
							$TDCcert_isTrue = true;
						} 
						if($row['PDC_Cert_approve'] !== NULL){
							$PDCcert_isTrue = true;
						}
					} 
				?>
					<table class="result">
						<tr>
						<td>
							<?php if ($TDCcert_isTrue): ?>
								<a href="../Pdf/printable_CERT_TDC.php?id=<?php echo $USERNAME ?>" target="_blank">
									<button class="buttonTDC">TDC CERT</button>
								</a>
							<?php else: ?>
								<button class="buttonTDC" onclick="showAlert()">TDC CERT</button>
								<script>
									function showAlert() {
										alert("TDC Certificate is not yet available.");
										// You can perform additional actions or just show the alert
									}
								</script>
							<?php endif; ?>
						</td>
						<td>
							<?php if ($PDCcert_isTrue): ?>
								<a href="../Pdf/printable_CERT_PDC.php?id=<?php echo $USERNAME ?>" target="_blank">
									<button class="buttonPDC">PDC CERT</button>
								</a>
							<?php else: ?>
								<button class="buttonPDC" onclick="showPDCAlert()">PDC CERT</button>
								<script>
									function showPDCAlert() {
										alert("PDC Certificate is not yet available.");
										// You can perform additional actions or just show the alert
									}
								</script>
							<?php endif; ?>
						</td>

						</tr>
						<tr>
							<td></td>
							<td></td>
						</tr>
					</table>
				</div>

			</div>
		</div>

	</div>
	<!--//Script search announcement history-->
	
	 <script>
        document.getElementById('searchButton').addEventListener('click', function () {
            // Get the selected date
            var selectedDate = document.getElementById('searchDate').value;

            // Get the table and its rows
            var table = document.getElementById('dataTable');
            var rows = table.getElementsByTagName('tr');

            // Loop through all rows, hide those that don't match the search date
            for (var i = 1; i < rows.length; i++) { // start from index 1 to skip the header row
                var dateCell = rows[i].getElementsByTagName('td')[1]; // Assuming the date is in the second column

                if (dateCell) {
                    var cellDate = dateCell.textContent || dateCell.innerText;

                    if (cellDate === selectedDate) {
                        rows[i].style.display = ''; // Show the row
                    } else {
                        rows[i].style.display = 'none'; // Hide the row
                    }
                }
            }
        });

        document.getElementById('resetButton').addEventListener('click', function () {
            // Get the table and its rows
            var table = document.getElementById('dataTable');
            var rows = table.getElementsByTagName('tr');

            // Loop through all rows, show them
            for (var i = 1; i < rows.length; i++) { // start from index 1 to skip the header row
                rows[i].style.display = ''; // Show the row
            }

            // Reset the selected date
            document.getElementById('searchDate').value = '';
        });
    </script>
	
	
	
	<!-- SCRIPT PARA MA-REDIRECT -->
	<script>
		function Logout() {
			window.location.href = "../login.php";
		}
		
	 function GoToPDCenrollment(Student_id) {
    // Construct the URL with the Student_id parameter
    var url = "../Enrollment_PDC.php?Student_id=" + Student_id;

    // Redirect to the new page
    window.location.href = url;
  }
		
	
	</script>
	<br> <br>

	</div>
	</div>

	</div>
	<?php $conn->close();?>
	<!-- Sscript to redirect from container-box -->
	<script>
		function redirectToProgress() {
			window.location.href = "STD_PROGRESS.php";
		}
		
        function redirectToReschedule(id) {
            // Assuming you want to redirect to a page named reschedule.php
            window.location.href = 'reschedule.php?id=' + id;
        }

	</script>

	<!-- SCRIPT PARA SA BIRTHDATE -->
	<script>
		var modal_EditProf = document.getElementById("EditProf");
		var btn_EditProf = document.getElementById("EditProf_btn");
		var span_EditProf = document.getElementsByClassName("close_SignUp")[0];

		const input = document.getElementById('birthdate');
		const today = new Date();
		const maxDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate())
			.toISOString()
			.split('T')[0];
		input.setAttribute('max', maxDate);



		btn_EditProf.onclick = function () {
			modal_EditProf.style.display = "block";
		}

		span_EditProf.onclick = function () {
			modal_EditProf.style.display = "none";
		}
	</script>

<!-- HAMBURGER For NAV On progress  -->
	<!-- <script>
		var Hamburger = document.getElementById("Hamburger");
		var navs = document.getElementById("navslist");
		var isNavVisible = true;

		Hamburger.onclick = function () {
			if (isNavVisible) {
				hideNav();
			} else {
				showNav();
			}
		};
		function hideNav() {
			navs.style.display = "none";
			Hamburger.classList.remove("fa-times");
			Hamburger.classList.add("fa-bars");
			isNavVisible = false;
		}
		function showNav() {
			navs.style.display = "block";
			Hamburger.classList.remove("fa-bars");
			Hamburger.classList.add("fa-times");
			isNavVisible = true;
		}
		function handleResize() {
			if (window.innerWidth < 768) {
				showNav();
			}
		}
		window.addEventListener("resize", handleResize);
		handleResize();
	</script> -->

	<script>
	let slideIndex = 0;
    let slides = document.getElementsByClassName("mySlides");

    showSlides();

    function showSlides() {
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex >= slides.length) {
            slideIndex = 0;
        }
        slides[slideIndex].style.display = "block";
        setTimeout(showSlides, 4000); // Change image every 4 seconds
    }
	</script>

	<!-- SCRIPT FOR HIDING TDC IF STUDENT IS NOT ENROLLED IN TDC-->
	<script>
		// Get the PHP variable value for TDC using PHP injection
		const isTrue_TDC = <?php echo $isTrue_TDC ? 'true' : 'false'; ?> ;

		// Get the container element for TDC
		const container_TDC = document.getElementById("progress_sirkol3");

		// Check the PHP variable value and set the CSS display property accordingly
		if (isTrue_TDC) {
			container_TDC.style.display = "none";
		} else {
			container_TDC.style.display = "block";
		}
	</script>

	<!-- SCRIPT FOR HIDING PDC IF STUDENT IS NOT ENROLLED IN PDC-->
	<script>
		// Get the PHP variable value for PDC using PHP injection
		const isTrue_PDC = <?php echo $isTrue_PDC ? 'true' : 'false'; ?> ;

		// Get the container element for PDC
		const container_PDC = document.getElementById("progress_sirkol2");
		var enrollButton = document.getElementById("enrollButton");
		// Check the PHP variable value and set the CSS display property accordingly
		if (isTrue_PDC) {
			enrollButton.style.display = "block";
			container_PDC.style.display = "none";
		} else {
			container_PDC.style.display = "block";
			enrollButton.style.display = "none";
		}
	</script>

	<!-- SCRIPT PARA SA BIRTHDATE -->
	<script>
		var modal_EditProf = document.getElementById("EditProf");
		var btn_EditProf = document.getElementById("EditProf_btn");
		var span_EditProf = document.getElementsByClassName("close_SignUp")[0];

		//   const input = document.getElementById('birthdate');
		//   const today = new Date();
		//   const maxDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate())
		// 	.toISOString()
		// 	.split('T')[0];

		//   input.setAttribute('max', maxDate);

		btn_EditProf.onclick = function () {
			modal_EditProf.style.display = "block";
		}

		span_EditProf.onclick = function () {
			modal_EditProf.style.display = "none";
		}
	</script>
	<!--Hanggang dito copy-->

	<script>
		// Update the progress bar width and value
		function updateProgressBar(progress, progressBarId) {
			var progressBar = document.getElementById(progressBarId);
			progressBar.style.width = progress + "%";
			progressBar.textContent = progress + "%";
		}

		// Example usage
		var currentProgress1 = 21;
		updateProgressBar(currentProgress1, "progress1");

		var currentProgress2 = 45;
		updateProgressBar(currentProgress2, "progress2");
	</script>


	<!--Script OVERALL PROGRESS bar-->
	<script>
		function updateProgressBar(percentage) {
			const progressBar = document.querySelector(".progress-bar-fill");
			const progressBarText = document.querySelector(".progress-bar-text");

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
		const dynamicValue = <?php echo $OVERALL_progress ?? 1; ?> ;
		updateProgressBar(dynamicValue);
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
	</script>


	<!-- LOGOUT -->
<script>
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

<script>
// Get the modal
var modalAnnouncementHistory = document.getElementById("Modal_AnnouncementHistory");

// Get the button that opens the modal
var btnAnnouncementHistory = document.getElementById("Announcement_History");

// Get the <span> element that closes the modal
var spanAnnouncementHistory = document.getElementsByClassName("close_AnnouncementHistory")[0];

// When the user clicks the button, open the modal 
btnAnnouncementHistory.onclick = function() {
  modalAnnouncementHistory.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
spanAnnouncementHistory.onclick = function() {
  modalAnnouncementHistory.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modalAnnouncementHistory) {
    modalAnnouncementHistory.style.display = "none";
  }
}
</script>

</body>

</html>