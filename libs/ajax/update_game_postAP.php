<?php include ("../../libs/db/common_db_functions.php"); 

$gm_ID = $_POST['gmID'];
$newRK = $_POST['newRK'];

db_query("UPDATE `games` SET Post_AP ='{$newRK}' WHERE GM_ID='{$gm_ID}'");