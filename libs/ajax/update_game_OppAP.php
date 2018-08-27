<?php include ("../../libs/db/common_db_functions.php"); 

$gm_ID = $_POST['gmID'];
$newOppAP = $_POST['newOppAP'];

db_query("UPDATE `games` SET Opp_AP_RK ='{$newOppAP}' WHERE GM_ID='{$gm_ID}'");