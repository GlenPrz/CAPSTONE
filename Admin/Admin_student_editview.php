<?php
include "../conn.php";
include "./php_scripts/admin_Staffiles/AdminStaff_EDIT_ENROLL.php";
include "./php_scripts/admin_Staffiles/AdminStaff_DEL.php";
?>
<!DOCTYPE html>
<html lang="en">
<style>
    .main_content{
    display: block;
    width: 60%;
    margin-left: 25%;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
    <link href="admin_styles/admin_nav.css" rel="stylesheet">
    <link href="./admin_styles/Admin_Enroll_viewedit.css" rel="stylesheet">
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
    <a href="admin_Pupdate.php"><i class="fas fa-bullhorn"></i> Post Updates</a>
    <a href="admin_reports.php"><i class="fas fa-chart-bar"></i> Reports</a>
    <a href="admin_Staff.php"><i class="fas fa-users"></i> Staff</a>
    <a href="admin_Assign.php"><i class="fas fa-tasks"></i> Assign</a>
    <a href="admin_view_feedback.php"><i class="fas fa-comment"></i> View Feedback</a>
    <a href="admin_module_exam.php"><i class="fas fa-book"></i> Module/Exam</a>
    <a href="" id="logoutLink"><i class="fas fa-sign-out-alt"></i> Log Out</a>


                    </div>
                </center>
            </nav>
    </div>
</div>
<div class="main_content">
  <!-- <?php
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
				//$lastname = $row['Lastname'];
				//$firstname = $row['Firstname'];

				 // echo '<form action=" 		" method="post" onsubmit="return confirmDelete();">';
						
				 // echo "</form>"


				// Create a form with a button to submit the 'id' to another file
				//  echo '<form action="Admin_stud_rec_del" method="post" onsubmit="return confirmDelete();">';
				// echo '<input type="hidden" name="student_id" value="' . $studentId . '">';
				// echo '<button type="submit">DELETE</button>';
				// echo '</form>';
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
		</script> -->
    </div>

</body>
</html>