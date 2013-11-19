<?php
    // ADMIN_TOOLS.PHP - Display admin login tools

    // Display Add a Book Form
    echo('<a class="popup-with-form" href="#add-book-form"><h4>Add A Book to the Catalog</h4></a>');
?>
<div class="add-book-form">
    <form id="add-book-form" class="white-popup-block mfp-hide" action="add_book.php" method="POST">
        <h2>Add A Book to the Catalog</h2>
        <fieldset>
            <p><label for="adb_title">Title</label>
                <input id="adb_title" name="adb_title" placeholder="book title" required="" type="text"></p>
            <h3>Author Name</h3>
            <p><label for="adb_auth_first">First/M.I.</label>
                <input id="adb_auth_first" name="adb_auth_first" placeholder="first name/middle initial" required="" type="text"></p>
            <p><label for="adb_auth_last">Last</label>
                <input id="adb_auth_last" name="adb_auth_last" placeholder="last name" required="" type="text"></p>
            <p><label for="adb_publisher">Publisher</label>
                <input id="adb_publisher" name="adb_publisher" placeholder="publisher" required="" type="text"></p>
            <p><label for="adb_isbn">ISBN-13</label>
                <input id="adb_isbn" name="adb_isbn" placeholder="ISBN-13 (no dashes)" required="" type="text"></p>
            <p><label for="adb_available">Availablilty</label>
                <input if = "adb_available" name="adb_available" type="checkbox" value="1">Available For Checking Out</p>
            <input name="add" type="submit" value="add" />
        </fieldset>
    </form>
</div>