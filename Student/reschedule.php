<?php
include("../conn.php");
?>

<!DOCTYPE html>
<html>

<head>
<title>BTS Driving school</title>
	<link rel="icon" type="image/x-icon" href="../img/favicon.ico">
	<link rel="stylesheet" href="../Student/studentstyle/resched.css">
	</head>

<body>
    <style>
    .notice h2 {
        color:red;
        font-size:35px;
    }
    .notice p {
        font-size:20px;
    }
        .notice {
            color: black;
            padding-left: 30px;
                        padding-right: 30px;
                        padding-bottom: 30px;
                        padding-top: 0px;

            border-radius: 8px;
            text-align: center;
            		box-shadow: 2px 7px 8px rgba(0, 0, 0, 0.2);

        }
        header {
background-color: white;
color: #fff;
padding: 15px;
text-align: center;
margin-top: 1%;
width: 100%;
font-size:25px;
}
    </style>
    <header><h1>Reschedule Information</h1></header>

    <?php
    // Check if the 'id' parameter is present in the URL
    if (isset($_GET['id'])) {
        // Get the ID from the URL
        $id = $_GET['id'];

            //TDC
            $stmtTDC = $conn->prepare("
           SELECT 
                student.idStudent, 
                MAX(student.Username) AS Username, 
                MAX(student.Lastname) AS Lastname, 
                MAX(student.Firstname) AS Firstname, 
                MAX(student.TDC_Cert_approve) AS TDCCert, 
                MAX(student.TDC) AS TDC,         
                MAX(student_schedule_tdc.idstudent_schedule) AS TDC_SchedID, 
                MAX(student_schedule_tdc.Student_Id) AS TDC_StdID, 
                MAX(student_schedule_tdc.schedule1) AS TDCsched1, 
                MAX(student_schedule_tdc.schedule2) AS TDCsched2, 
                MAX(student_schedule_tdc.Time1) AS TDCT1, 
                MAX(student_schedule_tdc.Time2) AS TDCT2
            FROM 
                student
            LEFT JOIN 
                student_schedule_tdc
            ON 
                student.idStudent = student_schedule_tdc.Student_Id         
            WHERE 
                student.idStudent = :id
            GROUP BY 
                student.idStudent;");

        $stmtTDC->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtTDC->execute();
        $resultTDC = $stmtTDC->fetch(PDO::FETCH_ASSOC);
        
            $studentName = $resultTDC['Lastname'] . ' ,' . $resultTDC['Firstname']; 
            $TDCSchedID = $resultTDC['TDC_SchedID'];
            $TDCcourseCert = $resultTDC['TDCCert'];
            $TDCcourse = $resultTDC['TDC'] ?? '';
            $TDCSchedCourse1 = $resultTDC['TDCsched1'];
            $TDCSchedCourse2 = $resultTDC['TDCsched2'];
            $TDCSchedTimeCourse1 = $resultTDC['TDCT1'];
            $TDCSchedTimeCourse2 = $resultTDC['TDCT2'];
            
            //TDC
          
        //PDC CAR   
        
            //PDC - CAR MANUAL
              $stmtPDC_CarManual = $conn->prepare("
            SELECT 
    student.idStudent, 
    student.Username AS Username, 
    student.Lastname AS Lastname, 
    student.Firstname AS Firstname, 
    student.PDC_Cert_approve AS PDCCert, 
    student.`PDC-CAR` AS `PDC-CAR`, 
    student_schedule_pdc.idstudent_schedule AS PDC_SchedIDCarManual, 
    student_schedule_pdc.Student_Id,
    student_schedule_pdc.schedule1 AS PDCsched1, 
    student_schedule_pdc.schedule2 AS PDCsched2, 
    student_schedule_pdc.Time1 AS PDCT1, 
    student_schedule_pdc.Time2 AS PDCT2,
    student_schedule_pdc.PDC_Vechicle AS PDCEnrolled
FROM 
    student       
LEFT JOIN 
    student_schedule_pdc
ON 
    student.idStudent = student_schedule_pdc.Student_Id
     WHERE 
                student.idStudent = :id and student_schedule_pdc.PDC_Vechicle = 'Car_Manual'");

        $stmtPDC_CarManual->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtPDC_CarManual->execute();
        $resultPDC_CarManual = $stmtPDC_CarManual->fetch(PDO::FETCH_ASSOC);
        
            $PDC_CarManualcourse = $resultPDC_CarManual['PDC-CAR'] ?? '';
            $PDC_CarManualSchedCourse1 = $resultPDC_CarManual['PDCsched1'];
            $PDC_CarManualSchedCourse2 = $resultPDC_CarManual['PDCsched2'];
            $PDC_CarManualSchedTimeCourse1 = $resultPDC_CarManual['PDCT1'];
            $PDC_CarManualSchedTimeCourse2 = $resultPDC_CarManual['PDCT2'];
            $PDCEnrolledC_manual = $resultPDC_CarManual['PDCEnrolled'];
            $PDCSchedID_CarManual = $resultPDC_CarManual['PDC_SchedIDCarManual'];
                        $PDC_StdID_CarManual = $resultPDC_CarManual['Student_Id'];



            //PDC - CAR MANUAL
            
            //PDC - CAR AUTO
              $stmtPDC_CarAutomatic = $conn->prepare("
            SELECT 
    student.idStudent, 
    student.Username AS Username, 
    student.Lastname AS Lastname, 
    student.Firstname AS Firstname, 
    student.PDC_Cert_approve AS PDCCert, 
    student.`PDC-CAR` AS `PDC-CAR`, 
    student_schedule_pdc.idstudent_schedule AS PDC_SchedIDCarAuto, 
    student_schedule_pdc.Student_Id,
    student_schedule_pdc.schedule1 AS PDCsched1, 
    student_schedule_pdc.schedule2 AS PDCsched2, 
    student_schedule_pdc.Time1 AS PDCT1, 
    student_schedule_pdc.Time2 AS PDCT2,
    student_schedule_pdc.PDC_Vechicle AS PDCEnrolled
FROM 
    student       
LEFT JOIN 
    student_schedule_pdc
ON 
    student.idStudent = student_schedule_pdc.Student_Id
     WHERE 
                student.idStudent = :id and student_schedule_pdc.PDC_Vechicle = 'Car_Automatic'");

        $stmtPDC_CarAutomatic->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtPDC_CarAutomatic->execute();
        $resultPDC_CarAutomatic = $stmtPDC_CarAutomatic->fetch(PDO::FETCH_ASSOC);
        
            $PDC_CarAutomaticStdID = $resultPDC_CarAutomatic['Student_Id'];
            $PDC_CarAutomaticcourse = $resultPDC_CarAutomatic['PDC-CAR'] ?? '';
            $PDC_CarAutomaticSchedCourse1 = $resultPDC_CarAutomatic['PDCsched1'];
            $PDC_CarAutomaticSchedCourse2 = $resultPDC_CarAutomatic['PDCsched2'];
            $PDC_CarAutomaticSchedTimeCourse1 = $resultPDC_CarAutomatic['PDCT1'];
            $PDC_CarAutomaticSchedTimeCourse2 = $resultPDC_CarAutomatic['PDCT2'];
            $PDCEnrolledC_Automatic = $resultPDC_CarAutomatic['PDCEnrolled'];
            $PDCSchedID_CarAuto = $resultPDC_CarAutomatic['PDC_SchedIDCarAuto'];


            //PDC - CAR AUTO


            //PDC - Motor MANUAL 
       $stmtPDC_Motorcycle_Manual = $conn->prepare("
            SELECT 
    student.idStudent, 
    student.Username AS Username, 
    student.Lastname AS Lastname, 
    student.Firstname AS Firstname, 
    student.PDC_Cert_approve AS PDCCert, 
    student.`PDC-MOTOR` AS `PDC-MOTOR`, 
    student_schedule_pdc.idstudent_schedule AS PDC_SchedIDMotorManual, 
    student_schedule_pdc.Student_Id AS PDC_StdID, 
    student_schedule_pdc.schedule1 AS PDCsched1, 
    student_schedule_pdc.schedule2 AS PDCsched2, 
    student_schedule_pdc.Time1 AS PDCT1, 
    student_schedule_pdc.Time2 AS PDCT2,
    student_schedule_pdc.PDC_Vechicle AS PDC_Vechicle
FROM 
    student       
LEFT JOIN 
    student_schedule_pdc
ON 
    student.idStudent = student_schedule_pdc.Student_Id
     WHERE 
                student.idStudent = :id and student_schedule_pdc.PDC_Vechicle = 'Motorcycle_Manual'");

        $stmtPDC_Motorcycle_Manual->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtPDC_Motorcycle_Manual->execute();
        $resultPDC_Motorcycle_Manual = $stmtPDC_Motorcycle_Manual->fetch(PDO::FETCH_ASSOC);
        
            $PDC_Motorcycle_Manualcourse = $resultPDC_Motorcycle_Manual['PDC-MOTOR'] ?? '';
            $PDC_Motorcycle_ManualSchedCourse1 = $resultPDC_Motorcycle_Manual['PDCsched1'];
            $PDC_Motorcycle_ManualSchedCourse2 = $resultPDC_Motorcycle_Manual['PDCsched2'];
            $PDC_Motorcycle_ManualSchedTimeCourse1 = $resultPDC_Motorcycle_Manual['PDCT1'];
            $PDC_Motorcycle_ManualSchedTimeCourse2 = $resultPDC_Motorcycle_Manual['PDCT2'];
            $PDCEnrolledM_Manual = $resultPDC_Motorcycle_Manual['PDC_Vechicle'];
            $PDCSchedID_Mmanual = $resultPDC_Motorcycle_Manual['PDC_SchedIDMotorManual'];
            $PDC_MmanualStdID = $resultPDC_Motorcycle_Manual['idStudent'];

            //PDC - Motor MANUAL 

            
            //PDC - Motor AUTO 

      $stmtPDC_Motorcycle_Automatic = $conn->prepare("
            SELECT 
    student.idStudent, 
    student.Username AS Username, 
    student.Lastname AS Lastname, 
    student.Firstname AS Firstname, 
    student.PDC_Cert_approve AS PDCCert, 
    student.`PDC-MOTOR` AS `PDC-MOTOR`, 
    student_schedule_pdc.idstudent_schedule AS PDC_SchedIDMotorAuto, 
    student_schedule_pdc.Student_Id AS PDC_StdID, 
    student_schedule_pdc.schedule1 AS PDCsched1, 
    student_schedule_pdc.schedule2 AS PDCsched2, 
    student_schedule_pdc.Time1 AS PDCT1, 
    student_schedule_pdc.Time2 AS PDCT2,
    student_schedule_pdc.PDC_Vechicle AS PDC_Vechicle
FROM 
    student       
LEFT JOIN 
    student_schedule_pdc
ON 
    student.idStudent = student_schedule_pdc.Student_Id
     WHERE 
                student.idStudent = :id and student_schedule_pdc.PDC_Vechicle = 'Motorcycle_Automatic'");

        $stmtPDC_Motorcycle_Automatic->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtPDC_Motorcycle_Automatic->execute();
        $resultPDC_Motorcycle_Automatic = $stmtPDC_Motorcycle_Automatic->fetch(PDO::FETCH_ASSOC);
        
            $PDC_Motorcycle_Automaticcourse = $resultPDC_Motorcycle_Automatic['PDC-MOTOR'] ?? '';
            $PDC_Motorcycle_AutomaticSchedCourse1 = $resultPDC_Motorcycle_Automatic['PDCsched1'];
            $PDC_Motorcycle_AutomaticSchedCourse2 = $resultPDC_Motorcycle_Automatic['PDCsched2'];
            $PDC_Motorcycle_AutomaticSchedTimeCourse1 = $resultPDC_Motorcycle_Automatic['PDCT1'];
            $PDC_Motorcycle_AutomaticSchedTimeCourse2 = $resultPDC_Motorcycle_Automatic['PDCT2'];
            $PDCEnrolledM_Automatic = $resultPDC_Motorcycle_Automatic['PDC_Vechicle'];
            $PDCSchedID_Automatic = $resultPDC_Motorcycle_Automatic['PDC_SchedIDMotorAuto'];
            $PDCStdID_Automatic = $resultPDC_Motorcycle_Automatic['idStudent'];

            //PDC - Motor AUTO 

    ?>
    
<div class = "containerfull">
 <div class="studentinfo">
            <label for="studentName">Student Name:</label>
            <input type="text" id="studentName" name="studentName" value="<?php echo $studentName; ?>" readonly><br><br>

            <label for="studentID">Student ID:</label>
            <input type="text" id="studentID" name="studentID" value="<?php echo $id; ?>" readonly><br><br>

          
            </div>      

            
            
 <div class="studentcoursetable">
 <div class="notice">
        <h2>Important Notice</h2>
        <p>Students are allowed to reschedule their appointments only once. Please plan accordingly.</p>
    </div>
            <table class = 'styled-table'>
                    <thead>

                <tr>
                    <th>Course</th>
                    <th colspan = "4">Current Sched</th>
                    
                    <th>New Sched</th>
                    <th>Actions</th>

                </tr>
                                    </thead>

                <?php
                //TDC RESCHEDULING
if ($TDCcourse != null && $TDCcourseCert == null) {
    
    
   echo "<form id='TDCForm'>";
   
           $formattedTDC = "$TDCSchedCourse1 -- $TDCSchedCourse2 | $TDCSchedTimeCourse1 -- $TDCSchedTimeCourse2";

   
   
echo '<input type="hidden" name="SchedTDC" value="' . $formattedTDC . '">'; // Added hidden input field for TDCSchedID
      echo '<input type="hidden" name="SchedTDCID" value="' . $TDCSchedID . '">'; 

echo '<input type="hidden" name="TDCSchedID" value="' . $id . '">'; // Added hidden input field for TDCSchedID
echo "<tr> <td>TDC</td>";
echo "<td>{$TDCSchedCourse1}</td>";
echo "<td>" . date("h:i A", strtotime($TDCSchedTimeCourse1)) . "</td>";
echo "<td>{$TDCSchedCourse2}</td>";
echo "<td>" . date("h:i A", strtotime($TDCSchedTimeCourse2)) . "</td>";

echo '<td><select class="aviSched" name="sched_tdc" id="available-schedule-tdc1">';

$querySched = "SELECT * FROM tdc_schedule WHERE Slot >= 1";
$stmtSched = $conn->prepare($querySched);
$stmtSched->execute();
$scheduleData = $stmtSched->fetchAll(PDO::FETCH_ASSOC);

if (count($scheduleData) > 0) {
    echo '<option value="" disabled selected hidden>Choose Schedule</option>';
    foreach ($scheduleData as $row) {
        $formattedOption = "{$row['schedule1']} -- {$row['schedule2']} | {$row['time1']} -- {$row['time2']}";
        echo "<option>{$formattedOption}</option>";
    }
} else {
    echo '<option value="" disabled>No slot available</option>';
}

echo '</select></td>';
    echo '<td><button type="submit" form="TDCForm" id="tdcResched">Update</button></td>';
echo "</tr>"; // Added closing </tr> tag
echo "</form>";



}else{
    echo "<tr>
    <td>TDC</td>
    <td colspan='6' style='text-align: center;'>COMPLETED</td>
    </tr>";
}
                //TDC RESCHEDULING

                //PDC RESCHEDULING
                
// CAR MANUAL
if ($PDC_CarManualcourse != null) {
    echo "<form id='PDCForm_CarManual'>";
    
               $formattedPDC_CarManual = "$PDC_CarManualSchedCourse1 -- $PDC_CarManualSchedCourse2 | $PDC_CarManualSchedTimeCourse1 -- $PDC_CarManualSchedTimeCourse2";

    
    echo '<input type="hidden" name="SchedPDC_CarManua" value="' . $formattedPDC_CarManual . '">'; 
    echo '<input type="hidden" name="PDCSchedID_CarManual" value="' . $PDCSchedID_CarManual . '">';
        echo '<input type="hidden" name="StdIDPDC" value="' . $PDC_StdID_CarManual . '">';

    echo "<tr> <td>PDC:{$PDCEnrolledC_manual}</td>";
    echo "<td>{$PDC_CarManualSchedCourse1}</td>";
    echo "<td>" . date("h:i A", strtotime($PDC_CarManualSchedTimeCourse1)) . "</td>";
    echo "<td>{$PDC_CarManualSchedCourse2}</td>";
    echo "<td>" . date("h:i A", strtotime($PDC_CarManualSchedTimeCourse2)) . "</td>";
    
    echo '<td><select class="aviSched" name="sched_Car_Manual" id="available-schedule-pdc1">';
    
    $querySched = "SELECT * FROM pdc_schedule WHERE Slot >= 1";
    $stmtSched = $conn->prepare($querySched);
    $stmtSched->execute();
    $scheduleData = $stmtSched->fetchAll(PDO::FETCH_ASSOC);

    if (count($scheduleData) > 0) {
        echo '<option value="" disabled selected hidden>Choose Schedule</option>';
        foreach ($scheduleData as $row) {
            $formattedOption = "{$row['schedule1']} -- {$row['schedule2']} | {$row['time1']} -- {$row['time2']}";
            echo "<option>{$formattedOption}</option>";
        }
    } else {
        echo '<option value="" disabled>No slot available</option>';
    }

    echo '</select></td>';
    echo '<td><button type="submit" form="PDCForm_CarManual" id="PdcReschedPDCcarManual">Update</button></td>';
    echo "</tr>"; // Added closing </tr> tag
    echo "</form>";
}

                //CAR MANUAL
                
                //CAR AUTOMATIC
  if ($PDC_CarAutomaticcourse != null) {
    echo "<form id='PDCForm_CarAutomatic'>";
    
                   $formattedPDC_CarAutomatic = "$PDC_CarAutomaticSchedCourse1 -- $PDC_CarAutomaticSchedCourse2 | $PDC_CarAutomaticSchedTimeCourse1 -- $PDC_CarAutomaticSchedTimeCourse2";

    echo '<input type="hidden" name="SchedPDC_CarAuto" value="' . $formattedPDC_CarAutomatic . '">'; 

    echo '<input type="hidden" name="PDCSchedID_CarAuto" value="' . $PDCSchedID_CarAuto . '">'; 
    
            echo '<input type="hidden" name="StdIDPDC" value="' . $PDC_CarAutomaticStdID . '">';

    
    echo "<tr> <td>PDC: {$PDCEnrolledC_Automatic}</td>";
    echo "<td>{$PDC_CarAutomaticSchedCourse1}</td>";
    echo "<td>" . date("h:i A", strtotime($PDC_CarAutomaticSchedTimeCourse1)) . "</td>";
    echo "<td>{$PDC_CarAutomaticSchedCourse2}</td>";
    echo "<td>" . date("h:i A", strtotime($PDC_CarAutomaticSchedTimeCourse2)) . "</td>";
    
    echo '<td><select class="aviSched" name="sched_Car_Automatic" id="available-schedule-pdc2">';
    
    $querySched = "SELECT * FROM pdc_schedule WHERE Slot >= 1";
    $stmtSched = $conn->prepare($querySched);
    $stmtSched->execute();
    $scheduleData = $stmtSched->fetchAll(PDO::FETCH_ASSOC);

    if (count($scheduleData) > 0) {
        echo '<option value="" disabled selected hidden>Choose Schedule</option>';
        foreach ($scheduleData as $row) {
            $formattedOption = "{$row['schedule1']} -- {$row['schedule2']} | {$row['time1']} -- {$row['time2']}";
            echo "<option>{$formattedOption}</option>";
        }
    } else {
        echo '<option value="" disabled>No slot available</option>';
    }

    echo '</select></td>';
    echo '<td><button type="submit" form="PDCForm_CarAutomatic" id="PdcReschedPDCcarAutomatic">Update</button></td>';
    echo "</tr>"; // Added closing </tr> tag
    echo "</form>";
}

                //CAR AUTOMATIC



                //MOTOR MANUAL
if ($PDC_Motorcycle_Manualcourse != null) {
    echo "<form id='PDCForm_Motorcycle_Manualcourse'>";
    echo '<input type="hidden" name="PDCSchedID_Mmanual" value="' . $PDCSchedID_Mmanual . '">'; // Added hidden input field for PDCSchedCarAutomatic
                echo '<input type="hidden" name="PDCMmanual" value="' . $PDC_MmanualStdID . '">';

    echo "<tr> <td>PDC: {$PDCEnrolledM_Manual}</td>";
    echo "<td>{$PDC_Motorcycle_ManualSchedCourse1}</td>";
    echo "<td>" . date("h:i A", strtotime($PDC_Motorcycle_ManualSchedTimeCourse1)) . "</td>";
    echo "<td>{$PDC_Motorcycle_ManualSchedCourse2}</td>";
    echo "<td>" . date("h:i A", strtotime($PDC_Motorcycle_ManualSchedTimeCourse2)) . "</td>";

    echo '<td><select class="aviSched" name="sched_motor_manual" id="available-schedule-pdc3">';

    $querySched = "SELECT * FROM pdc_schedule WHERE Slot >= 1";
    $stmtSched = $conn->prepare($querySched);
    $stmtSched->execute();
    $scheduleData = $stmtSched->fetchAll(PDO::FETCH_ASSOC);

    if (count($scheduleData) > 0) {
        echo '<option value="" disabled selected hidden>Choose Schedule</option>';
        foreach ($scheduleData as $row) {
            $formattedOption = "{$row['schedule1']} -- {$row['schedule2']} | {$row['time1']} -- {$row['time2']}";
            echo "<option>{$formattedOption}</option>";
        }
    } else {
        echo '<option value="" disabled>No slot available</option>';
    }

    echo '</select></td>';
    echo '<td><button type="submit" form="PDCForm_Motorcycle_Manualcourse" id="PdcReschedPDCMmotor">Update</button></td>';
    echo "</tr>"; // Added closing </tr> tag
    echo "</form>";
}

                //MOTOR MANUAL

 //MOTOR Automatic
   if ($PDC_Motorcycle_Automaticcourse != null) {
    echo "<form id='PDCForm_Motorcycle_Automaticcourse'>";
    echo '<input type="hidden" name="PDCSchedM_auto" value="' . $PDCSchedID_Automatic . '">';
        echo '<input type="hidden" name="PDCStdIdM_auto" value="' . $PDCStdID_Automatic . '">';

    echo "<tr><td>PDC: {$PDCEnrolledM_Automatic}</td>";
    echo "<td>{$PDC_Motorcycle_AutomaticSchedCourse1}</td>";
    echo "<td>" . date("h:i A", strtotime($PDC_Motorcycle_AutomaticSchedTimeCourse1)) . "</td>";
    echo "<td>{$PDC_Motorcycle_AutomaticSchedCourse2}</td>";
    echo "<td>" . date("h:i A", strtotime($PDC_Motorcycle_AutomaticSchedTimeCourse2)) . "</td>";
    
    echo '<td><select class="aviSched" name="sched_motor_auto" id="available-schedule-pdc4">';
    
    $querySched = "SELECT * FROM pdc_schedule WHERE Slot >= 1";
    $stmtSched = $conn->prepare($querySched);
    $stmtSched->execute();
    $scheduleData = $stmtSched->fetchAll(PDO::FETCH_ASSOC);

    if (count($scheduleData) > 0) {
        echo '<option value="" disabled selected hidden>Choose Schedule</option>';
        foreach ($scheduleData as $row) {
            $formattedOption = "{$row['schedule1']} -- {$row['schedule2']} | {$row['time1']} -- {$row['time2']}";
            echo "<option>{$formattedOption}</option>";
        }
    } else {
        echo '<option value="" disabled>No slot available</option>';
    }

    echo '</select></td>';
    echo '<td><button type="submit" id="PDCSchedM_auto">Update</button></td>';
    echo "</tr>"; // Added closing <tr> tag
    echo "</form>";
}

                //MOTOR Automatic
?>

           </table>
</div>
            <br>
    <div class = "backbtn_container">
            <input  type="button"  value="Back" onclick="history.go(-1);">
            </div>
            </div>
    <?php
    } else {
        // Handle the case when no ID is provided
        echo "No ID provided.";
    }
    ?>
    
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>

  // TDC RESCHED
  


$(document).ready(function () {
     var $selects = $('.aviSched');

    // Attach change event listener to all select elements
    $selects.change(function() {
        // Get the selected value of the current select element
        var selectedValue = $(this).val();

        // Check if any other select element has the same selected value
        var $otherSelects = $selects.not(this);
        var isDuplicate = $otherSelects.filter(function() {
            return $(this).val() === selectedValue;
        }).length > 0;

        if (isDuplicate) {
            alert("Selected values are the same!");

            // Clear the selected value in other select elements
            $otherSelects.val('');

        }
    });
    
    $("#TDCForm").submit(function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        var selectedOption_sched_tdc = $("#available-schedule-tdc1").val();
        formData.append("TDCID", $("input[name='SchedTDCID']").val());
        formData.append("TDCSched", $("input[name='SchedTDC']").val());
        formData.append("TDCSchedID", $("input[name='TDCSchedID']").val());
        formData.append("TDC", "TDC"); // Add TDC key to form data

        if (selectedOption_sched_tdc) {
            var scheduleName = "Theoritical";

            // Display a confirmation alert before updating the "Theoritical" schedule
            var confirmUpdate = confirm("Are you sure you want to request a reschedule for the Theoretical schedule?");
            if (confirmUpdate) {
                processSelectedOption(selectedOption_sched_tdc, formData, scheduleName);

                $.ajax({
                    url: "resched_for_tdc.php",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if(!response.includes("TDCdone")){
                        console.log(response);
                        // Handle success response here

                        // Refresh the page after a successful form submission
                        location.reload();
                                                alert("Update successful!");
                        }else{
                            alert("1 Resched Per Student Course");
                                                    location.reload();

                        }

                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                        // Handle form submission error
                    }
                });
            } else {
                console.log("Update operation canceled.");
            }
        } else {
            alert("Please choose a schedule before submitting the form.");
        }
    });
});


  //TDC AJAX


  //PDC 
$(document).ready(function () {
    $("#PDCForm_CarManual").submit(function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        var selectedOption_sched_car_manual = $("#available-schedule-pdc1").val();
        
        formData.append("StdIDPDC", $("input[name='StdIDPDC']").val()); 
        formData.append("PDCSchedCarManual", $("input[name='StdIDPDC']").val()); 
        formData.append("PDCSchedID", $("input[name='PDCSchedCarManual']").val()); // Add PDCSchedID to form data
        formData.append("PDC", "Car_manual"); // Add PDC key to form data

        if (selectedOption_sched_car_manual) {
            var scheduleName = "Car_manual";

            // Display a confirmation alert before updating the "Car_manual" schedule
            var confirmUpdate = confirm("Are you sure you want to request a reschedule for the Car_manual schedule?");
            if (confirmUpdate) {
                processSelectedOption(selectedOption_sched_car_manual, formData, scheduleName);

                $.ajax({
                    url: "resched_for_tdc.php",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                                                if(!response.includes("PDCdone")){

                        console.log(response);
                        // Handle success response here

                        // Refresh the page after a successful form submission
                        location.reload();
                                                alert("Update successful!");
                                                }else{
                            alert("1 Resched Per Student Course");
                                                    location.reload();

                        }

                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                        // Handle form submission error
                    }
                });
            } else {
                console.log("Update operation canceled.");
            }
        } else {
            alert("Please choose a schedule before submitting the form.");
        }
    });
});


$(document).ready(function () {
    $("#PDCForm_CarAutomatic").submit(function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        var selectedOption_sched_car_automatic = $("#available-schedule-pdc2").val();
        formData.append("PDCSchedID_CarAuto", $("input[name='PDCSchedID_CarAuto']").val()); // Add PDCSchedCarAutomatic to form data
        formData.append("PDC", "Car_automatic"); // Add PDC key to form data

        if (selectedOption_sched_car_automatic) {
            var scheduleName = "Car_automatic";

            // Display a confirmation alert before updating the "Car_automatic" schedule
            var confirmUpdate = confirm("Are you sure you want to update the Car_automatic schedule?");
            if (confirmUpdate) {
                processSelectedOption(selectedOption_sched_car_automatic, formData, scheduleName);

                // Log form data to the console
                for (var pair of formData.entries()) {
                    console.log(pair[0] + ': ' + pair[1]);
                }

                $.ajax({
                    url: "resched_for_tdc.php",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                                                                        if(!response.includes("PDCdone")){

                        console.log(response);
                        // Handle success response here

                        // Refresh the page after a successful form submission
                        location.reload();
                                                alert("Update successful!");
                                                                        }else{
                                                                             alert("1 Resched Per Student Course");
                                                    location.reload();
                                                                        }

                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                        // Handle form submission error
                    }
                });
            } else {
                alert("Update operation canceled.");
            }
        } else {
            alert("Please choose a schedule before submitting the form.");
        }
    });
});



  //PDC for Motor

