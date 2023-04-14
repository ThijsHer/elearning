<?php
session_start();

include_once 'header.php';

if (!(isset($_SESSION['sessionid']) || $_SESSION['sessionid'] == session_id())) {
    header("location: login.php");
}

?>

<link rel="stylesheet" href="css/style.css">
<body>
    <div>
        <button><a href="makelist.php">Make a list</a></button>
        <button><a href="practice.php"> Practice a list </a></button>
    </div>
</body>


