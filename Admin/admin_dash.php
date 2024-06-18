<script type="text/javascript">
  if (screen.width <= 1000) {
        window.location = "../login.php";
    }
</script>
<?php
include "../conn.php";
session_start();
// include "./php_scripts/Admin_EDIT_ENROLL.php";

//
$AdminSessionDash = $_SESSION['Adminid'];
$_SESSION['AdminSessionDash'] = $AdminSessionDash;


$sqlNumStdPDC = "SELECT COUNT(*) AS totalStudents
FROM student
WHERE Enroll_Status = 'enrolled' and PDC_Cert_approve IS NULL
and (`PDC-MOTOR` IS NOT NULL OR `PDC-CAR` IS NOT NULL)";
    $stmtNumStdPDC = $conn->prepare($sqlNumStdPDC);
    $stmtNumStdPDC->execute();

    // Fetch the result
    $resultNumStdPDC = $stmtNumStdPDC->fetch(PDO::FETCH_ASSOC);



 $sqlNumStdTDC = "SELECT COUNT(*) AS totalStudents FROM student WHERE TDC = 'Enrolling' and TDC_Cert_approve IS NULL and Enroll_Status = 'enrolled'";
    $stmtNumStdTDC = $conn->prepare($sqlNumStdTDC);
    $stmtNumStdTDC->execute();

    // Fetch the result
    $resultNumStdTDC = $stmtNumStdTDC->fetch(PDO::FETCH_ASSOC);



$sqlNumStd = "SELECT COUNT(*) As totalStudents FROM student WHERE ( (`PDC-MOTOR` IS NOT NULL AND TRIM(`PDC-MOTOR`) <> '') OR 
        (`PDC-CAR` IS NOT NULL AND TRIM(`PDC-CAR`) <> '') )
and TDC IS NOT NULL and TDC_Cert_approve IS NULL or PDC_Cert_approve IS NULL and Enroll_Status = 'enrolled'";


    $stmtNumSTD = $conn->prepare($sqlNumStd);
    $stmtNumSTD->execute();
        $resultNumSTD = $stmtNumSTD->fetch(PDO::FETCH_ASSOC);


//Eval
$sql_num_eval_Q1 = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q1 = 1;";
$stmt_num_evalQ1 = $conn->prepare($sql_num_eval_Q1);
$stmt_num_evalQ1->execute();
$data_num_evalQ1 = $stmt_num_evalQ1->fetchAll(PDO::FETCH_ASSOC);
$row_countQ1 = $data_num_evalQ1[0]['row_count'];

$sql_num_eval_Q2 = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q1 = 2;";
$stmt_num_evalQ2 = $conn->prepare($sql_num_eval_Q2);
$stmt_num_evalQ2->execute();
$data_num_evalQ2 = $stmt_num_evalQ2->fetchAll(PDO::FETCH_ASSOC);
$row_countQ2 = $data_num_evalQ2[0]['row_count'];

$sql_num_eval_Q3 = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q1 = 3;";
$stmt_num_evalQ3 = $conn->prepare($sql_num_eval_Q3);
$stmt_num_evalQ3->execute();
$data_num_evalQ3 = $stmt_num_evalQ3->fetchAll(PDO::FETCH_ASSOC);
$row_countQ3 = $data_num_evalQ3[0]['row_count'];

$sql_num_eval_Q4 = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q1 = 4;";
$stmt_num_evalQ4 = $conn->prepare($sql_num_eval_Q4);
$stmt_num_evalQ4->execute();
$data_num_evalQ4 = $stmt_num_evalQ4->fetchAll(PDO::FETCH_ASSOC);
$row_countQ4 = $data_num_evalQ4[0]['row_count'];

$sql_num_eval_Q5 = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q1 = 5;";
$stmt_num_evalQ5 = $conn->prepare($sql_num_eval_Q5);
$stmt_num_evalQ5->execute();
$data_num_evalQ5 = $stmt_num_evalQ5->fetchAll(PDO::FETCH_ASSOC);
$row_countQ5 = $data_num_evalQ5[0]['row_count'];


