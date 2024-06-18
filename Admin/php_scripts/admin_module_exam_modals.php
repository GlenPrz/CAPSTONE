<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    include '../conn.php';
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
    ?>

</head>
<style>
.modal_module1 {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content_module1 {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 30%;
  display: block;
}

/* The Close Button */
.close_module1 {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close_module1:hover,
.close_module1:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}    

/* Module 2 */
.modal_module2 {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content_module2 {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 30%;
}

/* The Close Button */
.close_module2 {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close_module2:hover,
.close_module2:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}    

/* Module 3 */
.modal_module3 {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content_module3 {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 30%;
}

/* The Close Button */
.close_module3 {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close_module3:hover,
.close_module3:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
.submit-button,
.reset-button {
  background-color: #4CAF50; /* Green background */
  border: none; /* Remove borders */
  color: white; /* White text */
  padding: 12px 24px; /* Some padding */
  text-align: center; /* Center text */
  text-decoration: none; /* Remove underline */
  display: inline-block; /* Make it an inline element */
  font-size: 16px; /* Increase font size */
  margin-right: 20px; /* Add some spacing between buttons */
  cursor: pointer; /* Add a pointer cursor on hover */
  border-radius: 5px; /* Optional: Add rounded corners */
}   
.reset-button{
    background-color:red;
}
</style>
<body>


<!-- The Modal Module 1-->
<div id="myModal_module1" class="modal_module1">

  <!-- Modal content -->
  <div class="modal-content_module1">
    <span class="close_module1">&times;</span>
    <form id="form_module1" enctype="multipart/form-data">
      <iframe src="../uploads/pdf_modules/<?php echo $pdfName1; ?>" width="500" height="500"></iframe>
      <input type="file" name="PDFModule1" accept=".pdf">
      <input type = "hidden" name="SubmitModule1" value = "1">
      <input type="submit" class="submit-button" value="Submit">
        <input type="reset" class="reset-button" value="Reset">
    </form>
  </div>
</div>

<!-- The Modal Module 2-->
<div id="myModal_module2" class="modal_module2">

  <!-- Modal content -->
  <div class="modal-content_module2">
    <span class="close_module2">&times;</span>
    <form id="form_module2" enctype="multipart/form-data">
    <iframe src="../uploads/pdf_modules/<?php echo $pdfName2; ?>" width="500" height="500"></iframe>
    <input type="file" name="PDFModule2" accept=".pdf">
    <input type = "hidden" name="SubmitModule2" value = "2">
    <input type="submit" class="submit-button" value="Submit">
        <input type="reset" class="reset-button" value="Reset">
    </form>

  </div>
</div>

<!-- The Modal Module 3-->
<div id="myModal_module3" class="modal_module3">

  <!-- Modal content -->
  <div class="modal-content_module3">
    <span class="close_module3">&times;</span>
    <form id="form_module3" enctype="multipart/form-data">
    <iframe src="../uploads/pdf_modules/<?php echo $pdfName3; ?>" width="500" height="500"></iframe>
    <input type="file" name="PDFModule3" accept=".pdf">
    <input type = "hidden" name="SubmitModule3" value = "3">
    <input type="submit" class="submit-button" value="Submit">
        <input type="reset" class="reset-button" value="Reset">
    </form>
  </div>
</div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    //MODULE 1
    $("#form_module1").on("submit", function(event) {
    event.preventDefault(); // Prevent the default form submission
    
    var formData = new FormData(this); // Create a FormData object from the form
    
    $.ajax({
      url: "./php_scripts/admin_module_update.php", // Replace with the actual PHP script to handle the update
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
        // Handle the response from the server
        alert(response); // Display a success message or handle errors
                location.reload();

      },
      error: function(xhr, status, error) {
        // Handle AJAX errors
        console.error(xhr.responseText);
      }
    });
  });
    //MODULE 2
  $("#form_module2").on("submit", function(event) {
    event.preventDefault(); // Prevent the default form submission
    
    var formData = new FormData(this); // Create a FormData object from the form
    
    $.ajax({
      url: "./php_scripts/admin_module_update.php", // Replace with the actual PHP script to handle the update
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
        // Handle the response from the server
        alert(response); // Display a success message or handle errors
                location.reload();

      },
      error: function(xhr, status, error) {
        // Handle AJAX errors
        console.error(xhr.responseText);
      }
    });
  });

   //MODULE 3
   $("#form_module3").on("submit", function(event) {
    event.preventDefault(); // Prevent the default form submission
    
    var formData = new FormData(this); // Create a FormData object from the form
    
    $.ajax({
      url: "./php_scripts/admin_module_update.php", // Replace with the actual PHP script to handle the update
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
        // Handle the response from the server
        alert(response); // Display a success message or handle errors
        location.reload();
      },
      error: function(xhr, status, error) {
        // Handle AJAX errors
        console.error(xhr.responseText);
      }
    });
  });
});
</script>




<script>
    // Module 1 
var modal_module1 = document.getElementById("myModal_module1");
var btn_module1 = document.getElementById("Enrollbtn1");
var span_module1 = document.getElementsByClassName("close_module1")[0];

btn_module1.onclick = function() {
    modal_module1.style.display = "block";
}

span_module1.onclick = function() {
    modal_module1.style.display = "none";
}
    // Module 2
    var modal_module2 = document.getElementById("myModal_module2");
var btn_module2 = document.getElementById("Enrollbtn2");
var span_module2 = document.getElementsByClassName("close_module2")[0];

btn_module2.onclick = function() {
    modal_module2.style.display = "block";
}

span_module2.onclick = function() {
    modal_module2.style.display = "none";
}
    // Module 3
var modal_module3 = document.getElementById("myModal_module3");
var btn_module3 = document.getElementById("Enrollbtn3");
var span_module3 = document.getElementsByClassName("close_module3")[0];

btn_module3.onclick = function() {
    modal_module3.style.display = "block";
}

span_module3.onclick = function() {
    modal_module3.style.display = "none";
}


window.onclick = function(event) {
  if (event.target == modal_module1) {
    modal_module1.style.display = "none";
  }
  if (event.target == modal_module2) {
    modal_module2.style.display = "none";
  }
  if (event.target == modal_module3) {
    modal_module3.style.display = "none";
  }
}
    </script>

</html>