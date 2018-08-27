<?php include ("../../libs/db/common_db_functions.php"); 

$player_row = $_POST['row'];
$newNum = $_POST['newNum'];

db_query("UPDATE `players` SET Number ='{$newNum}' WHERE Player_Row='{$player_row}'");