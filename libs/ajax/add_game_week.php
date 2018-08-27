<?php

include ("../../libs/db/common_db_functions.php");

$season = $_POST['season'];


$getMaxWeek = db_query("SELECT Max(Week) as MaxWeek From `games` WHERE Season_ID='{$season}'");
$fetchMaxWeek = $getMaxWeek->fetch_assoc();
$nextWeek = $fetchMaxWeek['MaxWeek'] + 1;


db_query("INSERT INTO `games` (

    `Season_ID`, 
    `Week`, 
    `Date`, 
    `H_A`, 
    `Location`, 
    `Vs`, 
    `Opp_Conf`, 
    `GM_Type`, 
    `GM_SubType`, 
    `Opp_AP_RK`, 
    `Opp_CFP_RK`, 
    `OSU_Score`, 
    `Opp_Score`, 
    `Conf_GM`, 
    `Div_GM`, 
    `Post_AP`, 
    `Post_CFP`)
    
VALUES 

('{$season}', '{$nextWeek}', '', '', '0', '0', '0', '43', '0', '0', '0', '0', '0', 'N', 'N', '0', '0')");
