<?php include ("../../libs/db/common_db_functions.php"); 

$player_row = $_POST['row'];
$newClass = addslashes($_POST['newClass']);

db_query("UPDATE `players` SET Class ='{$newClass}' WHERE Player_Row='{$player_row}'");