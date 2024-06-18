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
$fullName = $rowDi['UserNameDi'];
$DI_id = $rowDi['id_DI'];
$email = $rowDi['Email'];


$sql = "UPDATE di SET Availability_status = 'On Session' WHERE id_DI = '$DI_id' ";
     if ($conn->query($sql) === TRUE) {
        // Great
      } 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Retrieve the values from the POST data



		$course = $_POST["pdc_select"];
		$stud_id = $_POST["std_id"];
	
	} else {
		// Handle cases where the form was not submitted via POST.
		echo "Form not submitted.";
	}
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

				// Now, you can use these variables as needed for further processing.
			} else {
				echo "Student not found.";
			}
		} 
		
	
		$servername = "localhost";
        $username = "u896821908_bts";
        $password = "a*5E4UEhsHa]";
        $dbname = "u896821908_bts";

			// Create a connection to the database
			$conn2 = new mysqli($servername, $username, $password, $dbname);

			// Check the connection
			if ($conn2->connect_error) {
				die("Connection failed: " . $conn2->connect_error);
			}
		
			// Query to check if the PDC_result table is empty for the specified Username
			$sql = "SELECT COUNT(*) as count FROM u896821908_bts.pdc_result WHERE Username = '$Username' AND PDC_Course_enrolled LIKE '$course' AND Assessment LIKE 'pass' AND session = 1 ";
			$result = $conn2->query($sql);

			if ($result) {
				$row = $result->fetch_assoc();
				$count = $row["count"];
				
				// Check if the count is zero, indicating the table is empty for the specified Username
				if ($count == 0) {
					$session_1_status = 'Pending';
					$session = 1;
				}else {
					$std_passed = false;
					$session_1_status = 'Pass';
					$session = 2;
					
				}
			} else {
				echo "Error: " . $conn2->error;
			}
			
			$sql = "SELECT COUNT(*) as count FROM u896821908_bts.pdc_result WHERE Username = '$Username' AND PDC_Course_enrolled LIKE '$course' AND Assessment LIKE 'pass' AND session = 2 ";
			$result = $conn2->query($sql);

			if ($result) {
				$row = $result->fetch_assoc();
				$count = $row["count"];
				
				// Check if the count is zero, indicating the table is empty for the specified Username
				if ($count == 0) {
					$session_2_status = 'Pending';
				}else {
					$std_passed = true;
					$session_2_status = 'Pass';
				}
			} else {
				echo "Error: " . $conn2->error;
			}
			
			
			
			$conn2->close();
	
	
	
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BTS Driving school</title>
	<link rel="icon" type="image/x-icon" href="../img/favicon.ico">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <link rel="stylesheet" href="DI_PORTAL.css">

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
	    margin-top: 10%;
		display: flex;
		flex-wrap: wrap;
		margin: 0 -15px; /* Adjust the margin as needed */
	}

	.col {
	    margin-bottom: 2%;
		flex: 0 0 calc(50% - 15px); /* Adjust the width and spacing as needed */
		padding: 0 15px; /* Adjust the padding as needed */
		box-sizing: border-box;
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
		margin-top: 3%;
		display: flex;
		text-align: center;
		align-items: center; /* Center vertically */
		justify-content: center; /* Center horizontally */
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
      .Big_title{
          font-size: 12px;
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

    .large-button {
        padding: 10px 15px;
        font-size: 15px;
    }
    .btn_container{
      margin-top:2%;
    }

    .column .val{
        width: 200px;
    }
    
    .Large_buttons {
		margin-top: 15%;
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
		  <a href="#" id="logoutLink"><i class="fas fa-sign-out-alt"></i> Log Out</a>
        </div>
        
      </nav>
    </div>
  </div>
	<div class="content-container">
	<div class="header">
	</div>
		<div class="STD_info">
			<div class="row">
				<div class="col">
					<img src="../img/bts_logo.png" class="logo">
				</div>
			</div>
			<div class="row">
				<div class="col">
				    <?php
				 $LTOCodeM = "A(L1, L2, L3)";
                  $LTOCodeC = "B(M1)";
                  
                if (!empty($course) && ($course == 'Motorcycle_Manual' || $course == 'Motorcycle_Automatic')) {
    $LTOCODE = $LTOCodeM;
} elseif (!empty($course) && ($course == 'Car_Manual' || $course == 'Car_Automatic')) {
    $LTOCODE = $LTOCodeC;
} else {
    // Default value if $course doesn't match any condition
    $LTOCODE = ''; // or any other default value you want
}

                  ?>
						
					<h2 class="Big_title"><?php echo $course . ' ' . $LTOCODE; ?>&nbsp;Course</h2>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<label class="title">Session 1:</label>
					<input type="text" class="val" value="<?php echo $session_1_status; ?>" readonly>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<label class="title">Session 2:</label>
					<input type="text" class="val" value="<?php echo $session_2_status; ?>" readonly>
				</div>
			</div>
			<form method="post" action="DI_Assessment_Form.php" id="myForm">
			    
                <div class="row">
                    <div class="col">
        				<div class="column">
        					<label class="title">Start Odometer:</label><br>
        					<input type="text" class="val"  name="StartOdo" required>
                        </div>
                    </div>
                </div>  
                
				<div class="Large_buttons">
					<input type="hidden" class="std_id" name="DI_id" value="<?php echo $DI_id; ?>">
					<input type="hidden" class="std_id" name="course" value="<?php echo $course; ?>">
					<input type="hidden" class="std_id" name="std_id" value="<?php echo $idStudent; ?>">
					<input type="hidden" class="std_id" name="session" value="<?php echo $session; ?>">
					<button type="submit" class="large-button" id="session1">Session&nbsp;<?php echo $session; ?></button>
			</form>
					<a href="di_dashboard.php" class="large-button" id="session2">Back</a>
					
				</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

	<script>
    document.getElementById("myForm").addEventListener("submit", function(event) {
        // Check your condition here (replace with your actual condition)
        var IfStdPassCourse = <?php echo $std_passed; ?>; // Replace with your actual condition
        
        if (IfStdPassCourse) {
            event.preventDefault(); // Prevent the form from submitting
            alert("The student already passed this course.\nPlease go back and select another course enrolled.");
        }
    });
    
    
    
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