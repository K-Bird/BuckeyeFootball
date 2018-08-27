<?php include ("../../libs/db/common_db_functions.php"); 

$player_row = $_POST['row'];
$newPOS = addslashes($_POST['newPOS']);

db_query("UPDATE `players` SET Position_2 ='{$newPOS}' WHERE Player_Row='{$player_row}'");