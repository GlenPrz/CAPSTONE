<!DOCTYPE html>
<html lang="en">
<?php
include "../conn.php";
session_start();

$roleStaff = $_SESSION['role'];
$admin_username = $_SESSION['username'];
//Dito ichecheck if teller or admin. pag teller then magiging none ang value nung $none
$none='';
if ($roleStaff === "Teller") {
          $none='none';
    }


// Eval ALL PDC_Car
//Eval
$sql_num_eval_Q1_PDC_Car = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q1 = 1 and license = 'PDC_Car';";
$stmt_num_evalQ1_PDC_Car = $conn->prepare($sql_num_eval_Q1_PDC_Car);
$stmt_num_evalQ1_PDC_Car->execute();
$data_num_evalQ1_PDC_Car = $stmt_num_evalQ1_PDC_Car->fetchAll(PDO::FETCH_ASSOC);
$row_countQ1_PDC_Car = $data_num_evalQ1_PDC_Car[0]['row_count'];

$sql_num_eval_Q2_PDC_Car = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q1 = 2 and license = 'PDC_Car';";
$stmt_num_evalQ2_PDC_Car = $conn->prepare($sql_num_eval_Q2_PDC_Car);
$stmt_num_evalQ2_PDC_Car->execute();
$data_num_evalQ2_PDC_Car = $stmt_num_evalQ2_PDC_Car->fetchAll(PDO::FETCH_ASSOC);
$row_countQ2_PDC_Car = $data_num_evalQ2_PDC_Car[0]['row_count'];

$sql_num_eval_Q3_PDC_Car = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q1 = 3 and license = 'PDC_Car';";
$stmt_num_evalQ3_PDC_Car = $conn->prepare($sql_num_eval_Q3_PDC_Car);
$stmt_num_evalQ3_PDC_Car->execute();
$data_num_evalQ3_PDC_Car = $stmt_num_evalQ3_PDC_Car->fetchAll(PDO::FETCH_ASSOC);
$row_countQ3_PDC_Car = $data_num_evalQ3_PDC_Car[0]['row_count'];

$sql_num_eval_Q4_PDC_Car = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q1 = 4 and license = 'PDC_Car';";
$stmt_num_evalQ4_PDC_Car = $conn->prepare($sql_num_eval_Q4_PDC_Car);
$stmt_num_evalQ4_PDC_Car->execute();
$data_num_evalQ4_PDC_Car = $stmt_num_evalQ4_PDC_Car->fetchAll(PDO::FETCH_ASSOC);
$row_countQ4_PDC_Car = $data_num_evalQ4_PDC_Car[0]['row_count'];

$sql_num_eval_Q5_PDC_Car = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q1 = 5 and license = 'PDC_Car';";
$stmt_num_evalQ5_PDC_Car = $conn->prepare($sql_num_eval_Q5_PDC_Car);
$stmt_num_evalQ5_PDC_Car->execute();
$data_num_evalQ5_PDC_Car = $stmt_num_evalQ5_PDC_Car->fetchAll(PDO::FETCH_ASSOC);
$row_countQ5_PDC_Car = $data_num_evalQ5_PDC_Car[0]['row_count'];

$sql_num_eval_PDC_Car = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where license = 'PDC_Car'";
$stmt_num_eval_PDC_Car = $conn->prepare($sql_num_eval_PDC_Car);
$stmt_num_eval_PDC_Car->execute();
$data_num_eval_PDC_Car = $stmt_num_eval_PDC_Car->fetchAll(PDO::FETCH_ASSOC);
$row_count_PDC_Car = $data_num_eval_PDC_Car[0]['row_count'];

//Eval

//Eval License Driving School curriculum effectiveness DSLC
$sql_DSLC_Q1_PDC_Car = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q3 = 1 and license = 'PDC_Car';";
$stmt_DSLC_evalQ1_PDC_Car = $conn->prepare($sql_DSLC_Q1_PDC_Car);
$stmt_DSLC_evalQ1_PDC_Car->execute();
$data_DSLC_evalQ1_PDC_Car = $stmt_DSLC_evalQ1_PDC_Car->fetchAll(PDO::FETCH_ASSOC);
$row_count_DSLCQ1_PDC_Car = $data_DSLC_evalQ1_PDC_Car[0]['row_count'];

$sql_DSLC_Q2_PDC_Car = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q3 = 2 and license = 'PDC_Car';";
$stmt_DSLC_evalQ2_PDC_Car = $conn->prepare($sql_DSLC_Q2_PDC_Car);
$stmt_DSLC_evalQ2_PDC_Car->execute();
$data_DSLC_evalQ2_PDC_Car = $stmt_DSLC_evalQ2_PDC_Car->fetchAll(PDO::FETCH_ASSOC);
$row_count_DSLCQ2_PDC_Car = $data_DSLC_evalQ2_PDC_Car[0]['row_count'];

$sql_DSLC_Q3_PDC_Car = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q3 = 3 and license = 'PDC_Car';";
$stmt_DSLC_evalQ3_PDC_Car = $conn->prepare($sql_DSLC_Q3_PDC_Car);
$stmt_DSLC_evalQ3_PDC_Car->execute();
$data_DSLC_evalQ3_PDC_Car = $stmt_DSLC_evalQ3_PDC_Car->fetchAll(PDO::FETCH_ASSOC);
$row_count_DSLCQ3_PDC_Car = $data_DSLC_evalQ3_PDC_Car[0]['row_count'];

$sql_DSLC_Q4_PDC_Car = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q3 = 4 and license = 'PDC_Car';";
$stmt_DSLC_evalQ4_PDC_Car = $conn->prepare($sql_DSLC_Q4_PDC_Car);
$stmt_DSLC_evalQ4_PDC_Car->execute();
$data_DSLC_evalQ4_PDC_Car = $stmt_DSLC_evalQ4_PDC_Car->fetchAll(PDO::FETCH_ASSOC);
$row_count_DSLCQ4_PDC_Car = $data_DSLC_evalQ4_PDC_Car[0]['row_count'];

$sql_DSLC_Q5_PDC_Car = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q3 = 5 and license = 'PDC_Car';";
$stmt_DSLC_evalQ5_PDC_Car = $conn->prepare($sql_DSLC_Q5_PDC_Car);
$stmt_DSLC_evalQ5_PDC_Car->execute();
$data_DSLC_evalQ5_PDC_Car = $stmt_DSLC_evalQ5_PDC_Car->fetchAll(PDO::FETCH_ASSOC);
$row_count_DSLCQ5_PDC_Car = $data_DSLC_evalQ5_PDC_Car[0]['row_count'];

$sql_num_evallicense_PDC_Car = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q3 and license = 'PDC_Car';";
$stmt_num_evallicense_PDC_Car = $conn->prepare($sql_num_evallicense_PDC_Car);
$stmt_num_evallicense_PDC_Car->execute();
$data_num_evallicense_PDC_Car = $stmt_num_evallicense_PDC_Car->fetchAll(PDO::FETCH_ASSOC);
$row_countlicense_PDC_Car = $data_num_evallicense_PDC_Car[0]['row_count'];

$rating_PDC_Car = ((5 * $row_countQ5_PDC_Car) + (4 * $row_countQ4_PDC_Car) + (3 * $row_countQ3_PDC_Car) + (2 * $row_countQ2_PDC_Car) + (1 * $row_countQ1_PDC_Car)) / $row_count_PDC_Car;
$rating_PDC_Car = number_format($rating_PDC_Car, 2);

$Percentage1_PDC_Car = ($row_countQ1_PDC_Car / $row_count_PDC_Car) * 100;
$Percentage2_PDC_Car = ($row_countQ2_PDC_Car / $row_count_PDC_Car) * 100;
$Percentage3_PDC_Car = ($row_countQ3_PDC_Car / $row_count_PDC_Car) * 100;
$Percentage4_PDC_Car = ($row_countQ4_PDC_Car / $row_count_PDC_Car) * 100;
$Percentage5_PDC_Car = ($row_countQ5_PDC_Car / $row_count_PDC_Car) * 100;

$EC_PDC_Car = ((5 * $row_count_DSLCQ5_PDC_Car) + (4 * $row_count_DSLCQ4_PDC_Car) + (3 * $row_count_DSLCQ3_PDC_Car) + (2 * $row_count_DSLCQ2_PDC_Car) + (1 * $row_count_DSLCQ1_PDC_Car)) / $row_countlicense_PDC_Car;
$EC_PDC_Car = number_format($EC_PDC_Car, 2);

$Percentage1EC_PDC_Car = ($row_count_DSLCQ1_PDC_Car / $row_count_PDC_Car) * 100;
$Percentage2EC_PDC_Car = ($row_count_DSLCQ2_PDC_Car / $row_count_PDC_Car) * 100;
$Percentage3EC_PDC_Car = ($row_count_DSLCQ3_PDC_Car / $row_count_PDC_Car) * 100;
$Percentage4EC_PDC_Car = ($row_count_DSLCQ4_PDC_Car / $row_count_PDC_Car) * 100;
$Percentage5EC_PDC_Car = ($row_count_DSLCQ5_PDC_Car / $row_count_PDC_Car) * 100;
//Eval

// Eval ALL PDC_Car





// Eval ALL PDC_Motor
//Eval
$sql_num_eval_Q1_PDC_Motor = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q1 = 1 and license = 'PDC_Motor';";
$stmt_num_evalQ1_PDC_Motor = $conn->prepare($sql_num_eval_Q1_PDC_Motor);
$stmt_num_evalQ1_PDC_Motor->execute();
$data_num_evalQ1_PDC_Motor = $stmt_num_evalQ1_PDC_Motor->fetchAll(PDO::FETCH_ASSOC);
$row_countQ1_PDC_Motor = $data_num_evalQ1_PDC_Motor[0]['row_count'];

$sql_num_eval_Q2_PDC_Motor = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q1 = 2 and license = 'PDC_Motor';";
$stmt_num_evalQ2_PDC_Motor = $conn->prepare($sql_num_eval_Q2_PDC_Motor);
$stmt_num_evalQ2_PDC_Motor->execute();
$data_num_evalQ2_PDC_Motor = $stmt_num_evalQ2_PDC_Motor->fetchAll(PDO::FETCH_ASSOC);
$row_countQ2_PDC_Motor = $data_num_evalQ2_PDC_Motor[0]['row_count'];

$sql_num_eval_Q3_PDC_Motor = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q1 = 3 and license = 'PDC_Motor';";
$stmt_num_evalQ3_PDC_Motor = $conn->prepare($sql_num_eval_Q3_PDC_Motor);
$stmt_num_evalQ3_PDC_Motor->execute();
$data_num_evalQ3_PDC_Motor = $stmt_num_evalQ3_PDC_Motor->fetchAll(PDO::FETCH_ASSOC);
$row_countQ3_PDC_Motor = $data_num_evalQ3_PDC_Motor[0]['row_count'];

$sql_num_eval_Q4_PDC_Motor = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q1 = 4 and license = 'PDC_Motor';";
$stmt_num_evalQ4_PDC_Motor = $conn->prepare($sql_num_eval_Q4_PDC_Motor);
$stmt_num_evalQ4_PDC_Motor->execute();
$data_num_evalQ4_PDC_Motor = $stmt_num_evalQ4_PDC_Motor->fetchAll(PDO::FETCH_ASSOC);
$row_countQ4_PDC_Motor = $data_num_evalQ4_PDC_Motor[0]['row_count'];

$sql_num_eval_Q5_PDC_Motor = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q1 = 5 and license = 'PDC_Motor';";
$stmt_num_evalQ5_PDC_Motor = $conn->prepare($sql_num_eval_Q5_PDC_Motor);
$stmt_num_evalQ5_PDC_Motor->execute();
$data_num_evalQ5_PDC_Motor = $stmt_num_evalQ5_PDC_Motor->fetchAll(PDO::FETCH_ASSOC);
$row_countQ5_PDC_Motor = $data_num_evalQ5_PDC_Motor[0]['row_count'];

$sql_num_eval_PDC_Motor = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where license = 'PDC_Motor'";
$stmt_num_eval_PDC_Motor = $conn->prepare($sql_num_eval_PDC_Motor);
$stmt_num_eval_PDC_Motor->execute();
$data_num_eval_PDC_Motor = $stmt_num_eval_PDC_Motor->fetchAll(PDO::FETCH_ASSOC);
$row_count_PDC_Motor = $data_num_eval_PDC_Motor[0]['row_count'];

//Eval

//Eval License Driving School curriculum effectiveness DSLC
$sql_DSLC_Q1_PDC_Motor = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q3 = 1 and license = 'PDC_Motor';";
$stmt_DSLC_evalQ1_PDC_Motor = $conn->prepare($sql_DSLC_Q1_PDC_Motor);
$stmt_DSLC_evalQ1_PDC_Motor->execute();
$data_DSLC_evalQ1_PDC_Motor = $stmt_DSLC_evalQ1_PDC_Motor->fetchAll(PDO::FETCH_ASSOC);
$row_count_DSLCQ1_PDC_Motor = $data_DSLC_evalQ1_PDC_Motor[0]['row_count'];

