<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$vehicleid = $_GET['vehicleid'] ?? 'none';
$Add_Vhcl = $_GET['vehicleAdd'] ?? 'none';
$newevalquesid = $_GET['newevalquesidtest'] ?? 'none';
$evalAdd = $_GET['evalAdd'] ?? 'none';
$voucherid_edit = $_GET['voucherid_edit'] ?? 'none';


$servername = "localhost";
$username = "u896821908_bts";
$password = "a*5E4UEhsHa]";
$dbname = "u896821908_bts";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (isset($voucherid_edit) && $voucherid_edit !== 'none' && !empty($voucherid_edit)) {
            try {
                // Update logic
                $voucher_code = $_POST['voucher_code2'];
                $applied_for = $_POST['applied_for2'];
                $slot = $_POST['slot2'];
                $discount = $_POST['discount2'];
        
                $updateVoucherQuery = "UPDATE disc_voucher SET code=?, applied_for=?, slot=?, discount=? WHERE voucher_id=?";
        
                $stmt_Voucher = $conn->prepare($updateVoucherQuery);
                $stmt_Voucher->bind_param("sssii", $voucher_code, $applied_for, $slot, $discount, $voucherid_edit);
        
                if ($stmt_Voucher->execute()) {
                    echo "Update successful!";
                    header("Location: admin_Pupdate.php?updatedVoucher");
                    exit; // Make sure to exit after the redirect
                } else {
                    echo "Error executing update query: " . $stmt_Voucher->error;
                    exit; // Make sure to exit after displaying the error
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                // Handle the error appropriately, e.g., log it or show a user-friendly message
            }
        }

        if (isset($_POST['deleteVoucher'])) {
            try {
                // Delete logic
                $voucherid = $_POST['deleteVoucher'];
        
                $deleteVoucherQuery = "DELETE FROM disc_voucher WHERE voucher_id = ?";
                $stmt_Voucher = $conn->prepare($deleteVoucherQuery);
                $stmt_Voucher->bind_param("i", $voucherid);
        
                if ($stmt_Voucher->execute()) {
                    echo "Voucher deleted successfully!";
                    // You can echo a message if needed
                } else {
                    echo "Error deleting voucher: " . $stmt_Voucher->error;
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                // Handle the error appropriately, e.g., log it or show a user-friendly message
            }
        }
        
        
        if (isset($_POST['applied_for']) && isset($_POST['slot']) && isset($_POST['discount']) && isset($_POST['voucher_code'])) {
        try {
                $voucherCode = $_POST['voucher_code'];
    
                // Check if voucher code already exists
                $checkVoucherQuery = "SELECT COUNT(*) FROM disc_voucher WHERE code = ?";
                $stmtCheckVoucher = $conn->prepare($checkVoucherQuery);
                $stmtCheckVoucher->bind_param("s", $voucherCode);
                $stmtCheckVoucher->execute();
                $stmtCheckVoucher->bind_result($count);
                $stmtCheckVoucher->fetch();
                $stmtCheckVoucher->close();
    
                if ($count > 0) {
                    // Voucher code already exists, handle the error or redirect as needed
                    header("Location: admin_Pupdate.php?existingVoucher");
                    exit;
                }
    
                // Voucher code doesn't exist, proceed with the insertion
                $appliedFor = $_POST['applied_for'];
                $slot = $_POST['slot'];
                $discount = $_POST['discount'];
                $dateCreated = date("Y-m-d"); // Current date
    
                $insertVoucherQuery = "INSERT INTO disc_voucher (code, applied_for, slot, discount, date_created) VALUES (?, ?, ?, ?, ?)";
    
                $stmtVoucher = $conn->prepare($insertVoucherQuery);
                $stmtVoucher->bind_param("ssiss", $voucherCode, $appliedFor, $slot, $discount, $dateCreated);
    
                if ($stmtVoucher->execute()) {
                    header("Location: admin_Pupdate.php?insertedVoucher");
                    exit; // Make sure to exit after the redirect
                } else {
                    header("Location: admin_Pupdate.php?!insertedVoucher");
                    exit; // Make sure to exit after the redirect
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                // Handle the error appropriately, e.g., log it or show a user-friendly message
            }
        }
        
        
        
        
        if (isset($vehicleid) && $vehicleid !== 'none' && !empty($vehicleid)) {
            try {
                // Update logic
                $Type = $_POST['Type'];
                $vehicle_brand_model = $_POST['vehicle_brand_model'];
    
                $updateVehicleQuery = "UPDATE u896821908_bts.vehicle_tbl SET Type=?, vehicle_brand_model=? WHERE vhcl_id=?";
    
                $stmt_Vehicle = $conn->prepare($updateVehicleQuery);
                $stmt_Vehicle->bind_param("ssi", $Type, $vehicle_brand_model, $vehicleid);
    
                if ($stmt_Vehicle->execute()) {
                    header("Location: admin_Pupdate.php?updatedVehicle");
                    exit; // Make sure to exit after the redirect
                } else {
                    header("Location: admin_Pupdate.php?!updatedVehicle");
                    exit; // Make sure to exit after the redirect
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                // Handle the error appropriately, e.g., log it or show a user-friendly message
            }
        }

        if (isset($Add_Vhcl) && $Add_Vhcl !== 'none' && !empty($Add_Vhcl)) {
            try {
            // Insert logic
            $Type = $_POST['Type'];
            $vehicle_brand = $_POST['vehicle_brand'];
            $vehicle_model = $_POST['vehicle_model'];
            $vehicle_brand_model = $vehicle_brand . ':' . $vehicle_model;

            $insertVehicleQuery = "INSERT INTO u896821908_bts.vehicle_tbl (Type, vehicle_brand_model) VALUES (?, ?)";

            $stmt_Vehicle = $conn->prepare($insertVehicleQuery);
            $stmt_Vehicle->bind_param("ss", $Type, $vehicle_brand_model);

            if ($stmt_Vehicle->execute()) {
                header("Location: admin_Pupdate.php?insertedVehicle");
                exit; // Make sure to exit after the redirect
            } else {
                header("Location: admin_Pupdate.php?!insertedVehicle");
                exit; // Make sure to exit after the redirect
            }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                // Handle the error appropriately, e.g., log it or show a user-friendly message
            }
        }
       
        
        if (isset($_POST['V_id'])) {
            try {
            // Delete logic
            $V_id = $_POST['V_id'];

            $deleteVehicleQuery = "DELETE FROM u896821908_bts.vehicle_tbl WHERE vhcl_id = ?";
            $stmt_Vehicle = $conn->prepare($deleteVehicleQuery);
            $stmt_Vehicle->bind_param("i", $V_id);

            if ($stmt_Vehicle->execute()) {
                header("Location: admin_Pupdate.php?deletedVehicle");
                exit; // Make sure to exit after the redirect
            } else {
                header("Location: admin_Pupdate.php?!deleteFailed");
                exit; // Make sure to exit after the redirect
            }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                // Handle the error appropriately, e.g., log it or show a user-friendly message
            }
        } 
        
          if (isset($newevalquesid) && $newevalquesid !== 'none' && !empty($newevalquesid)) {
              try {
            // Update 
            $Question = $_POST['QuestionEval'];
            $evalid = $newevalquesid;
            
            $updateEvalQuestion = "UPDATE u896821908_bts.Added_evalques_tb SET new_question = ? WHERE new_evalques_id = ?";

            $stmtEvalQuestion = $conn->prepare($updateEvalQuestion);
            $stmtEvalQuestion->bind_param("si", $Question, $evalid);

            if ($stmtEvalQuestion->execute()) {
                header("Location: admin_Pupdate.php?updatedeval");
                exit; // Make sure to exit after the redirect
            } else {
                header("Location: admin_Pupdate.php?!updatedeval");
                exit; // Make sure to exit after the redirect
            }
          } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                // Handle the error appropriately, e.g., log it or show a user-friendly message
            }
        }
          
          
           if (isset($_POST['newevques_id'])) {
            try {
            // Delete logic
            $EV_id = $_POST['newevques_id'];

            $deleteEvaluationQuery = "DELETE FROM u896821908_bts.Added_evalques_tb WHERE new_evalques_id = ?";
            $stmt_Eval = $conn->prepare($deleteEvaluationQuery);
            $stmt_Eval->bind_param("i", $EV_id);

            if ($stmt_Eval->execute()) {
                header("Location: admin_Pupdate.php?deletedeval");
                exit; // Make sure to exit after the redirect
            } else {
                header("Location: admin_Pupdate.php?!deletedeval");
                exit; // Make sure to exit after the redirect
            }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                // Handle the error appropriately, e.g., log it or show a user-friendly message
            }
        } 
        
         if (isset($evalAdd) && $evalAdd !== 'none' && !empty($evalAdd)) {
            try {
            // Insert logic
            $Question = $_POST['QuestionEval'];
            $title = $_POST['Questiontitle'];

            $insertevalQuery = "INSERT INTO u896821908_bts.Added_evalques_tb (title, new_question) VALUES (?, ?)";

            $stmt_eval = $conn->prepare($insertevalQuery);
            $stmt_eval->bind_param("ss", $title, $Question);

            if ($stmt_eval->execute()) {
                header("Location: admin_Pupdate.php?inserteval");
                exit; // Make sure to exit after the redirect
            } else {
                header("Location: admin_Pupdate.php?!inserteval");
                exit; // Make sure to exit after the redirect
            }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                // Handle the error appropriately, e.g., log it or show a user-friendly message
            }
        }
    
}

$conn->close();
?>
