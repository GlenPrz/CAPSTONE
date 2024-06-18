<?php
session_start();

if (empty($_SESSION['username'])) {
    header("Location: ../login.php");
}
include "../conn.php";
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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <div class="container">
        <header><h2>Assign Driver Instructors</h2></header>

		<table>
		<tr class="tbl_header">
			<th>Driver Instructor ID</th>
			<th>Last Name</th>
			<th>First Name</th>
			<th>Availability Status</th>
			<th>Nature of Accreditation</th>
			<th>Student</th>
			<th colspan="4" style="text-align:center;">Action</th>
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
		
		$displayedDIs = array();
		$sql = "SELECT DISTINCT di.id_DI, di.Lastname, di.Firstname, di.Availability_status, di.DI_Training, da.Student_id, da.status
				FROM u896821908_bts.di
				LEFT JOIN u896821908_bts.di_assign_tbl da ON di.id_DI = da.DI_id
				ORDER BY di.id_DI, da.status DESC";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$diId = $row['id_DI'];
				 if ($row['Availability_status'] === 'Inactive') {
					 if (isset($displayedDIs[$diId])) {
						continue; // Skip this record and continue with the next iteration
					}
					$displayedDIs[$diId] = true;
					echo "<tr>";
					echo "<td>" . $row['id_DI'] . "</td>";
					echo "<td>" . $row['Lastname'] . "</td>";
					echo "<td>" . $row['Firstname'] . "</td>";
					echo "<td>" . $row['Availability_status'] . "</td>";
					echo "<td>" . $row['DI_Training'] . "</td>";
					echo "<td></td>";
					echo "<td><button href='admin_AssignStudent.php?id=" . $row['id_DI'] . "' class='assign-button-disable' disable>Assign</button></td>";
					echo "<td><button href='admin_ViewDiStudent.php?id=" . $row['id_DI'] . "' class='view-button-disable' disable>View</button></td>";
					
				}else if ($row['Availability_status'] === 'Active') {
					 if (isset($displayedDIs[$diId])) {
						continue; // Skip this record and continue with the next iteration
					}
					$displayedDIs[$diId] = true;
					echo "<tr>";
					echo "<td>" . $row['id_DI'] . "</td>";
					echo "<td>" . $row['Lastname'] . "</td>";
					echo "<td>" . $row['Firstname'] . "</td>";
					echo "<td>" . $row['Availability_status'] . "</td>";
					echo "<td>" . $row['DI_Training'] . "</td>";
					echo "<td></td>";
					echo "<td><a href='admin_AssignStudent.php?id=" . $row['id_DI'] . "' class='assign-button'>Assign</a></td>";
					echo "<td><button href='admin_ViewDiStudent.php?id=" . $row['id_DI'] . "' class='view-button-disable' disable>View</button></td>";
					
				} else if (($row['Availability_status'] === 'On Session' || $row['Availability_status'] === 'Assigned') && $row['Student_id'] !== null ) {
					 if (isset($displayedDIs[$diId])) {
						continue; // Skip this record and continue with the next iteration
					}
					$displayedDIs[$diId] = true;
					echo "<tr>";
					echo "<td>" . $row['id_DI'] . "</td>";
					echo "<td>" . $row['Lastname'] . "</td>";
					echo "<td>" . $row['Firstname'] . "</td>";
					echo "<td>" . $row['Availability_status'] . "</td>";
					echo "<td>" . $row['DI_Training'] . "</td>";

						// Retrieve student data from the "student" table
						$studentId = $row['Student_id'];
						$student_query = "SELECT Lastname, Firstname FROM student WHERE idStudent = '$studentId'";
						$student_result = $conn->query($student_query);

						if ($student_result->num_rows > 0) {
							$student_data = $student_result->fetch_assoc();
							$student_name = $student_data['Lastname'] . ", " . $student_data['Firstname'];
						} else {
							$student_name = "Student Not Found";
						}

						// Disable "Assign" button and enable "View" button
						echo "<td>" . $student_name . "</td>";
						echo "<td><button href='admin_AssignStudent.php?id=" . $row['id_DI'] . "' class='assign-button-disable' disable>Assign</button></td>";
						echo "<td><a href='admin_ViewDiStudent.php?id=" . $row['id_DI'] . "' class='view-button'>View</a></td>";
						
				} else if (($row['Availability_status'] === 'On Session' && $row['status'] !== 'pending') || ($row['Availability_status'] !== 'On Session' && $row['status'] === 'complete') || ($row['Availability_status'] === 'Inactive' && $row['status'] === 'pending') || ($row['Availability_status'] === 'Assigned' && $row['status'] !== 'pending') || ($row['Availability_status'] !== 'Assigned' && $row['status'] === 'complete')) {
					// Skip this record and continue with the next iteration
					continue;
				}
				
				echo "</tr>";
			}
		} else {
			echo "<tr><td colspan='8'>No records found</td></tr>";
		}




		// Close the database connection
		$conn->close();
		?>
	</table>
	</div>

    </div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
		function Assigned() {
            // Your JavaScript function logic here
            alert("Student successfully assigned to DI");

		// Reset the URL to the original state (without "success") after 2 seconds
            setTimeout(function() {
                history.replaceState({}, document.title, window.location.pathname);
            }, 1);
        }
		 function notAssigned() {
            // Your JavaScript function logic here
            alert("Failed to Assign Student. please try again.");

		// Reset the URL to the original state (without "success") after 2 seconds
            setTimeout(function() {
                history.replaceState({}, document.title, window.location.pathname);
            }, 1);
        }
        // Check if the URL contains "success" and trigger the function
        if (window.location.href.indexOf("assign") !== -1) {
              Assigned();
        }else if(window.location.href.indexOf("!assign") !== -1) {
            notAssigned();
        }
</script>
<script>
    // Get the input element and table
    const searchInput = document.getElementById('searchInput');
    const table = document.querySelector('.Main-table');

    // Add an event listener to the input field
    searchInput.addEventListener('input', function () {
        const searchQuery = this.value.toLowerCase();

        // Get all rows in the table
        const rows = table.querySelectorAll('tr');

        // Loop through rows, starting from index 1 to skip the table header
        for (let i = 1; i < rows.length; i++) {
            const row = rows[i];
            const cells = row.querySelectorAll('td');
            let found = false;

            // Loop through cells in each row
            for (let j = 0; j < cells.length; j++) {
                const cell = cells[j];
                const cellText = cell.textContent.toLowerCase();

                // Check if the cell text contains the search query
                if (cellText.includes(searchQuery)) {
                    found = true;
                    break;
                }
            }

            // Toggle row visibility based on search result
            row.style.display = found ? '' : 'none';
        }
    });
</script>
<script>
function reloadPageEvery10Seconds() {
    setTimeout(function() {
        location.reload();
    },  60 * 1000); // 3 minutes in milliseconds
}

// Call the function to start the reload timer
reloadPageEvery10Seconds();
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

</body>
</html>