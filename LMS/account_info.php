<?php
    // ACCOUNT_INFO.PHP - Display all user account information

    // Start a session to store user data
    session_start();

    echo('<h4>You Are Logged In As: <b>' . $_SESSION['username'] . '</b></h4>');
    echo('<h4>Access Level: <b>' . rankToString($_SESSION['rank']) . '</b></h4>');

    // Display current balance

    // Display current books checked out

    // Display book on hold

    // Display the change password form
    echo('<a class="popup-with-form" href="#pchange-form"><h4>Change Password</h4></a>');

    // If user is admin, include admin tools
    if($_SESSION['rank'] == 1)
        require "admin_tools.php";

    // Logout form
    echo('<form id="logout-form" action="logout.php" method="post">');
    echo('<input name="logout" type="submit" value="Logout" />');
    echo('</form>');
?>