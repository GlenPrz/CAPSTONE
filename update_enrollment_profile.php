<?php
session_start();
include 'conn.php';

// Assuming $session['username'] holds the username of the student
$username = $_SESSION['username'];

// Sanitize and validate the input before updating the database (recommended)
$tdcOnline = isset($_POST["tdcOnline"]) ? $_POST["tdcOnline"] : "";
$depStatus = isset($_POST["depStatus"]) ? $_POST["depStatus"] : "";
$licenseNumber = isset($_POST["licenseNumber"]) ? $_POST["licenseNumber"] : "";
$expirationDate = isset($_POST["expirationDate"]) ? $_POST["expirationDate"] : "";
$pdc = isset($_POST["PDC"]) ? $_POST["PDC"] : "";
$pdcMotor = isset($_POST["PDC_Motor"]) ? $_POST["PDC_Motor"] : "";
$pdcCar = isset($_POST["PDC_Car"]) ? $_POST["PDC_Car"] : "";

try {
    // Prepare the SQL query
    $stmt = $conn->prepare("UPDATE `u896821908_bts`.`student_enrolled`
                           SET `TDC` = :tdcOnline,
                               `DEP` = :depStatus,
                               `PDC-MOTOR` = :pdcMotor,
                               `PDC-CAR` = :pdcCar,
                               `LicenseNumber` = :licenseNumber,
                               `ExpirationDate` = :expirationDate
                           WHERE `Username` = :username");

    // Bind parameters
    $stmt->bindParam(':tdcOnline', $tdcOnline);
    $stmt->bindParam(':depStatus', $depStatus);
    $stmt->bindParam(':pdcMotor', $pdcMotor);
    $stmt->bindParam(':pdcCar', $pdcCar);
    $stmt->bindParam(':licenseNumber', $licenseNumber);
    $stmt->bindParam(':expirationDate', $expirationDate);
    $stmt->bindParam(':username', $username);

    // Execute the query
    if ($stmt->execute()) {
        echo "Enrollment data updated successfully!";
    } else {
        echo "Error updating enrollment data: " . $stmt->errorInfo()[2];
    }
} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage();
}
?>
