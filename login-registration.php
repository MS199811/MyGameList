<?php

/* LOGIN */

if (isset($_POST['login'])) {
    $logErrors = [];

    if (!empty($_POST['log_username'])) {
        $logName = htmlspecialchars($_POST['login-username']);
    } else {
        $errors[] = 'No username input';
    }

    if (!empty($_POST['log_password'])) {
        $logPass = htmlspecialchars($_POST['login-username']);
    } else {
        $errors[] = 'No password input';
    }
} 

/* REGISTRATION */

if (isset($_POST['registration'])) {
    $regErrors = [];

    if (!empty($_POST['reg_username'])) {
        $username = htmlspecialchars($_POST['login-username']);
    } else {
        $errors[] = 'No username input';
    }

    if (!empty($_POST['reg-email'])) {
        $username = htmlspecialchars($_POST['login-username']);
    } else {
        $errors[] = 'No username input';
    }

    if (!empty($_POST['reg_password'])) {
        $username = htmlspecialchars($_POST['login-username']);
    } else {
        $errors[] = 'No username input';
    }

    if (!empty($_POST['reg_repeat_password'])) {
        $username = htmlspecialchars($_POST['login-username']);
    } else {
        $errors[] = 'No username input';
    }

} 
?>
<!DOCTYPE html>
<html lang="en-GB">
<head>
    <?php include_once('includes/meta.html'); ?>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div id="container">
        <?php include_once('includes/header.html'); ?>
        <main>
            <!-- LOGIN -->
            <section>
                <h2>Login</h2>
                <form action="index.php" method="post">
                    <label for="log_name">Username: </label>
                    <input type="text" name="log-name" id="log-name">

                    <label for="log_password">Password: </label>
                    <input type="text" name="log-password" id="log-password">

                    <input type="submit" name="login" value="Send">
                </form>
            </section>

            <!-- REGISTRATION -->

            <section>
                <h2>Registration</h2>
                <form action="<?=htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                    <label for="reg_name">Username:</label>
                    <input type="text" name="reg_name" id="reg_name">

                    <label for="reg_email">E-Mail:</label>
                    <input type="email" name="reg-email" id="reg-email">

                    <label for="reg_password">Password:</label>
                    <input type="text" name="reg-password" id="reg-password">

                    <label for="reg_repeat_password">Repeat Password:</label>
                    <input type="text" name="reg_repeat-password" id="reg_repeat_password">

                    <input type="submit" name="registration" value="Send">
                </form>
            </section>
        </main>
        <?php include_once('includes/footer.html'); ?>
    </div> 
</body>
</html>