<?php

$server = 'localhost'; 
$user = 'root';
$pass = '';
$db = 'mgt';

$dbh = new mysqli($server, $user, $pass, $db);
if ($dbh->connect_error){
	die('Verbinden mislukt: '.$dbh->connect_error);
}
