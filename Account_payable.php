<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BTS Driving school</title>
	<link rel="icon" type="image/x-icon" href="../img/favicon.ico">
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Domine:wght@500&family=Merriweather:wght@700&display=swap" rel="stylesheet">
</head>
<style>
    * {
        font-family: 'Inter', sans-serif;
    }
    main {
        margin-top: -3%;
    }
    nav {
        width: 90%;
        margin: auto;
    }
    .logo {
        width: 140px;
        height: 150px;
        display: inline-block;
    }
    nav h2 {
        font-size: 50px;
        display: inline-block;
        transform: translateY(-90%);
        margin-left: 2%;
        margin-right: 2%;
    }
    nav hr {
        width: 40%;
        border: none;
        height: 15px;
        background: #018203;
        display: inline-block;
        margin-bottom: 5%;
    }
    h2 {
        display: inline-block;
    }

    .First-row {
        display: block;
    }

    .Left-Container,
    .Right-Container {
        display: block;
    }

    .Left-Container {
        width: 48.8%;
        float: left;
        height: 100%;
        text-align: right;
    }

    .Right-Container {
        width: 48.8%;
        float: left;
    }
    .Right-Container h3,h4{
        display:inline-block;
    }
    
    .img_gcash{
        height:350px;
        width:300px;
        transform: translate(125%, 0%);
    }

    /* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position:fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 40px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 80%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s;
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: black;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: white;
  color: black;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 5px 16px;
  background-color: white;
  color: white;
  display:flex;
  justify-content: flex-end;
}
.F-right-container,.F-left-Rcontainer{
    width:45%;
    height: 100%;
}
.F-right-container{
    display: inline-block;
    text-align:right;
}
.F-left-Rcontainer{
    display: inline-block;
    padding-top: -20px;
}
.example_gcash{
    width:300px;
    height: 300px;
    margin-left:20px;
}
/* CSS */
.button-37 {
  background-color: #13aa52;
  border: 1px solid #13aa52;
  border-radius: 4px;
  box-shadow: rgba(0, 0, 0, .1) 0 2px 4px 0;
  box-sizing: border-box;
  color: #fff;
  cursor: pointer;
  font-family: "Akzidenz Grotesk BQ Medium", -apple-system, BlinkMacSystemFont, sans-serif;
  font-size: 16px;
  font-weight: 400;
  outline: none;
  outline: 0;
  padding: 10px 25px;
  text-align: center;
  transform: translateY(0);
  transition: transform 150ms, box-shadow 150ms;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  margin-bottom: 50px;
}

.button-37:hover {
  box-shadow: rgba(0, 0, 0, .15) 0 3px 9px 0;
  transform: translateY(-2px);
}

@media (min-width: 768px) {
  .button-37 {
    padding: 10px 30px;
  }
}
.Reference_Number{
    width:300px;
    height: 20px;
    font-size: 20px;
    border:solid green 2px;
    padding:10px;
}
.FTitleR{
font-family: 'Domine', serif;
font-family: 'Merriweather', serif;
padding:10px;
text-align: right;
}
.modal-FTitleR{
font-family: 'Domine', serif;
font-family: 'Merriweather', serif;
font-size:20px;
}
.select_payment_option{
    padding:10px;
    margin:15px;
    background-color:lightgreen;
    font-size: 25px;
    border-radius: 5px;
    transform:translateX(0%);
}
/* CSS */
.button-44 {
  background: #e62143;
  border-radius: 11px;
  box-sizing: border-box;
  color: #fff;
  cursor: pointer;
  display: inline-flex;
  justify-content: flex-end;
  font-family: Mija,-apple-system,BlinkMacSystemFont,Roboto,"Roboto Slab","Droid Serif","Segoe UI",system-ui,Arial,sans-serif;
  font-size: 1.15em;
  font-weight: 700;
  justify-content: center;
  line-height: 33.4929px;
  padding: .8em 1em;
  text-align: center;
  text-decoration: none;
  text-decoration-skip-ink: auto;
  text-shadow: rgba(0, 0, 0, .3) 1px 1px 1px;
  text-underline-offset: 1px;
  transition: all .2s ease-in-out;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  width: 10%;
  word-break: break-word;
  border: 0;
}

