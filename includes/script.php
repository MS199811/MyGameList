<?php

require('../database/connection.php');

/* MORE TRENDING */

$moreTrending = $dbh->query("SELECT * FROM mgt_games WHERE is_trending = TRUE LIMIT 10");

while ($row = $moreTrending->fetch_assoc()) {
    echo '<a href="game-details.php?game_id='.$row['game_id'].'"><figure>';
        echo '<img src="'.$row['img_src'].'">';
        echo '<figcaption>'.$row['name'].'</figcaption>';
    echo '</figure></a>';
};