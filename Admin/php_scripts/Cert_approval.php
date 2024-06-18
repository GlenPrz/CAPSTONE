<?php
include "../../conn.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $studentId = $_POST['student_id'];
    $course = $_POST['course'];



	if ($course === 'TDC'){
		// Update the record in the student table
        $sql = "UPDATE student 
        SET TDC = 'Complete', 
            TDC_Cert_approve = 'released', 
            TDC_Cert_approve_date = CURDATE() 
        WHERE idStudent = :studentId";
        
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':studentId', $studentId);

		// Execute the update
		if ($stmt->execute()) {
			echo '<script>alert("Student can now access the certificate."); history.go(-1);</script>';
                exit;
		} else {
			echo '<script>alert("Student can not access the certificate."); history.go(-1);</script>';
                exit;
		}
	} else if ($course === 'PDC'){
        
        // Update the record in the student table
        $sql = "UPDATE student 
        SET PDC_Cert_approve = 'released', 
            PDC_Cert_approve_date = CURDATE() 
        WHERE idStudent = :studentId";
       $stmt = $conn->prepare($sql);
	   $stmt->bindParam(':studentId', $studentId);
	                
	   if ($stmt->execute()) {
    	echo '<script>alert("Student can now access the certificate."); history.go(-1);</script>';
                           
    	} else {
    	echo '<script>alert("Student can not access the certificate."); history.go(-1);</script>';
    	}    
       }
    } else {
        echo "No results found";
    }
	    
	

		

		
	

?>
