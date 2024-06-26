<?php

if (!isset($_POST['data'])) {
    header('Location: register.php');
    exit();
}

include_once 'functions.php';

session_start();
$data = $_POST['data'];
$_SESSION['data'] = $data;
unset($_SESSION['error']);

//validate email
if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error']['email'] = 'Invalid email';
}

//sanitizacia dat
foreach ($data as $key => $value) {
    $data[$key] = trim(strip_tags($value));

    if (in_array($key, ['firstname', 'lastname'])) {
        $data[$key] = preg_replace('/[^\w ]/', '', $data[$key]);
    }
}

foreach ($data as $key => $value) {
    if (empty($value)) {
        $_SESSION['error'][$key] = 'Field is required';
    }
}

foreach ($data as $key => $value) {
    if ($_POST['data'][$key] != $data[$key]) {
        $_SESSION['error'][$key] = 'Nebezpečný vstup';
    }
}

if (isset($_SESSION['error'])) {
    header('Location: register.php');
    exit();
}

// if (!preg_match('/[a-zA-Z0-9!@#$%^&*/]/', $data['password'])) {    
if (!preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{5,}/', $data['password'])) {    
    $_SESSION['error']['password'] = 'Password must contain at least one uppercase letter, one lowercase letter, one number and one special character';
}
elseif ($data['password'] != $data['repeat-password']) {
    $_SESSION['error']['repeat-password'] = 'Passwords do not match';
}

if (isset($_SESSION['error'])) {
    header('Location: register.php');
    exit();
}

include_once 'db_connect.php';

$sql = 'SELECT * FROM users WHERE email = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $data['email']);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $_SESSION['error']['message'] = 'User already exists';
    header('Location: register.php');
    exit();
}

$activationKey = generateRandomString(16);
$status = STATUS_INACTIVE;
$password = hash('sha256', $data['password']);
$sql = "INSERT INTO users (email, firstname, lastname, password, activation_key, status) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sssssi', $data['email'], $data['firstname'], $data['lastname'], $password, $activationKey, $status);

if ($stmt->execute()) {
    $_SESSION['success'] = 'User created successfully.';

    $to = $data['email'];
    $subject = 'Activate your account';    
    $message .= "Please click the following link to activate your account:<br><br>";
    $message .= '<a href="http://localhost/activate.php?key=' . urlencode($activationKey) . '">Activate your account</a>';
    $headers = "From: admin@knihajazd.sk\r\n";
    $headers .= "Content-type: text/html\r\n";

    $sent = mail($to, $subject, $message, $headers);

    if (!$sent) {
        $_SESSION['success'] .= ' However, the email could not be sent. Please contact our customer support.';        
    }

    header('Location: login.php');
    exit();
} else {
    $_SESSION['error']['message'] = 'Error: ' . $conn->error;
    header('Location: register.php');
    exit();
}