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
                <form action="<?=htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                    <label for="login-username">Username: </label>
                    <input type="text" name="login-username" id="login-username">

                    <label for="login-password">Password: </label>
                    <input type="password" name="login-password" id="login-password">

                    <input type="submit" name="login" value="Send">
                </form>
            </section>

            <!-- REGISTRATION -->

            <section>
                <h2>Registration</h2>
                <form action="<?=htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                    <label for=""></label>
                    <input type="text">

                </form>
            </section>
        </main>
        <?php include_once('includes/footer.html'); ?>
    </div> 
</body>
</html>