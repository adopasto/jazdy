<?php

if (!isset($_POST['data'])) {
    header('Location: login.php');
    exit();
}

include_once 'db_connect.php';

$data = $_POST['data'];
$sql = 'SELECT * FROM users WHERE id = ? AND password = ? LIMIT 1';
$stmt = $conn->prepare($sql);
$password = hash('sha256', $data['password']);
$stmt->bind_param('is', $data['id'], $password);
$stmt->execute();
$result = $stmt->get_result();

session_start();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();    
    $_SESSION['id'] = $row['id'];
    $_SESSION['username'] = $row['firstname'] . ' ' . $row['lastname'];
    header('Location: index.php');    
} else {
    $_SESSION['error'] = 'Invalid username or password.';    
    header('Location: login.php');    
}

exit();