$sql_num_eval = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb";
$stmt_num_eval = $conn->prepare($sql_num_eval);
$stmt_num_eval->execute();
$data_num_eval = $stmt_num_eval->fetchAll(PDO::FETCH_ASSOC);
$row_count = $data_num_eval[0]['row_count'];

//Eval


$sqlStudentDateEnrolled = "SELECT MONTH(DateOfEnrolled) AS month, COUNT(*) AS student_date_enrolled
                           FROM u896821908_bts.student
                           GROUP BY MONTH(DateOfEnrolled)";

$stmtStudentDateEnrolled = $conn->prepare($sqlStudentDateEnrolled);
$stmtStudentDateEnrolled->execute();

$dataStudentDateEnrolled = $stmtStudentDateEnrolled->fetchAll(PDO::FETCH_ASSOC);
$dataJsonStudentDateEnrolled = json_encode($dataStudentDateEnrolled);

// Fetch data for date_enrolled
$sqlDateEnrolled = "SELECT MONTH(date_enrolled) AS month, COUNT(*) AS student_count
                    FROM u896821908_bts.evalres_tb
                    WHERE license IS NOT NULL
                    GROUP BY MONTH(date_enrolled)";

$stmtDateEnrolled = $conn->prepare($sqlDateEnrolled);
$stmtDateEnrolled->execute();
$dataEnrolled = $stmtDateEnrolled->fetchAll(PDO::FETCH_ASSOC);
$dataJsonEnrolled = json_encode($dataEnrolled);


//TDC EXAM RESULT
$queryExamResultTDC = "SELECT Session_num,
                 AVG(num_of_wrong_ans) AS avg_wrong_answers,
                 AVG(Score) AS avg_score
          FROM student_result where Session_num > 0
          GROUP BY Session_num";

$stmtExamResultTDC = $conn->query($queryExamResultTDC);
$dataExamResultTDC = $stmtExamResultTDC->fetchAll(PDO::FETCH_ASSOC);

$sessionLabels = [];
$avgWrongAnswersData = [];
$avgScoreData = [];

foreach ($dataExamResultTDC as $rowExamResultTDC) {
    // $sessionLabels[] = "TDC Exam " . $rowExamResultTDC['Session_num'];
    $sessionLabels[] = "TDC Exam " . $rowExamResultTDC['Session_num'];
    $avgWrongAnswersData[] = (float) $rowExamResultTDC['avg_wrong_answers'];
    $avgScoreData[] = (float) $rowExamResultTDC['avg_score'];
}

// Format data for Chart.js
$chartDataExamResultTDC = [
    'labels' => $sessionLabels,
    'datasets' => [
        [
            'label' => 'Wrong Answers',
            'data' => $avgWrongAnswersData,
            'backgroundColor' => 'orange'
        ],
        [
            'label' => 'Score',
            'data' => $avgScoreData,
            'backgroundColor' => 'blue'
        ]
    ]
];






// Define the rating options and their corresponding colors
$ratingOptions = [
    "Very Good" => "rgba(255, 99, 132, 0.6)",
    "Good" => "rgba(54, 162, 235, 0.6)",
    "Fair" => "rgba(255, 206, 86, 0.6)",
    "Poor" => "rgba(75, 192, 192, 0.6)",
    "Very Poor" => "rgba(153, 102, 255, 0.6)"
];

// Define custom labels for questions Q2 to Q5
$questionLabels = [
    "Q2" => "Level of knowledge on start of course",
    //"Level of knowledge on start of course",
    "Q3" => "Level of effort invested in course",
    //"Level of effort invested in course",
    "Q4" => "Level of knowledge at the end of course",
    //"Level of knowledge at the end of course",
    "Q5" => "Level of communication"
    //"Level of communication"
];

// Fetch data for Q2 to Q5
$query = "SELECT Q2, Q3, Q4, Q5 FROM feedres_tb";
$stmt = $conn->prepare($query);
$stmt->execute();

