<?php include ("../../libs/db/common_db_functions.php"); 

$player_row = $_POST['row'];
$newHt = addslashes($_POST['newHt']);

db_query("UPDATE `players` SET Height ='{$newHt}' WHERE Player_Row='{$player_row}'");