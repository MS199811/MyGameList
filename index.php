<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require('database/connection.php');

require('includes/functions.php');

?>
<!DOCTYPE html>
<html lang="en-GB">

<head>
    <?php include_once('includes/meta.html'); ?>
    <link rel="stylesheet" href="css/index.css">
    <script src="js/functions.js" defer></script>
</head>

<body>
    <div id="container">
        <?php require_once('includes/header.php'); ?>
        <aside>
            <?php require_once('includes/nav.php'); ?>
        </aside>
        <main>
            <section>
                <h2>Welcome <?= $_SESSION['loginName'] ?? 'Visitor' ?>!</h2>
                <p>Here's a quick introduction as how to use this site.</p>
                <ul>
                    <li>- Search for games by sorting them!</li>
                    <li>- And that's it..! For now.</li>
                </ul>
            </section>
            <section>
                <h3>Trending</h3>
                <div id="trending" name="trending">
                    <?php createTrending($dbh) ?>
                </div>
                <button class="action-button more-trending" data-function="getTrending">More Trending</button>
            </section>
            <section>
                <h3>Latest</h3>
                <div id="latest">
                    <?php createLatest($dbh) ?>
                </div>
                <button class="action-button more-latest" data-function="getLatest">More Latest</button>
            </section>
            <section>
                <h3>Upcoming</h3>
                <div id="upcoming">
                    <?php createUpcoming($dbh) ?>
                </div>
                <button class="action-button more-upcoming" data-function="getUpcoming">More Upcoming</button>
            </section>
        </main>
        <?php include_once('includes/footer.html'); ?>
    </div>
</body>

</html>