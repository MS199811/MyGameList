<?php

require('database/connection.php');

/* RETRIEVE TRENDING GAMES */

function createTrending($dbh) {
    $trendingGames = $dbh->query("SELECT * FROM mgt_games WHERE is_trending = true LIMIT 5");
    while ($record = $trendingGames->fetch_assoc()) {
        echo '<article class="game">';
            echo '<h4>'.$record['name'].'</h4>';
            echo '<h5>'.$record['developer'].'</h5>';
        echo '</article>';
    };
}

/* RETRIEVE LATEST RELEASED GAMES */

function createLatest($dbh) {
    $latestGames = $dbh->query("SELECT * FROM mgt_games WHERE release_date IS NOT NULL ORDER BY release_date DESC LIMIT 5");

    while ($record = $latestGames->fetch_assoc()) {
        echo '<article class="game">';
            echo '<h4>'.$record['name'].'</h4>';
            echo '<h5>'.$record['developer'].'</h5>';
        echo '</article>';
    }
}

/* RETRIEVE UPCOMING GAMES */

function createUpcoming($dbh) {
    $upcomingGames = $dbh->query("SELECT * FROM `mgt_games` WHERE release_date IS NULL ORDER BY `mgt_games`.`name` ASC LIMIT 5");

    while ($record = $upcomingGames->fetch_assoc()) {
        echo '<article class="game">';
            echo '<h4>'.$record['name'].'</h4>';
            echo '<h5>'.$record['developer'].'</h5>';
        echo '</article>';
    }
}
