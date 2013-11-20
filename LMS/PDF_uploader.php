<?php
// PDF_UPLOADER.PHP - Handles file upload to the web server

// Start a session to store user data
session_start();

// Set local variables
// Set restriction on file uploading to 5 MB
$MAX_FILE_SIZE = 5 * 1024 * 1024;
$UPLOAD_PATH = "covers/";
$ALLOWED_EXTS = array("pdf", "gif", "jpeg", "jpg", "png");

// Get Book ID
$id = htmlspecialchars($_POST["pdf-id"]);

// Break up uploaded file into name and extension
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

// Full file name (Format = [$id]-cover.[extenstion])
$FILE_NAME = $id . "-cover." . $extension;

// Full file path on web server (Format = $UPLOAD_PATH/$FILE_NAME)
$FILE_PATH = $UPLOAD_PATH . $FILE_NAME;

// Check for file MIME type validity
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "application/pdf")
|| ($_FILES["file"]["type"] == "application/x-pdf")
&& ($_FILES["file"]["size"] < $MAX_FILE_SIZE)
&& in_array($extension, $ALLOWED_EXTS)))
{
    // On file upload error
    if ($_FILES["file"]["error"] > 0)
    {
        // Display any file uploading errors
        $_SESSION['message'] = "Return Code: " . $_FILES["file"]["error"];

        // Redirect browser
        header("location: index.html");
        exit;
    }
    else
    {
        // If the file already exists display overwrite message
        if (file_exists($FILE_PATH))
            $_SESSION['message'] = "Book Cover For Book ID: " . $id . " Already Exists And Will Be Overwritten.";
        else
            $_SESSION['message'] = "";

        // Move file from temp directory to permanent directory and rename
        move_uploaded_file($_FILES["file"]["tmp_name"], $FILE_PATH);
        $_SESSION['message'] .= $FILE_NAME . " Stored In: " . $FILE_PATH;
        $_SESSION['message'] .=  " Size: " . ($_FILES["file"]["size"] / 1024) . " KB.";

        // Redirect browser
        header("location: index.html");
        exit;
    }
}
else
{
    // Display error message
    $_SESSION['message'] = 'Invalid File.';

    // Redirect browser
    header("location: index.html");
    exit;
}
?>