<?php include ("../../libs/db/common_db_functions.php"); 

$master_ID = $_POST['master_ID'];
$newFName = addslashes($_POST['newFName']);

db_query("UPDATE `players` SET First_Name ='{$newFName}' WHERE Player_Master_ID='{$master_ID}'");
db_query("UPDATE `ref_player_lookup` SET First_Name ='{$newFName}' WHERE Player_Master_ID='{$master_ID}'");