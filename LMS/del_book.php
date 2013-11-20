<?php
// DEL_BOOK.PHP - Handles deleting a book from the database

// Start a session to store user data
session_start();

if(isset($_POST['delete']))
{
    // Get submitted form data
    $id = htmlspecialchars($_POST["del_id"]);

    // Open DB connection ($link)
    require "includes/user_db_open.php";

    // Check if book is in database
    $query = "SELECT * FROM team8_book_info WHERE id='" . $id . "';";
    $result = mysql_query($query);
    if(mysql_numrows($result) != 1) {
        // If the book was not found
        $_SESSION['message'] = 'Book With ID: ' . $id . ' Could Not Be Found.';
    }
    else
    {
        // Delete book from database
        mysql_query("DELETE FROM team8_book_info WHERE id='" . $id . "';") or die("".mysql_error());

        // Display session message
        $_SESSION['message'] = 'Book With ID ' . $id . ' Deleted From The Library Catalog.';
    }

    // Close DB connection
    require "includes/user_db_close.php";
}
else
{
    $_SESSION['message'] = "Error Processing Request. Try Again.";
}

// Redirect browser
header("location: index.html");
exit;
?>