<?php
include "conn.php";
session_start();



$UsernameVouchered = $_POST['UsernameVouchered'];
$voucherType = $_POST['voucherType'];
$voucherCode = $_POST['voucherCode'];

// echo $UsernameVouchered;
// echo $voucherType;
// echo $voucherType;

if ($voucherType == "TDCvoucher") {
    // Assuming $conn is your PDO connection

    $sqltmt = "SELECT applied_for, slot, discount FROM disc_voucher WHERE code = :voucherCode";
    $stmtTDC = $conn->prepare($sqltmt);

    $stmtTDC->bindParam(':voucherCode', $voucherCode, PDO::PARAM_STR);
    $stmtTDC->execute();

    $resultsvoucherCode = $stmtTDC->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($resultsvoucherCode)) {
        foreach ($resultsvoucherCode as $rowTDC) {
            if (strpos($rowTDC['applied_for'], 'PDC') !== false) {
                echo "This voucher is for PDC";
                exit;
            }

            if ($rowTDC['slot'] <= 0) {
                echo "No slot";
                exit;
            } else {
                $getstdidsql = "SELECT idStudent, TDC_VOUCHER FROM student WHERE Username = :username";
                $stmtSTDid = $conn->prepare($getstdidsql);
                $stmtSTDid->bindParam(':username', $UsernameVouchered, PDO::PARAM_STR);
                $stmtSTDid->execute();
                $resultsStdID = $stmtSTDid->fetch(PDO::FETCH_ASSOC);

                if ($resultsStdID) {
                    $STDID = $resultsStdID['idStudent'];
                    $Vouchered = $resultsStdID['TDC_VOUCHER'];

                    $sqlVoucherCheck = "SELECT * FROM voucher_history WHERE std_id = :stdvoucher";
                    $stmtVoucherCheck = $conn->prepare($sqlVoucherCheck);
                    $stmtVoucherCheck->bindParam(':stdvoucher', $STDID, PDO::PARAM_STR);
                    $stmtVoucherCheck->execute();

                    if ($stmtVoucherCheck->rowCount() > 0) {
                        if (!empty($Vouchered)) {
                            echo "Already Have Voucher";
                        } else {
                            $tdc_date_applied = date('Y-m-d H:i:s');

                            $sqlUpdateVoucherHistory = "UPDATE `voucher_history` SET `std_username` = :std_username, `tdc_code` = :tdc_code, `tdc_date_applied` = :tdc_date_applied WHERE `std_id` = :std";
                            $stmtUpdateVoucherHistory = $conn->prepare($sqlUpdateVoucherHistory);

                            $stmtUpdateVoucherHistory->bindParam(':std', $STDID, PDO::PARAM_STR);
                            $stmtUpdateVoucherHistory->bindParam(':std_username', $UsernameVouchered, PDO::PARAM_STR);
                            $stmtUpdateVoucherHistory->bindParam(':tdc_code', $voucherCode, PDO::PARAM_STR);
                            $stmtUpdateVoucherHistory->bindParam(':tdc_date_applied', $tdc_date_applied, PDO::PARAM_STR);
                            $stmtUpdateVoucherHistory->execute();

                        $sqlUpdateStudent = "UPDATE student SET TDC_VOUCHER = 1 WHERE idStudent = :idSTD";
                        $stmtUpdateStudent = $conn->prepare($sqlUpdateStudent);
                        $stmtUpdateStudent->bindParam(':idSTD', $STDID, PDO::PARAM_STR);
                        $stmtUpdateStudent->execute();

                        $sqlUpdateSlot = "UPDATE disc_voucher SET slot = slot - 1 WHERE code = :TDCcode";
                        $stmtUpdateSlot = $conn->prepare($sqlUpdateSlot);
                        $stmtUpdateSlot->bindParam(':TDCcode', $voucherCode, PDO::PARAM_STR);
                        $stmtUpdateSlot->execute();

                            $_SESSION["Discount"] = $rowTDC['discount'];
                            // echo "test".' '.$STDID.' '.$_SESSION["Discount"];
                             echo "Voucher Applied";

                        }
                        
                                                   
                    } else {
                        $tdc_date_applied = date('Y-m-d H:i:s');

                        $sqlInsertVoucherHistory = "INSERT INTO `voucher_history`(`std_id`, `std_username`, `tdc_code`, `tdc_date_applied`) VALUES (:std_id, :std_username, :tdc_code, :tdc_date_applied)";
                        $stmtVoucherHistory = $conn->prepare($sqlInsertVoucherHistory);

                        $stmtVoucherHistory->bindParam(':std_id', $STDID, PDO::PARAM_INT);
                        $stmtVoucherHistory->bindParam(':std_username', $UsernameVouchered, PDO::PARAM_STR);
                        $stmtVoucherHistory->bindParam(':tdc_code', $voucherCode, PDO::PARAM_STR);
                        $stmtVoucherHistory->bindParam(':tdc_date_applied', $tdc_date_applied, PDO::PARAM_STR);

                        $stmtVoucherHistory->execute();

                        $sqlUpdateStudent = "UPDATE student SET TDC_VOUCHER = 1 WHERE idStudent = :idSTD";
                        $stmtUpdateStudent = $conn->prepare($sqlUpdateStudent);
                        $stmtUpdateStudent->bindParam(':idSTD', $STDID, PDO::PARAM_STR);
                        $stmtUpdateStudent->execute();

                        $sqlUpdateSlot = "UPDATE disc_voucher SET slot = slot - 1 WHERE code = :TDCcode";
                        $stmtUpdateSlot = $conn->prepare($sqlUpdateSlot);
                        $stmtUpdateSlot->bindParam(':TDCcode', $voucherCode, PDO::PARAM_STR);
                        $stmtUpdateSlot->execute();



                        $_SESSION["Discount"] = $rowTDC['discount'];
                            // echo "Check".' '.$STDID.' '.$_SESSION["Discount"];
                            echo "Voucher Applied";

                    }
                }
            }
        }
    } else {
        echo "Voucher not found";
    }
}


