<?php
include "../conn.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["di_id"])) {
        $di_id = $_POST["di_id"];

        
        try {

            // Prepare the SQL statement
            $sql = "UPDATE di SET Availability_status = 'Inactive' WHERE id_DI = :di_id";
            $stmt = $conn->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':di_id', $di_id, PDO::PARAM_STR);

            // Execute the update
            if ($stmt->execute()) {
                // Redirect to another page
                header("Location: ../login.php?set");
                exit; // Terminate script extecusteion after redirection
            } else {
                echo "Error updating record.";
            }
        } catch (PDOException $e) {
            echo "Database connection failed: " . $e->getMessage();
        }
    } else {
        echo "DI ID not found in the POST data.";
    }
} else {
    echo "Form was not submitted.";
}
?>
