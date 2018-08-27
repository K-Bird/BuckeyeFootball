<?php include ("../../libs/db/common_db_functions.php"); 

$gm_ID = $_POST['gmID'];
$change = $_POST['confChg'];

db_query("UPDATE `games` SET OT='{$change}' WHERE GM_ID='{$gm_ID}'");