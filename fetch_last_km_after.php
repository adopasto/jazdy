<?php
$servername = "mysql80.r1.websupport.sk";
$username = "admin_dhzo";
$password = "Dharma108";
$dbname = "Zaznam_jazd";

$vehicleName = $_GET['vehicleName'];

// Connection create
$conn = new mysqli($servername, $username, $password, $dbname);

// Connection check
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$sql = "SELECT `KM po jazde` FROM jazda WHERE Vozidlo = '$vehicleName' ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $kmAfter = $row['KM po jazde'];
    echo json_encode(['kmAfter' => $kmAfter]);
} else {
    echo json_encode(['kmAfter' => null]);
}

$conn->close();
?>
