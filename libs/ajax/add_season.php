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
    `Hometown`,
    `Team_Status`,
    `Post_Season_Status`)
    
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
    `Hometown`,
    `Team_Status`,
    `Post_Season_Status`
    
FROM `players` WHERE Season='{$previousSeasonID}'");

//Update Season to Next Seasson's ID
$nextSeason = getSeason_ID($season);
db_query("UPDATE `players` SET Season='{$nextSeason}' WHERE Season='0'");

/* Loop through each player for Next Season to increment class and apply appropriate transition */
$getNextYearPlayers = db_query("SELECT * FROM `players` WHERE Season='{$nextSeason}'");

while ($fetchNextYearPlayers = $getNextYearPlayers->fetch_assoc()) {

    $playerRow = $fetchNextYearPlayers['Player_Row'];
    $currentClass = $fetchNextYearPlayers['Class'];
    $teamStatus = $fetchNextYearPlayers['Team_Status'];
    $offseasonStatus = $fetchNextYearPlayers['Post_Season_Status'];

    if ($offseasonStatus === 'Redshirt') {

        if ($class === 'FR') {
            db_query("UPDATE `players` SET Class = 'FR (RS)' WHERE Player_Row = '{$playerRow}'");
        }
        if ($class === 'SO') {
            db_query("UPDATE `players` SET Class = 'SO (RS)' WHERE Player_Row = '{$playerRow}'");
        }
        if ($class === 'JR') {
            db_query("UPDATE `players` SET Class = 'JR (RS)' WHERE Player_Row = '{$playerRow}'");
        }
        if ($class === 'SR') {
            db_query("UPDATE `players` SET Class = 'SR (RS)' WHERE Player_Row = '{$playerRow}'");
        }
    } else {

        //Non Red Shirt Track
        if ($currentClass === 'FR') {
            db_query("UPDATE `players` SET Class = 'SO' WHERE Player_Row = '{$playerRow}'");
        }
        if ($currentClass === 'SO') {
            db_query("UPDATE `players` SET Class = 'JR' WHERE Player_Row = '{$playerRow}'");
        }
        if ($currentClass === 'JR') {
            db_query("UPDATE `players` SET Class = 'SR' WHERE Player_Row = '{$playerRow}'");
        }

        //Red Shirt Track
        if ($currentClass === 'FR (RS)') {
            db_query("UPDATE `players` SET Class = 'SO (RS)' WHERE Player_Row = '{$playerRow}'");
        }
        if ($currentClass === 'SO (RS)') {
            db_query("UPDATE `players` SET Class = 'JR (RS)' WHERE Player_Row = '{$playerRow}'");
        }
        if ($currentClass === 'JR (RS)') {
            db_query("UPDATE `players` SET Class = 'SR (RS)' WHERE Player_Row = '{$playerRow}'");
        }
    }

    if ($offseasonStatus === 'Transfer' || $offseasonStatus === 'Graduated' || $offseasonStatus === 'Left For Draft' || $offseasonStatus === 'Not On Team') {
        db_query("DELETE FROM `players` WHERE Player_Row ='{$playerRow}'");
    } else {
        db_query("UPDATE `players` SET Team_Status= 'On Team' WHERE Player_Row = '{$playerRow}'");
        db_query("UPDATE `players` SET Post_Season_Status= 'Stayed' WHERE Player_Row = '{$playerRow}'");
    }
}
