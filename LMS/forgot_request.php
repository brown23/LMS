<?php
    // FORGOT_REQUEST.PHP - Handles sending an e-mail message for forgotten password

    require_once "includes/functions.php"; // For generatePassword();

    // Start a session to store user data
    session_start();

    // Generate an email if it needs to be sent
    if(isset($_POST['forgot'])) {
        $to = htmlspecialchars($_POST["for_email"]);

        // Generate a temporary password
        $temp_pass = generatePassword(8);

        // Save the temporary password to the user database
        require "includes/user_db_open.php";
        $query = "SELECT * FROM team8_reg_users WHERE email='" . $to . "';";
        $result = mysql_query($query);

        if(mysql_numrows($result) != 1)
        {
            // Close the user DB connection
            require "includes/user_db_close.php";

            $_SESSION['message'] = 'The E-mail Address ' . $to . ' Is Not Registered. Please Try Again.';
            header("location: index.html");
            exit;
        }
        else
        {
            $username = mysql_result($result, 0, "username");
            $query = "UPDATE team8_reg_users SET password='" . md5($temp_pass) . "' WHERE email='" . $to . "';";
            mysql_query($query);

            // Close the user DB connection
            require "includes/user_db_close.php";
        }

        $from = 'noreply@webhost330.asu.edu';
        $message = "**PASSWORD RESET REQUEST**\n\nYou are receiving this message because you forgot your password for " . $username . " at Library Management System.\n\nTemporary Password: " . $temp_pass . "\nUse the temporary password to login, then change your password under the \"My Account\" tab.\n\n**END MESSAGE**";
        $subject = "Library System Password Reset Request";
        $headers = "From:" . $from;
        mail($to,$subject,$message,$headers);

        $_SESSION['message'] = 'E-Mail Sent To: ' . $to . '. Please Check Your Inbox For Password Reset Instructions.';
    }
    else
    {
        $_SESSION['message'] = 'Error Sending Message. Please Try Again.';
    }

    // Redirect to index.html
    header("location: index.html");
    exit;
?>