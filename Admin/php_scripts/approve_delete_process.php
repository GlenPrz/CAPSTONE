<?php
include "../../conn.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Check if 'approve' or 'delete' parameter is set in the URL
    
    if (isset($_GET['approve'])) {
        $request_id = $_GET['approve'];
        $username = $_GET['username'];
        $session = $_GET['session'];

        try {
            // Delete records in the student_result table using PDO
            $deleteQuery = "DELETE FROM student_result WHERE Session_num = :session AND username = :username AND result = 'Failed'";
            $stmt = $conn->prepare($deleteQuery);

            // Bind parameters
            $stmt->bindParam(':session', $session, PDO::PARAM_STR);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);

            // Execute the statement
            $stmt->execute();

            // Check if any rows were affected
            if ($stmt->rowCount() > 0) {
                // Deletion successful

                // Update the request_for_TDC_attempts table
                $updateQuery = "UPDATE request_for_TDC_attempts SET status = 'complete' WHERE request_id = :request_id";
                $stmtUpdate = $conn->prepare($updateQuery);

                // Bind parameter
                $stmtUpdate->bindParam(':request_id', $request_id, PDO::PARAM_INT);

                // Execute the update statement
                $stmtUpdate->execute();

                // Update the student table
                $updateStudentQuery = "UPDATE student SET total_amount = total_amount + 300, balance = balance + 300 WHERE Username = :username";
                $stmtUpdateStudent = $conn->prepare($updateStudentQuery);

                // Bind parameter
                $stmtUpdateStudent->bindParam(':username', $username, PDO::PARAM_STR);

                // Execute the update statement for the student table
                $stmtUpdateStudent->execute();

                echo "<script>";
                echo "alert('Retake approved!');";
                echo "window.history.go(-1);";
                echo "window.history.replaceState({}, document.title, '../Admin_editview.php?status=retake');";
                echo "</script>";
                exit();
            } else {
                echo "<script>";
                echo "alert('Failed to approve.');";
                echo "window.history.go(-1);";
                echo "window.history.replaceState({}, document.title, '../Admin_editview.php?status=!retake');";
                echo "</script>";
                exit();
            }
        } catch (PDOException $e) {
            // Handle PDO exception
            echo "Error: " . $e->getMessage();
        }
        
        
    } elseif (isset($_GET['delete'])) {
    $request_id = $_GET['delete'];
    $username = $_GET['username'];
    $session = $_GET['session'];

    try {
        // Delete records in the student_result table using PDO
        $deleteStudentResultQuery = "DELETE FROM request_for_TDC_attempts WHERE request_id = :request_id";
        $stmtDeleteStudentResult = $conn->prepare($deleteStudentResultQuery);

        // Bind parameter
        $stmtDeleteStudentResult->bindParam(':request_id', $request_id, PDO::PARAM_INT);

        // Execute the delete statement for student_result table
        $stmtDeleteStudentResult->execute();

        // Check if any rows were affected
        if ($stmtDeleteStudentResult->rowCount() > 0) {

                echo "<script>";
                echo "alert('Request deleted!');";
                echo "window.history.go(-1);";
                echo "window.history.replaceState({}, document.title, '../Admin_editview.php?status=delete');";
                echo "</script>";
                exit();
        } else {
                echo "<script>";
                echo "alert('Failed to delete request.');";
                echo "window.history.go(-1);";
                echo "window.history.replaceState({}, document.title, '../Admin_editview.php?status=!delete');";
                echo "</script>";
                exit();
        }
    } catch (PDOException $e) {
        // Handle PDO exception
        echo "Error: " . $e->getMessage();
    }
}else {
        // Handle other cases if needed
        echo "Invalid action!";
    }
} else {
    // Handle case when the request method is not GET
    echo "Invalid request method!";
}
?>
