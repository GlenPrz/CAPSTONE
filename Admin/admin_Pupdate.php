<?php
session_start();
include "../conn.php";
include "../Admin/php_scripts/Admin_PupdateImage.php";

if (empty($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

try {

    $query = "SELECT * FROM u896821908_bts.newupdate;";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
//     // Check if an image was uploaded
//     if (isset($_FILES["img1"]) && $_FILES["img1"]["error"] === UPLOAD_ERR_OK) {
//         try {
//             // Move the uploaded image file to the desired location using the original filename
//             $destinationDir = "../img/drive-download-20230614T125330Z-001/";
//             $destinationPath = $destinationDir . $_FILES["img1"]["name"];

//             if (move_uploaded_file($_FILES["img1"]["tmp_name"], $destinationPath)) {
//                 // Update the image path in the database
//                 $imagePath = $destinationPath;

//                 // Update the image data in the database
//                 $sql_update = "UPDATE newupdate SET PICTURE = :imageData WHERE idNewUpdate = 1";
//                 $stmt_update = $conn->prepare($sql_update);
//                 $stmt_update->bindParam(':imageData', $imagePath, PDO::PARAM_LOB);
//                 $stmt_update->execute();
//             } else {
//                 echo "Error moving uploaded image.";
//             }

//             // Display image details in JavaScript console
//             echo '<script>';
//             echo 'console.log("Uploaded Image Details:");';
//             echo 'console.log("Name: ' . $_FILES["img1"]["name"] . '");';
//             echo 'console.log("Type: ' . $_FILES["img1"]["type"] . '");';
//             echo 'console.log("Size: ' . $_FILES["img1"]["size"] . ' bytes");';
//             echo '</script>';
//         } catch (PDOException $e) {
//             echo 'Error: ' . $e->getMessage();
//         }
//     } else {
//         // No file uploaded or file input empty
//         echo "No file uploaded.";
//     }
// } else {
//     // Set default photo path
//     $defaultPhotoPath = "/img/drive-download-20230614T125330Z-001/LOGIN PAGE.png";
    
//     try {
//         // Update the default image path in the database
//         $sql_update_default = "UPDATE newupdate SET PICTURE = :defaultPhotoPath WHERE idNewUpdate = 1";
//         $stmt_update_default = $conn->prepare($sql_update_default);
//         $stmt_update_default->bindParam(':defaultPhotoPath', $defaultPhotoPath, PDO::PARAM_STR);
//         $stmt_update_default->execute();
//     } catch (PDOException $e) {
//         echo 'Error updating default photo path: ' . $e->getMessage();
//     }
// }



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Updates</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
    <link href="admin_styles/admin_nav.css" rel="stylesheet">
    <link href="../Admin/admin_styles/admin_Pupdate.css" rel="stylesheet">
    <link href="../Admin/admin_styles/edit_modal.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


</head>

<style>
#sms_sending:disabled {
    background-color: grey;
    color: white;
    cursor: not-allowed;
}

#sms_sending:enabled {
    background-color: green;
    color: white;
    cursor: pointer;
}



/* Modal styles */
#Add_general_information {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgb(0,0,0);
  background-color: rgba(0,0,0,0.4);
  padding-top: 60px;
}

#Add_general_information .modal-content {
  background-color: #fefefe;
  margin: 5% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

#Add_general_information .close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

#Add_general_information .close:hover,
#Add_general_information .close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}




    .result {
    width: 100%;
    height: 300px;
    border-collapse: collapse;
    overflow-y: scroll;
    overflow-x: hidden;
    display: flex;
    }

    .contenttwo {
        width: 100%;
    }
