<?php 
include "../conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hiddenValue = $_POST['hiddenValue'];

    if($hiddenValue === "true"){
        // Insertion Logic
        $RelationshipStd = $_POST['relationship'];

        try {
            // Prepare SQL statement for insertion
            $stmt = $conn->prepare("INSERT INTO std_emergency_relationship (Relationship) VALUES (:Relationship)");

            // Bind parameters
            $stmt->bindParam(':Relationship', $RelationshipStd);

            // Execute the statement
            $stmt->execute();

            echo "New record created successfully";
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } elseif ($hiddenValue === "delete") {
        // Deletion Logic
        $idStd_Emergency_relationship = $_POST['idStd_Emergency_relationship'];

        try {
            // Prepare SQL statement for deletion
            $stmt = $conn->prepare("DELETE FROM std_emergency_relationship WHERE idStd_Emergency_relationship = :Std_Emergency_relationship");

            // Bind parameters
            $stmt->bindParam(':Std_Emergency_relationship', $idStd_Emergency_relationship);

            // Execute the statement
            $stmt->execute();

            echo "Record deleted successfully";
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Invalid request"; // Handle invalid requests
    }

    // Close the connection
    $conn = null;
}
?>