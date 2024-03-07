<?php

session_start();
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

$servername = "mysql80.r1.websupport.sk";
$username = "admin_dhzo";
$password = "Dharma108";
$dbname = "Zaznam_jazd";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the connection character set to UTF-8
$conn->set_charset("utf8mb4");

// Pagination settings
$recordsPerPage = 50; // Number of records per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page from the query parameter
$offset = ($page - 1) * $recordsPerPage; // Calculate the offset

// Fetch records with pagination
$sql = "SELECT * FROM jazda ORDER BY id DESC LIMIT $offset, $recordsPerPage";
$result = $conn->query($sql);

$records = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $records[] = $row;
    }
}

// Close DB connection
$conn->close();

// Return records in JSON format
header('Content-Type: application/json');
echo json_encode($records);
