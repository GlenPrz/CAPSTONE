<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BTS Driving school</title>
	<link rel="icon" type="image/x-icon" href="../img/favicon.ico">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="STUDENT_PORTAL.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
	
  <style>
    .Exam_smallcontainer {
			max-width: 1500px;
			margin: 0 auto;
			padding: 10px;
			overflow: hidden;
    }
	.examBTS_logo{
	  margin: 1% 2% 1%;
	  width: 70px;
	  height: 85px;
	}

   .question {
			margin-top: 25px;
			margin-bottom: 10px;
		}

		.options {
			margin-bottom: 25px;
		}

		.options label {
			display: inline-block;
			margin-right: 10px;
		}

		.error {
			color: red;
			font-style: italic;
		}

		hr.exam_Hr {
			border: none;
			height: 1.3px;
			background-color: rgba(0, 0, 0, 0.2);
		}
		
			.Exambutton {
        display: inline-block;
        margin-top:1%;
		margin-bottom:1%;
		width: 155px;
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
		float: left;
    }
	
    .quit {
        background-color: red;
        color: white;
		margin-left: 8%;
    }

    .submit {
        background-color: green;
        color: white;
		margin-right: 8%;
		float: right;
    }
	
	.submit:hover{
		background-color: #042e04;
	}
		
	.quit:hover{
		background-color: #630202;
	}
	  /* Style for the container row */
    .rating-row {
        display: flex; /* Use flexbox for horizontal alignment */
        align-items: center; /* Vertically align elements */
        margin-bottom: 20px; /* Add spacing between rows */
    }

    /* Style for the title */
    .rating-title {
        flex: 1; /* Allow the title to expand to fill available space */
        font-size: 18px; /* Adjust the font size */
        margin-right: 10px; /* Add spacing to the right of the title */
    }

    /* Style for the description */
    .rating-description {
        flex: 2; /* Allow the description to expand to fill available space */
        font-size: 14px; /* Adjust the font size */
        color: #888; /* Add a muted color to the description */
    }

    /* Style for the label and input */
    .rating-label {
        flex: 1; /* Allow the label to expand to fill available space */
        text-align: right; /* Right-align the label */
        margin-right: 10px; /* Add spacing to the right of the label */
    }

    /* Style for the input element */
    .rating-input {
        flex: 1; /* Allow the input to expand to fill available space */
        width: 50px; /* Set a fixed width for the input */
    }
	.assessment_form_cont{
		background-color: ;
	}
	.std_info{
		background-color: ;
		text-align: left;
		font-size: 24px;
	}
	.Title_col{
		width: 20%;
	}
	.desc_col{
		width: 30%;
	}
	.tbl_header{
		background-color: whitesmoke;
		height: 50px;
	}.container {
            width: 75%;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 1%;
            margin-bottom: 2%;
            margin-right: 5%;
        }
        strong {
    font-weight: bold;
    margin-right: 1%;
}
header {
background-color: green;
color: #fff;
padding: 1px;
text-align: center;
border-radius: 10px;
margin-bottom: 2%;
} table {
    margin: auto;
border-collapse: collapse;
width: 100%;
}

th{
text-align: left;
padding: 16px;
font-size: 24px;
}

