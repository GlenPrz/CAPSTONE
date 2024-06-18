
<?php
session_start();
include "../conn.php";
include "./Script_php/Selection_Student.php";

if (!isset($_SESSION['username'])) {
    // Redirect the user to the desired location (e.g., login page)
    header('Location: ../login.php');
    exit; // Make sure to exit after the redirection to prevent further code execution
}
$Didate = $_SESSION['username'];
// Retrieve the data from the database
$stmtDi = $conn->prepare("SELECT id_DI,Email, CONCAT(LastName, ', ', Firstname) AS UserNameDi FROM u896821908_bts.di WHERE Username = :DiInfo");

$stmtDi->bindParam(':DiInfo', $Didate);
$stmtDi->execute();
$rowDi = $stmtDi->fetch(PDO::FETCH_ASSOC);
$fullName = $rowDi['UserNameDi'];
$DI_id = $rowDi['id_DI'];
$email = $rowDi['Email'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Retrieve the values from the POST data
		$DI_id = $_POST['DI_id'];
		$stud_id = $_POST['stud_id'];
	
	// Perform a SQL query to retrieve student data
		$sql = "SELECT idStudent, Username, Lastname, Firstname, Middlename, Suffix, Birthdate, Contactnumber, 
				EmailAddress, Sex, Student_permit_number, `PDC-MOTOR`, `PDC-CAR`
				FROM u896821908_bts.student
				WHERE idStudent = :stud_id";

		// Prepare the SQL statement
		$stmt = $conn->prepare($sql);

		// Bind the parameter
		$stmt->bindParam(':stud_id', $stud_id, PDO::PARAM_INT);

		// Execute the query
		if ($stmt->execute()) {
			// Fetch the data into variables
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			
            
			if ($row) {
				$idStudent = $row['idStudent'];
				$Username = $row['Username']; 
				$Lastname = $row['Lastname'];
				$Firstname = $row['Firstname'];
				$Middlename = $row['Middlename'];
				$Suffix = $row['Suffix'];
				$Birthdate = $row['Birthdate'];
				$Contactnumber = $row['Contactnumber'];
				$EmailAddress = $row['EmailAddress'];
				$Sex = $row['Sex'];
				$Student_permit_number = $row['Student_permit_number'];
				$PDC_MOTOR = $row['PDC-MOTOR'];
				$PDC_CAR = $row['PDC-CAR'];
                

                
                 try {
                 // Assuming $idStudent is the variable you want to use in the WHERE clause
                
                    // Database connection details
                    $servername = "localhost";
                    $username = "u896821908_bts";
                    $password = "a*5E4UEhsHa]";
                    $dbname = "u896821908_bts";
                
                    // Create a connection
                    $conn2 = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                
                    // Set the PDO error mode to exception
                    $conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
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
                                $pdcVehicle_motor = $row_motor['PDC_Vechicle'];
                                $schedule1_motor = $row_motor['schedule1'];
                                $schedule2_motor = $row_motor['schedule2'];
                                $time1_motor = $row_motor['Time1'];
                                $time2_motor = $row_motor['Time2'];
                        
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
                            $pdcVehicle_car = $row_car['PDC_Vechicle'];
                            $schedule1_car = $row_car['schedule1'];
                            $schedule2_car = $row_car['schedule2'];
                            $time1_car = $row_car['Time1'];
                            $time2_car = $row_car['Time2'];
                    
                        }
                    } else {
                        $PDCcar = 'none';
                    }
                
                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                } finally {
                    // Close the connection
                    $conn2 = null;
                }
				// Now, you can use these variables as needed for further processing.
			} else {
				echo "Student not found.";
			}
		} else {
			echo "Error executing the query.";
		}
	} else {
		// Handle cases where the form was not submitted via POST.
		echo "Form not submitted.";
	}
	
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BTS Driving school</title>
	<link rel="icon" type="image/x-icon" href="../img/favicon.ico">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="DI_PORTAL.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>
