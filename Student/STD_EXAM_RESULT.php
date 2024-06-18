<?php
session_start();
include "../conn.php";
include("EDIT_PROFILE_MDL.php");


$pdfArray = [];

    $sql = "SELECT * FROM admin_module_exam_pdf WHERE idadmin_module_exam_pdf = 4";
    $stmt = $conn->query($sql);
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $id = $row['idadmin_module_exam_pdf'];
        $reviewerPDF = $row['pdf'];
        }
    }else {
        echo "No rows found.";
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
	<link rel="stylesheet" href="STD_NAV.css">
	<link rel="stylesheet" href="STUDENT_PORTAL.css">
	<link rel="stylesheet" href="../modalsStyle/modal_signup.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<style>
	* {
		font-family: 'Inter', sans-serif;
	}

	.nav_links a:nth-child(3) {
		background-color: green;
		border-radius: 10px;
		color: white;
	}
	.Evaluation_Container {
		margin: auto;
		width: 95%;
		height:50%;
		border-radius: 10px;
		border: 2px solid #c4c2c2;
		background-color: #f2f2f2;
		margin-bottom: 3%;
	}

	.exam-eval {
		margin: 0% 0% 2% 4%;
		color: green;
	}
	
	.exam-eval.failed{
		color: red;
	}

	.btn-proc {
		display: inline-block;
        margin-top:2%;
		margin-bottom:1%;
		width: 300px;
		height: 50px;
        border-radius: 5px;
        font-size: 24px;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
		line-height: 43px;
        vertical-align: middle;
		font-family: 'Inter', sans-serif;
		border: none;
		background-color: green;
        color: white;
		letter-spacing: 3px;
	}
	.btn-proc:hover{
		background-color: #042e04;
	}
	
	.btn-review {
		display: inline-block;
        margin-top:2%;
		margin-bottom:1%;
		width: 200px;
		height: 45px;
        border-radius: 5px;
        font-size: 20px;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
		line-height: 43px;
        vertical-align: middle;
		font-family: 'Inter', sans-serif;
		border: none;
		background-color: #f7de4f;
        color: #141414;
		letter-spacing: 3px;
	}
	.btn-review:hover{
		background-color: #4f471b;
		color: white;
	}
	
	 .Result_container {
	  font-size: 24px;
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
    }
	hr{
			border: none;
			height: 1.3px;
			background-color: rgba(0, 0, 0, 0.2);
	}
		.main_content{
		width: 70%;
		height: 100%;
		float: left;
		margin-left: 25%;
	}.nav_student{
		float: left;
    width: 20%;
    background-color: #f7fff5;
    box-shadow: 2px 7px 8px #E4F5E4; 
    gap: 2%;
	margin-right: .5%;
	top: 0; /* Stick to the top of the viewport */
    left: 0; /* Stick to the left edge of the viewport */
    position: fixed;
	}
</style>

<body>
	<div class="stud_Container">
		<div class="nav_student">
				<div class="profile" id="profile-box">
						<img src="../uploads/<?php echo basename($profilePicture); ?>" alt="Profile Picture" />
						<div class="namecon">
							<span class="username"><?php echo $_SESSION['username'] ?></span><br>
							<span class="email">sample@email.com</span>
						</div>
						<!--DITO USERNAME VARIABLE NG STUDENT-->
					</div>	
			<nav>
				<div class="nav_links" id="navslist">
					<a href="STD_HOME.php"><i class="fas fa-home"></i> Home</a>
					<a href="STD_ACC_PAYABLE.php"><i class="fas fa-money-bill"></i> Transaction</a>
					<a href="STD_MODULE_EXAM.php"><i class="fas fa-book"></i> Module / Exam</a>
					<a href="STD_EVALUATION_FORM.php"><i class="fas fa-comment"></i> Feedback</a>
					<a href="#" id="EditProf_btn"><i class="fas fa-user"></i> Edit Profile</a>
					<a href="" id="logoutLink"><i class="fas fa-sign-out-alt"></i> Log Out</a>
				</div>
				<center><div class="logo_container">
                        <img src="../img/bts_logo.png" class="admin_logo">
                    </div></center>
			</nav>
		</div>

		<div>
			<h4 class="description">Result of Exam</h4>
			<?php
			//Get the Topivariable sa STD_EXAM
						$TopicSelected = $_SESSION['Topic'];
					
					  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
						// Connect to the MySQL database
						$servername = "localhost";
                        $username = "u896821908_bts";
                        $password = "a*5E4UEhsHa]";
                        $dbname = "u896821908_bts";

						$conn = mysqli_connect($servername, $username, $password, $dbname);
						
						
						
						// Check connection
						if (!$conn) {
						  die("Connection failed: " . mysqli_connect_error());
						}

						// Retrieve questions from the database
						$sql = "SELECT * FROM questions WHERE topic = '$TopicSelected'";
						$result = mysqli_query($conn, $sql);

						// Variable to store the number of correct answers
						$correctAnswers = 0;

						// Calculate the number of correct answers
						if (mysqli_num_rows($result) > 0) {
						  while ($row = mysqli_fetch_assoc($result)) {
							$qid = $row['qid'];
							$correctAnswer = $row['correct_answer'];

							if (isset($_POST['answer' . $qid]) && $_POST['answer' . $qid] === $correctAnswer) {
							  $correctAnswers++;
							}
						  }
						}

					// Get the total number of questions
						$totalQuestions = mysqli_num_rows($result);
						$wrongAnswers =  $totalQuestions -  $correctAnswers;
						
					//Passing score is 75%
						$passingThreshold = 0.75; // 75%

						if ($correctAnswers >= ($passingThreshold * $totalQuestions)) {
							$ExamStatus = "Passed";
						} else {
							$ExamStatus = "Failed";
						}
						?>
			
			<div class="main_content">

						<div class="Evaluation_Container">
							<div class="Result_container">
							
							<?php
								// Display the results
								echo '<center><br><br><h2>'.$TopicSelected.' Quiz Result</h2><hr><br>';
								echo '<p>Total number of questions: ' . $totalQuestions . '</p>';
								echo '<p>Total correct answers: ' . $correctAnswers . '</p>';
								echo '<p>Total wrong answers: ' . $wrongAnswers . '</p><br>';
								
								if ($ExamStatus === "Passed") {
									echo '<h1 class="exam-eval">You passed the Exam!</h1></center>';
								}else{
									echo '<h1 class="exam-eval failed">Sorry, You failed</h1></center>';
								}
								
								if($TopicSelected === "Module 1"){
									$session_num = 1;
								}elseif($TopicSelected === "Module 2"){
									$session_num = 2;
								}elseif($TopicSelected === "Module 3"){
									$session_num = 3;
								}	
								
								if ($ExamStatus === "Failed"){
								echo '<center><a href="../uploads/pdf_modules/' . basename($reviewerPDF) . '" target="_blank" class="btn-review">Reviewer</a></center>';
								}
								
									// Data to be inserted
									$username = $_SESSION['username'];
									$score = $correctAnswers;
									$result = $ExamStatus;

									// Prepare the SQL query
									$sql = "INSERT INTO student_result (username, Session_num, Score, result, num_of_wrong_ans) 
											VALUES ('$username', $session_num, $score, '$result', $wrongAnswers )";

									// Execute the query
									if ($conn->query($sql) === TRUE) {
									} else {
										echo "Error: " . $sql . "<br>" . $conn->error;
									}
									
								// Close the database connection
								mysqli_close($conn);
							  }
							?>
						  </div>
					</div>
					
						<center><button class="btn-proc" onclick="Proceed()">Proceed</button></center>
			</div>
		</div>

	</div>
	
	
	<!-- SCRIPT PARA MA-REDIRECT -->
	<script>
	  function Logout(){
		window.location.href = "../login.php";
	  }
	  
	  function Proceed(){
		window.location.href = "./STD_MODULE_EXAM.php";
	  }
	</script>
	
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
		var Hamburger = document.getElementById("Hamburger");
		var navs = document.getElementById("navslist");
		var isNavVisible = true;

		Hamburger.onclick = function () {
			if (isNavVisible) {
				hideNav();
			} else {
				showNav();
			}
		};

		function hideNav() {
			navs.style.display = "none";
			Hamburger.classList.remove("fa-times");
			Hamburger.classList.add("fa-bars");
			isNavVisible = false;
		}

		function showNav() {
			navs.style.display = "block";
			Hamburger.classList.remove("fa-bars");
			Hamburger.classList.add("fa-times");
			isNavVisible = true;
		}

		function handleResize() {
			if (window.innerWidth > 768) {
				showNav();
			}
		}

		// Listen for the resize event
		window.addEventListener("resize", handleResize);

		// Initially check the screen size on page load
		handleResize();
	</script>
	 <script>
        // Disable back button
			history.pushState(null, null, document.URL);
			window.addEventListener('popstate', function () {
            history.pushState(null, null, document.URL);
			});

        // Disable page refresh (F5, Ctrl+R, etc.)
       window.onbeforeunload = function () {
           return "You are about to leave this page. Are you sure?";
       };
       
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