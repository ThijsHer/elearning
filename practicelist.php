<?php
//echo $_GET['chapter'];
session_start();
include_once "includes/dbh-inc.php";
include_once "header.php";
$chapter = $_GET['chapter'];
$completed = 0;
$query = "SELECT completed FROM score WHERE user_iduser = ? AND wordlist_idwordlist =?;";
$statementering = $conn->prepare($query);
$statementering->bind_param('ii', $_SESSION['usersId'], $chapter);
$statementering->execute();
$data2 = $statementering->get_result();
try {
    while ($row = $data2->fetch_array()) {
        $completed = $row['completed'];
    }
} catch (Exception $e) {
    $e->getMessage();
}
if ($completed == 1) {
    $sql = ("DELETE FROM score WHERE user_iduser = ? AND wordlist_idwordlist =?; ");
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii",  $_SESSION['usersId'], $chapter);
    $stmt->execute();

    $stmt->close();
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Practice List</title>
</head>
<body>

<div id="questionlabel"></div>
<input type="text" name="awnser" id="antwoord">
<!--    <button onclick="getquestion()"> Next </button>-->
<button onclick="checkAnswer()"> Check</button>
<script>

    let counter = 0;
    let results = [];
    let score = 0;

    async function checkAnswer() {

        let currentchapter = <?php echo $chapter; ?>;
        const response = await fetch('api.php?chapter=' + currentchapter);
        const data = await response.json();
        let answer = document.getElementById("antwoord").value;
        if (answer === data[counter]['translatedword']) {
            score++;
            alert('Goed gedaan!');
        } else {
            alert('Helaas, dat is niet correct.');
        }

        getquestion();
        if (counter === Object.keys(data).length) {
            results.push([score, <?php echo $_SESSION['usersId']; ?> , <?php echo $chapter; ?>]);
            //results.push(<?php //echo $_SESSION['usersId']; ?>//);
            //results.push(<?php //echo $chapter; ?>//);

            fetch('result.php', {
                method: 'POST',
                body: JSON.stringify(results)
            }).then(response => response.json())
                .then((data => {

                }));
        }
    }

    getquestion();

    async function getquestion() {
        let currentchapter = <?php echo $chapter; ?>;
        const response = await fetch('api.php?chapter=' + currentchapter);
        const data = await response.json();
        counter++;

        document.getElementById("questionlabel").innerHTML = data[counter]['englishword'];
    }


</script>
</body>
</html>