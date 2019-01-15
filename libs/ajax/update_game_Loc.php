<?php include ("../../libs/db/common_db_functions.php"); 

$gm_ID = $_POST['gmID'];
$newLoc = $_POST['newLoc'];

db_query("UPDATE `games` SET Location ='{$newLoc}' WHERE GM_ID='{$gm_ID}'");

$getStadium = db_query("SELECT * FROM `locations` WHERE Loc_ID='{$newLoc}'");
$fetchStadium = $getStadium->fetch_assoc();
$newLoc = $fetchStadium['Stadium'];

db_query("UPDATE `ref_game_lookup` SET Loc ='{$newLoc}' WHERE GM_ID='{$gm_ID}'");