<?php
include "../../conn.php";
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the values from the form
    $assign_id = $_POST['assign_id'];
	$DI_id = $_POST['DI_id'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Prepare the SQL statement with a parameter for security
        $sql = "UPDATE u896821908_bts.di_assign_tbl SET status = 'declined' WHERE  Di_Assign = :assign_id";
        $stmt = $conn->prepare($sql);
        
        // Bind the parameter
        $stmt->bindParam(':assign_id', $assign_id, PDO::PARAM_INT);
        
        // Execute the statement
        $stmt->execute();
        
		 // Prepare the SQL statement with a parameter for security
        $sql2 = "UPDATE u896821908_bts.di SET Availability_status = 'Active' WHERE id_DI = :DI_id";
        $stmt2 = $conn->prepare($sql2);
        
        // Bind the parameter
        $stmt2->bindParam(':DI_id', $DI_id, PDO::PARAM_INT);
        
        // Execute the statement
        $stmt2->execute();
		
        // Check if the update was successful
        if ($stmt->rowCount() > 0) {
             header("Location: ../di_dashboard.php?decline");
                exit;
        } else {
             header("Location: ../di_dashboard.php?!decline");
                exit;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // If the form was not submitted via POST, you can handle it here (e.g., display an error message).
    header("Location: ../admin_Assign.php?!decline");
    exit;
}
?>
