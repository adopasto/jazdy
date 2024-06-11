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
$user = $result->fetch_assoc();

session_start();
if (empty($user)) {
    $_SESSION['error'] = 'Invalid username or password.';
    header('Location: login.php');
}
elseif ($user['status'] === STATUS_INACTIVE) {
    $_SESSION['error'] = 'Your account is not activated. Please check your email for activation link.';
    header('Location: login.php');
}
else {
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['firstname'] . ' ' . $user['lastname'];
    header('Location: index.php');    
}

exit();