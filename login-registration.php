<?php

/* REGEX */

$nameRegex = '/^.{1,25}/';
$passwordRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{10, 50}$/';
$emailRegex = '/^.*@.*\..*$/';

/* LOGIN */

if (isset($_POST['login'])) {
    $logErrors = [];

    if (!empty($_POST['log_name'])) {
        $logName = htmlspecialchars($_POST['log_name']);
    } else {
        $logErrors[] = 'No username';
    }

    if (!empty($_POST['log_password'])) {
        $logPass = htmlspecialchars($_POST['log_password']);
    } else {
        $logErrors[] = 'No password';
    }
} 

/* REGISTRATION */

if (isset($_POST['registration'])) {
    $regErrors = [];

    if (!empty($_POST['reg_name'])) {
        if (preg_match($nameRegex, $_POST['reg_name']) === 0) {
            $regErrors[] = 'Username doesn\'t comply to the requirements.';
        } else {
            $regName = htmlspecialchars($_POST['reg_name']);
        }
    } else {
        $regErrors[] = 'Missing username';
    }

    if (!empty($_POST['reg_email'])) {
        if (preg_match($emailRegex, $_POST['reg_email']) === 0) {
            $regErrors[] = 'Email doesn\'t match the criteria.';
        } else {
            $regEmail = htmlspecialchars($_POST['reg_email']);
        }
    } else {
        $regErrors[] = 'Missing email';
    }

    if (!empty($_POST['reg_password'])) {
        if (preg_match($passwordRegex, $_POST['reg_password']) === 0) {
            $regErrors[] = 'Password doesn\'t comply to the requirements.';
        } else {
            $regPass = htmlspecialchars($_POST['reg_password']);
        }
    } else {
        $regErrors[] = 'Missing password';
    }

    if (!empty($_POST['reg_repeat_password'])) {
        $regRptPass = htmlspecialchars($_POST['reg_repeat_password']);
    } else {
        $regErrors[] = 'Missing secondary password';
    }

    /* Compare password */

    if (isset($regPass) && isset($regRptPass)) {
        if ($regPass === $regRptPass) {
            echo 'YEEEES';
        } else {
            echo 'Aw hell no';
        }
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
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                    <div>
                        <label for="log_name">Username: </label>
                        <input type="text" name="log_name" id="log_name" value="<?= $logName ?? ''?>">
                    </div>
                    <div>
                        <label for="log_password">Password: </label>
                        <input type="text" name="log_password" id="log_password" value="<?= $logPass ?? ''?>">
                    </div>
                    <div>
                        <input type="submit" name="login" value="Send">
                    </div>
                </form>
                <?php
                    if (isset($_POST['login']) && count($logErrors) > 0) {
                        echo '<ul>';
                            foreach ($logErrors as $logError) {
                                echo '<li style="color: red;"> - '.$logError.'</li>';
                            }
                        echo '</ul>';
                    }
                ?>
            </section>

            <!-- REGISTRATION -->

            <section>
                <h2>Registration</h2>
                <form action="<?=htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                    <div>
                        <label for="reg_name">Username:</label>
                        <input type="text" name="reg_name" id="reg_name" value="<?= $regName ?? ''?>" pattern="^.{1,25}" title="max of 25 chars">
                    </div>
                    <div>
                        <label for="reg_email">E-Mail:</label>
                        <input type="email" name="reg_email" id="reg_email" value="<?= $regEmail ?? ''?>" pattern="^.*@.*\..*$">
                    </div>
                    <div>
                        <label for="reg_password">Password:</label>
                        <input type="text" name="reg_password" id="reg_password" value="<?= $regPass ?? ''?>" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{10, 50}$" title="10 min 50 max characters consisting of 1 Uppercase letter, 1 Lowercase Letter, 1 special character (!@#$%&) and 1 number">
                    </div>
                    <div>
                        <label for="reg_repeat_password">Repeat Password:</label>
                        <input type="text" name="reg_repeat_password" id="reg_repeat_password" value="<?= $regRptPass ?? ''?>">
                    </div>
                    <div>
                        <input type="submit" name="registration" value="Send">
                    </div>
                </form>
                <?php
                     if (isset($_POST['registration']) && count($regErrors) > 0) {
                        echo '<ul>';
                            foreach ($regErrors as $regError) {
                                echo '<li style="color: red;"> - '.$regError.'</li>';
                            }
                        echo '</ul>';
                    }
                ?>
            </section>
        </main>
        <?php include_once('includes/footer.html'); ?>
    </div> 
</body>
</html>