//PDC

if ($voucherType == "PDCvoucher") {
    session_start();

    // Assuming $conn is your PDO connection

    $sqltmt = "SELECT applied_for, slot, discount FROM disc_voucher WHERE code = :voucherCode";
    $stmtPDC = $conn->prepare($sqltmt);

    $stmtPDC->bindParam(':voucherCode', $voucherCode, PDO::PARAM_STR);
    $stmtPDC->execute();

    $resultsvoucherCode = $stmtPDC->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($resultsvoucherCode)) {
        foreach ($resultsvoucherCode as $rowPDC) {
            if (strpos($rowPDC['applied_for'], 'TDC') !== false) {
                echo "This voucher is for TDC";
                exit;
            }

            if ($rowPDC['slot'] <= 0) {
                echo "No slot";
                exit;
                
            } else {
                $getstdidsql = "SELECT idStudent, PDC_VOUCHER FROM student WHERE Username = :username";
                $stmtSTDid = $conn->prepare($getstdidsql);
                $stmtSTDid->bindParam(':username', $UsernameVouchered, PDO::PARAM_STR);
                $stmtSTDid->execute();
                $resultsStdID = $stmtSTDid->fetch(PDO::FETCH_ASSOC);

                if ($resultsStdID) {
                    $STDID = $resultsStdID['idStudent'];
                    $Vouchered = $resultsStdID['PDC_VOUCHER'];

                    $sqlVoucherCheck = "SELECT * FROM voucher_history WHERE std_id = :stdvoucher";
                    $stmtVoucherCheck = $conn->prepare($sqlVoucherCheck);
                    $stmtVoucherCheck->bindParam(':stdvoucher', $STDID, PDO::PARAM_STR);
                    $stmtVoucherCheck->execute();

                    if ($stmtVoucherCheck->rowCount() > 0) {
                        if (!empty($Vouchered)) {
                            echo "Already Have Voucher";
                        } else {
                            
                            $pdc_date_applied = date('Y-m-d H:i:s');

                            $sqlUpdateVoucherHistory = "UPDATE `voucher_history` SET `std_username` = :std_username, `pdc_code` = :pdc_code, `pdc_date_applied` = :pdc_date_applied WHERE `std_id` = :std";
                            $stmtUpdateVoucherHistory = $conn->prepare($sqlUpdateVoucherHistory);

                            $stmtUpdateVoucherHistory->bindParam(':std', $STDID, PDO::PARAM_STR);
                            $stmtUpdateVoucherHistory->bindParam(':std_username', $UsernameVouchered, PDO::PARAM_STR);
                            $stmtUpdateVoucherHistory->bindParam(':pdc_code', $voucherCode, PDO::PARAM_STR);
                            $stmtUpdateVoucherHistory->bindParam(':pdc_date_applied', $pdc_date_applied, PDO::PARAM_STR);
                            $stmtUpdateVoucherHistory->execute();

                        $sqlUpdateStudent = "UPDATE student SET PDC_VOUCHER = 1 WHERE idStudent = :idSTD";
                        $stmtUpdateStudent = $conn->prepare($sqlUpdateStudent);
                        $stmtUpdateStudent->bindParam(':idSTD', $STDID, PDO::PARAM_STR);
                        $stmtUpdateStudent->execute();

                        $sqlUpdateSlot = "UPDATE disc_voucher SET slot = slot - 1 WHERE code = :PDCcode";
                        $stmtUpdateSlot = $conn->prepare($sqlUpdateSlot);
                        $stmtUpdateSlot->bindParam(':PDCcode', $voucherCode, PDO::PARAM_STR);
                        $stmtUpdateSlot->execute();

                            $_SESSION["Discount"] = $rowPDC['discount'];
                            // echo "test".' '.$STDID.' '.$_SESSION["Discount"];
                             echo "Voucher Applied";

                        }
                        
                                                   
                    } else {
                        $pdc_date_applied = date('Y-m-d H:i:s');

                        $sqlInsertVoucherHistory = "INSERT INTO `voucher_history`(`std_id`, `std_username`, `pdc_code`, `pdc_date_applied`) VALUES (:std_id, :std_username, :pdc_code, :pdc_date_applied)";
                        $stmtVoucherHistory = $conn->prepare($sqlInsertVoucherHistory);

                        $stmtVoucherHistory->bindParam(':std_id', $STDID, PDO::PARAM_INT);
                        $stmtVoucherHistory->bindParam(':std_username', $UsernameVouchered, PDO::PARAM_STR);
                        $stmtVoucherHistory->bindParam(':pdc_code', $voucherCode, PDO::PARAM_STR);
                        $stmtVoucherHistory->bindParam(':pdc_date_applied', $pdc_date_applied, PDO::PARAM_STR);

                        $stmtVoucherHistory->execute();

                        $sqlUpdateStudent = "UPDATE student SET PDC_VOUCHER = 1 WHERE idStudent = :idSTD";
                        $stmtUpdateStudent = $conn->prepare($sqlUpdateStudent);
                        $stmtUpdateStudent->bindParam(':idSTD', $STDID, PDO::PARAM_STR);
                        $stmtUpdateStudent->execute();

                        $sqlUpdateSlot = "UPDATE disc_voucher SET slot = slot - 1 WHERE code = :PDCcode";
                        $stmtUpdateSlot = $conn->prepare($sqlUpdateSlot);
                        $stmtUpdateSlot->bindParam(':PDCcode', $voucherCode, PDO::PARAM_STR);
                        $stmtUpdateSlot->execute();



                        $_SESSION["Discount"] = $rowTDC['discount'];
                            // echo "Check".' '.$STDID.' '.$_SESSION["Discount"];
                            echo "Voucher Applied";

                    }
                }
            }
        }
    } else {
        echo "Voucher not found";
    }
}



?>