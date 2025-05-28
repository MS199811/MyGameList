<?php

require('../database/connection.php');

/* MORE TRENDING */

$moreTrending = $dbh->query("SELECT * FROM mgt_games WHERE is_trending = TRUE");

while ($row = $moreTrending->fetch_assoc()) {
    echo '<figure>';
        echo '<img src="'.$row['img_src'].'">';
        echo '<figcaption>'.$row['name'].'</figcaption>';
    echo '</figure>';
};