<?php
include '../conn.php';

// Get input data and validate it
$msg = $_POST['message'] ?? "";
$contacts = $_POST['ContactNumStd'] ?? "";
$stdIDs = $_POST['SelectedStdID'] ?? "";
$stdNames = $_POST['SelectedStdname'] ?? "";

echo "Message: " . $msg . "<br>";
echo "Contact Numbers: " . $contacts . "<br>";
echo "Student IDs: " . $stdIDs . "<br>";
echo "Student Names: " . $stdNames . "<br>";

// Explode input data
$stdIDArray = explode(',', $stdIDs);
$stdNameArray = explode(',', $stdNames);

// Iterate through input data and insert records into the database
for ($i = 0; $i < count($stdIDArray); $i++) {
    $stdID = $stdIDArray[$i];
    $stdName = $stdNameArray[$i];
    $messagePurpose = $_POST['MsgPurpose'];
    $dateSent = date("Y-m-d H:i:s");

    // Prepare and execute the SQL statement for each iteration
    $sql = "INSERT INTO u896821908_bts.email_sms_history (Std_Id, Std_Name, Message_purpose, Message_body, Date_sent) 
            VALUES (:stdID, :stdName, :messagePurpose, :messageBody, :dateSent)";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    // Bind parameters with values
    $stmt->bindParam(':stdID', $stdID);
    $stmt->bindParam(':stdName', $stdName);
    $stmt->bindParam(':messagePurpose', $messagePurpose);
    $stmt->bindParam(':messageBody', $msg);
    $stmt->bindParam(':dateSent', $dateSent);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record for $stdName inserted successfully!<br>";
    } else {
        echo "Error inserting record for $stdName: " . $stmt->errorInfo()[2] . "<br>";
    }
}
?>

