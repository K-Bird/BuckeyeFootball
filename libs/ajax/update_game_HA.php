<?php include ("../../libs/db/common_db_functions.php"); 

$gm_ID = $_POST['gmID'];
$newHA = $_POST['newHA'];

db_query("UPDATE `games` SET H_A ='{$newHA}' WHERE GM_ID='{$gm_ID}'");