$(document).ready(function () {
    $("#PDCForm_Motorcycle_Manualcourse").submit(function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        var selectedOption_sched_motor_manual = $("#available-schedule-pdc3").val();
        formData.append("PDCSchedID_Mmanual", $("input[name='PDCSchedID_Mmanual']").val()); // Add PDCSchedID_Mmanual to form data
        formData.append("PDC", "motor_manual"); // Add PDC key to form data

        if (selectedOption_sched_motor_manual) {
            var scheduleName = "motor_manual";

            // Display a confirmation alert before updating the "motor_manual" schedule
            var confirmUpdate = confirm("Are you sure you want to update the motor_manual schedule?");
            if (confirmUpdate) {
                processSelectedOption(selectedOption_sched_motor_manual, formData, scheduleName);

                // Log form data to the console
                for (var pair of formData.entries()) {
                    console.log(pair[0] + ': ' + pair[1]);
                }

                $.ajax({
                    url: "resched_for_tdc.php",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                           if(!response.includes("PDCMotordone")){
                        console.log(response);
                        // Handle success response here

                        // Refresh the page after a successful form submission
                        location.reload();
                                                alert("Update successful!");
                           }else{
                                                                             alert("1 Resched Per Student Course");
                                                    location.reload();
                               
                           }

                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                        // Handle form submission error
                    }
                });
            } else {
                alert("Update operation canceled.");
            }
        } else {
            alert("Please choose a schedule before submitting the form.");
        }
    });
});



 $(document).ready(function () {
    $("#PDCForm_Motorcycle_Automaticcourse").submit(function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        var selectedOption_sched_motor_automatic = $("#available-schedule-pdc4").val();
        formData.append("PDCSchedM_auto", $("input[name='PDCSchedM_auto']").val()); // Add PDCSchedM_auto to form data
        formData.append("PDC", "motor_automatic");

        if (selectedOption_sched_motor_automatic) {
            var scheduleName = "motor_automatic";

            // Display a confirmation alert before updating the "motor_automatic" schedule
            var confirmUpdate = confirm("Are you sure you want to update the motor_automatic schedule?");
            if (confirmUpdate) {
                processSelectedOption(selectedOption_sched_motor_automatic, formData, scheduleName);

                // Log form data to the console
                for (var pair of formData.entries()) {
                    console.log(pair[0] + ': ' + pair[1]);
                }

                $.ajax({
                    url: "resched_for_tdc.php",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                                                   if(!response.includes("PDCMotordone")){

                        console.log(response);
                        // Handle success response here

                        // Refresh the page after a successful form submission
                        location.reload();
                                                alert("Update successful!");
                                                   }else{
                                                                                   alert("1 Resched Per Student Course");
                                                    location.reload();
                                                   }

                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                        // Handle form submission error
                    }
                });
            } else {
                console.log("Update operation canceled.");
            }
        } else {
            console.error("Please choose a schedule before submitting the form.");
        }
    });
});


  var selectedOption_sched_tdc = $("#available-schedule-tdc1").val();
  if (selectedOption_sched_tdc) {
      processSelectedOption(selectedOption_sched_tdc, formData, "Theoritical");
  }


  function processSelectedOption(selectedOption, formData, scheduleName) {
      if (selectedOption) {
          var parts = selectedOption.split(" | ");

          if (parts.length === 2) {
              var selectedSchedule1 = parts[0].split(" -- ")[0];
              var selectedTime1 = parts[1].split(" -- ")[0];

              var selectedSchedule2 = parts[0].split(" -- ")[1];
              var selectedTime2 = parts[1].split(" -- ")[1];


              console.log("selectedSchedule1" + " " + selectedSchedule1 + " " + "selectedTime1" + " " + selectedTime1);
              console.log("selectedSchedule2" + " " + selectedSchedule2 + " " + "selectedTime2" + " " + selectedTime2);

              // Append values to form data with dynamic IDs
              formData.append(`${scheduleName}_schedule1`, selectedSchedule1);
              formData.append(`${scheduleName}_time1`, selectedTime1);
              formData.append(`${scheduleName}_schedule2`, selectedSchedule2);
              formData.append(`${scheduleName}_time2`, selectedTime2);
          }
      }
  }
  </script>
</body>

</html>
