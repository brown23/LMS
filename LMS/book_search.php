<?php
// BOOK_SEARCH.PHP - Called to return results for a book search

// Currently needs to be completely rewritten

// Start a session to store user data
session_start();

/************************************************
	The Search PHP File
************************************************/

/************************************************
	MySQL Connect
************************************************/

// Database credentials
require "includes/db_credentials.php";

//	Connection
global $db_connect;

$db_connect = new mysqli();
$db_connect->connect($db_host, $db_user, $db_pass, $db_name);
$db_connect->set_charset("utf8");

//	Check Connection
if ($db_connect->connect_errno) {
    printf("Connect failed: %s\n", $db_connect->connect_error);
    exit();
}

/************************************************
	Search Functionality
************************************************/

// Define user levels
define("ADMIN", 1);
define("USER", 0);
define("NO_ACCESS", -1);

// Get current user
$rank = htmlspecialchars($_POST['rank']);

// Check username and set access level
if(!strcmp($rank, "Public"))
    $access = USER;
else if (!strcmp($rank, "Admin"))
    $access = ADMIN;
else
    $access = NO_ACCESS;

// Define Output HTML Formatting
$html = '<tr class="result">';
$html .= '<td><h4>titleString</h4></td>';
$html .= '<td><h4>authorString</h4></td>';
$html .= '<td><h4>publicationString</h4></td>';
$html .= '<td><h4>isbnString</h4></td>';
$html .= '<td><h4>availableString</h4></td>';
if ($access == ADMIN)
    $html .= '<td>delString</td>';
$html .= '</tr>';

$token_count = 0;

// Get Search
$search_string = preg_replace("/[^A-Za-z0-9:]/", " ", $_POST['query']);
$search_string = $db_connect->real_escape_string($search_string);
str_replace(':', '', $search_string);

// Use Space as Tokenizing Character
$temp = $search_string;
$token = strtok($temp, " ");
$token_array = array();

// Tokenize Search String
while ($token !== false && $token_count < 7) {
        $token_array[$token_count] = $token;
        $token = strtok(" ");
        $token_count++;
}

// Fixes query bug where first search token is an invalid token
if(sizeof($token_array) == 1)
    $token_count = 1;

// Check Length More Than One Character
if (strlen($search_string) >= 1 && $search_string !== ' ') {
	// Build Query
	$key = 0;
	$query = 'SELECT * FROM team8_book_info WHERE ';
	while ($key < $token_count) {
		$query .= '(UPPER(title) LIKE "%'.strtoupper($token_array[$key]).'%" OR ';
		$query .= 'UPPER(author) LIKE "%'.strtoupper($token_array[$key]).'%" OR ';
		$query .= 'UPPER(publication) LIKE "%'.strtoupper($token_array[$key]).'%" OR ';
		$query .= 'isbn LIKE "%'.$token_array[$key].'%")';
		$key++;
		if ($key != $token_count)
			$query .= ' AND ';
	}

	// Do Search
	$result = $db_connect->query($query);
	while($results = $result->fetch_array()) {
		$result_array[] = $results;
	}

	// Check If We Have Results
	if (isset($result_array)) {
        // Display table header based on level of access
        echo('<tr class="result"><th><h3>Title</h3></th><th><h3>Author</h3></th><th><h3>Publication</h3></th><th><h3>ISBN</h3></th><th><h3>Available</h3></th>');
        if ($access == ADMIN)
            echo('<th><h3>Book ID</h3></th>');
        echo('</tr>');
		foreach ($result_array as $result) {

			// Format Output Strings And Highlight Matches
            $key = 0;

            while($key < $token_count)
            {
                $display_title = preg_replace("/".$token_array[$key]."/i", "<b class='highlight'>".$token_array[$key]."</b>", $result['title']);
                $display_author = preg_replace("/".$token_array[$key]."/i", "<b class='highlight'>".$token_array[$key]."</b>", $result['author']);
                $display_publication = preg_replace("/".$token_array[$key]."/i", "<b class='highlight'>".$token_array[$key]."</b>", $result['publication']);
                $display_isbn = preg_replace("/".$token_array[$key]."/i", "<b class='highlight'>".$token_array[$key]."</b>", $result['isbn']);
                $display_available = preg_replace("/".$token_array[$key]."/i", "<b class='highlight'>".$token_array[$key]."</b>", $result['availability']);
                if ($access == ADMIN)
                {
                    // Get book ID
                    $display_edit = $result['id'];
                }
                $key++;
            }

			// Insert Title
			$output = str_replace('titleString', $display_title, $html);

			// Insert Author
            $output = str_replace('authorString', $display_author, $output);

            // Insert Publication
            $output = str_replace('publicationString', $display_publication, $output);

            // Insert ISBN
            $output = str_replace('isbnString', $display_isbn, $output);

            // Insert Availability
            $output = str_replace('availableString', $display_available, $output);

            // Insert Admin Delete Book Link
            if ($access == ADMIN)
                $output = str_replace('delString', $display_edit, $output);

			// Output
			echo($output);
		}
	}
    else {

		// Format No Results Output
		$output = str_replace('titleString', '<b>No Results Found.</b>', $html);
		$output = str_replace('authorString', 'Try Again.', $output);
        $output = str_replace('publicationString', '', $output);
        $output = str_replace('isbnString', '', $output);
        $output = str_replace('availableString', '', $output);
        $output = str_replace('delString', '', $output);

		// Output
		echo($output);
	}
}

// Close connection
$db_connect->close();
?>