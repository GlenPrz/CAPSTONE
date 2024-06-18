<?php
include "../conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'session' checkbox array is set
    if (isset($_POST['session']) && is_array($_POST['session'])) {
        // Retrieve the student ID
        $studentID = isset($_POST['std_id']) ? htmlspecialchars($_POST['std_id']) : '';

        try {

            // Insert each selected session into the table
            foreach ($_POST['session'] as $selectedSession) {
                $currentDate = date("Y-m-d", strtotime("now")); // Current date in the Philippines

                // Prepare and execute the SQL query
                $stmt = $conn->prepare("INSERT INTO request_for_TDC_attempts (student_id, session, date_request) VALUES (:student_id, :session, :date_request)");
                $stmt->bindParam(':student_id', $studentID);
                $stmt->bindParam(':session', $selectedSession);
                $stmt->bindParam(':date_request', $currentDate);
                $stmt->execute();
            }

            // Redirect to STD_MODULE_EXAM.php with a query parameter 'status'
            header("Location: STD_MODULE_EXAM.php?retake");
            exit(); // Ensure that no further code is executed after the redirection
        } catch (PDOException $e) {
            header("Location: STD_MODULE_EXAM.php?!retake");
            exit();
        }

        // Close the database connection
        $conn = null;
    } else {
        echo "No session selected";
    }
} else {
    echo "Invalid request method";
}
?>
