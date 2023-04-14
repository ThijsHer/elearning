<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
session_start();
include "includes/dbh-inc.php";

$mycount = 0;
$query = "SELECT * FROM `words` WHERE `wordlist_idwordlist` = ?";
$statementering = $conn->prepare($query);
$statementering->bind_param('s', $_GET['chapter']);
$statementering->execute();
$data = $statementering->get_result();

while ($row = $data->fetch_array()) {
    $mycount = $mycount + 1;
$questiondata[$mycount] = $row;
}

echo json_encode($questiondata);


//echo "<label> " . $row['englishword'] . " </label>";
//echo '<input type="text" name="question">';
?>


