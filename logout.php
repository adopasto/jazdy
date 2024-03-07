<?php
session_start();
// unset($_SESSION['id']);
// unset($_SESSION['username']);

foreach ($_SESSION as $key => $val) {
    unset($_SESSION[$key]);
}

header('Location: login.php');
exit;
?>