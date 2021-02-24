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
    
    '0',
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
    
//for each created player from recruits, populate the Player_Master_ID in players table
$getNewRecruits = db_query("SELECT * FROM `players` WHERE Season='{$seasonID}' AND Class='FR' AND Team_Status='Recruit'");
while ($fetchNewRecruits = $getNewRecruits->fetch_assoc()) {
    
    $nextMasterID = incrementPlayerMasterID();
    $Player_Row = $fetchNewRecruits['Player_Row'];
    $Recruit_ID = $fetchNewRecruits['Recruit_ID'];
    db_query("UPDATE `players` SET Player_Master_ID='{$nextMasterID}' WHERE Player_Row='{$Player_Row}'");
    db_query("UPDATE `recruits` SET Player_ID='{$nextMasterID}' WHERE Recruit_ID='{$Recruit_ID}'");
}

//Update atheletes to WR
db_query("UPDATE `players` SET Position='WR' WHERE Position='ATH' AND Season='{$seasonID}'");

}

//Copy recruits added the players table to the player reference table
db_query("INSERT INTO `ref_player_lookup` (

    `Player_Master_ID`, 
    `Last_Name`, 
    `First_Name`) SELECT
    
    `Player_ID`, 
    `Last_Name`, 
    `First_Name`
    
FROM `recruits` WHERE Class='{$class}'");
    
