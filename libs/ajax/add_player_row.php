<?php

include ("../../libs/db/common_db_functions.php");

$season = $_POST['season'];
$pos = $_POST['pos'];

$nextMasterID = incrementPlayerMasterID();
$nextPlayerRow = incrementPlayerRow();

db_query("INSERT INTO `players` (

    `Player_Row`, 
    `Player_Master_ID`, 
    `Season`, 
    `Last_Name`, 
    `First_Name`, 
    `Number`, 
    `Position`, 
    `Position_2`, 
    `Depth`, 
    `Depth_2`, 
    `Height`, 
    `Weight`, 
    `Class`, 
    `Hometown`)
    
VALUES 

('{$nextPlayerRow}','{$nextMasterID}', '{$season}', '', '', '', '{$pos}', '', '', '','', '', 'FR', '')");


db_query("INSERT INTO `ref_player_lookup` (`Player_Master_ID`) VALUES ('{$nextMasterID}')");
