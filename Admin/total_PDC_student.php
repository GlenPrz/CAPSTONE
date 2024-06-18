<?php
include "../conn.php";

// AGE get Data chart
$queryAgeStudent = "SELECT idStudent, Firstname, Lastname, Birthdate FROM student WHERE Enroll_Status = 'enrolled' and PDC_Cert_approve IS NULL
and (`PDC-MOTOR` IS NOT NULL OR `PDC-CAR` IS NOT NULL)";
$stmtAgeStudent = $conn->prepare($queryAgeStudent);
$stmtAgeStudent->execute();

$ageCategories = array("18-21", "22-25", "26-29", "30-33", "34-37", "38 and above");
$ageCounts = array_fill(0, count($ageCategories), 0);

$currentYear = date('Y');

while ($rowAgeStudent = $stmtAgeStudent->fetch(PDO::FETCH_ASSOC)) {
    $birthdate = $rowAgeStudent['Birthdate'];
    $birthYear = date('Y', strtotime($birthdate));
    $age = $currentYear - $birthYear;

    // Assign the age to an appropriate category
    if ($age >= 18 && $age <= 21) {
        $ageCounts[0]++;
    } elseif ($age >= 22 && $age <= 25) {
        $ageCounts[1]++;
    } elseif ($age >= 26 && $age <= 29) {
        $ageCounts[2]++;
    } elseif ($age >= 30 && $age <= 33) {
        $ageCounts[3]++;
    } elseif ($age >= 34 && $age <= 37) {
        $ageCounts[4]++;
    } else {
        $ageCounts[5]++;
    }
}

$ageData = array();
for ($i = 0; $i < count($ageCategories); $i++) {
    $ageData[] = array(
        "ageCategory" => $ageCategories[$i],
        "studentCount" => $ageCounts[$i]
    );
}
$maxCountIndex = array_keys($ageCounts, max($ageCounts))[0];
$maxAgeCategory = $ageCategories[$maxCountIndex];

// Count Gender
$CountGender = "SELECT Sex, COUNT(*) as count FROM student WHERE Enroll_Status = 'enrolled' and PDC_Cert_approve IS NULL
and (`PDC-MOTOR` IS NOT NULL OR `PDC-CAR` IS NOT NULL) GROUP BY Sex";
$stmtCountGender = $conn->prepare($CountGender);
$stmtCountGender->execute();

$CountMale = 0;
$CountFemale = 0;

while ($rowCountGender = $stmtCountGender->fetch(PDO::FETCH_ASSOC)) {
    if ($rowCountGender['Sex'] === 'MALE') {
        $CountMale += $rowCountGender['count'];
    } elseif ($rowCountGender['Sex'] === 'FEMALE') {
        $CountFemale += $rowCountGender['count'];
    }
}

// City Data Chart
$queryStdCity = "SELECT City, IFNULL(COUNT(*), 0) AS StudentCount FROM student WHERE Enroll_Status = 'enrolled' and PDC_Cert_approve IS NULL
and (`PDC-MOTOR` IS NOT NULL OR `PDC-CAR` IS NOT NULL) GROUP BY City";
$stmtStdCity = $conn->prepare($queryStdCity);
$stmtStdCity->execute();

$cityData = array();
while ($rowCity = $stmtStdCity->fetch(PDO::FETCH_ASSOC)) {
    $cityData[$rowCity['City']] = $rowCity['StudentCount'];
}

$cityLabelsFromDatabase = array_keys($cityData);

$queryDistinctCities = "SELECT DISTINCT City FROM student WHERE Enroll_Status = 'enrolled' and PDC_Cert_approve IS NULL
and (`PDC-MOTOR` IS NOT NULL OR `PDC-CAR` IS NOT NULL)";
$stmtDistinctCities = $conn->prepare($queryDistinctCities);
$stmtDistinctCities->execute();

$cityLabels = array();
while ($rowCity = $stmtDistinctCities->fetch(PDO::FETCH_ASSOC)) {
    $cityLabels[] = $rowCity['City'];
}

$allCities = array_unique(array_merge($cityLabels, $cityLabelsFromDatabase));
$cityCounts = array();
foreach ($allCities as $city) {
    $cityCounts[$city] = isset($cityData[$city]) ? $cityData[$city] : 0;
}

$maxCity = array_keys($cityCounts, max($cityCounts))[0];
$maxCityCount = max($cityCounts);

// Gender Data Chart
$queryGender = "SELECT Sex, COUNT(*) AS GenderCount FROM student WHERE Enroll_Status = 'enrolled' and PDC_Cert_approve IS NULL
and (`PDC-MOTOR` IS NOT NULL OR `PDC-CAR` IS NOT NULL) GROUP BY Sex";
$stmtGender = $conn->prepare($queryGender);
$stmtGender->execute();

