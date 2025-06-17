<?php

if (session_status() === PHP_SESSION_NONE){
    session_start();
}

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

        $gameName = $game['name'];

        $gameDescription = $game['description'];
       
        if (!$game['release_date'] == null) {
            $gameReleaseDate = $game['release_date'];
        } else {
            $gameReleaseDate = 'UNKNOWN';
        }

        if ($game['available_online'] == 1) {
            $gameOnline = 'Yes';
        } else {
            $gameOnline = 'No';
        }

        if ($game['crossplay'] == 1) {
            $gameCrossplay = 'Yes';
        } else {
            $gameCrossplay = 'No';
        }
        
        $gameImgSrc = $game['img_src'];
    }

    $stmt->close();
}

?>
<!DOCTYPE html>
<html lang="en-GB">
<head>
   <?php include_once('includes/meta.html'); ?>
   <link rel="stylesheet" href="css/game-details.css">
</head>
<body>
    <div id="container">
        <?php include_once('includes/header.php'); ?>
        <main>
            <div id="block1">
                <section>
                    <a href="index.php"><i class="fa-solid fa-angles-left"></i></a>
                </section>
                <section id="game-media">
                    <img src="<?=$gameImgSrc ?? 'images/game-covers/no_image.jpg'?>" alt="<?=$gameName ?? 'An Image of no image available'?>">
                </section>
                <section id="game-info">
                    <?php
                        if ((isset($_GET['game_id'])) && (!empty($gameName))) {
                            echo '<table>';
                                echo '<tr>';
                                    echo '<th colspan="2">'.$gameName.'</th>';
                                echo '</tr>';
                                echo '<tr>';
                                    echo '<td>Release Date:</td>';
                                    echo '<td>'.$gameReleaseDate.'</td>';
                                echo '</tr>';
                                echo '<tr>';
                                    echo '<td>Available Online:</td>';
                                    echo '<td>'.$gameOnline.'</td>';
                                echo '</tr>';
                                echo '<tr>';
                                    echo '<td>Supports Crossplay:</td>';
                                    echo '<td>'.$gameCrossplay.'</td>';
                                echo '</tr>';
                                echo '<tr>';
                                    echo '<td>Game Description:</td>';
                                    echo '<td>'.$gameDescription.'</td>';
                                echo '</tr>';
                            echo '</table>';
                        } else {
                            echo '<h3 style="color: red;">Game does not exist. Oof!</h3>'; 
                        }
                    ?>
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