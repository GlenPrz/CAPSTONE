<?php
include "../../conn.php";
session_start();

// Fetch data for the selected student using the provided 'id'
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $ol_id = $_GET['id'];

    // Your code to fetch and display the content for the selected student
    // ...

    // Example content (replace this with your actual content)
    echo "<h2>Student Details</h2>";
    echo "<p>Student ID: $ol_id</p>";
    // Add more content as needed
}
?>
