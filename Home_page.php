<?php
include("Navbar_login.html");
include("conn.php");

session_start();


if (!empty($_SESSION['AdminSessionDash'])) {
    header("Location: ../Admin/admin_dash.php");
}

if (!empty($_SESSION['StudentSessionDash'])) {
    header("Location: ../Student/STD_HOME.php");
}

if (!empty($_SESSION['DISessionDash'])) {
    header("Location: ../DrivingInstructor/di_dashboard.php");

}

try {

	$sqlInfoDataAboutUs = "SELECT * FROM u896821908_bts.info_tb where info_id = 7;";
	$stmtInfoDataAboutUs = $conn->query($sqlInfoDataAboutUs);
	
	$titleDataAboutUs = [];
	$descriptionDataAboutUs = [];

	
	 // Fetch and store values in arrays
	 while ($row = $stmtInfoDataAboutUs->fetch(PDO::FETCH_ASSOC)) {
		$titleDataAboutUs[] = $row['title'];
		$descriptionDataAboutUs[] = $row['description'];
	}

	$sqlInfoData = "SELECT * FROM u896821908_bts.course_enrolled where Course = 'General Information'";
    $stmtInfoData = $conn->query($sqlInfoData);
    
    $idCourse_EnrolledArray = [];
    $CourseArray = [];
    $Course_infoArray = [];
    $VechileArray = [];
    $InfoArray = [];
    $PriceArray = [];

     // Fetch and store values in arrays
     while ($row = $stmtInfoData->fetch(PDO::FETCH_ASSOC)) {
        $idCourse_EnrolledArray[] = $row['idCourse_Enrolled'];
        $CourseArray[] = $row['Course'];
        $Course_infoArray[] = $row['Course_info'];
        $VechileArray[] = $row['Vechile(Type)'];
        $InfoArray[] = $row['Info'];
       $PriceArray[] = number_format(intval($row['Price']), 0, '', ',');

    }




    $query = "SELECT * FROM u896821908_bts.newupdate;";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>BTS Driving school</title>
	  <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="./modalsStyle/modal_signup.css?version=1" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="./design/general/homepage.css">
	<link rel="stylesheet" href="./design/general/navbar.css">
   <!-- <link rel="icon" href="img\bts_logo.png" type="image/png"> -->

</head>
<style>


</style>
</head>

<body>
	<div class="Content_container_Home">
		<div class="slide_show">
			<div class="slideshow-container">
				<?php foreach ($images as $key => $image): ?>
				<div class="mySlides fade">
					<div class="numbertext"><?php echo $key + 1; ?> / <?php echo count($images); ?></div>
					<img src="./img/drive-download-20230614T125330Z-001/<?php echo basename($image['PICTURE']); ?>"
						class="Img_design_slider" data-id="<?php echo basename($image['PICTURE']); ?>"
						data-count="<?php echo $key + 1; ?>">
				</div>
				<?php endforeach; ?>

				<div>
					<a class="prev" onclick="plusSlides(-1)">❮</a>
					<a class="next" onclick="plusSlides(1)">❯</a>
				</div>

				<div class="dotters" style="text-align:center">
					<?php foreach ($images as $key => $image): ?>
					<span class="dot" onclick="currentSlide(<?php echo $key + 1; ?>)"></span>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<div class="featured_courses_services">
			<h2>Featured courses</h2>
			<div class="box_container">
				<div class="TDC_PDC_BOX">
					<div class="img_container">
						<img src=".\img\drive-download-20230614T125330Z-001\bts_tdc.jpg" alt="tdc Image">
					</div>
					<h4><?php echo $Course_infoArray[0]?></h4>
					<p><?php echo $InfoArray[0]?></p>
					<div class="enroll-section">
						<span class="starts-at">Starts at Php <?php echo $PriceArray[0] ?> &nbsp </span>
						<button class="enroll-button" id="Enrollbtn1">Enroll Now</button>
					</div>
				</div>

				<div class="TDC_PDC_BOX">
					<div class="img_container">
						<img src=".\img\drive-download-20230614T125330Z-001\bts_motor.jpg" alt="pdc_mc Image">
					</div>
					<h4><?php echo $Course_infoArray[1]?></h4>
					<p><?php echo $InfoArray[1]?></p>
					<div class="enroll-section">
						<span class="starts-at">Starts at Php <?php echo $PriceArray[1]?> &nbsp </span>
						<button class="enroll-button" id="Enrollbtn2">Enroll Now</button>
					</div>
				</div>

				<div class="TDC_PDC_BOX">
					<div class="img_container">
						<img src=".\img\drive-download-20230614T125330Z-001\bts_car.jpg" alt="pdc_c Image">
					</div>
					<h4><?php echo $Course_infoArray[2]?></h4>
					<p><?php echo $InfoArray[2]?></p>
					<div class="enroll-section">
						<span class="starts-at">Starts at Php <?php echo $PriceArray[2]?> &nbsp </span>
						<button class="enroll-button" id="Enrollbtn3">Enroll Now</button>
					</div>
				</div>
			</div>
		</div>

		<div class="about_us">
			<br>
			<center>
	<h2 style="color: green;"><?php echo $titleDataAboutUs[0] ?></h2>
			</center>
			<div class="abt_in_container">
				<div class="abt_divide_left">
					<img src="img/bts_logo.png" class="logo-large BTS">
				</div>
				<div class="abt_divide_mid">
					<p class="Text_information_BTS" style="letter-spacing: 3px; line-height: 1.5; text-align: justify;">
                        <?php echo $descriptionDataAboutUs[0] ?>
                    </p>

					<br>
					    <button id="readMoreBtn">Read More</button>

				</div>
				<div class="abt_divide_right">
					<center>
						<img src=".\img\drive-download-20230614T125330Z-001\LTO logo.png" class="logo-large LTO"><br>
						<h4>Accredited by LTO since 2021.<h4>
					</center>
				</div>
			</div>
		</div>

		
	</div>


	<!-- The Forgot_modal -->
	<div id="modalforgot" class="modal">

		<div class="modal-content">
			<span class="close-button_forgot" onclick="closeForgot_modal()">&times;</span>
			<br>
			<h2>FORGOT PASSWORD </h2>
			<input type="text" placeholder=" Username" class="User_forgot"><br><br>
			<input type="text" placeholder=" Email" class="Email_forgot"><br><br>
			<input type="text" placeholder=" Verification Code" class="Code"><br><br>
			<button class="cancel-button" onclick="closeForgot_modal()">Cancel</button>
			<button class="submit-button">Submit</button>
		</div>
	</div>

	<!-- The contact modal -->
	<div id="modal_cntct" class="modal">
	    <form id = "contact_form">
		<div class="modal-content">
			<span class="close-button">&times;</span>
			<div class="inputs">
        <h2>Contact Us</h2>
        <div class="form-group">
            <label for="first-name">First Name:</label>
            <input type="text" id="first-name" name="first-name" required pattern="[A-Za-z]+" title="First Name should contain only letters">
        </div>
        <div class="form-group">
            <label for="last-name">Last Name:</label>
            <input type="text" id="last-name" name="last-name" required pattern="[A-Za-z]+" title="Last Name should contain only letters>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
<input type="email" id="email" name="email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Enter a valid email address">
        </div>
        <div class="form-group">
            <label for="contact-number">Contact Number:</label>
<input type="text" id="contact-number" name="contact-number" required pattern="09\d{9}" title="Enter a valid 11-digit number starting with 09" maxlength="11">
        </div>
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea id="message" name="message" required maxlength="255"></textarea>
        </div>
        <center><button type="submit">Submit</button></center>
    </div><br>
			<div class="contact">
			    <div class="contact-info">
				<img class="contact-icon" src="./img/caller.png" alt="Contact Number Icon">
				<p>09215447612 / 02-87230574</p>
			</div>
			<div class="contact-info">
				<img class="contact-icon" src="./img/fbitch.png" alt="Facebook Icon">
				<p>BTS Driving School-Pateros</p>
			</div>
			<div class="contact-info">
				<img class="contact-icon" src="./img/mapa.png" alt="Address Icon">
				<p>C & N BLDG. ALMEDA ST. SAN ROQUE, PATEROS,
					METRO MANILA</p>
			</div>
			<div class="contact-info">
				<img class="contact-icon" src="./img/emoil.png" alt="Email Icon">
				<p>besttrainingschool101@gmail.com</p>
			</div>
			</div>
		</div>
		</form>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
	<script src="modal_script_index.js"></script>
	<script src="script_login_index.js"></script>
	<!--For capitalization of every word-->
	<!-- <script>
    // var genderField = document.querySelector('.gender');
    // genderField.setCustomValidity('Choose your gender');

    // // Reset validation message when an option is selected
    // genderField.addEventListener('change', function () {
    //   this.setCustomValidity('');
    // });

    // function capitalizeWords(value) {
    //   value = value.replace(/\s{2,}/g, ' '); // Replace consecutive spaces with a single space

    //   return value.replace(/\b\w/g, function (match) {
    //     return match.toUpperCase();
    //   }).replace(/\b\w+/g, function (match) {
    //     return match.charAt(0).toUpperCase() + match.slice(1).toLowerCase();
    //   });
    // }

    var passwordInput = document.getElementById("password");
var checkIcons = document.querySelectorAll("#check-icon");
var xIcons = document.querySelectorAll("#x-icon");

// When the user interacts with the password input
passwordInput.addEventListener("focus", function() {
  document.getElementById("message").style.display = "block";
});

passwordInput.addEventListener("blur", function() {
  document.getElementById("message").style.display = "none";
});

passwordInput.addEventListener("keyup", function() {
  var lowercaseRegex = /[a-z]/;
  var uppercaseRegex = /[A-Z]/;
  var numberRegex = /[0-9]/;
  var minLength = 8;

  var lowercaseValid = lowercaseRegex.test(passwordInput.value);
  var uppercaseValid = uppercaseRegex.test(passwordInput.value);
  var numberValid = numberRegex.test(passwordInput.value);
  var lengthValid = passwordInput.value.length >= minLength;

  document.getElementById("letter").classList.toggle("invalid", !lowercaseValid);
  document.getElementById("capital").classList.toggle("invalid", !uppercaseValid);
  document.getElementById("number").classList.toggle("invalid", !numberValid);
  document.getElementById("length").classList.toggle("invalid", !lengthValid);

  for (var i = 0; i < checkIcons.length; i++) {
    checkIcons[i].style.display = "none";
  }
  for (var i = 0; i < xIcons.length; i++) {
    xIcons[i].style.display = "inline-block";
  }

  if (lowercaseValid) {
    document.getElementById("letter").querySelector("#check-icon").style.display = "inline-block";
    document.getElementById("letter").querySelector("#x-icon").style.display = "none";
  }
  if (uppercaseValid) {
    document.getElementById("capital").querySelector("#check-icon").style.display = "inline-block";
    document.getElementById("capital").querySelector("#x-icon").style.display = "none";
  }
  if (numberValid) {
    document.getElementById("number").querySelector("#check-icon").style.display = "inline-block";
    document.getElementById("number").querySelector("#x-icon").style.display = "none";
  }
  if (lengthValid) {
    document.getElementById("length").querySelector("#check-icon").style.display = "inline-block";
    document.getElementById("length").querySelector("#x-icon").style.display = "none";
  }
});

  </script> -->







	<script>
	
	$(document).ready(function(){
    $("#contact_form").submit(function(event){
        // Prevent the default form submission
        event.preventDefault();

        // Serialize form data
        var formData = $(this).serialize();

        // Send the form data to the server using AJAX
        $.ajax({
            type: "POST",
            url: "../contact_us_insert.php",
            data: formData,
            success: function(response){
                // Handle the successful AJAX request here
                console.log(response);

                // Check the response from the server
                if(response.trim() === "success"){
                    // Show success alert
                    alert("Data inserted successfully!");
$("#modal_cntct").hide();

                    // Clear the form
                    $("#contact_form")[0].reset();
                } else {
                    // Handle other responses if needed
                    alert("Insert failed. Please try again.");
                }
            },
            error: function(error){
                // Handle errors here
                console.error(error);
                alert("An error occurred. Please try again later.");
            }
        });
    });
});
	
	
	
	
	
	
	
		// Get the modal
		$(document).ready(function () {
			// Attach click event handler to the button

			$("#Enrollbtn1").click(function () {
				window.location.href = "./login.php"; // Replace with your specific link
			});

			$("#Enrollbtn2").click(function () {
				window.location.href = "./login.php"; // Replace with your specific link
			});

			$("#Enrollbtn3").click(function () {
				window.location.href = "./login.php"; // Replace with your specific link
			});
		});

		let slideIndex = 0;
		let slideshowInterval = 2000; // Initial interval in milliseconds
		let slideshowTimeout;
		let slides = document.getElementsByClassName("mySlides"); // Define slides globally

		showSlides();

		function plusSlides(n) {
			clearTimeout(slideshowTimeout); // Clear the automatic slideshow timeout
			slideshowInterval = 5000; // Set a longer interval when manually changing slides
			slideIndex += n;
			if (slideIndex >= slides.length) {
				slideIndex = 0;
			} else if (slideIndex < 0) {
				slideIndex = slides.length - 1;
			}
			showSlides();
		}

		function showSlides() {
			let i;
			let dots = document.getElementsByClassName("dot");

			for (i = 0; i < slides.length; i++) {
				slides[i].style.display = "none";
			}
			for (i = 0; i < dots.length; i++) {
				dots[i].className = dots[i].className.replace(" active_carosel", "");
			}
			slides[slideIndex].style.display = "block";
			dots[slideIndex].className += " active_carosel";

			slideshowTimeout = setTimeout(plusSlides, slideshowInterval, 1); // Change image with the appropriate interval
		}
		// Function to prevent navigation via the back button
		function disableBackButton() {
			window.history.pushState(null, '', window.location.href);
			window.onpopstate = function (event) {
				window.history.pushState(null, '', window.location.href);
			};
		}

		// Call the function when the page loads
		window.onload = function () {
			disableBackButton();
		};
	</script>
<script>
     var description = "<?php echo addslashes($descriptionDataAboutUs[0]); ?>";
    var maxLength = 200;
    var isExpanded = false;

    function updateDescription() {
        if (isExpanded) {
            document.querySelector('.Text_information_BTS').textContent = description.substr(0, maxLength) + '...';
            document.getElementById('readMoreBtn').textContent = 'Read More';
        } else {
            document.querySelector('.Text_information_BTS').textContent = description;
            document.getElementById('readMoreBtn').textContent = 'Read Less';
        }
        isExpanded = !isExpanded;
    }

    // Make sure the button element exists before adding an event listener
    var readMoreBtn = document.getElementById('readMoreBtn');
    if (readMoreBtn) {
        readMoreBtn.addEventListener('click', function() {
            updateDescription();
        });

        // Initial setup: truncate description if it's longer than maxLength
        if (description.length > maxLength) {
            updateDescription();
        }
    }
</script>
<!-- Home page about us see more-->
	
</body>