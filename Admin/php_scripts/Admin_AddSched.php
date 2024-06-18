<?php
include "../../conn.php";

$response = array(); // Initialize an empty response array

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["Add_Sched"]) && !empty($_POST["Add_Sched"])) {
        try {
            $schedule1 = $_POST["PDC_Date1"];
            $schedule2 = $_POST["PDC_Date2"];
    
            $admin_scheduleTime1 = $_POST["TimeAdmin1"];
            $admin_scheduleTime2 = $_POST["TimeAdmin2"];
    
            // Ensure the schedules are not empty
            if (!empty($schedule1) && !empty($schedule2)) {
                // Convert dates to YYYY-MM-DD format
                $formattedSchedule1 = date("Y-m-d", strtotime($schedule1));
                $formattedSchedule2 = date("Y-m-d", strtotime($schedule2));
    
                // Convert time to 24-hour format for database insertion
                $time1_24hr = date("H:i:s", strtotime($admin_scheduleTime1));
                $time2_24hr = date("H:i:s", strtotime($admin_scheduleTime2));
    
                // Insert data into the database using prepared statement
                $sql_AddSchedule = "INSERT INTO `pdc_schedule` (`schedule1`, `schedule2`, `time1`, `time2`) VALUES (?, ?, ?, ?)";
                $stmt_AddSchedule = $conn->prepare($sql_AddSchedule);
                $stmt_AddSchedule->bindParam(1, $formattedSchedule1);
                $stmt_AddSchedule->bindParam(2, $formattedSchedule2);
                $stmt_AddSchedule->bindParam(3, $time1_24hr);
                $stmt_AddSchedule->bindParam(4, $time2_24hr);
                $stmt_AddSchedule->execute();
    
                // Set success response in the response array
                $response["status"] = "success";
            } else {
                // Set error response in the response array if any of the dates is empty
                $response["status"] = "error_date_empty";
            }
        } catch (PDOException $e) {
            // Set error response in the response array for database errors
            $response["status"] = "error_database";
        }
    }
    
}

// Encode the response array as JSON and echo it
echo json_encode($response);
?>
