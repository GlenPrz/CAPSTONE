<?php
include("Navbar_login.html");
include("conn.php");

try {

	$sqlInfoData = "SELECT * FROM u896821908_bts.info_tb where info_id = 7;";
	$stmtInfoData = $conn->query($sqlInfoData);
	
	$title = [];
	$description = [];

	
	 // Fetch and store values in arrays
	 while ($row = $stmtInfoData->fetch(PDO::FETCH_ASSOC)) {
		$title[] = $row['title'];
		$description[] = $row['description'];
	}
	
	
	}catch (PDOException $e) {
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./design/general/index.css">
    <link rel="stylesheet" href="./design/general/navbar.css">
    <link rel="stylesheet" href="./modalsStyle/modal_contactUs.css">

</head>
<style>
.body{
    background-color: rgba(137, 245, 150, .2);
}
	.about_us{
	  padding: 30px;
	  margin: auto;
	  margin-top: 1.5%;
	  width: 100%;
	  height: 550px; /* Set a specific height for the slideshow */
	  background-color: rgba(137, 245, 150, .2);
	}
	.about_us h2{
		font-size: 40px;
	}
	.abt_in_container {
	  display: flex;
	  width: 100%;
	  height: 100%;
	}

	.abt_divide_left{
	  margin: auto;
	  width: 10%;
	  height: 80%;
	}
	.abt_divide_mid{
	  margin: auto;
	  width: 60%;
	  height: 80%;
	}
	.abt_divide_right {
	  margin: auto;
	  width: 10%;
	  height: 80%;
	}
	.abt_divide_right .logo-large, .abt_divide_left .logo-large{
		max-width: 190px;
	}
	.abt_divide_right h4{
		font-size: 15px;
	}
	@media screen and (max-width: 500px) {
	  .about_us{
	  padding: 10px;
	  margin-top: 1.5%;
	  width: 100%;
	  height: 100%; /* Set a specific height for the slideshow */
	  background-color: rgba(137, 245, 150, .2);
	}
	.about_us h2{
		font-size: 40px;
	}
	.abt_in_container {
	  display: block;
	  width: 100%;
	  height: 100%;
	}

	.abt_divide_left{
	  width: 40%;
	  height: 80%;
	 
	}
	.abt_divide_mid{
	  width: 60%;
	  height: 80%;
	  text-align:center;
	}
	.abt_divide_right {
	  width: 60%;
	  height: 80%;
	}
	.abt_divide_right .logo-large, .abt_divide_left .logo-large{
		max-width: 190px;
	}
	.abt_divide_right h4{
		font-size: 15px;
	} 
	}
	@media screen and (min-width: 769px) and (max-width: 1024px){
	    .about_us{
	  padding: 10px;
	  margin: auto;
	  margin-top: 1.5%;
	  width: 100%;
	  height:100%; /* Set a specific height for the slideshow */
	}
	.about_us h2{
		font-size: 40px;
	}
	.abt_in_container {
	  display: flex;
	  width: 100%;
	  height: 100%;
	}

	.abt_divide_left{
	  margin: auto;
	  width: 10%;
	  height: 80%;
	}
	.abt_divide_mid{
	  margin: auto;
	  width: 60%;
	  height: 80%;
	}
	.abt_divide_right {
	  margin: auto;
	  width: 10%;
	  height: 80%;
	}
	.abt_divide_right .logo-large, .abt_divide_left .logo-large{
		max-width: 80px;
	}
	.abt_divide_right h4{
		font-size: 15px;
	}
		.Text_information_BTS {
	      letter-spacing: 10px;
	        line-height: 1.6;
	        background-color:red;
	}
	}
</style>

<body>
  <body>
    <div class="about_us">
	<br>
	<center>
	<h2 style="color: green;"><?php echo $title[0] ?></h2></center>
		<div class="abt_in_container">
		<div class="abt_divide_left">
			<img src="img/bts_logo.png" class="logo-large BTS">
		</div>
			<div class="abt_divide_mid">
				<p class= "Text_information_BTS" style = "letter-spacing: 3px;line-height: 1.5;">
				<?php echo $description[0] ?>
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
	
	
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <script src="modal_script_index.js"></script>
  <script src="script_login_index.js"></script>
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









    var description = "<?php echo addslashes($description[0]); ?>"; // Get the description from PHP and escape special characters
    var maxLength = 200; // Set the maximum length of the description to display without Read More
    var isExpanded = false;

    // Function to update the description content
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

    // Add click event listener to the Read More button
    document.getElementById('readMoreBtn').addEventListener('click', function() {
        updateDescription();
    });

    // Initial setup: truncate description if it's longer than maxLength
    if (description.length > maxLength) {
        updateDescription();
    }
</script>

</body>
