<?php
    // LOGIN.PHP - Handles login form processing

    // Start a session to store user data
    session_start();
    require_once "includes/functions.php"; // For getClientIP();

    $ip = getClientIP();
    $username = htmlspecialchars($_POST["log_username"]);
    $password = md5(htmlspecialchars($_POST["log_password"]));

    // Open DB connection ($link)
    require "includes/user_db_open.php";

    // Check username/password against database
    $query = "SELECT * FROM team8_reg_users WHERE username='" . $username . "' AND password='" . $password . "';";
    $result = mysql_query($query);
    if(mysql_numrows($result) != 1) {
        // If the username or password wrong
        $_SESSION['username'] = '';
        $_SESSION['password'] = '';
        $_SESSION['status'] == 0;
        $_SESSION['rank'] = -1;
        $_SESSION['message'] = 'Incorrect Username or Password.';
    }
    else {
        // Fetch rank
        $rank = mysql_result($result, 0, "rank");

        // Set last_login
        $query = "UPDATE team8_reg_users SET last_login='" . date('Y-m-d H:i:s') . "' WHERE username='" . $username . "';";
        mysql_query($query);

        // Set token
        $query = "UPDATE team8_reg_users SET token='" . generateToken($username) . "' WHERE username='" . $username . "';";
        mysql_query($query);

        // Set token_validity
        $query = "UPDATE team8_reg_users SET token_validity='" . getTokenTimeout() . "' WHERE username='" . $username . "';";
        mysql_query($query);

        // Set session variables
        $_SESSION['username'] = $_POST["log_username"];
        $_SESSION['rank'] = $rank;
        $_SESSION['status'] = 1;
        $_SESSION['message'] = 'Login Successful.';
    }

    $username = htmlspecialchars($_POST["log_username"]);
    $login_success = $_SESSION['status'];

    // Create team8_login_attempt entry
    mysql_query("INSERT INTO team8_reg_login_attempt(ip, username, login_success) VALUES ('$ip','$username', '$login_success')") or die("".mysql_error());

    // Close DB connection
    require "includes/user_db_close.php";

    // Redirect browser
    header("location: index.html");
    exit;
?>