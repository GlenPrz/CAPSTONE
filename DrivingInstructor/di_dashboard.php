
<?php
session_start();

if (empty($_SESSION['username'])) {
    header("Location: ../login.php");
}
include "../conn.php";
include "./Script_php/Selection_Student.php";

$query = "SELECT * FROM u896821908_bts.newupdate;";
$stmt = $conn->prepare($query);
$stmt->execute();

$images = $stmt->fetchAll(PDO::FETCH_ASSOC);


$DIdashStraight = "DI";
$_SESSION['DISessionDash'] = $DIdashStraight;


$Didate = '';
if (!isset($_SESSION['username'])) {
    // Redirect the user to the desired location (e.g., login page)
    header('Location: ../login.php');
    exit; // Make sure to exit after the redirection to prevent further code execution
} else {
    $Didate = $_SESSION['username'];
    // Retrieve the data from the database

    try {
        $stmtDi = $conn->prepare("SELECT id_DI, Email, DI_profile_pic, CONCAT(LastName, ', ', Firstname) AS UserNameDi FROM u896821908_bts.di WHERE Username = :DiInfo");
        $stmtDi->bindParam(':DiInfo', $Didate);
        $stmtDi->execute();
        $rowDi = $stmtDi->fetch(PDO::FETCH_ASSOC);
        $DI_id = $rowDi['id_DI'];
        if ($rowDi) {
            $fullName = $rowDi['UserNameDi'];
            
            $email = $rowDi['Email'];
            $profilePicture = $rowDi['DI_profile_pic'];

            if (!isset($_SESSION['availability_updated'])) {
            try {
                // Prepare the SQL statement for updating Availability_status
                $sql = "UPDATE u896821908_bts.di SET Availability_status = 'Active' WHERE id_DI = :di_id";
                $stmt = $conn->prepare($sql);
        
                // Bind parameters
                $stmt->bindParam(':di_id', $DI_id, PDO::PARAM_INT); // Assuming id_DI is an integer
        
                // Execute the update query
                if ($stmt->execute()) {
                    // The update was successful
                    // Set the session variable to indicate that the update has been performed
                    $_SESSION['availability_updated'] = true;
                    // You can add a success message or redirect here
                } else {
                    // Handle the case where the update fails
                    echo "Failed to update Availability_status.";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
             
        } else {
            // Handle the case where no user was found
            echo "User not found.";
        }
        
        
    } catch (PDOException $e) {
        echo "Database connection failed: " . $e->getMessage();
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
  <link rel="stylesheet" href="DI_PORTAL.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<script>
    function reloadPageEvery10Seconds() {
        setTimeout(function() {
            location.reload();
        },  60 * 1000); // 3 minutes in milliseconds
    }
    
    // Call the function to start the reload timer
    reloadPageEvery10Seconds();

    
  
    </script>
</head>
<style>
  .numbertext {
		color: #f2f2f2;
		font-size: 12px;
		padding: 8px 12px;
		position: absolute;
		top: 0;
	}

	.Img_design_slider {
		border-radius: 2px;
		width: 100%;
		height: 520px;
	}
  .nav_links a:nth-child(1) {
    background-color: green;
    border-radius: 10px;
    color: white;
  }

  .SchedulePDC {
    width: 100%;
    height: 55%;
    padding: 1%;
	margin: auto;
    border-radius: 3px;
    box-shadow: 2px 10px 8px #AADE91;
    float: left;
    display: block;
  }

  .sched {
    background-color: green;
    color: white;
    width: 70%;
    border: none;
    font-family: inherit;
    padding: 1.1rem;
    align-items: center;
    text-align: center;
    border-radius: 10px;
    font-size: 20px;
    margin-left: 15%;
  }

  .Announcement {
    margin-top: 5%;
    width: 100%;
    height: 30%;
    padding: 1%;
    border-radius: 3px;
    box-shadow: 2px 7px 8px #AADE91;
    /* Adding shadow to the nav_bar */
    float: left;
    margin-top: 5%;
    display: block;
    clear: both;
  }.Announcement h4{
  box-shadow: 2px 7px 8px gray;
  width: 100%;
  }

  .Students {
    width: 100%;
    height: 40%;
    padding: 3%;
    border-radius: 3px;
    box-shadow: 2px 7px 8px #AADE91;
    float: right;
    display: block;
  }

  .leftContainer {
    width: 100%;
    float: left;
    display: block;

  }

  .rightContainer {
    width: 40%;
    display: inline-block;
    margin-left: 5%;
  }

 #myProgress {
  width: 100%;
  background-color: #ddd;

}

  #myBar {  
  width: 100%;
  height: 30px;
  background-color: #04AA6D;
  text-align: center;
  line-height: 30px;
  color: white;
}table{
  width: 100%;
  text-align: center;
}.img_container img {
      max-width: 80%;
      max-height: 40%;
      border-radius: 3px;
      margin-left: 10%;
      margin-top: 2%;
    }
	
	.assigned_student{
		background-color:#e4f7df;
		margin-bottom: 3%;
		display: flex;
		padding: 3%;
		width: 100%;
		border-radius: 3px;
		box-shadow:  7px 7px 14px #656565,
					-7px -7px 14px #ffffff;
	}

	.STD_info{
		margin: auto;
		width: 80%;
	}
	.big_title {
      font-size: 30px;
      font-weight: 700;
      margin-bottom: 3%;
      color: green;
      border-bottom: 2px solid green; /* Add an underline with 2px solid green */
    }
	.STD_info .title{
		font-size: 23px;
		font-weight: 600;
	}
	.STD_info .val{
		font-size: 21px;
		font-weight: 500;
	}
	
	
	.btn_container{
	    margin: 3% auto;
	    display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
	    width: 100%;
	    display: flex;
	}
	.right_container{
	    margin-right: 4%;
	    display: flex;
		width: 130px;
		height: 155px;
		background-color: transparent;
		float: right;
	}
	.left_container{
	    float: left;
	}
	.table_container{
	    margin-top: 20%;
	}
    .std_assess {
        background-color: #4CAF50; /* Green background color */
        color: white; /* White text color */
        padding: 15px 40px; /* Padding around the text */
        border: none; /* Remove the border */
        cursor: pointer; /* Show a pointer cursor on hover */
        border-radius: 5px; /* Rounded corners */
        font-size: 16px; /* Font size */
    }

    .std_decline {
        background-color: #FF5733; /* Red background color */
        color: white; /* White text color */
        padding: 15px 40px; /* Padding around the text */
        border: none; /* Remove the border */
        cursor: pointer; /* Show a pointer cursor on hover */
        border-radius: 5px; /* Rounded corners */
        font-size: 16px; /* Font size */
    }

    .std_assess,
    .std_decline {
        margin: 5px;
    }

    .std_assess:hover{
		background-color: #204a22;
	}
    .std_decline:hover {
		background-color: #521d12;
  }
    .DIstatus select{
       width: 50%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 0px;
      font-size: 15px;
  }
  .slide_show {
        padding: 10px;
        width: 100%;
        height: 550px;
        /* Set a specific height for the slideshow */

}.slideshow-container {
        max-width: 800px;
        position: relative;
        margin: auto;
    }
    
     table.styled-table {
        border-collapse: collapse;
        width: 100%;
        border-radius: 8px;
        overflow: hidden;
        margin-top: 10px;
        background-color: white;
    }
    .header-row{
        background-color: green;
        color: white;
    }
    table.styled-table td, table.styled-table th {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    table.styled-table th {
        font-size: 18px;
        font-weight: 600;
    }

    table.styled-table tr.data-row {
        font-size: 16px;
        font-weight: 400;
    }

    table.styled-table tr.center-text td {
        text-align: center;
    }
    
    .Student_list{
        margin: 5% 0 10%;
        width: 100%;
        height: 400px;
    }
    .std_list_tbl{
        overflow: auto;
        width: 100%;
        height: 350px;
    }
     #search {
        margin-bottom: 10px;
        padding: 12px;
        font-size: 15px;
    }

   .Student_list table {
        width: 100%;
        border-collapse: collapse;
    }

   .Student_list th, .Student_list td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

   .Student_list th {
        padding: 12px;
        font-size: 18px;
        font-weight: 500;
        background-color: green;
        color: white;
    }

    .Student_list tr:nth-child(even) {
        background-color: #f9f9f9;
    }

   .Student_list tr:hover {
        background-color: #e4f7df;
    }
   .std_img{
       display:none;
   }
   @media only screen and (max-width: 600px) {
      .nav_links a {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        font-size: 12px;
      }
    
      .nav_links a i, .username, .email, .Student_list{
        display: none;
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
      
      
      
      
    }
    
     @media only screen and (max-width: 1440px) {
      .username{
        font-size: 13px;
      }
      .email{
        font-size: 10px;
      }
      
      
      
      
    }
</style>

<body>
    <div class="nav-container">
      <nav>
		<div class="profile" id="profile-box">
            <img src="../uploads/Di_uploads/<?php echo basename($profilePicture); ?>" alt="Profile Picture" />
            <div class="namecon">
              <span class="username"><?php echo $fullName ?></span><br>
              <span class="email"><?php echo $email ?></span>
            </div>
            <!--DITO USERNAME VARIABLE NG STUDENT-->
          </div>
     

        <div class="nav_links">
          <a href="di_dashboard.php"><i class="fas fa-tachometer-alt"></i>Home</a>
          <a href="di_reportSub.php"><i class="fas fa-chart-bar"></i>Reports</a>
          <a href="#" id="logout-link"><i class="fas fa-sign-out-alt"></i>Log Out</a>
        </div>
        
         <form id="logout-form" action="DI_logout.php" method="post" onsubmit="return confirm('If you want to logout click Ok.');">
        <!-- Add an input field to submit a value -->
        <input type="hidden" name="di_id" value="<?php echo $DI_id;?>">
        <button type="submit" id="logout-button" style="display: none;"></button>
		</form>
		
		

        <center><div class="logo_container">
                        <img src="../img/bts_logo.png" class="admin_logo">
                    </div><br>
                    <h2 class="label">Best Training School</h2>
                  </center>
      </nav>
    </div>

  <div class="content-container">
      <header><h2 class="title_header">DRIVER INSTRUCTOR PORTAL</h2></header>
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
				?>
					<br><br>
					<div class="leftContainer">
					  <div class="assigned_student">
						<div class="STD_info">
						<?php
						  $diAssignQuery = "SELECT * FROM di_assign_tbl WHERE DI_id = :DI_id AND status = 'pending'";
						  $diAssignStatement = $conn->prepare($diAssignQuery);
						  $diAssignStatement->bindParam(':DI_id', $DI_id); // Bind the parameter

						  $diAssignStatement->execute();
						  $diAssignRows = $diAssignStatement->fetchAll(PDO::FETCH_ASSOC);
						
						  if (count($diAssignRows) > 0) {
							$DI_Assign_logout = false;
							$_SESSION['DI_Assign_logout'] = $DI_Assign_logout;
							$diAssignRow = $diAssignRows[0];
							$stud_id = $diAssignRow['Student_id'];
							$assign_id = $diAssignRow['Di_Assign'];
							$_SESSION['DI_assign_id'] = $assign_id;
							
							// Query to retrieve additional student information from the students table
							$studentQuery = "SELECT * FROM student WHERE idStudent = :stud_id";
							$studentStatement = $conn->prepare($studentQuery);
							$studentStatement->bindParam(':stud_id', $stud_id); // Bind the parameter

							$studentStatement->execute();
							$studentRows = $studentStatement->fetchAll(PDO::FETCH_ASSOC);


							
							if (count($studentRows) > 0) {
							  $studentRow = $studentRows[0];
							  $lastname = $studentRow['Lastname'];
							  $firstname = $studentRow['Firstname'];
							  $middlename = $studentRow['Middlename'];
							  $suffix = $studentRow['Suffix'];
							  $student_permit_number = $studentRow['Student_permit_number'];
                              $STDprofilePicture = $studentRow['Profile_picture'] ?? '';

							  // Now, you can fetch and display the data.
							}
							echo '<div class="left_container">
							<p class="big_title">Assigned Student</p>
							<img class="std_img" src="../uploads/'.basename($STDprofilePicture).'" alt="Profile Picture" />
							
        							<output><p class="stitle">Student Name:</p></output>
        							<output><p class="val">&emsp;&emsp;' . $lastname . ', ' . $firstname . ' ' . $middlename . ' ' . $suffix .'</p></output><br>
        							<output><p class="stitle">Student Permit Number:</h2></output>
        							<output><p class="val">&emsp;&emsp;' . $student_permit_number . '</p></output>
        						  </div>';
							
							echo '<div class="right_container">
                                    <img src="../uploads/'.basename($STDprofilePicture).'" alt="Profile Picture" />
        						  </div>';
            
							
							echo "<br>
							<div class='table_container'>
                                    <h2>PDC Results</h2>
                                    <table class='styled-table'>
                                        <tr class='header-row'>
                                            <td>Session</td>
                                            <td>Course Enrolled</td>
                                            <td>Date</td>
                                            <td>Assessment</td>
                                        </tr>";
                                
                                $servername = "localhost";
                                $username = "u896821908_bts";
                                $password = "a*5E4UEhsHa]";
                                $dbname = "u896821908_bts";
                                
                                $conn = new mysqli($servername, $username, $password, $dbname);
                                
                                // Retrieve data from the "pdc_result" table where Student_id is equal to $studentId
                                $sql = "SELECT * FROM pdc_result WHERE Student_id = '$stud_id'";
                                $result1 = $conn->query($sql);
                                
                                if ($result1->num_rows > 0) {
                                    // Student data found
                                    while($row1 = $result1->fetch_assoc()) {
                                        // Echo the total fee and remaining balance in the table cells
                                        echo "
                                            <tr class='data-row'>
                                                <td>" . $row1['session'] . "</td>
                                                <td>" . $row1['PDC_Course_enrolled'] . "</td>
                                                <td>" . $row1['Date'] . "</td>
                                                <td>" . $row1['Assessment'] . "</td>
                                            </tr>";
                                    }
                                } else {
                                    // Student not found, handle the error appropriately
                                    echo "<tr class='center-text'><td colspan='4'>No results found</td></tr>";
                                }
                                
                                
                                
                                
                                echo '</table>
                                </div>
                                        <div class="btn_container">
									<form method="POST" action="DI_assess_welcome.php">
									  <input type="hidden" name="DI_id" value="' . $DI_id . '">
									  <input type="hidden" name="stud_id" value="' . $stud_id . '">
									  <button type="submit" class="std_assess">Accept</button>
									</form>  
										<form method="POST" action="Script_php/Di_std_Declined.php" onsubmit="return confirm(\'Are you sure you want to decline this student?\');">
											<input type="hidden" name="DI_id" value="' . $DI_id . '">
											<input type="hidden" name="assign_id" value="' . $assign_id . '">
											<button type="submit" class="std_decline">Decline</button>
										</form>
										</div>
								</div>
										 ';
                                $sql_UPDATE = "UPDATE di SET Availability_status = 'Assigned' WHERE id_DI = '$DI_id' ";
                                 if ($conn->query($sql_UPDATE) === TRUE) {
                                    // Great
                                  } 
						  }
						  else {
							$DI_Assign_logout = true;
							$_SESSION['DI_Assign_logout'] = $DI_Assign_logout;
							echo '<output><p class="title" style="font-size: 40px;">No student assigned to you.</p></output>';
							echo '</div>';
							
						  }
						?>
                        <script>
                            // Add a click event handler to the logout link
                            document.getElementById("logout-link").addEventListener("click", function(event) {
                                console.log("Clicked"); // Add this line to check if the click event is captured
                        
                                // Check your condition here (replace with your actual variable)
                                var yourVariable = <?php echo json_encode($DI_Assign_logout); ?>;
                                
                                if (yourVariable) {
                                    // If yourVariable is true, submit the form
                                    document.getElementById("logout-button").click();
                                } else if (yourVariable === false) {
                                    // If yourVariable is false, show an alert
                                    alert("You need to decline the student assigned to you first.");
                                }
                            });
                        </script>
						</div>
                        <div class="Student_list">
                             <header><h2>Student Assignment Record</h2></header><br>
                           <form id="searchForm">
                                <input type="text" id="search" name="search" placeholder=" search..." oninput="filterTable()">
                            </form>
                            <div class="std_list_tbl">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="student-id">Student_id</th>
                                            <th class="student-name">Student Name</th>
                                            <th class="date">Date</th>
                                            <th class="status">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody">
                                        <?php
                                    if (!empty($Didate)) {

                                        try {
                                            // Create a PDO instance
                                            $pdo = new PDO("mysql:host=localhost;dbname=u896821908_bts", "u896821908_bts", "a*5E4UEhsHa]");
                                    
                                            // Set the PDO error mode to exception
                                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    
                                            // Prepare the SQL statement
                                            $sql_di = "SELECT * FROM di WHERE Username = :Didate";
                                            $stmt_di = $pdo->prepare($sql_di);
                                            $stmt_di->bindParam(':Didate', $Didate, PDO::PARAM_STR);
                                    
                                            // Execute the query
                                            $stmt_di->execute();
                                    
                                            // Check if there are rows in the result
                                            if ($stmt_di->rowCount() > 0) {
                                                while ($row_di = $stmt_di->fetch(PDO::FETCH_ASSOC)) {
                                                    $DI_ID = $row_di["id_DI"];
                                              if (isset($_GET['search'])) {
                                                  // Prepare the SQL statement with JOINs and search conditions
                                                    $sql = "SELECT di_assign_tbl.Student_id, di_assign_tbl.Date, di_assign_tbl.status, 
                                                            student.Lastname, student.Firstname
                                                            FROM di
                                                            JOIN di_assign_tbl ON di.id_DI = di_assign_tbl.Di_Id
                                                            LEFT JOIN student ON di_assign_tbl.Student_id = student.idStudent
                                                            WHERE di.Username = :Didate AND (
                                                                di_assign_tbl.Student_id LIKE :searchParam
                                                                OR student.Lastname LIKE :searchParam
                                                                OR student.Firstname LIKE :searchParam
                                                                OR di_assign_tbl.Date LIKE :searchParam
                                                                OR di_assign_tbl.status LIKE :searchParam
                                                            )";
                                            
                                                    $stmt = $pdo->prepare($sql);
                                                    $stmt->bindParam(':Didate', $Didate, PDO::PARAM_STR);
                                            
                                                    // Set the search parameter for each column
                                                    $searchParam = '%' . $_GET['search'] . '%';
                                                    $stmt->bindParam(':searchParam', $searchParam, PDO::PARAM_STR);
                                                }  else {
                                                     // Prepare the SQL statement with JOINs
                                                    $sql = "SELECT di_assign_tbl.Student_id, di_assign_tbl.Date, di_assign_tbl.status, 
                                                            student.Lastname, student.Firstname
                                                            FROM di
                                                            JOIN di_assign_tbl ON di.id_DI = di_assign_tbl.Di_Id
                                                            LEFT JOIN student ON di_assign_tbl.Student_id = student.idStudent
                                                            WHERE di.Username = :Didate";
                                                
                                                    $stmt = $pdo->prepare($sql);
                                                    $stmt->bindParam(':Didate', $Didate, PDO::PARAM_STR);
                                                
                                                } 
                                                    
                                                  
                                                // Execute the query
                                                $stmt->execute();
                                            
                                                // Check if there are rows in the result
                                                if ($stmt->rowCount() > 0) {
                                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                        echo "<tr>";
                                                        echo "<td class='student-id'>" . $row["Student_id"] . "</td>";
                                            
                                                        $studentName = isset($row["Lastname"]) ? $row["Lastname"] . ", " . $row["Firstname"] : "Deleted Student";
                                                        echo "<td class='student-name'>" . $studentName . "</td>";
                                            
                                                        echo "<td class='date'>" . $row["Date"] . "</td>";
                                                        echo "<td class='status'>" . $row["status"] . "</td>";
                                                        echo "</tr>";
                                                    }
                                                    } else {
                                                        echo "<tr><td colspan='4'> No records found</td></tr>";
                                                    }
                                                }
                                            } else {
                                                echo "<tr><td colspan='4'>No records found in di table for Username: $Didate</td></tr>";
                                            }
                                        } catch (PDOException $e) {
                                            echo "Error: " . $e->getMessage();
                                        } finally {
                                            // Close the PDO connection
                                            $pdo = null;
                                        }
                                    } else {
                                        echo "Di is empty or not set.";
                                    }
                                        $conn->close();
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>    




        </div>
 
    </div>
    
       
    
    
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  var screenWidth = screen.width;

  if (screenWidth <= 1000) {
    var elementsToHide = document.getElementsByClassName("hide-on-mobile");

    // Loop through elements and hide them
    for (var i = 0; i < elementsToHide.length; i++) {
      elementsToHide[i].style.display = "none";
    }
  }
</script>
<script>
    function filterTable() {
        // Declare variables
        var input, filter, table, tbody, tr, td, i, txtValue;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        table = document.getElementById("tableBody");
        tbody = table.getElementsByTagName("tbody");
        tr = tbody[0].getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1]; // Change index to the column you want to search (0-based)
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    // Prevent form submission
    document.getElementById("searchForm").addEventListener("submit", function(event) {
        event.preventDefault();
    });
</script>

 
<script>
		function declined() {
            // Your JavaScript function logic here
            alert("You have successfuly declined the student");

		// Reset the URL to the original state (without "success") after 2 seconds
            setTimeout(function() {
                history.replaceState({}, document.title, window.location.pathname);
            }, 1);
        }
		 function notdeclined() {
            // Your JavaScript function logic here
            alert("Failed to decline Student. please try again.");

		// Reset the URL to the original state (without "success") after 2 seconds
            setTimeout(function() {
                history.replaceState({}, document.title, window.location.pathname);
            }, 1);
        }
		 function Assessment_done() {
            // Your JavaScript function logic here
            alert("Report Completed!");

		// Reset the URL to the original state (without "success") after 2 seconds
            setTimeout(function() {
                history.replaceState({}, document.title, window.location.pathname);
            }, 1);
        }
        // Check if the URL contains "success" and trigger the function
        if (window.location.href.indexOf("decline") !== -1) {
              declined();
        }else if(window.location.href.indexOf("!decline") !== -1) {
            notdeclined();
        }else if(window.location.href.indexOf("Assessment_done") !== -1) {
            Assessment_done();
		}
		
</script>

<script>
    let slideIndex = 0;
    let slides = document.getElementsByClassName("mySlides");

    showSlides();

    function showSlides() {
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex >= slides.length) {
            slideIndex = 0;
        }
        slides[slideIndex].style.display = "block";
        setTimeout(showSlides, 4000); // Change image every 4 seconds
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

<?php }?>
</body>

</html>