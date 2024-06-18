<?php
// STD_insert_payment.php

include("conn.php");
session_start();

// Print all the data received from the client (for debugging purposes)
error_log("Received POST data: " . print_r($_POST, true));

if (isset($_POST['paymentOption'])) {
    try {
        $paymentOption = $_POST['paymentOption'];
        $username = $_SESSION['username'];

        if ($paymentOption == "five") {
            // If the payment option is five, insert five rows into the student_payment table with different weeks
            $totalWithoutPercentage = $_POST['totalWithoutPercentage'];
            $perWeekAmount = ($totalWithoutPercentage + 1000) / 5;

            for ($week = 1; $week <= 5; $week++) {
                $date = date('Y-m-d', strtotime("+" . (($week - 1) * 7) . " days"));
                // Prepare and execute the SQL query using the $conn variable from conn.php
                $stmt = $conn->prepare("INSERT INTO student_payment (username, payment_type, week, date, Total_paid, payment_status) VALUES (?, 'five payment', ?, ?, ?, 'pending')");
                $stmt->execute([$username, $week, $date, $totalWithoutPercentage + 1000]); // Add 1000 to Total_paid for each week
            }
        } else if ($paymentOption == "full") {
            // If the payment option is full, insert a single row into the student_payment table
            $totalWithoutPercentage = $_POST['totalWithoutPercentage'];
            $date = date('Y-m-d'); // Use the current date as the payment date

            // Prepare and execute the SQL query using the $conn variable from conn.php
            $stmt = $conn->prepare("INSERT INTO student_payment (username, payment_type, date, Total_paid, payment_status) VALUES (?, 'full payment', ?, ?, 'pending')");
            $stmt->execute([$username, $date, $totalWithoutPercentage]);
        }

        // Update the Enroll_status to "pending" for the current user
        $stmt = $conn->prepare("UPDATE student SET Enroll_status = 'pending' WHERE username = ?");
        $stmt->execute([$username]);

        // If the data insertion is successful, send a response back to the client
        echo "Payment data successfully inserted.";
    } catch (PDOException $e) {
        // If an error occurs during the database operation, catch the exception and send an error response
        echo "Error inserting payment data: " . $e->getMessage();
    }
}
?>


