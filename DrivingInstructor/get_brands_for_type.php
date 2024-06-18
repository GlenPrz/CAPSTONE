<?php
include "../conn.php";

if (isset($_GET['type'])) {
    $selectedType = $_GET['type'];
    $sql_Vbrand = "SELECT DISTINCT brand FROM vehicle_tbl WHERE type = '$selectedType'";
    $result_Vbrand = $conn->query($sql_Vbrand);

    $brands = array();
    if ($result_Vbrand->num_rows > 0) {
        while ($row_Vbrand = $result_Vbrand->fetch_assoc()) {
            $brands[] = $row_Vbrand["brand"];
        }
    }

    echo json_encode($brands);
}
?>