<style>
  .nav_links a:nth-child(1) {
    background-color: green;
    border-radius: 10px;
    color: white;
  }

  .SchedulePDC {
    width: 100%;
    height: 55%;
    padding: 1%;
	margin: auto;
    border-radius: 3px;
    box-shadow: 2px 10px 8px #AADE91;
    float: left;
    display: block;
  }

  .sched {
    background-color: green;
    color: white;
    width: 70%;
    border: none;
    font-family: inherit;
    padding: 1.1rem;
    align-items: center;
    text-align: center;
    border-radius: 10px;
    font-size: 20px;
    margin-left: 15%;
  }

  .Announcement {
    margin-top: 5%;
    width: 100%;
    height: 30%;
    padding: 1%;
    border-radius: 3px;
    box-shadow: 2px 7px 8px #AADE91;
    /* Adding shadow to the nav_bar */
    float: left;
    margin-top: 5%;
    display: block;
    clear: both;
  }.Announcement h4{
  box-shadow: 2px 7px 8px gray;
  width: 100%;
  }

  .Students {
    width: 100%;
    height: 40%;
    padding: 3%;
    border-radius: 3px;
    box-shadow: 2px 7px 8px #AADE91;
    float: right;
    display: block;
  }

  .leftContainer {
    width: 50%;
    float: left;
    height: auto;
    display: block;

  }

  .rightContainer {
    width: 40%;
    display: inline-block;
    margin-left: 5%;
  }

 #myProgress {
  width: 100%;
  background-color: #ddd;

}

  #myBar {  
  width: 100%;
  height: 30px;
  background-color: #04AA6D;
  text-align: center;
  line-height: 30px;
  color: white;
}table{
  width: 100%;
  text-align: center;
}.img_container img {
      max-width: 80%;
      max-height: 40%;
      border-radius: 3px;
      margin-left: 10%;
      margin-top: 2%;
    }
	
	.STD_info{
		background-color: #e1f5dc;
		margin-bottom: 3%;
		padding: 3%;
		width: 100%;
		box-shadow: 2px 10px 8px rgba(0, 0, 0, 0.2);
	}
	.STD_info .title{
		font-size: 19px;
		font-weight: 600;
	}
	.STD_info .val{
		font-size: 22px;
		font-weight: 500;
	}
	/* CSS Styles for Input Fields and Labels */
	.row {
		display: flex;
		flex-wrap: wrap;
		margin: 0 -15px; /* Adjust the margin as needed */
		margin-bottom: 1%;
	}

	.col {
		flex: 0 0 calc(50% - 15px); /* Adjust the width and spacing as needed */
		padding: 0 15px; /* Adjust the padding as needed */
		box-sizing: border-box;
	}
	
	#pdc_car{
	    margin:3% auto;
	    border-radius: 10px; 
	    padding: 12px;
        background: #c6f7ba;
        box-shadow:  7px 7px 14px #8c9888,
                     -3px -3px 10px #afb8ad;
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

	/* Style the readonly input fields */
	input[readonly] {
		background-color: #fff;
		border: none;
		box-shadow: none;
		color: #333;
		border-radius: 10px;
		background-color: white;
		pointer: 
	}
	.assess{
		background-color: #eefaeb;
		margin-bottom: 3%;
		padding: 3%;
		width: 60%;
		box-shadow: 2px 10px 8px rgba(0, 0, 0, 0.2);
	}

	.Large_buttons {
		display: flex;
		text-align: center;
		align-items: center; /* Center vertically */
		justify-content: center; /* Center horizontally */
	}

	/* Style for large buttons */
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
		margin: 0; /* Remove margin */
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

		 /* Style for the select element */
        select {
            padding: 10px; /* Adjust the padding as needed */
            font-size: 16px; /* Adjust the font size as needed */
            border: 1px solid transparent;
            border-radius: 10px;
            width: 28.5%;
            box-sizing: border-box;
			margin: 2% 0;
        }

        /* Style for the options */
        select option {
            background-color: #fff;
            color: #333;
        }

        /* Style for the selected option */
        select option:checked {
            background-color: #007bff; /* Selected option color */
            color: #fff; /* Selected option text color */
        }
        
        
@media only screen and (max-width: 600px) {
      .nav_links a {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        font-size: 12px;
      }
    
      .nav_links a i, .username, .email, .Student_list{
        display: none;
      }
      .label{
          font-size: 15px;
      }
      .title_header, .big_title{
          font-size: 20px;
      }
    .STD_info{
        margin-top: 7%;
    }
      .STD_info .title{
		font-size: 12px;
		font-weight: 600;
	}
	.STD_info .val{
		font-size: 10px;
		font-weight: 500;
	}
	.STD_info label, .STD_info input{
	    font-size: 10px;
	}

    .std_img {
      display: block;
      width: 100px; /* Adjust the size as needed */
      height: 100px; /* Adjust the size as needed */
      border-radius: 50%;
      object-fit: cover;
      margin: 0 auto;
    }
    .table_container{
        display: none;
    }
    .large-button {
        padding: 10px 20px;
        font-size: 20px;
    }
    .btn_container{
      margin-top:2%;
    }
    .schedule{
        display:none;
    }
    
      header {
        width: 100%;
    }
      .nav-container{
          background-color: rgba(91, 189, 117, .5);
      }
      
      
      
      
    }
