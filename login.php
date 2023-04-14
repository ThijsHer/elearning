<?php
session_start();
include_once 'header.php';

?>

<link href="css/form.css" rel="stylesheet">

<body>
<section class="signup-form">
    <h2>Login</h2>
    <div class="signup-form">
        <form action="" method="post">
            <input type="text" name="uid" placeholder="Username/Email...">
            <input type="password" name="pwd" placeholder="Password...">
            <button type="submit" name="submit">Login</button>
        </form>
    </div>
</section>

<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] == 'emptyinput') {
        echo "<p class='error'>Fill in all fields</p>";
    }
    else if ($_GET['error'] == "invaliduid") {
        echo "<p class='error'>Choose a propper username </p>";
    }
    else if ($_GET['error'] == "invalidemail") {
        echo "<p class='error'>Choose a propper email </p>";
    }
    else if ($_GET['error'] == "passworddontmatch") {
        echo "<p class='error'>Passwords don't match </p>";
    }
    else if ($_GET['error'] == "stmtfailed") {
        echo "<p class='error'>something went wrong, try again! </p>";
    }
    else if ($_GET['error'] == "usernametaken") {
        echo "<p class='error'>username already taken </p>";
    }
    else if ($_GET['error'] == "none") {
        echo "<p class='signedup'>you have signed up </p>";
    }
}
?>

<?php


include "includes/dbh-inc.php";

if (isset($_POST["submit"])) {
    $name = htmlspecialchars($_POST['uid']);
    $pwd = htmlspecialchars($_POST['pwd']);

    $sql = "SELECT usersId, usersPwd, roll FROM users WHERE usersUid = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $name);
    $stmt->execute();
    $result = $stmt->get_result();

    try {
        while ($row = $result->fetch_array()){
            $passwordreturn = password_verify($pwd, $row["usersPwd"]);

            if($passwordreturn) {
                $_SESSION['uid'] = $name;
                $_SESSION['roll'] = $row['roll'];
                $_SESSION['usersId'] = $row['usersId'];
                $_SESSION['sessionid'] = session_id();
                header("Refresh:0.1; url=index.php", true, 303);
            }
        }
    } catch (Exception $e) {
        $e->getMessage();
    }
}

?>

