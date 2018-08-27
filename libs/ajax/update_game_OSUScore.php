<?php include ("../../libs/db/common_db_functions.php"); 

$gm_ID = $_POST['gmID'];
$newScore = $_POST['newScore'];

db_query("UPDATE `games` SET OSU_Score ='{$newScore}' WHERE GM_ID='{$gm_ID}'");