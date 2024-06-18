<?php
// Fetch the 'id' parameter from the URL query string
$qid = $_GET['id'] ?? 'none';
$qidPDCQuestion = $_GET['Pdcid'] ?? 'none';
$qidCourseinfo = $_GET['CourseInfo'] ?? 'none';
$infoId = $_GET['infoId'] ?? 'none';
$feedid = $_GET['feedid'] ?? 'none';
$evalid = $_GET['evalid'] ?? 'none';
$StdRelationship = $_GET['StdRelationship'] ?? 'none';


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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get values from POST
    if(isset($qid) && !empty($qid) && $qid != 'none') {
    $question = $_POST['question'];
    $ans1 = $_POST['ans1'];
    $ans2 = $_POST['ans2'];
    $ans3 = $_POST['ans3'];
    $ans4 = $_POST['ans4'];
    $correct_answer = $_POST['correct_answer'];
    $topic = $_POST['topic'];

    // File upload
    $targetDirectory = "../uploads/ques_img/";  // Set your target directory
    $targetPath = $targetDirectory . basename($_FILES["ques_img"]["name"]);

    if (!empty($_FILES["ques_img"]["name"])) {
        // Check if an image is provided
        if (move_uploaded_file($_FILES['ques_img']['tmp_name'], $targetPath)) {
            echo 'File has been uploaded successfully.';
            // Set $ques_img to the target path if the file is uploaded successfully
            $ques_img = $targetPath;
        } else {
            echo 'File upload failed.';
            // Set $ques_img to NULL if the file upload fails
            $ques_img = null;
        }
    } else {
        // No image provided
        $ques_img = null;
    }

    // Update the question in the database
    $updateSql = "UPDATE u896821908_bts.questions SET question=?, ans1=?, ans2=?, ans3=?, ans4=?, correct_answer=?, topic=?, ques_img=? WHERE qid=?";
    
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param('ssssssssi', $question, $ans1, $ans2, $ans3, $ans4, $correct_answer, $topic, $ques_img, $qid);

    if ($stmt->execute()) {
        header("Location: admin_module_exam.php?updated");
        exit; // Make sure to exit after the redirect
    } else {
        header("Location: admin_module_exam.php?!updated");
        exit; // Make sure to exit after the redirect
    }
}

if (isset($qidPDCQuestion) && ($qidPDCQuestion != 'none' && !empty($qidPDCQuestion))) {
  $Qtitle = $_POST['qtitle'];
  $desc = $_POST['desciption'];
  $session = $_POST['Session_PDCQ'];

  // Use prepared statements to prevent SQL injection
  $updatePDCQ = "UPDATE u896821908_bts.pdc_questions SET q_title = ?, desciption = ?, session = ? WHERE ques_id = ?";
  
  $stmt = $conn->prepare($updatePDCQ);
  $stmt->bind_param("ssii", $Qtitle, $desc, $session, $qidPDCQuestion);

  if ($stmt->execute()) {
      header("Location: admin_module_exam.php?updatedPDCQ");
      exit; // Make sure to exit after the redirect
  } else {
      header("Location: admin_module_exam.php?!updatingQ");
      exit; // Make sure to exit after the redirect
  }
}

if (isset($infoId) && $infoId != 'none' && !empty($infoId)) {
  $info_title = $_POST['info_title'];
  $Courseinformation = $_POST['information'];

  // Use prepared statements to prevent SQL injection
  $updateInfo = "UPDATE u896821908_bts.info_tb SET title = ?, description = ? WHERE info_id = ?";

  $stmtInfo = $conn->prepare($updateInfo);
  $stmtInfo->bind_param("ssi", $info_title, $Courseinformation, $infoId);

  if ($stmtInfo->execute()) {
      header("Location: admin_Pupdate.php?updatedInfo");
      exit; // Make sure to exit after the redirect
  } else{
    header("Location: admin_Pupdate.php?!updatedInfo");
    exit; 
  }
}

if (isset($feedid) && $feedid != 'none' && !empty($feedid)) {
  $Question = $_POST['QuestionFeedback'];

  // Use prepared statements to prevent SQL injection
  $updateFeedbackQuestion = "UPDATE u896821908_bts.feedques_tb SET Question = ? WHERE qID = ?";

  $stmtFeedbackQuestion = $conn->prepare($updateFeedbackQuestion);
  $stmtFeedbackQuestion->bind_param("si", $Question, $feedid);

  if ($stmtFeedbackQuestion->execute()) {
      header("Location: admin_Pupdate.php?updatedFeedbackQuestion");
      exit; // Make sure to exit after the redirect
  } else{
    header("Location: admin_Pupdate.php?!updatedFeedbackQuestion");
    exit; 
  }
}

if (isset($evalid) && $evalid != 'none' && !empty($evalid)) {
  $Question = $_POST['QuestionEval'];

  // Use prepared statements to prevent SQL injection
  $updateEvalQuestion = "UPDATE u896821908_bts.evalques_tb SET question = ? WHERE eval_id = ?";

  $stmtEvalQuestion = $conn->prepare($updateEvalQuestion);
  $stmtEvalQuestion->bind_param("si", $Question, $evalid);

  if ($stmtEvalQuestion->execute()) {
      header("Location: admin_Pupdate.php?updatedEvalQuestion");
      exit; // Make sure to exit after the redirect
  } else{
    header("Location: admin_Pupdate.php?!updatedEvalQuestion");
    exit; 
  }
}

if (isset($StdRelationship) && $StdRelationship != 'none' && !empty($StdRelationship)) {
  $stdRelationship = $_POST['stdRelationship'];

  // Use prepared statements to prevent SQL injection
  $updateStdRelationship = "UPDATE u896821908_bts.std_emergency_relationship SET Relationship = ? WHERE idStd_Emergency_relationship = ?";

  $stmtStdRelationship = $conn->prepare($updateStdRelationship);
  $stmtStdRelationship->bind_param("si", $stdRelationship, $StdRelationship);

  if ($stmtStdRelationship->execute()) {
      header("Location: admin_Pupdate.php?updatedStdRelatioship");
      exit; // Make sure to exit after the redirect
  } else{
    header("Location: admin_Pupdate.php?!updatedStdRelatioship");
    exit; 
  }
}

if (isset($qidCourseinfo) && ($qidCourseinfo != 'none' || !empty($qidCourseinfo))) {
  $Course = $_POST['Course'];
  $Courseinformation = $_POST['Courseinformation'];
  $VechileType = $_POST['VechileType'];
  $Info = $_POST['Info'];
  $Price = $_POST['Price'];
  
  // Use prepared statements to prevent SQL injection
  $updateCourse = "UPDATE u896821908_bts.course_enrolled SET Course = ?, Course_info = ?, `Vechile(Type)` = ?, Info = ?, Price = ? WHERE idCourse_Enrolled = ?";
  
  $stmt_info = $conn->prepare($updateCourse);
  $stmt_info ->bind_param("ssssii", $Course, $Courseinformation, $VechileType, $Info, $Price, $qidCourseinfo);
  
    if ($stmt_info ->execute()) {
         header("Location: admin_Pupdate.php?updatedCourse");
        exit; // Make sure to exit after the redirect
    } else {
         header("Location: admin_Pupdate.php?!updatedCourse");
        exit; // Make sure to exit after the redirect
    }
}



}

// Close the connection
$conn->close();
?>
