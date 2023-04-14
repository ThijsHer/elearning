<?php
session_start();
include_once 'header.php';
require_once "includes/dbh-inc.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Document</title>
    <link href="css/practice.css" type="text/css" rel="stylesheet">
</head>
<body>

<?php
$completed = 0;
$score = 0;
$query = "SELECT idwordlist, listname, user_iduser FROM wordlist";
$data = $conn->query($query);


foreach ($data as $data) {
    $completed = 0;
    $listamount = 0;
    $score = 0;

    $idwordlist = $data['idwordlist'];
    $query3 = "SElECT completed, score FROM score WHERE user_iduser= ? AND  wordlist_idwordlist = ?";
    $statmetering2 = $conn->prepare($query3);
    $statmetering2->bind_param('ii', $_SESSION['usersId'], $idwordlist);
    $statmetering2->execute();
    $data3 = $statmetering2->get_result();
    try {
        while ($row2 = $data3->fetch_array()) {
            if (isset($row2['completed'])) {
                $completed = $row2['completed'];
                $score = $row2['score'];
            }
            else {
                $completed = 0;
            }
        }
    } catch (Exception $e) {
        $e->getMessage();
    }

    $query3 = "SElECT idwords FROM words WHERE  wordlist_idwordlist = ?";
    $statmetering2 = $conn->prepare($query3);
    $statmetering2->bind_param('i', $idwordlist);
    $statmetering2->execute();
    $data3 = $statmetering2->get_result();
    try {
        while ($row2 = $data3->fetch_array()) {
            if (isset($row2['idwords'])) {
                $listamount += 1;
            }
            else {
            }
        }
    } catch (Exception $e) {
        $e->getMessage();
    }


    $query2 = "SELECT usersUid FROM users WHERE usersId = ?";
    $statementering = $conn->prepare($query2);
    $statementering->bind_param('s', $data['user_iduser']);
    $statementering->execute();
    $data2 = $statementering->get_result();


    foreach ($data2 as $data2) {
        ?>
        <div class="chapters">
            <a class="chapter" href="practicelist.php?chapter=<?php echo $data['idwordlist']; ?>">Chapter: <?php echo $data['listname']; ?>
              <br>  Maker: <?php echo $data2['usersUid']; ?> <br> <?php if ($completed == 1) {
                    echo "Completed<br>" . $score . "/" . $listamount;
                } ?> <?php  ?> </a> <br> <br>
        </div>
        <?php
    }
}
?>

</body>
</html>