.button-44:active,
.button-44:focus {
  border-bottom-style: none;
  border-color: #dadada;
  box-shadow: rgba(0, 0, 0, .3) 0 3px 3px inset;
  outline: 0;
}

.button-44:hover {
  border-bottom-style: none;
  border-color: #dadada;
}
.button-45 {
  background: #018201;
  border-radius: 11px;
  box-sizing: border-box;
  color: #fff;
  cursor: pointer;
  display: inline-flex;
  justify-content: flex-end;
  font-family: Mija,-apple-system,BlinkMacSystemFont,Roboto,"Roboto Slab","Droid Serif","Segoe UI",system-ui,Arial,sans-serif;
  font-size: 1.15em;
  font-weight: 700;
  justify-content: center;
  line-height: 33.4929px;
  padding: .8em 1em;
  text-align: center;
  text-decoration: none;
  text-decoration-skip-ink: auto;
  text-shadow: rgba(0, 0, 0, .3) 1px 1px 1px;
  text-underline-offset: 1px;
  transition: all .2s ease-in-out;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  width: 10%;
  word-break: break-word;
  border: 0;
  margin-right:3px;
}

.button-45:active,
.button-45:focus {
  border-bottom-style: none;
  border-color: #018201;
  box-shadow: rgba(0, 0, 0, .3) 0 3px 3px inset;
  outline: 0;
}

.button-45:hover {
  border-bottom-style: none;
  border-color: #018201;
}
</style>

