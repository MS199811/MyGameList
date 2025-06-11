<?php
if (session_status() === PHP_SESSION_NONE){
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("includes/meta.html") ?>
    <link rel="stylesheet" href="css/user-dashboard.css">
</head>
<body>
    <div id="container">
        <?php include_once("includes/header.html") ?>
        <main>
            <div class="block block1">
                <section>
                    1
                </section>
                <section>
                    2
                </section>
            </div>
            <div class="block block2">
                <section>
                    3
                </section>
            </div>
        </main>
        <?php include_once("includes/footer.html") ?>
    </div>
</body>
</html>