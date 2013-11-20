<?php
    // ADMIN_TOOLS.PHP - Display admin login tools

    // Display Library Catalog Management Tools
    echo('<div id="admin-tools">');
    echo('<h3 class="center">Library Catalog Management Tools</h3>');
    echo('<ul>');
    echo('<li><a class="popup-with-form" href="#add-book-form"><h4>Add A Book to the Catalog</h4></a></li>');
    echo('<li><a class="popup-with-form" href="#pdf-form"><h4>Upload a Book Cover to the Catalog</h4></a></li>');
    echo('<li><a class="popup-with-form" href="#del-book-form"><h4>Delete a Book By ID</h4></a></li>');
    echo('</ul>');
    echo('</div>');
?>

<!-- FORM FOR ADDING A BOOK-->
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
                <input id="adb_available" name="adb_available" type="checkbox" value="1">Available For Checking Out</p>
            <input name="add" type="submit" value="add" />
        </fieldset>
    </form>
</div>

<!-- FORM FOR DELETING A BOOK-->
<div class="del-book-form">
    <form id="del-book-form" class="white-popup-block mfp-hide" action="del_book.php" method="POST">
        <h2>Delete Book From Catalog</h2>
        <h4>Enter the book ID to permanently remove a book from the catalog. This cannot be undone.</h4>
        <h4>(Search the Library Catalog to find the Book ID if it is not known)</h4><br>
        <fieldset>
            <p><label for="del_id">Book ID</label>
                <input id="del_id" name="del_id" placeholder="ID" required="" type="text"></p>
            <input type="submit" id="delete" name="delete" value="delete" />
        </fieldset>
    </form>
</div>

<!-- FORM FOR UPLOADING A PDF/IMAGE -->
<?php
require "PDF_form.html";
?>