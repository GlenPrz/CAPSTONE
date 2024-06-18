<?php
include "../conn.php"; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // echo "<script>console.log(" . ($_POST['SubmitModule1'] ?? '') . ")</script>";
    // echo "<script>console.log(" . ($_POST['SubmitModule2'] ?? '') . ")</script>";
    // echo "<script>console.log(" . ($_POST['SubmitModule3'] ?? '') . ")</script>";

    // MODULE 1 UPDATE
    if (isset($_POST['SubmitModule1']) && $_POST['SubmitModule1'] === '1') {
        if (isset($_FILES['PDFModule1']) && $_FILES['PDFModule1']['error'] === UPLOAD_ERR_OK) {
            $filenamepdf = $_FILES["PDFModule1"]["name"];
            // Specify the desired filename
            $folder = "../../uploads/pdf_modules/" . $filenamepdf;
            // Check if the uploaded file is a PDF
            $file_extension = pathinfo($filenamepdf, PATHINFO_EXTENSION);
            
            if ($file_extension === "pdf") {
                if (move_uploaded_file($_FILES["PDFModule1"]["tmp_name"], $folder)) {
                    // Prepare and execute the SQL update statement
                    $sql = "UPDATE admin_module_exam_pdf SET pdf = ? WHERE idadmin_module_exam_pdf = 1"; // Assuming Module 1 corresponds to ID 1
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(1, $folder); // Store the file path in the database
                    if ($stmt->execute()) {
                        echo "PDF for Module 1 has been uploaded and updated successfully!";
                    } else {
                        echo "Failed to update the database.";
                    }
                } else {
                    echo "Failed to upload PDF.";
                }
            } else {
                echo "Invalid file format. Please upload a PDF file.";
            }
        } else {
            echo "No PDF uploaded or an error occurred.";
        }
    }
    
    //MODULE 2 UPDATE
     if (isset($_POST['SubmitModule2']) && $_POST['SubmitModule2'] === '2') {
        if (isset($_FILES['PDFModule2']) && $_FILES['PDFModule2']['error'] === UPLOAD_ERR_OK) {
            $filenamepdf = $_FILES["PDFModule2"]["name"];
            // Specify the desired filename
            $folder = "../../uploads/pdf_modules/" . $filenamepdf;
            // Check if the uploaded file is a PDF
            $file_extension = pathinfo($filenamepdf, PATHINFO_EXTENSION);
            
            if ($file_extension === "pdf") {
                if (move_uploaded_file($_FILES["PDFModule2"]["tmp_name"], $folder)) {
                    // Prepare and execute the SQL update statement
                    $sql = "UPDATE admin_module_exam_pdf SET pdf = ? WHERE idadmin_module_exam_pdf = 2"; // Assuming Module 1 corresponds to ID 1
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(1, $folder); // Store the file path in the database
                    if ($stmt->execute()) {
                        echo "PDF for Module 2 has been uploaded and updated successfully!";
                    } else {
                        echo "Failed to update the database.";
                    }
                } else {
                    echo "Failed to upload PDF.";
                }
            } else {
                echo "Invalid file format. Please upload a PDF file.";
            }
        } else {
            echo "No PDF uploaded or an error occurred.";
        }
    }

    //MODULE 3 UPDATE
    if (isset($_POST['SubmitModule3']) && $_POST['SubmitModule3'] === '3') {
        if (isset($_FILES['PDFModule3']) && $_FILES['PDFModule3']['error'] === UPLOAD_ERR_OK) {
            $filenamepdf = $_FILES["PDFModule3"]["name"];
            // Specify the desired filename
            $folder = "../../uploads/pdf_modules/" . $filenamepdf;
            // Check if the uploaded file is a PDF
            $file_extension = pathinfo($filenamepdf, PATHINFO_EXTENSION);
            
            if ($file_extension === "pdf") {
                if (move_uploaded_file($_FILES["PDFModule3"]["tmp_name"], $folder)) {
                    // Prepare and execute the SQL update statement
                    $sql = "UPDATE admin_module_exam_pdf SET pdf = ? WHERE idadmin_module_exam_pdf = 3"; // Assuming Module 1 corresponds to ID 1
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(1, $folder); // Store the file path in the database
                    if ($stmt->execute()) {
                        echo "PDF for Module 3 has been uploaded and updated successfully!";
                    } else {
                        echo "Failed to update the database.";
                    }
                } else {
                    echo "Failed to upload PDF.";
                }
            } else {
                echo "Invalid file format. Please upload a PDF file.";
            }
        } else {
            echo "No PDF uploaded or an error occurred.";
        }
    }


} else {
    echo "Invalid request!";
}
?>
