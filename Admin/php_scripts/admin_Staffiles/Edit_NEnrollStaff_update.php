<?php
include "../../../conn.php";
session_start();


// Validate and sanitize the form inputs
$lastName = isset($_POST['LastName']) ? $_POST['LastName'] : '';
$firstName = isset($_POST['FirstName']) ? $_POST['FirstName'] : '';
$middleName = isset($_POST['MiddleName']) ? $_POST['MiddleName'] : '';
$suffix = isset($_POST['Suffix']) ? $_POST['Suffix'] : '';
$birthdate = isset($_POST['Birthdate']) ? $_POST['Birthdate'] : '';
$civilStatus = isset($_POST['CivilStatus']) ? $_POST['CivilStatus'] : '';
$contactNumber = isset($_POST['ContactNumber']) ? $_POST['ContactNumber'] : '';
$sex = isset($_POST['SEX']) ? $_POST['SEX'] : '';
$completeAddress = isset($_POST['CompleteAddress']) ? $_POST['CompleteAddress'] : '';
$city = isset($_POST['City']) ? $_POST['City'] : '';
$zipCode = isset($_POST['ZipCode']) ? $_POST['ZipCode'] : '';
$citizenship = isset($_POST['Citizenship']) ? $_POST['Citizenship'] : '';
$emailAddress = isset($_POST['EmailAdd']) ? $_POST['EmailAdd'] : '';
$password = !empty($_POST['pass']) ? $_POST['pass'] : $password;
$username = isset($_POST['CurrentUsername']) ? $_POST['CurrentUsername'] : '';
$newUsername = isset($_POST['NewUsername']) ? $_POST['NewUsername'] : '';
$email = isset($_GET['email']) ? $_GET['email'] : '';
$DI_profile_pic = isset($_FILES['profile_picture']['name']) ? $_FILES['profile_picture']['name'] : '';


// echo "LastName: $lastName <br>";
// echo "FirstName: $firstName <br>";
// echo "MiddleName: $middleName <br>";
// echo "Suffix: $suffix <br>";
// echo "Birthdate: $birthdate <br>";
// echo "CivilStatus: $civilStatus <br>";
// echo "ContactNumber: $contactNumber <br>";
// echo "Sex: $sex <br>";
// echo "CompleteAddress: $completeAddress <br>";
// echo "City: $city <br>";
// echo "ZipCode: $zipCode <br>";
// echo "Citizenship: $citizenship <br>";
// echo "EmailAddress: $emailAddress <br>";
// echo "Password: $password <br>";
// echo "Username: $username <br>";
// echo "NewUsername: $newUsername <br>";
// echo "Email: $email <br>";
// echo "profile: $DI_profile_pic <br>";

$stmtStaff = $conn->prepare("SELECT DI_profile_pic FROM u896821908_bts.di WHERE Username = :CurrentUsername");
$stmtStaff->bindParam(':CurrentUsername', $username);
$stmtStaff->execute();
$rowStaff = $stmtStaff->fetch(PDO::FETCH_ASSOC);
$currentProfilePicture = $rowStaff['DI_profile_pic'];

$profilePicture = $_FILES['profile_picture']['name'];
$profilePictureTmp = $_FILES['profile_picture']['tmp_name'];

if (!empty($profilePictureTmp)) {
    $profilePicturePath = '../../../uploads/Di_uploads/'.basename($profilePicture);

    if (move_uploaded_file($profilePictureTmp, $profilePicturePath)) {
        $profilePicture = $profilePicturePath; 
        error_log('Uploaded profile picture: ' . $profilePicture);
    } else {
        error_log('Failed to move the uploaded file to the desired location.');
        $profilePicture = !empty($currentProfilePicture) ? $currentProfilePicture : './uploads/user_icon.png';
    }
} else {
    $profilePicture = !empty($currentProfilePicture) ? $currentProfilePicture : './uploads/user_icon.png';
    error_log('No new profile picture uploaded');
}

// Check if the new username already exists



// Prepare the SQL statement to update data in the table
$stmt = $conn->prepare("UPDATE u896821908_bts.di SET
    LastName = :LastName,
    FirstName = :FirstName,
    Midllename = :MiddleName,
    Suffix = :Suffix,
    Birthdate = :Birthdate,
    Civil_status = :CivilStatus,
    ContactNumber = :ContactNumber,
    Sex = :Sex,
    Address = :Address,
    City = :City,
    ZipCode = :ZipCode,
    Citizenship = :Citizenship,
    Email = :EmailAddress,
    DI_profile_pic = :DI_profile_pic,
    Password = CASE WHEN :Password IS NOT NULL AND :Password <> '' THEN :Password ELSE Password END,
    Username = :NewUsername
    WHERE Username = :CurrentUsername");

$stmt->bindParam(':LastName', $lastName);
$stmt->bindParam(':FirstName', $firstName);
$stmt->bindParam(':MiddleName', $middleName);
$stmt->bindParam(':Suffix', $suffix);
$stmt->bindParam(':Birthdate', $birthdate);
$stmt->bindParam(':CivilStatus', $civilStatus);
$stmt->bindParam(':ContactNumber', $contactNumber);
$stmt->bindParam(':Sex', $sex);
$stmt->bindParam(':Address', $completeAddress);
$stmt->bindParam(':City', $city);
$stmt->bindParam(':ZipCode', $zipCode);
$stmt->bindParam(':Citizenship', $citizenship);
$stmt->bindParam(':EmailAddress', $emailAddress);
$stmt->bindParam(':Password', $password);
$stmt->bindParam(':NewUsername', $newUsername);
$stmt->bindParam(':CurrentUsername', $username);
$stmt->bindParam(':DI_profile_pic', $profilePicture);

if ($stmt->execute()) {
    $rowCount = $stmt->rowCount();
    
    if ($rowCount > 0) {
        $_SESSION['Username'] = $newUsername; 
    
        echo "<script>alert('Profile updated successfully!');</script>";
    } else {
        echo "<script>alert('No records were updated.');</script>";
    }
} else {
    echo "<script>alert('Error updating profile.');</script>";
}

// Close the database connection
$conn = null;


?>
