<?php
include "../conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $title = $_POST['AdminPost_TopicTitle'];
    $description = $_POST['AdminPost_BodyDescription'];
    $CreatePost = $_POST['CreatePost'];
    $date = date("Y-m-d"); 
    try {
        if(isset($CreatePost) && $CreatePost == "CreatePost"){
        $sql = "INSERT INTO u896821908_bts.admin_updatepostdesc (Date, Title, Description) VALUES (:date, :title, :description)";
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);

        // Execute the statement
        if ($stmt->execute()) {
            // Insert successful
            echo "Success";
        } else {
            // Insert failed
            echo "Error: " . $stmt->errorInfo()[2];
        }
    }

    } catch (PDOException $e) {
        // Handle database connection errors
        echo "Error: " . $e->getMessage();
    } finally {
        // Close the database connection
        $conn = null;
    }

} else {
    // Handle non-POST requests
    echo "Invalid request.";
}

?>