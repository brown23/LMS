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

// Credentials
    $db_host = 'localhost';
    $db_name = 'library_management_system';
    $db_user = 'root';
    $db_pass = 'test123';

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
$html .= '<td><h4>modelString</h4></td>';
$html .= '<td><h4>full_nameString</h4></td>';
$html .= '<td><h4>ratioString</h4></td>';
$html .= '<td><h4>seriesString</h4></td>';
$html .= '<td><h4>diagString</h4></td>';
$html .= '<td><h4>matString</h4></td>';
if ($access == ADMIN)
    $html .= '<td><h4>msrpString</h4></td>';
$html .= '</tr>';

$token_count = 0;

// Get Search
$search_string = preg_replace("/[^A-Za-z0-9:]/", " ", $_POST['query']);
$search_string = $sev_db_connect->real_escape_string($search_string);
str_replace(':', '', $search_string);

// Use Space as Tokenizing Character
$temp = $search_string;
$token = strtok($temp, " ");
$token_array = array();

// Tokenize Search String
while ($token !== false && $token_count < 7) {
    if(!discardToken($token))
    {
        $token_array[$token_count] = $token;
        $token = strtok(" ");
        $token_count++;
    }
    else
    {
        $token_array[$token_count] = "INVALID TOKEN";
        $token = strtok(" ");
    }
}

// Fixes query bug where first search token is an invalid token
if(sizeof($token_array) == 1)
    $token_count = 1;

// Check Length More Than One Character
if (strlen($search_string) >= 1 && $search_string !== ' ') {
	// Build Query
	$key = 0;
	$query = 'SELECT * FROM prices WHERE ';
	while ($key < $token_count) {
		$query .= '(UPPER(model) LIKE "%'.strtoupper($token_array[$key]).'%" OR ';
		$query .= 'UPPER(full_name) LIKE "%'.strtoupper($token_array[$key]).'%" OR ';
		$query .= 'UPPER(series) LIKE "%'.strtoupper($token_array[$key]).'%" OR ';
		$query .= 'ratio LIKE "%'.$token_array[$key].'%" OR ';
		$query .= 'diagonal LIKE "%'.$token_array[$key].'%" OR ';
		$query .= 'UPPER(material) LIKE "%'.strtoupper($token_array[$key]).'%")';
		$key++;
		if ($key != $token_count)
			$query .= ' AND ';
	}

	// Do Search
	$result = $sev_db_connect->query($query);
	while($results = $result->fetch_array()) {
		$result_array[] = $results;
	}

	// Check If We Have Results
	if (isset($result_array)) {
        // Display table header based on level of access
        echo('<tr class="result"><td><h3>Model</h3></td><td><h3>Description</h3></td><td><h3>Ratio</h3></td><td><h3>Series</h3></td><td><h3>Diagonal</h3></td><td><h3>Material</h3></td>');
        if ($access == ADMIN)
            echo('<td><h3>MSRP</h3></td>');
        echo('</tr>');
		foreach ($result_array as $result) {

			// Format Output Strings And Highlight Matches
            $key = 0;

            while($key < $token_count)
            {
                $display_model = preg_replace("/".$token_array[$key]."/i", "<b class='highlight'>".$token_array[$key]."</b>", $result['model']);
                $display_full_name = preg_replace("/".$token_array[$key]."/i", "<b class='highlight'>".$token_array[$key]."</b>", $result['full_name']);
                $display_ratio = preg_replace("/".$token_array[$key]."/i", "<b class='highlight'>".$token_array[$key]."</b>", $result['ratio']);
                $display_series = preg_replace("/".$token_array[$key]."/i", "<b class='highlight'>".$token_array[$key]."</b>", $result['series']);
                $display_diag = preg_replace("/".$token_array[$key]."/i", "<b class='highlight'>".$token_array[$key]."</b>", $result['diagonal']);
                $display_mat = preg_replace("/".$token_array[$key]."/i", "<b class='highlight'>".$token_array[$key]."</b>", $result['material']);
                if ($access == ADMIN)
                    $display_msrp = '$' . preg_replace("/".$token_array[$key]."/i", "<b class='highlight'>".$token_array[$key]."</b>", $result['msrp']);
                $key++;
            }

			// Insert Model
			$output = str_replace('modelString', $display_model, $html);

			// Insert Full Name
            $output = str_replace('full_nameString', $display_full_name, $output);

            // Insert Ratio
            $output = str_replace('ratioString', $display_ratio, $output);

            // Insert Series
            $output = str_replace('seriesString', $display_series, $output);

            // Insert Diagonal
            $output = str_replace('diagString', $display_diag, $output);

            // Insert Material
            $output = str_replace('matString', $display_mat, $output);

            // Insert MSRP
            if ($access == ADMIN)
                $output = str_replace('msrpString', $display_msrp, $output);

			// Output
			echo($output);
		}
	}
    else {

		// Format No Results Output
		$output = str_replace('urlString', 'javascript:void(0);', $html);
		$output = str_replace('modelString', '<b>No Results Found.</b>', $output);
		$output = str_replace('full_nameString', 'Try Again.', $output);
        $output = str_replace('ratioString', '', $output);
        $output = str_replace('seriesString', '', $output);
        $output = str_replace('diagString', '', $output);
        $output = str_replace('matString', '', $output);
		$output = str_replace('msrpString', '', $output);
        $output = str_replace('distString', '', $output);
        $output = str_replace('prefString', '', $output);
        $output = str_replace('dealString', '', $output);

		// Output
		echo($output);
	}
}

// Close connection
$sev_db_connect->close();

// If $tok not part of a valid search term, discard it
function discardToken($tok)
{
    $validWords = array("3DMP","ACOUSTICALLY","BROADWAY","BWAT","BWMP","CF","CGMP","CINEMA","CROSSFIRE", "CURVED","CWMP","DELUXE","DF","DOWN","ELECTRIC","FF","FIXED","FRAME","GE","GM","GP","GREY","GT","GVMP","GX","HVMP","IF","IMPRESSION","LEGACY","LF","MANUAL","MATTE","MICRO","MW", "PERF","PORTABLE","PULL","QUICK","SAT4K","SE","SEVISION","SPIRIT","ST","TAB","TENSIONED","TRAPDOOR","UP","VISION","WE","WHISPER","WHITE","WT", "XF");
    $pattern = "*" . strtoupper($tok) . "*";
    $matches = 0;

    for($i = 0; $i < sizeof($validWords); $i++)
    {
        $matches = $matches + preg_match($pattern, $validWords[$i]);
    }
    if ($matches > 0 || is_numeric($tok)) // If at least one match is found or if token is a number
        return false; // Do not discard token
    else
        return true;  // Discard token
}
?>