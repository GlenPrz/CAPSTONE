<?php

session_start();
if (empty($_SESSION['username'])) {
    header("Location: ../login.php");
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
          //Dito ichecheck if teller or admin. pag teller then magiging none ang value nung $none
          $none='none';
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
    <link href="admin_styles/admin_nav.css" rel="stylesheet">
    <link href="./admin_styles/admin_enroll.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fontscancel-btn.googleapis.com/css2?family=Merriweather:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<style>

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
.tableCon {
    max-height: 500px;
    overflow-y: auto;
}
.tableCon2{
     max-height: 400px;
     font-size: 14px;
    overflow-y: auto;
}

.Student_table {
    width: 100%;
    border-collapse: collapse;
}
</style>
<body>
	<div class="Container_nav">
    
    
		<div id="modalContent"></div>
        <div class="main_content">
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
		<div class="container">
		    
		<header><h2>ENROLLMENT APPROVAL</h2></header>
        <div class="search_con">
			<!--<select id="rowsPerPage" onchange="changeRowsPerPage()" class="select_rows">-->
			<!--	<option value="5" <?php if (!isset($_GET['limit']) || $_GET['limit'] == 5) echo 'selected'; ?>>5</option>-->
			<!--	<option value="15" <?php if (isset($_GET['limit']) && $_GET['limit'] == 15) echo 'selected'; ?>>15</option>-->
			<!--	<option value="25" <?php if (isset($_GET['limit']) && $_GET['limit'] == 25) echo 'selected'; ?>>25</option>-->
			<!--	<option value="50" <?php if (isset($_GET['limit']) && $_GET['limit'] == 50) echo 'selected'; ?>>50</option>-->
			<!--</select>-->
			 <form class="search-form" method="GET" action="">
				<input type="text" id="search" name="search_query" class="search-input" placeholder="Search Student">
				<button type="submit" class="search-button" style="width: 100px;"><center>Search</center></button>
			</form>
		</div>

        <!-- <select class="select_rows" id="Role_Select">
    <option value="ALL">ALL</option>
    <option value="Student">Student</option>
    <option value="Admin">Admin</option>
    <option value="DI">DI</option>
</select> -->
		<div class="tableCon">
		    <div class="tableCon2">
			<table class = "Student_table">
                        <tr>
                            <th>Student Id</th>
                            <th>Last Name</th>
            				<th>First Name</th>
                            <th>Email</th>
                            <th>Contact Number</th>
                            <th>Balance</th>
                            <th>Address</th>
                            <th>Enrollment Status</th>
                            <th colspan="4" style="text-align:center;">Action</th>
            
                        </tr>
                   <?php
                // Establish a database connection (assuming you have done this)
                $host = "localhost";
                $username = "u896821908_bts";
                $password = "a*5E4UEhsHa]";
                $dbname = "u896821908_bts";
            
                $conn = new mysqli($host, $username, $password, $dbname);
            
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
            
               // Get the search query from the form submission
               if (isset($_GET['search_query'])) {
                $searchQuery = $_GET['search_query'];
            
                // Modify your SQL query to include a WHERE clause for filtering
                $sql = "SELECT * FROM student WHERE 
                        (idStudent LIKE '%$searchQuery%' OR
                        Lastname LIKE '%$searchQuery%' OR
                        Firstname LIKE '%$searchQuery%' OR
                        EmailAddress LIKE '%$searchQuery%' OR
                        Contactnumber LIKE '%$searchQuery%' OR
                        balance LIKE '%$searchQuery%' OR
                        Address LIKE '%$searchQuery%' OR
                        Enroll_Status LIKE '%$searchQuery%')
                        AND (`PDC-MOTOR` IS NOT NULL
                        OR `PDC-CAR` IS NOT NULL
                        OR `TDC` IS NOT NULL);";
            } else {
                // If no search query is provided, fetch all records
                $sql = "SELECT *  FROM student WHERE ( (`PDC-MOTOR` IS NOT NULL AND TRIM(`PDC-MOTOR`) <> '') OR 
                    (`PDC-CAR` IS NOT NULL AND TRIM(`PDC-CAR`) <> '') )
            and TDC IS NOT NULL and TDC_Cert_approve IS NULL or PDC_Cert_approve IS NULL AND `Enroll_Status`IS NOT null";
            }
            
            // Execute the modified SQL query
            $result = $conn->query($sql);
            	
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['idStudent'] . "</td>";
                        echo "<td>" . $row['Lastname'] . "</td>";
                        echo "<td>" . $row['Firstname'] . "</td>";
                        echo "<td>" . $row['EmailAddress'] . "</td>";
                        echo "<td>" . $row['Contactnumber'] . "</td>";
                        echo "<td>" . $row['balance'] . "</td>";
                        echo "<td>" . $row['Address'] . "</td>";
                        echo "<td>" . $row['Enroll_Status'] . "</td>";
            			echo "<td><button class='fee' onclick='openModal(\"" . $row['idStudent'] . "\")'><i class='fas fa-money-bill'></i></button></td>";
                        echo "<td><a class='edit' href='Admin_editview.php?id=" . $row['idStudent'] . "'><i class='fas fa-edit'></i></a></td>";
                        echo "<td><button class='del' data-studentid=" . $row['idStudent'] . " style='Display:$none'><i class='fas fa-trash'></i></button>";
            
            
            		
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='12'>No records found</td></tr>";
                }
            
                // Close the database connection
                $conn->close();
                ?>
            </table>
		</div>
    </div>
    
    </div>
    
    <div class="container">
		    
		<header><h2>TDC RETAKE REQUEST</h2></header>
        
		<div class="tableCon">
		    <div class="tableCon2">
		<table class="TDC_req_tbl">
    <tr>
        <th>Student Id</th>
        <th>Number of Requests</th>
        <th>Action</th>
    </tr>
    <?php
    $host = "localhost";
    $username = "u896821908_bts";
    $password = "a*5E4UEhsHa]";
    $dbname = "u896821908_bts";

    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from request_for_TDC_attempts
    $sql = "SELECT student_id, COUNT(student_id) as occurrences
            FROM request_for_TDC_attempts
            WHERE status = 'pending'
            GROUP BY student_id";

    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Fetch additional student details using student_id
                // Note: Replace the placeholder function with your actual function
                // $studentDetails = getStudentDetails($row['student_id'], $conn);

                echo "<tr>";
                echo "<td>" . $row['student_id'] . "</td>";
                echo "<td>" . $row['occurrences'] . "</td>";
                echo "<td><a class='edit' href='Admin_editview.php?id=" . $row['student_id'] . "'>VIEW</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No Request found</td></tr>";
        }

        $conn->close();
    } else {
        die("Error: " . $conn->error);
    }
    ?>
