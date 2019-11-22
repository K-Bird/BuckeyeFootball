<?php include ("../../libs/db/common_db_functions.php"); 

$season_ID = $_POST['seasonID'];
$newStart = $_POST['newStart'];

db_query("UPDATE `seasons` SET CFP_RK_Start ='{$newStart}' WHERE Season_ID='{$season_ID}'");