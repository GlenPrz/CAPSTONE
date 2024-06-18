<?php
session_start();
include "../conn.php";
include "./Script_php/Selection_Student.php";

if (!isset($_SESSION['username'])) {
    // Redirect the user to the desired location (e.g., login page)
    header('Location: ../login.php');
    exit; // Make sure to exit after the redirection to prevent further code execution
}
// Retrieve the data from the database
echo $_SESSION['username'];
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
  .nav_links a:nth-child(3) {
        background-color: green;
        border-radius: 10px;
        color: white;
    }
.featured_courses_services{
      display: block;
      padding: 30px;
      margin: auto;
      margin-top: 1.5%;
      width: 100%;
      height: 700px; /* Set a specific height for the slideshow */
     
    }
    
    .featured_courses_services h2 {
      color: green;
      font-size: 40px;
      height: 20px;
    }
    .box_container{
        text-align: center;
        margin: 0 auto;
        display: flex;
        height: 70%;
        width: 100%;
    }
    .Modules {
      margin: auto;
      width: 25%;
      height: 80%;
      padding: 1%;
      border-radius: 3px;
      box-shadow: 2px 7px 8px rgba(0, 0, 0, 0.2); /* Adding shadow to the nav_bar */
    }   
    .Modules:hover{
      background-color: rgba(87, 138, 93, .2);
    }
    
    .Modules .img_container{
        text-align: center;
    }
    .Modules img {
      max-width: 70%;
      max-height: 40%;
      border-radius: 3px;
    }

    .Modules h4 {
      margin: 10px 0;
      font-size: 18px;
      color: green;
    }

    .Modules p {
      margin: 5px 0;
      font-size: 16px;
    }

    .enroll-section {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .enroll-button {
      display: block;
      margin: 10px 10px 10px 0;
      padding: 8px 16px;
      background-color: green;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 20px;
      border-radius: 10px;
    }
    
    .enroll-button:hover{
      background-color: #173d19;
    }

    .starts-at {
      font-size: 18px;
      color: black;
    }.img_container img{
        max-width: 70%;
      max-height: 40%;
      border-radius: 3px;
    }
    
</style>
<body>
    <div class ="main-container">
          <div class="nav-container">
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
                <!-- <a href ="di_modules.php">Modules</a> -->
                <a href="" id = "logoutLink">Log Out</a>

            </div>
            </nav>
        </div>
    </div>
    <div class = "content-container">
        
        <?php
// Assuming you have a database connection
$servername = "localhost";
$username = "u896821908_bts";
$password = "a*5E4UEhsHa]";
$dbname = "u896821908_bts";

try {
    // Create a PDO connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL query to count the rows in the "student" table
    $sql = "SELECT COUNT(*) as count FROM admin";
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result) {
        // Fetch the count value
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $total_students = $row['count'];
    } else {
        echo "Error in query: " . print_r($conn->errorInfo(), true);
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Close the database connection (not necessary for PDO, but good practice)
$conn = null;
?>

<div class="Heading">
    <div class="title">
                  <h2>BEST TRAINING SCHOOL</h2>
                  <h4>Driver Instructor Portal</h4>
                      
                    </div>
                </div>
<div class="featured_courses_services">
        <h2>Featured courses</h2>
        <div class="box_container">
            <div class="Modules">
                <div class="img_container">
                  <img src="../img/module\module1.png" alt="tdc Image">
                </div> 
                  <h4>Module Number 1</h4>
                  <p>Details of the modules</p>
                    <div class="enroll-section">
                        <button class="enroll-button" id ="Enrollbtn1">View</button>
                    </div>
            </div>
            
            <div class="Modules">
                <div class="img_container">
                  <img src="../img/module\module2.png" alt="pdc_mc Image">
                </div> 
                  <h4>Module Number 2</h4>
                  <p>Details of the module</p>
                    <div class="enroll-section">
                      <button class="enroll-button" id ="Enrollbtn2">View</button>
                    </div>
            </div>
            
            <div class="Modules">
                 <div class="img_container">
                  <img src="../img/module\module3.png" alt="pdc_c Image">
                </div> 
                <h4>Module Number 3</h4>
                  <p>Details of the Module</p>
                    <div class="enroll-section">
                      <button class="enroll-button" id ="Enrollbtn3">View</button>
                    </div>
            </div>
        </div>
    </div>                
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script>
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