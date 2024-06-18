
<?php
session_start();
if (empty($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}
include "../conn.php";
include "./php_scripts/Admin_EDIT_ENROLL.php";
include "./php_scripts/Admin_DEL.php";
include "./php_scripts/Admin_Payment.php";
include "./php_scripts/Admin_StdEnroll.php";
include "./php_scripts/Admin_edit_status.php";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $stud_id = $_GET['id'];

    try {
        // Prepare the SQL statement
        $stmt = $conn->prepare("SELECT Firstname, Lastname, Email FROM std_contact_us WHERE id_std_contact_us = :stud_id");

        // Bind the parameter
        $stmt->bindParam(':stud_id', $stud_id, PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Check if there is a result
        if ($stmt->rowCount() > 0) {
            // Fetch data
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $email = $row["Email"];
            $firstname = $row["Firstname"];
            $lastname = $row["Lastname"];
        } else {
            echo "No data found for ID: " . $stud_id;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID not provided";
}


	
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
    <link href="admin_styles/admin_nav.css" rel="stylesheet">
    <link href="./admin_styles/admin_denied.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fontscancel-btn.googleapis.com/css2?family=Merriweather:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<style>
.Email {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    box-sizing: border-box;
    border: 1px solid green;
    border-radius: 4px;
    font-size: 24px;
}

/* Optional: Add styles for focus state */
.Email:focus {
    border: 2px solid green;
    outline: none;
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
            <a href="admin_sched.php"><i class="far fa-calendar"></i> Schedule</a>
            <a href="admin_enroll.php"><i class="fas fa-user-plus"></i> Enrollment</a>
            <a href="admin_Pupdate.php"><i class="fas fa-bullhorn"></i> Post Updates</a>
            <a href="admin_reports.php"><i class="fas fa-chart-bar"></i> Reports</a>
            <a href="admin_Staff.php"><i class="fas fa-users"></i> Staff</a>
            <a href="admin_Assign.php"><i class="fas fa-tasks"></i> Assign</a>
            <a href="admin_view_feedback.php"><i class="fas fa-comment"></i> View Feedback</a>
            <a href="admin_module_exam.php"><i class="fas fa-book"></i> Module/Exam</a>
            <a href="" id="logoutLink"><i class="fas fa-sign-out-alt"></i> Log Out</a>
          </div>
        </center>
      </nav>
    </div>
    
        <div>
        <div class="main_content">
            <div class="container">
               <form id="denyForm" action='php_scripts/Email_to_concern.php' method='post' onsubmit="return confirm('Are you sure you want to send this email to the student?');">
    				<header><h2>Reply to Concerns</h2></header>
    				<input type='hidden'  name='stud_id' value='<?php echo $stud_id;?>'>
    				<input type='hidden'  name='firstname' value='<?php echo $firstname;?>'>
    				
                    <div class="emailbody">
                        <label>Email: </label><br><br>
                        <input type="text" class="Email" name="email" value="<?php echo $email;?>" required>
                        
                        <br><br>
                        
                         <label>Message: </label><br><br>
                          <textarea id="message" name="message" rows="4" cols="50" required></textarea>
                    </div>
                    <center><input type="submit" value="Submit">
                 </form>
                 <button type="button" class="back_btn" onclick="goBack()">Back</button></center>
             </div>
    	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




<script>
function changeRowsPerPage() {
        var rowsPerPageSelect = document.getElementById('rowsPerPage');
        var selectedLimit = rowsPerPageSelect.options[rowsPerPageSelect.selectedIndex].value;
        var currentURL = new URL(window.location.href);
        currentURL.searchParams.set('limit', selectedLimit);
        window.location.href = currentURL.href;
    }

		function Payment_success() {
            // Your JavaScript function logic here
            alert("Payment Recorded to the Database!");

		// Reset the URL to the original state (without "success") after 2 seconds
            setTimeout(function() {
                history.replaceState({}, document.title, window.location.pathname);
            }, 1);
        }
		 function Payment_failed() {
            // Your JavaScript function logic here
            alert("Failed to insert Payment record to database. please try again.");

		// Reset the URL to the original state (without "success") after 2 seconds
            setTimeout(function() {
                history.replaceState({}, document.title, window.location.pathname);
            }, 1);
        }
		 function enrolled() {
            // Your JavaScript function logic here
            alert("Student is officially enrolled!");

		// Reset the URL to the original state (without "success") after 2 seconds
            setTimeout(function() {
                history.replaceState({}, document.title, window.location.pathname);
            }, 1);
        }
        // Check if the URL contains "success" and trigger the function
        if (window.location.href.indexOf("Paid") !== -1) {
             Payment_success();
        }else if(window.location.href.indexOf("!Paid") !== -1) {
            Payment_failed();
        }else if(window.location.href.indexOf("enrolled") !== -1) {
            enrolled();
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
    function goBack() {
			window.history.back();
		}
</script>

</body>

</html>