<?php
include "../conn.php";
session_start();

if (empty($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

$roleStaff = $_SESSION['role'];
$admin_username = $_SESSION['username'];
//Dito ichecheck if teller or admin. pag teller then magiging none ang value nung $none
$none='';
if ($roleStaff === "Teller") {
          $none='none';
    }

$sqlMsgHist = "SELECT * FROM email_sms_history";
$stmtMsgHisto = $conn->query($sqlMsgHist);

$GetStdinfo = $_GET['id'] ?? '';
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
    <link href="../Admin/admin_styles/admin_reports.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


</head>

<style>

.table_container{
    display: block;
    height: 400px;
    overflow: auto;
    margin-top: 6%;
}
.table_container2{
    display: block;
    height: 400px;
    overflow: auto;
    margin-top: 1%;
}
.table_container3{
    display: block;
    height: 400px;
    overflow: auto;
    margin-top: 1%;
}
</style>

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

<div id="modalContent"></div><!-- MODAL HERE -->

    <div class="main_content">
    	<div class="container">
    	<header><h2>INSTRUCTOR REPORTS</h2></header>
   

		<!--<form class="search-form" method="GET" action="">-->
    <div class="search">
				<input type="text" id="search" name="search_query" class="search-bar" placeholder="Search...">
				<!--<button type="submit" class="search-button">Search</button>-->
			<!--</form>-->


<!--			<select class="sort-combo" onchange="changeSortingTable()" id="SortingTable">-->
<!--    <option value="name" <?php if (isset($_GET['Sortby']) && $_GET['Sortby'] == 'name') echo 'selected'; ?>>Sort by Name</option>-->
<!--    <option value="id" <?php if (isset($_GET['Sortby']) && $_GET['Sortby'] == 'id') echo 'selected'; ?>>Sort by ID</option>-->
<!--</select>-->
    </div>
     <div class="table_container">
         <table id="data-tableINS">
            <thead>
    
    			<tr class="TBheader">
    				<th id="driver-id-header">Driver Id</th>
    				<th id="name-header">Name</th>
    				<th>Contact Number</th>
    				<th>Student Name</th>
    				<th>Vehicle Used</th>
    				<th>Date of Assessment</th>
    				<th>Session</th>
    				<th colspan="4" style="text-align:center;">Action</th>
    			</tr>
        </thead>
        <tbody>
    
    			<?php
    			try {
    				if (isset($_GET['search_query'])) {
    					$searchQuery = '%' . $_GET['search_query'] . '%';
    
    					$sql = "SELECT dr.*, di.Lastname AS di_lastname, di.Firstname AS di_firstname, di.ContactNumber AS di_contact_number,
    							s.Lastname AS student_lastname, s.Firstname AS student_firstname, s.Middlename AS student_middlename
    							FROM di_report_tbl dr
    							LEFT JOIN di ON dr.DI_id = di.id_DI
    							LEFT JOIN student s ON dr.student_id = s.idStudent
    							WHERE dr.Vehicle LIKE :searchQuery OR dr.DateofAssessment LIKE :searchQuery
    							OR di.Lastname LIKE :searchQuery OR di.Firstname LIKE :searchQuery OR di.ContactNumber LIKE :searchQuery
    							OR s.Lastname LIKE :searchQuery OR s.Firstname LIKE :searchQuery OR s.Middlename LIKE :searchQuery";
    					
    					$stmt = $conn->prepare($sql);
    					$stmt->bindParam(':searchQuery', $searchQuery, PDO::PARAM_STR);
    					$stmt->execute();
    					
    					// Fetch and display the data
    					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr class='data-row'>";
    						$di_full_name = $row['di_lastname'] . ', ' . $row['di_firstname'];
    						$di_contact_number = $row['di_contact_number'];
    						$student_full_name = $row['student_lastname'] . ', ' . $row['student_firstname'] . ' ' . $row['student_middlename'];
    					
    						echo "<td>" . $row['DI_id'] . "</td>";
    						echo "<td>" . $di_full_name . "</td>";
    						echo "<td>" . $di_contact_number . "</td>";
    						echo "<td>" . $student_full_name . "</td>";
    						echo "<td>" . $row['Vehicle'] . "</td>";
    						echo "<td><center>" . $row['session'] . "</center></td>";
    						echo "<td>" . $row['DateofAssessment'] . "</td>";
    						echo "<td><button class='view-button' onclick='openModal(\"" . $row['report_id'] . "\")'>View</button></td>";
    						echo "</tr>";
    					}
    					
    
    				}
    				else{
    				// SQL query to retrieve data from di_report_tbl
    				$sql = "SELECT * FROM di_report_tbl";
    
    				// Execute the query
    				$stmt = $conn->prepare($sql);
    				$stmt->execute();
    
    				// Fetch and display the data
    				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    					echo "<tr>";
    					// Fetch the name and contact number from the "di" table using DI_id
    					$sql_di_info = "SELECT Lastname, Firstname, ContactNumber FROM di WHERE id_DI = :DI_id";
    					$stmt_di_info = $conn->prepare($sql_di_info);
    					$stmt_di_info->bindParam(':DI_id', $row['DI_id'], PDO::PARAM_INT);
    					$stmt_di_info->execute();
    
    					$di_info = $stmt_di_info->fetch(PDO::FETCH_ASSOC);
    
    					$di_full_name = $di_info['Lastname'] . ', ' . $di_info['Firstname'];
    					$di_contact_number = $di_info['ContactNumber'];
    
    					// Fetch the student name from the "student" table using student_id
    					$sql_student_info = "SELECT Lastname, Firstname, Middlename FROM student WHERE idStudent = :student_id";
    					$stmt_student_info = $conn->prepare($sql_student_info);
    					$stmt_student_info->bindParam(':student_id', $row['student_id'], PDO::PARAM_INT);
    					$stmt_student_info->execute();
    					$student_info = $stmt_student_info->fetch(PDO::FETCH_ASSOC);
    
    					$student_full_name = $student_info['Lastname'] . ', ' . $student_info['Firstname'] . ' ' . $student_info['Middlename'];
    					
    					echo "<td>" . $row['DI_id'] . "</td>";
    					echo "<td>" . $di_full_name . "</td>";
    					echo "<td>" . $di_contact_number . "</td>";
    					echo "<td>" . $student_full_name . "</td>";
    					echo "<td>" . $row['Vehicle'] . "</td>";
    					echo "<td><center>" . $row['session'] . "</center></td>";					
    					echo "<td>" . $row['DateofAssessment'] . "</td>";
    					echo "<td><button class='view-button' onclick='openModal(\"" . $row['report_id'] . "\")'>View</button></td>";
    					echo "</tr>";
    
    				}
    			}
    
    			} catch (PDOException $e) {
    				echo "Error: " . $e->getMessage();
    			} finally {
    					
    				if ($conn !== null) {
    					$conn = null;
    				}
    			}
    			?>
    			    </tbody>
    
    		</table>
      </div>	
	</div>
