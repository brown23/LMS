<?php
    // LOGOUT.PHP - Handles user logout

    // Start a session to store user data
    session_start();

    // Destroy session
    session_destroy();

    // Reset Session
    session_start();
    $_SESSION['username'] = '';
    $_SESSION['password'] = '';
    $_SESSION['status'] == 0;
    $_SESSION['rank'] = -1;
    $_SESSION['message'] = 'Logout Successful.';

    // Redirect browser
    header("location: index.html");
    exit;
?>