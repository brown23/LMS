<?php
    // PCHANGE.PHP - Handles updating the current users password

    // Start a session to store user data
    session_start();

    // Check if logged in and form was sent
    if(isset($_POST['update']) && $_SESSION["status"]) {
        $new_pass = htmlspecialchars($_POST["pch_password"]);
        $username = htmlspecialchars($_SESSION["username"]);

        // Save the new password to the user database
        require "includes/user_db_open.php";
        $query = "SELECT * FROM team8_reg_users WHERE username='" . $username . "';";
        $result = mysql_query($query);

        if(mysql_numrows($result) != 1)
        {
            // Close the user DB connection
            require "includes/user_db_close.php";

            $_SESSION['message'] = 'The Username: ' . $username . ' Is Not Registered. Please Try Again.';
            header("location: index.html");
            exit;
        }
        else
        {
            $query = "UPDATE team8_reg_users SET password='" . md5($new_pass) . "' WHERE username='" . $username . "';";
            mysql_query($query);

            // Close the user DB connection
            require "includes/user_db_close.php";
        }

        $_SESSION['message'] = 'New Password Set For ' . $username . '.';
    }
    else
    {
        $_SESSION['message'] = 'Error. Please Log Out, Then Try Again.';
    }

    // Redirect to index.html
    header("location: index.html");
    exit;
?>