<br>
<br>
<div class="container">
    	<header><h2>MESSAGE HISTORY RESULT</h2></header>

		<!--<form class="search-form" method="GET" action="">-->
		
    <div class="search">
        <input type="text" id="searchSTDHisto" name="search_query" class="search-bar" placeholder="Search..." value="<?php echo htmlspecialchars($GetStdinfo); ?>">
        <!--				<button type="submit" class="search-button">Search</button>-->
        			<!--</form>-->
        
        
        <!--			<select class="sort-combo" onchange="changeSortingTable()" id="SortingTable">-->
        <!--    <option value="name" <?php if (isset($_GET['Sortby']) && $_GET['Sortby'] == 'name') echo 'selected'; ?>>Sort by Name</option>-->
        <!--    <option value="id" <?php if (isset($_GET['Sortby']) && $_GET['Sortby'] == 'id') echo 'selected'; ?>>Sort by ID</option>-->
        <!--</select>-->
    </div>
    <div class="table_container">
      <table id="data-table" class = "Sms_history_table">

			<tr>
				<th>Message ID</th>
				<th>Student ID</th>
				<th>Student Name</th>
				<th>Message Purpose</th>
				<th>Message Body</th>
				<th>Date sent</th>
			</tr>
			<?php
    while ($rowMsgHist = $stmtMsgHisto->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($rowMsgHist['Message_Id']) . '</td>';
        echo '<td>' . htmlspecialchars($rowMsgHist['Std_Id']) . '</td>';
        echo '<td>' . htmlspecialchars($rowMsgHist['Std_Name']) . '</td>';
        echo '<td>' . htmlspecialchars($rowMsgHist['Message_purpose']) . '</td>';
        echo '<td>' . htmlspecialchars($rowMsgHist['Message_body']) . '</td>';
        echo '<td>' . htmlspecialchars($rowMsgHist['Date_sent']) . '</td>';
        echo '</tr>';
    }
    ?>

		</table>
		</div>
		</div>
		
		
  <div class="Studentlist container">
         	<header><h2>STUDENT ENROLLED</h2></header>
         	
