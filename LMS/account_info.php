<?php
    // ACCOUNT_INFO.PHP - Display all user account information

    // Start a session to store user data
    session_start();

    $username = $_SESSION['username'];

    echo('<h4>You Are Logged In As: <b>' . $username . '</b></h4>');
    echo('<h4>Access Level: <b>' . rankToString($_SESSION['rank']) . '</b></h4>');

    // Logout form
    echo('<form id="logout-form" action="logout.php" method="post">');
    echo('<input name="logout" type="submit" value="Logout" />');
    echo('</form>');

    // Open database
    require "includes/user_db_open.php";

    // Display current balance
    $query = "SELECT * FROM team8_reg_users WHERE username='" . $username . "';";
    $result = mysql_query($query);

    if(mysql_numrows($result) != 1)
    {
        echo('<h4>Could not get account info for ' . $username . '</h4>');
    }
    else
    {
        $balance = 'Account Balance: $' . $result['account_balance'];
    }

    // Display current books checked out

    // Display books on hold

    // Close database
    require "includes/user_db_close.php";

    // Display the change password form
    echo('<a class="popup-with-form" href="#pchange-form"><h4>Change Password</h4></a>');

    // If user is admin, include admin tools
    if($_SESSION['rank'] == 1)
        require "admin_tools.php";


?>