</style>

<body>
  <div class="main-container">
    <div class="nav-container">
      <nav>
       

          <div class="profile">
            <img src="../uploads/Di_uploads/<?php echo basename($profilePicture); ?>" alt="Profile Picture" />
            <div class="namecon">
              <span class="username"><?php echo $fullName ?></span>
              <span class="email"><?php echo $email ?></span>
            </div>
            <!--DITO USERNAME VARIABLE NG STUDENT-->
          </div>

        <div class="nav_links">
          <a href="di_dashboard.php"><i class="fas fa-tachometer-alt"></i> Home</a>
          <a href="di_reportSub.php"><i class="fas fa-chart-bar"></i> Reports</a>
		  <a href="#" id="logout-link"><i class="fas fa-sign-out-alt"></i> Log Out</a>
        </div>
      </nav>
    </div>
  </div>
	<div class="content-container">
	
		<div class="STD_info">
		
		<?php
		
		
			 $LTOCodeM = "A(L1, L2, L3)";
                  $LTOCodeC = "B(M1)";
                  
                  if (!empty($PDC_MOTOR)) {
                      $motorC = $LTOCodeM;
                  }
                    
                    if (!empty($PDC_CAR)) {
                      $carC = $LTOCodeC;
                  }
						
		
		
		
		
			// Start of PHP
			echo '
			<div class="row">
				<div class="col">
					<img src="../img/bts_logo.png" class="logo">
				</div>
			</div>
			<div class="row">
				<div class="col">
					<label class="title">Student ID:</label>
					<input type="text" class="val" value="&nbsp;' . $idStudent . '" readonly>
				</div>
				<div class="col">
					<label class="title">Student Name:</label>
					<input type="text" class="val" value="&nbsp;' . $Lastname . ', ' . $Firstname . ' ' . $Middlename . ' ' . $Suffix . '" readonly>
				</div>
			</div>
			<div class="row">			
			
						<div class="col">
							<label class="title">Birthdate:</label>
							<input type="text" class="val" value="&nbsp;' . $Birthdate . '" readonly>
						</div>
						<div class="col">
							<label class="title">Sex:</label>
							<input type="text" class="val" value="&nbsp;' . $Sex . '" readonly>
						</div>
			</div>
			<div class="row">			
				<div class="col">
					<label class="title">Contact Number:</label>
					<input type="text" class="val" value="&nbsp;' . $Contactnumber . '" readonly>
				</div>
				<div class="col">
					<label class="title">Email Address:</label>
					<input type="text" class="val" value="&nbsp;' . $EmailAddress . '" readonly>
				</div>
			</div>

			<div class="row">
				<div class="col">
					<label class="title">Student Permit Number:</label>
					<input type="text" class="val" value="&nbsp;' . $Student_permit_number . '" readonly>
				</div>
			</div>	
			
			<div class="schedule">
    			<div class="row">
    			    <!--For PDC MOTOR -->
    				<div class="col" style="display:'.$PDCmotor.';" id="pdc_car">
    				
    					<label class="title">PDC MOTOR:</label>
    					<input type="text" class="val" placeholder="&nbsp;N/A" value="&nbsp;' . $PDC_MOTOR .' '. $motorC. '" readonly>
    					
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
    					<input type="text" class="val" placeholder="&nbsp;N/A"  value="&nbsp;' . $PDC_CAR .' '. $carC . '" readonly>
    					
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
    			</div>
    		</div>'; // End of .row
            
			?>
			<form method="post" action="DI_pre-assessment.php">
				<label class="title">Select Course:</label>
				<select class="val" name="pdc_select" required>
					<option hidden selected value="">Select a Course</option>
					<?php if (!empty($PDC_MOTOR)): ?>
						<option value="<?php echo $PDC_MOTOR; ?>"><?php echo $PDC_MOTOR . " " . "$motorC"; ?></option>
					<?php endif; ?>
					<?php if (!empty($PDC_CAR)): ?>
						<option value="<?php echo $PDC_CAR; ?>"><?php echo $PDC_CAR . " " . "$carC"; ?></option>
					<?php endif; ?>
				</select>

				<div class="Large_buttons">
					<input type="hidden" class="std_id" name="DI_id" value="<?php echo $DI_id; ?>">
					<input type="hidden" class="std_id" name="std_id" value="<?php echo $idStudent; ?>">
					<button type="submit" class="large-button" id="session1">Proceed</button>
			</form>
					<a href="di_dashboard.php" class="large-button" id="session2">Back</a>
				</div>
					

		</div>



	  

	</div>

</body>

</html>