td {
text-align: left;
padding: 5px;
font-size: 32px;
}
.rating-title, .rating-description{
text-align: left;
padding: 5px;
font-size: 32px;
}
.studInfoCon{
	width: 100%;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 1%;
            margin-bottom: 2%;
            margin-right: 5%;
}
.rating-input{
	font-size: 32px;
}

 @media only screen and (max-width: 600px) {
     body{
         padding:0;
     }
      .container{
          width: 100%;
          padding: 1%;
      }
      .label{
          font-size: 15px;
      }
      .title_header, .big_title{
          font-size: 20px;
      }
      .STD_info .title{
		font-size: 19px;
		font-weight: 600;
	}
	.STD_info .val{
		font-size: 15px;
		font-weight: 500;
	}
    .right_container{
        display: none;
    }  
    .std_img {
      display: block;
      width: 100px; /* Adjust the size as needed */
      height: 100px; /* Adjust the size as needed */
      border-radius: 50%;
      object-fit: cover;
      margin: 0 auto;
    }
    .table_container{
        display: none;
    }
    .std_assess, .std_decline {
        padding: 15px 20px; /* Padding around the text */
    }
    .btn_container{
      margin-top:2%;
    }

    
      header {
        width: 100%;
    }
      .nav-container{
          background-color: rgba(91, 189, 117, .5);
      }
      
      .Exam_smallcontainer{
          margin: 0;
          padding: 0;
          width: 100%; 
      }
     .Exam_smallcontainer h2{
        font-size: 16px;
		font-weight: 500;
     }
      
     .student_info{
        font-size: 15px; 
     }
      
     .Title_col,
      .desc_col,
      th,
      .rating-title,
      .rating-description,
      .rating-label,
      .rating-input {
        font-size: 12px;
      }
      
      .questions{
          font-size: 13px;
      }
      
      .Exambutton{
        width: 120px;
		height: 45px;
      }
    }

  </style>
  <script>
    function validateForm() {
      var questions = document.getElementsByClassName("question");
      var error = document.getElementById("error-msg");

      for (var i = 0; i < questions.length; i++) {
        var options = questions[i].getElementsByTagName("input");
        var isChecked = false;

        for (var j = 0; j < options.length; j++) {
          if (options[j].checked) {
            isChecked = true;
            break;
          }
        }

      }

      return true;
    }
  </script>

</head>

