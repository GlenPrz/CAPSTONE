<?php
include "../conn.php";
session_start();
$username = $_SESSION['username'];

try {
    $stmtStudentData = $conn->prepare("SELECT idStudent,Username,Lastname,Firstname FROM student WHERE Username = :username");
    $stmtStudentData->bindParam(':username', $username, PDO::PARAM_STR);
    $stmtStudentData->execute();
    $studentData = $stmtStudentData->fetch(PDO::FETCH_ASSOC);

    if ($studentData) {
        // Access the retrieved columns
        $idStudent = $studentData['idStudent'];
        $STDname = $studentData['Lastname'] . $studentData['Firstname'];

        // Output or use the retrieved data as needed
        echo "Student ID: $idStudent<br>";
        echo "Username: $STDname<br>";
    } else {
        echo "No data found for username: $username";
    }

    
    // Collect form data
    $student_id =  $idStudent; // Student_id field
    $student_name = $STDname; // Student_name field
    $DI_Name = $_POST['data_3']; // Instructor_fname field
    $q1 = $_POST['data_7']; // Q1 field
    $q2 = $_POST['data_9']; // Q2 field
    $q3 = $_POST['data_10']; // Q3 field
    $q4 = $_POST['data_11']; // Q4 field
    $q5 = $_POST['data_12']; // Q5 field
    $q6 = $_POST['data_8']; // Q6 field

    // Prepare and execute the SQL INSERT statement
    $stmt = $conn->prepare("INSERT INTO feedres_tb (Student_id, Student_name, DI_Name, Q1, Q2, Q3, Q4, Q5, Q6) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$student_id, $student_name, $DI_Name, $q1, $q2, $q3, $q4, $q5, $q6]);

    // Echo success message
    echo "Data inserted successfully!";
} catch (PDOException $e) {
    // Handle any errors that occur during the database insertion
    echo "Error: " . $e->getMessage();
}

?>

