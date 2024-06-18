<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (empty($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}
include "../conn.php";
session_start();

$roleStaff = $_SESSION['role'];
$admin_username = $_SESSION['username'];
//Dito ichecheck if teller or admin. pag teller then magiging none ang value nung $none
$none='';
if ($roleStaff === "Teller") {
          $none='none';
    }
    
    
$stmtRecent = $conn->prepare("SELECT * FROM std_contact_us ORDER BY created_at DESC LIMIT 5");
$stmtRecent->execute();
$resultRecent = $stmtRecent->fetchAll(PDO::FETCH_ASSOC);


    $stmt = $conn->prepare("SELECT * FROM std_contact_us");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
?>
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
 /* Style for the container div with class "recent" inside main_content */
.main_content .recent {
    width: 100%; /* Gawing 100% ang lapad ng .recent div */
    margin: 20px auto;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
}

/* Style for the table inside .recent */
.main_content .recent table {
    width: 100%; /* Gawing 100% ang lapad ng table */
    border-collapse: collapse;
    margin-bottom: 10px;
}

/* Style for table headers */
.main_content .recent th {
    background-color: #4CAF50;
    color: white;
    padding: 10px;
    text-align: left;
}

/* Style for table data cells */
.main_content .recent td {
    padding: 8px;
    border-bottom: 1px solid #ddd;
    display: block;
}

/* Hover effect for table rows */
.main_content .recent td:hover {
    background-color: #f5f5f5;
}

.reply-button {
    background-color: #3ac24b;
    border-radius: 8px;
    padding: 12px 25px;
    font-size: 17px;
    font-weight: 400;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.reply-button:hover {
    background-color: #174f1e;
    color: white;
}
</style>

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
                        <a href="admin_sched.php" style="Display:<?php echo $none;?>;"><i class="far fa-calendar"></i> Schedule</a>
                        <a href="admin_enroll.php"><i class="fas fa-user-plus"></i> Enrollment</a>
                        <a href="admin_Pupdate.php" style="Display:<?php echo $none;?>;"><i class="fas fa-bullhorn"></i> Post Updates</a>
                        <a href="admin_reports.php" style="Display:<?php echo $none;?>;"><i class="fas fa-chart-bar"></i> Reports</a>
                        <a href="admin_Staff.php" style="Display:<?php echo $none;?>;"><i class="fas fa-users"></i> Staff</a>
                        <a href="admin_Assign.php"><i class="fas fa-tasks"></i> Assign</a>
                        <a href="admin_view_feedback.php" style="Display:<?php echo $none;?>;"><i class="fas fa-comment"></i> View Feedback</a>
                        <a href="admin_module_exam.php" style="Display:<?php echo $none;?>;"><i class="fas fa-book"></i> Module/Exam</a>
                        <a href="" id="logoutLink"><i class="fas fa-sign-out-alt"></i> Log Out</a>
                    </div>
                </center>
            </nav>
        </div>
        
<div class="main_content">
<div class="recent">
   <table>
    <tr>
        <th>Recent Messages</th>
        <th></th>
    </tr>
    <?php foreach ($resultRecent as $messageRecent) { ?>
        <tr>
            <td>
                <div style="display: flex;">
                    <div style="width: 80%;">
                        <label>Name: </label><label><?php echo $messageRecent['Firstname'] . ' ' . $messageRecent['Lastname']; ?></label><br>
                        <label>Email: </label><label><?php echo $messageRecent['Email']; ?></label><br>
                        <label>Contact Number: </label><label><?php echo $messageRecent['ContactNo']; ?></label><br>
                        <label>Message: </label><label><?php echo $messageRecent['Message']; ?></label><br>
                    </div>
                    <div style="display: flex; justify-content: center; align-items: center;">
                        <a href="reply_Concern.php?id=<?php echo $messageRecent['id_std_contact_us']; ?>">
                           <button class="reply-button">Reply</button>
                        </a>
                    </div>
                </div>
            </td>
        </tr>
    <?php } ?>
</table>
</div>


<div class="recent">
   <?php
   if (count($result) > 0) {
        // Output HTML table
        echo "<table>
                <tr>
                    <th>All Messages</th>
                    <th></th>
                </tr>";
        
        foreach ($result as $row) {
           echo '<tr>
                    <td>
                        <div style="display: flex;">
                            <div style="width: 80%;">
                                <label>Name: </label><label>' . $row["Firstname"] . ' ' . $row["Lastname"] . '</label><br>
                                <label>Email: </label><label>' . $row["Email"] . '</label><br>
                                <label>Contact Number: </label><label>' . $row["ContactNo"] . '</label><br>
                                <label>Message: </label><label>' . $row["Message"] . '</label>
                            </div>
                            <div style="display: flex; justify-content: center; align-items: center;">
                               <a href="reply_Concern.php?id=' . $row["id_std_contact_us"] . '">
                                  <button class="reply-button">Reply</button>
                               </a>
                            </div>
                        </div>
                    </td>
                </tr>';

        }

        echo "</table>";
    } else {
        echo "No messages found.";
    }
   
   ?>
</div>
</div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
function sent() {
    // Your JavaScript function logic here
    alert("Student has been emailed about their concern.");

	// Reset the URL to the original state (without "success") after 2 seconds
    setTimeout(function() {
        history.replaceState({}, document.title, window.location.pathname);
        }, 1);
    }
function invalidemail() {
    // Your JavaScript function logic here
    alert("The Email of the student is invalid.");

	// Reset the URL to the original state (without "success") after 2 seconds
    setTimeout(function() {
        history.replaceState({}, document.title, window.location.pathname);
        }, 1);
    }
if(window.location.href.indexOf("sent") !== -1) {
    sent();
}else if(window.location.href.indexOf("invalidemail") !== -1) {
    invalidemail();
}
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
</script>
</body>
</html>
