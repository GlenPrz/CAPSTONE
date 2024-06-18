<?php
include "../conn.php";
session_start();
include "./php_scripts/Admin_EDIT_ENROLL.php";


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
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
    <link href="admin_styles/admin_nav.css" rel="stylesheet">
    <link href="admin_styles/admin_dash.css" rel="stylesheet">
        <link href="../Admin/admin_styles/edit_modal.css" rel="stylesheet">
        <link href="../Admin/admin_styles/admin_Pupdate.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<style>
    .nav_links a:nth-child(4) {
  background-color: #F7FFF5;
  border-radius: 10px;
  color: black;
}
.nav_links a:hover {
    background-color: black;
    color: white;
    border-radius: 10px;

}
</style>


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

        <div class="holder">
        <div class="main_content">

<header style="margin-bottom:1% ;"><h2>STUDENT LIST</h2></header>
 <div class="Studentlist" style="height: 600px;">
     <div class="consearch">
<input type="text" class="searchbar" id="searchInput" placeholder="Search by Student Id, Username, or Full Name">
    <button type="submit" name="search" class="submit"><i class="fa fa-search"></i></button>
 </div>
 
 <table class="Student_table">
    <tr>
        <th>Student Id</th>
        <th>Username</th>
        <th>Full Name</th>
        <th>Exam Result</th>
        <th colspan="4" style="text-align:center;">Action</th>
    </tr>
    <?php
    // Establish a database connection
    $servername = "localhost";
    $username = "u896821908_bts";
    $password = "a*5E4UEhsHa]";
    $dbname = "u896821908_bts";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Initialize $sql with a default query
    $sql = "SELECT student.idStudent, student.Firstname, student.Lastname, student_result.username
            FROM student
            JOIN student_result ON student.Username = student_result.username
            GROUP BY student.idStudent, student.Firstname, student.Lastname, student_result.username";

    // Get the search query from the form submission
    if (isset($_GET['search_query'])) {
        $searchQuery = $_GET['search_query'];
        // Modify your SQL query to include a WHERE clause for filtering
        $sql .= " HAVING 
                 idStudent LIKE '%$searchQuery%' OR
                 Lastname LIKE '%$searchQuery%' OR
                 Firstname LIKE '%$searchQuery%' OR
                 EmailAddress LIKE '%$searchQuery%'";
    }

    // Execute the SQL query
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            // Output the table rows
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['idStudent'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['Lastname'] . ", " . $row['Firstname'] . "</td>";

                // Fetch TDC Exam Result for this user
                $queryExamResultTDC = "SELECT student_result.Session_num,
                                       MAX(student_result.Score) AS max_score,
                                       SUM(student_result.num_of_wrong_ans) AS total_wrong_answers,
                                       SUM(student_result.Score) AS total_score
                                       FROM student_result
                                       WHERE student_result.username = '" . $row['username'] . "'
                                       GROUP BY student_result.Session_num";

                $stmtExamResultTDC = $conn->query($queryExamResultTDC);

                $sessionLabels = [];
                $wrongAnswersData = [];
                $scoreData = [];

                while ($rowExamResultTDC = $stmtExamResultTDC->fetch_assoc()) {
                    $sessionLabels[] = "Session " . $rowExamResultTDC['Session_num'];
                    $wrongAnswersData[] = (int)$rowExamResultTDC['total_wrong_answers'];
                    $scoreData[] = (int)$rowExamResultTDC['total_score'];
                }

                // Format data for Chart.js
                $chartDataExamResultTDC = [
                    'labels' => $sessionLabels,
                    'datasets' => [
                        [
                            'label' => 'Total Wrong Answers',
                            'data' => $wrongAnswersData,
                            'backgroundColor' => 'red'
                        ],
                        [
                            'label' => 'Total Score',
                            'data' => $scoreData,
                            'backgroundColor' => 'blue'
                        ]
                    ]
                ];

                echo "<td><canvas id='resultChart_" . $row['username'] . "' width = '80%'></canvas></td>";
echo "<td><center><a class='edit' onclick='openStudentResult(\"" . $row['username'] . "\")'><i class='fas fa-eye'></i></a></center></td>";
                
                echo "</tr>";
                echo "<script>
                        var ctxExamResultTDC_" . $row['username'] . " = document.getElementById('resultChart_" . $row['username'] . "').getContext('2d');
                        var resultChart_" . $row['username'] . " = new Chart(ctxExamResultTDC_" . $row['username'] . ", {
                            type: 'bar',
                            data: " . json_encode($chartDataExamResultTDC) . ",
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        title: {
                                            display: true,
                                            text: 'Count'
                                        }
                                    },
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Session'
                                        }
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top'
                                    }
                                }
                            }
                        });
                    </script>";
            }
        } else {
            echo "<tr><td colspan='4'>No records found</td></tr>";
        }
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
    ?>
</table>

 <div class="modal" id="viewModal_<?php echo $row['username']; ?>">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="studentUsername"></div>
    </div>

</div>
</div>

    
   
</div>
</div>
    
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
 document.getElementById("searchInput").addEventListener("input", function() {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.querySelector(".Student_table");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and each cell within the row
        for (i = 1; i < tr.length; i++) { // Start from 1 to skip table header row
            var found = false;
            td = tr[i].getElementsByTagName("td");
            for (j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
            }
            if (found) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    });



   function openStudentResult(Std_id_result) {
      // Create a new XMLHttpRequest object
      var xhttp = new XMLHttpRequest();

      // Define the function to be executed when the request completes
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          // Insert the modal content into the 'modalContent' div
          document.getElementById("modalContentCourseInformation").innerHTML = this.responseText;
          // Display the modal
          document.getElementById('editModalCourse').style.display = 'block';
        }
      };

      // Send a GET request to the edit_question.php file and pass the 'id' parameter
      xhttp.open("GET", "../Admin/php_scripts/admin_Pupdate_course.php?Stdid_res=" + Std_id_result, true);
      xhttp.send();
    }




$(document).ready(function() {
$('#logoutLink').click(function(event) {
        event.preventDefault(); // Prevent the default link behavior
        $.ajax({
            url: '../logout.php', // The URL of your PHP script to handle logout
            type: 'POST', // You can also use 'GET' if your server configuration allows
            success: function(response) {
                // Redirect to login.php on successful logout
                window.location.href = '../login.php';
            },
            error: function(xhr, status, error) {
                console.error(error); // Log any errors to the console
            }
        });
  });
});

 function closeModal() {
      document.getElementById('editModalCourse').style.display = 'none';
    }

    </script>
<?php
include "../Admin/php_scripts/admin_Pupdate_modal.php"
?>
</html>