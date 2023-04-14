<?php
session_start();
if (isset($_POST["submit"])) {
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];

    require_once 'dbh-inc.php';
    require_once 'functions-inc.php';



    if (emptyInputLogin($username, $pwd) !== false)
    {
        header("Location: ../login.php?error=emptyinput");
        exit();
    }

    function LoginUser($conn, $username, $pwd) {

        $uidExists = uidExists($conn, $username);

        if($uidExists === false) {
            header("Location: ../login.php?error=wronginlog");
            exit();
        }
        $pwdHashed = $uidExists['usersPwd'];
        $checkPwd = password_verify($pwd, $pwdHashed);

        if ($checkPwd === false) {
            header("Location: ../login.php?error=wronglogin");
            exit();
        }
        else if ($checkPwd === true) {
            session_start();
            $_SESSION['userid'] = $uidExists["usersId"];
            //$_SESSION['userid'] = $uidExists["usersId"];
            header("Location: ../index.php");
            exit();
        }
    }

    require_once "dbh-inc.php";
    LoginUser($conn, $username, $pwd);
}
else {
    header("Location: ../login.php");
    exit();
}