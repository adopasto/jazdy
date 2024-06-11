<?php

include_once 'db_connect.php';

/**
 * Generate random string of specified length
 * 
 * @param int $length Desired lenght of the string
 * @return string
 */
function generateRandomString($length = 10) {
    $result = '';

    for ($i = 0; $i < $length; $i++) {
        $type = rand(0, 2);
        
        //chars 0 - 9
        if ($type === 0) {
            $result .= rand(0, 9);
        }
        // a - z
        elseif ($type === 1) {            
            // $result .= chr(rand(ord('a'), ord('z')));
            $ord  = rand(97, 122); // 100
            $char = chr($ord); // d
            $result .= $char;
        }
        // A - Z
        elseif ($type === 2) {
            $result .= chr(rand(ord('A'), ord('Z')));
        }
    }

    return $result;
}

/**
 * Get user by activation key
 * 
 * @param string $key Activation key
 * @return array|null
 */
function getUserByActivationKey($key)
{    
    global $conn;
    $sql = "SELECT * FROM users WHERE activation_key = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $key);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    return $user;
}

/**
 * Activate user
 * 
 * @param array $user User details
 * @return bool
 */
function activateUser($user)
{
    global $conn;
    $sql = "UPDATE users SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $status = STATUS_ACTIVE;
    $stmt->bind_param('ii', $status, $user['id']);
    return $stmt->execute();    
}