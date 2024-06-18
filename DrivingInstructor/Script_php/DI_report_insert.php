<?php
include "../../conn.php";
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve data from the form
    $DI_id = $_POST["driverId"];
    $Vehicle = $_POST["Vehicle"];
    $student_id = $_POST["std_id"];
    $session = $_POST["session"];
    $Start_Odometer = $_POST["startOdometer"];
    $End_Odometer = $_POST["endOdometer"];
    $DateofAssessment = $_POST["dateOfAssessment"];

    // Now you can process and use the received data as needed
    // For example, you can insert it into a database, perform calculations, etc.

    // Inserting data into the di_report_tbl table (replace with your database code)
    try {

        // Example SQL query to insert data into the di_report_tbl table
        $sql = "INSERT INTO di_report_tbl (DI_id, Vehicle, student_id, session, Start_Odometer, End_Odometer, DateofAssessment)
                VALUES (:DI_id, :Vehicle, :student_id, :session, :Start_Odometer, :End_Odometer, :DateofAssessment)";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':DI_id', $DI_id);
        $stmt->bindParam(':Vehicle', $Vehicle);
        $stmt->bindParam(':student_id', $student_id);
        $stmt->bindParam(':session', $session);
        $stmt->bindParam(':Start_Odometer', $Start_Odometer);
        $stmt->bindParam(':End_Odometer', $End_Odometer);
        $stmt->bindParam(':DateofAssessment', $DateofAssessment);

        $stmt->execute();

        // Redirect to a success page or display a success message
        header("Location: ../di_dashboard.php?Assessment_done"); 
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
    }
}
?>
