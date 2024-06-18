<?php


$qid = $_GET['id'] ?? 'none';
$qidPDCQuestion = $_GET['Pdcid'] ?? 'none';

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

if(isset($qid) && !empty($qid) && $qid !== 'none'){

    // Delete the question with the specified qid
    $sql = "DELETE FROM questions WHERE qid = '$qid'";
    if ($conn->query($sql) === TRUE) {
        // Deletion successful
        echo "Question deleted successfully";
    } else {
        // Error deleting question
        echo "Error deleting question: " . $conn->error;
    }

    // Close the connection
    $conn->close();

    // Redirect back to the page after deletion
    header("Location: admin_module_exam.php?deleted");
	exit; // Make sure to exit after the redirect
   
}

if(isset($qidPDCQuestion) && !empty($qidPDCQuestion) or $qidPDCQuestion == 'none'){
// Delete the question with the specified qid
$sqlPDCQ = "DELETE FROM pdc_questions WHERE ques_id = '$qidPDCQuestion'";
if ($conn->query($sqlPDCQ) === TRUE) {
    // Deletion successful
    echo "Question deleted successfully";
} else {
    // Error deleting question
    echo "Error deleting question: " . $conn->error;
}

// Close the connection
$conn->close();

// Redirect back to the page after deletion
header("Location: admin_module_exam.php?delQ");
exit; // Make sure to exit after the redirect
}
?>