$genderData = array();
while ($rowGender = $stmtGender->fetch(PDO::FETCH_ASSOC)) {
    $genderData[$rowGender['Sex']] = $rowGender['GenderCount'];
}

$genderLabels = array_keys($genderData);
$genderCounts = array_values($genderData);
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
    <link href="admin_styles/total_std.css" rel="stylesheet">
    <link href="admin_styles/admin_dash.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.min.js"></script>
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
        <div class="main_content">
            <header style="margin-bottom:1%;"><h2>TOTAL PDC STUDENTS</h2></header>
            <div class="con1">
            <div class="students">
                <div class="male">
                    <i class="fa fa-mars"></i>
                </div>
                <div class="label">
                    <h2>MALE</h2>
                    <label><?php echo $CountMale ?></label>
                    </div>
                
            </div><br>
            
            <div class="students">
                <div class="female">
                    <i class="fa fa-venus"></i>
                </div>
                <div class="label">
                    <h2>FEMALE</h2>
                    <label><?php echo $CountFemale ?></label>
                    </div>
                
            </div>
            </div>
            
            <div class="gender_chart">
                                                    <canvas id="genderChart"></canvas>

            </div>
            
            <div class="summary">
                <h2>The age of the most numerous students</h2>
                <label><?php echo $maxAgeCategory ?></label>
                <br><br>
                <h2>The address of the most numerous students</h2>
                <label><?php echo $maxCity ?></label>
                
                
            </div>
            
            <header><h2>STUDENT LIST</h2></header>
 <div class="Studentlist">
    <div class="consearch">
    <input type="text" class"searchbar" placeholder="Search student" id = "SearchingStudentList" style="border:solid black 1px;"></input>
 </div>
    <table class = "Student_table" id = "SearchingStudentListTable">
           <thead>
        <tr>
            <th>Student Id</th>
            <th>Last Name</th>
            <th>First Name</th>
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

if (isset($_GET['search_query'])) {
    $searchQuery = $_GET['search_query'];
    // Modify your SQL query to include a WHERE clause for filtering
    $sql = "SELECT * FROM student WHERE 
            (idStudent LIKE '%$searchQuery%' OR
            Lastname LIKE '%$searchQuery%' OR
            Firstname LIKE '%$searchQuery%' OR
            EmailAddress LIKE '%$searchQuery%' OR);";
}else {
    $sql = "SELECT * FROM student
            WHERE Enroll_Status = 'enrolled' and PDC_Cert_approve IS NULL
and (`PDC-MOTOR` IS NOT NULL OR `PDC-CAR` IS NOT NULL)";
}

$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        // Output the table rows
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['idStudent'] . "</td>";
            echo "<td>" . $row['Lastname'] . "</td>";
            echo "<td>" . $row['Firstname'] . "</td>";
            echo "<td><center><a class='edit' href='Admin_editview.php?id=" . $row['idStudent'] . "'><i class='fas fa-eye'></i></a></center></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No records found</td></tr>";
    }
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
    </tbody>

</table>

</div>
            
            
            <div class="age_chart">
                <h2>Student Ages</h2>
                                                                <canvas id="ageChart"></canvas>

            </div><br><br>
            <div class= "std_add">
            <h2>Student Address</h2>  
                                    <canvas id="addressChart"></canvas>

            </div>
            
            
        </div>
        </div>
        </body> 




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
//Age STD CHART
    // JavaScript: Create a bar graph using Chart.js
    var ctx = document.getElementById('ageChart').getContext('2d');
var ageChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($ageCategories); ?>,
        datasets: [{
            label: 'Number of Students',
            data: <?php echo json_encode(array_values($ageCounts)); ?>,
            backgroundColor: 'rgba(75, 192, 192, 0.6)', // Bar color
            borderWidth: 1,
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Number of Students'
                },
                ticks: {
                    stepSize: 1, // Set the step size to 1 to display whole numbers
                },
            },
            x: {
                title: {
                    display: true,
                    text: 'Age Category'
                }
            }
        }
    }
});





//STD City 
var ctxCity = document.getElementById('addressChart').getContext('2d');
    var addressChart = new Chart(ctxCity, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($cityLabels); ?>,
            datasets: [{
                label: 'Number of Students',
                data: <?php echo json_encode(array_values($cityCounts)); ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.6)', // Bar color
                borderWidth: 1,
            }]
        },
        options: {
            scales: {
                y: {
                    suggestedMin: 0, // Start at 0
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Students'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'City'
                    }
                }
            }
        }
    });

    //GENDER
var ctxGender = document.getElementById('genderChart').getContext('2d');
        var genderChart = new Chart(ctxGender, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($genderLabels); ?>,
                datasets: [{
                    data: <?php echo json_encode($genderCounts); ?>,
                    backgroundColor: ['purple', 'orange'], // Color for each gender
                    borderWidth: 1,
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Students Gender'
                }
            }
        });


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
    </script>

</html>