<?php
    // LOGIN_FORM.php - Included anywhere on the site where the user needs to login to get access

    // Start a session to store user data
    session_start();

    // Display login form
    echo('<h4>You are not currently logged in. Please use the link below to login.</h4>');
    echo('<a class="popup-with-form" href="#login-form"><h4>Login to Library Management System</h4></a>');
    echo('<h4>Not registered? Use the link below to register for access.</h4>');
    echo('<a class="popup-with-form" href="#register-form"><h4>Register</h4></a>');
    echo('<a class="popup-with-form" href="#forgot-form"><h4>Forgot Username/Password?</h4></a>');
?>