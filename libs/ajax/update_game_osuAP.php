<?php include ("../../libs/db/common_db_functions.php"); 

$gm_ID = $_POST['gmID'];
$newOSUAP = $_POST['newOSUAP'];

db_query("UPDATE `games` SET OSU_AP_RK ='{$newOSUAP}' WHERE GM_ID='{$gm_ID}'");