<!--<form method="GET" action="" id="filterForm">-->

    <div class="consearch">
<input type="text" name="search_query" id="SearchingStudentList" class="searchbar search-bar" placeholder="Search student" style="border:solid black 1px;">

<div class="filter">
    
<!--<select name="sortBy" id="sortByName">-->
<!--    <option value="1">Name</option> <!-- Adjust the value according to the column index -->
<!--    <option value="4">TDC</option>-->
<!--    <option value="5">PDC-MOTOR</option>-->
<!--    <option value="6">PDC-CAR</option>-->
<!--</select>-->

<!--<input type="date" name="fromDate" id="fromDate">-->
<!--<input type="date" name="toDate" id="toDate">-->
<!--<button type="submit" name="applyFilters" id="applyFilters" class= "apply">Filter</button>-->
<!--</form>-->
</div>

 </div>
    <div class="table_container2">
        <table class = "Student_table" id = "SearchingStudentListTable">
                       <thead>
                    <tr>
                        <th>Student Id</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Date Enrolled</th>
                        <th>TDC Course</th>
                        <!--<th>TDC Code</th>-->
                        <!--<th>Date Applied</th>-->
                        <th>PDC Motor</th>
                        <th>PDC Car</th>
                        <!--<th>PDC Code</th>-->
                        <!--<th>Date Applied</th>-->
                        <th colspan="4" style="text-align:center;">Action</th>
                    </tr>
                </thead>
                    <tbody>
            
                  <?php
            $servername = "localhost";
            $username = "u896821908_bts";
            $password = "a*5E4UEhsHa]";
            $dbname = "u896821908_bts";
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 
            
            $sql = "SELECT * FROM student";
            
            if(isset($_GET['applyFilters'])) {
                $searchQuery = $_GET['search_query'];
            
              $searchQuery = isset($_GET['searchQuery']) ? $conn->real_escape_string($_GET['searchQuery']) : '';
                $sortBy = isset($_GET['sortBy']) ? $conn->real_escape_string($_GET['sortBy']) : '';
            $fromDate = isset($_GET['fromDate']) ? $_GET['fromDate'] : null;
            $toDate = isset($_GET['toDate']) ? $_GET['toDate'] : null;
            
            // Validate and format dates only if they are not empty
            if (!empty($fromDate)) {
                $fromDate = date("Y-m-d", strtotime($fromDate));
            }
            if (!empty($toDate)) {
                $toDate = date("Y-m-d", strtotime($toDate));
            }
            
            
                $sql = "SELECT * FROM student
                        WHERE ( (`PDC-MOTOR` IS NOT NULL AND TRIM(`PDC-MOTOR`) <> '') OR 
                    (`PDC-CAR` IS NOT NULL AND TRIM(`PDC-CAR`) <> '') )
            or TDC IS NOT NULL and Enroll_Status = 'enrolled'";
                        
                   if (!empty($fromDate) && !empty($toDate)) {
              $sql = "SELECT * FROM student
                    WHERE ((`PDC-MOTOR` IS NOT NULL AND TRIM(`PDC-MOTOR`) <> '') OR 
                           (`PDC-CAR` IS NOT NULL AND TRIM(`PDC-CAR`) <> '')) 
                    AND TDC IS NOT NULL 
                    AND Enroll_Status = 'enrolled' 
                    AND `DateOfEnrolled` BETWEEN '$fromDate' AND '$toDate'";
                }else{
            
                    if (!empty($sortBy)) {
                        switch ($sortBy) {
                        case '1':
                            $sql = " SELECT * FROM `student` WHERE Enroll_Status = 'enrolled' ORDER BY `Lastname`, `Firstname`";
                            break;
                        case '4':
                            $sql = "SELECT * FROM `student` WHERE Enroll_Status = 'enrolled' and  TDC is NOT NULL";
                            break;
                        case '5':
                            $sql = "SELECT * FROM `student` WHERE Enroll_Status = 'enrolled' and (`PDC-MOTOR` IS NOT NULL AND TRIM(`PDC-MOTOR`) <> '')";
                            break;
                        case '6':
                            $sql = "SELECT * FROM `student` WHERE Enroll_Status = 'enrolled' and  (`PDC-CAR` IS NOT NULL AND TRIM(`PDC-CAR`) <> '') ";
                            break;
                        default:
            $sql = "SELECT * FROM student
                        WHERE ( (`PDC-MOTOR` IS NOT NULL AND TRIM(`PDC-MOTOR`) <> '') OR 
                    (`PDC-CAR` IS NOT NULL AND TRIM(`PDC-CAR`) <> '') )
            or TDC IS NOT NULL and Enroll_Status = 'enrolled'";
            break;
                    }
            }
                }
            
            
            }
            
            
            else {
                $sql = "SELECT * FROM student
                        WHERE ( (`PDC-MOTOR` IS NOT NULL AND TRIM(`PDC-MOTOR`) <> '') OR 
                    (`PDC-CAR` IS NOT NULL AND TRIM(`PDC-CAR`) <> '') )
            or TDC IS NOT NULL and Enroll_Status = 'enrolled'";
            }
            
            $result = $conn->query($sql);
            
            
               $LTOCodeM = "A(L1, L2, L3)";
                  $LTOCodeC = "B(M1)";
            
            if ($result) {
                if ($result->num_rows > 0) {
                    // Output the table rows
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['idStudent'] . "</td>";
                        echo "<td>" . $row['Lastname'] . "</td>";
                        echo "<td>" . $row['Firstname'] . "</td>";
                        echo "<td>" . $row['DateOfEnrolled'] . "</td>";
                        echo "<td>" . $row['TDC'] . "</td>";
                        // echo "<td>"  ."</td>";
                        // echo "<td>"  ."</td>";
                       
                        if (!empty($row['PDC-MOTOR'])) {
    echo "<td>".$row['PDC-MOTOR'] .' '. $LTOCodeM . "</td>";
}else{
     echo "<td>" . $row['PDC-MOTOR'] . "</td>";
}
                        if (!empty($row['PDC-CAR'])) {
    echo "<td>".$row['PDC-CAR'] . ' '. $LTOCodeC . "</td>";
}else{
 echo "<td>" . $row['PDC-CAR'] . "</td>";   
}

                        // echo "<td>" . "</td>";
                        // echo "<td>".  "</td>";
            
                        echo "<td><center><a class='edit' href='Admin_editview.php?id=" . $row['idStudent'] . "'><i class='fas fa-eye'></i></a></center></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No records found</td></tr>";
                }
            } else {
                echo "Error: " . $conn->error;
            }
            // echo $sql;
            // $conn->close();
            ?>
            
                </tbody>
            
        </table>
    </div>
   
   
   <br>
    <br>
    <div class="table_container3">
                 	<header><h2>Voucher History</h2></header>
