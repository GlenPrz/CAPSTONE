<?php
session_start();

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
$di_Username =  $_SESSION['username'];

?>

<!DOCTYPE html>
<html>
<head>
<title>BTS Driving school</title>
	<link rel="icon" type="image/x-icon" href="../img/favicon.ico">
	<script>
         function updateVehicleBrands() {
            const vehicleTypeSelect = document.getElementById("vehicleType");
            const vehicleBrandModelSelect = document.getElementById("vehicleBrandModel");

            // Clear existing options
            vehicleBrandModelSelect.innerHTML = '<option value="" disabled selected>Select a Vehicle Brand</option>';

            // Get the selected value from the vehicleType select
            const selectedVehicleType = vehicleTypeSelect.value;

            // Fetch brands based on the selected vehicle type using PHP and AJAX
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const brandsForType = JSON.parse(xhr.responseText);

                    // Populate the vehicleBrandModel select with options
                    for (const brand of brandsForType) {
                        const option = document.createElement("option");
                        option.value = brand;
                        option.text = brand;
                        vehicleBrandModelSelect.appendChild(option);
                    }
                }
            };

            xhr.open("GET", "get_brands_for_type.php?type=" + selectedVehicleType, true);
            xhr.send();
        }
    </script>
</head>
<body>
<?php
// Fetch data for the selected student using the provided 'id'
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $username = $_GET['id'];
    // Query for student details
    $sql = "SELECT idStudent, Username, Lastname, Firstname FROM student WHERE Username = '$username'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    // Query for DI details
    $di_sql = "SELECT idStudent, Username, Lastname, Firstname FROM student WHERE Username = '$di_Username'";
    $di_result = $conn->query($di_sql);
    $di_row = $di_result->fetch_assoc();

    if ($row && $di_row) {
        // Modal content HTML with student details
        echo '
            <div id="reportModal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <h1>Report Details</h1>
                    <form action="report_data_insert.php" method="post">
                        <input type="hidden" name="stud_id" value="' . $row['idStudent'] . '">
                        <input type="hidden" name="stud_username" value="' . $row['Username'] . '">
                        <label>Student Username:</label>
                        <input type="text" value="' . $row['Username'] . '"  placeholder="N/A" readonly><br>

                        <label>Last Name:</label>
                        <input type="text" name="stud_lname" value="' . $row['Lastname'] . '" placeholder="N/A" readonly><br>

                        <label>First Name:</label>
                        <input type="text" name="stud_fname" value="' . $row['Firstname'] . '" placeholder="N/A" readonly><br>
                        
                        <input type="hidden" name="Di_id" value="' . $di_row['idStudent'] . '">
                        <input type="hidden" name="Di_lname" value="' . $di_row['Lastname'] . '">
                        <input type="hidden" name="Di_fname" value="' . $di_row['Firstname'] . '">
                        
                        <label>Odometer:</label>
                        <input type="number" name="odometer" placeholder="Enter current odometer here"><br>
                        
                        <label for="vehicleType">Select Vehicle Type:</label>
                        <select id="vehicleType" name="vehicleType" required onchange="updateVehicleBrands()">
                            <option value="" disabled selected>Select a Vehicle Type</option>';
                                // Generate options using fetched data
                                $sql_Vtype = "SELECT DISTINCT type FROM vehicle_tbl";
                                $result_Vtype = $conn->query($sql_Vtype);
                                if ($result_Vtype->num_rows > 0) {
                                    while ($row_Vtype = $result_Vtype->fetch_assoc()) {
                                        echo '<option value="' . $row_Vtype['type'] . '">' . $row_Vtype["type"] . '</option>';
                                    }
                                }
                            echo '</select><br>
                            
                            <label for="vehicleBrandModel">Select Vehicle brand:</label>
                            <select id="vehicleBrandModel" name="vehicleBrandModel" required>
                                <option value="" disabled selected>Select a Vehicle Brand</option>
                            </select><br>

                            <label>Date:</label>
                            <input type="date" name="date" required>
                            <input type="submit" class="PDC_insertbtn" name="submit" value="Submit">
                            <br>
                        </form>
                    </div>
                </div>';
    }
}

// Close the database connection
$conn->close();
?>
</body>
</html>
