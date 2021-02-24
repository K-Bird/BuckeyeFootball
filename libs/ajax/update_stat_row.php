<?php

include ("../../libs/db/common_db_functions.php");

$gameID = $_POST['GM_ID'];
$playerID = $_POST['Player_ID'];
$seasonID = getSeasonIDbyGameID($gameID);

if (isset($_POST['statCategory'])) {
    $Category = $_POST['statCategory'];
}

if ($Category === 'passing') {

    $getCurrStats = db_query("SELECT * FROM `stats_passing` WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    $fetchCurrStats = $getCurrStats->fetch_assoc();

    if ($_POST['passComp'] != '') {
        $completions = $_POST['passComp'];
        $compDiff = statDiff($fetchCurrStats['Comp'], $completions);
        db_query("UPDATE `stats_passing_agg` SET Comp=Comp + '{$compDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_passing` SET Comp='{$completions}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['passAtt'] != '') {
        $attempts = $_POST['passAtt'];
        $attDiff = statDiff($fetchCurrStats['Att'], $attempts);
        db_query("UPDATE `stats_passing_agg` SET Att=Att + '{$attDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_passing` SET Att='{$attempts}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['passYards'] != '') {
        $yards = $_POST['passYards'];
        $yardsDiff = statDiff($fetchCurrStats['Yards'], $yards);
        db_query("UPDATE `stats_passing_agg` SET Yards=Yards + '{$yardsDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_passing` SET Yards='{$yards}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['passTDs'] != '') {
        $TDs = $_POST['passTDs'];
        $TDDiff = statDiff($fetchCurrStats['TDs'], $TDs);
        db_query("UPDATE `stats_passing_agg` SET TDs=TDs + '{$TDDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_passing` SET TDs='{$TDs}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['passINTs'] != '') {
        $INTs = $_POST['passINTs'];
        $INTDiff = statDiff($fetchCurrStats['INTs'], $INTs);
        db_query("UPDATE `stats_passing_agg` SET INTs=INTs + '{$INTDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_passing` SET INTs='{$INTs}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
}


if ($Category === 'rushing') {

    $getCurrStats = db_query("SELECT * FROM `stats_rushing` WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    $fetchCurrStats = $getCurrStats->fetch_assoc();

    if ($_POST['rushAtt'] != '') {
        $att = $_POST['rushAtt'];
        $attDiff = statDiff($fetchCurrStats['Att'], $att);
        db_query("UPDATE `stats_rushing_agg` SET Att=Att + '{$attDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_rushing` SET Att='{$att}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['rushYards'] != '') {
        $yards = $_POST['rushYards'];
        $yardDiff = statDiff($fetchCurrStats['Yards'], $yards);
        db_query("UPDATE `stats_rushing_agg` SET Yards=Yards + '{$yardDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_rushing` SET Yards='{$yards}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['rushTDs'] != '') {
        $TDs = $_POST['rushTDs'];
        $TDDiff = statDiff($fetchCurrStats['TDs'], $TDs);
        db_query("UPDATE `stats_rushing_agg` SET TDs=TDs + '{$TDDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_rushing` SET TDs='{$TDs}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
}


if ($Category === 'rec') {

    $getCurrStats = db_query("SELECT * FROM `stats_rec` WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    $fetchCurrStats = $getCurrStats->fetch_assoc();

    if ($_POST['recRec'] != '') {
        $rec = $_POST['recRec'];
        $recDiff = statDiff($fetchCurrStats['Rec'], $rec);
        db_query("UPDATE `stats_rec_agg` SET Rec=Rec + '{$recDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_rec` SET Rec='{$rec}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['recYards'] != '') {
        $yards = $_POST['recYards'];
        $yardsDiff = statDiff($fetchCurrStats['Yards'], $yards);
        db_query("UPDATE `stats_rec_agg` SET Yards=Yards + '{$yardsDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_rec` SET Yards='{$yards}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['recTDs'] != '') {
        $TDs = $_POST['recTDs'];
        $TDDiff = statDiff($fetchCurrStats['TDs'], $TDs);
        db_query("UPDATE `stats_rec_agg` SET TDs=TDs + '{$TDDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_rec` SET TDs='{$TDs}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
}

if ($Category === 'def') {

    $getCurrStats = db_query("SELECT * FROM `stats_def` WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    $fetchCurrStats = $getCurrStats->fetch_assoc();

    if ($_POST['defTak'] != '') {
        $tak = $_POST['defTak'];
        $takDiff = statDiff($fetchCurrStats['Tackles'], $tak);
        db_query("UPDATE `stats_def_agg` SET Tackles=Tackles + '{$takDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_def` SET Tackles='{$tak}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['defLoss'] != '') {
        $loss = $_POST['defLoss'];
        $lossDiff = statDiff($fetchCurrStats['ForLoss'], $loss);
        db_query("UPDATE `stats_def_agg` SET ForLoss=ForLoss + '{$lossDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_def` SET ForLoss='{$loss}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['defSack'] != '') {
        $sack = $_POST['defSack'];
        $sackDiff = statDiff($fetchCurrStats['Sacks'], $sack);
        db_query("UPDATE `stats_def_agg` SET Sacks=Sacks + '{$sackDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_def` SET Sacks='{$sack}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['defINTs'] != '') {
        $INTs = $_POST['defINTs'];
        $INTsDiff = statDiff($fetchCurrStats['INTs'], $INTs);
        db_query("UPDATE `stats_def_agg` SET INTs=INTs + '{$INTsDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_def` SET INTs='{$INTs}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['defINTTDs'] != '') {
        $INTTDs = $_POST['defINTTDs'];
        $INTTDsDiff = statDiff($fetchCurrStats['INT_TDs'], $INTTDs);
        db_query("UPDATE `stats_def_agg` SET INT_TDs=INT_TDs + '{$INTTDsDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_def` SET INT_TDs='{$INTTDs}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['defPassDef'] != '') {
        $passdef = $_POST['defPassDef'];
        $takDiff = statDiff($fetchCurrStats['Tackles'], $tak);
        db_query("UPDATE `stats_def_agg` SET Tackles=Tackles + '{$takDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_def` SET PassDef='{$passdef}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['defQBHurries'] != '') {
        $hurries = $_POST['defQBHurries'];
        $hurriesDiff = statDiff($fetchCurrStats['QBHurries'], $hurries);
        db_query("UPDATE `stats_def_agg` SET QBHurries=QBHurries + '{$hurriesDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_def` SET QBHurries='{$hurries}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['defFumRec'] != '') {
        $rec = $_POST['defFumRec'];
        $recDiff = statDiff($fetchCurrStats['FumbleRec'], $rec);
        db_query("UPDATE `stats_def_agg` SET FumbleRec=FumbleRec + '{$recDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_def` SET FumbleRec='{$rec}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['defFumTDs'] != '') {
        $TDs = $_POST['defFumTDs'];
        $fumTDsDiff = statDiff($fetchCurrStats['FumbleTDs'], $TDs);
        db_query("UPDATE `stats_def_agg` SET FumbleTDs=FumbleTDs + '{$fumTDsDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_def` SET FumbleTDs='{$TDs}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
}

if ($Category === 'ret') {

    $getCurrStats = db_query("SELECT * FROM `stats_ret` WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    $fetchCurrStats = $getCurrStats->fetch_assoc();

    if ($_POST['retKRRet'] != '') {
        $returns = $_POST['retKRRet'];
        $returnsDiff = statDiff($fetchCurrStats['KR_Ret'], $returns);
        db_query("UPDATE `stats_ret_agg` SET KR_Ret=KR_Ret + '{$returnsDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_ret` SET KR_Ret='{$returns}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['retKRYards'] != '') {
        $yards = $_POST['retKRYards'];
        $yardsDiff = statDiff($fetchCurrStats['KR_Yards'], $yards);
        db_query("UPDATE `stats_ret_agg` SET KR_Yards=KR_Yards + '{$yardsDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_ret` SET KR_Yards='{$yards}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['retKRRetTDs'] != '') {
        $TDs = $_POST['retKRRetTDs'];
        $TDsDiff = statDiff($fetchCurrStats['KR_TDs'], $TDs);
        db_query("UPDATE `stats_ret_agg` SET KR_TDs=KR_TDs + '{$TDsDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_ret` SET KR_TDs='{$TDs}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['retPRRet'] != '') {
        $returns = $_POST['retPRRet'];
        $returnsDiff = statDiff($fetchCurrStats['PR_Ret'], $returns);
        db_query("UPDATE `stats_ret_agg` SET PR_Ret=PR_Ret + '{$returnsDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_ret` SET PR_Ret='{$returns}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['retPRRetYards'] != '') {
        $yards = $_POST['retPRRetYards'];
        $yardsDiff = statDiff($fetchCurrStats['PR_Yards'], $yards);
        db_query("UPDATE `stats_ret_agg` SET PR_Yards=PR_Yards + '{$yardsDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_ret` SET PR_Yards='{$yards}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['retPRRetTDs'] != '') {
        $TDs = $_POST['retPRRetTDs'];
        $TDsDiff = statDiff($fetchCurrStats['PR_TDs'], $TDs);
        db_query("UPDATE `stats_ret_agg` SET PR_TDs=PR_TDs + '{$TDsDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_ret` SET PR_TDs='{$TDs}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
}

if ($Category === 'kicking') {

    $getCurrStats = db_query("SELECT * FROM `stats_kicking` WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    $fetchCurrStats = $getCurrStats->fetch_assoc();

    $seasonID = getSeasonIDbyGameID($gameID);
    $getCurrStatsAgg = db_query("SELECT * FROM `stats_kicking_agg` WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
    $fetchCurrStatsAgg = $getCurrStats->fetch_assoc();

    if ($_POST['kickXPM'] != '') {
        $XPM = $_POST['kickXPM'];
        $XPMDiff = statDiff($fetchCurrStats['XPM'], $XPM);
        db_query("UPDATE `stats_kicking_agg` SET XPM=XPM + '{$XPMDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_kicking` SET XPM='{$XPM}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['kickXPA'] != '') {
        $XPA = $_POST['kickXPA'];
        $XPADiff = statDiff($fetchCurrStats['XPA'], $XPA);
        db_query("UPDATE `stats_kicking_agg` SET XPA=XPA + '{$XPADiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_kicking` SET XPA='{$XPA}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['kickFGM'] != '') {
        $FGM = $_POST['kickFGM'];
        $FGMDiff = statDiff($fetchCurrStats['FGM'], $FGM);
        db_query("UPDATE `stats_kicking_agg` SET FGM=FGM + '{$FGMDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_kicking` SET FGM='{$FGM}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['kickFGA'] != '') {
        $FGA = $_POST['kickFGA'];
        $FGADiff = statDiff($fetchCurrStats['FGA'], $FGA);
        db_query("UPDATE `stats_kicking_agg` SET FGA=FGA + '{$FGADiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_kicking` SET FGA='{$FGA}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['kickLong'] != '') {
        $Long = $_POST['kickLong'];
        $LongKickKeep = longKeep($fetchCurrStatsAgg['LongKick'], $Long);
        db_query("UPDATE `stats_kicking_agg` SET LongKick='{$LongKickKeep}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_kicking` SET LongKick='{$Long}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
}

if ($Category === 'punting') {

    $getCurrStats = db_query("SELECT * FROM `stats_punting` WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    $fetchCurrStats = $getCurrStats->fetch_assoc();

    $seasonID = getSeasonIDbyGameID($gameID);
    $getCurrStatsAgg = db_query("SELECT * FROM `stats_punting_agg` WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
    $fetchCurrStatsAgg = $getCurrStats->fetch_assoc();

    if ($_POST['puntAtt'] != '') {
        $attempts = $_POST['puntAtt'];
        $attemptsDiff = statDiff($fetchCurrStats['Att'], $attempts);
        db_query("UPDATE `stats_punting_agg` SET Att=Att + '{$attemptsDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_punting` SET Att='{$attempts}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['puntYards'] != '') {
        $yards = $_POST['puntYards'];
        $yardsDiff = statDiff($fetchCurrStats['Yards'], $yards);
        db_query("UPDATE `stats_punting_agg` SET Yards=Yards + '{$yardsDiff}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_punting` SET Yards='{$yards}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['puntLong'] != '') {
        $Long = $_POST['puntLong'];
        $LongKickKeep = longKeep($fetchCurrStatsAgg['LongKick'], $Long);
        db_query("UPDATE `stats_punting_agg` SET LongPunt='{$LongKickKeep}' WHERE Season_ID='{$seasonID}' AND Player_ID='{$playerID}'");
        db_query("UPDATE `stats_punting` SET LongPunt='{$Long}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
}

function statDiff($existingStat, $newStat) {

    $diff = $newStat - $existingStat;
    return $diff;
}

function longKeep($existingLong, $NewLong) {

    if ($existingLong < $NewLong) {
        return $NewLong;
    } else {
        return $existingLong;
    }
}
