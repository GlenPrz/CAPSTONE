<?php
session_start();
if (empty($_SESSION['username'])) {
    header("Location: ../login.php");
}
include "../conn.php";
include("EDIT_PROFILE_MDL.php");
date_default_timezone_set("Asia/Manila");

$querySTDname = "SELECT Lastname, Firstname,idStudent FROM u896821908_bts.student WHERE Username = :username";
$stmtSTDname = $conn->prepare($querySTDname);

if ($stmtSTDname) {
    $stmtSTDname->bindValue(':username', $_SESSION['username'], PDO::PARAM_STR);
    $stmtSTDname->execute();

    $row = $stmtSTDname->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $lastname = $row['Lastname'];
        $firstname = $row['Firstname'];
        $stdID = $row['idStudent'];

		$_SESSION['STD_Fullname'] = $lastname. " " . $firstname;
    } else {
        // Handle the case where no matching records were found.
    }
}


$pdfArray = [];

    $sql = "SELECT * FROM u896821908_bts.admin_module_exam_pdf";
    $stmt = $conn->query($sql);
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $id = $row['idadmin_module_exam_pdf'];
        $pdfData = $row['pdf'];
        
        // Store the PDF data in the array
        $pdfArray[] = [
            'id' => $id,
            'pdf_data' => $pdfData,
            'pdf_name' => basename($pdfData), // Optionally store the PDF file name
        ];

        }
    }else {
        echo "No rows found.";
    }
$pdfName1 = $pdfArray[0]['pdf_name'];
$pdfName2 = $pdfArray[1]['pdf_name'];
$pdfName3 = $pdfArray[2]['pdf_name'];


/*
if (!isset($_SESSION['username'])) {
    // Redirect the user to the desired location (e.g., login page)
    header('Location: ../login.php');
    exit; // Make sure to exit after the redirection to prevent further code execution
}
*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BTS Driving school</title>
	<link rel="icon" type="image/x-icon" href="../img/favicon.ico">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="STD_NAV.css">
	<link rel="stylesheet" href="STUDENT_PORTAL.css">
	<link href="studentstyle/stdModuleExam.css" rel="stylesheet">
	<link rel="stylesheet" href="../modalsStyle/modal_signup.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<style>
.message_con{
    display: block;
    margin-top: 4%;
    width: 100%;
    height: 700px;
}
.resched_con {
    padding: 2%;
    margin: auto;
    background-color: rgba(204, 252, 204, 0.1);
    border: 1px solid rgba(0, 128, 0, 0.5); /* Lighter and thinner green border */
    border-radius: 10px; /* Add rounded corners */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Black shadow */
    width: 90%;
    height: 300px;
    margin-top: 2%;
}