<body>
    <nav>
        <img src="img/bts_logo.png" class="logo">
        <h2>Accounts payable</h2>
        <hr>
    </nav>
    <div class="First-row">
        <div class="F-right-container">
        <form method="POST" action="printable_receipt.php" id="paymentForm">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
                // Retrieve form data
                $tdcOnline = isset($_POST["tdcOnline"]) ? $_POST["tdcOnline"] : "";
                $depStatus = isset($_POST["depStatus"]) ? $_POST["depStatus"] : "";
                $licenseNumber = isset($_POST["licenseNumber"]) ? $_POST["licenseNumber"] : "";
                $expirationDate = isset($_POST["expirationDate"]) ? $_POST["expirationDate"] : "";
                $pdc = isset($_POST["PDC"]) ? $_POST["PDC"] : "";
                $pdcMotor = isset($_POST["PDC_Motor"]) ? $_POST["PDC_Motor"] : "";
                $pdcCar = isset($_POST["PDC_Car"]) ? $_POST["PDC_Car"] : "";
                // Set price variables based on selected options
                $priceMotor = 0;
                $priceCar = 0;
                $tdcEnroll = 0;
                $depStatusEnroll = 0;
                $Total = 0;

                if ($pdcMotor === "Motorcycle(Automatic)" || $pdcMotor === "Motorcycle(Manual)") {
                    $priceMotor = 2500;
                }
                if ($pdcCar === "CAR(Automatic)" || $pdcCar === "CAR(Manual)") {
                    $priceCar = 4000;
                }

                if ($tdcOnline === "Enrolling") {
                    $tdcEnroll = 1000;
                }

                if ($depStatus === "Enrolling") {
                    $depStatusEnroll = 1000;
                }

                // Display the form data if not empty
                if (!empty($tdcOnline)) {
                    echo "<h2 class = FTitleR>Theoretical Driving Course: $tdcOnline</h2><br>";
                }
                if (!empty($depStatus)) {
                    echo "<h2 class = FTitleR>Driving Enhancement Program: $depStatus</h2><br>";
                }
                if (!empty($licenseNumber)) {
                    echo "<h2 class = FTitleR>License Number: $licenseNumber</h2><br>";
                }
                if (!empty($expirationDate)) {
                    echo "<h2 class = FTitleR>Expiration Date: $expirationDate</h2><br>";
                }
                if (!empty($pdcMotor)) {
                    echo "<h2 class = FTitleR>Motorcycle: $pdcMotor</h2><br>";
                }
                if (!empty($pdcCar)) {
                    echo "<h2 class = FTitleR>Car: $pdcCar</h2><br>";
                }
            }
            ?>
            <select name="payment_option" class="select_payment_option" onchange="calculatePayment()">
                <option value="full" class="select_payment_option">Full Payment</option>
                <option value="five" class="select_payment_option">Five Payment</option>
            </select>
        </form>
        </div>
        <div class= "F-left-Rcontainer">
        <img src="./img/admin/Gcash/Gcash.jpg" class="img_gcash">
        </div>
    </div>
    <div class="Left-Container" id="leftContainer">
        <?php
        $totalWithoutPercentage = $priceCar + $priceMotor + $tdcEnroll + $depStatusEnroll;
        $additionalAmountFirstWeek = $totalWithoutPercentage * 0.1;
        $totalWithFirstWeek = $totalWithoutPercentage + $additionalAmountFirstWeek;
        $perWeekAmount = $totalWithoutPercentage / 4;
        // Check if the user selects "Five Payment"
        if (isset($_POST['payment_option']) && $_POST['payment_option'] === 'five') {
            echo "<h2 class = 'FTitleR'>First Week (10% More): $totalWithFirstWeek</h2><br>";
            for ($week = 2; $week <= 5; $week++) {
                echo "<h2 class = 'FTitleR'>Week $week: $perWeekAmount</h2><br>";
            }
        } else {
          if (!empty($tdcOnline)) {
            echo "<h2 class = FTitleR>Theoretical Driving Course: $tdcEnroll</h2><br>";
        }
        if (!empty($depStatus)) {
            echo "<h2 class = FTitleR>Driving Enhancement Program: $depStatusEnroll</h2><br>";
        }
        if (!empty($licenseNumber)) {
            echo "<h2 class = FTitleR>License Number: $licenseNumber</h2><br>";
        }
        if (!empty($expirationDate)) {
            echo "<h2 class = FTitleR>Expiration Date: $expirationDate</h2><br>";
        }
        if (!empty($pdcMotor)) {
            echo "<h2 class = FTitleR>Motorcycle: $priceMotor</h2><br>";
        }
        if (!empty($pdcCar)) {
            echo "<h2 class = FTitleR>Car: $priceCar</h2><br>";
        }
            echo "<h2 class = FTitleR>Total: $totalWithoutPercentage</h2><br>";
        }
        ?>
    </div>
    <div class="Right-Container">
    <center>
        <h2>Steps in online Payment</h2>
        <br>
        <h3>Step 1:</h3>
        <h4>Scan the G Cash QR Code</h4>
        <br>
        <h3>Step 2: </h3>
        <h4>Enter The Amount: </h4>
        <br>
        <h3>Step 3:  </h3>
        <h4>Put the Code “BTSStudent username” in the message </h4>
        <br>
        <h4>Example:<br>         
        <img src="./img/admin/Gcash/Gcash.jpg" class="example_gcash">
        </h4>
        <br>
        <h3>Step 4:  </h3>
        <h4>Copy and put the reference number on the provided section </h4>
        <br>
        <h3>Number:09999123456</h3>
        <br>
        <input type="text" class ="Reference_Number" placeholder="Reference Number">
        <br>
        <br>
        <button type="button"  class="button-37" onclick="printReceiptData()">Print</button>
        <button id ="myBtn" class="button-37" >Enroll</button>
        </center>
    </div>

    <div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Enroling for:</h2>
    </div>
    <div class="modal-body">

      <div id="payment-container">

      </div>
    </div>
    <div class="modal-footer">
        <button class="button-45" onclick="confirmEnroll()">CONFIRM</button>
        <button id="cancelButton" class="button-44">CANCEL</button>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
                    const paymentOption = document.querySelector("select[name='payment_option']").value;
                    if (paymentOption === 'full') {
    //Container for payment div   
    document.querySelector('#payment-container').innerHTML = ''; 
                <?php
                if (!empty($tdcOnline)) {
                    echo
                    "document.querySelector('#payment-container').innerHTML += '<h2 class = modal-FTitleR>Theoretical Driving Course: $tdcEnroll</h2><br>';";
                }
                if (!empty($depStatus)) {
                    echo
                    "document.querySelector('#payment-container').innerHTML += '<h2 class = modal-FTitleR>Driving Enhancement Program: $depStatusEnroll</h2><br>';";
                }
                if (!empty($licenseNumber)) {
                    echo
                    "document.querySelector('#payment-container').innerHTML += '<h2 class = modal-FTitleR>License Number: $licenseNumber</h2><br>';";
                }
                if (!empty($expirationDate)) {
                    echo
                    "document.querySelector('#payment-container').innerHTML += '<h2 class = modal-FTitleR>Expiration Date: $expirationDate</h2><br>';";
                }
                if (!empty($pdcMotor)) {
                    echo
                    "document.querySelector('#payment-container').innerHTML += '<h2 class = modal-FTitleR>Motorcycle: $priceMotor</h2><br>';";
                }
                if (!empty($pdcCar)) {
                    echo "document.querySelector('#payment-container').innerHTML += '<h2 class = modal-FTitleR>Car: $priceCar</h2><br>';";
                }
                echo "document.querySelector('#payment-container').innerHTML += '<h2 class = modal-FTitleR>Total: $totalWithoutPercentage</h2><br>';"; 
                ?>
                    }
                if(paymentOption === 'five'){
                    document.querySelector('#payment-container').innerHTML = ''; 
                    <?php
                    if (!empty($tdcOnline)) {
                    echo
                    "document.querySelector('#payment-container').innerHTML += '<h2 class = modal-FTitleR>Theoretical Driving Course: $tdcEnroll</h2><br>';";
                }
                if (!empty($depStatus)) {
                    echo
                    "document.querySelector('#payment-container').innerHTML += '<h2 class = modal-FTitleR>Driving Enhancement Program: $depStatusEnroll</h2><br>';";
                }
                if (!empty($licenseNumber)) {
                    echo
                    "document.querySelector('#payment-container').innerHTML += '<h2 class = modal-FTitleR>License Number: $licenseNumber</h2><br>';";
                }
                if (!empty($expirationDate)) {
                    echo
                    "document.querySelector('#payment-container').innerHTML += '<h2 class = modal-FTitleR>Expiration Date: $expirationDate</h2><br>';";
                }
                if (!empty($pdcMotor)) {
                    echo
                    "document.querySelector('#payment-container').innerHTML += '<h2 class = modal-FTitleR>Motorcycle: $priceMotor</h2><br>';";
                }
                if (!empty($pdcCar)) {
                    echo "document.querySelector('#payment-container').innerHTML += '<h2 class = modal-FTitleR>Car: $priceCar</h2><br>';";
                }
                ?>
                }

        function calculatePayment() {
            const paymentOption = document.querySelector("select[name='payment_option']").value;

            let totalWithoutPercentage = <?php echo $priceCar + $priceMotor + $tdcEnroll + $depStatusEnroll; ?> ;
            let perWeekAmount = (totalWithoutPercentage + 1000) / 5;
            let totalFivePayment = totalWithoutPercentage;

            if (paymentOption === 'five') {
                document.querySelector("#leftContainer").innerHTML = `
        <h2 class = FTitleR>Week 1: ${perWeekAmount}</h2><br>
        <h2 class = FTitleR>Week 2: ${perWeekAmount}</h2><br>
        <h2 class = FTitleR>Week 3: ${perWeekAmount}</h2><br>
        <h2 class = FTitleR>Week 4: ${perWeekAmount}</h2><br>
        <h2 class = FTitleR>Week 5: ${perWeekAmount}</h2><br>
        <h2 class = FTitleR>Total: ${totalFivePayment + 1000}</h2><br>
    `;
    document.querySelector("#payment-container").innerHTML ='';
    <?php
                    if (!empty($tdcOnline)) {
                    echo
                    "document.querySelector('#payment-container').innerHTML += '<h2 class = modal-FTitleR>Theoretical Driving Course: $tdcEnroll</h2><br>';";
                }
                if (!empty($depStatus)) {
                    echo
                    "document.querySelector('#payment-container').innerHTML += '<h2 class = modal-FTitleR>Driving Enhancement Program: $depStatusEnroll</h2><br>';";

                }
                if (!empty($licenseNumber)) {
                    echo
                    "document.querySelector('#payment-container').innerHTML += '<h2 class = modal-FTitleR>License Number: $licenseNumber</h2><br>';";
                }
                if (!empty($expirationDate)) {
                    echo
                    "document.querySelector('#payment-container').innerHTML += '<h2 class = modal-FTitleR>Expiration Date: $expirationDate</h2><br>';";
                }
                if (!empty($pdcMotor)) {
                    echo
                    "document.querySelector('#payment-container').innerHTML += '<h2 class = modal-FTitleR>Motorcycle: $priceMotor</h2><br>';";
                }
                if (!empty($pdcCar)) {
                    echo "document.querySelector('#payment-container').innerHTML += '<h2 class = modal-FTitleR>Car: $priceCar</h2><br>';";
                }
                ?>

    document.querySelector("#payment-container").innerHTML += `
    <h2 class = FTitleR>Week 1: ${perWeekAmount}</h2><br>
        <h2 class = FTitleR>Week 2 test: ${perWeekAmount}</h2><br>
        <h2 class = FTitleR>Week 3: ${perWeekAmount}</h2><br>
        <h2 class = FTitleR>Week 4: ${perWeekAmount}</h2><br>
        <h2 class = FTitleR>Week 5: ${perWeekAmount}</h2><br>
        <h2 class = FTitleR>Total: ${totalFivePayment + 1000}</h2><br>
    `;
            }  
            
            if (paymentOption === 'full') {
                // Display the additional information in the else part
                document.querySelector('#leftContainer').innerHTML = ''; 
                <?php
                if (!empty($tdcOnline)) {
                    echo
                    "document.querySelector('#leftContainer').innerHTML += '<h2 class = FTitleR>Theoretical Driving Course: $tdcEnroll</h2><br>';";
                }
                if (!empty($depStatus)) {
                    echo
                    "document.querySelector('#leftContainer').innerHTML += '<h2 class = FTitleR>Driving Enhancement Program: $depStatusEnroll</h2><br>';";
                }
                if (!empty($licenseNumber)) {
                    echo
                    "document.querySelector('#leftContainer').innerHTML += '<h2 class = FTitleR>License Number: $licenseNumber</h2><br>';";
                }
                if (!empty($expirationDate)) {
                    echo
                    "document.querySelector('#leftContainer').innerHTML += '<h2 class = FTitleR>Expiration Date: $expirationDate</h2><br>';";
                }
                if (!empty($pdcMotor)) {
                    echo
                    "document.querySelector('#leftContainer').innerHTML += '<h2 class = FTitleR>Motorcycle: $priceMotor</h2><br>';";
                }
                if (!empty($pdcCar)) {
                    echo "document.querySelector('#leftContainer').innerHTML += '<h2 class = FTitleR>Car: $priceCar</h2><br>';";
                }
                echo
                "document.querySelector('#leftContainer').innerHTML += '<h2 class = FTitleR>Total: $totalWithoutPercentage</h2><br>';"; 
                ?>
            }
        }
    </script>

