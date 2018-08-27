<?php include ("../../libs/db/common_db_functions.php"); 

$gm_ID = $_POST['gmID'];
$change = $_POST['divChg'];

db_query("UPDATE `games` SET Div_GM ='{$change}' WHERE GM_ID='{$gm_ID}'");