.reschedule_button {
    background-color: #1ac42b;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}
.reschedule_button:hover {
    background-color: #0b4511;
}

input[type="checkbox"] {
    margin-right: 10px;
}
        .zero_slot{
            display:flex;
            width:100%;
        }
        .session_chk {
            width: 25%;
            margin-right: 5%;
            padding: 1%;
            background-color: rgba(233, 255, 217, 0.1);
            border: 1px solid rgba(0, 128, 0, 0.5); /* Lighter and thinner green border */
            border-radius: 10px; /* Add rounded corners */
        }

        .session_chk p {
            font-weight: bold;
        }

        .session_chk label {
            margin-bottom: 10px;
        }

        .session_chk input {
            transform: scale(1.5);
            margin-right: 10px;
        }

        .slot_details {
            width: 65%;
        }

        .slot_details p {
            text-align: justify;
        }
        
        .chkbx{
            margin-left: 1%;
            width: 80$;
            
        }
.request_slot_button {
    background-color: #1ac42b;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}
.request_slot_button:hover {
    background-color: #0b4511;
}


</style>

<body>
	<div class="stud_Container">
		<div class="nav_student">
				<div class="profile" id="profile-box">
						<img src="../uploads/<?php echo basename($profilePicture); ?>" alt="Profile Picture" />
						<div class="namecon">
						<span class="username"><?php echo $lastname . ", " .$firstname?></span><br>
							<span class="email">Student Id: <?php echo $stdID ?></span>
						</div>
						<!--DITO USERNAME VARIABLE NG STUDENT-->
					</div>
			<nav>
				<div class="nav_links" id="navslist">
					<a href="STD_HOME.php">&nbsp;&nbsp;<i class="fas fa-home"></i>&nbsp;&nbsp;&nbsp;Home</a>
					<a href="STD_ACC_PAYABLE.php">&nbsp;&nbsp;<i class="fas fa-money-bill"></i>&nbsp;&nbsp;&nbsp;Transaction</a>
					<a href="STD_MODULE_EXAM.php">&nbsp;&nbsp;<i class="fas fa-book"></i>&nbsp;&nbsp;&nbsp;Module / Exam</a>
					<a href="STD_EVALUATION_FORM.php">&nbsp;&nbsp;<i class="fas fa-comment"></i>&nbsp;&nbsp;&nbsp;Feedback</a>
					<a href="#" id="EditProf_btn">&nbsp;&nbsp;<i class="fas fa-user"></i>&nbsp;&nbsp;&nbsp;Edit Profile</a>
					<a href="" id="logoutLink">&nbsp;&nbsp;<i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;&nbsp;Log Out</a>
				</div>
				<center><div class="logo_container">
                        <img src="../img/bts_logo.png" class="admin_logo">
                    </div></center>
			</nav>
		</div>
		
		
<h4 class="description">Module & Examination</h4>
    		<?php
    		// SQL SELECT query
             $sql = "SELECT Username, schedule1, schedule2 FROM student_schedule_tdc WHERE Student_Id = :stdID";
             $stmt = $conn->prepare($sql);
             $stmt->bindParam(':stdID', $stdID, PDO::PARAM_STR);
             $stmt->execute();
    
            // Check if there are results
            if ($stmt->rowCount() > 0) {
                // Fetch data and output schedules
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $schedule1 = $row["schedule1"];
                    $schedule2 = $row["schedule2"];
                    $currentDate = date("Y-m-d");
                    //"2023-11-20"
                
                    $TDC_progress = $_SESSION['TDC_progress'];
                    
                    if ($currentDate < $schedule1) {
                        $s1s2_btn = true;
                    } else {
                        $s1s2_btn = false;
                    }
                    
                    if ($currentDate < $schedule2) {
                        $s3_btn = true;
                    } else {
                        $s3_btn = false;
                    }
                    $tdc_istrue = "none";
                    if ($currentDate > $schedule2) {
                    //if(true){
                        $s3_btn = true;
                        $s1s2_btn = true;
                         if (!$TDC_progress == 100){
                         //if(true){
                            $tdc_istrue = "block";
                            $callFunction = true;
                         }
                    }
                    
                    
                }
            } else {
                echo "No results found";
            }
    		
    		?>
			
			<div class="main_content">
				<div>
			
				<div class="Mod_Ex_Container">
				
			<!--For number of attempts-->	
			<?php
			// Replace these with your actual database credentials
			$servername = "localhost";
            $username = "u896821908_bts";
            $password = "a*5E4UEhsHa]";
            $dbname = "u896821908_bts";

			// Create a connection to the database
			$conn = new mysqli($servername, $username, $password, $dbname);

			// Check the connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			// PHP variable value to subtract
			$max_attempt  = 3;
			$USERNAME = $_SESSION['username'];

				// NUMBER OF ATTEMPTS FOR MODULE 1
				$stmt = $conn->prepare("SELECT COUNT(*) AS totalRows FROM u896821908_bts.student_result WHERE Session_num = 1 AND username LIKE ?");
				$stmt->bind_param("s", $USERNAME);
				$stmt->execute();
				$result = $stmt->get_result();

				// Fetch the result
				if ($row = $result->fetch_assoc()) {
					$rowCount = $row['totalRows'];
					$Mod1_attempt = $max_attempt - $rowCount;
				}
				$stmt->close();
				
						// Check if session 1 is passed
						$stmt = $conn->prepare("SELECT * FROM u896821908_bts.student_result WHERE Session_num = 1 AND result = 'Passed' AND username LIKE ?");
						$stmt->bind_param("s", $USERNAME);
						$stmt->execute();
						$result = $stmt->get_result();

						// Fetch the result
						if ($row = $result->fetch_assoc()) {
							$passed1 = 1; // 1 means yes
						} else {
							$passed1 = 0; // 0 means no
						}
						$stmt->close();


				// NUMBER OF ATTEMPTS FOR MODULE 2
				$stmt = $conn->prepare("SELECT COUNT(*) AS totalRows FROM u896821908_bts.student_result WHERE Session_num = 2 AND username LIKE ?");
				$stmt->bind_param("s", $USERNAME);
				$stmt->execute();
				$result = $stmt->get_result();

				// Fetch the result
				if ($row = $result->fetch_assoc()) {
					$rowCount = $row['totalRows'];
					$Mod2_attempt = $max_attempt - $rowCount;
				}

				// Close the connection
				$stmt->close();
				
						// Check if session 2 is passed
						$stmt = $conn->prepare("SELECT * FROM u896821908_bts.student_result WHERE Session_num = 2 AND result = 'Passed' AND username LIKE ?");
						$stmt->bind_param("s", $USERNAME);
						$stmt->execute();
						$result = $stmt->get_result();

						// Fetch the result
						if ($row = $result->fetch_assoc()) {
							$passed2 = 1; // 1 means yes
						} else {
							$passed2 = 0; // 0 means no
						}
						$stmt->close();


				// NUMBER OF ATTEMPTS FOR MODULE 3
				$stmt = $conn->prepare("SELECT COUNT(*) AS totalRows FROM u896821908_bts.student_result WHERE Session_num = 3 AND username LIKE ?");
				$stmt->bind_param("s", $USERNAME);
				$stmt->execute();
				$result = $stmt->get_result();

				// Fetch the result
				if ($row = $result->fetch_assoc()) {
					$rowCount = $row['totalRows'];
					$Mod3_attempt = $max_attempt - $rowCount;
				}
				
			// Close the connection
			$stmt->close();
			
						// Check if session 3 is passed
						$stmt = $conn->prepare("SELECT * FROM u896821908_bts.student_result WHERE Session_num = 3 AND result = 'Passed' AND username LIKE ?");
						$stmt->bind_param("s", $USERNAME);
						$stmt->execute();
						$result = $stmt->get_result();

						// Fetch the result
						if ($row = $result->fetch_assoc()) {
							$passed3 = 1; // 1 means yes
						} else {
							$passed3 = 0; // 0 means no
						}
						$stmt->close();

			// Close the database connection
			$conn->close();
			?>

				  <form action="STD_EXAM.php" method="post">
				  	<center> <header><h2>Theoretical Driving Course</h2></header></center><br>

				<div class="bodyContainer">
					<div class="sessions_container">
						<div class="img_container">
				  <img src="..\img\drive-download-20230614T125330Z-001\exam1.png" alt="pdc_mc Image">
				</div> 
						<h2 class="session_name">Session 1</h2>
						 <a href ="../uploads/pdf_modules/<?php echo basename($pdfName1); ?>" target="_blank" class="OpenMod_btn">Click to open Module</a><br>
						 
						 <button type="submit" name="ExamButton" class="takeExam_btn" value="Module 1" <?php if ($s1s2_btn || $Mod1_attempt <= 0 || $passed1 == 1) echo 'disabled';?>>Click to take Exam</a></button>
						 <br> <br><p class="Attempt">Number of attempt: <?php echo $Mod1_attempt?></p>
					</div>
					
					<div class="sessions_container">
						<div class="img_container">
				  <img src="..\img\drive-download-20230614T125330Z-001\exam2.png" alt="pdc_mc Image">
				</div> 
						<h2 class="session_name">Session 2</h2>
						<a href ="../uploads/pdf_modules/<?php echo basename($pdfName2); ?>" target="_blank" class="OpenMod_btn">Click to open Module</a><br>
						<button type="submit" name="ExamButton" class="takeExam_btn" value="Module 2" <?php if ($s1s2_btn || ($Mod1_attempt == 3 || $Mod2_attempt <=  0 || $passed2 == 1)) echo 'disabled';?>>Click to take Exam</a></button>
						<br><br> <p class="Attempt">Number of attempt:  <?php echo $Mod2_attempt?> </p>
					</div>
					
					<div class="sessions_container">
						<div class="img_container">
				  <img src="..\img\drive-download-20230614T125330Z-001\exam3.png" alt="pdc_mc Image">
				</div> 
						<h2 class="session_name">Session 3</h2>
						 <a href ="../uploads/pdf_modules/<?php echo basename($pdfName3); ?>" target="_blank" class="OpenMod_btn">Click to open Module</a><br>
						 <button type="submit" name="ExamButton" class="takeExam_btn" value="Module 3" <?php if ($s1s2_btn || ($Mod2_attempt == 3 || $Mod3_attempt <=  0 || $passed3 == 1)) echo 'disabled'; ?>>Click to take Exam</a></button>
						<br><br><p class="Attempt">Number of attempt:  <?php echo $Mod3_attempt?> </p>
					</div>
				</div>
				  </form>
				</div>
				
				<div class="message_con">
				    <?php
				    $slot_iszero = "none";
    				if($Mod1_attempt <=  0 || $Mod2_attempt <=  0 || $Mod3_attempt <=  0){
    				//if(true){
    				    $slot_iszero = "block";
    				    $callFunction2 = true;
    				}

				    ?>
				   <div class="resched_con" id="resched" style="display: <?php echo $tdc_istrue; ?>;">
                        <h1>RESCHED</h1><br>
                       <p style="text-align: justify;">We regret to inform you that it appears the student has missed their scheduled time for the TDC exam. This might have been due to unforeseen circumstances. No need to worry! You can reschedule your TDC exam by clicking the button below. We appreciate your understanding and cooperation.</p><br>
                       <a href = "../Student/reschedule.php?id=<?php echo $std_id; ?>"><button id='reschedbtn' name='resched' class="reschedule_button">RESCHEDULE</button></a>
                    </div>
                    
				    <div class="resched_con" id="slot" style="display: <?php echo $slot_iszero; ?>; margin-bottom: 5%; height: 350px">
                        <h1>REQUEST FOR EXAM RETAKESSS</h1><br>
                        <div class="zero_slot">
                            <div class="session_chk">
                                <p>Select Session you want to retake:</p><br>
                                
                               <form action="request_process.php" method="post" onsubmit="return validateForm()">
                                    <input type="hidden" name="std_id" value="<?php echo $stdID;?>">
                                    <div class="chkbx">
                                        <div style="margin-bottom: 10px;">
                                            <label>
                                                <input type="checkbox" name="session[]" value="1"> Session 1
                                            </label>
                                        </div>
                                    
                                        <div style="margin-bottom: 10px;">
                                            <label>
                                                <input type="checkbox" name="session[]" value="2"> Session 2
                                            </label>
                                        </div>
                                    
                                        <div style="margin-bottom: 10px;">
                                            <label>
                                                <input type="checkbox" name="session[]" value="3"> Session 3
                                            </label>
                                        </div>
                                    </div>
                                
                                    <button class="request_slot_button" type="submit">Request for Retake</button>
                                </form>

                            </div>
                            <div class="slot_details">
                                <p>
                                If one of your session have zero attempts left, you have the option to request for a retake. To initiate a retake, choose the session and proceed to requesting by clicking the request button. Keep in mind that requesting additional attempts incurs a 300 PHP fee per session you choose, and opting for a new attempt will replace the existing record for the selected session. Proceed with this decision only if you are willing to make the payment and understand the potential loss of the current attempt record. The fee will be added to your balance once the admin accepts your request for a retake. You can contact us at besttrainingschool101@gmail.com if you have any questions about requesting for a retake. Happy Driving!.
                                </p>
                            </div>
                        </div>
                    </div>




				</div>    
			</div>
		</div>

	</div>

</body>

<script>
     function validateForm() {
        // Use the built-in JavaScript confirm dialog
        

        var checkboxes = document.getElementsByName('session[]');
        var isChecked = false;

        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                isChecked = true;
                break;
            }
        }

        if (!isChecked) {
            alert('Please select at least one session before submitting.');
            return false;
        } else {
        var isConfirmed = confirm('Are you sure you want to submit the form?');

        if (!isConfirmed) {
            // Return false if the user clicks "Cancel"
            return false;
        }
        }

        // Return true to allow the form submission
        return true;
    }

        function redirectToReschedule(id) {
            // Assuming you want to redirect to a page named reschedule.php
            window.location.href = 'reschedule.php?id=' + id;
        }

        // Define a function to scroll to the element
        function scrollToResched() {
            document.querySelector('#resched').scrollIntoView({
                behavior: 'smooth'
            });
        }
        function scrollToResched2() {
            document.querySelector('#slot').scrollIntoView({
                behavior: 'smooth'
            });
        }
        // Conditionally call the function based on the PHP variable
        <?php if ($callFunction): ?>
            scrollToResched();
        <?php endif; 
            if ($callFunction2): ?>
            scrollToResched2();
        <?php endif; ?>

    function openPDF() {
      window.open('Final-Document_BigBoyCoders.pdf', '_blank');
    }
  </script>

