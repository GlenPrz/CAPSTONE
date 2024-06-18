<?php
session_start();
include "conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = $_SESSION['username'];
    $tdc = isset($_POST['tdcOnline']) && !empty($_POST['tdcOnline']) ? $_POST['tdcOnline'] : '';
    $dep = isset($_POST['depStatus']) && !empty($_POST['depStatus']) ? $_POST['depStatus'] : '';
    $pdcMotorA = isset($_POST['PDC_Motor']) && $_POST['PDC_Motor'] === 'MC_Automatic' ? 'MC_Automatic' : '';
    $pdcMotorM = isset($_POST['PDC_Motor']) && $_POST['PDC_Motor'] === 'MC_Manual' ? 'MC_Manual' : '';
    $pdcCarA = isset($_POST['PDC_Car']) && $_POST['PDC_Car'] === 'C_Automatic' ? 'C_Automatic' : '';
    $pdcCarM = isset($_POST['PDC_Car']) && $_POST['PDC_Car'] === 'C_Manual' ? 'C_Manual' : '';
    $licenseNumber = isset($_POST['licenseNumber']) && !empty($_POST['licenseNumber']) ? $_POST['licenseNumber'] : '';
    $expirationDate = isset($_POST['expirationDate']) && !empty($_POST['expirationDate']) ? $_POST['expirationDate'] : '';

    // Check if any of the fields have values
    if (!empty($tdc) || !empty($dep) || !empty($pdcMotorA) || !empty($pdcMotorM) || !empty($pdcCarA) || !empty($pdcCarM) || !empty($licenseNumber) || !empty($expirationDate)) {
        try {
            // Prepare the SQL statement
            $stmt = $conn->prepare("INSERT INTO student_enrolled (Username, TDC, DEP, `PDC-MOTOR-A`, `PDC-MOTOR-M`, `PDC-CAR-A`, `PDC-CAR-M`, LicenseNumber, ExpirationDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

            // Bind the parameters
            $stmt->bindParam(1, $username);
            $stmt->bindParam(2, $tdc);
            $stmt->bindParam(3, $dep);
            $stmt->bindParam(4, $pdcMotorA);
            $stmt->bindParam(5, $pdcMotorM);
            $stmt->bindParam(6, $pdcCarA);
            $stmt->bindParam(7, $pdcCarM);
            $stmt->bindParam(8, $licenseNumber);
            $stmt->bindParam(9, $expirationDate);

            // Execute the statement
            if ($stmt->execute()) {

                // Update the Enroll_Status to 'enrolled' if any of the fields have values
                if (!empty($pdcMotorA) || !empty($pdcMotorM) || !empty($pdcCarA) || !empty($pdcCarM)) {
                    $enrollStatus = 'enrolled';
                    $updateStmt = $conn->prepare("UPDATE student SET Enroll_Status = ? WHERE Username = ?");
                    $updateStmt->bindParam(1, $enrollStatus);
                    $updateStmt->bindParam(2, $username);
                    $updateStmt->execute();
                }
                
                // Redirect to Student\STD_HOME.php
                echo 'success';
                exit();
            } else {
                // Failed to insert data
                echo "Error: " . $stmt->errorInfo()[2];
            }
        } catch (PDOException $e) {
            // Handle PDO exceptions
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "No data to insert or update.";
    }
}
?>
