<?php include ("../../libs/db/common_db_functions.php"); 

$gm_ID = $_POST['gmID'];
$newDate = $_POST['newDate'];

db_query("UPDATE `games` SET Date ='{$newDate}' WHERE GM_ID='{$gm_ID}'");