$sql_DSLC_Q2_PDC_Motor = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q3 = 2 and license = 'PDC_Motor';";
$stmt_DSLC_evalQ2_PDC_Motor = $conn->prepare($sql_DSLC_Q2_PDC_Motor);
$stmt_DSLC_evalQ2_PDC_Motor->execute();
$data_DSLC_evalQ2_PDC_Motor = $stmt_DSLC_evalQ2_PDC_Motor->fetchAll(PDO::FETCH_ASSOC);
$row_count_DSLCQ2_PDC_Motor = $data_DSLC_evalQ2_PDC_Motor[0]['row_count'];

$sql_DSLC_Q3_PDC_Motor = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q3 = 3 and license = 'PDC_Motor';";
$stmt_DSLC_evalQ3_PDC_Motor = $conn->prepare($sql_DSLC_Q3_PDC_Motor);
$stmt_DSLC_evalQ3_PDC_Motor->execute();
$data_DSLC_evalQ3_PDC_Motor = $stmt_DSLC_evalQ3_PDC_Motor->fetchAll(PDO::FETCH_ASSOC);
$row_count_DSLCQ3_PDC_Motor = $data_DSLC_evalQ3_PDC_Motor[0]['row_count'];

$sql_DSLC_Q4_PDC_Motor = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q3 = 4 and license = 'PDC_Motor';";
$stmt_DSLC_evalQ4_PDC_Motor = $conn->prepare($sql_DSLC_Q4_PDC_Motor);
$stmt_DSLC_evalQ4_PDC_Motor->execute();
$data_DSLC_evalQ4_PDC_Motor = $stmt_DSLC_evalQ4_PDC_Motor->fetchAll(PDO::FETCH_ASSOC);
$row_count_DSLCQ4_PDC_Motor = $data_DSLC_evalQ4_PDC_Motor[0]['row_count'];

$sql_DSLC_Q5_PDC_Motor = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q3 = 5 and license = 'PDC_Motor';";
$stmt_DSLC_evalQ5_PDC_Motor = $conn->prepare($sql_DSLC_Q5_PDC_Motor);
$stmt_DSLC_evalQ5_PDC_Motor->execute();
$data_DSLC_evalQ5_PDC_Motor = $stmt_DSLC_evalQ5_PDC_Motor->fetchAll(PDO::FETCH_ASSOC);
$row_count_DSLCQ5_PDC_Motor = $data_DSLC_evalQ5_PDC_Motor[0]['row_count'];

$sql_num_evallicense_PDC_Motor = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q3 and license = 'PDC_Motor';";
$stmt_num_evallicense_PDC_Motor = $conn->prepare($sql_num_evallicense_PDC_Motor);
$stmt_num_evallicense_PDC_Motor->execute();
$data_num_evallicense_PDC_Motor = $stmt_num_evallicense_PDC_Motor->fetchAll(PDO::FETCH_ASSOC);
$row_countlicense_PDC_Motor = $data_num_evallicense_PDC_Motor[0]['row_count'];

$rating_PDC_Motor = ((5 * $row_countQ5_PDC_Motor) + (4 * $row_countQ4_PDC_Motor) + (3 * $row_countQ3_PDC_Motor) + (2 * $row_countQ2_PDC_Motor) + (1 * $row_countQ1_PDC_Motor)) / $row_count_PDC_Motor;
$rating_PDC_Motor = number_format($rating_PDC_Motor, 2);

$Percentage1_PDC_Motor = ($row_countQ1_PDC_Motor / $row_count_PDC_Motor) * 100;
$Percentage2_PDC_Motor = ($row_countQ2_PDC_Motor / $row_count_PDC_Motor) * 100;
$Percentage3_PDC_Motor = ($row_countQ3_PDC_Motor / $row_count_PDC_Motor) * 100;
$Percentage4_PDC_Motor = ($row_countQ4_PDC_Motor / $row_count_PDC_Motor) * 100;
$Percentage5_PDC_Motor = ($row_countQ5_PDC_Motor / $row_count_PDC_Motor) * 100;

$EC_PDC_Motor = ((5 * $row_count_DSLCQ5_PDC_Motor) + (4 * $row_count_DSLCQ4_PDC_Motor) + (3 * $row_count_DSLCQ3_PDC_Motor) + (2 * $row_count_DSLCQ2_PDC_Motor) + (1 * $row_count_DSLCQ1_PDC_Motor)) / $row_countlicense_PDC_Motor;
$EC_PDC_Motor = number_format($EC_PDC_Motor, 2);

$Percentage1EC_PDC_Motor = ($row_count_DSLCQ1_PDC_Motor / $row_count_PDC_Motor) * 100;
$Percentage2EC_PDC_Motor = ($row_count_DSLCQ2_PDC_Motor / $row_count_PDC_Motor) * 100;
$Percentage3EC_PDC_Motor = ($row_count_DSLCQ3_PDC_Motor / $row_count_PDC_Motor) * 100;
$Percentage4EC_PDC_Motor = ($row_count_DSLCQ4_PDC_Motor / $row_count_PDC_Motor) * 100;
$Percentage5EC_PDC_Motor = ($row_count_DSLCQ5_PDC_Motor / $row_count_PDC_Motor) * 100;
//Eval

// Eval ALL PDC_Motor



// Eval ALL TDC
//Eval
$sql_num_eval_Q1_TDC = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q1 = 1 and license = 'TDC';";
$stmt_num_evalQ1_TDC = $conn->prepare($sql_num_eval_Q1_TDC);
$stmt_num_evalQ1_TDC->execute();
$data_num_evalQ1_TDC = $stmt_num_evalQ1_TDC->fetchAll(PDO::FETCH_ASSOC);
$row_countQ1_TDC = $data_num_evalQ1_TDC[0]['row_count'];

$sql_num_eval_Q2_TDC = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q1 = 2 and license = 'TDC';";
$stmt_num_evalQ2_TDC = $conn->prepare($sql_num_eval_Q2_TDC);
$stmt_num_evalQ2_TDC->execute();
$data_num_evalQ2_TDC = $stmt_num_evalQ2_TDC->fetchAll(PDO::FETCH_ASSOC);
$row_countQ2_TDC = $data_num_evalQ2_TDC[0]['row_count'];

$sql_num_eval_Q3_TDC = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q1 = 3 and license = 'TDC';";
$stmt_num_evalQ3_TDC = $conn->prepare($sql_num_eval_Q3_TDC);
$stmt_num_evalQ3_TDC->execute();
$data_num_evalQ3_TDC = $stmt_num_evalQ3_TDC->fetchAll(PDO::FETCH_ASSOC);
$row_countQ3_TDC = $data_num_evalQ3_TDC[0]['row_count'];

$sql_num_eval_Q4_TDC = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q1 = 4 and license = 'TDC';";
$stmt_num_evalQ4_TDC = $conn->prepare($sql_num_eval_Q4_TDC);
$stmt_num_evalQ4_TDC->execute();
$data_num_evalQ4_TDC = $stmt_num_evalQ4_TDC->fetchAll(PDO::FETCH_ASSOC);
$row_countQ4_TDC = $data_num_evalQ4_TDC[0]['row_count'];

$sql_num_eval_Q5_TDC = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q1 = 5 and license = 'TDC';";
$stmt_num_evalQ5_TDC = $conn->prepare($sql_num_eval_Q5_TDC);
$stmt_num_evalQ5_TDC->execute();
$data_num_evalQ5_TDC = $stmt_num_evalQ5_TDC->fetchAll(PDO::FETCH_ASSOC);
$row_countQ5_TDC = $data_num_evalQ5_TDC[0]['row_count'];


$sql_num_eval_TDC = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where license = 'TDC'";
$stmt_num_eval_TDC = $conn->prepare($sql_num_eval_TDC);
$stmt_num_eval_TDC->execute();
$data_num_eval_TDC = $stmt_num_eval_TDC->fetchAll(PDO::FETCH_ASSOC);
$row_count_TDC = $data_num_eval_TDC[0]['row_count'];

//Eval

//Eval License Driving School curriculum effectiveness DSLC
$sql_DSLC_Q1_TDC = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q3 = 1 and license = 'TDC';";
$stmt_DSLC_evalQ1_TDC = $conn->prepare($sql_DSLC_Q1_TDC);
$stmt_DSLC_evalQ1_TDC->execute();
$data_DSLC_evalQ1_TDC = $stmt_DSLC_evalQ1_TDC->fetchAll(PDO::FETCH_ASSOC);
$row_count_DSLCQ1_TDC = $data_DSLC_evalQ1_TDC[0]['row_count'];

$sql_DSLC_Q2_TDC = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q3 = 2 and license = 'TDC';";
$stmt_DSLC_evalQ2_TDC = $conn->prepare($sql_DSLC_Q2_TDC);
$stmt_DSLC_evalQ2_TDC->execute();
$data_DSLC_evalQ2_TDC = $stmt_DSLC_evalQ2_TDC->fetchAll(PDO::FETCH_ASSOC);
$row_count_DSLCQ2_TDC = $data_DSLC_evalQ2_TDC[0]['row_count'];

$sql_DSLC_Q3_TDC = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q3 = 3 and license = 'TDC';";
$stmt_DSLC_evalQ3_TDC = $conn->prepare($sql_DSLC_Q3_TDC);
$stmt_DSLC_evalQ3_TDC->execute();
$data_DSLC_evalQ3_TDC = $stmt_DSLC_evalQ3_TDC->fetchAll(PDO::FETCH_ASSOC);
$row_count_DSLCQ3_TDC = $data_DSLC_evalQ3_TDC[0]['row_count'];

$sql_DSLC_Q4_TDC = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q3 = 4 and license = 'TDC';";
$stmt_DSLC_evalQ4_TDC = $conn->prepare($sql_DSLC_Q4_TDC);
$stmt_DSLC_evalQ4_TDC->execute();
$data_DSLC_evalQ4_TDC = $stmt_DSLC_evalQ4_TDC->fetchAll(PDO::FETCH_ASSOC);
$row_count_DSLCQ4_TDC = $data_DSLC_evalQ4_TDC[0]['row_count'];

$sql_DSLC_Q5_TDC = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q3 = 5 and license = 'TDC';";
$stmt_DSLC_evalQ5_TDC = $conn->prepare($sql_DSLC_Q5_TDC);
$stmt_DSLC_evalQ5_TDC->execute();
$data_DSLC_evalQ5_TDC = $stmt_DSLC_evalQ5_TDC->fetchAll(PDO::FETCH_ASSOC);
$row_count_DSLCQ5_TDC = $data_DSLC_evalQ5_TDC[0]['row_count'];


$sql_num_evallicense_TDC = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q3 and license = 'TDC';";
$stmt_num_evallicense_TDC = $conn->prepare($sql_num_evallicense_TDC);
$stmt_num_evallicense_TDC->execute();
$data_num_evallicense_TDC = $stmt_num_evallicense_TDC->fetchAll(PDO::FETCH_ASSOC);
$row_countlicense_TDC = $data_num_evallicense_TDC[0]['row_count'];


$rating_TDC = ((5 * $row_countQ5_TDC) + (4 * $row_countQ4_TDC) + (3 * $row_countQ3_TDC) + (2 * $row_countQ2_TDC) + (1 * $row_countQ1_TDC)) / $row_count_TDC;
$rating_TDC = number_format($rating_TDC, 2);

$Percentage1_TDC = ($row_countQ1_TDC/$row_count_TDC) * 100;
$Percentage2_TDC = ($row_countQ2_TDC/$row_count_TDC) * 100;
$Percentage3_TDC = ($row_countQ3_TDC/$row_count_TDC) * 100;
$Percentage4_TDC = ($row_countQ4_TDC/$row_count_TDC) * 100;
$Percentage5_TDC = ($row_countQ5_TDC/$row_count_TDC) * 100;

$EC_TDC = ((5 * $row_count_DSLCQ5_TDC) + (4 * $row_count_DSLCQ4_TDC) + (3 * $row_count_DSLCQ3_TDC) + (2 * $row_count_DSLCQ2_TDC) + (1 * $row_count_DSLCQ1_TDC)) / $row_countlicense_TDC;
$EC_TDC = number_format($EC_TDC, 2);

$Percentage1EC_TDC = ($row_count_DSLCQ1_TDC/$row_count_TDC) * 100;
$Percentage2EC_TDC = ($row_count_DSLCQ2_TDC/$row_count_TDC) * 100;
$Percentage3EC_TDC = ($row_count_DSLCQ3_TDC/$row_count_TDC) * 100;
$Percentage4EC_TDC = ($row_count_DSLCQ4_TDC/$row_count_TDC) * 100;
$Percentage5EC_TDC = ($row_count_DSLCQ5_TDC/$row_count_TDC) * 100;
//Eval


