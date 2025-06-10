<?php

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
    <?php include_once('includes/header.html'); ?>
    <aside>
        <?php require_once('includes/nav.php'); ?>
    </aside>
    <main>
        <section>
            <h2>Welcome User</h2>
            <p>Here's a quick introduction as how to use this site.</p>
            <ul>
                <li>- Search for games by sorting them!</li>
                <li>- Like games!</li>
            </ul>
        </section>
        <section>
            <h3>Trending</h3>
            <div id="trending" name="trending">
                <?php createTrending($dbh) ?>
            </div>
            <button id="more-trending">More Trending</button>
        </section>
        <section>
            <h3>Latest</h3>
            <hr>
            <div id="latest">
                <?php createLatest($dbh) ?>
            </div>
            <button id="more-latest">More Latest</button>
        </section>
        <section>
            <h3>Upcoming</h3>
            <div id="upcoming">
                <?php createUpcoming($dbh) ?>
            </div>
            <button id="more-upcoming">More Upcoming</button>
        </section>
    </main>
    <?php include_once('includes/footer.html'); ?>
    </div>
</body>
</html>