<!-- SCRIPT PARA MA-REDIRECT -->
	<script>
	  function Logout(){
		window.location.href = "../login.php";
	  }
	</script>

<!-- SCRIPT PARA SA BIRTHDATE -->
	<script>
        var modal_EditProf  = document.getElementById("EditProf");
		var btn_EditProf = document.getElementById("EditProf_btn");
		var span_EditProf  = document.getElementsByClassName("close_SignUp")[0];
	  const input = document.getElementById('birthdate');
	  const today = new Date();
	  const maxDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate())
		.toISOString()
		.split('T')[0];
	  input.setAttribute('max', maxDate);

 

btn_EditProf.onclick = function () {
    modal_EditProf.style.display = "block";
}

span_EditProf.onclick = function () {
    modal_EditProf.style.display = "none";
}

	</script>

<script>
	// var Hamburger = document.getElementById("Hamburger");
	// var navs = document.getElementById("navslist");
	// var isNavVisible = true;

	// Hamburger.onclick = function () {
	// 	if (isNavVisible) {
	// 		hideNav();
	// 	} else {
	// 		showNav();
	// 	}
	// };

	// function hideNav() {
	// 	navs.style.display = "none";
	// 	Hamburger.classList.remove("fa-times");
	// 	Hamburger.classList.add("fa-bars");
	// 	isNavVisible = false;
	// }

	// function showNav() {
	// 	navs.style.display = "block";
	// 	Hamburger.classList.remove("fa-bars");
	// 	Hamburger.classList.add("fa-times");
	// 	isNavVisible = true;
	// }

	// function handleResize() {
	// 	if (window.innerWidth > 768) {
	// 		showNav();
	// 	}
	// }

	// // Listen for the resize event
	// window.addEventListener("resize", handleResize);

	// // Initially check the screen size on page load
	// handleResize();
</script>

	<!-- LOGOUT -->
	<script>
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

function retake_success() {
            // Your JavaScript function logic here
            alert("Request sent to admin. Please wait for your retakes");

            setTimeout(function() {
                history.replaceState({}, document.title, window.location.pathname);
            }, 1);
        }
function retake_failed() {
            // Your JavaScript function logic here
            alert("Request failed to send. Please try again.");

            setTimeout(function() {
                history.replaceState({}, document.title, window.location.pathname);
            }, 1);
        }        
if (window.location.href.indexOf("retake") !== -1) {
             retake_success();
}else if(window.location.href.indexOf("!Paid") !== -1) {
            retake_failed();
}
</script>
</html>