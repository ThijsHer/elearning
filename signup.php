<?php
include_once 'header.php';
?>

<link href="css/form.css" rel="stylesheet">

<body>
<section class="signup-form">
    <h2>Sign Up</h2>
    <div class="signup-form">
        <form action="includes/signup-inc.php" method="post">
            <input type="text" name="name" placeholder="Full name...">
            <input type="text" name="email" placeholder="Email...">
            <input type="text" name="uid" placeholder="Username...">
            <input type="password" name="pwd" placeholder="Password...">
            <input type="password" name="pwdrepeat" placeholder="Repeat password...">
            <button type="submit" name="submit">Sign Up</button>
        </form>
    </div>
</section>

    <?php
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'emptyinput') {
            echo "<p class='error'>Fill in all fields</p>";
        }
        else if ($_GET['error'] == "wronginlog") {
            echo "<p class='error'>Incorect login information </p>";
        }

    }
    ?>



</body>