// Initialize an array to store the count of each rating option for each question (Q2, Q3, Q4, Q5)
$ratingCounts = array();

foreach ($ratingOptions as $option => $color) {
    $ratingCounts[$option] = array_fill_keys(["Q2", "Q3", "Q4", "Q5"], 0);
}

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    foreach ($ratingOptions as $option => $color) {
        foreach (["Q2", "Q3", "Q4", "Q5"] as $question) {
            // Increment the count for the corresponding rating option and question
            if (isset($row[$question]) && $row[$question] === $option) {
                $ratingCounts[$option][$question]++;
            }
        }
    }
}


//FeedBack Chart
$query = "SELECT Q1, COUNT(*) AS OptionCount FROM feedres_tb GROUP BY Q1";
$stmt = $conn->prepare($query);
$stmt->execute();

$optionData = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $optionData[$row['Q1']] = $row['OptionCount'];
}

// Prepare the data for JavaScript
$optionLabels = array_keys($optionData);
$optionCounts = array_values($optionData);


//Pie chart Gender
$queryGender = "SELECT Sex, COUNT(*) AS GenderCount FROM student GROUP BY Sex";
$stmtGender = $conn->prepare($queryGender);
$stmtGender->execute();

$genderData = array();
while ($rowGender = $stmtGender->fetch(PDO::FETCH_ASSOC)) {
    $genderData[$rowGender['Sex']] = $rowGender['GenderCount'];
}

// Prepare the gender data for JavaScript
$genderLabels = array_keys($genderData);
$genderCounts = array_values($genderData);

//City get DataChart
$queryStdCity = "SELECT City, IFNULL(COUNT(*), 0) AS StudentCount FROM student GROUP BY City";
$stmtStdCity = $conn->prepare($queryStdCity);
$stmtStdCity->execute();

$cityData = array();
while ($rowCity = $stmtStdCity->fetch(PDO::FETCH_ASSOC)) {
    $cityData[$rowCity['City']] = $rowCity['StudentCount'];
}

$cityLabelsFromDatabase = array_keys($cityData);

// Fetch distinct city labels from the database
$queryDistinctCities = "SELECT DISTINCT City FROM student";
$stmtDistinctCities = $conn->prepare($queryDistinctCities);
$stmtDistinctCities->execute();

$cityLabels = array();
while ($rowCity = $stmtDistinctCities->fetch(PDO::FETCH_ASSOC)) {
    $cityLabels[] = $rowCity['City'];
}

// Ensure that there is a count of 0 for all cities
$allCities = array_unique(array_merge($cityLabels, $cityLabelsFromDatabase));
$cityCounts = array();
foreach ($allCities as $city) {
    $cityCounts[$city] = isset($cityData[$city]) ? $cityData[$city] : 0;
}
$cityCounts[] = 0;

//AGE get Data chart
$queryAgeStudent = "SELECT idStudent, Firstname, Lastname, Birthdate FROM student";
$stmtAgeStudent = $conn->prepare($queryAgeStudent);
$stmtAgeStudent->execute();

$ageCategories = array("18-21", "22-25", "26-30", "31-35", "36-40", "41 and above");
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
    } elseif ($age >= 26 && $age <= 30) {
        $ageCounts[2]++;
    } elseif ($age >= 31 && $age <= 35) {
        $ageCounts[3]++;
    } elseif ($age >= 36 && $age <= 40) {
        $ageCounts[4]++;
    } else {
        $ageCounts[5]++;
    }
}

// Prepare the age data for JavaScript
$ageData = array();

for ($i = 0; $i < count($ageCategories); $i++) {
    $ageData[] = array(
        "ageCategory" => $ageCategories[$i],
        "studentCount" => $ageCounts[$i]
    );
}

$rating = ((5 * $row_countQ5) + (4 * $row_countQ4) + (3 * $row_countQ3) + (2 * $row_countQ2) + (1 * $row_countQ1)) / $row_count;
$rating = number_format($rating, 2);

