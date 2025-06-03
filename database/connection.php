<?php

$server = 'localhost'; 
$user = 'root';
$pass = '';
$db = 'mgt';

$dbh = new mysqli($server, $user, $pass, $db);
$dbh->set_charset("utf8mb4");
if ($dbh->connect_error){
	die('Verbinden mislukt: '.$dbh->connect_error);
}
