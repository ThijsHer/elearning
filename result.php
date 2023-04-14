<?php
session_start();
$data = json_decode(file_get_contents('php://input'), true);

include_once "includes/dbh-inc.php";

$completed = 1;
$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "elearning";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName, 3306);


foreach ($data as $row ) {
    $sql = ("INSERT INTO `score` (`score`, `user_iduser`, `wordlist_idwordlist`, `completed`) VALUES (?, ?, ?, ?)");
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiii", $row[0], $_SESSION['usersId'], $row[2], $completed);
    $stmt->execute();

    $stmt->close();
}
$conn->close();
echo json_encode('ligma');