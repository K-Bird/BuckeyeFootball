<?php include ("../../libs/db/common_db_functions.php"); 

$player_row = $_POST['player_row'];
$newStatus = $_POST['newStatus'];

db_query("UPDATE `players` SET Post_Season_Status ='{$newStatus}' WHERE Player_Row='{$player_row}'");