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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>BTS Driving school</title>
	<link rel="icon" type="image/x-icon" href="../img/favicon.ico">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
    <link href="admin_styles/admin_feedback.css" rel="stylesheet">
    <link href="admin_styles/admin_nav.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

        <header>
            <h2>Feedback Results</h2>
        </header><br>
        <div class="search">

      <input type="text" class="search-bar" placeholder="Enter your search query">
    <button class="search-button" onclick="searchTable()">Search</button>


        <select class="sort-combo" onchange="changeSortingTable()" id="SortingTable">
    <option value="name" <?php if (isset($_GET['Sortby']) && $_GET['Sortby'] == 'name') echo 'selected'; ?>>Sort by Student Name</option>
    <option value="id" <?php if (isset($_GET['Sortby']) && $_GET['Sortby'] == 'id') echo 'selected'; ?>>Sort by Student ID</option>
</select>
    </div>

        <table class = "Feedback_Table">
            <tr>
                <th>Response ID</th>
                <th id="Student_ID">Student ID</th>
                <th id="Student_name">Student Name</th>
                <th>Instructor Name</th>
                <th>Why did you chose this course?</th>
                <th>How would you rate your driving instructor's</th>
                <th>How comfortable did your driving instructor make you feel during the lessons?</th>
                <th>How well did your driving instructor provide constructive feedback on your driving skills and areas needing improvement?</th>
                <th>How punctual and reliable was your driving instructor in terms of lesson timings and scheduling?</th>
                <th>Would you recommend this course to other students?</th>
            </tr>
            <!-- Replace the following rows with actual feedback data -->
           <?php
            $query = "SELECT * FROM u896821908_bts.feedres_tb";
            $stmt = $conn->prepare($query);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                // Loop through the rows and populate the table
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    echo '<td>' . $row['Response_ID'] . '</td>';
                    echo '<td>' . $row['Student_id'] . '</td>';
                    echo '<td>' . $row['Student_name'] . '</td>';
                    echo '<td>' . $row['DI_Name'] . '</td>';
                    echo '<td>' . $row['Q1'] . '</td>';
                    echo '<td>' . $row['Q2'] . '</td>';
                    echo '<td>' . $row['Q3'] . '</td>';
                    echo '<td>' . $row['Q4'] . '</td>';
                    echo '<td>' . $row['Q5'] . '</td>';
                    echo '<td>' . $row['Q6'] . '</td>';

                  
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="4">No data found.</td></tr>';
                // Set page to 1 and limit to 5 when no data found
                $page = 1;
                $limit = 5;
                echo '<script>';
                echo 'var rowsPerPageSelect = document.getElementById("rowsPerPage");';
                echo 'rowsPerPageSelect.selectedIndex = 0;'; // Select the first option (5 rows)
                echo 'var currentURL = new URL(window.location.href);';
                echo 'currentURL.searchParams.set("page", 1);'; // Set page to 1
                echo 'currentURL.searchParams.set("limit", 5);'; // Set limit to 5
                echo '</script>';
            }
           ?>
            <!-- Add more rows as needed -->
        </table>
        
    </div>
    </div>
</body>
	<!-- LOGOUT -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script>

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
        table = document.querySelector('.Feedback_Table');
        switching = true;
        
        while (switching) {
            switching = false;
            rows = table.rows;
            
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].querySelector('td:nth-child(1)'); // Change 2 to the column number of "Name"
                y = rows[i + 1].querySelector('td:nth-child(1)'); // Change 2 to the column number of "Name"
                
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
    document.getElementById('Student_name').addEventListener('click', function () {
        sortTableByName();
    });

	function sortTableById() {
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.querySelector('.Feedback_Table');
    switching = true;

    while (switching) {
        switching = false;
        rows = table.rows;

        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].querySelector('td:nth-child(2)'); // Change 2 to the column number of "Student ID"
            y = rows[i + 1].querySelector('td:nth-child(2)'); // Change 2 to the column number of "Student ID"

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

// Attach the click event listener to the "Student ID" column header
document.getElementById('Student_ID').addEventListener('click', function () {
    sortTableById();
});

var input = document.querySelector(".search-bar");
        input.addEventListener("input", function () {
            var filter = input.value.trim().toUpperCase();
            var table = document.querySelector(".Feedback_Table");
            var tr = table.getElementsByTagName("tr");

            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                    }
        });

function searchTable() {
            var input, filter, table, tr, td, i, j, txtValue;
            input = document.querySelector(".search-bar");
            filter = input.value.toUpperCase();
            table = document.querySelector(".Feedback_Table");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) { // Start from 1 to skip the table header row
                td = tr[i].getElementsByTagName("td");
                var found = false; // Flag to check if any cell in the row matches
                for (j = 0; j < td.length; j++) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break; // If one cell in the row matches, stop searching the cells
                    }
                }
                if (found) {
                    tr[i].style.display = ""; // Display the row if any cell matches
                } else {
                    tr[i].style.display = "none"; // Hide the row if no match is found
                }
            }
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
</html>
