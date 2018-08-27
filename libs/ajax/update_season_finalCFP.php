<?php include ("../../libs/db/common_db_functions.php"); 

$season_ID = $_POST['seasonID'];
$newRK = $_POST['newRK'];

db_query("UPDATE `seasons` SET CFP_Final ='{$newRK}' WHERE Season_ID='{$season_ID}'");