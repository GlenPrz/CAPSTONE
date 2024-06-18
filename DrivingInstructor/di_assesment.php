<?php
session_start();
include "./Script_php/Selection_Student.php";

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

// Check if the search form is submitted
if (isset($_GET['search'])) {
    $search_term = $_GET['search'];
    // Fetch data from the "student" table based on the search term
    $sql = "SELECT Username, Lastname, Firstname, Middlename, Suffix, Contactnumber, Sex, Address, Citizenship, EmailAddress FROM u896821908_bts.student WHERE role ='Student' AND Enroll_Status = 'enrolled'
            AND (idStudent LIKE '%$search_term%' OR Username LIKE '%$search_term%' OR Lastname LIKE '%$search_term%' OR Firstname LIKE '%$search_term%')";
} else {
    // Fetch data from the "student" table without any filter
    $sql = "SELECT Username, Lastname, Firstname, Middlename, Suffix, Contactnumber, Sex, Address, Citizenship, EmailAddress FROM u896821908_bts.student WHERE role ='Student'  AND Enroll_Status = 'enrolled'";
}
// Assuming you're using a database connection, you can execute the SQL query here
// and check if there are any results.

// Example:
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BTS Driving school</title>
	<link rel="icon" type="image/x-icon" href="../img/favicon.ico">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="DI_PORTAL.css">

</head>
<style>
 .nav_links a:nth-child(6) {
		background-color: green;
		border-radius: 10px;
		color: white;
	}
	
	 h2 {
            text-align: center;
			margin: 10px;
        }
        .table-container {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f2f2f2;
        }
        .assess-btn {
            padding: 8px 12px;
            background-color: #4CAF50;
            border: none;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            border-radius: 4px;
			transition: background-color 0.3s;
        }
        .assess-btn:hover {
            background-color: #2e6930;
        }
        @media screen and (max-width: 600px) {
            table {
                font-size: 12px;
            }
            .assess-btn {
                font-size: 12px;
                padding: 6px 8px;
            }
        }
		
		#assessmentModal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.6); /* Semi-transparent background */
}

