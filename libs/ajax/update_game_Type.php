<?php include ("../../libs/db/common_db_functions.php"); 

$gm_ID = $_POST['gmID'];
$newType = $_POST['newType'];

db_query("UPDATE `games` SET GM_Type ='{$newType}' WHERE GM_ID='{$gm_ID}'");