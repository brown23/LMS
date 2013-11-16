<?php
// FUNCTIONS.php - Includes functions for doing important things
function generatePassword($length = 8) {
    // Given a password length, returns a random password of that length
    $password = "";
    // Define possible characters
    $possible = "0123456789abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $i = 0;
    // Add random characters to $password until $length is reached
    while ($i < $length) {
        // Pick a random character from the possible ones
        $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
        // No duplicate characters allowed
        if (!strstr($password, $char)) {
            $password .= $char;
            $i++;
        }
    }
    return $password;
}

function generateToken($user) {
	// Generate a token for the logged in user
	$token = sha1($user.time().rand(0, 1000000));
	return $token;
}

function getClientIP() {
    // Return the IP address of the logged in user
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';

    return $ipaddress;
}

function getTokenTimeout() {
    // Generate token timeout value
    $timeout = date('Y-m-d H:i:s', strtotime("+10 min"));
    return $timeout;
}

function rankToString($rank) {
    // Return a string interpretation of users rank
    switch($rank)
    {
        case -1:
            $str_rank = "No Access";
            break;
        case 0:
            $str_rank = "Public";
            break;
        case 1:
            $str_rank = "Admin";
            break;
        default:
            $str_rank = "Invalid Rank";
    }
    return $str_rank;
}

?>