// Eval ALL TDC

//Eval ALL STD
$sql_num_eval_Q1 = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q1 = 1;";
$stmt_num_evalQ1 = $conn->prepare($sql_num_eval_Q1);
$stmt_num_evalQ1->execute();
$data_num_evalQ1 = $stmt_num_evalQ1->fetchAll(PDO::FETCH_ASSOC);
$row_countQ1 = $data_num_evalQ1[0]['row_count'];

$sql_num_eval_Q2 = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q1 = 2;";
$stmt_num_evalQ2 = $conn->prepare($sql_num_eval_Q2);
$stmt_num_evalQ2->execute();
$data_num_evalQ2 = $stmt_num_evalQ2->fetchAll(PDO::FETCH_ASSOC);
$row_countQ2 = $data_num_evalQ2[0]['row_count'];

$sql_num_eval_Q3 = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q1 = 3;";
$stmt_num_evalQ3 = $conn->prepare($sql_num_eval_Q3);
$stmt_num_evalQ3->execute();
$data_num_evalQ3 = $stmt_num_evalQ3->fetchAll(PDO::FETCH_ASSOC);
$row_countQ3 = $data_num_evalQ3[0]['row_count'];

$sql_num_eval_Q4 = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q1 = 4;";
$stmt_num_evalQ4 = $conn->prepare($sql_num_eval_Q4);
$stmt_num_evalQ4->execute();
$data_num_evalQ4 = $stmt_num_evalQ4->fetchAll(PDO::FETCH_ASSOC);
$row_countQ4 = $data_num_evalQ4[0]['row_count'];

$sql_num_eval_Q5 = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q1 = 5;";
$stmt_num_evalQ5 = $conn->prepare($sql_num_eval_Q5);
$stmt_num_evalQ5->execute();
$data_num_evalQ5 = $stmt_num_evalQ5->fetchAll(PDO::FETCH_ASSOC);
$row_countQ5 = $data_num_evalQ5[0]['row_count'];


$sql_num_eval = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb";
$stmt_num_eval = $conn->prepare($sql_num_eval);
$stmt_num_eval->execute();
$data_num_eval = $stmt_num_eval->fetchAll(PDO::FETCH_ASSOC);
$row_count = $data_num_eval[0]['row_count'];

//Eval

//Eval License Driving School curriculum effectiveness DSLC
$sql_DSLC_Q1 = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q3 = 1;";
$stmt_DSLC_evalQ1 = $conn->prepare($sql_DSLC_Q1);
$stmt_DSLC_evalQ1->execute();
$data_DSLC_evalQ1 = $stmt_DSLC_evalQ1->fetchAll(PDO::FETCH_ASSOC);
$row_count_DSLCQ1 = $data_DSLC_evalQ1[0]['row_count'];

$sql_DSLC_Q2 = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q3 = 2;";
$stmt_DSLC_evalQ2 = $conn->prepare($sql_DSLC_Q2);
$stmt_DSLC_evalQ2->execute();
$data_DSLC_evalQ2 = $stmt_DSLC_evalQ2->fetchAll(PDO::FETCH_ASSOC);
$row_count_DSLCQ2 = $data_DSLC_evalQ2[0]['row_count'];

$sql_DSLC_Q3 = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q3 = 3;";
$stmt_DSLC_evalQ3 = $conn->prepare($sql_DSLC_Q3);
$stmt_DSLC_evalQ3->execute();
$data_DSLC_evalQ3 = $stmt_DSLC_evalQ3->fetchAll(PDO::FETCH_ASSOC);
$row_count_DSLCQ3 = $data_DSLC_evalQ3[0]['row_count'];

$sql_DSLC_Q4 = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q3 = 4;";
$stmt_DSLC_evalQ4 = $conn->prepare($sql_DSLC_Q4);
$stmt_DSLC_evalQ4->execute();
$data_DSLC_evalQ4 = $stmt_DSLC_evalQ4->fetchAll(PDO::FETCH_ASSOC);
$row_count_DSLCQ4 = $data_DSLC_evalQ4[0]['row_count'];

$sql_DSLC_Q5 = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q3 = 5;";
$stmt_DSLC_evalQ5 = $conn->prepare($sql_DSLC_Q5);
$stmt_DSLC_evalQ5->execute();
$data_DSLC_evalQ5 = $stmt_DSLC_evalQ5->fetchAll(PDO::FETCH_ASSOC);
$row_count_DSLCQ5 = $data_DSLC_evalQ5[0]['row_count'];


$sql_num_evallicense = "SELECT COUNT(*) AS row_count FROM u896821908_bts.evalres_tb where Q3;";
$stmt_num_evallicense = $conn->prepare($sql_num_evallicense);
$stmt_num_evallicense->execute();
$data_num_evallicense = $stmt_num_evallicense->fetchAll(PDO::FETCH_ASSOC);
$row_countlicense = $data_num_evallicense[0]['row_count'];


$rating = ((5 * $row_countQ5) + (4 * $row_countQ4) + (3 * $row_countQ3) + (2 * $row_countQ2) + (1 * $row_countQ1)) / $row_count;
$rating = number_format($rating, 2);

$Percentage1 = ($row_countQ1/$row_count) * 100;
$Percentage2 = ($row_countQ2/$row_count) * 100;
$Percentage3 = ($row_countQ3/$row_count) * 100;
$Percentage4 = ($row_countQ4/$row_count) * 100;
$Percentage5 = ($row_countQ5/$row_count) * 100;

$EC = ((5 * $row_count_DSLCQ5) + (4 * $row_count_DSLCQ4) + 
(3 * $row_count_DSLCQ3) + (2 * $row_count_DSLCQ2) + (1 * $row_count_DSLCQ1)) / $row_countlicense;
$EC = number_format($EC, 2);

$Percentage1EC = ($row_count_DSLCQ1/$row_count) * 100;
$Percentage2EC = ($row_count_DSLCQ2/$row_count) * 100;
$Percentage3EC = ($row_count_DSLCQ3/$row_count) * 100;
$Percentage4EC = ($row_count_DSLCQ4/$row_count) * 100;
$Percentage5EC = ($row_count_DSLCQ5/$row_count) * 100;
//Eval


?>

<head>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>BTS Driving school</title>
	<link rel="icon" type="image/x-icon" href="../img/favicon.ico">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
    <link href="admin_styles/admin_nav.css" rel="stylesheet">
    <link href="admin_styles/admin_dash.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
  <style>
    .main_content{
      padding: 10px;
      column-gap: 1%;
      padding: 10px;
      display: block;
    }.inside{
      margin-top: 2%;
      display: flex;
      overflow-x: auto;
      column-gap: 1%;
      width: 100%;
    }
    
table {
            width: 100%;
            margin-top: 20px;
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.1);
        }

        th {
          padding: 5px;
            font-size: 24px;
            height: 50px; 

        }

        tr:nth-child(even) {
            
        }
        td{
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: block;
        height: 200px;  
        overflow-y: auto; 
        }
        .star-rating {
      display: inline-block;
    }

    .star-rating input[type="radio"] {
      display: none;
    }

    .star-rating label {
      font-size: 30px;
      color: #ccc;
      float: right;
      cursor: pointer;
    }

    .star-rating input[type="radio"]:checked~label {
      color: #ffcc00;
    }

    .star-rating label:hover,
    .star-rating label:hover~label {
    }.comment {
    white-space: nowrap; /* Prevent the text from wrapping */
    overflow: hidden; /* Hide any overflowing content */
    text-overflow: ellipsis; /* Display an ellipsis (...) for overflowed content */
}

.comment display {
    white-space: normal; /* Allow the text to wrap within the display element */
    max-width: 100%; /* Limit the width of the display element to its container */
}
.positive{
  height: 100%;
  width: 30%;
  overflow-y: auto;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
   flex: 0 0 auto;
}
.positive::-webkit-scrollbar {
    width: 5px; /* Width of the scrollbar */
}
.heading {
  font-size: 25px;
  margin-right: 25px;
}

.fa {
  font-size: 25px;
}

.checked {
  color: orange;
}

/* Three column layout */
.side {
  float: left;
  width: 15%;
  margin-top:10px;
}

.middle {
  margin-top:10px;
  float: left;
  width: 70%;
}

