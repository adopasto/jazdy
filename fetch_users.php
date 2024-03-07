<?php

include_once 'db_connect.php';

$sql = "SELECT * FROM users";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$usersDropdown = [];
while ($row = $result->fetch_assoc()) {    
    $usersDropdown[$row['id']] = $row['firstname'] . ' ' . $row['lastname'];
}

$stmt->close();
$conn->close();