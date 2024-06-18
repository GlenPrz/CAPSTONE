<?php
session_start();
if (empty($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}
include "../conn.php";

if (isset($_GET['userId'])) {
    $userId = $_GET['userId'];

    // Prepare and execute the SQL query to delete the user
    $sql = "DELETE FROM admin WHERE idadmin = $userId";

    if ($conn->query($sql) === TRUE) {
        // Record deleted successfully
        header("Location: ../admin_Staff.php?deleted");
        exit();
    } else {
        header("Location: ../admin_Staff.php?!deleted");
        exit();
    }
    
} else {
    
}
?>
