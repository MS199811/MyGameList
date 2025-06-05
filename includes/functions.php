<?php

require('database/connection.php');

/* RETRIEVE TRENDING GAMES */

function createTrending($dbh) {
    $trendingGames = $dbh->query("SELECT * FROM mgt_games WHERE is_trending = true LIMIT 5");
    while ($record = $trendingGames->fetch_assoc()) {
        echo '<a href="game-details.php?game_id='.$record['game_id'].'"><article class="game">';
            echo '<h4>'.$record['name'].'</h4>';
            echo '<h5>'.$record['developer'].'</h5>';
        echo '</article></a>';
    };
}

/* RETRIEVE LATEST RELEASED GAMES */

function createLatest($dbh) {
    $latestGames = $dbh->query("SELECT * FROM mgt_games
    WHERE release_date < CURDATE() 
    ORDER BY release_date DESC 
    LIMIT 5");

    while ($record = $latestGames->fetch_assoc()) {
        echo '<a href="game-details.php?game_id='.$record['game_id'].'"><article class="game">';
            echo '<h4>'.$record['name'].'</h4>';
            echo '<h5>'.$record['developer'].'</h5>';
        echo '</article></a>';
    }
}

/* RETRIEVE UPCOMING GAMES */

function createUpcoming($dbh) {
    $upcomingGames = $dbh->query("SELECT * FROM `mgt_games` 
        WHERE release_date IS NULL
        OR release_date > CURDATE()
        ORDER BY release_date DESC
        LIMIT 5;");

    while ($record = $upcomingGames->fetch_assoc()) {
        echo '<a href="game-details.php?game_id='.$record['game_id'].'"><article class="game">';
            echo '<h4>'.$record['name'].'</h4>';
            echo '<h5>'.$record['developer'].'</h5>';
        echo '</article></a>';
    }
}
