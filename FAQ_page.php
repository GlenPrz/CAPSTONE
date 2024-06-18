<?php
include("Navbar_login.html");
include("conn.php");

try {
    $sqlInfoData = "SELECT * FROM u896821908_bts.info_tb WHERE info_id != 7;";
    $stmtInfoData = $conn->query($sqlInfoData);

    $title = [];
    $description = [];

    // Fetch and store values in arrays
    while ($row = $stmtInfoData->fetch(PDO::FETCH_ASSOC)) {
        $title[] = $row['title'];
        $description[] = $row['description'];
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="./modalsStyle/modal_signup.css?version=1" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./design/general/index.css">
    <link rel="stylesheet" href="./design/general/navbar.css">
    <link rel="stylesheet" href="./modalsStyle/modal_contactUs.css">

</head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }.main_content{
        	width: 100%;
        }
        .container {
            width: 100%;
            background-color: #fff;
            padding: 100px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 1%;
            margin-bottom: 2%;
            margin-right: 5%;
        }
        h2 {
            font-size: 36px;
            margin-bottom: 10px;
        }
        p {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .inner_box {
		height: 30%;
		width: 100%;
		padding: 20px;
		background-color: rgba(137, 245, 150, .2);
		display: block;
		box-shadow: 2px 7px 8px rgba(0, 0, 0, 0.3);
		border-radius: 10px;
		margin-bottom: 2%;

	}
	header {
background-color: green;
color: #fff;
padding: 20px;
text-align: center;
border-radius: 10px;
width: 100%;
margin-bottom: 2%;
}
@media screen and (max-width: 500px){
     h2 {
            font-size: 16px;
            margin-bottom: 10px;
        }
        p {
            font-size: 10px;
            margin-bottom: 20px;
        }
}
    </style>
<body>
	<div class="main_content">
    <div class="container">
        <header><h2>Frequently Asked Questions</h2></header>
          <?php
        $count = count($title);
        for ($i = 0; $i < $count; $i++) {
        ?>
            <div class="inner_box">
                <p><strong><?php echo htmlspecialchars($title[$i]); ?></strong></p>
                <p><?php echo htmlspecialchars($description[$i]); ?></p>
            </div>
        <?php
        }
        ?>
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
	
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	  <script src="modal_script_index.js"></script>
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

</script>

</body>
</html>

