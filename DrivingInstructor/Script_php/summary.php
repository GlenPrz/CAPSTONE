<?php
include "../../conn.php";
session_start();

// Retrieve assessment data from URL parameters (your existing code)
$assessmentData = $_GET;

// Access individual ratings using $assessmentData, e.g., $assessmentData['question1']
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<style>
body {
		  font-family: 'Arial', sans-serif;
		  line-height: 1.6;
		  margin: 40px;
		  background-color: whitesmoke;
		}
      .Assmnt_sum {
        background-color: #fff;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        margin: 5% auto; /* Center horizontally */
        width: 60%; /* Set width to 60% */
        text-align: center; /* Center text horizontally */
    }
	 .inner_container {
        text-align: left;
		margin: auto;
		width: 70%;
    }
    .Assmnt_sum h1 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .Assmnt_sum p {
        margin: 5px 0;
    }

    .Assmnt_sum label {
        font-weight: bold;
    }
	/* Button styling */
        .proceed-button {
			display: block;
			margin: 0 auto;
			width: 200px; /* Adjust the width as needed */
			background-color: #2cd152;
			color: #fff;
			padding: 15px 30px; /* Increased padding for a larger button */
			border: none;
			border-radius: 8px; /* Slightly rounded corners */
			cursor: pointer;
			text-align: center;
			font-size: 22px; /* Adjust the font size as needed */
			
		}

		.proceed-button:hover {
			background-color: #156e2a;
			color: white;
		}

		p {
		  margin: 10px 0;
		}

		label {
		  font-weight: bold;
		}

		/* Session styling */
		p:first-child {
		  font-size: 2em;
		  margin-bottom: 20px;
		}

		/* Name row styling */
		p:nth-child(2),
		p:nth-child(3),
		p:nth-child(4) {
		  display: inline-block;
		  margin-right: 20px;
		   margin-bottom: 16px;
		}

		/* Personal information row styling */
		p:nth-child(5),
		p:nth-child(6),
		p:nth-child(7),
		p:nth-child(8) {
		  display: inline-block;
		  margin-right: 40px;
		  margin-bottom: 16px;
		}

		/* Address row styling */
		p:nth-child(9) {
		  clear: both;
		  margin-bottom: 16px;
		}

		/* Student Permit Number row styling */
		p:nth-child(10) {
		  clear: both;
		  margin-bottom: 16px;
		}

		/* Total Rating, Num of Questions, Passing Score, Assessment row styling */
		p:nth-child(11),
		p:nth-child(12),
		p:nth-child(13){
		  clear: both;
		  margin-bottom: 16px;
		}

		p:last-child{
		  clear: both;
		  margin-bottom: 16px;
		  font-size: 2em;
		}
		hr {
		  border: 1px solid #ddd; /* Set border color */
		  margin: 20px 0; /* Adjust margin for spacing */
		}
</style>

