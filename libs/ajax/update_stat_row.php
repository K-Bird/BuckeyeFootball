<?php

include ("../../libs/db/common_db_functions.php");

$gameID = $_POST['GM_ID'];
$playerID = $_POST['Player_ID'];

if (isset($_POST['statCategory'])) {
    $Category = $_POST['statCategory'];
}

if ($Category === 'passing') {

    if ($_POST['passComp'] != '') {
        $completions = $_POST['passComp'];
        db_query("UPDATE `stats_passing` SET Comp='{$completions}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['passAtt'] != '') {
        $attempts = $_POST['passAtt'];
        db_query("UPDATE `stats_passing` SET Att='{$attempts}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['passYards'] != '') {
        $yards = $_POST['passYards'];
        db_query("UPDATE `stats_passing` SET Yards='{$yards}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['passTDs'] != '') {
        $TDs = $_POST['passTDs'];
        db_query("UPDATE `stats_passing` SET TDs='{$TDs}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['passINTs'] != '') {
        $INTs = $_POST['passINTs'];
        db_query("UPDATE `stats_passing` SET INTs='{$INTs}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['passRate'] != '') {
        $rate = $_POST['passRate'];
        db_query("UPDATE `stats_passing` SET Rate='{$rate}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
}


if ($Category === 'rushing') {

    if ($_POST['rushAtt'] != '') {
        $att = $_POST['rushAtt'];
        db_query("UPDATE `stats_rushing` SET Att='{$att}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['rushYards'] != '') {
        $yards = $_POST['rushYards'];
        db_query("UPDATE `stats_rushing` SET Yards='{$yards}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['rushTDs'] != '') {
        $TDs = $_POST['rushTDs'];
        db_query("UPDATE `stats_rushing` SET TDs='{$TDs}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
}


if ($Category === 'rec') {

    if ($_POST['recRec'] != '') {
        $rec = $_POST['recRec'];
        db_query("UPDATE `stats_rec` SET Rec='{$rec}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['recYards'] != '') {
        $yards = $_POST['recYards'];
        db_query("UPDATE `stats_rec` SET Yards='{$yards}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['recTDs'] != '') {
        $TDs = $_POST['recTDs'];
        db_query("UPDATE `stats_rec` SET TDs='{$TDs}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
}

if ($Category === 'def') {
    if ($_POST['defTak'] != '') {
        $tak = $_POST['defTak'];
        db_query("UPDATE `stats_def` SET Tackles='{$tak}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['defLoss'] != '') {
        $loss = $_POST['defLoss'];
        db_query("UPDATE `stats_def` SET ForLoss='{$loss}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['defSack'] != '') {
        $sack = $_POST['defSack'];
        db_query("UPDATE `stats_def` SET Sacks='{$sack}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['defINTs'] != '') {
        $INTs = $_POST['defINTs'];
        db_query("UPDATE `stats_def` SET INTs='{$INTs}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['defINTTDs'] != '') {
        $INTTDs = $_POST['defINTTDs'];
        db_query("UPDATE `stats_def` SET INT_TDs='{$INTTDs}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['defPassDef'] != '') {
        $passdef = $_POST['defPassDef'];
        db_query("UPDATE `stats_def` SET PassDef='{$passdef}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['defQBHurries'] != '') {
        $hurries = $_POST['defQBHurries'];
        db_query("UPDATE `stats_def` SET QBHurries='{$hurries}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['defFumRec'] != '') {
        $rec = $_POST['defFumRec'];
        db_query("UPDATE `stats_def` SET FumbleRec='{$rec}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['defFumTDs'] != '') {
        $TDs = $_POST['defFumTDs'];
        db_query("UPDATE `stats_def` SET FumbleTDs='{$TDs}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
}

if ($Category === 'ret') {
    if ($_POST['retKRRet'] != '') {
        $returns = $_POST['retKRRet'];
        db_query("UPDATE `stats_ret` SET KR_Ret='{$returns}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['retKRYards'] != '') {
        $yards = $_POST['retKRYards'];
        db_query("UPDATE `stats_ret` SET KR_Yards='{$yards}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['retKRRetTDs'] != '') {
        $TDs = $_POST['retKRRetTDs'];
        db_query("UPDATE `stats_ret` SET KR_TDs='{$TDs}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['retPRRet'] != '') {
        $returns = $_POST['retPRRet'];
        db_query("UPDATE `stats_ret` SET PR_Ret='{$returns}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['retPRRetYards'] != '') {
        $yards = $_POST['retPRRetYards'];
        db_query("UPDATE `stats_ret` SET PR_Yards='{$yards}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['retPRRetTDs'] != '') {
        $TDs = $_POST['retPRRetTDs'];
        db_query("UPDATE `stats_ret` SET PR_TDs='{$TDs}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
}

if ($Category === 'kicking') {
    if ($_POST['kickXPM'] != '') {
        $XPM = $_POST['kickXPM'];
        db_query("UPDATE `stats_kicking` SET XPM='{$XPM}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['kickXPA'] != '') {
        $XPA = $_POST['kickXPA'];
        db_query("UPDATE `stats_kicking` SET XPA='{$XPA}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['kickFGM'] != '') {
        $FGM = $_POST['kickFGM'];
        db_query("UPDATE `stats_kicking` SET FGM='{$FGM}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['kickFGA'] != '') {
        $FGA = $_POST['kickFGA'];
        db_query("UPDATE `stats_kicking` SET FGA='{$FGA}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['kickLong'] != '') {
        $Long = $_POST['kickLong'];
        db_query("UPDATE `stats_kicking` SET LongKick='{$Long}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
}

if ($Category === 'punting') {
    if ($_POST['puntAtt'] != '') {
        $attempts = $_POST['puntAtt'];
        db_query("UPDATE `stats_punting` SET Att='{$attempts}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['puntYards'] != '') {
        $yards = $_POST['puntYards'];
        db_query("UPDATE `stats_punting` SET Yards='{$yards}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
    if ($_POST['puntLong'] != '') {
        $Long = $_POST['puntLong'];
        db_query("UPDATE `stats_punting` SET LongPunt='{$Long}' WHERE Game_ID='{$gameID}' AND Player_ID='{$playerID}'");
    }
}
 