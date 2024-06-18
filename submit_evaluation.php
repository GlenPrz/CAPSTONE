<?php
include "conn.php";

$sql = "INSERT INTO evalres_tb (student_name, license, date_enrolled, Q1, Q2, Q3, Q4) 
        VALUES (:student_name, :license, :date_enrolled, :Q1, :Q2, :Q3, :Q4)";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

$student_name = $_POST['student_name'] ?? '';
$date_enrolled = $_POST['dateEnroll'] ?? '';
$license = $_POST['license_std'] ?? '';
$Q1 = $_POST['rating_overall_experience'] ?? '';
$Q2 = $_POST['rating_instructor_quality'] ?? '';
$Q3 = $_POST['rating_curriculum_effectiveness'] ?? '';
$Q4 = $_POST['additional_comments'] ?? '';

// Bind parameters
$stmt->bindParam(':student_name', $student_name);
$stmt->bindParam(':license', $license);
$stmt->bindParam(':date_enrolled', $date_enrolled);
$stmt->bindParam(':Q1', $Q1);
$stmt->bindParam(':Q2', $Q2);
$stmt->bindParam(':Q3', $Q3);
$stmt->bindParam(':Q4', $Q4);

try {
        // Prepare the insert statement
        $insertQuery = "INSERT INTO newques_evalres_tb (title, question, rate) VALUES (:title, :question, :rating)";
        $insertStmt = $conn->prepare($insertQuery);

       $questions = array_values($_POST['questions']);
$titles = array_values($_POST['titles']);
$ratings = array_values($_POST['rating']);

foreach ($questions as $key => $question) {
    // Check if the necessary data is present
    if (isset($titles[$key], $ratings[$key])) {
        $title = $titles[$key];
        $rating = $ratings[$key];

        // Bind parameters
        $insertStmt->bindParam(':title', $title);
        $insertStmt->bindParam(':question', $question);
        $insertStmt->bindParam(':rating', $rating);

        // Execute the statement
        $insertStmt->execute();

        echo "Rating recorded for question: $question, Title: $title, Rating: $rating<br>";
    } else {
        echo "Error: Incomplete data for question $question<br>";
    }
}

        echo "Ratings successfully recorded!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
if ($stmt->execute()) {
    echo "Record inserted successfully.";
} else {
    echo "Error: Unable to insert record.";
}
?>
