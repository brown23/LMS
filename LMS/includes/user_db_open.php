<?php
    // USER_DB_OPEN - Opens a connection to the user database

    $db_host = 'localhost';
    $db_name = 'library_management_system';
    $db_user = 'root';
    $db_pass = 'test123';
    $link = mysql_connect($db_host,$db_user,$db_pass);
    @$link or die ("Could not connect to MySql");
    @mysql_select_db($db_name) or die ("Could not connect to Dbase");
    
    echo "Connected to Dbase!";
?>