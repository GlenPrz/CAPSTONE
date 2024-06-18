<?php
session_start();
include "../conn.php";
include "./Script_php/Selection_Student.php";

$DI_Assign_logout = $_SESSION['DI_Assign_logout'];

if (!isset($_SESSION['username'])) {
    // Redirect the user to the desired location (e.g., login page)
    header('Location: ../login.php');
    exit; // Make sure to exit after the redirection to prevent further code execution
}
$Didate = $_SESSION['username'];
// Retrieve the data from the database
$stmtDi = $conn->prepare("SELECT id_DI, Email, CONCAT(LastName, ', ', Firstname) AS UserNameDi FROM u896821908_bts.di WHERE Username = :DiInfo");

$stmtDi->bindParam(':DiInfo', $Didate);
$stmtDi->execute();
$rowDi = $stmtDi->fetch(PDO::FETCH_ASSOC);
$fullName = $rowDi['UserNameDi'];
$DI_id = $rowDi['id_DI'];
$email = $rowDi['Email'];


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
    .main_content{
        display: block;
    width: 70%;
    margin-left: 25%;
    margin-top: 1%;
    height: 100%;
    float: left;
}
.nav_links a:nth-child(2){
    background-color: green;
    border-radius: 10px;
    color: white;
}
input[type="text"],[type="number"],[type="email"],[type="tel"],[type="date"], select {
   width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  }
  input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}
.DIstatus select{
       width: 50%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 0px;
  font-size: 15px;
  }
  .container {
            width: 100%;
            max-width: 1200px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 1%;
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
      .title_header, .title{
          font-size: 20px;
      }
      header {
        width: 100%;
    }
      .nav-container{
          background-color: rgba(91, 189, 117, .5);
      }
      
      
      
    }
    
     @media only screen and (max-width: 1440px) {
      .username{
        font-size: 13px;
      }
      .email{
        font-size: 10px;
      }
      
      
      
      
    }    
</style>


<body>
    <div class="nav-container">
      <nav>
       <div class="profile" id="profile-box">
            <img src="../uploads/Di_uploads/<?php echo basename($profilePicture); ?>" alt="Profile Picture" />
            <div class="namecon">
              <span class="username"><?php echo $fullName ?></span><br>
              <span class="email"><?php echo $email ?></span>
            </div>
            <!--DITO USERNAME VARIABLE NG STUDENT-->
          </div>

        <div class="nav_links">
          <a href="di_dashboard.php"><i class="fas fa-tachometer-alt"></i> Home</a>
          <a href="di_reportSub.php"><i class="fas fa-chart-bar"></i> Reports</a>
          <a href="#" id="logout-link"><i class="fas fa-sign-out-alt"></i> Log Out</a>
        </div>
         <form id="logout-form" action="DI_logout.php" method="post" onsubmit="return confirm('If you want to logout click Ok.');">
        <!-- Add an input field to submit a value -->
        <input type="hidden" name="di_id" value="<?php echo $DI_id;?>">
        <button type="submit" id="logout-button" style="display: none;"></button>
		
		</form>
		
        <center><div class="logo_container">
                        <img src="../img/bts_logo.png" class="admin_logo">
                    </div><br>
                    <h2 class="label">Best Training School</h2>
                  </center>
      </nav>
    </div>
