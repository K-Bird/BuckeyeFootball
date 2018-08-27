<?php include ("../../libs/db/common_db_functions.php"); 

$gm_ID = $_POST['gmID'];
$newOppCFP = $_POST['newOppCFP'];

db_query("UPDATE `games` SET Opp_CFP_RK ='{$newOppCFP}' WHERE GM_ID='{$gm_ID}'");