/* Place text to the right */
.right {
  text-align: right;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* The bar container */
.bar-container {
  width: 100%;
  background-color: #f1f1f1;
  text-align: center;
  color: white;
}

/* Individual bars All Std*/
.bar-5 {width: 60%; height: 18px; background-color: #04AA6D;}
.bar-4 {width: 30%; height: 18px; background-color: #2196F3;}
.bar-3 {width: 10%; height: 18px; background-color: #00bcd4;}
.bar-2 {width: 4%; height: 18px; background-color: #ff9800;}
.bar-1 {width: 15%; height: 18px; background-color: #f44336;}

/* Individual bars All TDC*/
.bar-5_TDC {width: 60%; height: 18px; background-color: #04AA6D;}
.bar-4_TDC {width: 30%; height: 18px; background-color: #2196F3;}
.bar-3_TDC {width: 10%; height: 18px; background-color: #00bcd4;}
.bar-2_TDC {width: 4%; height: 18px; background-color: #ff9800;}
.bar-1_TDC {width: 15%; height: 18px; background-color: #f44336;}

.barDS-5_TDC {width: 60%; height: 18px; background-color: #04AA6D;}
.barDS-4_TDC {width: 30%; height: 18px; background-color: #2196F3;}
.barDS-3_TDC {width: 10%; height: 18px; background-color: #00bcd4;}
.barDS-2_TDC {width: 4%; height: 18px; background-color: #ff9800;}
.barDS-1_TDC {width: 15%; height: 18px; background-color: #f44336;}

/* Individual bars All PDC MOTOR*/
.bar-5_PDC_Motor {width: 60%; height: 18px; background-color: #04AA6D;}
.bar-4_PDC_Motor {width: 30%; height: 18px; background-color: #2196F3;}
.bar-3_PDC_Motor {width: 10%; height: 18px; background-color: #00bcd4;}
.bar-2_PDC_Motor {width: 4%; height: 18px; background-color: #ff9800;}
.bar-1_PDC_Motor {width: 15%; height: 18px; background-color: #f44336;}

.barDS-5_PDC_Motor {width: 60%; height: 18px; background-color: #04AA6D;}
.barDS-4_PDC_Motor {width: 30%; height: 18px; background-color: #2196F3;}
.barDS-3_PDC_Motor {width: 10%; height: 18px; background-color: #00bcd4;}
.barDS-2_PDC_Motor {width: 4%; height: 18px; background-color: #ff9800;}
.barDS-1_PDC_Motor {width: 15%; height: 18px; background-color: #f44336;}

/* Individual bars All PDC Car*/
.bar-5_PDC_Car {width: 60%; height: 18px; background-color: #04AA6D;}
.bar-4_PDC_Car {width: 30%; height: 18px; background-color: #2196F3;}
.bar-3_PDC_Car {width: 10%; height: 18px; background-color: #00bcd4;}
.bar-2_PDC_Car {width: 4%; height: 18px; background-color: #ff9800;}
.bar-1_PDC_Car {width: 15%; height: 18px; background-color: #f44336;}

.barDS-5_PDC_Car {width: 60%; height: 18px; background-color: #04AA6D;}
.barDS-4_PDC_Car {width: 30%; height: 18px; background-color: #2196F3;}
.barDS-3_PDC_Car {width: 10%; height: 18px; background-color: #00bcd4;}
.barDS-2_PDC_Car {width: 4%; height: 18px; background-color: #ff9800;}
.barDS-1_PDC_Car {width: 15%; height: 18px; background-color: #f44336;}

/* Responsive layout - make the columns stack on top of each other instead of next to each other */
@media (max-width: 400px) {
  .side, .middle {
    width: 100%;
  }
  .right {
    display: none;
  }
}.rating{
  display: flex;
  column-gap: 2%;
  padding: 10px;
}.Overall{
  width: 50%;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  padding: 20px;

}
/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
.star{
    color:#ffcc00;
}
.positive th .star i {
    font-size: 32px; /* Set the desired font size for the stars */
}
header{
    background-color:#EAFFF1;
}
</style>

<body>
  <div class="nav_admin">
            <nav>
                <center>
                    <div class="logo_container">
                        <img src="../img/bts_logo.png" class="admin_logo">
                    </div>
                    <div class="nav_links">
                        <a href="admin_dash.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        <a href="admin_sched.php"><i class="far fa-calendar"></i> Schedule</a>
                        <a href="admin_enroll.php"><i class="fas fa-user-plus"></i> Enrollment</a>
                        <a href="admin_Pupdate.php" style="Display:<?php echo $none;?>;"><i class="fas fa-bullhorn"></i> Post Updates</a>
                        <a href="admin_reports.php"><i class="fas fa-chart-bar"></i> Reports</a>
                        <a href="admin_Staff.php" style="Display:<?php echo $none;?>;"><i class="fas fa-users"></i> Staff</a>
                        <a href="admin_Assign.php"><i class="fas fa-tasks"></i> Assign</a>
                        <a href="admin_view_feedback.php"><i class="fas fa-comment"></i> View Feedback</a>
                        <a href="admin_module_exam.php" style="Display:<?php echo $none;?>;"><i class="fas fa-book"></i> Module/Exam</a>
                        <a href="" id="logoutLink"><i class="fas fa-sign-out-alt"></i> Log Out</a>
                    </div>
                </center>
            </nav>
        </div>

<div class="main_content">


<div class="tab">
  <button class="tablinks" id="defaultOpen" onclick="openCity(event, 'All')">All Student</button>
  <button class="tablinks" onclick="openCity(event, 'TDC')">TDC Students</button>
  <button class="tablinks" onclick="openCity(event, 'PDC')">PDC Motorcycle Students</button>
  <button class="tablinks" onclick="openCity(event, 'TDCandPDC')">PDC Car Students</button>

</div>

<!--ALL STD-->
<div id="All" class="tabcontent">
<div class="rating">  
<div class="Overall">
  <div class="total">
    <h1>Student Overall Experience</h1>
    <h1><?php echo $rating ?></h1>
    <p>average based on <?php echo $row_count?> reviews.</p>
<hr style="border:3px solid #f1f1f1">

<div class="row">
  <div class="side">
    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-5"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_countQ5 ?></div>
  </div>
  <div class="side">
     <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-4"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_countQ4 ?></div>
  </div>
  <div class="side">
     <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-3"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_countQ3 ?></div>
  </div>
  <div class="side">
    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-2"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_countQ2 ?></div>
  </div>
  <div class="side">
   <div class="star"><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-1"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_countQ1 ?></div>
  </div>
</div>
  </div>
</div>

<!-- sucess rate -->
<div class="Overall">
  <div class="total">
    <h1>Effectiveness of Curriculum</h1>
    <h1><?php echo $EC ?></h1>
    <p>Driving School curriculum effectiveness average based on <?php echo $row_countlicense ?> reviews.</p>
<hr style="border:3px solid #f1f1f1">

<div class="row">
  <div class="side">
    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="barDS-5"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_count_DSLCQ5?></div>
  </div>
  <div class="side">
    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="barDS-4"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_count_DSLCQ4?></div>
  </div>
  <div class="side">
    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="barDS-3"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_count_DSLCQ3?></div>
  </div>
  <div class="side">
    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="barDS-2"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_count_DSLCQ2?></div>
  </div>
  <div class="side">
    <div class="star"><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="barDS-1"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_count_DSLCQ1?></div>
  </div>
</div>
  </div>
</div>
</div>
<div class="inside">
    <!--ALL STD 5-->
  <div class="positive">
    <table>
    <tr>
      <th><header><div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div></header></th>
    </tr>
    <?php
$Positive_Student = "SELECT student_name, Q1, Q4 FROM u896821908_bts.evalres_tb WHERE Q1 = 5";
$stmt_positive = $conn->prepare($Positive_Student);
$stmt_positive->execute();
$Student_positive = $stmt_positive->fetchAll(PDO::FETCH_ASSOC);

echo "<tr>";
foreach ($Student_positive as $row) {
    $studentName = $row['student_name'];
    $Q1Value = $row['Q1'];
    $Q4Value = $row['Q4'];

    // Generate unique IDs and names for each loop iteration
    $randomNumber = rand();
    $star5Id = 'star5' . $studentName . $randomNumber;
    $star4Id = 'star4' . $studentName . $randomNumber;
    $star3Id = 'star3' . $studentName . $randomNumber;
    $star2Id = 'star2' . $studentName . $randomNumber;
    $star1Id = 'star1' . $studentName . $randomNumber;
    $ratingName = 'rating' . $studentName . $randomNumber;

    echo '<td>';
    echo '<label>' . $studentName . '</label><br>';
    echo '<div class="star-rating">';
    echo '<input type="radio" id="' . $star5Id . '" name="' . $ratingName . '" value="5" ' . (($Q1Value == 5) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star5Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star4Id . '" name="' . $ratingName . '" value="4" ' . (($Q1Value == 4) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star4Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star3Id . '" name="' . $ratingName . '" value="3" ' . (($Q1Value == 3) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star3Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star2Id . '" name="' . $ratingName . '" value="2" ' . (($Q1Value == 2) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star2Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star1Id . '" name="' . $ratingName . '" value="1" ' . (($Q1Value == 1) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star1Id . '">&#9733;</label>';
    echo '</div>';
    echo '<div class="comment">';
    echo '<display>' . $Q4Value . '</display>';
    echo '</div>';
    echo '</td>';
}
?>
    </tr>
  </table>
</div>

<!--ALL STD 4 star-->
<div class="positive"><table>
    <tr>
      <th><header><div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div></header></th>
    </tr>
    <?php
$Negative_Student = "SELECT student_name, Q1, Q4 FROM u896821908_bts.evalres_tb WHERE Q1 = 4";
$stmt_negative = $conn->prepare($Negative_Student);
$stmt_negative->execute();
$Student_negative = $stmt_negative->fetchAll(PDO::FETCH_ASSOC);

echo "<tr>";
foreach ($Student_negative as $row) {
    $studentName = $row['student_name'];
    $Q1Value = $row['Q1'];
    $Q4Value = $row['Q4'];

    // Generate unique IDs and names for each loop iteration
    $randomNumber = rand();
    $star5Id = 'star5' . $studentName . $randomNumber;
    $star4Id = 'star4' . $studentName . $randomNumber;
    $star3Id = 'star3' . $studentName . $randomNumber;
    $star2Id = 'star2' . $studentName . $randomNumber;
    $star1Id = 'star1' . $studentName . $randomNumber;
    $ratingName = 'rating' . $studentName . $randomNumber;

    echo '<td>';
    echo '<label>' . $studentName . '</label><br>';
    echo '<div class="star-rating">';
    echo '<input type="radio" id="' . $star5Id . '" name="' . $ratingName . '" value="5" ' . (($Q1Value == 5) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star5Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star4Id . '" name="' . $ratingName . '" value="4" ' . (($Q1Value == 4) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star4Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star3Id . '" name="' . $ratingName . '" value="3" ' . (($Q1Value == 3) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star3Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star2Id . '" name="' . $ratingName . '" value="2" ' . (($Q1Value == 2) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star2Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star1Id . '" name="' . $ratingName . '" value="1" ' . (($Q1Value == 1) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star1Id . '">&#9733;</label>';
    echo '</div>';
    echo '<div class="comment">';
    echo '<display>' . $Q4Value . '</display>';
    echo '</div>';
    echo '</td>';
}
?>
    </tr>
  </table>
</div>
<!--ALL STD 3 star-->
<div class="positive"><table>
    <tr>
      <th><header><div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div></header></th>
    </tr>
    <?php
$Negative_Student = "SELECT student_name, Q1, Q4 FROM u896821908_bts.evalres_tb WHERE Q1 = 3";
$stmt_negative = $conn->prepare($Negative_Student);
$stmt_negative->execute();
$Student_negative = $stmt_negative->fetchAll(PDO::FETCH_ASSOC);

echo "<tr>";
foreach ($Student_negative as $row) {
    $studentName = $row['student_name'];
    $Q1Value = $row['Q1'];
    $Q4Value = $row['Q4'];

    // Generate unique IDs and names for each loop iteration
    $randomNumber = rand();
    $star5Id = 'star5' . $studentName . $randomNumber;
    $star4Id = 'star4' . $studentName . $randomNumber;
    $star3Id = 'star3' . $studentName . $randomNumber;
    $star2Id = 'star2' . $studentName . $randomNumber;
    $star1Id = 'star1' . $studentName . $randomNumber;
    $ratingName = 'rating' . $studentName . $randomNumber;

    echo '<td>';
    echo '<label>' . $studentName . '</label><br>';
    echo '<div class="star-rating">';
    echo '<input type="radio" id="' . $star5Id . '" name="' . $ratingName . '" value="5" ' . (($Q1Value == 5) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star5Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star4Id . '" name="' . $ratingName . '" value="4" ' . (($Q1Value == 4) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star4Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star3Id . '" name="' . $ratingName . '" value="3" ' . (($Q1Value == 3) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star3Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star2Id . '" name="' . $ratingName . '" value="2" ' . (($Q1Value == 2) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star2Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star1Id . '" name="' . $ratingName . '" value="1" ' . (($Q1Value == 1) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star1Id . '">&#9733;</label>';
    echo '</div>';
    echo '<div class="comment">';
    echo '<display>' . $Q4Value . '</display>';
    echo '</div>';
    echo '</td>';
}
?>
    </tr>
  </table>
</div>
<!--ALL STD 2 star-->
<div class="positive"><table>
    <tr>
      <th><header style="background-color: red;"><div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i></div></header></th>
    </tr>
    <?php
$Negative_Student = "SELECT student_name, Q1, Q4 FROM u896821908_bts.evalres_tb WHERE Q1 = 2";
$stmt_negative = $conn->prepare($Negative_Student);
$stmt_negative->execute();
$Student_negative = $stmt_negative->fetchAll(PDO::FETCH_ASSOC);

echo "<tr>";
foreach ($Student_negative as $row) {
    $studentName = $row['student_name'];
    $Q1Value = $row['Q1'];
    $Q4Value = $row['Q4'];

    // Generate unique IDs and names for each loop iteration
    $randomNumber = rand();
    $star5Id = 'star5' . $studentName . $randomNumber;
    $star4Id = 'star4' . $studentName . $randomNumber;
    $star3Id = 'star3' . $studentName . $randomNumber;
    $star2Id = 'star2' . $studentName . $randomNumber;
    $star1Id = 'star1' . $studentName . $randomNumber;
    $ratingName = 'rating' . $studentName . $randomNumber;

    echo '<td>';
    echo '<label>' . $studentName . '</label><br>';
    echo '<div class="star-rating">';
    echo '<input type="radio" id="' . $star5Id . '" name="' . $ratingName . '" value="5" ' . (($Q1Value == 5) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star5Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star4Id . '" name="' . $ratingName . '" value="4" ' . (($Q1Value == 4) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star4Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star3Id . '" name="' . $ratingName . '" value="3" ' . (($Q1Value == 3) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star3Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star2Id . '" name="' . $ratingName . '" value="2" ' . (($Q1Value == 2) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star2Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star1Id . '" name="' . $ratingName . '" value="1" ' . (($Q1Value == 1) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star1Id . '">&#9733;</label>';
    echo '</div>';
    echo '<div class="comment">';
    echo '<display>' . $Q4Value . '</display>';
    echo '</div>';
    echo '</td>';
}
?>
    </tr>
  </table>
</div>
<!--ALL STD 1 star-->
<div class="positive"><table>
    <tr>
      <th><header style="background-color: red;"><div class="star"><i class="fas fa-star"></i></div></header></th>
    </tr>
    <?php
$Negative_Student = "SELECT student_name, Q1, Q4 FROM u896821908_bts.evalres_tb WHERE Q1 = 1";
$stmt_negative = $conn->prepare($Negative_Student);
$stmt_negative->execute();
$Student_negative = $stmt_negative->fetchAll(PDO::FETCH_ASSOC);

echo "<tr>";
foreach ($Student_negative as $row) {
    $studentName = $row['student_name'];
    $Q1Value = $row['Q1'];
    $Q4Value = $row['Q4'];

    // Generate unique IDs and names for each loop iteration
    $randomNumber = rand();
    $star5Id = 'star5' . $studentName . $randomNumber;
    $star4Id = 'star4' . $studentName . $randomNumber;
    $star3Id = 'star3' . $studentName . $randomNumber;
    $star2Id = 'star2' . $studentName . $randomNumber;
    $star1Id = 'star1' . $studentName . $randomNumber;
    $ratingName = 'rating' . $studentName . $randomNumber;

    echo '<td>';
    echo '<label>' . $studentName . '</label><br>';
    echo '<div class="star-rating">';
    echo '<input type="radio" id="' . $star5Id . '" name="' . $ratingName . '" value="5" ' . (($Q1Value == 5) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star5Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star4Id . '" name="' . $ratingName . '" value="4" ' . (($Q1Value == 4) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star4Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star3Id . '" name="' . $ratingName . '" value="3" ' . (($Q1Value == 3) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star3Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star2Id . '" name="' . $ratingName . '" value="2" ' . (($Q1Value == 2) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star2Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star1Id . '" name="' . $ratingName . '" value="1" ' . (($Q1Value == 1) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star1Id . '">&#9733;</label>';
    echo '</div>';
    echo '<div class="comment">';
    echo '<display>' . $Q4Value . '</display>';
    echo '</div>';
    echo '</td>';
}
?>
    </tr>
  </table>
</div>
</div>
</div>

<!--ALL STD-->

<!--ALL TDC-->
<div id="TDC" class="tabcontent">
    <div class="rating">  
<div class="Overall">
  <div class="total">
    <h1>Student Overall Experience</h1>
    <h1><?php echo $rating_TDC ?></h1>
    <p>average based on <?php echo $row_count_TDC?> reviews.</p>
<hr style="border:3px solid #f1f1f1">

<div class="row">
  <div class="side">
    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-5_TDC"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_countQ5_TDC  ?></div>
  </div>
  <div class="side">
     <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-4_TDC"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_countQ4_TDC ?></div>
  </div>
  <div class="side">
     <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-3_TDC"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_countQ3_TDC ?></div>
  </div>
  <div class="side">
    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-2_TDC"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_countQ2_TDC ?></div>
  </div>
  <div class="side">
   <div class="star"><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-1_TDC"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_countQ1_TDC ?></div>
  </div>
</div>
  </div>
</div>

<!-- sucess rate -->
<div class="Overall">
  <div class="total">
    <h1>Effectiveness of Curriculum</h1>
    <h1><?php echo $EC_TDC ?></h1>
    <p>Driving School curriculum effectiveness average based on <?php echo $row_countlicense_TDC ?> reviews.</p>
<hr style="border:3px solid #f1f1f1">

<div class="row">
  <div class="side">
    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="barDS-5_TDC"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_count_DSLCQ5_TDC ?></div>
  </div>
  <div class="side">
    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="barDS-4_TDC"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_count_DSLCQ4_TDC ?></div>
  </div>
  <div class="side">
    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="barDS-3_TDC"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_count_DSLCQ3_TDC ?></div>
  </div>
  <div class="side">
    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="barDS-2_TDC"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_count_DSLCQ2_TDC ?></div>
  </div>
  <div class="side">
    <div class="star"><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="barDS-1_TDC"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_count_DSLCQ1_TDC ?></div>
  </div>
</div>
  </div>
</div>
</div>
<div class="inside">
<!--ALL TDC 5 Star-->
  <div class="positive">
    <table>
    <tr>
      <th><header><div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div></header></th>
    </tr>
    <?php
$Positive_StudentTDC = "SELECT student_name, Q1, Q4 FROM u896821908_bts.evalres_tb WHERE Q1 = 5 AND license = 'TDC'";
$stmt_positiveTDC = $conn->prepare($Positive_StudentTDC);
$stmt_positiveTDC->execute();
$Student_positiveTDC = $stmt_positiveTDC->fetchAll(PDO::FETCH_ASSOC);

echo "<tr>";
foreach ($Student_positiveTDC as $rowTDC) {
    $studentNameTDC = $rowTDC['student_name'];
    $Q1ValueTDC = $rowTDC['Q1'];
    $Q4ValueTDC = $rowTDC['Q4'];

    // Generate unique IDs and names for each loop iteration
    $randomNumberTDC = rand();
    $star5IdTDC = 'star5' . $studentNameTDC . $randomNumberTDC;
    $star4IdTDC = 'star4' . $studentNameTDC . $randomNumberTDC;
    $star3IdTDC = 'star3' . $studentNameTDC . $randomNumberTDC;
    $star2IdTDC = 'star2' . $studentNameTDC . $randomNumberTDC;
    $star1IdTDC = 'star1' . $studentNameTDC . $randomNumberTDC;
    $ratingNameTDC = 'rating' . $studentNameTDC . $randomNumberTDC;

    echo '<td>';
    echo '<label>' . $studentNameTDC . '</label><br>';
    echo '<div class="star-rating">';
    echo '<input type="radio" id="' . $star5Id . '" name="' . $ratingNameTDC . '" value="5" ' . (($Q1ValueTDC == 5) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star5Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star4Id . '" name="' . $ratingNameTDC . '" value="4" ' . (($Q1ValueTDC == 4) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star4Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star3Id . '" name="' . $ratingNameTDC . '" value="3" ' . (($Q1ValueTDC == 3) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star3Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star2Id . '" name="' . $ratingNameTDC . '" value="2" ' . (($Q1ValueTDC == 2) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star2Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star1Id . '" name="' . $ratingNameTDC . '" value="1" ' . (($Q1ValueTDC == 1) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star1Id . '">&#9733;</label>';
    echo '</div>';
    echo '<div class="comment">';
    echo '<display>' . $Q4ValueTDC . '</display>';
    echo '</div>';
    echo '</td>';
}
?>
    </tr>
  </table>
</div>
<!--ALL TDC 4 Star-->
<div class="positive"><table>
    <tr>
      <th><header><div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div></header></th>
    </tr>
    <?php
$Negative_StudentTDC = "SELECT student_name, Q1, Q4 FROM u896821908_bts.evalres_tb WHERE Q1 = 4 AND license = 'TDC'";
$stmt_negativeTDC = $conn->prepare($Negative_StudentTDC);
$stmt_negativeTDC->execute();
$Student_negativeTDC = $stmt_negativeTDC->fetchAll(PDO::FETCH_ASSOC);

echo "<tr>";
foreach ($Student_negativeTDC as $rowTDC) {
    $studentNameTDC = $rowTDC['student_name'];
    $Q1ValueTDC = $rowTDC['Q1'];
    $Q4ValueTDC = $rowTDC['Q4'];

    // Generate unique IDs and names for each loop iteration
    $randomNumberTDC = rand();
    $star5IdTDC = 'star5' . $studentNameTDC . $randomNumberTDC;
    $star4IdTDC = 'star4' . $studentNameTDC . $randomNumberTDC;
    $star3IdTDC = 'star3' . $studentNameTDC . $randomNumberTDC;
    $star2IdTDC = 'star2' . $studentNameTDC . $randomNumberTDC;
    $star1IdTDC = 'star1' . $studentNameTDC . $randomNumberTDC;
    $ratingNameTDC = 'rating' . $studentNameTDC . $randomNumberTDC;

    echo '<td>';
    echo '<label>' . $studentNameTDC . '</label><br>';
    echo '<div class="star-rating">';
    echo '<input type="radio" id="' . $star5Id . '" name="' . $ratingNameTDC . '" value="5" ' . (($Q1ValueTDC == 5) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star5Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star4Id . '" name="' . $ratingNameTDC . '" value="4" ' . (($Q1ValueTDC == 4) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star4Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star3Id . '" name="' . $ratingNameTDC . '" value="3" ' . (($Q1ValueTDC == 3) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star3Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star2Id . '" name="' . $ratingNameTDC . '" value="2" ' . (($Q1ValueTDC == 2) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star2Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star1Id . '" name="' . $ratingNameTDC . '" value="1" ' . (($Q1ValueTDC == 1) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star1Id . '">&#9733;</label>';
    echo '</div>';
    echo '<div class="comment">';
    echo '<display>' . $Q4ValueTDC . '</display>';
    echo '</div>';
    echo '</td>';
}
?>
    </tr>
  </table>
</div>
<!--ALL TDC 3 Star-->
<div class="positive"><table>
    <tr>
      <th><header><div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div></header></th>
    </tr>
    <?php
$Negative_StudentTDC = "SELECT student_name, Q1, Q4 FROM u896821908_bts.evalres_tb WHERE Q1 = 3 AND license = 'TDC'";
$stmt_negativeTDC = $conn->prepare($Negative_StudentTDC);
$stmt_negativeTDC->execute();
$Student_negativeTDC = $stmt_negativeTDC->fetchAll(PDO::FETCH_ASSOC);

echo "<tr>";
foreach ($Student_negativeTDC as $rowTDC) {
    $studentNameTDC = $rowTDC['student_name'];
    $Q1ValueTDC = $rowTDC['Q1'];
    $Q4ValueTDC = $rowTDC['Q4'];

    // Generate unique IDs and names for each loop iteration
    $randomNumberTDC = rand();
    $star5IdTDC = 'star5' . $studentNameTDC . $randomNumberTDC;
    $star4IdTDC = 'star4' . $studentNameTDC . $randomNumberTDC;
    $star3IdTDC = 'star3' . $studentNameTDC . $randomNumberTDC;
    $star2IdTDC = 'star2' . $studentNameTDC . $randomNumberTDC;
    $star1IdTDC = 'star1' . $studentNameTDC . $randomNumberTDC;
    $ratingNameTDC = 'rating' . $studentNameTDC . $randomNumberTDC;

    echo '<td>';
    echo '<label>' . $studentNameTDC . '</label><br>';
    echo '<div class="star-rating">';
    echo '<input type="radio" id="' . $star5Id . '" name="' . $ratingNameTDC . '" value="5" ' . (($Q1ValueTDC == 5) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star5Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star4Id . '" name="' . $ratingNameTDC . '" value="4" ' . (($Q1ValueTDC == 4) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star4Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star3Id . '" name="' . $ratingNameTDC . '" value="3" ' . (($Q1ValueTDC == 3) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star3Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star2Id . '" name="' . $ratingNameTDC . '" value="2" ' . (($Q1ValueTDC == 2) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star2Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star1Id . '" name="' . $ratingNameTDC . '" value="1" ' . (($Q1ValueTDC == 1) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star1Id . '">&#9733;</label>';
    echo '</div>';
    echo '<div class="comment">';
    echo '<display>' . $Q4ValueTDC . '</display>';
    echo '</div>';
    echo '</td>';
}
?>
    </tr>
  </table>
</div>
<!--ALL TDC 2 Star-->
<div class="positive"><table>
    <tr>
      <th><header style="background-color: red;"><div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i></div></header></th>
    </tr>
    <?php
$Negative_StudentTDC = "SELECT student_name, Q1, Q4 FROM u896821908_bts.evalres_tb WHERE Q1 = 2 AND license = 'TDC'";
$stmt_negativeTDC = $conn->prepare($Negative_StudentTDC);
$stmt_negativeTDC->execute();
$Student_negativeTDC = $stmt_negativeTDC->fetchAll(PDO::FETCH_ASSOC);

echo "<tr>";
foreach ($Student_negativeTDC as $rowTDC) {
    $studentNameTDC = $rowTDC['student_name'];
    $Q1ValueTDC = $rowTDC['Q1'];
    $Q4ValueTDC = $rowTDC['Q4'];

    // Generate unique IDs and names for each loop iteration
    $randomNumberTDC = rand();
    $star5IdTDC = 'star5' . $studentNameTDC . $randomNumberTDC;
    $star4IdTDC = 'star4' . $studentNameTDC . $randomNumberTDC;
    $star3IdTDC = 'star3' . $studentNameTDC . $randomNumberTDC;
    $star2IdTDC = 'star2' . $studentNameTDC . $randomNumberTDC;
    $star1IdTDC = 'star1' . $studentNameTDC . $randomNumberTDC;
    $ratingNameTDC = 'rating' . $studentNameTDC . $randomNumberTDC;

    echo '<td>';
    echo '<label>' . $studentNameTDC . '</label><br>';
    echo '<div class="star-rating">';
    echo '<input type="radio" id="' . $star5Id . '" name="' . $ratingNameTDC . '" value="5" ' . (($Q1ValueTDC == 5) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star5Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star4Id . '" name="' . $ratingNameTDC . '" value="4" ' . (($Q1ValueTDC == 4) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star4Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star3Id . '" name="' . $ratingNameTDC . '" value="3" ' . (($Q1ValueTDC == 3) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star3Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star2Id . '" name="' . $ratingNameTDC . '" value="2" ' . (($Q1ValueTDC == 2) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star2Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star1Id . '" name="' . $ratingNameTDC . '" value="1" ' . (($Q1ValueTDC == 1) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star1Id . '">&#9733;</label>';
    echo '</div>';
    echo '<div class="comment">';
    echo '<display>' . $Q4ValueTDC . '</display>';
    echo '</div>';
    echo '</td>';
}
?>
    </tr>
  </table>
</div>
<!--ALL TDC 1 Star-->
<div class="positive"><table>
    <tr>
      <th><header style="background-color: red;"><div class="star"><i class="fas fa-star"></i></div></header></th>
    </tr>
    <?php
$Negative_StudentTDC = "SELECT student_name, Q1, Q4 FROM u896821908_bts.evalres_tb WHERE Q1 = 1 AND license = 'TDC'";
$stmt_negativeTDC = $conn->prepare($Negative_StudentTDC);
$stmt_negativeTDC->execute();
$Student_negativeTDC = $stmt_negativeTDC->fetchAll(PDO::FETCH_ASSOC);

echo "<tr>";
foreach ($Student_negativeTDC as $rowTDC) {
    $studentNameTDC = $rowTDC['student_name'];
    $Q1ValueTDC = $rowTDC['Q1'];
    $Q4ValueTDC = $rowTDC['Q4'];

    // Generate unique IDs and names for each loop iteration
    $randomNumberTDC = rand();
    $star5IdTDC = 'star5' . $studentNameTDC . $randomNumberTDC;
    $star4IdTDC = 'star4' . $studentNameTDC . $randomNumberTDC;
    $star3IdTDC = 'star3' . $studentNameTDC . $randomNumberTDC;
    $star2IdTDC = 'star2' . $studentNameTDC . $randomNumberTDC;
    $star1IdTDC = 'star1' . $studentNameTDC . $randomNumberTDC;
    $ratingNameTDC = 'rating' . $studentNameTDC . $randomNumberTDC;

    echo '<td>';
    echo '<label>' . $studentNameTDC . '</label><br>';
    echo '<div class="star-rating">';
    echo '<input type="radio" id="' . $star5Id . '" name="' . $ratingNameTDC . '" value="5" ' . (($Q1ValueTDC == 5) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star5Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star4Id . '" name="' . $ratingNameTDC . '" value="4" ' . (($Q1ValueTDC == 4) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star4Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star3Id . '" name="' . $ratingNameTDC . '" value="3" ' . (($Q1ValueTDC == 3) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star3Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star2Id . '" name="' . $ratingNameTDC . '" value="2" ' . (($Q1ValueTDC == 2) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star2Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star1Id . '" name="' . $ratingNameTDC . '" value="1" ' . (($Q1ValueTDC == 1) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star1Id . '">&#9733;</label>';
    echo '</div>';
    echo '<div class="comment">';
    echo '<display>' . $Q4ValueTDC . '</display>';
    echo '</div>';
    echo '</td>';
}
?>
    </tr>
  </table>
</div>
</div>
</div>
<!--ALL TDC-->


<!--ALL PDC  MOTOR-->
<div id="PDC" class="tabcontent">
    <div class="rating">  
<div class="Overall">
  <div class="total">
    <h1>Student Overall Experience</h1>
    <h1><?php echo $rating_PDC_Motor ?></h1>
    <p>average based on <?php echo $row_count_PDC_Motor ?> reviews.</p>
<hr style="border:3px solid #f1f1f1">

<div class="row">
  <div class="side">
    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-5_PDC_Motor"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_countQ5_PDC_Motor?></div>
  </div>
  <div class="side">
     <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-4_PDC_Motor"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_countQ4_PDC_Motor  ?></div>
  </div>
  <div class="side">
     <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-3_PDC_Motor"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_countQ3_PDC_Motor ?></div>
  </div>
  <div class="side">
    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-2_PDC_Motor"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_countQ2_PDC_Motor ?></div>
  </div>
  <div class="side">
   <div class="star"><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-1_PDC_Motor"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_countQ1_PDC_Motor ?></div>
  </div>
</div>
  </div>
</div>

<!-- sucess rate -->
<div class="Overall">
  <div class="total">
    <h1>Effectiveness of Curriculum</h1>
    <h1><?php echo $EC_PDC_Motor ?></h1>
    <p>Driving School curriculum effectiveness average based on <?php echo $row_countlicense_PDC_Motor ?> reviews.</p>
<hr style="border:3px solid #f1f1f1">

<div class="row">
  <div class="side">
    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="barDS-5_PDC_Motor"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_count_DSLCQ5_PDC_Motor ?></div>
  </div>
  <div class="side">
    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="barDS-4_PDC_Motor"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_count_DSLCQ4_PDC_Motor ?></div>
  </div>
  <div class="side">
    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="barDS-3_PDC_Motor"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_count_DSLCQ3_PDC_Motor ?></div>
  </div>
  <div class="side">
    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="barDS-2_PDC_Motor"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_count_DSLCQ2_PDC_Motor ?></div>
  </div>
  <div class="side">
    <div class="star"><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="barDS-1_PDC_Motor"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_count_DSLCQ1_PDC_Motor ?></div>
  </div>
</div>
  </div>
</div>
</div>
<div class="inside">
    <!--ALL PDC MOTOR 5 star-->
  <div class="positive">
    <table>
    <tr>
      <th><header><div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div></header></th>
    </tr>
    <?php
$Positive_StudentPDC = "SELECT student_name, Q1, Q4 FROM u896821908_bts.evalres_tb WHERE Q1 = 5 AND license = 'PDC_Motor'";
$stmt_positivePDC = $conn->prepare($Positive_StudentPDC);
$stmt_positivePDC->execute();
$Student_positivePDC = $stmt_positivePDC->fetchAll(PDO::FETCH_ASSOC);

echo "<tr>";
foreach ($Student_positivePDC as $rowPDC) {
    $studentNamePDC = $rowPDC['student_name'];
    $Q1ValuePDC = $rowPDC['Q1'];
    $Q4ValuePDC = $rowPDC['Q4'];

    // Generate unique IDs and names for each loop iteration
    $randomNumberPDC = rand();
    $star5IdPDC = 'star5' . $studentNamePDC . $randomNumberPDC;
    $star4IdPDC = 'star4' . $studentNamePDC . $randomNumberPDC;
    $star3IdPDC = 'star3' . $studentNamePDC . $randomNumberPDC;
    $star2IdPDC = 'star2' . $studentNamePDC . $randomNumberPDC;
    $star1IdPDC = 'star1' . $studentNamePDC . $randomNumberPDC;
    $ratingNamePDC = 'rating' . $studentNamePDC . $randomNumberPDC;

    echo '<td>';
    echo '<label>' . $studentNamePDC . '</label><br>';
    echo '<div class="star-rating">';
    echo '<input type="radio" id="' . $star5Id . '" name="' . $ratingNamePDC . '" value="5" ' . (($Q1ValuePDC == 5) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star5Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star4Id . '" name="' . $ratingNamePDC . '" value="4" ' . (($Q1ValuePDC == 4) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star4Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star3Id . '" name="' . $ratingNamePDC . '" value="3" ' . (($Q1ValuePDC == 3) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star3Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star2Id . '" name="' . $ratingNamePDC . '" value="2" ' . (($Q1ValuePDC == 2) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star2Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star1Id . '" name="' . $ratingNamePDC . '" value="1" ' . (($Q1ValuePDC == 1) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star1Id . '">&#9733;</label>';
    echo '</div>';
    echo '<div class="comment">';
    echo '<display>' . $Q4ValuePDC . '</display>';
    echo '</div>';
    echo '</td>';
}
?>



     
    </tr>
  </table>
</div>
<!--ALL PDC MOTOR 4 star-->
<div class="positive"><table>
    <tr>
      <th><header><div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div></header></th>
    </tr>
    <?php
$Negative_StudentPDC = "SELECT student_name, Q1, Q4 FROM u896821908_bts.evalres_tb WHERE Q1 = 4 AND license = 'PDC_Motor'";
$stmt_negativePDC = $conn->prepare($Negative_StudentPDC);
$stmt_negativePDC->execute();
$Student_negativePDC = $stmt_negativePDC->fetchAll(PDO::FETCH_ASSOC);

echo "<tr>";
foreach ($Student_negativePDC as $rowPDC) {
    $studentNamePDC = $rowPDC['student_name'];
    $Q1ValuePDC = $rowPDC['Q1'];
    $Q4ValuePDC = $rowPDC['Q4'];

    // Generate unique IDs and names for each loop iteration
    $randomNumberPDC = rand();
    $star5IdPDC = 'star5' . $studentNamePDC . $randomNumberPDC;
    $star4IdPDC = 'star4' . $studentNamePDC . $randomNumberPDC;
    $star3IdPDC = 'star3' . $studentNamePDC . $randomNumberPDC;
    $star2IdPDC = 'star2' . $studentNamePDC . $randomNumberPDC;
    $star1IdPDC = 'star1' . $studentNamePDC . $randomNumberPDC;
    $ratingNamePDC = 'rating' . $studentNamePDC . $randomNumberPDC;

    echo '<td>';
    echo '<label>' . $studentNamePDC . '</label><br>';
    echo '<div class="star-rating">';
    echo '<input type="radio" id="' . $star5Id . '" name="' . $ratingNamePDC . '" value="5" ' . (($Q1ValuePDC == 5) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star5Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star4Id . '" name="' . $ratingNamePDC . '" value="4" ' . (($Q1ValuePDC == 4) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star4Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star3Id . '" name="' . $ratingNamePDC . '" value="3" ' . (($Q1ValuePDC == 3) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star3Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star2Id . '" name="' . $ratingNamePDC . '" value="2" ' . (($Q1ValuePDC == 2) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star2Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star1Id . '" name="' . $ratingNamePDC . '" value="1" ' . (($Q1ValuePDC == 1) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star1Id . '">&#9733;</label>';
    echo '</div>';
    echo '<div class="comment">';
    echo '<display>' . $Q4ValuePDC . '</display>';
    echo '</div>';
    echo '</td>';
}
?>
    </tr>
  </table>
</div>
<!--ALL PDC MOTOR 3 star-->
<div class="positive"><table>
    <tr>
      <th><header><div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div></header></th>
    </tr>
    <?php
$Negative_StudentPDC = "SELECT student_name, Q1, Q4 FROM u896821908_bts.evalres_tb WHERE Q1 = 3 AND license = 'PDC_Motor'";
$stmt_negativePDC = $conn->prepare($Negative_StudentPDC);
$stmt_negativePDC->execute();
$Student_negativePDC = $stmt_negativePDC->fetchAll(PDO::FETCH_ASSOC);

echo "<tr>";
foreach ($Student_negativePDC as $rowPDC) {
    $studentNamePDC = $rowPDC['student_name'];
    $Q1ValuePDC = $rowPDC['Q1'];
    $Q4ValuePDC = $rowPDC['Q4'];

    // Generate unique IDs and names for each loop iteration
    $randomNumberPDC = rand();
    $star5IdPDC = 'star5' . $studentNamePDC . $randomNumberPDC;
    $star4IdPDC = 'star4' . $studentNamePDC . $randomNumberPDC;
    $star3IdPDC = 'star3' . $studentNamePDC . $randomNumberPDC;
    $star2IdPDC = 'star2' . $studentNamePDC . $randomNumberPDC;
    $star1IdPDC = 'star1' . $studentNamePDC . $randomNumberPDC;
    $ratingNamePDC = 'rating' . $studentNamePDC . $randomNumberPDC;

    echo '<td>';
    echo '<label>' . $studentNamePDC . '</label><br>';
    echo '<div class="star-rating">';
    echo '<input type="radio" id="' . $star5Id . '" name="' . $ratingNamePDC . '" value="5" ' . (($Q1ValuePDC == 5) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star5Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star4Id . '" name="' . $ratingNamePDC . '" value="4" ' . (($Q1ValuePDC == 4) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star4Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star3Id . '" name="' . $ratingNamePDC . '" value="3" ' . (($Q1ValuePDC == 3) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star3Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star2Id . '" name="' . $ratingNamePDC . '" value="2" ' . (($Q1ValuePDC == 2) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star2Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star1Id . '" name="' . $ratingNamePDC . '" value="1" ' . (($Q1ValuePDC == 1) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star1Id . '">&#9733;</label>';
    echo '</div>';
    echo '<div class="comment">';
    echo '<display>' . $Q4ValuePDC . '</display>';
    echo '</div>';
    echo '</td>';
}
?>
    </tr>
  </table>
</div>
<!--ALL PDC MOTOR 2 star-->
<div class="positive"><table>
    <tr>
      <th><header style="background-color: red;"><div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i></div></header></th>
    </tr>
    <?php
$Negative_StudentPDC = "SELECT student_name, Q1, Q4 FROM u896821908_bts.evalres_tb WHERE Q1 = 2 AND license = 'PDC_Motor'";
$stmt_negativePDC = $conn->prepare($Negative_StudentPDC);
$stmt_negativePDC->execute();
$Student_negativePDC = $stmt_negativePDC->fetchAll(PDO::FETCH_ASSOC);

echo "<tr>";
foreach ($Student_negativePDC as $rowPDC) {
    $studentNamePDC = $rowPDC['student_name'];
    $Q1ValuePDC = $rowPDC['Q1'];
    $Q4ValuePDC = $rowPDC['Q4'];

    // Generate unique IDs and names for each loop iteration
    $randomNumberPDC = rand();
    $star5IdPDC = 'star5' . $studentNamePDC . $randomNumberPDC;
    $star4IdPDC = 'star4' . $studentNamePDC . $randomNumberPDC;
    $star3IdPDC = 'star3' . $studentNamePDC . $randomNumberPDC;
    $star2IdPDC = 'star2' . $studentNamePDC . $randomNumberPDC;
    $star1IdPDC = 'star1' . $studentNamePDC . $randomNumberPDC;
    $ratingNamePDC = 'rating' . $studentNamePDC . $randomNumberPDC;

    echo '<td>';
    echo '<label>' . $studentNamePDC . '</label><br>';
    echo '<div class="star-rating">';
    echo '<input type="radio" id="' . $star5Id . '" name="' . $ratingNamePDC . '" value="5" ' . (($Q1ValuePDC == 5) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star5Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star4Id . '" name="' . $ratingNamePDC . '" value="4" ' . (($Q1ValuePDC == 4) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star4Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star3Id . '" name="' . $ratingNamePDC . '" value="3" ' . (($Q1ValuePDC == 3) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star3Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star2Id . '" name="' . $ratingNamePDC . '" value="2" ' . (($Q1ValuePDC == 2) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star2Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star1Id . '" name="' . $ratingNamePDC . '" value="1" ' . (($Q1ValuePDC == 1) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star1Id . '">&#9733;</label>';
    echo '</div>';
    echo '<div class="comment">';
    echo '<display>' . $Q4ValuePDC . '</display>';
    echo '</div>';
    echo '</td>';
}
?>
    </tr>
  </table>
</div>
<!--ALL PDC MOTOR 1 star-->
<div class="positive"><table>
    <tr>
      <th><header style="background-color: red;"><div class="star"><i class="fas fa-star"></i></div></header></th>
    </tr>
    <?php
$Negative_StudentPDC = "SELECT student_name, Q1, Q4 FROM u896821908_bts.evalres_tb WHERE Q1 = 1 AND license = 'PDC_Motor'";
$stmt_negativePDC = $conn->prepare($Negative_StudentPDC);
$stmt_negativePDC->execute();
$Student_negativePDC = $stmt_negativePDC->fetchAll(PDO::FETCH_ASSOC);

echo "<tr>";
foreach ($Student_negativePDC as $rowPDC) {
    $studentNamePDC = $rowPDC['student_name'];
    $Q1ValuePDC = $rowPDC['Q1'];
    $Q4ValuePDC = $rowPDC['Q4'];

    // Generate unique IDs and names for each loop iteration
    $randomNumberPDC = rand();
    $star5IdPDC = 'star5' . $studentNamePDC . $randomNumberPDC;
    $star4IdPDC = 'star4' . $studentNamePDC . $randomNumberPDC;
    $star3IdPDC = 'star3' . $studentNamePDC . $randomNumberPDC;
    $star2IdPDC = 'star2' . $studentNamePDC . $randomNumberPDC;
    $star1IdPDC = 'star1' . $studentNamePDC . $randomNumberPDC;
    $ratingNamePDC = 'rating' . $studentNamePDC . $randomNumberPDC;

    echo '<td>';
    echo '<label>' . $studentNamePDC . '</label><br>';
    echo '<div class="star-rating">';
    echo '<input type="radio" id="' . $star5Id . '" name="' . $ratingNamePDC . '" value="5" ' . (($Q1ValuePDC == 5) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star5Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star4Id . '" name="' . $ratingNamePDC . '" value="4" ' . (($Q1ValuePDC == 4) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star4Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star3Id . '" name="' . $ratingNamePDC . '" value="3" ' . (($Q1ValuePDC == 3) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star3Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star2Id . '" name="' . $ratingNamePDC . '" value="2" ' . (($Q1ValuePDC == 2) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star2Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star1Id . '" name="' . $ratingNamePDC . '" value="1" ' . (($Q1ValuePDC == 1) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star1Id . '">&#9733;</label>';
    echo '</div>';
    echo '<div class="comment">';
    echo '<display>' . $Q4ValuePDC . '</display>';
    echo '</div>';
    echo '</td>';
}
?>
    </tr>
  </table>
</div>
</div>
</div>
<!--ALL PDC MOTOR-->


<!--ALL PDC CAR-->
<div id="TDCandPDC" class="tabcontent">
<div class="rating">  
<div class="Overall">
  <div class="total">
    <h1>Student Overall Experience</h1>
    <h1><?php echo $rating_PDC_Car ?></h1>
    <p>average based on <?php echo $row_count_PDC_Car?> reviews.</p>
<hr style="border:3px solid #f1f1f1">

<div class="row">
  <div class="side">
    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-5_PDC_Car"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_countQ5_PDC_Car ?></div>
  </div>
  <div class="side">
     <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-4_PDC_Car"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_countQ4_PDC_Car ?></div>
  </div>
  <div class="side">
     <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-3_PDC_Car"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_countQ3_PDC_Car ?></div>
  </div>
  <div class="side">
    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-2_PDC_Car"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_countQ2_PDC_Car ?></div>
  </div>
  <div class="side">
   <div class="star"><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="bar-1_PDC_Car"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_countQ1_PDC_Car ?></div>
  </div>
</div>
  </div>
</div>

<!-- sucess rate -->
<div class="Overall">
  <div class="total">
    <h1>Effectiveness of Curriculum</h1>
    <h1><?php echo $EC_PDC_Car ?></h1>
    <p>Driving School curriculum effectiveness average based on <?php echo $row_countlicense_PDC_Car ?> reviews.</p>
<hr style="border:3px solid #f1f1f1">

<div class="row">
  <div class="side">
    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="barDS-5_PDC_Car"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_count_DSLCQ5_PDC_Car ?></div>
  </div>
  <div class="side">
    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="barDS-4_PDC_Car"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_count_DSLCQ4_PDC_Car ?></div>
  </div>
  <div class="side">
    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="barDS-3_PDC_Car"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_count_DSLCQ3_PDC_Car ?></div>
  </div>
  <div class="side">
    <div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="barDS-2_PDC_Car"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_count_DSLCQ2_PDC_Car ?></div>
  </div>
  <div class="side">
    <div class="star"><i class="fas fa-star"></i></div>
  </div>
  <div class="middle">
    <div class="bar-container">
      <div class="barDS-1_PDC_Car"></div>
    </div>
  </div>
  <div class="side right">
    <div><?php echo $row_count_DSLCQ1_PDC_Car ?></div>
  </div>
</div>
  </div>
</div>
</div>
<div class="inside">
    <!--ALL PDC CAR 5 STAR-->
  <div class="positive">
    <table>
    <tr>
      <th><header><div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div></header></th>
    </tr>
    <?php
$Positive_StudentPDCandTDC = "SELECT student_name, Q1, Q4 FROM u896821908_bts.evalres_tb WHERE Q1 = 5 AND license = 'PDC_Car'";
$stmt_positivePDCandTDC = $conn->prepare($Positive_StudentPDCandTDC);
$stmt_positivePDCandTDC->execute();
$Student_positivePDCandTDC = $stmt_positivePDCandTDC->fetchAll(PDO::FETCH_ASSOC);

echo "<tr>";
foreach ($Student_positivePDCandTDC as $rowPDCandTDC) {
    $studentNamePDCandTDC = $rowPDCandTDC['student_name'];
    $Q1ValuePDCandTDC = $rowPDCandTDC['Q1'];
    $Q4ValuePDCandTDC = $rowPDCandTDC['Q4'];

    // Generate unique IDs and names for each loop iteration
    $randomNumberPDCandTDC = rand();
    $star5IdPDCandTDC = 'star5' . $studentNamePDCandTDC . $randomNumberPDCandTDC;
    $star4IdPDCandTDC = 'star4' . $studentNamePDCandTDC . $randomNumberPDCandTDC;
    $star3IdPDCandTDC = 'star3' . $studentNamePDCandTDC . $randomNumberPDCandTDC;
    $star2IdPDCandTDC = 'star2' . $studentNamePDCandTDC . $randomNumberPDCandTDC;
    $star1IdPDCandTDC = 'star1' . $studentNamePDCandTDC . $randomNumberPDCandTDC;
    $ratingNamePDCandTDC = 'rating' . $studentNamePDCandTDC . $randomNumberPDCandTDC;

    echo '<td>';
    echo '<label>' . $studentNamePDCandTDC . '</label><br>';
    echo '<div class="star-rating">';
    echo '<input type="radio" id="' . $star5Id . '" name="' . $ratingNamePDCandTDC . '" value="5" ' . (($Q1ValuePDCandTDC == 5) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star5Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star4Id . '" name="' . $ratingNamePDCandTDC . '" value="4" ' . (($Q1ValuePDCandTDC == 4) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star4Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star3Id . '" name="' . $ratingNamePDCandTDC . '" value="3" ' . (($Q1ValuePDCandTDC == 3) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star3Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star2Id . '" name="' . $ratingNamePDCandTDC . '" value="2" ' . (($Q1ValuePDCandTDC == 2) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star2Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star1Id . '" name="' . $ratingNamePDCandTDC . '" value="1" ' . (($Q1ValuePDCandTDC == 1) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star1Id . '">&#9733;</label>';
    echo '</div>';
    echo '<div class="comment">';
    echo '<display>' . $Q4ValuePDCandTDC . '</display>';
    echo '</div>';
    echo '</td>';
}
?>



     
    </tr>
  </table>
</div>
<!--ALL PDC CAR 4 Star-->
<div class="positive"><table>
    <tr>
      <th><header><div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div></header></th>
    </tr>
    <?php
$Negative_StudentPDCandTDC = "SELECT student_name, Q1, Q4 FROM u896821908_bts.evalres_tb WHERE Q1 = 4 AND license = 'PDC_Car'";
$stmt_negativePDCandTDC = $conn->prepare($Negative_StudentPDCandTDC);
$stmt_negativePDCandTDC->execute();
$Student_negativePDCandTDC = $stmt_negativePDCandTDC->fetchAll(PDO::FETCH_ASSOC);

echo "<tr>";
foreach ($Student_negativePDCandTDC as $rowPDCandTDC) {
    $studentNamePDCandTDC = $rowPDCandTDC['student_name'];
    $Q1ValuePDCandTDC = $rowPDCandTDC['Q1'];
    $Q4ValuePDCandTDC = $rowPDCandTDC['Q4'];

    // Generate unique IDs and names for each loop iteration
    $randomNumberPDCandTDC = rand();
    $star5IdPDCandTDC = 'star5' . $studentNamePDCandTDC . $randomNumberPDCandTDC;
    $star4IdPDCandTDC = 'star4' . $studentNamePDCandTDC . $randomNumberPDCandTDC;
    $star3IdPDCandTDC = 'star3' . $studentNamePDCandTDC . $randomNumberPDCandTDC;
    $star2IdPDCandTDC = 'star2' . $studentNamePDCandTDC . $randomNumberPDCandTDC;
    $star1IdPDCandTDC = 'star1' . $studentNamePDCandTDC . $randomNumberPDCandTDC;
    $ratingNamePDCandTDC = 'rating' . $studentNamePDCandTDC . $randomNumberPDCandTDC;

    echo '<td>';
    echo '<label>' . $studentNamePDCandTDC . '</label><br>';
    echo '<div class="star-rating">';
    echo '<input type="radio" id="' . $star5Id . '" name="' . $ratingNamePDCandTDC . '" value="5" ' . (($Q1ValuePDCandTDC == 5) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star5Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star4Id . '" name="' . $ratingNamePDCandTDC . '" value="4" ' . (($Q1ValuePDCandTDC == 4) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star4Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star3Id . '" name="' . $ratingNamePDCandTDC . '" value="3" ' . (($Q1ValuePDCandTDC == 3) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star3Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star2Id . '" name="' . $ratingNamePDCandTDC . '" value="2" ' . (($Q1ValuePDCandTDC == 2) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star2Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star1Id . '" name="' . $ratingNamePDCandTDC . '" value="1" ' . (($Q1ValuePDCandTDC == 1) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star1Id . '">&#9733;</label>';
    echo '</div>';
    echo '<div class="comment">';
    echo '<display>' . $Q4ValuePDCandTDC . '</display>';
    echo '</div>';
    echo '</td>';
}
?>
    </tr>
  </table>
</div>
<!--ALL PDC CAR 3 Star-->
<div class="positive"><table>
    <tr>
      <th><header><div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div></header></th>
    </tr>
    <?php
$Negative_StudentPDCandTDC = "SELECT student_name, Q1, Q4 FROM u896821908_bts.evalres_tb WHERE Q1 = 3 AND license = 'PDC_Car'";
$stmt_negativePDCandTDC = $conn->prepare($Negative_StudentPDCandTDC);
$stmt_negativePDCandTDC->execute();
$Student_negativePDCandTDC = $stmt_negativePDCandTDC->fetchAll(PDO::FETCH_ASSOC);

echo "<tr>";
foreach ($Student_negativePDCandTDC as $rowPDCandTDC) {
    $studentNamePDCandTDC = $rowPDCandTDC['student_name'];
    $Q1ValuePDCandTDC = $rowPDCandTDC['Q1'];
    $Q4ValuePDCandTDC = $rowPDCandTDC['Q4'];

    // Generate unique IDs and names for each loop iteration
    $randomNumberPDCandTDC = rand();
    $star5IdPDCandTDC = 'star5' . $studentNamePDCandTDC . $randomNumberPDCandTDC;
    $star4IdPDCandTDC = 'star4' . $studentNamePDCandTDC . $randomNumberPDCandTDC;
    $star3IdPDCandTDC = 'star3' . $studentNamePDCandTDC . $randomNumberPDCandTDC;
    $star2IdPDCandTDC = 'star2' . $studentNamePDCandTDC . $randomNumberPDCandTDC;
    $star1IdPDCandTDC = 'star1' . $studentNamePDCandTDC . $randomNumberPDCandTDC;
    $ratingNamePDCandTDC = 'rating' . $studentNamePDCandTDC . $randomNumberPDCandTDC;

    echo '<td>';
    echo '<label>' . $studentNamePDCandTDC . '</label><br>';
    echo '<div class="star-rating">';
    echo '<input type="radio" id="' . $star5Id . '" name="' . $ratingNamePDCandTDC . '" value="5" ' . (($Q1ValuePDCandTDC == 5) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star5Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star4Id . '" name="' . $ratingNamePDCandTDC . '" value="4" ' . (($Q1ValuePDCandTDC == 4) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star4Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star3Id . '" name="' . $ratingNamePDCandTDC . '" value="3" ' . (($Q1ValuePDCandTDC == 3) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star3Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star2Id . '" name="' . $ratingNamePDCandTDC . '" value="2" ' . (($Q1ValuePDCandTDC == 2) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star2Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star1Id . '" name="' . $ratingNamePDCandTDC . '" value="1" ' . (($Q1ValuePDCandTDC == 1) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star1Id . '">&#9733;</label>';
    echo '</div>';
    echo '<div class="comment">';
    echo '<display>' . $Q4ValuePDCandTDC . '</display>';
    echo '</div>';
    echo '</td>';
}
?>
    </tr>
  </table>
</div>
<!--ALL PDC CAR 2 Star-->
<div class="positive"><table>
    <tr>
      <th><header style="background-color: red;"><div class="star"><i class="fas fa-star"></i><i class="fas fa-star"></i></div></header></th>
    </tr>
    <?php
$Negative_StudentPDCandTDC = "SELECT student_name, Q1, Q4 FROM u896821908_bts.evalres_tb WHERE Q1 = 2 AND license = 'PDC_Car'";
$stmt_negativePDCandTDC = $conn->prepare($Negative_StudentPDCandTDC);
$stmt_negativePDCandTDC->execute();
$Student_negativePDCandTDC = $stmt_negativePDCandTDC->fetchAll(PDO::FETCH_ASSOC);

echo "<tr>";
foreach ($Student_negativePDCandTDC as $rowPDCandTDC) {
    $studentNamePDCandTDC = $rowPDCandTDC['student_name'];
    $Q1ValuePDCandTDC = $rowPDCandTDC['Q1'];
    $Q4ValuePDCandTDC = $rowPDCandTDC['Q4'];

    // Generate unique IDs and names for each loop iteration
    $randomNumberPDCandTDC = rand();
    $star5IdPDCandTDC = 'star5' . $studentNamePDCandTDC . $randomNumberPDCandTDC;
    $star4IdPDCandTDC = 'star4' . $studentNamePDCandTDC . $randomNumberPDCandTDC;
    $star3IdPDCandTDC = 'star3' . $studentNamePDCandTDC . $randomNumberPDCandTDC;
    $star2IdPDCandTDC = 'star2' . $studentNamePDCandTDC . $randomNumberPDCandTDC;
    $star1IdPDCandTDC = 'star1' . $studentNamePDCandTDC . $randomNumberPDCandTDC;
    $ratingNamePDCandTDC = 'rating' . $studentNamePDCandTDC . $randomNumberPDCandTDC;

    echo '<td>';
    echo '<label>' . $studentNamePDCandTDC . '</label><br>';
    echo '<div class="star-rating">';
    echo '<input type="radio" id="' . $star5Id . '" name="' . $ratingNamePDCandTDC . '" value="5" ' . (($Q1ValuePDCandTDC == 5) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star5Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star4Id . '" name="' . $ratingNamePDCandTDC . '" value="4" ' . (($Q1ValuePDCandTDC == 4) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star4Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star3Id . '" name="' . $ratingNamePDCandTDC . '" value="3" ' . (($Q1ValuePDCandTDC == 3) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star3Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star2Id . '" name="' . $ratingNamePDCandTDC . '" value="2" ' . (($Q1ValuePDCandTDC == 2) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star2Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star1Id . '" name="' . $ratingNamePDCandTDC . '" value="1" ' . (($Q1ValuePDCandTDC == 1) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star1Id . '">&#9733;</label>';
    echo '</div>';
    echo '<div class="comment">';
    echo '<display>' . $Q4ValuePDCandTDC . '</display>';
    echo '</div>';
    echo '</td>';
}
?>
    </tr>
  </table>
</div>
<!--ALL PDC CAR 1 Star-->
<div class="positive"><table>
    <tr>
      <th><header style="background-color: red;"><div class="star"><i class="fas fa-star"></i></div></header></th>
    </tr>
    <?php
$Negative_StudentPDCandTDC = "SELECT student_name, Q1, Q4 FROM u896821908_bts.evalres_tb WHERE Q1 = 1 AND license = 'PDC_Car'";
$stmt_negativePDCandTDC = $conn->prepare($Negative_StudentPDCandTDC);
$stmt_negativePDCandTDC->execute();
$Student_negativePDCandTDC = $stmt_negativePDCandTDC->fetchAll(PDO::FETCH_ASSOC);

echo "<tr>";
foreach ($Student_negativePDCandTDC as $rowPDCandTDC) {
    $studentNamePDCandTDC = $rowPDCandTDC['student_name'];
    $Q1ValuePDCandTDC = $rowPDCandTDC['Q1'];
    $Q4ValuePDCandTDC = $rowPDCandTDC['Q4'];

    // Generate unique IDs and names for each loop iteration
    $randomNumberPDCandTDC = rand();
    $star5IdPDCandTDC = 'star5' . $studentNamePDCandTDC . $randomNumberPDCandTDC;
    $star4IdPDCandTDC = 'star4' . $studentNamePDCandTDC . $randomNumberPDCandTDC;
    $star3IdPDCandTDC = 'star3' . $studentNamePDCandTDC . $randomNumberPDCandTDC;
    $star2IdPDCandTDC = 'star2' . $studentNamePDCandTDC . $randomNumberPDCandTDC;
    $star1IdPDCandTDC = 'star1' . $studentNamePDCandTDC . $randomNumberPDCandTDC;
    $ratingNamePDCandTDC = 'rating' . $studentNamePDCandTDC . $randomNumberPDCandTDC;

    echo '<td>';
    echo '<label>' . $studentNamePDCandTDC . '</label><br>';
    echo '<div class="star-rating">';
    echo '<input type="radio" id="' . $star5Id . '" name="' . $ratingNamePDCandTDC . '" value="5" ' . (($Q1ValuePDCandTDC == 5) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star5Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star4Id . '" name="' . $ratingNamePDCandTDC . '" value="4" ' . (($Q1ValuePDCandTDC == 4) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star4Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star3Id . '" name="' . $ratingNamePDCandTDC . '" value="3" ' . (($Q1ValuePDCandTDC == 3) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star3Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star2Id . '" name="' . $ratingNamePDCandTDC . '" value="2" ' . (($Q1ValuePDCandTDC == 2) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star2Id . '">&#9733;</label>';
    echo '<input type="radio" id="' . $star1Id . '" name="' . $ratingNamePDCandTDC . '" value="1" ' . (($Q1ValuePDCandTDC == 1) ? 'checked' : '') . ' disabled>';
    echo '<label for="' . $star1Id . '">&#9733;</label>';
    echo '</div>';
    echo '<div class="comment">';
    echo '<display>' . $Q4ValuePDCandTDC . '</display>';
    echo '</div>';
    echo '</td>';
}
?>
    </tr>
  </table>
</div>
</div>
</div>

<!--ALL PDC And TDC-->

</div>

<script>

window.onload = function() {
  // Simulate a click on the "All Student" button when the page loads
  document.getElementById("defaultOpen").click();
};

function openCity(evt, course) {
  // Your existing openCity function remains unchanged
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(course).style.display = "block";
  evt.currentTarget.className += " active";
}


</script>
  <?php
  // ALL STD
  echo '<script>';
  echo 'document.querySelector(".bar-1").style.width = "' . $Percentage1 . '%";';
  echo 'document.querySelector(".bar-2").style.width = "' . $Percentage2 . '%";';
  echo 'document.querySelector(".bar-3").style.width = "' . $Percentage3 . '%";';
  echo 'document.querySelector(".bar-4").style.width = "' . $Percentage4 . '%";';
  echo 'document.querySelector(".bar-5").style.width = "' . $Percentage5 . '%";';
  echo '</script>';
  
  echo '<script>';
  echo 'document.querySelector(".barDS-1").style.width = "' . $Percentage1EC . '%";';
  echo 'document.querySelector(".barDS-2").style.width = "' . $Percentage2EC . '%";';
  echo 'document.querySelector(".barDS-3").style.width = "' . $Percentage3EC . '%";';
  echo 'document.querySelector(".barDS-4").style.width = "' . $Percentage4EC . '%";';
  echo 'document.querySelector(".barDS-5").style.width = "' . $Percentage5EC . '%";';
  echo '</script>';
  // ALL STD
  
  // ALL TDC
  echo '<script>';
  echo 'document.querySelector(".bar-1_TDC").style.width = "' . $Percentage1_TDC . '%";';
  echo 'document.querySelector(".bar-2_TDC").style.width = "' . $Percentage2_TDC . '%";';
  echo 'document.querySelector(".bar-3_TDC").style.width = "' . $Percentage3_TDC . '%";';
  echo 'document.querySelector(".bar-4_TDC").style.width = "' . $Percentage4_TDC . '%";';
  echo 'document.querySelector(".bar-5_TDC").style.width = "' . $Percentage5_TDC . '%";';
  echo '</script>';
  
  echo '<script>';
  echo 'document.querySelector(".barDS-1_TDC").style.width = "' . $Percentage1EC_TDC . '%";';
  echo 'document.querySelector(".barDS-2_TDC").style.width = "' . $Percentage2EC_TDC . '%";';
  echo 'document.querySelector(".barDS-3_TDC").style.width = "' . $Percentage3EC_TDC . '%";';
  echo 'document.querySelector(".barDS-4_TDC").style.width = "' . $Percentage4EC_TDC . '%";';
  echo 'document.querySelector(".barDS-5_TDC").style.width = "' . $Percentage5EC_TDC . '%";';
  echo '</script>';
  
  // ALL STD
  
  // ALL PDC_Motor
  echo '<script>';
  echo 'document.querySelector(".bar-1_PDC_Motor").style.width = "' . $Percentage1_PDC_Motor . '%";';
  echo 'document.querySelector(".bar-2_PDC_Motor").style.width = "' . $Percentage2_PDC_Motor . '%";';
  echo 'document.querySelector(".bar-3_PDC_Motor").style.width = "' . $Percentage3_PDC_Motor . '%";';
  echo 'document.querySelector(".bar-4_PDC_Motor").style.width = "' . $Percentage4_PDC_Motor . '%";';
  echo 'document.querySelector(".bar-5_PDC_Motor").style.width = "' . $Percentage5_PDC_Motor . '%";';
  echo '</script>';
  
  echo '<script>';
  echo 'document.querySelector(".barDS-1_PDC_Motor").style.width = "' . $Percentage1EC_PDC_Motor . '%";';
  echo 'document.querySelector(".barDS-2_PDC_Motor").style.width = "' . $Percentage2EC_PDC_Motor . '%";';
  echo 'document.querySelector(".barDS-3_PDC_Motor").style.width = "' . $Percentage3EC_PDC_Motor . '%";';
  echo 'document.querySelector(".barDS-4_PDC_Motor").style.width = "' . $Percentage4EC_PDC_Motor . '%";';
  echo 'document.querySelector(".barDS-5_PDC_Motor").style.width = "' . $Percentage5EC_PDC_Motor . '%";';
  echo '</script>';
  
    // ALL PDC_Motor


 // ALL PDC_Car
  echo '<script>';
  echo 'document.querySelector(".bar-1_PDC_Car").style.width = "' . $Percentage1_PDC_Car . '%";';
  echo 'document.querySelector(".bar-2_PDC_Car").style.width = "' . $Percentage2_PDC_Car . '%";';
  echo 'document.querySelector(".bar-3_PDC_Car").style.width = "' . $Percentage3_PDC_Car . '%";';
  echo 'document.querySelector(".bar-4_PDC_Car").style.width = "' . $Percentage4_PDC_Car . '%";';
  echo 'document.querySelector(".bar-5_PDC_Car").style.width = "' . $Percentage5_PDC_Car . '%";';
  echo '</script>';
  
  echo '<script>';
  echo 'document.querySelector(".barDS-1_PDC_Car").style.width = "' . $Percentage1EC_PDC_Car . '%";';
  echo 'document.querySelector(".barDS-2_PDC_Car").style.width = "' . $Percentage2EC_PDC_Car . '%";';
  echo 'document.querySelector(".barDS-3_PDC_Car").style.width = "' . $Percentage3EC_PDC_Car . '%";';
  echo 'document.querySelector(".barDS-4_PDC_Car").style.width = "' . $Percentage4EC_PDC_Car . '%";';
  echo 'document.querySelector(".barDS-5_PDC_Car").style.width = "' . $Percentage5EC_PDC_Car . '%";';
  echo '</script>';
  
    // ALL PDC_Car
    
  ?>
  
</body>

</html>
