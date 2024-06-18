<?php
include "../conn.php";
 
try {

// Build the $dummy_data array with other form fields
$dummy_data = [
  'Lastname' => isset($_POST['DI_LastName']) ? $_POST['DI_LastName'] : '',
  'Firstname' => isset($_POST['DI_FirstName']) ? $_POST['DI_FirstName'] : '',
  'Midllename' => isset($_POST['DI_MiddleName']) ? $_POST['DI_MiddleName'] : '',
  'Suffix' => isset($_POST['DI_LastName']) ? $_POST['DI_LastName'] : '',
  'Birthdate' => isset($_POST['DI_Birthdate']) ? date('Y-m-d', strtotime($_POST['DI_Birthdate'])) : '',
  'Civil_status' => isset($_POST['DI_CivilStatus']) ? $_POST['DI_CivilStatus'] : '',
  'Sex' => isset($_POST['SEX']) ? $_POST['SEX'] : '',
  'ContactNumber' => isset($_POST['DI_ContactNumber']) ? $_POST['DI_ContactNumber'] : '',
  'Address' => isset($_POST['DI_CompleteAddress']) ? $_POST['DI_CompleteAddress'] : '',
  'City' => isset($_POST['DI_City']) ? $_POST['DI_City'] : '',
  'ZipCode' => isset($_POST['DI_ZipCode']) ? $_POST['DI_ZipCode'] : '',
  'Citizenship' => isset($_POST['DI_Citizenship']) ? $_POST['DI_Citizenship'] : '',
  'Email' => isset($_POST['DI_EmailAdd']) ? $_POST['DI_EmailAdd'] : '',
  'Educational_Attainment' => isset($_POST['DI_Education']) ? $_POST['DI_Education'] : '',
  'Educational_Attainment_yr' => isset($_POST['DI_Year']) ? date('Y-m-d', strtotime($_POST['DI_Year'])) : '',
  'Educational_Attainment_school' => isset($_POST['DI_School']) ? $_POST['DI_School'] : '',
  'Educational_Attainment_degree' => isset($_POST['DI_Degree']) ? $_POST['DI_Degree'] : '',
  'DI_Training' => isset($_POST['DI_Accreditation']) ? $_POST['DI_Accreditation'] : '',
  'DI_Training_yrgraduate' => isset($_POST['DI_YearGrad']) ? date('Y-m-d', strtotime($_POST['DI_YearGrad'])) : '',
  'DI_Training_yrTrainingCenter' => isset($_POST['DI_Center']) ? $_POST['DI_Center'] : '',
  'Exp_DI_From' => isset($_POST['DI_FromYear']) ? date('Y-m-d', strtotime($_POST['DI_FromYear'])) : '',
  'Exp_DI_To' => isset($_POST['DI_ToYear']) ? date('Y-m-d', strtotime($_POST['DI_ToYear'])) : '',
  'Di_posisyon' => isset($_POST['DI_Position']) ? $_POST['DI_Position'] : '',
  'Di_driving_school' => isset($_POST['DI_Driving_School']) ? $_POST['DI_Driving_School'] : '',
  'CurrentDL' => isset($_POST['DI_Citizenship']) ? $_POST['DI_Citizenship'] : '',
  'CurrentDL_Expiration' => isset($_POST['DI_DriverLicense']) ? $_POST['DI_DriverLicense'] : '',
  'Username' => isset($_POST['Username']) ? $_POST['Username'] : '',
  'Password' => isset($_POST['DI_pass']) ? $_POST['DI_pass'] : '',
  'AcredNum' => isset($_POST['AcredNum']) ? $_POST['AcredNum'] : '',

  'DL' => isset($dl_path) ? $dl_path : '',
  'DI_profile_pic' => isset($photo_path) ? $photo_path : '',
];


// Prepare the SQL INSERT statement with placeholders
$sql_insert = "INSERT INTO di (
  Lastname, Firstname, Midllename, Suffix, Birthdate, Civil_status, Sex, ContactNumber, Address,
  City, ZipCode, Citizenship, Email, Educational_Attainment, Educational_Attainment_yr,
  Educational_Attainment_school, Educational_Attainment_degree, DI_Training, DI_Training_yrgraduate,
  DI_Training_yrTrainingCenter, Exp_DI_From, Exp_DI_To, Di_posisyon, Di_driving_school, CurrentDL, Accreditation_Number,
  CurrentDL_Expiration, Username, Password, DL, DI_profile_pic
) VALUES (
  :Lastname, :Firstname, :Midllename, :Suffix, :Birthdate, :Civil_status, :Sex, :ContactNumber, :Address,
  :City, :ZipCode, :Citizenship, :Email, :Educational_Attainment, :Educational_Attainment_yr,
  :Educational_Attainment_school, :Educational_Attainment_degree, :DI_Training, :DI_Training_yrgraduate,
  :DI_Training_yrTrainingCenter, :Exp_DI_From, :Exp_DI_To, :Di_posisyon, :Di_driving_school, :CurrentDL, :AcredNum,
  :CurrentDL_Expiration, :Username, :Password, :DL, :DI_profile_pic
)";

$upload_dir = "../../uploads/Di_uploads/";

if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
  $photo_filename = uniqid() . "_" . $_FILES['profile_picture']['name'];
  $photo_path = $upload_dir . $photo_filename;

  if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $photo_path)) {
      $dummy_data['DI_profile_pic'] = $photo_path; 
      echo "<h3>Profile picture uploaded successfully!</h3>";
  } 
}else {
  $dummy_data['DI_profile_pic'] = "../../uploads/Di_uploads/DI_icon.png"; 
  echo "<h3>Failed to upload profile picture!</h3>";
}


// Handle driver's license upload
if (isset($_FILES['DI_DriverLicense']) && $_FILES['DI_DriverLicense']['error'] === UPLOAD_ERR_OK) {
$dl_filename = uniqid() . "_" . $_FILES['DI_DriverLicense']['name'];
$dl_path = $upload_dir . $dl_filename;

if (move_uploaded_file($_FILES['DI_DriverLicense']['tmp_name'], $dl_path)) {
    $dummy_data['DL'] = $dl_path; // Store the file path
    echo "<h3>Driver's license picture uploaded successfully!</h3>";
} else {
    echo "<h3>Failed to upload driver's license picture!</h3>";
}

}
     $stmt = $conn->prepare($sql_insert);


    // Execute the statement
    $stmt->execute($dummy_data);
    echo "<script>console.error('Inserted Di');</script>";

    // Send a success message to the browser console
  } catch (PDOException $e) {
    // Send an error message to the browser console
    echo "<script>console.error('Error: " . $e->getMessage() . "');</script>";
  }
  
  // Close the database connection
  $conn = null;
  ?>
