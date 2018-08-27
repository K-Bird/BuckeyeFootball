<?php include ("../../libs/db/common_db_functions.php"); 

$gm_ID = $_POST['gmID'];
$newLoc = $_POST['newLoc'];

db_query("UPDATE `games` SET Location ='{$newLoc}' WHERE GM_ID='{$gm_ID}'");