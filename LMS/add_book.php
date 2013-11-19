<?php
// ADD_BOOK.PHP - Handles adding a book to the database

// Start a session to store user data
session_start();

// Get submitted form data
$title = htmlspecialchars($_POST["adb_title"]);
$auth_first = htmlspecialchars($_POST["adb_auth_first"]);
$auth_last = htmlspecialchars($_POST["adb_auth_last"]);
$publisher = htmlspecialchars($_POST["adb_publisher"]);
$isbn = htmlspecialchars($_POST["adb_isbn"]);
$available = htmlspecialchars($_POST["adb_available"]);

// Open DB connection ($link)
require "includes/user_db_open.php";

// Strip any dashes out of ISBN
str_replace('-', '', $isbn);

// Structure author name (LAST, FIRST M.I.)
$author = $auth_last . ", " . $auth_first;

// Set availability
if($available != 1)
    $available = 0;

// Display session message
$_SESSION['message'] = $title . ' (' . $isbn . ') Added to the Library Catalog.';

// Add book to database (team8_book_info)
mysql_query("INSERT INTO team8_book_info(title, author, publication, isbn, availability) VALUES ('$title','$author','$publisher','$isbn','$available')") or die("".mysql_error());

// Close DB connection
require "includes/user_db_close.php";

// Redirect browser
header("location: index.html");
exit;
?>