<?php include ("../../libs/db/common_db_functions.php"); 

$gm_ID = $_POST['gmID'];
$newOpp = $_POST['newOpp'];

db_query("UPDATE `games` SET Vs ='{$newOpp}' WHERE GM_ID='{$gm_ID}'");