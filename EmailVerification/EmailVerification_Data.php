<?php
session_start();
$_SESSION['Username_EV'] = $_POST['Username'];
$_SESSION['EmailAdd_EV'] = $_POST['EmailAdd'];
$_SESSION['pass_EV'] = $_POST['pass'];
$_SESSION['profilePic_EV'] = $_POST['pass'];
$_SESSION['otp_EV'] = $_POST['otp'] ?? '';

if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
    $filename = $_FILES["profile_picture"]["name"];
    $tempname = $_FILES["profile_picture"]["tmp_name"];
    $folder = "../uploads/" . $filename;

    if (move_uploaded_file($tempname, $folder)) {
        // Store the profile picture data in a session variable
        echo "Image uploaded and stored in the session.";
    } else {
        echo "Failed to upload image.";
    }
} else {
    $folder = "../uploads/user_icon.png";
    echo "No image uploaded or an error occurred.";
}

$_SESSION['profilepicture_EV'] = $folder;

 

?>