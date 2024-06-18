<?php 
session_start();
include "conn.php";
include("EDIT_NOT_ENROLL.php");

try {
    $query = "SELECT * FROM u896821908_bts.newupdate";
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="./Student/STUDENT_PORTAL.css">
	<link rel="stylesheet" href="./modalsStyle/modal_signup.css">

    <style>
        * {
            padding: 0%;
            margin: 0%;
            box-sizing: border-box;
            border: none;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .mobile-container {
            max-width: 100%;
            margin: auto;
            height: 200px;
            color: white;
            border-radius: 10px;
        }

        .topnav {
            overflow: hidden;
            position: relative;
        }

        .topnav #myLinks {
            display: none;
        }

        .topnav a {
            float: left;
            color: black;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .topnav #myLinks a {
            margin-top: 5%;
        }

        .topnav a.icon {
            float: right;
        }

        .logo {
            width: 100px;
            height: 100px;

        }

        .active {
            margin-left: 10%;
            margin-top: 2%;
        }

        .Username_img {
            width: 100px;
            height: 100px;
            float: right;
            margin-top: 5%;
        }

        .username_user {
            margin-top: 8%;
        }

        .username_user h3 {
            font-size: 30px;
        }

        .Content_container {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
        }

        .left_content_container {
            width: 50%;
            padding: 2%;
        }

        .right_content_container {
            display: flex;
            flex-direction: column;
            width: 50%;
        }

        .right_content_container h1 {
            text-align: center;
            font-size: 42px;
            width: 70%;
            margin: auto auto;
            margin-top: 2%;
            background-color: white;
            color: #0E8341;
            font-family: 'Inter', sans-serif;
        }

        .right_content_container button {
            width: 200px;
            height: 80px;
            font-size: 20px;
            font-weight: bold;
            margin: auto auto;
            padding: 2%;
            color: white;
            background-color: #4ABB2E;
            border-radius: 10px;
        }

        .mySlides {
            display: none;
        }

        .img_carosel {
            vertical-align: middle;
        }

        /* Slideshow container */
        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }

        /* Caption text */
        .text {
            color: #f2f2f2;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        /* The dots/bullets/indicators */
        .dot {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active_carosel {
            background-color: #717171;
        }

        /* Fading animation */
        .fade {
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }
        .dropdown {
            position: relative;
            float: right;
            top: 70px;
            margin-right: 10%;
        }
         .dropdown-icon {
            display: inline-block;
            width: 40px;
            height: 40px;
           background: url('./img/menu.png') center center no-repeat;
           background-size: cover;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            min-width: 160px;
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
          .dropdown-content a:hover {
            background-color: lightgray;
            color: white;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .img1 {
            width: 150px;
            height: 300px;
        }

        .img2 {
            width: 150px;
            height: 300px;
        }

        .img3 {
            width: 150px;
            height: 300px;
        }

        footer {
            display: flex;
            justify-content: center;
        }

        footer a {
            text-align: center;
            margin: 1%;
            font-weight: lighter;
            color: #000000;
            text-decoration: none;
        }

        footer a:active {
            text-align: center;
            margin: 1%;
            font-weight: lighter;
            color: #000000;
            text-decoration: none;
        }
        @media screen and (min-width: 425px) and (max-width: 767px){

            body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .mobile-container {
            max-width: 100%;
            margin: auto;
            height: 200px;
            color: white;
            border-radius: 10px;
        }

        .topnav {
            overflow: hidden;
            position: relative;
        }

        .topnav #myLinks {
            display: none;
        }

        .topnav a {
            float: left;
            color: black;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
    
        }

        .topnav #myLinks a {
            margin-top: 5%;
        }

        .topnav a.icon {
            float: right;
        }

        .logo {
            width: 100px;
            height: 100px;

        }

        .active {
            margin-left: 10%;
            margin-top: 2%;
        }

        .Username_img {
            width: 100px;
            height: 100px;
            float: right;
            margin-top: 5%;
        }

        .username_user {
            margin-top: 3%;

        }

        .username_user h3 {
            font-size: 30px;
        }

        .Content_container {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
        }

        .left_content_container {
            width: 50%;
            padding: 2%;
        }

        .right_content_container {
            display: flex;
            flex-direction: column;
            width: 50%;
        }

        .right_content_container h1 {
            text-align: center;
            font-size: 32px;
            width: 70%;
            margin: auto auto;
            margin-top: 2%;
            background-color: white;
            color: #0E8341;
            font-family: 'Inter', sans-serif;

        }

        .right_content_container button {
            width: 200px;
            height: 80px;
            font-size: 20px;
            font-weight: bold;
            margin: auto auto;
            padding: 2%;
            color: white;
            background-color: #4ABB2E;
            border-radius: 10px;
        }

        .mySlides {
            display: none;
        }

        .img_carosel {
            vertical-align: middle;
        }

        /* Slideshow container */
        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }

        /* Caption text */
        .text {
            color: #f2f2f2;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        /* The dots/bullets/indicators */
        .dot {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active_carosel {
            background-color: #717171;
        }

        /* Fading animation */
        .fade {
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }
        .dropdown {
            position: relative;
            float: right;
            top: 70px;
            margin-right: 10%;
        }
         .dropdown-icon {
            display: inline-block;
            width: 40px;
            height: 40px;
           background: url('./img/menu.png') center center no-repeat;
           background-size: cover;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            min-width: 160px;
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
          .dropdown-content a:hover {
            background-color: lightgray;
            color: white;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .img1 {
            width: 150px;
            height: 300px;
        }

        .img2 {
            width: 150px;
            height: 300px;
        }

        .img3 {
            width: 150px;
            height: 300px;
        }

        footer {
            display: flex;
            justify-content: center;
        }

        footer a {
            text-align: center;
            margin: 1%;
            font-weight: lighter;
            color: #000000;
            text-decoration: none;
        }

        footer a:active {
            text-align: center;
            margin: 1%;
            font-weight: lighter;
            color: #000000;
            text-decoration: none;
        }
        }

    </style>
</head>

<body>
    <nav>
         <div class="dropdown">
        <div class="dropdown-icon"></div>
        <div class="dropdown-content">
            <a href="#" id="logoutLink">Logout</a>
            <a href="#">Feedback</a>
            <p href="#" id="EditProf_btn">Edit Profile</p>
        </div>
    </div>
        <div class="mobile-container">
            <div class="topnav">
                <a href="#home" class="active"><img src="./img/bts_logo.png" class="logo"></a>
                <img src="./uploads/<?php echo basename($profilePicture); ?>" class="Username_img" style="max-width: 150px; max-height: 150px; border-radius: 50%; object-fit: cover; border: 2px solid black;">
                <?php echo $profilePicture; ?>
                <a href="#" class="icon username_user">
                    <h3><?php echo $_SESSION['username'] ?></h3>
                </a>

            </div>
        </div>
    </nav>
    <div class="Content_container">
        <div class="left_content_container">


            <div class="slideshow-container">

            <?php foreach ($images as $key => $image): ?>
        <div class="mySlides fade">
            <div class="numbertext"><?php echo $key + 1; ?> / <?php echo count($images); ?></div>
            <img src="./img/drive-download-20230614T125330Z-001/<?php echo basename($image['PICTURE']); ?>" style="width:100%" class="img_carosel img<?php echo $key + 1; ?>">
        </div>
    <?php endforeach; ?>

            </div>
            <br>

            <div style="text-align:center">
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>
        <div class="right_content_container">
            <h1>Welcome To Best
                Training School! <br><br>
                Where the best
                drivers are trained</h1>
            <button id="enrollBtn">ENROLL NOW</button>
        </div>
    </div>
    <div class="Footer_container">
        <footer>
            <h3>BTS Driving School
                C&N BLDG. M. ALMEDA ST., BRGY SAN ROQUE
                TEL NO.: (02)8723-0574 MOBILE NO.: (+63)921-5447612</h3>
        </footer>
    </div>


    <script>
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active_carosel", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active_carosel";
            setTimeout(showSlides, 2000); // Change image every 2 seconds
        }


        function myFunction() {
            var x = document.getElementById("myLinks");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }
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

var defaultImage = $('<img id="defaultProfileImage">');
defaultImage.attr("src", "./uploads/<?php echo basename($profilePicture); ?>");
defaultImage.addClass("preview-image");
defaultImage.css("max-width", "150px");
defaultImage.css("max-height", "150px");
defaultImage.css("border-radius", "50%");
defaultImage.css("object-fit", "cover");
defaultImage.css("border", "2px solid black"); // Add black border
$(".imgPrev").empty();
$(".imgPrev").append(defaultImage);


		// Test if file is selected
		$("#profile_picture").change(function () {
			var file = this.files[0];
			if (file) {
				console.log('File selected:', file.name);
			} else {
				console.log('No file selected.');
			}
		});

	</script>

<script>
  // Function to handle the enrollment process
  function enrollStudent() {
    // Get the username from the session variable (assuming it's already set)
    const username = "<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>";

    // Send the data using AJAX with the POST method
    $.ajax({
      type: "POST",
      url: "Temp_enroll.php",
      data: { username: username }, // Send the username as a POST parameter
      success: function (response) {
        // Handle the response from the server
        window.location.href = "Enrollment_profile.php";
    },
      error: function (error) {
        // Handle errors if any (optional)
        console.error("Error enrolling student:", error);
      }
    });
  }

  // Bind the enrollStudent function to the button click event
  $(document).ready(function () {
    $("#enrollBtn").click(function () {
      enrollStudent(); // Call enrollStudent function when the button is clicked
    });

    $('#logoutLink').click(function(event) {
        event.preventDefault(); // Prevent the default link behavior
        $.ajax({
            url: 'logout.php', // The URL of your PHP script to handle logout
            type: 'POST', // You can also use 'GET' if your server configuration allows
            success: function(response) {
                // Redirect to login.php on successful logout
                window.location.href = 'login.php';
            },
            error: function(xhr, status, error) {
                console.error(error); // Log any errors to the console
            }
        });
  });
});
</script>
</body>

</html>