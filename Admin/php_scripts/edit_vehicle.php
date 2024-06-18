<?php

// Fetch the 'id' parameter from the URL query string
$vhcl_id = $_GET['id'];

// Connect to the database
$servername = "localhost";
$username = "u896821908_bts";
$password = "a*5E4UEhsHa]";
$dbname = "u896821908_bts";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($vhcl_id) && !empty($vhcl_id) && $vhcl_id != 'none') {
    // Get the vehicle based on the vhcl_id
    $sql = "SELECT * FROM your_vehicle_table WHERE vhcl_id = '$vhcl_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Now you have the data, you can use it as needed
        $vehicle_id = $row['vhcl_id'];
        $vehicle_name = $row['vehicle_name'];
        // Add more fields as needed

        // Output the data or use it in your HTML form
        echo "<h2>Edit Vehicle (ID: $vehicle_id)</h2>";
        echo "<form action='update_vehicle.php?id=$vehicle_id' method='post'>";
        // Add your form fields here, pre-filled with the fetched data
        echo "<label for='vehicle_name'>Vehicle Name:</label>";
        echo "<input type='text' name='vehicle_name' value='$vehicle_name'><br>";
        // Add more fields as needed
        echo "<button type='submit'>Update Vehicle</button>";
        echo "</form>";
    } else {
        // Handle case when vehicle is not found
        echo "Vehicle not found.";
    }
}

// Close the connection
$conn->close();
?>
