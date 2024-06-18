<?php
session_start();
if (empty($_SESSION['username'])) {
    header("Location: ../login.php");
}
include "../conn.php";
include("EDIT_PROFILE_MDL.php");


try {

	$sqlfeedInfoData = "SELECT * FROM u896821908_bts.feedques_tb;";
	$stmtfeedInfoData = $conn->query($sqlfeedInfoData);
	
	$Question = [];

	
	 // Fetch and store values in arrays
	 while ($rowfeedInfoData = $stmtfeedInfoData->fetch(PDO::FETCH_ASSOC)) {
		$Question[] = $rowfeedInfoData['Question'];
	}
	
	
	}catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}


$querySTDname = "SELECT Lastname, Firstname, idStudent FROM u896821908_bts.student WHERE Username = :username";
$stmtSTDname = $conn->prepare($querySTDname);

if ($stmtSTDname) {
    $stmtSTDname->bindValue(':username', $_SESSION['username'], PDO::PARAM_STR);
    $stmtSTDname->execute();

    $row = $stmtSTDname->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $lastname = $row['Lastname'];
        $firstname = $row['Firstname'];
		$_SESSION['STD_Fullname'] = $lastname. " " . $firstname;
				       $isStd = $row['idStudent'];

    } 
}
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
	<link href="studentstyle/stdfeedback.css" rel="stylesheet">
	<link rel="stylesheet" href="../modalsStyle/modal_signup.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body>
	<div class="stud_Container">
		<div class="nav_student">
			<div class="profile" id="profile-box">
				<img src="../uploads/<?php echo basename($profilePicture); ?>" alt="Profile Picture" />
				<div class="namecon">
				<span class="username"><?php echo $lastname . ", " .$firstname?></span><br>
					<span class="email">Student Id: <?php echo $isStd ?></span>
				</div>
				<!--DITO USERNAME VARIABLE NG STUDENT-->
			</div>
					<?php
						$sql = "SELECT * FROM student WHERE TDC IS NOT NULL AND username LIKE :username";

						try {
							$stmt = $conn->prepare($sql);
							$stmt->bindParam(':username', $username, PDO::PARAM_STR);
							$stmt->execute();
							// Fetch the result
							if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
								// Student is not enrolled in TDC, display another set of navigation links
								echo '
									<nav>
										<div class="nav_links" id="navslist">
											<a href="STD_HOME.php"><i class="fas fa-home"></i> Home</a>
											<a href="STD_ACC_PAYABLE.php"><i class="fas fa-money-bill"></i> Transaction</a>
											<a href="STD_MODULE_EXAM.php"><i class="fas fa-book"></i> Module / Exam</a>
											<a href="STD_EVALUATION_FORM.php"><i class="fas fa-comment"></i> Feedback</a>
											<a href="#" id="EditProf_btn"><i class="fas fa-user"></i> Edit Profile</a>
											<a href="" id="logoutLink"><i class="fas fa-sign-out-alt"></i> Log Out</a>
										</div>
										<center>
											<div class="logo_container">
												<img src="../img/bts_logo.png" class="admin_logo">
											</div><br>
											<h2 style="color: green;">Best Training School</h2>
										</center>
									</nav>';
							} else {
								echo '
									<nav>
										<div class="nav_links" id="navslist">
											<a href="STD_HOME.php"><i class="fas fa-home"></i> Home</a>
											<a href="STD_ACC_PAYABLE.php"><i class="fas fa-money-bill"></i> Transaction</a>
											<a href="STD_EVALUATION_FORM.php"><i class="fas fa-comment"></i> Feedback</a>
											<a href="#" id="EditProf_btn"><i class="fas fa-user"></i> Edit Profile</a>
											<a href="" id="logoutLink"><i class="fas fa-sign-out-alt"></i> Log Out</a>
										</div>
										<center>
											<div class="logo_container">
												<img src="../img/bts_logo.png" class="admin_logo">
											</div><br>
											<h2 style="color: green;">Best Training School</h2>
										</center>
									</nav>';
							}
						} catch (PDOException $e) {
							echo "Error: " . $e->getMessage();
						}
					?>
		</div>
		<h4 class="description">Feedback</h4>
		<div class="main_content">
			<div>
				<header><h1>Driving School Feedback Form</h1></header>
				<div class="Evaluation_Container">
					<form id="EvaluationForm" method="POST">
						<div style="padding-bottom: 18px;font-size : 24px;">Student Feedback</div>
						<div style="padding-bottom: 18px;font-size : 18px;">Please help us improve our courses by
							filling out this form.</div>
							
							<label for="data_3"><?php echo $Question[0] ?></label><br>
							<select id="data_3" class="data_3" name="data_3" required>
								<option value="" hidden disabled selected>Choose your DI</option>
								<?php
								try {

									// SQL query to fetch distinct vehicle_brand_model values
									$sql2 = "SELECT * FROM di";
									$stmt2 = $conn->prepare($sql2);
									$stmt2->execute();

									// Fetch the results and generate options
									while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
										echo '<option value="' . $row2['Lastname'] . ', ' . $row2['Firstname'] . '">' . $row2['Lastname'] . ', ' . $row2['Firstname'] . '</option>';
									}
								} catch (PDOException $e) {
									echo "Error: " . $e->getMessage();
								} finally {

								}
								?>
							</select><br><br>
						
						<div style="padding-bottom: 18px;"><?php echo $Question[1] ?><br>
							<select id="data_7" name="data_7" style="max-width : 500px;" class="form-control">
								<option value='' hidden selected disabled>Choose an answer</option>
								<option>Degree requirement</option>
								<option>Personal interest</option>
							</select>
						</div>
						
						<div style="padding-bottom: 18px;"><?php echo $Question[2] ?><br>
							<select id="data_9" name="data_9" style="max-width : 500px;" class="form-control">
								<option value='' hidden selected disabled>Choose an answer</option>
								<option>Very good</option>
								<option>Good</option>
								<option>Fair</option>
								<option>Poor</option>
								<option>Very poor</option>
							</select>
						</div>
						
						<div style="padding-bottom: 18px;"><?php echo $Question[3] ?><br>
							<select id="data_10" name="data_10" style="max-width : 500px;" class="form-control">
								<option value='' hidden selected disabled>Choose an answer</option>
								<option>Very good</option>
								<option>Good</option>
								<option>Fair</option>
								<option>Poor</option>
								<option>Very poor</option>
							</select>
						</div>
						
						<div style="padding-bottom: 18px;"><?php echo $Question[4] ?><br>
							<select id="data_11" name="data_11" style="max-width : 500px;" class="form-control">
								<option value='' hidden selected disabled>Choose an answer</option>
								<option>Very good</option>
								<option>Good</option>
								<option>Fair</option>
								<option>Poor</option>
								<option>Very poor</option>
							</select>
						</div>
						
						<div style="padding-bottom: 18px;"><?php echo $Question[5] ?><br>
							<select id="data_12" name="data_12" style="max-width : 500px;" class="form-control">
								<option value='' hidden selected disabled>Choose an answer</option>
								<option>Very good</option>
								<option>Good</option>
								<option>Fair</option>
								<option>Poor</option>
								<option>Very poor</option>
							</select>
						</div>
						
						<div style="padding-bottom: 18px;"><?php echo $Question[6] ?><br />
							<select id="data_8" name="data_8" style="max-width : 500px;" class="form-control">
								<option value='' hidden selected disabled>Choose an answer</option>
								<option>Yes</option>
								<option>No</option>
								<option>Not sure</option>
							</select>
						</div>
						<center><button class="paybtn" type="submit" name="onlpayment">Submit</button></center><br>
					</form>
				</div>
			</div>
		</div>

	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
    $('#EvaluationForm').submit(function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Serialize form data
        var formData = $(this).serialize();

        // Reference to the form element
        var form = this;

        // Send AJAX request
        $.ajax({
            type: 'POST', // Change this to your desired HTTP method (POST/GET)
            url: 'STD_Eval_script.php', // Replace with the URL of your server-side script
            data: formData,
            success: function (response) {
                if (response.includes("Data inserted successfully!")) {
                    alert("FEEDBACK ACCEPTED");

                    // Reset the form
                    form.reset();
                }
                console.log(response);
                // You can update the page or show a success message
            },
            error: function (error) {
                // Handle any errors here
                console.error('Error:', error);
            }
        });
    });
});
    </script>


	<!-- SCRIPT PARA MA-REDIRECT -->
	

	<!-- SCRIPT PARA SA BIRTHDATE -->
	<script>
		var modal_EditProf = document.getElementById("EditProf");
		var btn_EditProf = document.getElementById("EditProf_btn");
		var span_EditProf = document.getElementsByClassName("close_SignUp")[0];
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
	</script>
</body>


</html>