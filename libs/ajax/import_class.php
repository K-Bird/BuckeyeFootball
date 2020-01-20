<?php

include ("../../libs/db/common_db_functions.php");

$class = $_POST['recClass'];

//Check if season exists
$seasonExists = mysqli_num_rows(db_query("SELECT * FROM `seasons` WHERE Year='{$class}'"));

if ($seasonExists === 0) {
    echo 'Season Not Not Exist';
} else {
    echo 'Class Imported';
    $seasonID = getSeason_ID($class);

$nextMasterID = incrementPlayerMasterID();

//Copy recruits into player table
db_query("INSERT INTO `players` (

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
    `Hometown`,
    `Recruit_ID`,
    `Team_Status`,
    `Post_Season_Status`) SELECT
    
    '{$nextMasterID}',
    '{$seasonID}',
    `Last_Name`, 
    `First_Name`,
    '0',
    `Position`,
    '',
    '0',
    '0',
    `Height`, 
    `Weight`, 
    'FR',
    `Hometown`,
    `Recruit_ID`,
    'Recruit',
    'Stayed'
    
FROM `recruits` WHERE Class='{$class}'");
    
//populate the Player_Master_ID in the recruits table
db_query("UPDATE `recruits` INNER JOIN `players` ON recruits.Recruit_ID = players.Recruit_ID SET recruits.Player_ID = players.Player_Master_ID");

//Update atheletes to WR
db_query("UPDATE `players` SET Position='WR' WHERE Position='ATH' AND Season='{$seasonID}'");

}