<input type="text" name="search_query" id="SearchingStudentListVoucherHisto" class="searchbar search-bar" placeholder="Search student" style="border:solid black 1px;">

       <?php
       $query = "SELECT * FROM `voucher_history`";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

echo "<table border='1' id = 'VoucherHistory'>
    <tr>
        <th>Voucher ID</th>
        <th>Student ID</th>
        <th>Student Username</th>
        <th>TDC Code</th>
        <th>TDC Date Applied</th>
        <th>PDC Code</th>
        <th>PDC Date Applied</th>
        <!-- Add more columns based on your table structure -->
    </tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
        <td>{$row['voucherid']}</td>
        <td>{$row['std_id']}</td>
        <td>{$row['std_username']}</td>
        <td>{$row['tdc_code']}</td>
        <td>{$row['tdc_date_applied']}</td>
        <td>{$row['pdc_code']}</td>
        <td>{$row['pdc_date_applied']}</td>
        <!-- Add more cells based on your table structure -->
    </tr>";
}

echo "</table>";
       ?>
        
        
        
            </div>
   
</div>
  
</div>
		
    </div>




</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>


$(document).ready(function() {
    // Get the table and search input field
    var tableINS = $('#data-tableINS');
    var searchInputINS = $('#search');

    // Apply the search functionality on keyup event in the search input field
    searchInputINS.keyup(function() {
        var searchText = $(this).val().toLowerCase(); // Get the search text in lowercase

        // Loop through each table row (excluding the header row) and hide those that don't match the search query
        $('#data-tableINS tbody tr').each(function() {
            var DriverId= $('td:nth-child(1)', this).text().toLowerCase();
            var Name = $('td:nth-child(2)', this).text().toLowerCase();
            var ContactNumber = $('td:nth-child(3)', this).text().toLowerCase();
            var StudentName = $('td:nth-child(4)', this).text().toLowerCase();
            var DateofAssessment = $('td:nth-child(5)', this).text().toLowerCase();
            var Session = $('td:nth-child(6)', this).text().toLowerCase();
            
            if (DriverId.includes(searchText) || Name.includes(searchText) || ContactNumber.includes(searchText) || StudentName.includes(searchText) || DateofAssessment.includes(searchText) || Session.includes(searchText)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});


$(document).ready(function() {
    // Function to filter table rows based on input value
    function filterTable() {
        var value = $("#searchSTDHisto").val().toLowerCase();
        $("#data-table tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    }
    
    // Event listener for input event
    $("#searchSTDHisto").on("input", function() {
        filterTable();
    });

    // Event listener for onload event
    $(window).on("load", function() {
        filterTable();
    });
});


$(document).ready(function() {
    // Get the table and search input field
    var table = $('#SearchingStudentListTable');
    var searchInput = $('#SearchingStudentList');

    // Apply the search functionality on keyup event in the search input field
    searchInput.keyup(function() {
        var searchText = $(this).val().toLowerCase(); // Get the search text in lowercase

        // Loop through each table row (excluding the header row) and hide those that don't match the search query
        $('#SearchingStudentListTable tbody tr').each(function() {
            var studentId = $('td:nth-child(1)', this).text().toLowerCase();
            var lastName = $('td:nth-child(2)', this).text().toLowerCase();
            var firstName = $('td:nth-child(3)', this).text().toLowerCase();

            if (studentId.includes(searchText) || lastName.includes(searchText) || firstName.includes(searchText)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
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

function changeSortingTable() {
        var selectedOption = document.getElementById('SortingTable').value;

        if (selectedOption === 'name') {
            sortTableByName();
        } else if (selectedOption === 'id') {
            sortTableById();
        }
    }

 function sortTableByName() {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.querySelector('.Student_table');
        switching = true;
        
        while (switching) {
            switching = false;
            rows = table.rows;
            
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].querySelector('td:nth-child(2)'); // Change 2 to the column number of "Name"
                y = rows[i + 1].querySelector('td:nth-child(2)'); // Change 2 to the column number of "Name"
                
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
            
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }

    // Attach the click event listener to the "Name" column header
    document.getElementById('name-header').addEventListener('click', function () {
        sortTableByName();
    });

	function sortTableById() {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.querySelector('.Student_table');
        switching = true;
        
        while (switching) {
            switching = false;
            rows = table.rows;
            
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].querySelector('td:nth-child(1)'); // Change 1 to the column number of "Driver Id"
                y = rows[i + 1].querySelector('td:nth-child(1)'); // Change 1 to the column number of "Driver Id"
                
                if (parseInt(x.innerHTML) > parseInt(y.innerHTML)) {
                    shouldSwitch = true;
                    break;
                }
            }
            
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }

    // Attach the click event listener to the "Driver Id" column header
    document.getElementById('driver-id-header').addEventListener('click', function () {
        sortTableById();
    });

        function openModal(report_id) {
            // Create a new XMLHttpRequest object
            var xhttp = new XMLHttpRequest();

            // Define the function to be executed when the request completes
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Insert the modal content into the 'modalContent' div
                    document.getElementById("modalContent").innerHTML = this.responseText;
                    // Display the modal
                    document.getElementById('view_report_modal').style.display = 'block';
                }
            };

            // Send a GET request to the modal_content.php file and pass the 'id' parameter
            xhttp.open("GET", "./php_scripts/Admin_view_report.php?id=" + report_id, true);
            xhttp.send();
        }

        function closeModal() {
            // Hide the modal
            document.getElementById('view_report_modal').style.display = 'none';
        }

        // Close the modal when clicking outside the modal content
        window.onclick = function(event) {
            var modal = document.getElementById('view_report_modal');
            if (event.target === modal) {
                closeModal();
            }
        };
        
        
       
$(document).ready(function(){
    // Function to perform search
    $('#SearchingStudentListVoucherHisto').on('input', function(){
        var searchQuery = $(this).val().toLowerCase();

        $('#VoucherHistory tr:gt(0)').each(function(){
            var rowText = $(this).text().toLowerCase();
            // Show/hide rows based on the search query
            $(this).toggle(rowText.indexOf(searchQuery) > -1);
        });
    });
});

        
        
        
        
    </script>
    
    

</html>