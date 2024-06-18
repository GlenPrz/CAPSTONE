<?php
session_start();
if (empty($_SESSION['username'])) {
    header("Location: ../login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    	    <title>BTS Driving school</title>
	<link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
    <link href="admin_styles/admin_nav.css" rel="stylesheet">
    <link href="../Admin/admin_styles/admin_sched.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>



<?php
include "../conn.php";
include "./php_scripts/Admin_DELSched.php";
include "./php_scripts/Admin_DELSchedTDC.php";
$roleStaff = $_SESSION['role'];
$admin_username = $_SESSION['username'];



//Dito ichecheck if teller or admin. pag teller then magiging none ang value nung $none
$none='';
if ($roleStaff === "Teller") {
          $none='none';
    }


$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 5;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Calculate the offset for pagination
$offset = ($page - 1) * $limit;

$sqlGetTable = "SELECT * FROM u896821908_bts.pdc_schedule LIMIT :limit OFFSET :offset";
$stmtTableSched = $conn->prepare($sqlGetTable);
$stmtTableSched->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmtTableSched->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmtTableSched->execute();
$schedules = $stmtTableSched->fetchAll(PDO::FETCH_ASSOC);

$sqlGetTableTDC = "SELECT * FROM u896821908_bts.tdc_schedule LIMIT :limit OFFSET :offset";
$stmtTableSchedTDC = $conn->prepare($sqlGetTableTDC);
$stmtTableSchedTDC->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmtTableSchedTDC->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmtTableSchedTDC->execute();
$schedulesTDC = $stmtTableSchedTDC->fetchAll(PDO::FETCH_ASSOC);



// Calculate total rows for pagination
$countQuery = "SELECT COUNT(*) AS total FROM u896821908_bts.pdc_schedule";
$stmtCount = $conn->query($countQuery);
$row = $stmtCount->fetch(PDO::FETCH_ASSOC);
$totalRows = $row['total'];

// Calculate total pages
$totalPages = ceil($totalRows / $limit);

?>

<body>
    <div class="Container_nav">
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
        <div>
            <div class="main_content">
                
                <div class="container">
                    <div class="Sched_container">
                    <header><h2>PRACTICAL DRIVING COURSE SCHEDULE</h2></header>
                    <br>
                     <div>
                        <select id="rowsPerPage" onchange="changeRowsPerPage()" class="select_rows">
                    <option value="5" <?php if (!isset($_GET['limit']) || $_GET['limit'] == 5) echo 'selected'; ?>>5
                    </option>
                    <option value="15" <?php if (isset($_GET['limit']) && $_GET['limit'] == 15) echo 'selected'; ?>>15
                    </option>
                    <option value="25" <?php if (isset($_GET['limit']) && $_GET['limit'] == 25) echo 'selected'; ?>>25
                    </option>
                </select>
                </div>
                
                    <h2 class="Add_Text">Add Schedule:</h2>
                    <button class="Add_Staff" id='btn_sign_PDC'>+</button>
                    <div>
                   
                        <table>
                            <tr>
                                <th>Session1</th>
                                <th>Session2</th>
                                <th>Time Start</th>
                                <th>Time End</th>
                                <th>Slot</th>

                                <th style="text-align:center;">Options</th>
                            </tr>
                            <?php foreach ($schedules as $schedule): ?>
                            <tr>
                                <td><?php echo $schedule['schedule1']; ?></td>
                                <td><?php echo $schedule['schedule2']; ?></td>
                                <td><?php echo date("h:i A", strtotime($schedule['time1'])); ?></td>
                                <td><?php echo date("h:i A", strtotime($schedule['time2'])); ?></td>
                                <td><?php echo $schedule['Slot']; ?></td>

                                <td><center><span class="fa fa-trash del-icon trash-icon"
                                        data-id="<?php echo $schedule['PDC_SchedID']; ?>"></span></center></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                 
                    </div>
                    <div>
                    </div>
                </div>
                </div>
            <div class="container">
                <div class="TDC_Container">
            <header><h2>THEORETICAL DRIVING COURSE SCHEDULE</h2></header>
            <h2 class="Add_Text">Add Schedule:</h2>
            <button class="Add_Staff" id='btn_sign_TDC'>+</button>
            <div>
                <!--<select id="rowsPerPage" onchange="changeRowsPerPage()" class="select_rows">-->
                <!--    <option value="5" <?php if (!isset($_GET['limit']) || $_GET['limit'] == 5) echo 'selected'; ?>>5-->
                <!--    </option>-->
                <!--    <option value="15" <?php if (isset($_GET['limit']) && $_GET['limit'] == 15) echo 'selected'; ?>>15-->
                <!--    </option>-->
                <!--    <option value="25" <?php if (isset($_GET['limit']) && $_GET['limit'] == 25) echo 'selected'; ?>>25-->
                <!--    </option>-->
                <!--</select>-->
                </div>
            <table>
                <tr>
                    <th>Session1</th>
                    <th>Session2</th>
                    <th>Time Start</th>
                    <th>Time End</th>
                    <th>Slot</th>

                    <th style="text-align:center;">Options</th>
                </tr>
                <?php foreach ($schedulesTDC as $scheduledTDC): ?>
                <tr>
                    <td><?php echo $scheduledTDC['schedule1']; ?></td>
                    <td><?php echo $scheduledTDC['schedule2']; ?></td>
                    <td><?php echo date("h:i A", strtotime($scheduledTDC['time1'])); ?></td>
                    <td><?php echo date("h:i A", strtotime($scheduledTDC['time2'])); ?></td>
                    <td><?php echo $scheduledTDC['Slot']; ?></td>

                    <td><center><span class="fa fa-trash delTDC-icon trash-icon"
                            data-id="<?php echo $scheduledTDC['TDC_SchedID']; ?>"></span></center></td>
                </tr>
                <?php endforeach; ?>
            </table>

        </div>
            </div>
                   <div class="pagination" style= "width:80%; margin:auto;">
                            <?php
            if ($page > 1) {
                echo '<a href="?page=' . ($page - 1) . '" class="Prev_pagenation">Previous</a>';
            }
            for ($i = 1; $i <= $totalPages; $i++) {
                echo '<a href="?page=' . $i . '" class="Num_pagenation">' . $i . '</a>';
            }
            if ($page < $totalPages) {
                echo '<a href="?page=' . ($page + 1) . '" class="Next_pagenation">Next</a>';
            }
            ?>
                        </div>
            </div>
            
        </div>

        

        <!-- PDC MODAL PDC MODAL PDC MODAL PDC MODAL PDC MODAL PDC MODAL PDC MODAL PDC MODAL PDC MODAL -->
        <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close">&times;</span>
                    <h2 class="ScheduleTitle">Add Schedule</h2>
                </div>
                <form id="scheduleForm" method="POST">
                    <div class="modal-body">
                        <h2 class="titleDate">Session 1:</h2>
                        <input type="date" class="input_typeDate" name="PDC_Date1" min="<?php echo date('Y-m-d'); ?>"
                            required><br>

                        <h2 class="titleDate">Session 2:</h2>
                        <input type="date" class="input_typeDate" name="PDC_Date2" min="<?php echo date('Y-m-d'); ?>"
                            required><br>

                        <h2 class="titleTime">Time:</h2>
                        <input type="time" class="input_typeTime" name="TimeAdmin1">
                        
                        <input type="time" class="input_typeTime" name="TimeAdmin2">
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="Add_Sched" value="Add">
                        <input type="submit" class="SubmitSched button-19 green-color" value="Add" id="timeInput1">
                        <input type="reset" id="CancelAddModal" name="reset_Sched" class="resetSched button-19"
                            value="Cancel" id="timeInput2">
                </form>
            </div>
            
        </div>
    </div>

    <!-- PDC MODAL PDC MODAL PDC MODAL PDC MODAL PDC MODAL PDC MODAL PDC MODAL PDC MODAL PDC MODAL -->

    <!-- TDC MODAL TDC MODAL TDC MODAL TDC MODAL TDC MODAL TDC MODAL TDC MODAL TDC MODAL TDC MODAL TDC MODAL -->

    <div id="myModal_TDC" class="modal_TDC">
        <!-- Modal content -->
        <div class="modal-content_TDC">
            <div class="modal-header_TDC">
                <span class="close_TDC">&times;</span>
                <h2 class="ScheduleTitle">Add Schedule Theorical </h2>
            </div>
            <form id="scheduleFormTDC" method="POST">
                <div class="modal-body_TDC">
                    <h2 class="titleDate">Session 1:</h2>
                    <input type="date" class="input_typeDate" name="TDC_Date1" min="<?php echo date('Y-m-d'); ?>"
                        required><br>

                    <h2 class="titleDate">Session 2:</h2>
                    <input type="date" class="input_typeDate" name="TDC_Date2" min="<?php echo date('Y-m-d'); ?>"
                        required><br>

                    <h2 class="titleTime">Time:</h2>
                    <input type="time" class="input_typeTime" name="TimeTDC1">
                    
                    <input type="time" class="input_typeTime" name="TimeTDC2">
                </div>
                <div class="modal-footer_TDC">
                    <input type="hidden" name="Add_SchedTDC" value="Add">
                    <input type="submit" class="SubmitSched button-19 green-color" value="Add" id="timeInput1">
                    <input type="reset" id="CancelAddModal" name="reset_Sched" class="resetSched button-19"
                        value="Cancel" id="timeInput2">
            </form>
            
        </div>
    </div>
    <!-- TDC MODAL TDC MODAL TDC MODAL TDC MODAL TDC MODAL TDC MODAL TDC MODAL TDC MODAL TDC MODAL TDC MODAL TDC MODAL TDC MODAL TDC MODAL TDC MODAL TDC MODAL -->


</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // JavaScript to limit the time range
    const timeInput1 = document.querySelector('.input_typeTime[name="TimeAdmin1"]');
    const timeInput2 = document.querySelector('.input_typeTime[name="TimeAdmin2"]');

    timeInput1.addEventListener('change', function () {
        const selectedTime1 = new Date('2000-01-01 ' + this.value);
        const minimumTime2 = new Date(selectedTime1.getTime() + 4 * 60 * 60 * 1000);

        const timeInput2Value = timeInput2.value;
        const selectedTime2 = new Date('2000-01-01 ' + timeInput2Value);

        if (selectedTime2 <= minimumTime2) {
            timeInput2.value = minimumTime2.toTimeString().substring(0, 5);
        }
        timeInput2.min = minimumTime2.toTimeString().substring(0, 5);
    });

    timeInput2.addEventListener('change', function () {
        const selectedTime2 = new Date('2000-01-01 ' + this.value);
        const selectedTime1 = new Date('2000-01-01 ' + timeInput1.value);
        const minimumTime2 = new Date(selectedTime1.getTime() + 4 * 60 * 60 * 1000);

        if (selectedTime2 <= minimumTime2) {
            this.value = minimumTime2.toTimeString().substring(0, 5);
        }
    });

    const timeInputTDC1 = document.querySelector('.input_typeTime[name="TimeTDC1"]');
const timeInputTDC2 = document.querySelector('.input_typeTime[name="TimeTDC2"]');

timeInputTDC1.addEventListener('change', function () {
    const selectedTimeTDC1 = new Date('2000-01-01 ' + this.value);
    const minimumTimeTDC2 = new Date(selectedTimeTDC1.getTime() + 7.5 * 60 * 60 * 1000);

    const timeInputTDC2Value = timeInputTDC2.value;
    const selectedTime2TDC = new Date('2000-01-01 ' + timeInputTDC2Value);

    if (selectedTime2TDC <= minimumTimeTDC2) {
        timeInputTDC2.value = minimumTimeTDC2.toTimeString().substring(0, 5);
    }
    timeInputTDC2.min = minimumTimeTDC2.toTimeString().substring(0, 5);
});

timeInputTDC2.addEventListener('change', function () {
    const selectedTime2TDC = new Date('2000-01-01 ' + this.value);
    const selectedTime1TDC = new Date('2000-01-01 ' + timeInputTDC1.value);
    const minimumTime2TDC = new Date(selectedTime1TDC.getTime() + 7.5 * 60 * 60 * 1000);

    if (selectedTime2TDC <= minimumTime2TDC) {
        this.value = minimumTime2TDC.toTimeString().substring(0, 5);
    }
});



    $(document).ready(function () {


        $("#scheduleForm").submit(function (event) {
            event.preventDefault(); // Prevent the default form submission

            // Get form data
            var formData = $(this).serialize();
            console.log("Serialized Form Data:", formData);

            $.ajax({
                type: "POST",
                url: "../Admin/php_scripts/Admin_AddSched.php",
                data: formData,
                dataType: "json", // Set expected data type
                success: function (response) {
                    if (response.status === "success") {
                        alert("Schedule added successfully.");
                        window.location.reload();
                    } else if (response.status === "error_date_empty") {
                        alert("Schedule date cannot be empty.");
                    } else if (response.status === "error_database") {
                        alert("Error adding schedule to the database.");
                    } else {
                        alert("An unexpected error occurred.");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Detailed Error Response:", xhr
                    .responseText); // Log the detailed error response
                    alert(
                        "An error occurred while processing the request. See the console for more details.");
                                        console.log("test");

                }
            });
        });

        $("#scheduleFormTDC").submit(function (event) {
            event.preventDefault(); // Prevent the default form submission

            // Get form data
            var formData = $(this).serialize();
            console.log("Serialized Form Data:", formData);

            $.ajax({
                type: "POST",
                url: "../Admin/php_scripts/Admin_AddSchedTDC.php",
                data: formData,
                dataType: "json", // Set expected data type
                success: function (response) {
                    if (response.status === "success") {
                        alert("Schedule added successfully.");
                        window.location.reload();
                    } else if (response.status === "error_date_empty") {
                        alert("Schedule date cannot be empty.");
                    } else if (response.status === "error_database") {
                        alert("Error adding schedule to the database.");
                    } else {
                        alert("An unexpected error occurred.");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Detailed Error Response:", xhr
                    .responseText); // Log the detailed error response
                    alert(
                        "An error occurred while processing the request. See the console for more details.");
                }
            });
        });

        $('#logoutLink').click(function(event) {
            event.preventDefault(); // Prevent the default link behavior
            
            var userConfirmed = window.confirm("To confirm Logging out, click Ok");
            
            if (userConfirmed) {
                $.ajax({
                    url: '../logout.php',
                    type: 'POST',
                    success: function(response) {
                        // Redirect to login.php on successful logout
                        window.location.href = '../login.php';
                    },
                    error: function(xhr, status, error) {
                        console.error(error); // Log any errors to the console
                    }
                });
            }
            // If the user clicks "No" or cancels, do nothing
        });

    });

    //DEL Sched
    var userDel = "<?php echo isset($_GET['DELID']) && !empty($_GET['DELID']) ? $_GET['DELID'] : ''; ?>";
    var userDelTDC = "<?php echo isset($_GET['DELTDCID']) && !empty($_GET['DELTDCID']) ? $_GET['DELTDCID'] : ''; ?>";

    var modal_Del = document.getElementById('modal_Del_Del');
    var span_del = document.getElementsByClassName('close_del')[0];

    if (userDel) {
        modal_Del.style.display = "block";
    }

    span_del.onclick = function () {
        modal_Del.style.display = "none";
        var currentURL = new URL(window.location.href);
        currentURL.searchParams.delete('DELID');
        window.history.replaceState({}, document.title, currentURL.href);
    }

    var modal_Del_DelTDC = document.getElementById('modal_Del_DelTDC');
    var span_delTDC = document.getElementsByClassName('close_delTDC')[0];

    if (userDelTDC) {
        modal_Del_DelTDC.style.display = "block";
    }else{
        modal_Del_DelTDC.style.display = "none";

    }

    span_delTDC.onclick = function () {
        modal_Del_DelTDC.style.display = "none";
        var currentURL = new URL(window.location.href);
        currentURL.searchParams.delete('DELTDCID');
        window.history.replaceState({}, document.title, currentURL.href);
    }


    function handleDelClick(del_username) {
        // Redirect to Admin_EDIT_ENROLL.php with the Username data in the URL
        var currentURL = new URL(window.location.href);
        currentURL.searchParams.set('DELID', del_username);
        window.location.href = currentURL.href;
    }

    function handleDelTDCClick(delTDC_username) {
        // Redirect to Admin_EDIT_ENROLL.php with the Username data in the URL
        var currentURL = new URL(window.location.href);
        currentURL.searchParams.set('DELTDCID', delTDC_username);
        window.location.href = currentURL.href;
    }


    var delIcons = document.getElementsByClassName('del-icon');

    for (var i = 0; i < delIcons.length; i++) {
        delIcons[i].addEventListener('click', function () {
            // Get the data-id attribute, which contains the Username
            var del_username = this.getAttribute('data-id');
            // Call the function to handle the edit click event and pass the Username
            handleDelClick(del_username);
        });
    }

    var delTDCIcons = document.getElementsByClassName('delTDC-icon');

    for (var i = 0; i < delTDCIcons.length; i++) {
        delTDCIcons[i].addEventListener('click', function () {
            // Get the data-id attribute, which contains the Username
            var delTDC_username = this.getAttribute('data-id');
            // Call the function to handle the edit click event and pass the Username
            handleDelTDCClick(delTDC_username);
        });
    }

    //DEL Sched


    function changeRowsPerPage() {
        var rowsPerPageSelect = document.getElementById("rowsPerPage");
        var selectedLimit = rowsPerPageSelect.value;

        var currentURL = new URL(window.location.href);
        currentURL.searchParams.set("limit", selectedLimit);
        currentURL.searchParams.set("page", 1); // Reset page to 1 when changing limit
        window.location.href = currentURL.href;
    }

    $(document).ready(function () {
        // Bind a click event to the Cancel button
        $("#CancelAddModal").click(function () {
            window.location.reload();
            window.location.href = 'admin_sched.php';
        });
    });

    //Add Modals

    // PDC SCHED
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("btn_sign_PDC");
    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function () {
        modal.style.display = "block";
    }

    span.onclick = function () {
        modal.style.display = "none";
    }
    // PDC SCHED

    //TDC SCHED
    var modal_TDC = document.getElementById("myModal_TDC");
    var btn_TDC = document.getElementById("btn_sign_TDC");
    var span_TDC = document.getElementsByClassName("close_TDC")[0];

    btn_TDC.onclick = function () {
        modal_TDC.style.display = "block";
    }

    span_TDC.onclick = function () {
        modal_TDC.style.display = "none";
    }
    //TDC SCHED

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        } else if (event.target == modal_Del) {
            modal_Del.style.display = "none";
            var currentURL = new URL(window.location.href);
            currentURL.searchParams.delete('DELID');
            window.history.replaceState({}, document.title, currentURL.href);
        } else if (event.target == modal_Del_DelTDC) {
            modal_Del_DelTDC.style.display = "none";
            var currentURL = new URL(window.location.href);
            currentURL.searchParams.delete('DELTDCID');
            window.history.replaceState({}, document.title, currentURL.href);
        }
    }

    //     function validateDates() {
    //     var startDate = new Date(document.getElementById("startDate").value);
    //     var endDate = new Date(document.getElementById("endDate").value);

    //     if (startDate >= endDate) {
    //         console.log("Start Date:", startDate);
    //         console.log("End Date:", endDate);
    //         alert("Start Date must be earlier than End Date.");
    //         return false;
    //     }

    //     return true;
    // }
</script>

</html>