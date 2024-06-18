<?php

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
    // Collect form data here
    if (isset($_POST['proceedPDCQ'])) {
        echo "The 'proceedPDCQ' button was clicked.";
        $qtitle = $_POST['qtitle'];
        $desciption = $_POST['desciption'];
        $Session = $_POST['Session_PDCQ'];

        $sqlPDCQ = "INSERT INTO pdc_questions (q_title, desciption, session) VALUES (?, ?, ?)";
        // Prepare the SQL statement
        $stmtInsertPDCQ = $conn->prepare($sqlPDCQ);
        // Bind the parameters
        $stmtInsertPDCQ->bind_param("sss", $qtitle, $desciption, $Session);
        // Execute the query

        if ($stmtInsertPDCQ->execute()) {
            header("Location: admin_module_exam.php?addQ");
            	exit;
        }else{
        header("Location: admin_module_exam.php?!addQ");
        	exit;
        }
    }

if (isset($_POST['proceed'])) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    $question = $_POST["question"];
    $ans1 = $_POST["ans1"];
    $ans2 = $_POST["ans2"];
    $ans3 = $_POST["ans3"];
    $ans4 = $_POST["ans4"];
    $correct_answer = $_POST["correct_answer"];
    $topic = $_POST["topic"];

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

    // Perform the database insertion operation here
    // Prepare and execute the INSERT query
    $sql = "INSERT INTO questions (question, ans1, ans2, ans3, ans4, correct_answer, topic, ques_img) 
            VALUES ('$question', '$ans1', '$ans2', '$ans3', '$ans4', '$correct_answer', '$topic', ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $ques_img);

    if ($stmt->execute()) {
        // Insertion successful
        header("Location: admin_module_exam.php?added");
        exit; // Make sure to exit after the redirect
    } else {
        // Error inserting question
        header("Location: admin_module_exam.php?!added");
        exit; // Make sure to exit after the redirect
    }

}


$conn->close();

}
?>