.modal-content {
    font-size: 21px;
    background-color: white;
    margin: 5% auto; /* Adjust the margin as needed */
    padding: 20px;
    border-radius: 8px;
    max-width: 1200px; /* Adjust the max-width to make it bigger */
    max-height: 90%; /* Adjust the max-height to make it bigger */
    min-height: 500px; /* Adjust the min-height to make it bigger */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.modal-content input[type="text"] {
    font-size: 21px;
}
.modal-content select, .modal-content .stud_name {
    font-size: 21px;
	border: 1px solid #ccc;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

.form-container {
    display: flex;
    flex-wrap: wrap;
	margin: 10px auto 10px;
}

.form-row {
	margin: 10px 0 10px;
}

.thin_hr {
  border: none;
  height: 1px; /* Set the height of the thin line */
  background-color: rgba(0, 0, 0, 0.1); /* Color of the line */
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Add a shadow to the line */
}
 input[type="number"],input[type="date"] {
            width: 30%;
            padding: 3px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 21px;
        }
		
/* styles.css */
input[type="checkbox"] {
    /* Remove default browser styles for checkboxes */
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    /* Set custom size for the checkbox */
    width: 20px;
    height: 20px;
    /* Custom styles for the checkbox design */
    border: 2px solid #777; /* Gray border */
    border-radius: 4px; /* Rounded corners */
}

/* Custom style for the checked state of the checkbox */
input[type="checkbox"]:checked {
    background-color: #4CAF50; 
    border: 2px solid #777;
}

.red-checkbox {
           /* Remove default browser styles for checkboxes */
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
		/* Set custom size for the checkbox */
		width: 20px;
		height: 20px;
		/* Custom styles for the checkbox design */
		border: 2px solid #777; /* Gray border */
		border-radius: 4px; /* Rounded corners */
        }

        /* Override the checkbox style when the assessment is 'fail' */
        .red-checkbox[disabled] {
            background-color: red;
            /* You can apply other styling as needed to make the checkbox look red. */
        }

/* Custom style for the labels */
.session_lbl {
    font-size: 14px; /* Small font size for the labels */
}

/* Custom style for the PDC_insertbtn class */
.PDC_insertbtn {
     /* Set the background color to #4CAF50 (green) */
    background-color: #4CAF50;
    color: #fff; /* Set the text color to white */
    padding: 12px 24px; /* Adjust the padding as needed */
    font-size: 18px; /* Increase the font size for a bigger button */
    border: none; /* Remove the default button border */
    border-radius: 4px; /* Rounded corners */
    cursor: pointer; /* Show a pointer cursor on hover */
    /* Make the button wider */
    width: 150px;
	float: right;
	margin-right: 3%;
	margin-bottom:  5%;
}

/* Style for the PDC_insertbtn on hover */
.PDC_insertbtn:hover {
    background-color: #45a049; /* Slightly darker shade on hover */
}

   /* CSS for the search container */
    .search-container {
        margin: 20px 5%;
        display: flex;
        align-items: center;
    }

    /* CSS for the input field */
    .search-container input[type="text"] {
        padding: 10px;
        border: 2px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        width: 300px;
        outline: none;
    }

    /* CSS for the search button */
    .search-container button[type="submit"] {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        background-color:  #4CAF50;;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .search-container button[type="submit"]:hover {
        background-color: #2e6930;
    }
	 .center-text {
        text-align: center;
		font-size: 35px;
    }
	.modal_logo{
		float: right;
		margin: 0% 4%;
		width: 100px;
		height: 115px;
	}
</style>
<body>
    <div class ="main-container">
        <div class = "nav-container">
                 <nav>
			    <img src="../img/bts_logo.png" class="logo">
				
                <center>
                     <div class="profile">
                     <img src="../uploads/<?php echo basename($profilePicture); ?>" alt="Profile Picture" />
						<span class="username"><?php echo $_SESSION['username'] ?></span>
						<!--DITO USERNAME VARIABLE NG STUDENT-->
					</div>
                </center>
				
               <div class="nav_links">
                <a href ="di_dashboard.php">Dashboard</a>
                <a href ="di_assesment.php">Reports</a>
                <a href="" id = "logoutLink">Log Out</a>

                <!-- <a href ="di_modules.php">Modules</a> -->
            </div>
            </nav>
        </div>
    </div>
    <div class="content-container">
       <h4 class="description">Reports</h4>
	   
	   <h2>Student Data</h2>
	   <div class="search-container">
		<form method="GET">
				<input type="text" name="search" placeholder="Search by Username, Last/First Name">
				<button type="submit">Search</button>
			</form>
		</div>
        <div class = "second-row-content">
			<div class="table-container">

        <?php
				echo "<table>";
					echo "<tr>";
					echo "<th>Last Name</th>";
					echo "<th>First Name</th>";
					echo "<th>Middle Name</th>";
					echo "<th>Contact Number</th>";
					echo "<th>Sex</th>";
					echo "<th>Email Address</th>";
					echo "<th>Assess</th>";
					echo "</tr>";

					if (mysqli_num_rows($result) == 0) {
						echo "<tr><td colspan='7' class='center-text'>No data found.</td></tr>";
					} else {
						while ($row = $result->fetch_assoc()) {
							echo "<tr onclick='openModal(\"" . $row['Username'] . "\")'>";
							echo "<td>" . $row['Lastname'] . "</td>";
							echo "<td>" . $row['Firstname'] . "</td>";
							echo "<td>" . $row['Middlename'] . "</td>";
							echo "<td>" . $row['Contactnumber'] . "</td>";
							echo "<td>" . $row['Sex'] . "</td>";
							echo "<td>" . $row['EmailAddress'] . "</td>";
							echo "<td><button class='assess-btn' onclick='openModal(\"" . $row['Username'] . "\")'>Assess</button></td>";
							echo "</tr>";
						}
					}

				echo "</table>";
        ?>
    
</div>

    </div>
	</div>
	
	 <!-- Include the modal content using JavaScript -->
    <div id="modalContent"></div>
	
	 <script>
        function openModal(username) {
            // Create a new XMLHttpRequest object
            var xhttp = new XMLHttpRequest();

            // Define the function to be executed when the request completes
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Insert the modal content into the 'modalContent' div
                    document.getElementById("modalContent").innerHTML = this.responseText;
                    // Display the modal
                    document.getElementById('assessmentModal').style.display = 'block';
                }
            };

            // Send a GET request to the modal_content.php file and pass the 'id' parameter
            xhttp.open("GET", "assess.php?id=" + username, true);
            xhttp.send();
        }

        function closeModal() {
            // Hide the modal
            document.getElementById('assessmentModal').style.display = 'none';
        }
		
        // Close the modal
        function closeModal() {
            document.getElementById('assessmentModal').style.display = 'none';
        }

        // Close the modal when clicking outside the modal content
        window.onclick = function(event) {
            var modal = document.getElementById('assessmentModal');
            if (event.target === modal) {
                closeModal();
            }
        };
    </script>
	  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<script>
		 function data_success() {
            // Your JavaScript function logic here
            alert("Data is successfuly stored!");

		// Reset the URL to the original state (without "success") after 2 seconds
            setTimeout(function() {
                history.replaceState({}, document.title, window.location.pathname);
            }, 1);
        }
		 function data_failed() {
            // Your JavaScript function logic here
            alert("Failed inserting data.");

		// Reset the URL to the original state (without "success") after 2 seconds
            setTimeout(function() {
                history.replaceState({}, document.title, window.location.pathname);
            }, 1);
        }
        // Check if the URL contains "success" and trigger the function
        if (window.location.href.indexOf("success") !== -1) {
             data_success();
        }else if(window.location.href.indexOf("failed") !== -1) {
            data_failed();
        }

        $('#logoutLink').click(function(event) {
        event.preventDefault(); // Prevent the default link behavior
        $.ajax({
            url: '../logout.php', // The URL of your PHP script to handle logout
            type: 'POST', // You can also use 'GET' if your server configuration allows
            success: function(response) {
                // Redirect to login.php on successful logout
                window.location.href = '../login.php';
            },
            error: function(xhr, status, error) {
                console.error(error); // Log any errors to the console
            }
        });
  });
	</script>
</body>
</html>
<?php
// Close the database connection
$conn->close();
?>