<div class="content-container">
    <div class="container">
   <header><h2>Driver Instructor Report</h2></header>
        <br><br>
	<?php
		$std_id = 'Select Student ID';
		$session = '';
		$StartOdo = '';
		$full_name = '';
	
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
					// Check if the form was submitted
					$std_id = $_POST["Stud_id"];
					$session = $_POST["Session"];
					$StartOdo = $_POST["Start_odo"];
		try {
			// Retrieve student data
			$sql_student = "SELECT * FROM u896821908_bts.student WHERE idStudent = :std_id";
			$stmt_student = $conn->prepare($sql_student);
			$stmt_student->bindParam(':std_id', $std_id, PDO::PARAM_INT);
			$stmt_student->execute();
			$student_data = $stmt_student->fetch(PDO::FETCH_ASSOC);

			
			// Now you can use $student_data and $di_data to access the retrieved data
			if ($student_data) {
				$full_name = $student_data['Lastname'] . ', ' . $student_data['Firstname'] . ' ' .$student_data['Middlename'] . '.';
			} else {
				echo "No data found.";
			}
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}

		
		}
	?>	
		
		
    <form method="post" action="./Script_php/DI_report_insert.php" onsubmit="return confirm('If you want to Submit this report click Ok.');">
        <label for="driverId">Driver ID:</label><br>
        <input type="text" id="driverId" name="driverId" value ="<?php echo $DI_id;?>" readonly><br><br>

        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value ="<?php echo $fullName;?>" readonly><br><br>

        <label for="vehicleUse">Vehicle Used:</label><br>
        <select id="vehicleType" class="wid_med" name="Vehicle" required>
			<option value="" hidden selected>Select a Vehicle Type</option>
			<?php
			try {

				// SQL query to fetch distinct vehicle_brand_model values
				$sql_Vtype = "SELECT DISTINCT vehicle_brand_model FROM u896821908_bts.vehicle_tbl";
				$stmt = $conn->prepare($sql_Vtype);
				$stmt->execute();

				// Fetch the results and generate options
				while ($row_Vtype = $stmt->fetch(PDO::FETCH_ASSOC)) {
					echo '<option value="' . $row_Vtype['vehicle_brand_model'] . '">' . $row_Vtype["vehicle_brand_model"] . '</option>';
				}
			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
			} finally {

			}
			?>
		</select>
		
		<br><br>	
		<!--<label for="driverId">Student ID:</label><br>
        <input type="text" id="driverId" name="driverId" value ="<?php// echo $std_id;?>" required ><br><br> -->
		<label for="driverId">Student ID and Name:</label><br>
		<select id="driverId" class="wid_med" name="std_id" required>
			<option value="<?php echo $std_id; ?>" selected hidden><?php echo $std_id  . ' - ' . $full_name; ?></option>
			<?php
			try {

				// SQL query to fetch distinct student IDs from di_assign_tbl
				$sql_std = "SELECT DISTINCT Student_id FROM u896821908_bts.di_assign_tbl WHERE status = 'complete'";
				$stmt2 = $conn->prepare($sql_std);
				$stmt2->execute();

				 // Fetch the results and generate options
        while ($row_std = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            $studentId = $row_std['Student_id'];

           // Retrieve the last name, first name, and middle name of the student from the "student" table
            $sql_student_info = "SELECT lastname, firstname, middlename FROM u896821908_bts.student WHERE idStudent = :studentId";
            $stmt_student_info = $conn->prepare($sql_student_info);
            $stmt_student_info->bindParam(':studentId', $studentId, PDO::PARAM_INT);
            $stmt_student_info->execute();
            $student_info = $stmt_student_info->fetch(PDO::FETCH_ASSOC);

            $full_name = $student_info['lastname'] . ', ' . $student_info['firstname'] . ' ' . $student_info['middlename'] . '.';

            echo '<option value="' . $studentId . '">' . $studentId . ' - ' . $full_name . '</option>';
       
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        // Close the database connection when done
        if ($conn !== null) {
            $conn = null;
        }
    }
    ?>
		</select>
		<br><br>
		
        <!--
		<label for="studentName">Student Name:</label><br>
        <input type="text" id="studentName" name="studentName" value ="<?php //echo $Stud_name;?>" required ><br><br>
		-->
		
        <label for="dateOfAssessment">Date of Assessment:</label><br>
        <input type="date" id="dateOfAssessment" name="dateOfAssessment" required><br><br>

        <label for="session">Session:</label><br>
        <input type="number" id="session" name="session" min="1" max="2" onKeyDown="return false" value ="<?php echo $session;?>" required><br><br>

        <label for="startOdometer">Start Odometer:</label><br>
        <input type="number" id="startOdometer" name="startOdometer"  value ="<?php echo $StartOdo;?>" required><br><br>

        <label for="endOdometer">End Odometer:</label><br>
        <input type="number" id="endOdometer" name="endOdometer" required><br><br>

        <input type="submit" value="Submit">
    </form>
    </div>
</div>
</div>
 <script>
    // Add a click event handler to the logout link
        document.getElementById("logout-link").addEventListener("click", function(event) {
         console.log("Clicked"); // Add this line to check if the click event is captured
                        
    // Check your condition here (replace with your actual variable)
        var yourVariable = <?php echo json_encode($DI_Assign_logout); ?>;
                                
            if (yourVariable) {
            // If yourVariable is true, submit the form
                document.getElementById("logout-button").click();
            } else if (yourVariable === false) {
            // If yourVariable is false, show an alert
                alert("You need to decline the student assigned to you first.");
                }
               });
 </script>    
  
</body>
    

</html>