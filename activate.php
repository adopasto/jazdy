<?php

include_once 'functions.php';

if (!isset($_GET['key'])) {
    header('Location: login.php');
    exit();
}

$key = $_GET['key'];
$key = preg_replace('/[^a-zA-Z0-9]/', '', $key);

if (empty($key)) {
    header('Location: login.php');
    exit();
}

if (!$user) {
    $message = 'Invalid activation key';
} 
elseif ($user['status'] === STATUS_ACTIVE) {
    $message = 'Account already activated';
} 
else {    
    $result = activateUser($user);
    if (!$result) {
        $message = 'Something went wrong. Please contact customer support.';
    }
    else {
        $message = 'Account activated successfully';
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Activate your account</title>
        <link type="text/css" rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
            <?php echo $message;?><br><br>
            <a href="login.php">Login</a>
        </div>
    </body>
</html>