</table>



		</div>
    </div>
    
    </div>
   </div>
  </div> 

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	
<script>
window.onload = function() {
            window.scrollTo(0, 0); // Adjust the values if needed
        };
    // Function to handle the click event
    document.querySelectorAll('.del').forEach(function(button) {
        button.addEventListener('click', function() {
            // Get the student ID from the button's data attribute
            var studentId = this.getAttribute('data-studentid');
            
            // Display a confirmation prompt
            var confirmDelete = confirm("Are you sure you want to delete this student?");
            
            // If the user confirms, redirect to the deletion script
            if (confirmDelete) {
                window.location.href = "./php_scripts/Admin_Stud_Del.php?id=" + studentId;
            }
        });
    });
</script>

<script>
        function openModal(idStudent) {
            // Create a new XMLHttpRequest object
            var xhttp = new XMLHttpRequest();

            // Define the function to be executed when the request completes
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Insert the modal content into the 'modalContent' div
                    document.getElementById("modalContent").innerHTML = this.responseText;
                    // Display the modal
                    document.getElementById('take_fee_modal').style.display = 'block';
                }
            };

            // Send a GET request to the modal_content.php file and pass the 'id' parameter
            xhttp.open("GET", "./php_scripts/Admin_take_fee.php?id=" + idStudent, true);
            xhttp.send();
        }

        function closeModal() {
            // Hide the modal
            document.getElementById('take_fee_modal').style.display = 'none';
        }
		
        // Close the modal
        function closeModal() {
            document.getElementById('take_fee_modal').style.display = 'none';
        }

        // Close the modal when clicking outside the modal content
        window.onclick = function(event) {
            var modal = document.getElementById('take_fee_modal');
            if (event.target === modal) {
                closeModal();
            }
        };
    </script>

<script>
 function data_deleted() {
            // Your JavaScript function logic here
            alert("Student Record Deleted");

		// Reset the URL to the original state (without "success") after 2 seconds
            setTimeout(function() {
                history.replaceState({}, document.title, window.location.pathname);
            }, 1);
        }
 if(window.location.href.indexOf("deleted") !== -1) {
            data_deleted();
 }
</script>

<script>
function changeRowsPerPage() {
        var rowsPerPageSelect = document.getElementById('rowsPerPage');
        var selectedLimit = rowsPerPageSelect.options[rowsPerPageSelect.selectedIndex].value;
        var currentURL = new URL(window.location.href);
        currentURL.searchParams.set('limit', selectedLimit);
        window.location.href = currentURL.href;
    }

		function Payment_success() {
            // Your JavaScript function logic here
            alert("Payment Recorded to the Database!");

		// Reset the URL to the original state (without "success") after 2 seconds
            setTimeout(function() {
                history.replaceState({}, document.title, window.location.pathname);
            }, 1);
        }
		 function Payment_failed() {
            // Your JavaScript function logic here
            alert("Failed to insert Payment record to database. please try again.");

		// Reset the URL to the original state (without "success") after 2 seconds
            setTimeout(function() {
                history.replaceState({}, document.title, window.location.pathname);
            }, 1);
        }
		 function enrolled() {
            // Your JavaScript function logic here
            alert("Student is officially enrolled!");

		// Reset the URL to the original state (without "success") after 2 seconds
            setTimeout(function() {
                history.replaceState({}, document.title, window.location.pathname);
            }, 1);
        }
         function Denied() {
            // Your JavaScript function logic here
            alert("Student's Enrollment has been Denied.");

		// Reset the URL to the original state (without "success") after 2 seconds
            setTimeout(function() {
                history.replaceState({}, document.title, window.location.pathname);
            }, 1);
        }
        // Check if the URL contains "success" and trigger the function
        if (window.location.href.indexOf("Paid") !== -1) {
             Payment_success();
        }else if(window.location.href.indexOf("!Paid") !== -1) {
            Payment_failed();
        }else if(window.location.href.indexOf("enrolled") !== -1) {
            enrolled();
        }else if(window.location.href.indexOf("Denied") !== -1) {
            Denied();
        }
		
		$(document).ready(function() {

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
});

</script>
<script>
    function denyFormSubmit() {
        // Assuming the form has an ID of "denyForm"
        document.getElementById('denyForm').submit();
    }
</script>
</body>

</html>