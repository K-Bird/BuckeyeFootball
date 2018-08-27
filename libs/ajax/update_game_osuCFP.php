<?php include ("../../libs/db/common_db_functions.php"); 

$gm_ID = $_POST['gmID'];
$newOSUCFP = $_POST['newOSUCFP'];

db_query("UPDATE `games` SET OSU_CFP_RK ='{$newOSUCFP}' WHERE GM_ID='{$gm_ID}'");