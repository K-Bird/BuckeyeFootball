<?php

include ("../../libs/db/common_db_functions.php");

$season = $_POST['season'];

$maxDecade = returnMaxSeasonDecade();

$previousSeason = $season - 1;
$previousSeasonID = getSeason_ID($previousSeason);

//Insert New Season into Seasons Table
db_query("INSERT INTO `seasons` (`Year`, `Decade_ID`, `Conf`, `Division`, `HC`, `DepthChart`) SELECT '{$season}','{$maxDecade}', `Conf`, `Division`, `HC`, `DepthChart` FROM `seasons` WHERE Season_ID='{$previousSeasonID}'");

//Update Input Season Control
db_query("UPDATE `controls` SET Value='{$season}' WHERE Control='Input_Season'");

//Copy Previous Year Roster
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
    `Hometown`)
    
SELECT

    `Player_Master_ID`,     
    '0', 
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
    `Hometown`
    
FROM `players` WHERE Season='{$previousSeasonID}'");

//Update Season to Next Seasson's ID
$nextSeason = getSeason_ID($season);
db_query("UPDATE `players` SET Season='{$nextSeason}' WHERE Season='0'");

//Remove SR, SR (RS) and GR Players in Next Season
db_query("DELETE FROM `players` WHERE Season='{$nextSeason}' AND (Class='SR' or Class='SR (RS)' or Class='GR')");

/*Loop through each player for Next Season and increment class */
$getNextYearPlayers = db_query("SELECT * FROM `players` WHERE Season='{$nextSeason}'");

while ($fetchNextYearPlayers = $getNextYearPlayers->fetch_assoc()) {
    
    $currentClass = $fetchNextYearPlayers['Class'];
    $nextClass = incrementPlayerClass($currentClass);
    db_query("UPDATE `players` SET Class='{$nextClass}' WHERE Player_Row='{$fetchNextYearPlayers['Player_Row']}'");
    
}

