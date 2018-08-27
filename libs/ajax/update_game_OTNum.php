<?php include ("../../libs/db/common_db_functions.php"); 

$gm_ID = $_POST['gmID'];
$newOTNum = $_POST['newOTNum'];

db_query("UPDATE `games` SET OT_Num ='{$newOTNum}' WHERE GM_ID='{$gm_ID}'");