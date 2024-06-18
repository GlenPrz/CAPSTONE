<?php
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

// Fetch data for the selected student using the provided 'id'
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $username = $_GET['id'];
    $sql = "SELECT b.Username, b.Lastname, b.Firstname, b.Contactnumber, b.Sex, b.EmailAddress, s.TDC, s.DEP, s.`PDC-MOTOR`, s.`PDC-CAR`, s.LicenseNumber, s.ExpirationDate 
							FROM u896821908_bts.student AS b JOIN student_enrolled AS s ON b.Username = s.Username WHERE b.Username = '$username'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($row) {
        // Modal content HTML with student details
        echo '
            <div id="assessmentModal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                    <h1>User Details</h1>
					 <form>
						<label>Username:</label>
						<input type="text" value="' . $row['Username'] . '"><br>

						<label>Last Name:</label>
						<input type="text" value="' . $row['Lastname'] . '"><br>

						<label>First Name:</label>
						<input type="text" value="' . $row['Firstname'] . '"><br>

						<label>Contact Number:</label>
						<input type="text" value="' . $row['Contactnumber'] . '"><br>

						<label>Sex:</label>
						<input type="text" value="' . $row['Sex'] . '"><br>

						<label>Email Address:</label>
						<input type="text" value="' . $row['EmailAddress'] . '"><br>

						<label>TDC:</label>
						<input type="text" value="' . $row['TDC'] . '"><br>

						<label>DEP:</label>
						<input type="text" value="' . $row['DEP'] . '"><br>

						<label>PDC MOTOR:</label>
						<input type="text" value="' . $row['PDC-MOTOR'] . '"><br>

						<label>PDC CAR:</label>
						<input type="text" value="' . $row['PDC-CAR'] . '"><br>

						<label>License Number:</label>
						<input type="text" value="' . $row['LicenseNumber'] . '"><br>

						<label>Expiration Date:</label>
						<input type="text" value="' . $row['ExpirationDate'] . '"><br>
					</form>
					
                </div>
            </div>
        ';
    }
}

// Close the database connection
$conn->close();
?>
