<?php
    // BOOKS.PHP - Displays the book search input box to the user
    // Start a session to store user data
    session_start();
?>
<div id="header">
    <div id="main">
        <!-- Main Title -->
        <h1 class="center">Library Catalog Search</h1>

        <?php
        // Database credentials
        require "includes/db_credentials.php";

        mysql_connect($db_host,$db_user,$db_pass);
        $db_selected = @mysql_select_db($db_name);
        if (!$db_selected)
        {
            die ('Unable to connect to database.' . mysql_error());
        }
        else
        {
            echo('<!-- Main Input -->');
            echo('<div class="currentrank" style="text-align:right;"><b style="visibility:hidden;font-size:0;">' . rankToString($_SESSION['rank']) . '</b></div>');
            echo('<input type="text" id="search" autocomplete="off" placeholder="Type search here">');
        }
        ?>
    </div>
</div>

<div id="full-results">
    <!-- Show Results -->
    <table id="results-table">
        <h4 id="results">Showing results for: <b id="search-string">Array</b></h4>
        <table id="results"></table>
    </table>
</div>