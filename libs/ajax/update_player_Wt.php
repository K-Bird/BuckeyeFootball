<?php include ("../../libs/db/common_db_functions.php"); 

$player_row = $_POST['row'];
$newWt = addslashes($_POST['newWt']);

db_query("UPDATE `players` SET Weight ='{$newWt}' WHERE Player_Row='{$player_row}'");