<?php

include ("../../libs/db/common_db_functions.php");

$gameID = $_POST['gameID'];
$playerID = $_POST['playerID'];
$category = $_POST['category'];

$getCurrStats = db_query("SELECT * FROM `stats_{$category}` WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
$fetchCurrStats = $getCurrStats->fetch_assoc();

$seasonID = getSeasonIDbyGameID($gameID);

if ($category === 'passing') {

    $currComp = $fetchCurrStats['Comp'];
    $currAtt = $fetchCurrStats['Att'];
    $currYards = $fetchCurrStats['Yards'];
    $currTDs = $fetchCurrStats['TDs'];
    $currINTs = $fetchCurrStats['INTs'];

    /* Update the existing stat agg row */
    $aggRow = returnAggRow($category, $seasonID, $playerID);
    db_query("Update `stats_passing_agg` SET Comp= Comp - {$currComp}, Att=Att - {$currAtt}, Yards=Yards - {$currYards}, TDs=TDs - {$currTDs}, INTs=INTs - {$currINTs} WHERE Player_ID={$playerID} AND Season_ID={$seasonID}");
}
if ($category === 'rushing') {

    $currAtt = $fetchCurrStats['Att'];
    $currYards = $fetchCurrStats['Yards'];
    $currTDs = $fetchCurrStats['TDs'];

    /* Update the existing stat agg row */
    $aggRow = returnAggRow($category, $seasonID, $playerID);
    db_query("Update `stats_rushing_agg` SET Att=Att - {$currAtt}, Yards=Yards - {$currYards}, TDs=TDs - {$currTDs} WHERE Player_ID={$playerID} AND Season_ID={$seasonID}");
}

if ($category === 'rec') {

    $currRec = $fetchCurrStats['Rec'];
    $currYards = $fetchCurrStats['Yards'];
    $currTDs = $fetchCurrStats['TDs'];

    /* Update the existing stat agg row */
    $aggRow = returnAggRow($category, $seasonID, $playerID);
    db_query("Update `stats_rec_agg` SET Rec=Rec - {$currRec}, Yards=Yards - {$currYards}, TDs=TDs - {$currTDs} WHERE Player_ID={$playerID} AND Season_ID={$seasonID}");
}
if ($category === 'def') {

    $currTak = $fetchCurrStats['Tackles'];
    $currForLoss = $fetchCurrStats['ForLoss'];
    $currSacks = $fetchCurrStats['Sacks'];
    $currINTs = $fetchCurrStats['INTs'];
    $currINTTDs = $fetchCurrStats['INT_TDs'];
    $currPassDef = $fetchCurrStats['PassDef'];
    $currQBHurries = $fetchCurrStats['QBHurries'];
    $currFumbleRec = $fetchCurrStats['FumbleRec'];
    $currFumbleTDs = $fetchCurrStats['FumbleTDs'];

    /* Update the existing stat agg row */
    $aggRow = returnAggRow($category, $seasonID, $playerID);
    db_query("Update `stats_def_agg` SET Tackles= Tackles - {$currTak}, ForLoss=ForLoss - {$currForLoss}, Sacks=Sacks - {$currSacks}, INTs=INTs - {$currINTs}, INT_TDs=INT_TDs - {$currINTTDs}, PassDef = PassDef - {$currPassDef}, QBHurries = QBHurries - {$currQBHurries}, FumbleRec = FumbleRec - {$currFumbleRec}, FumbleTDs = FumbleTDs - {$currFumbleTDs} WHERE Player_ID={$playerID} AND Season_ID={$seasonID}");
}

if ($category === 'ret') {

    $currKR_RET = $fetchCurrStats['KR_Ret'];
    $currKR_Yards = $fetchCurrStats['KR_Yards'];
    $currKR_TDs = $fetchCurrStats['KR_TDs'];
    $currPR_RET = $fetchCurrStats['PR_Ret'];
    $currPR_Yards = $fetchCurrStats['PR_Yards'];
    $currPR_TDs = $fetchCurrStats['PR_TDs'];


    /* Update the existing stat agg row */
    $aggRow = returnAggRow($category, $seasonID, $playerID);
    db_query("Update `stats_ret_agg` SET KR_Ret= KR_Ret - {$currKR_RET}, KR_Yards = KR_Yards - {$currKR_Yards}, KR_TDs=KR_TDs - {$currKR_TDs}, PR_Ret= PR_Ret - {$currPR_RET}, PR_Yards = PR_Yards - {$currPR_Yards}, PR_TDs=PR_TDs - {$currKR_TDs} WHERE Player_ID={$playerID} AND Season_ID={$seasonID}");
}

if ($category === 'kicking') {

    $currXPA = $fetchCurrStats['XPA'];
    $currXPM = $fetchCurrStats['XPM'];
    $currFGA = $fetchCurrStats['FGA'];
    $currFGM = $fetchCurrStats['FGM'];
    $currLongKick = $fetchCurrStats['LongKick'];

    /* Update the existing stat agg row */
    $aggRow = returnAggRow($category, $seasonID, $playerID);
    $NewKickLong = findNewLong('kicking', $gameID, $playerID);
    db_query("Update `stats_kicking_agg` SET XPA=XPA - {$currXPA}, XPM=XPM - {$currXPM}, FGA=FGA - {$currFGA}, FGM=FGM - {$currFGM}, LongKick= {$NewKickLong} WHERE Player_ID='{$playerID}' AND Season_ID='{$seasonID}'");
}

if ($category === 'punting') {

    $currAtt = $fetchCurrStats['Att'];
    $currYards = $fetchCurrStats['Yards'];
    $currLongPunt = $fetchCurrStats['LongPunt'];

    /* Update the existing stat agg row */
    $aggRow = returnAggRow($category, $seasonID, $playerID);
    $NewPuntLong = findNewLong('punting', $gameID, $playerID);
    db_query("Update `stats_punting_agg` SET Att=Att - {$currAtt}, Yards=Yards - {$currYards}, LongPunt = {$NewPuntLong} WHERE Player_ID={$playerID} AND Season_ID={$seasonID}");
}

db_query("DELETE FROM `stats_{$category}` WHERE Player_ID='{$playerID}' AND Game_ID='{$gameID}'");
oneAggStatRowExists($category, $playerID, $seasonID);

function returnAggRow($category, $seasonID, $playerID) {
    $getCurrAgg = db_query("SELECT * FROM `stats_{$category}_agg` WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
    $fetchCurrAgg = $getCurrAgg->fetch_assoc();
    $aggRow = $fetchCurrAgg['agg_row'];
    return $aggRow;
}

//Check to see if the player has at least one row for the provided category in the removed stat's season || If so remove agg line item for player during season removed
function oneAggStatRowExists($category, $playerID, $seasonID) {

    $statInSeasonCount = 0;
    $checkStatRows = db_query("SELECT * FROM `stats_{$category}` WHERE Player_ID='{$playerID}'");
    while ($fetchStatRows = $checkStatRows->fetch_assoc()) {
        $gameID = $fetchStatRows['Game_ID'];
        $seasonIDStatRow = getSeasonIDbyGameID($gameID);
        if ($seasonID === $seasonIDStatRow) {
            $statInSeasonCount++;
        }
    }

    if ($statInSeasonCount < 1) {
        db_query("DELETE FROM `stats_{$category}_agg` WHERE Player_ID='{$playerID}' AND Season_ID='{$seasonID}'");
    } else {
        
    }
}

//Find the max Kick or Punt Long for games in stat removed season that does not include the game the stat was removed from
function findNewLong($type, $gameID, $playerID) {

    $seasonID = getSeasonIDbyGameID($gameID);

    if ($type === 'kicking') {

        $getLongs = db_query("SELECT * FROM `stats_{$type}` WHERE Player_ID='{$playerID}' AND Game_ID <> '{$gameID}'");
        $LongestKick = 0;
        while ($fetchLongs = $getLongs->fetch_assoc()) {

            $seasonIDofGame = getSeasonIDbyGameID($fetchLongs['Game_ID']);
            if ($seasonIDofGame === $seasonID) {
                if ($fetchLongs['LongKick'] > $LongestKick) {
                    $LongestKick = $fetchLongs['LongKick'];
                }
            }
        }
    }
    if ($type === 'punting') {

        $getLongs = db_query("SELECT * FROM `stats_{$type}` WHERE Player_ID='{$playerID}' AND Game_ID <> '{$gameID}'");
        $LongestKick = 0;
        while ($fetchLongs = $getLongs->fetch_assoc()) {

            $seasonIDofGame = getSeasonIDbyGameID($fetchLongs['Game_ID']);
            if ($seasonIDofGame === $seasonID) {
                if ($fetchLongs['LongPunt'] > $LongestKick) {
                    $LongestKick = $fetchLongs['LongPunt'];
                }
            }
        }
    }
    return $LongestKick;
}
