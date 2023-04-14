<?php

    //session_start();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-Learning</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header.css">
</head>
<body>

<nav>
    <div class="wrapper">
        <a class="logo" href="index.php">E-Learning</a>
        <ul>
            <li><a href="index.php">Home</a></li>
            <?php
                if (isset($_SESSION['usersId'])) {
                    echo "<li> <a href='logout.php'> Log out </a> </li>";

                }
                else {
                    echo "<li> <a href='signup.php'> Sign up </a> </li>";
                    echo "<li> <a href='login.php'> Login </a> </li>";
                }
            ?>

        </ul>

    </div>
</nav>

<div class="wrapper">