<script>
    function sendData(paymentOption, totalWithoutPercentage) {
        // Get the payment option value
        const data = {
        paymentOption: paymentOption,
        username: "<?php echo $_SESSION['username']; ?>",
        totalWithoutPercentage: <?php echo $priceCar + $priceMotor + $tdcEnroll; ?>,
    };
    console.log(data); // Log the data to the console for testing purposes

    // Send the data to the server using AJAX
    $.ajax({
  type: "POST",
  url: "STD_insert_payment.php",
  data: data,
  success: function (response) {
    // Handle the success response (if needed)
    console.log("Response from server:", response);

    if (response.trim() === "Payment data successfully inserted.") {
      // Success, redirect to WelcomePage(Pending).php
      window.location.href = "WelcomePage(Pending).php";
    } else {
      // Unexpected response or error, handle accordingly
      console.error("Error inserting payment data:", response);
      alert("Error occurred during payment data insertion. Please try again.");
    }
  },
  error: function (error) {
    // Handle the error response (if needed)
    console.error("Error inserting payment data:", error);
    alert("Error occurred during payment data insertion. Please try again.");
  }
});

    }

    function confirmEnroll() {
        // Get the payment option value
        const paymentOption = document.querySelector("select[name='payment_option']").value;

        // Get other necessary data from PHP variables
        const tdcOnline = "<?php echo $tdcOnline; ?>";
        const depStatus = "<?php echo $depStatus; ?>";
        const licenseNumber = "<?php echo $licenseNumber; ?>";
        const expirationDate = "<?php echo $expirationDate; ?>";
        const pdcMotor = "<?php echo $pdcMotor; ?>";
        const pdcCar = "<?php echo $pdcCar; ?>";
        const totalWithoutPercentage = <?php echo $priceCar + $priceMotor + $tdcEnroll; ?>;
        const perWeekAmount = (totalWithoutPercentage + 1000) / 5;
        const totalFivePayment = totalWithoutPercentage + 1000;

        // Clear the payment container
        document.querySelector('#payment-container').innerHTML = '';

        // Create and append payment details based on payment option
        if (paymentOption == 'five') {
            sendData(paymentOption, totalWithoutPercentage);
        } else if (paymentOption == 'full') {
            sendData(paymentOption, totalWithoutPercentage);
        }
    }
