<?php
include "conn.php";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Values from the form
    $student_id = $_POST['student_id_GCASH'];
    $student_name = $_POST['student_name'];
    $gcash_number = $_POST['gcash_number'];
    $reference_number = $_POST['Reference_number'];
    
    $date = date('Y-m-d'); // Assuming you want to insert the current date

    // Check if a file was uploaded
    $folder = ""; // Initialize the variable

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $filename = $_FILES["profile_picture"]["name"];
        $tempname = $_FILES["profile_picture"]["tmp_name"];
        $folder = "./uploads/imgs_gcash_student/" . $filename;
    
        if (move_uploaded_file($tempname, $folder)) {
            // Store the profile picture data in a session variable
            echo "Image uploaded and stored in the session.";
        } else {
            echo "Failed to upload image.";
        }
    } else {
        // If no new profile picture was uploaded, use a default value
        // $GCASH_PICTUREPath = './uploads/imgs_gcash_student/user_icon.png';
        error_log('No new profile picture uploaded');
    }

   

    // Prepare the SQL statement
    $sql = "INSERT INTO olpayment_tb (student_id, student_name, Gcash_num, Receipt_pic, date, Refence_num) 
            VALUES (:student_id, :student_name, :gcash_number, :gcash_picture, :date, :reference)";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
    $stmt->bindParam(':student_name', $student_name, PDO::PARAM_STR);
    $stmt->bindParam(':gcash_number', $gcash_number, PDO::PARAM_STR);
    $stmt->bindParam(':gcash_picture', $folder, PDO::PARAM_STR);
    $stmt->bindParam(':date', $date, PDO::PARAM_STR);
    $stmt->bindParam(':reference', $reference_number, PDO::PARAM_STR);


    // Execute the SQL statement
    if ($stmt->execute()) {
        echo "Record inserted successfully.";
    } else {
        echo "Error inserting record: " . $stmt->errorInfo()[2];
    }
} else {
    echo "Form was not submitted.";
}
?>
