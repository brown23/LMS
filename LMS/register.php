<?php
    // REGISTER.PHP - Handles registration form processing

    // Start a session to store user data
    session_start();
    require_once "includes/functions.php";

    if(isset($_POST['register'])) {
        if(isset($_POST['reg_username']) && isset($_POST['reg_password'])) {
            $passlength = strlen($_POST['reg_password']);
            $username = htmlspecialchars($_POST['reg_username']);
            $password = md5(htmlspecialchars($_POST['reg_password']));
            $repass = md5(htmlspecialchars($_POST['reg_repassword']));
            $email = htmlspecialchars($_POST['reg_email']);

            // Open DB connection ($link)
            require "includes/user_db_open.php";

            // Generate token for user
            $token = generateToken($username);
            $token_valid = getTokenTimeout();

            // Set rank to be public (default)
            $rank = 0;

            // Check for duplicate username
            $query = "SELECT * FROM team8_reg_users WHERE username='" . $username . "';";
            $result = mysql_query($query);
            if(mysql_numrows($result) != 0)
            {
                $_SESSION['message'] = 'Username ' . $username . ' Is Already Registered. Please Choose Another Username.';
                header('location: index.html');
                exit;
            }

            // Check for duplicate email
            $query = "SELECT * FROM team8_reg_users WHERE email='" . $email . "';";
            $result = mysql_query($query);
            if(mysql_numrows($result) != 0)
            {
                $_SESSION['message'] = 'The E-mail Address ' . $email . ' Is Already Registered.';
                header('location: index.html');
                exit;
            }

            // Insert values into user DB
            mysql_query("INSERT INTO team8_reg_users(username, password, email, rank, token, token_validity) VALUES ('$username','$password','$email', '$rank', '$token', '$token_valid')") or die("".mysql_error());

            // Close DB connection
            require "includes/user_db_close.php";

            $_SESSION['message'] = 'Registration Successful.';

            // Redirect to homepage
            header('location: index.html');
            exit;
        }
    }
    else {
        $_SESSION['message'] = 'Error Registering. Please Try Again.';
        header('location: index.html');
        exit;
    }
?>