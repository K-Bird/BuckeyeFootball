<?php include ("../../libs/db/common_db_functions.php"); 

$gm_ID = $_POST['gmID'];
$newOpp = $_POST['newOpp'];

db_query("UPDATE `games` SET Vs ='{$newOpp}' WHERE GM_ID='{$gm_ID}'");

$getOpponent = db_query("SELECT * FROM `opponents` WHERE Team_ID='{$newOpp}'");
$fetchOpponent = $getOpponent->fetch_assoc();
$newOpp = $fetchOpponent['School'] . " " . $fetchOpponent['Nickname'];

db_query("UPDATE `ref_game_lookup` SET Opp ='{$newOpp}' WHERE GM_ID='{$gm_ID}'");