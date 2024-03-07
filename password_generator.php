<?php

include_once 'config.php';

$records = [
    [
        'firstname' => 'Branislav',
        'lastname' => 'Barták',
        'password' => 'Bartak1234'
    ],
    [
        'firstname' => 'Ľuboš',
        'lastname' => 'Hajdúch',
        'password' => 'LHajduch1234'
    ],
    [
        'firstname' => 'Peter',
        'lastname' => 'Hajdúch',
        'password' => 'PHajduch1234'
    ],
    [
        'firstname' => 'Andrej',
        'lastname' => 'Pastorek',
        'password' => 'Pastorek1234'
    ],
    [
        'firstname' => 'Michal',
        'lastname' => 'Prekop',
        'password' => 'Prekop1234'
    ],
    [
        'firstname' => 'Marek',
        'lastname' => 'Rendek',
        'password' => 'Rendek1234'
    ],
    [
        'firstname' => 'Peter',
        'lastname' => 'Sidor',
        'password' => 'Sidor1234'
    ]
];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $conn->set_charset("utf8mb4");
}

$sql = "INSERT INTO `users` (`firstname`, `lastname`, `password`) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
foreach ($records as $record) {
    $password = hash('sha256', $record['password']);
    $stmt->bind_param("sss", $record['firstname'], $record['lastname'], $password);
    $stmt->execute();
}

$stmt->close();
$conn->close();