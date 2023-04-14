<?php
session_start();
include_once 'header.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="includes/makelist-inc.php" method="POST">
    <input type="text" name="dutch1" placeholder="Nederlandse woord" required>
    <input type="text" name="english1" placeholder="Engelse woord" required> <br>
    <div id="inputdiv">

    </div>
    <input type="text" name="listname" placeholder="lijst naam" required>
    <input type="submit" name="submit" value="klaar">
</form>
<button id="newRow"> Nieuwe rij</button>
<button id="clear"> Clear</button>
</body>
<script>

    $counter = 1;

    document.getElementById("newRow").onclick = function () {
        generateRow()
    };

    function generateRow() {

        $counter += 1;
        document.getElementById("inputdiv").innerHTML += '<input type="text" name="dutch' + $counter + '" placeholder="Nederlandse woord" required> <input type="text" name="english' + $counter + '" placeholder="Engelse woord" required> <br>';

    }
    document.getElementById("clear").onclick = function () {
        clearRow()
    };

    function clearRow() {
        document.getElementById("inputdiv").innerHTML = ' ';
    }
</script>
</html>
<?php


