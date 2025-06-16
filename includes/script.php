<?php

require('../database/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['function'])) {
    $function = $_POST['function'];

    switch ($function) {
        case 'getTrending':
            getTrending($dbh);
            break;
        case 'getUpcoming':
            getUpcoming($dbh);
            break;
        case 'getLatest':
            getLatest($dbh);
            break;
        default:
            echo 'Ongeldige functie.';
    }
}

function getTrending($dbh) {
    $moreTrending = $dbh->query("SELECT * FROM mgt_games WHERE is_trending = TRUE LIMIT 10");

    while ($row = $moreTrending->fetch_assoc()) {
        echo '<a href="game-details.php?game_id='.$row['game_id'].'"><figure>';
            echo '<img src="'.$row['img_src'].'">';
            echo '<figcaption>'.$row['name'].'</figcaption>';
        echo '</figure></a>';
    };
}

function getLatest($dbh) {
    $moreLatest = $dbh->query("SELECT * FROM mgt_games
        WHERE release_date <= CURDATE() 
        ORDER BY release_date DESC 
        LIMIT 10");

    while ($row = $moreLatest->fetch_assoc()) {
        echo '<a href="game-details.php?game_id='.$row['game_id'].'"><figure>';
            echo '<img src="'.$row['img_src'].'">';
            echo '<figcaption>'.$row['name'].'</figcaption>';
        echo '</figure></a>';
    };
}

function getUpcoming($dbh) {
    $moreUpcoming = $dbh->query("SELECT * FROM `mgt_games` 
        WHERE release_date IS NULL
        OR release_date > CURDATE()
        ORDER BY release_date DESC
        LIMIT 10;");

    while ($row = $moreUpcoming->fetch_assoc()) {
        echo '<a href="game-details.php?game_id='.$row['game_id'].'"><figure>';
            echo '<img src="'.$row['img_src'].'">';
            echo '<figcaption>'.$row['name'].'</figcaption>';
        echo '</figure></a>';
    };
}