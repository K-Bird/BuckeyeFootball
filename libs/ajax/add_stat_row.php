<?php

include ("../../libs/db/common_db_functions.php");

$gameID = $_POST['GM_ID'];
$playerID = $_POST['Player_ID'];

if (isset($_POST['statCategory'])) {
    $Category = $_POST['statCategory'];
}

if ($Category === 'pass') {

    if (isset($_POST['passComp'])) {
        $completions = $_POST['passComp'];
    }
    if (isset($_POST['passAtt'])) {
        $attempts = $_POST['passAtt'];
    }
    if (isset($_POST['passYards'])) {
        $yards = $_POST['passYards'];
    }
    if (isset($_POST['passTDs'])) {
        $TDs = $_POST['passTDs'];
    }
    if (isset($_POST['passINTs'])) {
        $INTs = $_POST['passINTs'];
    }
    if (isset($_POST['passRate'])) {
        $rate = $_POST['passRate'];
    }

    db_query("INSERT INTO `stats_passing` (Game_ID, Player_ID, Comp, Att, Yards, TDs, INTs, Rate) VALUES ('{$gameID}','{$playerID}','{$completions}','{$attempts}','{$yards}','{$TDs}','{$INTs}','{$rate}')");
}

if ($Category === 'rush') {

    if (isset($_POST['rushAtt'])) {
        $attempts = $_POST['rushAtt'];
    }
    if (isset($_POST['rushYards'])) {
        $yards = $_POST['rushYards'];
    }
    if (isset($_POST['rushTDs'])) {
        $TDs = $_POST['rushTDs'];
    }

    db_query("INSERT INTO `stats_rushing` (Game_ID, Player_ID, Att, Yards, TDs) VALUES ('{$gameID}','{$playerID}','{$attempts}','{$yards}','{$TDs}')");
}

if ($Category === 'rec') {

    if (isset($_POST['recRec'])) {
        $rec = $_POST['recRec'];
    }
    if (isset($_POST['recYards'])) {
        $yards = $_POST['recYards'];
    }
    if (isset($_POST['recTDs'])) {
        $TDs = $_POST['recTDs'];
    }

    db_query("INSERT INTO `stats_rec` (Game_ID, Player_ID, Rec, Yards, TDs) VALUES ('{$gameID}','{$playerID}','{$rec}','{$yards}','{$TDs}')");
}

if ($Category === 'def') {

    if (isset($_POST['defTak'])) {
        $tak = $_POST['defTak'];
    }
    if (isset($_POST['defLoss'])) {
        $loss = $_POST['defLoss'];
    }
    if (isset($_POST['defSack'])) {
        $sacks = $_POST['defSack'];
    }
    if (isset($_POST['defINTs'])) {
        $INTs = $_POST['defINTs'];
    }
    if (isset($_POST['defINTTDs'])) {
        $INTTDs = $_POST['defINTTDs'];
    }
    if (isset($_POST['defPassDef'])) {
        $PassDef = $_POST['defPassDef'];
    }
    if (isset($_POST['defQBHurries'])) {
        $Hurries = $_POST['defQBHurries'];
    }
    if (isset($_POST['defFumRec'])) {
        $FumRec = $_POST['defFumRec'];
    }
    if (isset($_POST['defFumTDs'])) {
        $FumTDs = $_POST['defFumTDs'];
    }

    db_query("INSERT INTO `stats_def` (Game_ID, Player_ID, Tackles, ForLoss, Sacks, INTs, INT_TDs, PassDef, QBHurries, FumbleRec, FumbleTDs)
            VALUES ('{$gameID}','{$playerID}','{$tak}','{$loss}','{$sacks}','{$INTs}','{$INTTDs}','{$PassDef}','{$Hurries}','{$FumRec}','{$FumTDs}')");
}

if ($Category === 'ret') {

    if (isset($_POST['retKRRet'])) {
        $KRreturns = $_POST['retKRRet'];
    }
    if (isset($_POST['retKRYards'])) {
        $KRyards = $_POST['retKRYards'];
    }
    if (isset($_POST['retKRRetTDs'])) {
        $KRTDs = $_POST['retKRRetTDs'];
    }
    if (isset($_POST['retPRRet'])) {
        $PRreturns = $_POST['retPRRet'];
    }
    if (isset($_POST['retPRRetYards'])) {
        $PRyards = $_POST['retPRRetYards'];
    }
    if (isset($_POST['retPRRetTDs'])) {
        $PRTDs = $_POST['retPRRetTDs'];
    }
  
    db_query("INSERT INTO `stats_ret` (Game_ID, Player_ID, KR_Ret, KR_Yards, KR_TDs, PR_Ret, PR_Yards, PR_TDs)
            VALUES ('{$gameID}','{$playerID}','{$KRreturns}','{$KRyards}','{$KRTDs}','{$PRreturns}','{$PRyards}','{$PRTDs}')");
}

if ($Category === 'kick') {

    if (isset($_POST['kickXPM'])) {
        $XPM = $_POST['kickXPM'];
    }
    if (isset($_POST['kickXPA'])) {
        $XPA = $_POST['kickXPA'];
    }
    if (isset($_POST['kickFGM'])) {
        $FGM= $_POST['kickFGM'];
    }
    if (isset($_POST['kickFGA'])) {
        $FGA = $_POST['kickFGA'];
    }
  
    db_query("INSERT INTO `stats_kicking` (Game_ID, Player_ID, XPA, XPM, FGA, FGM)
            VALUES ('{$gameID}','{$playerID}','{$XPA}','{$XPM}','{$FGA}','{$FGM}')");
}

if ($Category === 'punt') {

    if (isset($_POST['puntAtt'])) {
        $Attempts = $_POST['puntAtt'];
    }
    if (isset($_POST['puntYards'])) {
        $Yards = $_POST['puntYards'];
    }
  
    db_query("INSERT INTO `stats_punting` (Game_ID, Player_ID, Att, Yards)
            VALUES ('{$gameID}','{$playerID}','{$Attempts}','{$Yards}')");
}