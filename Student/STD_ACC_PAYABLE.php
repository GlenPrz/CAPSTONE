<?php
session_start();
if (empty($_SESSION['username'])) {
    header("Location: ../login.php");
}
include "../conn.php";
include("EDIT_PROFILE_MDL.php");

/*
if (!isset($_SESSION['username'])) {
    // Redirect the user to the desired location (e.g., login page)
    header('Location: ../login.php');
    exit; // Make sure to exit after the redirection to prevent further code execution
}
*/

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

    } else {
        // Handle the case where no matching records were found.
    }
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
	<link href="studentstyle/stdaccpayable.css" rel="stylesheet">
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

		
			<h4 class = "description" style="display: block;">Account Payable</h4>
            <div class="main_content">
            
			<br><br>
			<?php
			if (isset($_SESSION['username'])) {

					// Assuming $std_id contains the student's ID
					$std_id = $_SESSION['idStudent'];

			// Database connection settings
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
					// Prepare and execute a query to retrieve the total_amount and balance
					$sql = "SELECT total_amount, balance FROM student WHERE idStudent = ?";
					$stmt = $conn->prepare($sql);
					$stmt->bind_param("i", $std_id);
					$stmt->execute();
					$stmt->bind_result($total_amount, $balance);

					// Fetch and display the data in the table
					if ($stmt->fetch()) {
						echo "<div style='display:flex;'>
						<h2>Total Amount: &nbsp<h2 style='color:green;'>Php " . $total_amount ."</h2></h2>
						</div>";
						echo "<div style='display: flex;'>
						<h2>Remaining balance: &nbsp<h2 style='color:red;'>Php " . $balance ."</h2></h2>
						</div><br>";
					}
					$stmt->close();
					?>
         <form id = "payForm" action="OnlinePaymentSTD.php" method="POST">
        <button class="paybtn" type="submit" name="onlpayment">
            <i class="fas fa-money-bill"></i> Pay Now
        </button>
    </form>
					<table class="result">
					<tr style='font-size:22px; font-weight: bold; background-color: #eaffe3;'>
						<td>Payment</td>
						<td>Date</td>
						<td>Time</td>
						<td>Course</td>
						<td>Action</td>
					</tr>
					<?php
					
					// Prepare and execute a query to retrieve the desired columns from student_transaction
					$sql = "SELECT Transaction_ID,Amount_paid, Submit_date, Transaction_time, Course FROM student_transaction WHERE Student_Id = ?";
					$stmt = $conn->prepare($sql);
					$stmt->bind_param("i", $std_id);
					$stmt->execute();
					$stmt->bind_result($Transaction_ID,$amount_paid, $submit_date, $transaction_time, $course);

					// Fetch and display the data in the table
					while ($stmt->fetch()) {
						echo "<tr>";
						echo "<td class='hidden-column'>$Transaction_ID</td>"; // Hide this column
						echo "<td>Php $amount_paid</td>";
						echo "<td>$submit_date</td>";
						echo "<td>$transaction_time</td>";
						echo "<td>$course</td>";
						echo "<td><a href='../Pdf/printable_Receipt.php?Transaction_ID=$Transaction_ID' target='_blank'>Print</a></td>";
						echo "</tr>";
					}

					// Close the database connection
					$stmt->close();
					$conn->close();
					}
					?>
</table>
					</div>
			</div>
		</div>

	</div>

</body>
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
	// 	Hamburger.classList.remove("fa-times");
	// 	Hamburger.classList.add("fa-bars");
	// 	navs.style.display = "none";
	// 	isNavVisible = false;
	// }

	// function showNav() {
	// 	Hamburger.classList.remove("fa-bars");
	// 	Hamburger.classList.add("fa-times");
	// 	navs.style.display = "block";
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

</html>