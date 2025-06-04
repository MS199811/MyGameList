<?php

require('database/connection.php');

if (isset($_GET['game_id'])) {
    $gameId = $_GET['game_id'];

    // Use a prepared statement to prevent SQL injection
    $stmt = $dbh->prepare("SELECT game_id, name, developer, description, release_date, available_online, crossplay, is_trending, img_src FROM mgt_games WHERE game_id = ?");
    $stmt->bind_param("i", $gameId);  // Assuming game_id is an integer
    $stmt->execute();

    $result = $stmt->get_result();
    if ($game = $result->fetch_assoc()) {
        //echo '<pre>';
        //var_dump($game);
        //echo '</pre>';

        // Access data directly
        $gameName = $game['name'];
        $gameDescription = $game['description'];
        $gameReleaseDate = $game['release_date'];
        $gameOnline = $game['available_online'];
        $gameCrossplay = $game['crossplay'];
        $gameImgSrc = $game['img_src'];
        // and so on...
    }

    $stmt->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php include_once('includes/meta.html'); ?>
   <link rel="stylesheet" href="css/game-info.css">
</head>
<body>
    <div id="container">
        <?php include_once('includes/header.html'); ?>
        <main>
            <div id="block1">
                <section>
                    <a href="index.php"><i class="fa-solid fa-angles-left"></i></a>
                </section>
                <section id="game-media">
                    <img src="<?=$gameImgSrc?>" alt="<?=$gameName?> cover art">
                </section>
                <section id="game-info">
                    <?=$gameDescription ?? 'Game not found.'?>
                </section>
            </div>
            <div id="block2">
                <div>
                    <i class="fa-solid fa-chevron-left"></i>
                </div>
                <section class="game">

                </section>
                <section class="game">

                </section>
                <section class="game">

                </section>
                <section class="game">

                </section>
                <section class="game">

                </section>
                <div>
                    <i class="fa-solid fa-chevron-right"></i>
                </div>
            </div>
        </main>
        <?php include_once('includes/footer.html'); ?>
    </div>
</body>
</html>