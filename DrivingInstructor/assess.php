

<?php
$servername = "localhost";
$username = "u896821908_bts";
$password = "a*5E4UEhsHa]";
$dbname = "u896821908_bts";
session_start();
// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data for the selected student using the provided 'id'
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $username = $_GET['id'];
    $sql = "SELECT b.idStudent, b.Username, b.Lastname, b.Firstname, b.Contactnumber, b.Sex, b.EmailAddress, s.`PDC-MOTOR`, s.`PDC-CAR`, s.LicenseNumber, s.ExpirationDate 
            FROM u896821908_bts.student AS b JOIN student_enrolled AS s ON b.Username = s.Username WHERE b.Username = '$username'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

$PDC_Motor = $row['PDC-MOTOR'];
$PDC_CAR = $row['PDC-CAR'];

    if ($row) {
			// checking if done with the sessions for Motorcycle(mt/at)     //MS1 = Motorcycle Session 1
			$sql_MS1 = "SELECT * FROM u896821908_bts.pdc_result WHERE Username = '$username' AND PDC_Course_enrolled ='$PDC_Motor' AND session = 1 AND Assessment = 'pass'";
			$result_MS1 = $conn->query($sql_MS1);
			$row_MS1 = $result_MS1->fetch_assoc();
			if ($row_MS1) {
				$M_pdc_sesh_1_exist = true;
			}else{
				$M_pdc_sesh_1_exist = false;
			};
			
			 //MS2 = Motorcycle Session 2
			$sql_MS2 = "SELECT * FROM u896821908_bts.pdc_result WHERE Username = '$username' AND PDC_Course_enrolled ='$PDC_Motor' AND session = 2 AND Assessment = 'pass'";
			$result_MS2 = $conn->query($sql_MS2);
			$row_MS2 = $result_MS2->fetch_assoc();
			if ($row_MS2) {
				$M_pdc_sesh_2_exist = true;
			}else{
				$M_pdc_sesh_2_exist = false;
			};
				
			// checking if done with the sessions for CAR(mt/at)     //CS1 = CAR Session 1
			$sql_CS1 = "SELECT * FROM u896821908_bts.pdc_result WHERE Username = '$username' AND PDC_Course_enrolled ='$PDC_CAR' AND session = 1 AND Assessment = 'pass'";
			$result_CS1 = $conn->query($sql_CS1);
			$row_CS1 = $result_CS1->fetch_assoc();
			if ($row_CS1) {
				$C_pdc_sesh_1_exist = true;
			}else{
				$C_pdc_sesh_1_exist = false;
			};
			
			 //CS2 = CAR Session 2
			$sql_CS2 = "SELECT * FROM u896821908_bts.pdc_result WHERE Username = '$username' AND PDC_Course_enrolled ='$PDC_CAR' AND session = 2 AND Assessment = 'pass'";
			$result_CS2 = $conn->query($sql_CS2);
			$row_CS2 = $result_CS2->fetch_assoc();
			if ($row_CS2) {
				$C_pdc_sesh_2_exist = true;
			}else{
				$C_pdc_sesh_2_exist = false;
			};
			
			$di_Username =  $_SESSION['username'];

			// Query for DI details
			$di_sql = "SELECT idadmin, Username, Lastname, Firstname FROM u896821908_bts.admin WHERE Username = '$di_Username'";
			$di_result = $conn->query($di_sql);
			$di_row = $di_result->fetch_assoc();
		
        // Modal content HTML with student details
        echo '
            <div id="assessmentModal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            
			<img src="../img/bts_logo.png" class="modal_logo">
				
            <form action="insert_data.php" method="post">
			<h1>User Details</h1>
				<input type="hidden" name="stud_id" value="' . $row['idStudent'] . '">
                <input type="hidden" name="username" value="' . $row['Username'] . '">
                <label>Username:</label>
                <input type="text" value="' . $row['Username'] . '" placeholder="N/A" disabled>
                <div class="form-container">
                    <div class="form-row">
                        <label>Last Name:</label>
                        <input type="text" class="stud_name" name="stud_lname" value="' . $row['Lastname'] . '" placeholder="N/A" readonly>
                    </div>
                    <div class="form-row">
                        <label>&nbspFirst Name:</label>
                        <input type="text" class="stud_name" name="stud_fname" value="' . $row['Firstname'] . '" placeholder="N/A" readonly>
                    </div>
                    <div class="form-row">
                        <label>Contact No.:</label>
                        <input type="text" value="' . $row['Contactnumber'] . '" placeholder="N/A" disabled>
                    </div>
                    <div class="form-row">
                        <label>&nbspSex:</label>
                        <input type="text" value="' . $row['Sex'] . '" placeholder="N/A" disabled>
                    </div>
                    <div class="form-row">
                        <label>Email Address:</label>
                        <input type="text" value="' . $row['EmailAddress'] . '" placeholder="N/A" disabled>
                    </div>
                </div>
                <hr class="thin_hr"><br>
           
                    <div class="form-row">
                        <label>PDC MOTOR:</label>
                        <input type="text" value="' . $row['PDC-MOTOR'] . '" placeholder="N/A" disabled>
                        <label class="session_lbl" for="session1">Session 1:</label>
							<input type="checkbox" name="session1" id="session1" ' . ($M_pdc_sesh_1_exist ? 'checked' : '') . ' disabled>
                        <label class="session_lbl" for="session2">Session 2:</label>
							<input type="checkbox" name="session2" id="session2" ' . ($M_pdc_sesh_2_exist ? 'checked' : '') . ' disabled>
                   </div>
				   
                    <div class="form-row">
                        <label>PDC CAR:</label>
                        <input type="text" value="' . $row['PDC-CAR'] . '" placeholder="N/A" disabled>
						<label class="session_lbl" for="session1">Session 1:</label>
							<input type="checkbox" name="session1" id="session1" ' . ($C_pdc_sesh_1_exist ? 'checked' : '') . ' disabled>
                        <label class="session_lbl" for="session2">Session 2:</label>
							<input type="checkbox" name="session2" id="session2" ' . ($C_pdc_sesh_2_exist ? 'checked' : '') . ' disabled>
                    </div>
				<br>	
				<hr class="thin_hr"><br>
				
                <div class="form-row">
                    <!-- Add the new data input fields -->
                    <label for="course">PDC Course Enrolled:</label>
                    <select name="course" id="course" required>
                        <option value="" disabled selected>Select a course</option>
                       <option value="' . $PDC_Motor . '" ' . ($PDC_Motor === '' ? 'disabled="disabled"' : '') . '>' . ($PDC_Motor === '' ? 'N/A' : $PDC_Motor) . '</option>
						<option value="' . $PDC_CAR . '" ' . ($PDC_CAR === '' ? 'disabled="disabled"' : '') . '>' . ($PDC_CAR === '' ? 'N/A' : $PDC_CAR) . '</option>

                    </select>
                </div>
                <div class="form-row">
                    <label>Session:</label>
                    <select name="session" id="session" required>
                        <option value="" disabled selected>Select a session</option>
                        <option value="1">Session 1</option>
                        <option value="2">Session 2</option>
                    </select>
                </div>
                <div class="form-row">
                    <label>Assessment:</label>
                    <select name="assessment" id="assessment" required>
                        <option value="" disabled selected>Choose 1</option>
                        <option value="pass">Passed</option>
                        <option value="fail">Failed</option>
                    </select>
                </div>
				<br><hr class="thin_hr"><br>
					
				  <div class="form-row">
				 <h3>Report Details</h3>
                        <input type="hidden" name="Di_id" value="' . $di_row['idadmin'] . '">
                        
                        <label>Odometer:</label>
                        <input type="number" name="odometer" placeholder="Enter current odometer here">
					</div> 	
                    <div class="form-row">   
                        <label for="vehicleType">Select Vehicle Type:</label>
                        <select id="vehicleType" name="vehicleType" required>
                              <option value="" disabled selected>Select a course</option>
							  <option value="' . $PDC_Motor . '" ' . ($PDC_Motor === '' ? 'disabled="disabled"' : '') . '>' . ($PDC_Motor === '' ? 'N/A' : $PDC_Motor) . '</option>
							  <option value="' . $PDC_CAR . '" ' . ($PDC_CAR === '' ? 'disabled="disabled"' : '') . '>' . ($PDC_CAR === '' ? 'N/A' : $PDC_CAR) . '</option>
						</select><br>
                    </div> 
					
					<div class="form-row">   
						<label for="vehicleBrandModel">Select Vehicle Type:</label>
                        <select id="vehicleBrandModel" name="vehicleBrandModel" required>
                            <option value="" disabled selected>Select a Vehicle Brand and Model</option>';
                                // Generate options using fetched data
                                $sql_Vtype = "SELECT vehicle_brand_model FROM vehicle_tbl WHERE type LIKE '%$PDC_Motor%' OR type LIKE '%$PDC_CAR%'";
                                $result_Vtype = $conn->query($sql_Vtype);
                                if ($result_Vtype->num_rows > 0) {
                                    while ($row_Vtype = $result_Vtype->fetch_assoc()) {
                                        echo '<option value="' . $row_Vtype['vehicle_brand_model'] . '">' . $row_Vtype["vehicle_brand_model"] . '</option>';
                                    }
                                }
                            echo '</select><br>	
                    </div>    
                           
						<div class="form-row"> 
                            <label>Date:</label>
                            <input type="date" name="date" required>
                            <input type="submit" class="PDC_insertbtn" name="submit" value="Submit">
                            <br>
						</div>
            </form>
        ';
		
    }
}

// Close the database connection
$conn->close();
?>
