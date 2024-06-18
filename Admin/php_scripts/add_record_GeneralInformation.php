<?php 
include "../conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hiddenValue = $_POST['hiddenValue'];

    if($hiddenValue === "true"){
        // Insertion Logic
        $title = $_POST['title'];
        $description = $_POST['description'];

        try {
            // Prepare SQL statement for insertion
            $stmt = $conn->prepare("INSERT INTO info_tb (title, description) VALUES (:title, :description)");

            // Bind parameters
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);

            // Execute the statement
            $stmt->execute();

            echo "New record created successfully";
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } elseif ($hiddenValue === "delete") {
        // Deletion Logic
        $info_id = $_POST['info_id'];

        try {
            // Prepare SQL statement for deletion
            $stmt = $conn->prepare("DELETE FROM info_tb WHERE info_id = :info_id");

            // Bind parameters
            $stmt->bindParam(':info_id', $info_id);

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



