<?php
session_start();

if (empty($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}
 // Include the modal content
 include '../conn.php';
    $pdfArray = [];

    $sql = "SELECT * FROM u896821908_bts.admin_module_exam_pdf";
    $stmt = $conn->query($sql);
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $id = $row['idadmin_module_exam_pdf'];
        $pdfData = $row['pdf'];
        
        // Store the PDF data in the array
        $pdfArray[] = [
            'id' => $id,
            'pdf_data' => $pdfData,
            'pdf_name' => basename($pdfData), // Optionally store the PDF file name
        ];

        }
    }else {
        echo "No rows found.";
    }
$pdfName1 = $pdfArray[0]['pdf_name'];
$pdfName2 = $pdfArray[1]['pdf_name'];
$pdfName3 = $pdfArray[2]['pdf_name'];
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
  <link href="admin_styles/admin_mod_ex.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="admin_styles\edit_modal.css">
  <link rel="stylesheet" type="text/css" href="admin_styles\add_modal.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.min.js"></script>


</head>
<style>
  body {
  font-family: Arial, sans-serif;
  text-decoration: none;
}
  
  .third_content{
  }
 
  .pdc_question_table{
    overflow-y: scroll;
    overflow-x: hidden;

    height: 500px;
    width: 100%;
    font-size: 15px;
  }

  .pdc_question_table table{
    width: 100%;
  } 

  .main_content {}

  .main_content h1 {
    padding-right: 75%;
    margin-left: 1%;
  }

  .Second_content {
    width: 100%;
  }

  .ex_tbl {
    width: 100%;
    height: 500px;
    overflow-x: auto;
    overflow-y: scroll;
    border-collapse: collapse;
  }

  table {
    overflow: scroll;
    border-collapse: collapse;
    margin: 1% 1%;
  }

  th,
  td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }

  th {
    background-color: #f2f2f2;
  }

  tr:hover {
    background-color: #f2f2f2;
  }

  .ex_tbl thead th:nth-child(1) {
    width: 30%;
    text-align: center;
  }

  .ex_tbl thead th:nth-child(2),
  .ex_tbl thead th:nth-child(3),
  .ex_tbl thead th:nth-child(4),
  .ex_tbl thead th:nth-child(5) {
    width: 10%;
    text-align: center;
  }

  .ex_tbl thead th:nth-child(6) {
    width: 5%;
    text-align: center;
  }

  .ex_tbl thead th:nth-child(7) {
    width: 7%;
    text-align: center;
  }

  .ex_tbl thead th:nth-child(8) {
    text-align: center;
  }

  .ex_tbl tbody tr:hover {
    background-color: #e0e0e0;
  }

  .ex_tbl a {
    margin-right: 5px;
    text-decoration: none;
  }

  .ex_tbl a:hover {
    text-decoration: underline;
  }

  .edit-link,
  .delete-link {
    margin-right: 5px;
    text-decoration: none;
    padding: 5px 10px;
    border-radius: 3px;
    font-weight: bold;
    color: white;
    margin-bottom: 5px;
  }

  .edit-link {
    background-color: green;
  }

  .edit-link:hover {
    background-color: #064706;
  }

  .delete-link {
    background-color: red;
  }

  .delete-link:hover {
    background-color: #520808;
  }


  .Second_content h1 {
    margin: 0;
    font-size: 24px;
  }

  .editmod_content_container {
    width: 20%;
  }

  .edtmod_con {
    margin-top: 5px;
    display: flex;
    flex-direction: row;
    align-items: center;
    text-align: center;
  }

  .edtmod_con h1 {
    margin-right: 5%;
    margin-left: 10%;
  }

  .round-button {
    display: inline-block;
    width: 40%;
    padding: 10px 20px;
    border: none;
    border-radius: 10px;
    background-color: #4CAF50;
    ;
    color: white;
    font-size: 15px;
    font-weight: bold;
    text-align: center;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 10px;
  }

  .round-button:hover {
    background-color: #2e6930;
    ;
  }

  /* CSS for the search container */
  .search-container {
    margin: 1% 1% 5px;
    display: flex;
    align-items: center;
  }

  /* CSS for the input field */
  .search-container input[type="text"] {
    padding: 10px;
    border: 2px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    width: 300px;
    outline: none;
  }

  /* CSS for the search button */
  .search-container button[type="submit"] {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: #f2eb5c;
    color: black;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .search-container button[type="submit"]:hover {
    background-color: #545220;
    color: white;
  }

  .Add_question {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: #4CAF50;
    color: #fff;
    font-size: 17px;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .Add_question:hover {
    background-color: #2e6930;
  }

  .center-text {
    text-align: center;
    font-size: 35px;
  }


  /* CSS for Module */
  .featured_courses_services {
    display: block;
    padding: 30px;
    margin-top: 1.5%;
    width: 100%;
    height: 700px;
    /* Set a specific height for the slideshow */

  }

  .featured_courses_services h2 {
    color: green;
    font-size: 40px;
    height: 20px;
  }

  .box_container {
    text-align: center;
    margin: 0 auto;
    display: flex;
    height: 70%;
    width: 100%;
  }

  .Modules {
    margin: auto;
    width: 100%;
    height: 80%;
    padding: 1%;
    border-radius: 3px;
    box-shadow: 2px 7px 8px rgba(0, 0, 0, 0.2);
    /* Adding shadow to the nav_bar */
    column-gap: 1%;
  }

  .Modules:hover {
    background-color: rgba(87, 138, 93, .2);
  }

  .Modules .img_container {
    text-align: center;
  }

  .Modules img {
    max-width: 70%;
    max-height: 40%;
    border-radius: 3px;
  }

  .Modules h4 {
    margin: 10px 0;
    font-size: 18px;
    color: green;
  }

  .Modules p {
    margin: 5px 0;
    font-size: 16px;
  }

  .enroll-section {
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .enroll-button {
    display: block;
    margin: 10px 10px 10px 0;
    padding: 8px 16px;
    background-color: green;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 20px;
    border-radius: 10px;
    text-decoration: none;
  }

  .enroll-button:hover {
    background-color: #173d19;
  }

  .starts-at {
    font-size: 18px;
    color: black;
  }

  button {
    border: none;
  }.container {
            width: 95%;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 1%;
            margin-bottom: 2%;
        }
        header {
            background-color: green;
            color: #fff;
            padding: 20px;
            text-align: center;
        }


input[type="file"]{
        width: 100%;
        padding: 12px;
        margin-bottom: 12px;
        box-sizing: border-box;
        border: 1px solid #4CAF50; /* Green border color */
        border-radius: 4px; /* Rounded corners */
        background-color: #f8f8f8; /* Light gray background color */
        transition: border-color 0.3s ease, background-color 0.3s ease; /* Transition effect on hover */
    }

    /* Hover effect */
input[type="file"]:hover{
        border-color: #45a049; /* Darker green border color on hover */
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
      <div class="container">
       <header><h2>EDIT EXAM</h2></header> <br>
      <div class="search-container">
        <form method="POST" action=" ">
          <input type="text" name="search" placeholder="Search by Question, Module.">
          <button type="submit">Search</button>
          <a class="Add_question" onclick="openAddModal()">Add</a>
        </form>
      </div>


      <div class="ex_tbl">
        <table>
          <thead>
            <tr>
              <th>Question</th>
              <th>Ans1</th>
              <th>Ans2</th>
              <th>Ans3</th>
              <th>Ans4</th>
              <th>Correct Answer</th>
              <th>Topic</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Connect to the database
            $servername = "localhost";
            $username = "u896821908_bts";
            $password = "a*5E4UEhsHa]";
            $dbname = "u896821908_bts";

            // Create a connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check the connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }

            if (isset($_POST['search'])) {
              $search_term = $_POST['search'];
              // Fetch data from the "student" table based on the search term
              $sql = "SELECT * FROM u896821908_bts.questions
                        WHERE question LIKE '%$search_term%' OR qid LIKE '%$search_term%' OR topic LIKE '%$search_term%'";
            } else {
              // Fetch data from the "student" table without any filter
              $sql = "SELECT * FROM u896821908_bts.questions";
            }
            $result = $conn->query($sql);

            if (mysqli_num_rows($result) == 0) {
              echo "<tr><td colspan='8' class='center-text'>No data found.</td></tr>";
            } else {
              while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["question"] . "</td>";
                echo "<td>" . $row["ans1"] . "</td>";
                echo "<td>" . $row["ans2"] . "</td>";
                echo "<td>" . $row["ans3"] . "</td>";
                echo "<td>" . $row["ans4"] . "</td>";
                echo "<td><center>" . $row["correct_answer"] . "</center></td>";
                echo "<td>" . $row["topic"] . "</td>";
                echo "<td>";
                echo "<center>
                <button class='edit-link' onclick='openEditModal(\"" . $row['qid'] . "\")'><i class='fas fa-edit'></i></button>";
                echo "<button class='delete-link' onclick='openDeleteModal(" . $row['qid'] . ")'><i class='fas fa-trash-alt'></i></button>";
                echo "</td>";
                echo "</tr>";
              }
            }

            // Close the connection
            ?>
          </tbody>
        </table>
      </div>
      </div>
      
      <!-- MODULE PART -->

  <div class="container">
        
        <div class="third_content">
        <div class = "Content_search">
      <header><h2>PDC QUESTIONS </h2></header><br>

      <div class="search-container">
        <form method="POST" action=" ">
          <input type="text" name="searchPDCQuestion" placeholder="Search by Title, Desciption.">
          <button type="submit">Search</button>
          <a class="Add_question" onclick="addModalPDCQ()">Add</a>
        </form>
       </div>

       <div class = "pdc_question_table">
        <table>
          <thead>
            <tr>
              <th>Title</th>
              <th>Desciption</th>
              <th>Session</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
               if (isset($_POST['searchPDCQuestion'])) {
                $search_term = $_POST['searchPDCQuestion'];
                $sqlpdcQuestion = "SELECT * FROM u896821908_bts.pdc_questions
                          WHERE desciption LIKE '%$search_term%' OR ques_id LIKE '%$search_term%' OR q_title LIKE '%$search_term%'";
              } else {
                $sqlpdcQuestion = "SELECT * FROM u896821908_bts.pdc_questions;";
              }      
                $resultPDCQuestion = $conn->query($sqlpdcQuestion);
    
                if (mysqli_num_rows($resultPDCQuestion) == 0) {
                  echo "<tr><td colspan='8' class='center-text'>No data found.</td></tr>";
                } else {
                  while ($rowPDCQuestion = $resultPDCQuestion->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $rowPDCQuestion["q_title"] . "</td>";
                    echo "<td>" . $rowPDCQuestion["desciption"] . "</td>";
                    echo "<td>" . $rowPDCQuestion["session"] . "</td>";

                    echo "<td>";
                    echo "<center><button class='edit-link' onclick='openEditModalPDCQUESTION(\"" . $rowPDCQuestion['ques_id'] . "\")'><i class='fas fa-edit'></i></button>";
                    echo "<button class='delete-link' onclick='openDeleteModalPDCQUESTION(" . $rowPDCQuestion['ques_id'] . ")'><i class='fas fa-trash-alt'></i></button>";
                    echo "</td>";
                    echo "</tr>";
                  }
                }
                
                error_reporting(E_ALL);
ini_set('display_errors', 1);

                $conn->close();

            ?>
          </tbody>
        </table>
        </div>
        </div>
    </div>
      </div>
<!-- MODULE PART  -->
      <div class="Second_content">
        <div class="featured_courses_services">
          <h2>Featured courses</h2>
          <div class="box_container">
            <div class="Modules">
              <div class="img_container">
                <img src="..\img\drive-download-20230614T125330Z-001\exam1.png" alt="tdc Image">

              </div>
              <h4>Module Number 1</h4>
              <p>Details of the modules</p>
              <div class="enroll-section">
                <button class="enroll-button" id="Enrollbtn1">Edit</button>
                <a href="../uploads/pdf_modules/<?php echo basename($pdfName1); ?>" target="_blank" style="text-decoration: none;">
                <button class="enroll-button" id="EnrollbtnV1">View</button>
                </a>
              </div>
            </div>

            <div class="Modules">
              <div class="img_container">
                <img src="..\img\drive-download-20230614T125330Z-001\exam2.png" alt="pdc_mc Image">
              </div>
              <h4>Module Number 2</h4>
              <p>Details of the module</p>
              <div class="enroll-section">
                <button class="enroll-button" id="Enrollbtn2">Edit</button>
               <a href="../uploads/pdf_modules/<?php echo $pdfName2; ?>" target="_blank" style="text-decoration: none;">
                  <button class="enroll-button" id="EnrollbtnV2">View</button>
                </a>

              </div>
            </div>

            <div class="Modules">
              <div class="img_container">
                <img src="..\img\drive-download-20230614T125330Z-001\exam3.png" alt="pdc_c Image">
              </div>
              <h4>Module Number 3</h4>
              <p>Details of the Module</p>
              <div class="enroll-section">
                <button class="enroll-button" id="Enrollbtn3">Edit</button>
                <a href="../uploads/pdf_modules/<?php echo $pdfName3; ?>" target="_blank" style="text-decoration: none;">
                  <button class="enroll-button" id="EnrollbtnV3">View</button>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>  


  </div>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    function data_success() {
      // Your JavaScript function logic here
      alert("Data is successfuly Updated!");

      // Reset the URL to the original state (without "success") after 2 seconds
      setTimeout(function() {
        history.replaceState({}, document.title, window.location.pathname);
      }, 1);
    }

    function data_failed() {
      // Your JavaScript function logic here
      alert("Failed to update the data.");

      // Reset the URL to the original state (without "success") after 2 seconds
      setTimeout(function() {
        history.replaceState({}, document.title, window.location.pathname);
      }, 1);
    }

    function data_deleted() {
      // Your JavaScript function logic here
      alert("Data Deleted");

      // Reset the URL to the original state (without "success") after 2 seconds
      setTimeout(function() {
        history.replaceState({}, document.title, window.location.pathname);
      }, 1);
    }

    function data_added() {
      // Your JavaScript function logic here
      alert("Data is successfuly Added");

      // Reset the URL to the original state (without "success") after 2 seconds
      setTimeout(function() {
        history.replaceState({}, document.title, window.location.pathname);
      }, 1);
    }

    function data_Notadded() {
      // Your JavaScript function logic here
      alert("Failed to add the data.");

      // Reset the URL to the original state (without "success") after 2 seconds
      setTimeout(function() {
        history.replaceState({}, document.title, window.location.pathname);
      }, 1);
    }
    // Check if the URL contains "success" and trigger the function
    if (window.location.href.indexOf("updated") !== -1) {
      data_success();
    } else if (window.location.href.indexOf("!updated") !== -1) {
      data_failed();
    } else if (window.location.href.indexOf("deleted") !== -1) {
      data_deleted();
    } else if (window.location.href.indexOf("added") !== -1) {
      data_added();
    } else if (window.location.href.indexOf("!added") !== -1) {
      data_Notadded();
    }

    if (window.location.href.indexOf("updatingQ") !== -1) {
      data_success();
    } else if (window.location.href.indexOf("!updatingQ") !== -1) {
      data_failed();
    } else if (window.location.href.indexOf("delQ") !== -1) {
      data_deleted();
    } else if (window.location.href.indexOf("addQ") !== -1) {
      data_added();
    } else if (window.location.href.indexOf("!addQ") !== -1) {
      data_Notadded();
    }



  </script>

  <script>
    function openDeleteModal(qid) {
      var confirmation = confirm("Are you sure you want to delete this item?");
      if (confirmation) {
        window.location.href = "delete_question.php?id=" + qid;
      }
    }

    function openDeleteModalPDCQUESTION(ques_id) {
      var confirmation = confirm("Are you sure you want to delete this item?");
      if (confirmation) {
        window.location.href = "delete_question.php?Pdcid=" + ques_id;
      }
    }
  </script>

  <script>
    //EDIT QUESTION EXAM     //EDIT QUESTION EXAM     //EDIT QUESTION EXAM     //EDIT QUESTION EXAM     //EDIT QUESTION EXAM     //EDIT QUESTION EXAM     //EDIT QUESTION EXAM     //EDIT QUESTION EXAM


    function openEditModal(qid) {
      // Create a new XMLHttpRequest object
      var xhttp = new XMLHttpRequest();

      // Define the function to be executed when the request completes
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          // Insert the modal content into the 'modalContent' div
          document.getElementById("modalContent").innerHTML = this.responseText;
          // Display the modal
          document.getElementById('editModal').style.display = 'block';
        }
      };

      // Send a GET request to the edit_question.php file and pass the 'id' parameter
      xhttp.open("GET", "edit_question.php?id=" + qid, true);
      xhttp.send();
    }
    //EDIT QUESTION EXAM     //EDIT QUESTION EXAM    //EDIT QUESTION EXAM     //EDIT QUESTION EXAM    //EDIT QUESTION EXAM     //EDIT QUESTION EXAM    //EDIT QUESTION EXAM     //EDIT QUESTION EXAM

    //EDIT PDCQUESTION EXAM     //EDIT PDCQUESTION EXAM    //EDIT PDCQUESTION EXAM     //EDIT PDCQUESTION EXAM    //EDIT PDCQUESTION EXAM     //EDIT QUESTION EXAM 

    function openEditModalPDCQUESTION(ques_id) {
      // Create a new XMLHttpRequest object
      var xhttp = new XMLHttpRequest();

      // Define the function to be executed when the request completes
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          // Insert the modal content into the 'modalContent' div
          document.getElementById("modalContentPDCQUESTION").innerHTML = this.responseText;
          // Display the modal
          document.getElementById('editModalPDCQUESTION').style.display = 'block';
        }
      };

      // Send a GET request to the edit_question.php file and pass the 'id' parameter
      xhttp.open("GET", "edit_question.php?Pdcid=" + ques_id, true);
      xhttp.send();
    }

    //EDIT PDCQUESTION EXAM     //EDIT PDCQUESTION EXAM    //EDIT PDCQUESTION EXAM     //EDIT PDCQUESTION EXAM    //EDIT PDCQUESTION EXAM     //EDIT PDCQUESTION EXAM


    // Close the modal
    function closeModal() {
      document.getElementById('editModal').style.display = 'none';
    }

     // Close the modal
     function closeModalPDCQUESTION() {
      document.getElementById('editModalPDCQUESTION').style.display = 'none';
    }

    // Close the modal when clicking outside the modal content
    window.onclick = function(event) {
      var modal = document.getElementById('editModal');
      var modalPDC = document.getElementById('editModalPDCQUESTION');

      if (event.target === modal) {
        closeModal();
      }
      if (event.target === modalPDC) {
        closeModalPDCQUESTION();
      }
    };
  </script>

  <script>
    // Function to confirm the update
    function confirmUpdate() {
      var confirmation = confirm("Are you sure you want to update?");
      if (confirmation) {
        // If user clicks OK, submit the form
        document.querySelector('form').submit();
      }
    }

    function confirmUpdatePDCQ() {
      var confirmationPDCQ = confirm("Are you sure you want to update?");
      if (confirmationPDCQ) {
        // If user clicks OK, submit the form
        document.getElementById('PDCQ').submit();
      }
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




  <?php
  // Include the modal content
  include 'edit_modal_content.php';
  include 'add_modal.php';
  include 'add_modalPDCQ.php';
  include "../Admin/php_scripts/admin_module_exam_modals.php"

  ?>


</body>

</html>