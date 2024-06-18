<?php
session_start();
include "conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username from the AJAX request and sanitize it
    $username = isset($_POST["username"]) ? $_POST["username"] : "";

    // Check if the user is already enrolled
    $check_sql = "SELECT COUNT(*) FROM student_enrolled WHERE username = :username";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bindParam(':username', $username);
    $check_stmt->execute();
    $enrolled_count = $check_stmt->fetchColumn();

    if ($enrolled_count > 0) {
        // User is already enrolled, show an error message
        echo "Error: User is already enrolled.";
    } else {
        // Insert the username into the u896821908_bts.student_enrolled table (replace table_name with your actual table name)
        $insert_sql = "INSERT INTO student_enrolled (username) VALUES (:username)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bindParam(':username', $username);

        try {
            // Use prepared statement to execute the query safely
            if ($insert_stmt->execute()) {
                echo "Enrollment successful!";
            } else {
                echo "Error: " . implode(" ", $insert_stmt->errorInfo());
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