<body>
<div class="Assmnt_sum">
    <h1>Assessment Summary</h1>
	<div class="inner_container">
		<?php if (isset($_SESSION['totalRating'])): 
		$Di_StudentId =  $_SESSION['Di_StudentId']; //Student id
		$Di_Student_currentDate =  $_SESSION['Di_Student_currentDate'];
		$DI_id = $_SESSION['Di_id']; //Driving Instructor id
		$Di_Student_course =  $_SESSION['Di_Student_course'];
		$Di_Student_session =  $_SESSION['Di_Student_session'];
		$Rating_score =  $_SESSION['totalRating'] - $Di_Student_session;
		$ques_count =  $_SESSION['question_count'];
		$passing_score = ($ques_count*5)*.75;
		$assign_id = $_SESSION['DI_assign_id'];
		$StartOdo = $_SESSION['Start_Odometer'];
				
		if ($Rating_score >= $passing_score){
			$assessment='pass';
			$assessment_label='passed';
		} else if ($Rating_score < $passing_score){
			$assessment='failed';
			$assessment_label ='failed';
		}
				// Prepare and execute the SQL query using PDO
			$sql = "SELECT * FROM u896821908_bts.student WHERE idStudent = :Di_StudentId";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':Di_StudentId', $Di_StudentId, PDO::PARAM_INT);
			$stmt->execute();

			// Check for errors during execution
			if ($stmt->errorCode() !== '00000') {
				$errorInfo = $stmt->errorInfo();
				echo "Error executing query: " . $errorInfo[2];
			} else {
				// Check if any rows were returned
				if ($stmt->rowCount() > 0) {
					// Fetch and process each row
					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
						 // Access data from the row
						$studentUsername = $row['Username'];
						$lastname = $row['Lastname'];
						$firstname = $row['Firstname'];
						$middlename = $row['Middlename'];
						$birthdate = $row['Birthdate'];
						$civilstatus = $row['Civilstatus'];
						$contactnumber = $row['Contactnumber'];
						$sex = $row['Sex'];
						$address = $row['Address'];
						$city = $row['City'];
						$student_permit_number = $row['Student_permit_number'];
						
						// Insert data into the pdc_result table
						$insertSql = "INSERT INTO u896821908_bts.pdc_result (Username, Student_id, PDC_Course_enrolled, session, Assessment, Date)
									  VALUES (:Username, :Student_id, :PDC_Course_enrolled, :session, :Assessment, :Date)";
						$insertStmt = $conn->prepare($insertSql);
						$insertStmt->bindParam(':Username', $studentUsername, PDO::PARAM_STR);
						$insertStmt->bindParam(':Student_id', $Di_StudentId, PDO::PARAM_INT);
						$insertStmt->bindParam(':PDC_Course_enrolled', $Di_Student_course, PDO::PARAM_STR);
						$insertStmt->bindParam(':session', $Di_Student_session, PDO::PARAM_STR);
						$insertStmt->bindParam(':Assessment', $assessment, PDO::PARAM_STR);
						$insertStmt->bindParam(':Date', $Di_Student_currentDate, PDO::PARAM_STR);
						
						if ($insertStmt->execute()) {
							//echo "Data inserted successfully into pdc_result.";
						} 
						
						echo '
							<center><p><label for="">Session: </label> ' . $Di_Student_session . '</p></center>
							<p><label for="lastname">Student Name:</label> ' . $lastname . ', ' . $firstname . ' ' . $middlename .'</p><br>
							<p><label for="birthdate">Birth Date:</label> ' . $birthdate . '</p>
							<p><label for="civilstatus">Civil Status:</label> ' . $civilstatus . '</p>
							<p><label for="contactnumber">Contact Number:</label> ' . $contactnumber . '</p>
							<p><label for="sex">Sex:</label> ' . $sex . '</p>
							<p><label for="address">Address:</label> ' . $address . ', ' . $city . '</p>
							<p><label for="student_permit_number">Student Permit Number:</label> ' . $student_permit_number . '</p><hr>
							<p><label for="Rating_score">Total Rating:</label> ' . $Rating_score . '</p>
							<p><label for="ques_count">Total num of questions:</label> ' . $ques_count . '</p>
							<p><label for="passing_score">Passing score: </label> ' . $passing_score . '</p>
							<brs><p><label for="">Assessment: </label> ' . $assessment_label . '</p>
						';

						
					}
					
				} else {
					echo "No matching records found.";
				}
			}
		
			try {
			// Prepare the SQL statement with a parameter for security
			$sql = "UPDATE u896821908_bts.di_assign_tbl SET status = 'complete' WHERE  Di_Assign = :assign_id";
			$stmt = $conn->prepare($sql);
			
			// Bind the parameter
			$stmt->bindParam(':assign_id', $assign_id, PDO::PARAM_INT);
			
			// Execute the statement
			$stmt->execute();
			
			 // Prepare the SQL statement with a parameter for security
			$sql2 = "UPDATE u896821908_bts.di SET Availability_status = 'Active' WHERE id_DI = :DI_id";
			$stmt2 = $conn->prepare($sql2);
			
			// Bind the parameter
			$stmt2->bindParam(':DI_id', $DI_id, PDO::PARAM_INT);
			
			// Execute the statement
			$stmt2->execute();
			
			// Check if the update was successful
			if ($stmt->rowCount() > 0) {
				// header("Location: ../di_dashboard.php?decline");
				//    exit;
			} else {
				// header("Location: ../di_dashboard.php?!decline");
				//   exit;
			}
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		endif; 
		?>
		
		<form method="post" action="../di_reportSub.php">
			<input type="hidden" name="Di_id" value="<?php echo $DI_id; ?>">
			<input type="hidden" name="Stud_id" value="<?php echo $Di_StudentId; ?>">
			<input type="hidden" name="Session" value="<?php echo $Di_Student_session; ?>">
			<input type="hidden" name="Session" value="<?php echo $Di_Student_session; ?>">
			<input type="hidden" name="Start_odo" value="<?php echo $StartOdo; ?>">
			<button type="submit" class="proceed-button">Proceed</button>
		</form>

	</div>
</div>
<script>
       // function redirectToDiDashboard() {
            // Redirect to "Di_dashboard.php" and add a word to the URL
          //  window.location.href = '../Di_dashboard.php?Assessment_done'; // Replace "example" with your desired word

            // Close the current page
          //  window.close();
        //}
    </script>	
<script>
    // Disable the back button
    history.pushState(null, null, document.URL);
    window.addEventListener('popstate', function () {
        history.pushState(null, null, document.URL);
  });
</script>	
</body>
</html>