table {
   overflow-x: auto;
        overflow-y: scroll;
        width: 100%;
  }

  th,td {
    padding: 10px;
    text-align: left;
    border: none;
    font-size: 16px;
    
  }th{
    background-color: #f2f2f2;
  }

  tr:hover {
    background-color: #f2f2f2;
  }

  .result thead th:nth-child(1) {
    width: 100%;
    text-align: center;
  }

  .result thead th:nth-child(2),
  .result thead th:nth-child(3),
  .result thead th:nth-child(4),
  .result thead th:nth-child(5) {
    width: 100%;
    text-align: center;
  }

  .result thead th:nth-child(6) {
    width: 100%;
    text-align: center;
  }

  .result thead th:nth-child(7) {
    width: 100%;
    text-align: center;
  }

  .result thead th:nth-child(8) {
    text-align: center;
  }

  .result tbody tr:hover {
    background-color: #e0e0e0;
  }

  .result a {
    margin-right: 5px;
    text-decoration: none;
  }

  .result a:hover {
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
    border: none;
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
   .contact_tbl {
        width: 100%; /* Set your desired width */
        height: 200px; /* Set your desired height */
        overflow-x: auto; /* Add vertical scrollbar */
        font-size: 10px;
    }
    .contact_tbl td:nth-child(1){
        width:5%;
    }.contact_tbl td:nth-child(1){
        width:5%;
        text-align:center;
    }
    
    .Add_btn {
    padding: 5px 20px;
    border: none;
    border-radius: 5px;
    background-color: #4CAF50;
    color: black;
    font-size: 17px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .Add_btn:hover {
    background-color: #2e6930;
    color: #fff;
  }
  .reset_search {
    padding: 5px 20px;
    border: none;
    border-radius: 5px;
    background-color: #edd33e;
    color: black;
    font-size: 17px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .reset_search:hover {
    background-color: #61571b;
    color: #fff;
  }
  
  .search_btn {
    padding: 5px 20px;
    border: none;
    border-radius: 5px;
    background-color: #4099ed;
    color: black;
    font-size: 17px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .search_btn:hover {
    background-color: #1a3a59;
    color: #fff;
  }
  /* Style for the modal */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0, 0, 0); /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
    }

    /* Style for modal content */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* 15% from the top and centered */
        padding: 30px;
        border: 1px solid #888;
        width: 30%; /* Could be more or less, depending on screen size */
    }

    /* Close button style */
    .close {
        color: #aaa;
        margin: 5% 35% 0 0;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
    
    .apply:hover{
        background-color: #155e17;
    }
    .cancelbtn:hover{
        background-color: #690500;
    }
    .cancel-button:hover{
        background-color: darkred;
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
        <header>
          <h2>COMPOSE MESSAGE</h2>
        </header>
        <!-- sms -->
        <div class="CPost_Container">
          <form method="POST" id="studentForm">
            <div class="CPost_MainBody">
              <div>
                <?php
						try {
							$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$query = "SELECT student.*,
							 email_sms_history.Message_purpose,
       email_sms_history.Message_body,
       email_sms_history.Date_sent AS Max_Date_sent 
FROM student 
LEFT JOIN email_sms_history 
ON student.idStudent = email_sms_history.Std_Id 
   AND email_sms_history.Date_sent = (
       SELECT MAX(Date_sent) 
       FROM email_sms_history 
       WHERE Std_Id = student.idStudent
   )

GROUP BY student.idStudent;
;
";
							$date1 = 0;
							$date2 = 0;
              $selectedContacts = [];



							if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
								$selected = $_POST['sql_filter'];
								$date1 = $_POST['from_date'];
								$date2 = $_POST['to_date'];
                                $istrue = false;
                                
								if ($selected === '1') {
									if(!empty($date1) && !empty($date2)){
									$query = "SELECT student.*, 
       email_sms_history.Date_sent AS Max_Date_sent 
FROM student 
LEFT JOIN email_sms_history 
ON student.idStudent = email_sms_history.Std_Id 
   AND email_sms_history.Date_sent = (
       SELECT MAX(Date_sent) 
       FROM email_sms_history 
       WHERE Std_Id = student.idStudent
   )

Where student.DateOfEnrolled BETWEEN '$date1' AND '$date2'
GROUP BY student.idStudent;
'";
									}else{
$query = "SELECT student.*, 
       email_sms_history.Date_sent AS Max_Date_sent 
FROM student 
LEFT JOIN email_sms_history 
ON student.idStudent = email_sms_history.Std_Id 
   AND email_sms_history.Date_sent = (
       SELECT MAX(Date_sent) 
       FROM email_sms_history 
       WHERE Std_Id = student.idStudent
   )

GROUP BY student.idStudent;
";									}
								} else if ($selected === '2') {
									if(!empty($date1) && !empty($date2)){
									$query = "SELECT student.*, 
       email_sms_history.Date_sent AS Max_Date_sent 
FROM student 
LEFT JOIN email_sms_history 
ON student.idStudent = email_sms_history.Std_Id 
   AND email_sms_history.Date_sent = (
       SELECT MAX(Date_sent) 
       FROM email_sms_history 
       WHERE Std_Id = student.idStudent
   )
WHERE student.DateOfEnrolled BETWEEN '$date1' AND '$date2'
AND student.balance <> 0
GROUP BY student.idStudent;
';
'";
                  $tempmsg = "Dear Student,we've noticed an outstanding balance on your account at Best Training School. Please settle it promptly to avoid any interruptions in your learning. For questions, contact us at besttrainingschool101@gmail.com. Thank you.";
									}else{
									$query = "SELECT student.*, 
       email_sms_history.Date_sent AS Max_Date_sent 
FROM student 
LEFT JOIN email_sms_history 
ON student.idStudent = email_sms_history.Std_Id 
   AND email_sms_history.Date_sent = (
       SELECT MAX(Date_sent) 
       FROM email_sms_history 
       WHERE Std_Id = student.idStudent
   )
WHERE student.balance <> 0
GROUP BY student.idStudent;

";

                  $tempmsg = "Dear Student,we've noticed an outstanding balance on your account at Best Training School. Please settle it promptly to avoid any interruptions in your learning. For questions, contact us at besttrainingschool101@gmail.com. Thank you.";

									}

                  

								} else if ($selected === '3') {

									if(!empty($date1) && !empty($date2)){
									$query = "SELECT student.*, 
       email_sms_history.Date_sent AS Max_Date_sent 
FROM student 
LEFT JOIN email_sms_history 
ON student.idStudent = email_sms_history.Std_Id 
   AND email_sms_history.Date_sent = (
       SELECT MAX(Date_sent) 
       FROM email_sms_history 
       WHERE Std_Id = student.idStudent
   )
WHERE student.DateOfEnrolled BETWEEN '$date1' AND '$date2'
AND student.Enroll_Status LIKE 'pending'
GROUP BY student.idStudent;
;
";

                  $tempmsg = "Hello prospective student! We're excited to welcome you to BTS Driving School. Your enrollment is pending, and we're working diligently to finalize the process. Rest assured, you'll be hitting the road with us soon! If you have any concerns, feel free to get in touch. For questions, contact us at besttrainingschool101@gmail.com. Thank you.";

									}else{
									$query = "SELECT student.*, 
       email_sms_history.Date_sent AS Max_Date_sent 
FROM student 
LEFT JOIN email_sms_history 
ON student.idStudent = email_sms_history.Std_Id 
   AND email_sms_history.Date_sent = (
       SELECT MAX(Date_sent) 
       FROM email_sms_history 
       WHERE Std_Id = student.idStudent
   )
WHERE student.Enroll_Status LIKE 'pending'
GROUP BY student.idStudent;

";

                  $tempmsg = "Hello prospective student! We're excited to welcome you to BTS Driving School. Your enrollment is pending, and we're working diligently to finalize the process. Rest assured, you'll be hitting the road with us soon! If you have any concerns, feel free to get in touch. For questions, contact us at besttrainingschool101@gmail.com. Thank you.";

									}


								} else if ($selected === '4') {

									if(!empty($date1) && !empty($date2)){
									$query = "
									SELECT student.*, 
       email_sms_history.Date_sent AS Max_Date_sent 
FROM student 
LEFT JOIN email_sms_history 
ON student.idStudent = email_sms_history.Std_Id 
   AND email_sms_history.Date_sent = (
       SELECT MAX(Date_sent) 
       FROM email_sms_history 
       WHERE Std_Id = student.idStudent
   )
WHERE student.DateOfEnrolled BETWEEN '$date1' AND '$date2'
AND student.TDC IS NOT NULL 
GROUP BY student.idStudent;
";
								
                  $tempmsg = "Greetings, TDC student! Your dedication to learning with us is truly commendable. We're here to support you every step of the way. If you need any extra guidance or have questions about your TDC course, please don't hesitate to ask. Keep up the great work! For questions, contact us at besttrainingschool101@gmail.com. Thank you.";

                }else{
									$query = "SELECT student.*, 
       email_sms_history.Date_sent AS Max_Date_sent 
FROM student 
LEFT JOIN email_sms_history 
ON student.idStudent = email_sms_history.Std_Id 
   AND email_sms_history.Date_sent = (
       SELECT MAX(Date_sent) 
       FROM email_sms_history 
       WHERE Std_Id = student.idStudent
   )
WHERE student.TDC IS NOT NULL 
GROUP BY student.idStudent;
 
";

                  $tempmsg = "Greetings, TDC student! Your dedication to learning with us is truly commendable. We're here to support you every step of the way. If you need any extra guidance or have questions about your TDC course, please don't hesitate to ask. Keep up the great work! For questions, contact us at besttrainingschool101@gmail.com. Thank you.";

									}

                  
								} else if ($selected === '5') {
									if(!empty($date1) && !empty($date2)){
									$query = "SELECT student.*, 
       email_sms_history.Date_sent AS Max_Date_sent 
FROM student 
LEFT JOIN email_sms_history 
ON student.idStudent = email_sms_history.Std_Id 
   AND email_sms_history.Date_sent = (
       SELECT MAX(Date_sent) 
       FROM email_sms_history 
       WHERE Std_Id = student.idStudent
   )
WHERE student.DateOfEnrolled BETWEEN '$date1' AND '$date2'
AND (student.`PDC-MOTOR` IS NOT NULL OR student.`PDC-CAR` IS NOT NULL)
GROUP BY student.idStudent;
;
";
                  
                  $tempmsg = "Hello PDC student! Your commitment to improving your driving skills is inspiring. We believe in your potential to become a confident and responsible driver. Should you require any assistance or have specific goals in mind, feel free to share them with us. Wishing you a safe and enjoyable learning experience! For questions, contact us at besttrainingschool101@gmail.com. Thank you.";
	
                }else{
									$query = "SELECT student.*, 
       email_sms_history.Date_sent AS Max_Date_sent 
FROM student 
LEFT JOIN email_sms_history 
ON student.idStudent = email_sms_history.Std_Id 
   AND email_sms_history.Date_sent = (
       SELECT MAX(Date_sent) 
       FROM email_sms_history 
       WHERE Std_Id = student.idStudent
   )
WHERE (student.`PDC-MOTOR` IS NOT NULL OR student.`PDC-CAR` IS NOT NULL)
GROUP BY student.idStudent;
;
";

                  $tempmsg = "Hello PDC student! Your commitment to improving your driving skills is inspiring. We believe in your potential to become a confident and responsible driver. Should you require any assistance or have specific goals in mind, feel free to share them with us. Wishing you a safe and enjoyable learning experience! For questions, contact us at besttrainingschool101@gmail.com. Thank you.";

									}


								}
								else if ($selected === '6') {
                                    if(!empty($date1) && !empty($date2)){
                                        $query = "SELECT student.*, 
       email_sms_history.Date_sent AS Max_Date_sent 
FROM student 
LEFT JOIN email_sms_history 
ON student.idStudent = email_sms_history.Std_Id 
   AND email_sms_history.Date_sent = (
       SELECT MAX(Date_sent) 
       FROM email_sms_history 
       WHERE Std_Id = student.idStudent
   )
WHERE student.DateOfEnrolled BETWEEN '$date1' AND '$date2'
AND student.TDC_Cert_approve IS NOT NULL
GROUP BY student.idStudent;
;
";
                                         $tempmsg = "Dear BTS Driving School Students, Your feedback matters! Share your experience at BTS Driving School through our quick evaluation form: https://btsdrivingschool.website/BTS_EvaluationForm.php. Your input helps us enhance our programs. Thank you for being a part of our journey. Best regards, BTS Driving School Team.";
                                         $istrue = true;
                                        }else{
                                                    $query = "SELECT student.*, 
       email_sms_history.Date_sent AS Max_Date_sent 
FROM student 
LEFT JOIN email_sms_history 
ON student.idStudent = email_sms_history.Std_Id 
   AND email_sms_history.Date_sent = (
       SELECT MAX(Date_sent) 
       FROM email_sms_history 
       WHERE Std_Id = student.idStudent
   )
WHERE student.TDC_Cert_approve IS NOT NULL
GROUP BY student.idStudent;
;
";
                                          $istrue = true;    
                                         $tempmsg = "Dear BTS Driving School Students, Your feedback matters! Share your experience at BTS Driving School through our quick evaluation form: https://btsdrivingschool.website/BTS_EvaluationForm.php. Your input helps us enhance our programs. Thank you for being a part of our journey. Best regards, BTS Driving School Team.";
                                        }
                                }
                                else if ($selected === '7') {
                                    if(!empty($date1) && !empty($date2)){
             $query = "SELECT student.*, 
       email_sms_history.Date_sent AS Max_Date_sent 
FROM student 
LEFT JOIN email_sms_history 
ON student.idStudent = email_sms_history.Std_Id 
   AND email_sms_history.Date_sent = (
       SELECT MAX(Date_sent) 
       FROM email_sms_history 
       WHERE Std_Id = student.idStudent
   )
WHERE student.DateOfEnrolled BETWEEN '$date1' AND '$date2'
AND student.PDC_Cert_approve IS NOT NULL
GROUP BY student.idStudent;
;
";                                        
                                        
                                          $tempmsg = "Dear BTS Driving School Students, Your feedback matters! Share your experience at BTS Driving School through our quick evaluation form: https://btsdrivingschool.website/BTS_EvaluationForm.php. Your input helps us enhance our programs. Thank you for being a part of our journey. Best regards, BTS Driving School Team.";
                                         $istrue = true;
                                    }else{
 $query = "SELECT student.*, 
       email_sms_history.Date_sent AS Max_Date_sent 
FROM student 
LEFT JOIN email_sms_history 
ON student.idStudent = email_sms_history.Std_Id 
   AND email_sms_history.Date_sent = (
       SELECT MAX(Date_sent) 
       FROM email_sms_history 
       WHERE Std_Id = student.idStudent
   )
WHERE student.PDC_Cert_approve IS NOT NULL
GROUP BY student.idStudent;
;
";                                                  
                                           $tempmsg = "Dear BTS Driving School Students, Your feedback matters! Share your experience at BTS Driving School through our quick evaluation form: https://btsdrivingschool.website/BTS_EvaluationForm.php. Your input helps us enhance our programs. Thank you for being a part of our journey. Best regards, BTS Driving School Team.";
                                           
                                         $istrue = true;
                                        }
                                }
							}

							$sql = "$query";
							$stmt = $conn->query($sql);
						} catch (PDOException $e) {
							echo "Connection failed: " . $e->getMessage();
						}

						?>
                <div class="contact_tbl">
                    <div class="consearch">
                        <input type="text" id="searchbar" class="searchbar" placeholder="search">
                        <button type="submit" name="search" class="submit"><i class="fa fa-search"></i></button>
                    </div>
                  <table>
                    <tr>
                      <th>Select <center><input type="checkbox" id="SelectAll" name="checkbox"></center></th>
                      <th>Student Id</th>
                      <th>Name</th>
                      <th>Contact Number</th>
                      <th>Email</th>
                      <th>Date Sent</th>
                      <th>Message Purpose</th>
                      <th>View More</th>

                    </tr>

                    <?php
								// Loop through the query result and populate the table
								while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
									echo "<tr>";
echo "<td><input type='checkbox' class='checkbox' data-lastname='" . $row['Lastname'] . "' data-firstname='" . $row['Firstname'] . "' data-contact='" . $row['Contactnumber'] . "' data-email='" . $row['EmailAddress'] . "' data-student-id='" . $row['idStudent'] . "'></td>";

                                    echo "<td>" . $row['idStudent'] . "</td>";
									echo "<td>" . $row['Lastname'] . ", " . $row['Firstname'] . "</td>";
									echo "<td>" . $row['Contactnumber'] . "</td>";
									echo "<td>" . $row['EmailAddress'] . "</td>";
									echo "<td>" . $row['Max_Date_sent'] . "</td>";
									echo "<td>" . $row['Message_purpose'] . "</td>";
                                    echo '<td><a href="admin_reports.php?id=' . $row['idStudent'] . '"><i class="fas fa-eye"></i></a></td>';

									echo "</tr>";
								}
								?>
                  </table>
                </div>
                <div class="filter">
                  <select name="sql_filter" id="sql_filter" required>
                    <option value=1 selected>All Students</option>
                    <option value=2>With Balance</option>
                    <option value=3>Pending Enrollment</option>
                    <option value=4>TDC students</option>
                    <option value=5>PDC students</option>
                    <option value=6>TDC Certificated</option>
                    <option value=7>PDC Certificated</option>
                  </select>
                  
                  <label>From</label>
                  <input type="date" name="from_date"></input>
                  <label>to</label>
                  <input type="date" name="to_date"></input>
                  <button type="submit" name="submit" class="apply">Apply</button>
                </div>
              </div>
              </form>          <!-- ^ SMS SENT END FORM ^ -->


               <form id="sendsms">

        <input type="text" placeholder="contacts" class="stdnumber" name="ContactNumStd" id="ContactNumSTD"
            readonly><br>
        <input type="text" placeholder="Email Address" class="stdnumber" name="SelectedEmailAdd"
            id="SelectedEmailAdd" readonly>
            
<input type="hidden" placeholder="Std Id" class="stdnumber" name="SelectedStdID"
            id="SelectedStdId" readonly>
            
            <input type="hidden" placeholder="Std name" class="stdnumber" name="SelectedStdname"
            id="SelectedStdname" readonly>
            
             <input type="hidden" placeholder="MsgPurpose" class="stdnumber" name="MsgPurpose" id="MsgPurpose" readonly>

            
            
        <textarea name="message" cols="40" rows="5" placeholder="Please input your message" class="CPost_BDesc"
            id="textmessage" maxlength="1000"><?php echo htmlspecialchars($tempmsg ?? ''); ?></textarea>

        <div class="button_container">
            <center>
                <input type="submit" id="sms_sending" name="sendSms" class="apply" value="SEND" disabled>
                <button type="button" onclick="reloadPage()">CANCEL</button>
            </center>
        </div>
    </form>

            </div>
          
        </div>
</div>
            <div class="container">
                <header><h2>CREATE A POST</h2></header>
            <div class="CPost_Container">
                <form id="postForm">
                    <div class="CPost_MainBody">
                    <input type="hidden" placeholder="Topic Title" class="CPost_Ttopic" name="CreatePost" value="CreatePost">
                        <input type="text" placeholder="Topic Title" class="CPost_Ttopic" name="AdminPost_TopicTitle" id = "TopicTitle">
                        <textarea name="AdminPost_BodyDescription" cols="40" rows="5" placeholder="Body Description"
                            class="CPost_BDesc" id = "TextAreaAdmin" maxlength="1000"></textarea>
                        <div class="button_container">
                            <center>
                                <button type="submit" name="Publish_postInformation"
                                    value="Publish_postInformation">PUBLISH</button>
                                <button>RESET</button>
                            </center>
                        </div>
                    </div>
                </form>
            </div>
</div>
            <div class="container">
                <header><h2>UPDATE NEWS POSTER</h2></header><br>
            <div class="img_container">
                <div class="slideshow-container">
                    <?php foreach ($images as $key => $image): ?>
                    <div class="mySlides fade">
                        <div class="numbertext"><?php echo $key + 1; ?> / <?php echo count($images); ?></div>
                        <img src="../img/drive-download-20230614T125330Z-001/<?php echo basename($image['PICTURE']); ?>"
                            style="width:80%" data-id="<?php echo basename($image['PICTURE']); ?>"
                            data-count="<?php echo $key + 1; ?>">
                    </div>

                    <?php endforeach; ?>

                    <div>
                        <a class="prev" onclick="plusSlides(-1)">❮</a>
                        <a class="next" onclick="plusSlides(1)">❯</a>
                    </div>

                    <div class="dotters">
                        <?php foreach ($images as $key => $image): ?>
                        <span class="dot" onclick="currentSlide(<?php echo $key + 1; ?>)"></span>
                        <?php endforeach; ?>
                    </div>

                    <div class="btn_container">
                        <button id="Edit" class="Edit_btn" onclick="editButtonClick()">Edit</button>
                    </div>
                </div>
            </div>
            </div>
                         
    <div class="container">
                 <header><h2>UPDATE AVAILABLE COURSES</h2></header><br>    
                <table class="result">
                   
                    <tr>
                        <th>Course</th>
                        <th>Course Info</th>
                        <th>Transmission</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th></th>
                    </tr>
                        <?php
                         $CoursesTable = "SELECT * FROM u896821908_bts.course_enrolled;";
                         $CourseInformation = $conn->query($CoursesTable);
                         
                         if ($CourseInformation) {
                             if ($CourseInformation->rowCount() == 0) {
                                 echo "<tr><td colspan='6' class='center-text'>No data found.</td></tr>";
                             } else {
                                 while ($rowCourseInformation = $CourseInformation->fetch(PDO::FETCH_ASSOC)) {
                                     echo "<tr>";
                                     echo "<td>" . $rowCourseInformation["Course"] . "</td>";
                                     echo "<td>" . $rowCourseInformation["Course_info"] . "</td>";
                                     echo "<td>" . $rowCourseInformation["Vechile(Type)"] . "</td>";
                                     echo "<td>" . $rowCourseInformation["Info"] . "</td>";
                                     echo "<td>" . $rowCourseInformation["Price"] . "</td>";
                         
                                     echo "<td>";
                                     echo "<button class='edit-link' onclick='openEditModalCourseInformation(\"" . $rowCourseInformation['idCourse_Enrolled'] . "\")'><i class='fas fa-edit'>Edit</button>";
                                     echo "</td>";
                                     echo "</tr>";
                                 }
                             }
                         } else {
                             echo "Error: " . $conn->errorInfo();
                         }
                                    
                        ?>
                </table>
    </div>
 
 
    <!-- Add a modal for adding a new VOUCHER -->
    <div id="add_voucher_Modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closevoucherModal()">&times;</span>
            <h2>Add Voucher</h2><br>
            <form action='Vehicle_add_del.php?voucherAdd="add"' method='post' onsubmit="return validateVoucherForm()">
                <label for='voucher_code' style="display: block; margin-bottom: 8px;">Voucher Code:</label>
                <input type='text' name='voucher_code' required style="width: 100%; padding: 8px; margin-bottom: 12px; box-sizing: border-box;"><br>

                <label for='applied_for' style="display: block; margin-bottom: 8px;">Applied For:</label>
                <select name='applied_for' required style="width: 100%; padding: 8px; margin-bottom: 12px; box-sizing: border-box;">
                    <option value='' selected disabled hidden>Select Applied For</option>
                    <option value='TDC'>TDC</option>
                    <option value='PDC'>PDC</option>
                </select><br>
    
                <label for='slot' style="display: block; margin-bottom: 8px;">Slot:</label>
                <input type='number' name='slot' required min='1' max='100' style="width: 100%; padding: 8px; margin-bottom: 12px; box-sizing: border-box;"><br>
    
                <label for='discount' style="display: block; margin-bottom: 8px;">Discount (1% to 100%):</label>
                <input type='number' name='discount' required min='1' max='100' style="width: 100%; padding: 8px; margin-bottom: 12px; box-sizing: border-box;"><br>

                <div style="display:flex; justify-content: center;">
                    <button type='submit' class='proceed-button' style="padding: 10px; margin-right: 10px; cursor: pointer;">Add Voucher</button>
                    <button type='button' onclick="closevoucherModal()" class="cancel-button">Close</button>
                </div>
            </form>    
           
        </div>
    </div>

 
 
    <div class="container">
        <header>
            <h2>DISCOUNT VOUCHERS</h2>
        </header>
        <br>
        <!-- Add search bar and search button -->
        <div class="search-container">
            <input type="text" id="searchVoucherInput" placeholder="Search..." style="width:20%;" oninput="searchVoucher()">
            <button onclick="openAddVouchModal()" class="Add_btn">Add</button>
        </div>
        
        <div class="result">
        <table  id="voucherTable" style="width:100%;"> <!-- Add unique ID for the table -->
            <tr>
                <th style='display: none'>Voucher code</th>
                <th>Applied For</th>
                <th>Slot</th>
                <th>Discount</th>
                <th>Date Created</th>
                <th></th>
            </tr>
            <?php
            $voucherTable = "SELECT * FROM u896821908_bts.disc_voucher ORDER BY slot ASC;";
            $voucherData = $conn->query($voucherTable);

            if ($voucherData) {
                if ($voucherData->rowCount() == 0) {
                    echo "<tr><td colspan='4' class='center-text'>No data found.</td></tr>";
                } else {
                    while ($rowVoucher = $voucherData->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td style='display: none'>" . $rowVoucher["code"] . "</td>";
                        echo "<td>" . $rowVoucher["applied_for"] . "</td>";
                        echo "<td>" . $rowVoucher["slot"] . "</td>";
                        echo "<td>" . $rowVoucher["discount"] . "%</td>";
                        echo "<td>" . $rowVoucher["date_created"] . "</td>";
                        echo "<td>";
                        echo "<center>
                            <button class='edit-link' onclick='openEditModalvoucher(\"" . $rowVoucher['voucher_id'] . "\")'><i class='fas fa-edit'>Edit/View</i></button>";
                        echo "<button class='delete-link' onclick='openDeleteModalvoucher(" . $rowVoucher['voucher_id'] . ")'><i class='fas fa-trash-alt'></i></button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                }
            } else {
                echo "Error: " . $conn->errorInfo();
            }
            ?>
        </table>
        </div>
    </div>
    
    
    <!-- Add a modal for adding a new vehicle -->
        <div id="addModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeAddModal()">&times;</span>
                <h2>Add Vehicle</h2><br>
                <form action='Vehicle_add_del.php?vehicleAdd="add"' method='post'>
                    <label for='vehicle_type'>Vehicle Type:</label>
                    <select name='Type'>
                        <option value='' selected disabled hidden>Select a Type and Transmission</option>
                        <option value='Car(Manual)'>Car(Manual)</option>
                        <option value='Car(Automatic)'>Car(Automatic)</option>
                        <option value='Motorcyle(Manual)'>Motorcyle(Manual)</option>
                        <option value='Motorcyle(Automatic)'>Motorcyle(Automatic)</option>
                    </select><br>
                    
                    <label for='vehicle_brand'>Vehicle Brand:</label>
                    <input type='text' name='vehicle_brand' required><br>
                    
                    <label for='vehicle_model'>Vehicle Model:</label>
                    <input type='text' name='vehicle_model' required><br>
                   <div styl="display:flex;">
                   <button type='submit' class='proceed-button'>Add Vehicle</button>
                </form>    
                <button type='button' onclick="closeAddModal()" class="cancel-button">Close</button>
                </div>
            </div>
        </div>
        
        
   <div class="container">
        <header>
            <h2>UPDATE VEHICLE INFORMATION</h2>
        </header>
        <br>
        <!-- Add search bar and search button -->
            <div class="search-container">
            <input type="text" id="searchVehicleInput" placeholder="Search..." style="width:20%;" oninput="searchVehicle()">
            <button onclick="openAddModal()" class="Add_btn">Add</button>
        </div>
    
        <div class="result">
            <table id="vehicleTable" style="width:100%;">
            <tr>
                <th>Type</th>
                <th>Vehicle Brand Model</th>
                <th></th>
            </tr>
            <?php
            $vehicleTable = "SELECT * FROM u896821908_bts.vehicle_tbl;";
            $vehicleData = $conn->query($vehicleTable);
    
            if ($vehicleData) {
                if ($vehicleData->rowCount() == 0) {
                    echo "<tr><td colspan='3' class='center-text'>No data found.</td></tr>";
                } else {
                    while ($rowVehicle = $vehicleData->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $rowVehicle["Type"] . "</td>";
                        echo "<td>" . $rowVehicle["vehicle_brand_model"] . "</td>";
                        echo "<td>";
                        echo "<center>
                           <button class='edit-link' onclick='openEditModalvehicle(\"" . $rowVehicle['vhcl_id'] . "\")'><i class='fas fa-edit'>Edit</i></button>";
                        echo "<button class='delete-link' onclick='openDeleteModalvehicle(" . $rowVehicle['vhcl_id'] . ")'><i class='fas fa-trash-alt'></i></button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                }
            } else {
                echo "Error: " . $conn->errorInfo();
            }
            ?>
        </table>
        </div>
    </div>

    <div class="container">
        
        <!--Tinamad mag gawa ng add na maayos si JM-->
        
        
        <div id="Add_general_information" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <form id="addForm">
        <input type="hidden" id="hiddenValue" name="hiddenValue" value="true">

      <label for="titleID">Title:</label>
      <input type="text" id="titleID" name="title_information" required><br>
      <label for="descriptionID">Description:</label>
      <input type="text" id="descriptionID" name="description_information" required><br>
      <button type="submit">Add Record</button>
    </form>
  </div>
</div>
        
        
        
        
                 <header><h2>UPDATE INFORMATION</h2></header><br>    
                        <input type="text" id="search_Update_information" placeholder="Search..." style="width:20%;">
                            <button  class="Add_btn_General_information Add_btn">Add</button>

                <table class="result" id = "GeneralInfortable">
                   
                    <tr>
                        <th>Title</th>                   
                        <th>Description</th>
                       
                        <th></th>
                    </tr>
                        <?php
                         $info_Table = "SELECT * FROM u896821908_bts.info_tb;";
                         $Information_table = $conn->query($info_Table);
                         
                         if ($Information_table) {
                             if ($Information_table->rowCount() == 0) {
                                 echo "<tr><td colspan='6' class='center-text'>No data found.</td></tr>";
                             } else {
                                 while ($rowInformation_table = $Information_table->fetch(PDO::FETCH_ASSOC)) {
                                     echo "<tr>";
                                     echo "<td>" . $rowInformation_table["title"] . "</td>";
                                     echo "<td>" . $rowInformation_table["description"] . "</td>";                       
                                     echo "<td>";
                                     echo "<button class='edit-link' onclick='openEditModalInformation(\"" . $rowInformation_table['info_id'] . "\")'><i class='fas fa-edit'>Edit</button></i>";
                                     echo "<button class='delete-link' onclick='openDeleteInformation(" . $rowInformation_table['info_id'] . ")'><i class='fas fa-trash-alt'></i></button>";

                                     echo "</td>";
                                     echo "</tr>";
                                 }
                             }
                         } else {
                             echo "Error: " . $conn->errorInfo();
                         }
                                    
                        ?>
                </table>
    </div>

    
    <div class="container">
        
        <!--Tinamad mag gawa ng add na maayos si JM ng Emergency_Relationship-->
        
        
        <div id="Add_Emergency_Relationship" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <form id="addForm_Emergency_Relationship">
        <input type="hidden" id="hiddenValue" name="hiddenValue" value="true">
        
      <label for="Relationship_Std">Incase of Emergency Relationship:</label>
      <input type="text" id="Relationship_Std" name="RelationshipStd" required><br>
      <button type="submit">Add Record</button>
    </form>
  </div>
</div>
        
        
        
        
                 <header><h2>EMERGENCY CONTACT RELATIONSHIP</h2></header><br>    
                        <input type="text" id="search_Update_information" placeholder="Search..." style="width:20%;">
                            <button  class="Add_Contact_Relationship Add_btn">Add</button>

                <table class="" id = "General_Contact_Relationship">
                   
                    <tr>
                        <th>Title</th>                   

                        <th></th>
                    </tr>
                        <?php
                         $std_Emergency_Table = "SELECT * FROM u896821908_bts.std_emergency_relationship;";
                         $std_relationship_table = $conn->query($std_Emergency_Table);
                         
                         if ($std_relationship_table) {
                             if ($std_relationship_table->rowCount() == 0) {
                                 echo "<tr><td colspan='6' class='center-text'>No data found.</td></tr>";
                             } else {
                                 while ($rowstd_relationship_table = $std_relationship_table->fetch(PDO::FETCH_ASSOC)) {
                                     echo "<tr>";
                                     echo "<td>" . $rowstd_relationship_table["Relationship"] . "</td>";
                                     echo "<td>";
                                     echo "<button class='edit-link' onclick='openEditstd_relationship_table(\"" . $rowstd_relationship_table['idStd_Emergency_relationship'] . "\")'><i class='fas fa-edit'>Edit</button></i>";
                                     echo "<button class='delete-link' onclick='openstd_relationship_table(" . $rowstd_relationship_table['idStd_Emergency_relationship'] . ")'><i class='fas fa-trash-alt'></i></button>";

                                     echo "</td>";
                                     echo "</tr>";
                                 }
                             }
                         } else {
                             echo "Error: " . $conn->errorInfo();
                         }
                                    
                        ?>
                </table>
    </div>
    
    
    
    <div class="container">
                 <header><h2>UPDATE FEEDBACK QUESTION</h2></header><br>    
                <table >
                   
                    <tr>
                        <th>Question</th>                   
                        <th></th>
                    </tr>
                        <?php
                         $feedback_Table = "SELECT * FROM u896821908_bts.feedques_tb;";
                         $feedbackn_table = $conn->query($feedback_Table);
                         
                         if ($feedbackn_table) {
                             if ($feedbackn_table->rowCount() == 0) {
                                 echo "<tr><td colspan='6' class='center-text'>No data found.</td></tr>";
                             } else {
                                 while ($rowfeedbackn_table = $feedbackn_table->fetch(PDO::FETCH_ASSOC)) {
                                     echo "<tr>";
                                     echo "<td>" . $rowfeedbackn_table["Question"] . "</td>";
                                     echo "<td>";
                                     echo "<center><button class='edit-link' onclick='openEditModalFeedback(\"" . $rowfeedbackn_table['qID'] . "\")'><i class='fas fa-edit'>Edit</button></center>";
                                     echo "</td>";
                                     echo "</tr>";
                                 }
                             }
                         } else {
                             echo "Error: " . $conn->errorInfo();
                         }
                                    
                        ?>
                </table>
    </div>

    <div class="container">
                 <header><h2>UPDATE EVALUATION QUESTION</h2></header><br>    
                <div class="search-container">
        <input type="text" id="searchInput" placeholder="Search..." style="width:20%;">
        <button onclick="searchQuestions()" class="search_btn">Search</button>
        <button onclick="resetSearchques()" class="reset_search">Reset</button>
        <button onclick="openAddquesModal()" class="Add_btn">Add</button>
    </div>
    <table id="questionsTable">
                   
                    <tr>
                        <th>Question</th>                   
                        <th></th>
                    </tr>
                        <?php
                         $evalques_Table = "SELECT * FROM u896821908_bts.evalques_tb;";
                         $evalques_strm = $conn->query($evalques_Table);
                         
                         if ($evalques_strm) {
                             if ($evalques_strm->rowCount() == 0) {
                                 echo "<tr><td colspan='6' class='center-text'>No data found.</td></tr>";
                             } else {
                                 while ($rowevalques = $evalques_strm->fetch(PDO::FETCH_ASSOC)) {
                                     echo "<tr>";
                                     echo "<td>" . $rowevalques["question"] . "</td>";
                                     echo "<td>";
                                     echo "<center><button class='edit-link' onclick='openEditModalevalques(\"" . $rowevalques['eval_id'] . "\")'><i class='fas fa-edit'>Edit</button></center>";
                                     echo "</td>";
                                     echo "</tr>";
                                 }
                             }
                         } else {
                             echo "Error: " . $conn->errorInfo();
                         }
                         echo "<tr><td colspan='3' class='center-text' style='font-weight: 600; font-size:25px'>Newly Added Questions:</td></tr>";
                            $evalques = "SELECT * FROM u896821908_bts.Added_evalques_tb;";
                            $evalquesData = $conn->query($evalques);
                    
                            if ($evalquesData) {
                                if ($evalquesData->rowCount() == 0) {
                                    echo "<tr><td colspan='3' class='center-text'>No newly added questions.</td></tr>";
                                } else {
                                    while ($rowevalques = $evalquesData->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<tr>";
                                        echo "<td>" . $rowevalques["new_question"] . "</td>";
                                        echo "<td>";
                                        echo "<center>
                                           <button class='edit-link' onclick='openEditModalnewevalques(\"" . $rowevalques['new_evalques_id'] . "\")'><i class='fas fa-edit'>Edit</i></button>";
                                        echo "<button class='delete-link' onclick='openDeleteModalnewevalques(" . $rowevalques['new_evalques_id'] . ")'><i class='fas fa-trash-alt'></i></button>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                }
                            } else {
                                echo "Error: " . $conn->errorInfo();
                            }
                                    
                        ?>
                </table>
    </div>
     <!-- Add a modal for adding a new evaluation question -->
            <div id="addquesModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeAddquesModal()">&times;</span>
                    <h2>Add Evaluation Question</h2><br>
                    <form action='Vehicle_add_del.php?evalAdd="add"' method='post'>
                        <label for='Questiontitle'>Question:</label>
                        <input type='text' name='Questiontitle' >
                        <label for='QuestionEval'>Question:</label>
                       <textarea name='QuestionEval' rows='5' cols='70' style='resize: none;'></textarea>
            
                       <button type='submit' class='proceed-button'>Add Question</button>
                        <button type='button' onclick="closeAddquesModal()" class="cancel-button">Close</button>
                    </form>    
                   
                    </div>
                </div>
            </div>
</div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    function searchVoucher() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchVoucherInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("voucherTable");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows and hide those that don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0]; // Change the index based on the column you want to search
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

    function resetSearchVoucher() {
        document.getElementById("searchVoucherInput").value = "";
        searchVoucher(); // Call the search function to reset the table to its original state
    }


 // JavaScript functions for search and add functionality
    function searchQuestions() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("questionsTable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];

            if (td) {
                txtValue = td.textContent || td.innerText;

                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    function resetSearchques() {
        var input = document.getElementById("searchInput");
        input.value = ""; // Clear the search input

        var table = document.getElementById("questionsTable");
        var tr = table.getElementsByTagName("tr");

        for (var i = 0; i < tr.length; i++) {
            tr[i].style.display = ""; // Show all rows
        }
    }

      function openAddquesModal() {
        var modal = document.getElementById("addquesModal");
        modal.style.display = "block";
    }

    function closeAddquesModal() {
        var modal = document.getElementById("addquesModal");
        modal.style.display = "none";
    }

//SMS disabled no input

 const messageInput = document.getElementById('textmessage');
        const submitButton = document.getElementById('sms_sending');

        function reloadPage() {
            $('#studentForm')[0].reset();
                    $('#sendsms')[0].reset();
                     var textarea = document.getElementById("textmessage");
                    textarea.value = '';        }

        function validateForm() {
            const messageValue = messageInput.value.trim();

            if (messageValue.length > 0) {
                submitButton.removeAttribute('disabled');
            } else {
                submitButton.setAttribute('disabled', 'true');
            }
        }

        // Validate the form when input changes in the textarea
        messageInput.addEventListener('input', validateForm);
        messageInput.addEventListener('change', validateForm);
        window.addEventListener('load', validateForm);


        
        if (window.location.href.indexOf("updatedeval") !== -1) {
          data_success();
        } else if (window.location.href.indexOf("!updatedeval") !== -1) {
          data_failed();
        }
         if (window.location.href.indexOf("inserteval") !== -1) {
          insert_success();
        } else if (window.location.href.indexOf("!inserteval") !== -1) {
          insert_failed();
        }
        if (window.location.href.indexOf("deletedeval") !== -1) {
          delete_success();
        } else if (window.location.href.indexOf("!deletedeval") !== -1) {
          delete_failed();
        }
//SMS disabled no input



//CRUD for Update Information

//TABlE search for Update Information



function openDeleteInformation(info_id) {
    // Show a confirmation dialog before deleting the record
    var confirmDelete = confirm("Are you sure you want to delete this record?");
    
    if (confirmDelete) {
        // Perform AJAX request to delete record
        $.ajax({
            type: "POST",
            url: "../Admin/php_scripts/add_record_GeneralInformation.php",
            data: { info_id: info_id, hiddenValue: "delete" }, // Send info_id and hiddenValue to identify the record to be deleted
            success: function(data) {
                // Handle response, maybe update the table or show a success message
                console.log(data);
                                    alert("Record deleted successfully!");

                // Refresh the page after successful deletion
                location.reload(true);
            },
            error: function(error) {
                console.error("Error:", error);
            }
        });
    } else {
        // If user chooses not to delete, do nothing
    }
}





$(document).ready(function() {
    
    $("#search_Update_information").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#GeneralInfortable tr").filter(function() {
                $(this).toggle(
                    $(this).find("td:eq(0)").text().toLowerCase().indexOf(value) > -1 ||
                    $(this).find("td:eq(1)").text().toLowerCase().indexOf(value) > -1
                );
            });
        });
    
    
    
    
    // Get the modal
    var modal = $("#Add_general_information");

    // Get the form and input elements
    var addForm = $("#addForm");
    var titleInput = $("#titleID");
    var descriptionInput = $("#descriptionID");

    // Get the <span> element that closes the modal
    var span = $(".close");

    // Function to open the modal
    function openAddModalGeneralInformation() {
        titleInput.val(""); // Clear the title input field
        descriptionInput.val(""); // Clear the description input field
        modal.css("display", "block");
    }

    // When the user clicks on <span> (x), close the modal
    span.click(function() {
        modal.css("display", "none");
    });

    // When the user clicks outside of the modal, close it
    $(window).click(function(event) {
        if (event.target === modal[0]) {
            modal.css("display", "none");
        }
    });

    // Add Record Form Submission
  addForm.submit(function(event) {
    event.preventDefault();
    var title = titleInput.val();
    var description = descriptionInput.val();

    // Show confirmation dialog before inserting the record
    var confirmInsert = confirm("Do you want to insert this record?");
    if (confirmInsert) {
        // Perform AJAX request to add record
        $.ajax({
            type: "POST",
            url: "../Admin/php_scripts/add_record_GeneralInformation.php",
            data: { title: title, description: description, hiddenValue: true}, // Send data as key-value pairs
            success: function(data) {
                // Handle response, maybe update the table or show a success message
                console.log(data);
                                    alert("Record successfully added!");

                modal.css("display", "none"); // Close the modal after adding the record
                // Refresh the page after successful insertion
                location.reload(true);
            },
            error: function(error) {
                console.error("Error:", error);
            }
        });
    } else {
        // If user chooses not to insert, do nothing
    }
});


    // Function to open the modal when the Add button is clicked
    $(".Add_btn_General_information").click(function() {
        openAddModalGeneralInformation();
    });
});

//CRUD for Update Information


//CRUD for Relation Ship Information

function openstd_relationship_table(std_relationship_id) {
    // Show a confirmation dialog before deleting the record
    var confirmDelete = confirm("Are you sure you want to delete this record?");
    
    if (confirmDelete) {
        // Perform AJAX request to delete record
        $.ajax({
            type: "POST",
            url: "../Admin/php_scripts/add_record_EmergencyRelationship.php",
            data: { idStd_Emergency_relationship: std_relationship_id, hiddenValue: "delete" }, // Send info_id and hiddenValue to identify the record to be deleted
            success: function(data) {
                // Handle response, maybe update the table or show a success message
                console.log(data);
                                    alert("Record deleted successfully!");

                // Refresh the page after successful deletion
                location.reload(true);
            },
            error: function(error) {
                console.error("Error:", error);
            }
        });
    } else {
        // If user chooses not to delete, do nothing
    }
}





$(document).ready(function() {
    var modalEmergency = $("#Add_Emergency_Relationship");
    var addFormEmergency = $("#addForm_Emergency_Relationship");
    var relationshipInput = $("#Relationship_Std");
    var spanEmergency = $(".close");

    function openAddModalEmergencyRelationship() {
        relationshipInput.val("");
        modalEmergency.css("display", "block");
    }

    spanEmergency.click(function() {
        modalEmergency.css("display", "none");
    });

    $(window).click(function(event) {
        if (event.target === modalEmergency[0]) {
            modalEmergency.css("display", "none");
        }
    });

    addFormEmergency.submit(function(event) {
        event.preventDefault();
        var relationship = relationshipInput.val();
        var confirmInsertEmergency = confirm("Do you want to insert this record for Emergency Contact Relationship?");
        if (confirmInsertEmergency) {
            $.ajax({
                type: "POST",
                url: "../Admin/php_scripts/add_record_EmergencyRelationship.php",
                data: { relationship: relationship, hiddenValue: true },
                success: function(data) {
                    console.log(data);
                    alert("Record for Emergency Contact Relationship successfully added!");
                    modalEmergency.css("display", "none");
                    location.reload(true);
                },
                error: function(error) {
                    console.error("Error:", error);
                }
            });
        }
    });

    $(".Add_Contact_Relationship").click(function() {
        openAddModalEmergencyRelationship();
    });
});


<!-- Search user composed message -->
$(document).ready(function() {
    $('#SelectAll').change(function() {
        // If it's checked, check all the individual checkboxes for visible rows
        if ($(this).prop('checked')) {
            $('table tr:not(:first):visible .checkbox').prop('checked', true);
        } else {
            // If it's unchecked, uncheck all the individual checkboxes
            $('.checkbox').prop('checked', false);
        }
    });

    $('#searchbar').on('input', function() {
        var searchText = $(this).val().toLowerCase(); // Get the search text in lowercase
        // Loop through each table row excluding the first row (header row)
        $('table tr:not(:first)').each(function() {
            var lastName = $(this).find('td:eq(1)').text().toLowerCase(); // Get Lastname column text
            var contactNumber = $(this).find('td:eq(2)').text().toLowerCase(); // Get Contact Number column text
            var emailAddress = $(this).find('td:eq(3)').text().toLowerCase(); // Get Email Address column text
            // Check if any of the columns contain the search text
            if (lastName.includes(searchText) || contactNumber.includes(searchText) || emailAddress.includes(searchText)) {
                $(this).show(); // If yes, display the row
            } else {
                $(this).hide(); // If not, hide the row
            }
        });

        // Uncheck "Select All" checkbox when filtering
        $('#SelectAll').prop('checked', false);
    });
});







<!-- Search user composed message -->

function searchVehicle() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchVehicleInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("vehicleTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows and hide those that don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0]; // Change the index based on the column you want to search
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    function resetSearchVehicle() {
        document.getElementById("searchVehicleInput").value = "";
        searchVehicle(); // Call the search function to reset the table to its original state
    }
    

    function resetSearch() {
        var input = document.getElementById("searchVehicleInput");
        input.value = ""; // Clear the search input

        var table = document.getElementById("vehicleTable");
        var tr = table.getElementsByTagName("tr");

        for (var i = 0; i < tr.length; i++) {
            tr[i].style.display = ""; // Show all rows
        }
    }

      function openAddModal() {
        var modal = document.getElementById("addModal");
        modal.style.display = "block";
    }

    function closeAddModal() {
        var modal = document.getElementById("addModal");
        modal.style.display = "none";
    }
    
    
    //FOR VOUCHER
    
     function openAddVouchModal() {
        var modal = document.getElementById("add_voucher_Modal");
        modal.style.display = "block";
    }

    function closevoucherModal() {
        var modal = document.getElementById("add_voucher_Modal");
        modal.style.display = "none";
    }
    
     function validateVoucherForm() {
        var discountInput = document.getElementsByName('discount')[0];
        var discountValue = parseInt(discountInput.value);

        if (isNaN(discountValue) || discountValue < 1 || discountValue > 100) {
            alert("Discount must be a number between 1 and 100.");
            discountInput.focus();
            return false;
        }

        return true;
    }
    

  //test site sms
  
 var selectElement = document.getElementById("sql_filter");
var msgPurposeInput = document.getElementById("MsgPurpose");

// Set the value of MsgPurpose input to the default selected option's text
msgPurposeInput.value = selectElement.options[selectElement.selectedIndex].text;

// Add an event listener to the select element to detect changes
selectElement.addEventListener("change", function() {
    // Set the value of MsgPurpose input to the selected option's text
    msgPurposeInput.value = selectElement.options[selectElement.selectedIndex].text;
});

  
// Array to store selected Lastnames, Contactnumbers, and Emails
var selectedFullNames = [];
var selectedContacts = [];
var selectedEmail = [];
var SelectedStdId = [];

document.getElementById('studentForm').addEventListener('change', function(event) {
  // Iterate through all checkboxes with the class 'checkbox'
  var checkboxes = document.querySelectorAll('.checkbox');
  var selectedContacts = [];
  var selectedEmail = [];
  var selectedStdIds = [];
  var selectedFullNames = [];

  checkboxes.forEach(function(checkbox) {
    var contact = checkbox.getAttribute('data-contact');
    var email = checkbox.getAttribute('data-email');
    var firstname = checkbox.getAttribute('data-firstname');
    var lastname = checkbox.getAttribute('data-lastname');
    var studentId = checkbox.getAttribute('data-student-id');

    // If checkbox is checked, add contact, email, and studentId to the arrays
    if (checkbox.checked) {
      selectedContacts.push(contact);
      selectedEmail.push(email);
      selectedStdIds.push(studentId);

      // Construct the full student name by concatenating first name and last name, and add it to the array
      var fullName = firstname+" "+ lastname;
      selectedFullNames.push(fullName);
    }
  });

  // Update the value of the input fields with selected contacts, emails, and student names
  document.getElementById('ContactNumSTD').value = selectedContacts.join(',');
  document.getElementById('SelectedEmailAdd').value = selectedEmail.join(',');

  // Update the SelectedStdId array with the selected student IDs
  SelectedStdId = selectedStdIds;

  // Update the SelectedStdId input field with the selected student IDs
  document.getElementById('SelectedStdId').value = SelectedStdId.join(',');

  // Update the SelectedStdname input field with the selected full names (concatenated first name and last name)
  document.getElementById('SelectedStdname').value = selectedFullNames.join(',');

  // Output values to the console for debugging
  console.log('Selected Contacts: ', selectedContacts);
  console.log('Selected Emails: ', selectedEmail);
  console.log('Selected Student IDs: ', SelectedStdId);
  console.log('Selected Student Names: ', selectedFullNames);
});








  $(document).ready(function () {
    // Handle postForm submission
   $('#sendsms').submit(function (event) {
    // Prevent the form from submitting normally
    event.preventDefault();

    // Show confirmation dialog
    var confirmation = confirm("Are you sure you want to send the message?");
    
    if (confirmation) {
        // Prepare form data for SMS
        var formDataSMS = $(this).serialize();
        console.log('SMS Form Data:', formDataSMS); // Log the form data for SMS
        
        // Comment out the AJAX request for SMS
        
        $.ajax({
    type: 'POST',
    url: '../NewSms/NewSender.php',
    data: formDataSMS,
    success: function (response) {
        // Handle the success response from the first AJAX request
        console.log(response); // Log the response to the console
        alert("SMS sent successfully!");

    },
    error: function (error) {
        // Handle errors from the first AJAX request
        console.log(error); // Log the error to the console
        // You can show an error message or perform other error handling actions
    }
});

$.ajax({
            type: 'POST',
            url: '../Sms/Sms_History.php',
            data: formDataSMS,
            success: function (historyResponse) {
                // Handle the success response from the nested AJAX request
                console.log(historyResponse); // Log the response to the console
                alert("History SMS sent successfully!");
                // You can perform other actions based on the historyResponse if needed
            },
            error: function (historyError) {
                // Handle errors from the nested AJAX request
                console.log(historyError); // Log the error to the console
                // You can show an error message or perform other error handling actions
            }
        });
        
        
        var istrue = <?php echo json_encode($istrue); ?>;

        if (istrue) {
            // Prepare form data for Email
            var formDataEmail = $(this).serialize();
            console.log('Email Form Data:', formDataEmail); // Log the form data for email evaluation

            // Comment out the AJAX request for email evaluation
            
            $.ajax({
                type: 'POST',
                url: '../Admin/php_scripts/Email_evaluation.php',
                data: formDataEmail,
                success: function (response) {
                    // Handle the success response from the server
                    console.log(response); // Log the response to the console

                    // Check if the data was successfully sent
                    if (response === 'DataReceived') {
                        alert("Email sent successfully!");
                          $('#studentForm')[0].reset();
                    $('#sendsms')[0].reset();
                    } else {
                        alert("Email sent successfully!");

                         $('#studentForm')[0].reset();
                    $('#sendsms')[0].reset();
                     var textarea = document.getElementById("textmessage");
                    textarea.value = '';
                    }

                    $('#studentForm')[0].reset();
                    $('#sendsms')[0].reset();
                     var textarea = document.getElementById("textmessage");
                    textarea.value = '';

                    // Note: You may or may not want to reload the page here
                },
                error: function (error) {
                    // Handle errors from the server
                    console.log(error); // Log the error to the console
                    // You can show an error message or perform other error handling actions
                }
            });
            
        }
    } else {
        // If the user clicks cancel, refresh the page
$('#studentForm')[0].reset();
                    $('#sendsms')[0].reset();
                     var textarea = document.getElementById("textmessage");
                    textarea.value = '';
                        }
$('#studentForm')[0].reset();
                    $('#sendsms')[0].reset();
                     var textarea = document.getElementById("textmessage");
                    textarea.value = '';

});

});



  //test site sms


    var ImgData = "<?php echo isset($_GET['ImgNum']) && !empty($_GET['ImgNum']) ? $_GET['ImgNum'] : ''; ?>";
    var modal_img1 = document.getElementById("modal_img1");
    var span_img1 = document.getElementsByClassName("close_img1")[0];

    span_img1.onclick = function () {
        showSlides(ImgData);
        modal_img1.style.display = "none";
        var currentURL = new URL(window.location.href);
        currentURL.searchParams.delete('ImgNum');
        currentURL.searchParams.delete('ImgCount');
        window.history.replaceState({}, document.title, currentURL.href);
    }



    function previewImage(event, currentImageUrl) {
        var previewDiv = document.getElementById("img-prev");
        var fileInput = event.target;

        // Clear the preview div
        previewDiv.innerHTML = '';

        // Display the current image as a reference
        var currentImg = document.createElement("img");
        currentImg.src = currentImageUrl;
        currentImg.style.width = "80%";
        currentImg.style.height = "60%";
        currentImg.style.maxWidth = "650px";
        currentImg.style.maxHeight = "600px";
        currentImg.style.objectFit = "fit";
        currentImg.style.border = "2px solid black";

        var currentImageDiv = document.createElement("div");
        currentImageDiv.appendChild(document.createTextNode(""));
        currentImageDiv.appendChild(currentImg);

        previewDiv.appendChild(currentImageDiv);

        if (fileInput.files && fileInput.files[0]) {
            previewDiv.innerHTML = '';
            var reader = new FileReader();
            reader.onload = function (e) {
                var img = document.createElement("img");
                img.src = e.target.result;
                img.classList.add("preview-image");

                img.style.width = "80%";
                img.style.height = "60%";
                img.style.maxWidth = "350px";
                img.style.maxHeight = "300px";
                img.style.objectFit = "fit";
                img.style.border = "2px solid black";

                // Replace the existing preview image with the new one
                previewDiv.appendChild(img);
            };

            reader.readAsDataURL(fileInput.files[0]);
        }
    }

    var fileInput = document.querySelector("input[name='img_input']");
    var currentImageUrl = "../img/drive-download-20230614T125330Z-001/<?php echo $_SESSION['ImgPrevValue']; ?>";
    previewImage({
        target: fileInput
    }, currentImageUrl); // Call the function with current image URL and default image URL
    fileInput.addEventListener("change", function (event) {
        previewImage(event, currentImageUrl); // Call the function when the input changes
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


    $('#postForm').submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();

                // Make an AJAX request
                $.ajax({
                    type: 'POST', // Use POST method
                    url: '../Admin/php_scripts/admin_Pupdate_post.php', 
                    data: formData,
                    success: function(response) {
                        console.log(response);
                       if(response.trim() == "Success"){
                        alert("Data inserted")

                         document.getElementById("TopicTitle").value = '';
                        document.getElementById("TextAreaAdmin").value = '';
                       }else{
                        alert("Data not inserted")
                       }
                    },
                    error: function(error) {
                        // Handle errors, e.g., display an error message
                        console.error('Error:', error);
                    }
                });
            });

            function openEditModalCourseInformation(CourseInfo) {
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
      xhttp.open("GET", "../Admin/php_scripts/admin_Pupdate_course.php?CourseInfo=" + CourseInfo, true);
      xhttp.send();
    }

    function openEditModalInformation(Info) {
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
      xhttp.open("GET", "../Admin/php_scripts/admin_Pupdate_course.php?Info=" + Info, true);
      xhttp.send();
    }
    
    //STD RELATIONSHIP
       function openEditstd_relationship_table(stdRelation) {
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
      xhttp.open("GET", "../Admin/php_scripts/admin_Pupdate_course.php?stdRelation=" + stdRelation, true);
      xhttp.send();
    }
    
     if (window.location.href.indexOf("updatedStdRelatioship") !== -1) {
      data_success();
    } else if (window.location.href.indexOf("!updatedStdRelatioship") !== -1) {
      data_failed();
    }
    

    if (window.location.href.indexOf("updatedInfo") !== -1) {
      data_success();
    } else if (window.location.href.indexOf("!updatedInfo") !== -1) {
      data_failed();
    }

    function openEditModalFeedback(feedid) {
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
      xhttp.open("GET", "../Admin/php_scripts/admin_Pupdate_course.php?feedid=" + feedid, true);
      xhttp.send();
    }

    if (window.location.href.indexOf("updatedFeedbackQuestion") !== -1) {
      data_success();
    } else if (window.location.href.indexOf("!updatedFeedbackQuestion") !== -1) {
      data_failed();
    }

    function openEditModalevalques(evalid) {
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
      xhttp.open("GET", "../Admin/php_scripts/admin_Pupdate_course.php?evalid=" + evalid, true);
      xhttp.send();
    }

    if (window.location.href.indexOf("updatedEvalQuestion") !== -1) {
      data_success();
    } else if (window.location.href.indexOf("!updatedEvalQuestion") !== -1) {
      data_failed();
    }


function openEditModalnewevalques(newevques) {
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
      xhttp.open("GET", "../Admin/php_scripts/admin_Pupdate_course.php?newevques=" + newevques, true);
      xhttp.send();
    }


 function openDeleteModalnewevalques(newevques_id) {
    var confirmation = confirm("Are you sure you want to delete this Evaluation Question?");
    
    if (confirmation) {
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "Vehicle_add_del.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        // Prepare the data
        var postData = "newevques_id=" + newevques_id;

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Handle the response here if needed
                console.log(this.responseText);
                
                // Redirect after the deletion if required
                window.location.href = "admin_Pupdate.php?deletedeval";
            }
        };

        // Send the POST request with the data
        xhttp.send(postData);
    }
}



     function openDeleteModalvehicle(V_id) {
    var confirmation = confirm("Are you sure you want to delete this vehicle?");
    
    if (confirmation) {
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "Vehicle_add_del.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        // Prepare the data
        var postData = "V_id=" + V_id;

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Handle the response here if needed
                console.log(this.responseText);
                
                // Redirect after the deletion if required
                window.location.href = "admin_Pupdate.php?deletedVehicle";
            }
        };

        // Send the POST request with the data
        xhttp.send(postData);
    }
}


    function openEditModalvoucher(voucherid) {
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
      xhttp.open("GET", "../Admin/php_scripts/admin_Pupdate_course.php?voucherid=" + voucherid, true);
      xhttp.send();
    }
    
    function openDeleteModalvoucher(voucherid) {
        var confirmation = confirm("Are you sure you want to delete this voucher?");
        
        if (confirmation) {
            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "Vehicle_add_del.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
            // Prepare the data
            var postData = "deleteVoucher=" + voucherid;
    
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Handle the response here if needed
                    console.log(this.responseText);
                    
                    // Redirect after the deletion if required
                    window.location.href = "admin_Pupdate.php?deletedVoucher";
                }
            };
    
            // Send the POST request with the data
            xhttp.send(postData);
        }
    }

    
    
     function openEditModalvehicle(vehicleid) {
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
      xhttp.open("GET", "../Admin/php_scripts/admin_Pupdate_course.php?vehicleid=" + vehicleid, true);
      xhttp.send();
    }
    
    if (window.location.href.indexOf("existingVoucher") !== -1) {
      vcode_exist();
    }
    if (window.location.href.indexOf("insertedVoucher") !== -1) {
      insert_success();
    } else if (window.location.href.indexOf("!insertedVoucher") !== -1) {
      insert_failed();
    }
    if (window.location.href.indexOf("updatedVoucher") !== -1) {
      data_success();
    } else if (window.location.href.indexOf("!updatedVoucher") !== -1) {
      data_failed();
    }
    if (window.location.href.indexOf("deletedVoucher") !== -1) {
      delete_success();
    } else if (window.location.href.indexOf("!deletedVoucher") !== -1) {
      delete_failed();
    }
     if (window.location.href.indexOf("updatedVehicle") !== -1) {
      data_success();
    } else if (window.location.href.indexOf("!updatedVehicle") !== -1) {
      data_failed();
    }
     if (window.location.href.indexOf("insertedVehicle") !== -1) {
      insert_success();
    } else if (window.location.href.indexOf("!insertedVehicle") !== -1) {
      insert_failed();
    }
    if (window.location.href.indexOf("deletedVehicle") !== -1) {
      delete_success();
    } else if (window.location.href.indexOf("!deletedVehicle") !== -1) {
      delete_failed();
    }

    function closeModal() {
      document.getElementById('editModalCourse').style.display = 'none';
    }
    
    
    function delete_success() {
      // Your JavaScript function logic here
      alert("Data is successfuly Deleted!");

      // Reset the URL to the original state (without "success") after 2 seconds
      setTimeout(function() {
        history.replaceState({}, document.title, window.location.pathname);
      }, 1);
    }

    function delete_failed() {
      // Your JavaScript function logic here
      alert("Failed to Delete the data.");

      // Reset the URL to the original state (without "success") after 2 seconds
      setTimeout(function() {
        history.replaceState({}, document.title, window.location.pathname);
      }, 1);
    }
    function insert_success() {
      // Your JavaScript function logic here
      alert("Data is successfuly Inserted!");

      // Reset the URL to the original state (without "success") after 2 seconds
      setTimeout(function() {
        history.replaceState({}, document.title, window.location.pathname);
      }, 1);
    }

    function insert_failed() {
      // Your JavaScript function logic here
      alert("Failed to insert the data.");

      // Reset the URL to the original state (without "success") after 2 seconds
      setTimeout(function() {
        history.replaceState({}, document.title, window.location.pathname);
      }, 1);
    }
    
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
    
    function vcode_exist() {
      // Your JavaScript function logic here
      alert("The Voucher code already exist. Please try another code.");

      // Reset the URL to the original state (without "success") after 2 seconds
      setTimeout(function() {
        history.replaceState({}, document.title, window.location.pathname);
      }, 1);
    }

     // Check if the URL contains "success" and trigger the function
     if (window.location.href.indexOf("updatedCourse") !== -1) {
      data_success();
    } else if (window.location.href.indexOf("!updatedCourse") !== -1) {
      data_failed();
    }

    function confirmUpdate() {
      var confirmation = confirm("Are you sure you want to update?");
      if (confirmation) {
        // If user clicks OK, submit the form
        document.querySelector('form').submit();
      }
    }



    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        if (n > slides.length) {
            slideIndex = 1;
        }
        if (n < 1) {
            slideIndex = slides.length;
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";

    }
    if (ImgData) {
        modal_img1.style.display = "block";
    }


    function editButtonClick() {

        const slides = document.getElementsByClassName("mySlides");
        const dots = document.getElementsByClassName("dot");
        let currentSlide = null;

        for (let i = 0; i < slides.length; i++) {
            if (slides[i].style.display === "block") {
                currentSlide = slides[i];
                break;

            }
        }

        console.log('Current slide:', currentSlide); // Check the element with active class
        if (currentSlide) {
            const image = currentSlide.querySelector('img');
            const dataId = image.getAttribute('data-id');
            const dataCount = image.getAttribute('data-count'); // Retrieve the count
            if (dataId) {
                console.log('Edit button clicked for:', dataId);
                var currentURL = new URL(window.location.href);
                currentURL.searchParams.set('ImgNum', dataId);
                currentURL.searchParams.set('ImgCount', dataCount); // Set the count in the URL
                window.location.href = currentURL.href;
            }
        }
    }

    window.onclick = function (event) {
        if (event.target == modal_img1) {
            modal_img1.style.display = "none";
            var currentURL = new URL(window.location.href);
            currentURL.searchParams.delete('ImgNum');
            currentURL.searchParams.delete('ImgCount');

            window.history.replaceState({}, document.title, currentURL.href);
        }
    }
    
    function togglePassword() {
        var passwordInput = document.getElementById("voucherCodeInput");
        var toggleIcon = document.getElementById("togglePasswordIcon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    }

</script>

<?php
include "../Admin/php_scripts/admin_Pupdate_modal.php";
?>
</html>






