<body>
<?php
 try {
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection configuration
    $servername = "localhost";
    $username = "u896821908_bts";
    $password = "a*5E4UEhsHa]";
    $dbname = "u896821908_bts";

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    

}
?>

	<center><div class="container">
		<img src="../img/bts_logo.png" class="examBTS_logo">

		<div class="Exam_smallcontainer">
			<header><h2>STUDENT ASSESSMENT FORM</h2></header>
			<div class="studInfoCon">
				<div class="std_info">
				 <?php
				 if ($_SERVER["REQUEST_METHOD"] == "POST") {
					// Check if the form was submitted

					$course = $_POST["course"];
					$std_id = $_POST["std_id"];
					$session = $_POST["session"];
					$DI_id = $_POST["DI_id"];
					$StartOdo = $_POST["StartOdo"];
					
					
					// Update the Availability_status column in the 'di' table
                    $sql = "UPDATE di SET Availability_status = 'On Session' WHERE id_DI = '$DI_id' ";
                    if ($conn->query($sql) === TRUE) {
                      // Great
                    } 
					
					
					
					$sql = "SELECT * FROM student WHERE idStudent = $std_id";

					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						// Output data of each row
						while ($row = $result->fetch_assoc()) {
					echo "<div class='student_info'>
					<strong>Student ID:</strong> " . $row["idStudent"] . "<br>";
					echo "<strong>Last Name:</strong> " . $row["Lastname"] . "<br>";
					echo "<strong>First Name:</strong> " . $row["Firstname"] . "<br>";
					echo "<strong>Middle Name:</strong> " . $row["Middlename"] . "<br>";
					echo "<strong>Gender:</strong> " . $row["Sex"] . "<br>";
					echo "<strong>Contact Number:</strong> " . $row["Contactnumber"] . "<br>";
					echo "<strong>Email Address:</strong> " . $row["EmailAddress"] . "<br>";

							// Add more fields as needed
						}
					}
					
				  $LTOCodeM = "A(L1, L2, L3)";
                  $LTOCodeC = "B(M1)";
						
					
					if (!empty($course) && ($course == 'Motorcycle_Manual' || $course == 'Motorcycle_Automatic')) {
    $LTOCODE = $LTOCodeM;
} elseif (!empty($course) && ($course == 'Car_Manual' || $course == 'Car_Automatic')) {
    $LTOCODE = $LTOCodeC;
} else {
    // Default value if $course doesn't match any condition
    $LTOCODE = ''; // or any other default value you want
}

					
					echo "<strong>Selected Course: </strong> " . $course .' ' . $LTOCODE. "<br>";
					echo "<strong>Student ID:</strong>  " . $std_id . "<br>";
					echo "<strong>Session: </strong> " . $session . "<br>";
					echo "<strong>DI_id: </strong> " . $DI_id . "<br>";
					echo "<strong>course:</strong>  " . $course .' ' . $LTOCODE.  "<br>
					</div>";
									}
									
								 ?>
								 
			</div>

			</div>	
			<hr> 

						<form method="post" action="Script_php\assessment_inserting.php">
							<div class="assessment_form_cont">
							
							<table class="Main-table">
							<tr class="tbl_header">
								<th class="Title_col">Title</th>
								<th class="desc_col">Description</th>
								<th>Rating(1=Poor, 2=Fair, 3=Good, 4=Very Good, 5=Excellent)</th>
							</tr>

							 <?php
							 
							// Fetch questions for session 
							$sql = "SELECT q_title, desciption
									FROM pdc_questions
									WHERE session = $session";

							$result = $conn->query($sql);
							
							 if (!$result) {
								throw new Exception("Error in SQL query: " . $conn->error);
							}
							
							while ($row = $result->fetch_assoc()) { ?>
								<tr class="questions">
								<td><h4 class="rating-title"><?php echo $row["q_title"]; ?></h4></td>
								<td><p class="rating-description"><?php echo $row["desciption"]; ?></p></td>
								<td><center><label class="rating-label" for="<?php echo $row["q_title"]; ?>">Rating (1-5): </label>
								<input type="number" id="<?php echo $row["q_title"]; ?>" name="<?php echo $row["q_title"]; ?>" class="rating-input" min="1" max="5" inputmode="numeric" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="1" required>

								</tr>
							<?php
								} 
								$conn->close();
								 } catch (Exception $e) {
							// Handle the error here
							echo "ERROR OCCURRED: " . $e->getMessage();
						}

								if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_back'])) {
                                    // Assuming $DI_id is defined somewhere
                                    $DI_id = $_POST['DI_id'];
                                
                                    // Update the Availability_status column in the 'di' table
                                    $sql = "UPDATE di SET Availability_status = 'Assigned' WHERE id_DI = '$DI_id'";
                                    if ($conn->query($sql) === TRUE) {
                                        // Database update successful
                                    } else {
                                        // Handle the error appropriately
                                        echo "Error updating record: " . $conn->error;
                                    }
                                }
							?>
						</table>
							
							
							
							</div>	
							<input type="hidden" class="std_id" name="DI_id" value="<?php echo $DI_id; ?>">
							<input type="hidden" class="std_id" name="course" value="<?php echo $course; ?>">
							<input type="hidden" class="std_id" name="std_id" value="<?php echo $std_id; ?>">
							<input type="hidden" class="std_id" name="session" value="<?php echo $session; ?>">
							<input type="hidden" class="std_id" name="StartOdo" value="<?php echo $StartOdo; ?>">
							
							<center><button type="submit" class="Exambutton submit">Submit</button>
							<a href="#" class="Exambutton quit" onclick="quitAndDisableBack();">Back</a></center>
						</form>	  
		</div>
		
		<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_back'])) {
        // Assuming $DI_id is defined somewhere
        $DI_id = $_POST['DI_id'];
                                
        // Update the Availability_status column in the 'di' table
        $sql = "UPDATE di SET Availability_status = 'Assigned' WHERE id_DI = '$DI_id'";
        if ($conn->query($sql) === TRUE) {
        // Database update successful
        } else {
        // Handle the error appropriately
        echo "Error updating record: " . $conn->error;
            }
        }
	?>
	</div></center>
		
<script>
       function quitAndDisableBack() {
        if (confirm('Are you sure you want to go back?')) {
            // Assuming $DI_id is defined somewhere in your PHP
            var DI_id = <?php echo json_encode($DI_id); ?>;

            // Send a POST request to update the database
            var xhr = new XMLHttpRequest();
            xhr.open('POST', window.location.href, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('confirm_back=true&DI_id=' + DI_id);

            // Remove the previous page entry from the browser's history
            history.pushState(null, null, location.href);
            window.onpopstate = function () {
                history.go(1);
            };

            // Redirect to the "di_dashboard.php" page
            window.location.replace("di_dashboard.php");
        }
    }
    </script>					
</body>

</html>