$Percentage1 = ($row_countQ1/$row_count) * 100;
$Percentage2 = ($row_countQ2/$row_count) * 100;
$Percentage3 = ($row_countQ3/$row_count) * 100;
$Percentage4 = ($row_countQ4/$row_count) * 100;
$Percentage5 = ($row_countQ5/$row_count) * 100;

if (empty($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}
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
        <div class="maintitle"><header><h2>BEST TRAINING SCHOOL</h2><a href="concerns.php"><i class="fas fa-envelope"></i></a></header></div>
        <div class="demographics">

            <a href="total_std.php" class = "content_total_student">
                <div class="totalstd_div">
                 <i class="fas fa-user-alt"></i>  
                </div>
                <div class="totalstd"><label>Total Enrolled Students</label><br>
                    <label style="font-size: 32px; font-weight: bold;"><?php echo $resultNumSTD['totalStudents']; ?></label>
                </div>
                </a>
                <a href="total_TDC_student.php" class = "content_total_student">
                    <div class="totalstd_div">
                 <i style="color: orange;" class="fas fa-user-alt"></i>  
                </div>
                <div class="totalstd"><label>Current Enrolled TDC Students</label><br>
                    <label style="font-size: 32px; font-weight: bold;"><?php echo $resultNumStdTDC['totalStudents']; ?></label>
                </div>
                </a>
                <a href="total_PDC_student.php" class = "content_total_student">
                    <div class="totalstd_div">
                 <i style="color: red;" class="fas fa-user-alt"></i>  
                </div>
                <div class="totalstd"><label>Current Enrolled PDC Students</label><br>
                    <label style="font-size: 32px; font-weight: bold;"><?php echo $resultNumStdPDC['totalStudents']; ?></label>
                </div>
                </a>      
 </div>

 <div class="examres">
    <div class="Overall">
<h2>Student Evaluation</h2>
  <div class="total">
    <h1> <?php echo $rating ?></h1>
    <p>average based on <?php echo $row_count ?> reviews.</p>
<hr style="border:3px solid #f1f1f1">

<div class="row">
  <div class="side">
    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-5"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_countQ5 ?></div>
  </div>
  <div class="side">
    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-4"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_countQ4 ?></div>
  </div>
  <div class="side">
    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-3"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_countQ3 ?></div>
  </div>
  <div class="side">
    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-2"></div>
    </div>
  </div>
  <div class="side right">
  <div><?php echo $row_countQ2 ?></div>
  </div>
  <div class="side">
   <div class="star"><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-1"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_countQ1 ?></div>
  </div>
</div>
  </div>

  <br>
  <br>
  <a href ="../Admin/sample.php"><button class="std_TDC_res">More Details>></button></a>
</div>

     <div class="exam">
        <h2>TDC Exam Results</h2>
        <canvas class="exam" id="resultChart"></canvas>
        <a href="TDC_exam_res.php"><button class="std_TDC_res">More Details>></button></a>
    </div>

    
 </div>
<!--<header><h2>STUDENT LIST</h2></header>-->
<!-- <div class="Studentlist">-->
<!--    <div class="consearch">-->
<!--    <input type="text" class"searchbar" placeholder="Search student" id = "SearchingStudentList" style="border:solid black 1px;"></input>-->
<!-- </div>-->
<!--    <table class = "Student_table" id = "SearchingStudentListTable">-->
<!--           <thead>-->
<!--        <tr>-->
<!--            <th>Student Id</th>-->
<!--            <th>Last Name</th>-->
<!--            <th>First Name</th>-->
<!--            <th colspan="4" style="text-align:center;">Action</th>-->
<!--        </tr>-->
<!--    </thead>-->
<!--        <tbody>-->

       <?php
// $servername = "localhost";
// $username = "u896821908_bts";
// $password = "a*5E4UEhsHa]";
// $dbname = "u896821908_bts";

// $conn = new mysqli($servername, $username, $password, $dbname);

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// } 

// $sql = "SELECT * FROM student";

// if (isset($_GET['search_query'])) {
//     $searchQuery = $_GET['search_query'];
//     // Modify your SQL query to include a WHERE clause for filtering
//     $sql = "SELECT * FROM student WHERE 
//             (idStudent LIKE '%$searchQuery%' OR
//             Lastname LIKE '%$searchQuery%' OR
//             Firstname LIKE '%$searchQuery%' OR
//             EmailAddress LIKE '%$searchQuery%' OR);";
// }else {
//     $sql = "SELECT * FROM student
//             WHERE `PDC-MOTOR` IS NOT NULL
//             OR `PDC-CAR` IS NOT NULL
//             OR `TDC` IS NOT NULL;";
// }

// $result = $conn->query($sql);

// if ($result) {
//     if ($result->num_rows > 0) {
//         // Output the table rows
//         while ($row = $result->fetch_assoc()) {
//             echo "<tr>";
//             echo "<td>" . $row['idStudent'] . "</td>";
//             echo "<td>" . $row['Lastname'] . "</td>";
//             echo "<td>" . $row['Firstname'] . "</td>";
//             echo "<td><center><a class='edit' href='Admin_editview.php?id=" . $row['idStudent'] . "'><i class='fas fa-eye'></i></a></center></td>";
//             echo "</tr>";
//         }
//     } else {
//         echo "<tr><td colspan='4'>No records found</td></tr>";
//     }
// } else {
//     echo "Error: " . $conn->error;
// }

// $conn->close();
?>
<!--    </tbody>-->

<!--</table>-->

<!--</div>-->
 
   


            </div>
            
        </div>
        
    </div>

    
</body>
<?php
  echo '<script>';
  echo 'document.querySelector(".bar-1").style.width = "' . $Percentage1 . '%";';
  echo 'document.querySelector(".bar-2").style.width = "' . $Percentage2 . '%";';
  echo 'document.querySelector(".bar-3").style.width = "' . $Percentage3 . '%";';
  echo 'document.querySelector(".bar-4").style.width = "' . $Percentage4 . '%";';
  echo 'document.querySelector(".bar-5").style.width = "' . $Percentage5 . '%";';
  echo '</script>';
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

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


   // Parse PHP data into JavaScript
   const dataStudentDateEnrolled = <?php echo $dataJsonStudentDateEnrolled; ?>;
const dataEnrolled = <?php echo $dataJsonEnrolled; ?>;

const monthNames = ["January", "February", "March", "April", "May", "June", "July", 
                    "August", "September", "October", "November", "December"];

const mergedData = [];

for (let i = 0; i < 12; i++) {
    const month = monthNames[i];
    const studentDateEnrolled = dataStudentDateEnrolled.find(item => item.month - 1 === i);
    const enrolled = dataEnrolled.find(item => item.month - 1 === i);
    
    const countStudentDateEnrolled = studentDateEnrolled ? studentDateEnrolled.student_date_enrolled : 0;
    const countEnrolled = enrolled ? enrolled.student_count : 0;

    mergedData.push({
        month: month,
        student_date_enrolled: countStudentDateEnrolled,
        student_count: countEnrolled
    });
}


 // Create the bar chart using Chart.js
 var ctxExamResultTDC = document.getElementById('resultChart').getContext('2d');
        var resultChart = new Chart(ctxExamResultTDC, {
            type: 'bar',
            data: <?php echo json_encode($chartDataExamResultTDC); ?>,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Students'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Session'
                        }
                    }
                }
            }
        });










//GENDER
// var ctxGender = document.getElementById('genderChart').getContext('2d');
//         var genderChart = new Chart(ctxGender, {
//             type: 'pie',
//             data: {
//                 labels: <?php echo json_encode($genderLabels); ?>,
//                 datasets: [{
//                     data: <?php echo json_encode($genderCounts); ?>,
//                     backgroundColor: ['purple', 'orange'], // Color for each gender
//                     borderWidth: 1,
//                 }]
//             },
//             options: {
//                 title: {
//                     display: true,
//                     text: 'Students Gender'
//                 }
//             }
//         });




//Age STD CHART
   



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