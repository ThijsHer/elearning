<?php
session_start();
include 'dbh-inc.php';
$counter = 0;
//echo $_SESSION['usersId'];
if (isset($_POST['submit'])) {
    $sql = "INSERT INTO wordlist (listname, user_iduser) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $_POST['listname'], $_SESSION['usersId']);
    $result = $stmt->execute();

    $lastid = mysqli_insert_id($conn);
    looplist($counter, $conn, $lastid);
}



function looplist($inloopcounter, $connection, $chapter)
{
    $inloopcounter = $inloopcounter + 1;
    $counter = $inloopcounter;
    $question = $_POST['english' . $counter];
    $answer = $_POST['dutch' . $counter];

    $sql2 = "INSERT INTO words (wordlist_idwordlist, questionNumber, englishword, translatedword) VALUES (?, ?, ?, ?)";
    $stmt2 = $connection->prepare($sql2);
    $stmt2->bind_param("ssss", $chapter, $counter, $question , $answer);
    $stmt2->execute();
    echo $_POST['english' . $counter] . ' <br>';
    echo $_POST['dutch' . $counter] . ' <br>';
    if (isset($_POST['english' . ($counter + 1)])) {
        looplist($counter, $connection, $chapter);
    }
    else {
        header("Location: ../index.php");
    }
}

?>