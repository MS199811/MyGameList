<?php
require('database/connection.php');

if (session_status() === PHP_SESSION_NONE){
    session_start();
}


/* REGEX */

$nameRegex = '/^[a-zA-Z0-9_]{1,25}$/';
$passwordRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,50}$/';
$emailRegex = '/^[\w\.-]+@[\w\.-]+\.[a-zA-Z]{2,}$/';

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

    /* Validate Login */

    if (empty($logErrors)) {
        $stmtLogin = $dbh->prepare("SELECT username, password FROM mgt_user WHERE username = ?");
        if (!$stmtLogin) {
            die("Prepare failed: " . $dbh->error);
        }

        $stmtLogin->bind_param("s", $logName);
        $stmtLogin->execute();
        $result = $stmtLogin->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($logPass, $user['password'])) {
            $_SESSION['logged'] = true;
            $_SESSION['loginName'] = $user['username'];
            header("Location: index.php");
            exit();
        } else {
            $logErrors[] = "Invalid username or password.";
        }
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

    /* Validate Registration Data  */

    if (empty($regErrors)) {
        /* Compare passwords */
        if ($regPass !== $regRptPass) {
            $regErrors[] = 'Passwords don\'t match!';    
        } else {
            /* check if the email exist in the db */
            $checkEmailStmt = $dbh->prepare("SELECT email FROM mgt_user where email = ?");
            $checkEmailStmt->bind_param("s", $regEmail);
            $checkEmailStmt->execute();
            $result = $checkEmailStmt->store_result();
            
            if ($checkEmailStmt->num_rows > 0) {
                $regErrors[] = "Email ID already exists";
            } else {
                $hashedPassword = password_hash($regPass, PASSWORD_DEFAULT);
                $stmtRegistration = $dbh->prepare("INSERT INTO mgt_user (username, password, email) VALUES (?, ?, ?)");
                $stmtRegistration->bind_param("sss", $regName, $hashedPassword, $regEmail);
                if ($stmtRegistration->execute()){
                    // Registration successful, set session variable
                    $_SESSION['logged'] = true;
                    $_SESSION['loginName'] = $regName; 
                    header("Location: index.php");
                    exit();
                } else {
                    $regErrors[] = "Error: ". $stmtRegistration->error;
                }
                $stmtRegistration->close();
            }
            $checkEmailStmt->close();
        }
        $dbh->close();
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
        <?php include_once('includes/header.php'); ?>
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
                        <input type="password" name="log_password" id="log_password" value="<?= $logPass ?? ''?>">
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
                        <input type="text" name="reg_name" id="reg_name" value="<?= $regName ?? ''?>" pattern="^[a-zA-Z0-9_]{1,25}$" title="Letters, numbers and underscores only">
                    </div>
                    <div>
                        <label for="reg_email">E-Mail:</label>
                        <input type="email" name="reg_email" id="reg_email" value="<?= $regEmail ?? ''?>" pattern="^[\w\.-]+@[\w\.-]+\.[a-zA-Z]{2,}$/">
                    </div>
                    <div>
                        <label for="reg_password">Password:</label>
                        <input type="password" name="reg_password" id="reg_password" value="<?= $regPass ?? ''?>" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{10,50}$" title="8 min 50 max characters consisting of 1 Uppercase letter, 1 Lowercase Letter, 1 special character (!@#$%&) and 1 number">
                    </div>
                    <div>
                        <label for="reg_repeat_password">Repeat Password:</label>
                        <input type="password" name="reg_repeat_password" id="reg_repeat_password" value="<?= $regRptPass ?? ''?>">
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