</script>

<script>
  function printReceiptData() {
    const paymentOption = document.querySelector("select[name='payment_option']").value;

    // Create a form element
    const form = document.createElement("form");
    form.method = "POST";
    form.action = "printable_receipt.php";
    form.target = "_blank";

    // Create an input field for the payment option
    const paymentOptionInput = document.createElement("input");
    paymentOptionInput.type = "hidden";
    paymentOptionInput.name = "payment_option";
    paymentOptionInput.value = paymentOption;

    // Append the input field to the form
    form.appendChild(paymentOptionInput);

    // Append the form to the document and submit it
    document.body.appendChild(form);
    form.submit();

    // Remove the form from the document (optional)
    document.body.removeChild(form);
  }

  // When the document is ready
  $(document).ready(function () {
    // Bind the sendData function to the form submission event
    $("#paymentForm").submit(function (event) {
      event.preventDefault(); // Prevent default form submission
      sendData(); // Call sendData function to handle form submission
    });

    // Get the modal
    var modal = $("#myModal");

    // Get the button that opens the modal
    var btn = $("#myBtn");

    // Get the <span> element that closes the modal
    var span = $(".close");

    // When the user clicks the button, open the modal
    btn.click(function () {
      modal.css("display", "block");
    });

    // When the user clicks on <span> (x), close the modal
    span.click(function () {
      modal.css("display", "none");
    });

    $("#cancelButton").click(function() {
    // Hide the modal by changing its display property
        modal.css("display", "none");
  });

    // When the user clicks anywhere outside of the modal, close it
    $(window).click(function (event) {
      if (event.target == modal[0]) {
        modal.css("display", "none");
      }
    });
  });
</script>

</body>

</html>