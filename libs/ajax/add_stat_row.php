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

    /* Check for and update aggregate passing stats */
    if (doesAggExist($playerID, $gameID, $Category) === true) {

        $seasonID = getSeasonIDbyGameID($gameID);
        db_query("Update `stats_passing_agg` SET Comp= Comp+ {$completions}, Att=Att + {$attempts}, Yards=Yards + {$yards}, TDs=TDs + {$TDs}, INTs=INTs + {$INTs} WHERE Player_ID={$playerID} AND Season_ID={$seasonID}");
    } else {
        $seasonID = getSeasonIDbyGameID($gameID);
        db_query("INSERT INTO `stats_passing_agg` (Player_ID, Season_ID, Comp, Att, Yards, TDs, INTs) VALUES ('{$playerID}','{$seasonID}','{$completions}','{$attempts}','{$yards}','{$TDs}','{$INTs}')");
    }
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

    /* Check for and update aggregate rushing stats */
    if (doesAggExist($playerID, $gameID, $Category) === true) {

        $seasonID = getSeasonIDbyGameID($gameID);
        db_query("Update `stats_rushing_agg` SET Att=Att + {$attempts}, Yards=Yards + {$yards}, TDs=TDs + {$TDs} WHERE Player_ID={$playerID} AND Season_ID={$seasonID}");
    } else {
        $seasonID = getSeasonIDbyGameID($gameID);
        db_query("INSERT INTO `stats_rushing_agg` (Player_ID, Season_ID, Att, Yards, TDs) VALUES ('{$playerID}','{$seasonID}','{$attempts}','{$yards}','{$TDs}')");
    }
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

    /* Check for and update aggregate receiving stats */
    if (doesAggExist($playerID, $gameID, $Category) === true) {

        $seasonID = getSeasonIDbyGameID($gameID);
        db_query("Update `stats_rec_agg` SET Rec=Rec + {$rec}, Yards=Yards + {$yards}, TDs=TDs + {$TDs} WHERE Player_ID={$playerID} AND Season_ID={$seasonID}");
    } else {
        $seasonID = getSeasonIDbyGameID($gameID);
        db_query("INSERT INTO `stats_rec_agg` (Player_ID, Season_ID, Rec, Yards, TDs) VALUES ('{$playerID}','{$seasonID}','{$rec}','{$yards}','{$TDs}')");
    }
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

    /* Check for and update aggregate defensive stats */
    if (doesAggExist($playerID, $gameID, $Category) === true) {

        $seasonID = getSeasonIDbyGameID($gameID);
        db_query("Update `stats_def_agg` SET Tackles=Tackles + {$tak}, ForLoss=ForLoss + {$loss}, Sacks=Sacks + {$sacks}, INTs=INTs + {$INTs}, INT_TDs=INT_TDs + {$INTTDs}, PassDef=PassDef + {$PassDef}, QBHurries=QBHurries + {$Hurries}, FumbleRec=FumbleRec + {$FumRec}, FumbleTDs = FumbleTDs+ {$FumTDs} WHERE Player_ID={$playerID} AND Season_ID={$seasonID}");
    } else {
        $seasonID = getSeasonIDbyGameID($gameID);
        db_query("INSERT INTO `stats_def_agg` (Player_ID, Season_ID, Tackles, ForLoss, Sacks, INTs, INT_TDs, PassDef, QBHurries, FumbleRec, FumbleTDs)
            VALUES ('{$playerID}','{$seasonID}','{$tak}','{$loss}','{$sacks}','{$INTs}','{$INTTDs}','{$PassDef}','{$Hurries}','{$FumRec}','{$FumTDs}')");
    }
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

    /* Check for and update aggregate return stats */
    if (doesAggExist($playerID, $gameID, $Category) === true) {

        $seasonID = getSeasonIDbyGameID($gameID);
        db_query("Update `stats_ret_agg` SET KR_Ret=KR_Ret + {$KRreturns}, KR_Yards=KR_Yards + {$KRyards}, KR_TDs=KR_TDs + {$KRTDs}, PR_Ret=PR_Ret + {$PRreturns}, PR_Yards=PR_Yards + {$PRyards}, PR_TDs=PR_TDs + {$PRTDs} WHERE Player_ID={$playerID} AND Season_ID={$seasonID}");
    } else {
        $seasonID = getSeasonIDbyGameID($gameID);
        db_query("INSERT INTO `stats_ret_agg` (Player_ID, Season_ID, KR_Ret, KR_Yards, KR_TDs, PR_Ret, PR_Yards, PR_TDs)
            VALUES ('{$playerID}','{$seasonID}','{$KRreturns}','{$KRyards}','{$KRTDs}','{$PRreturns}','{$PRyards}','{$PRTDs}')");
    }
}

if ($Category === 'kick') {

    if (isset($_POST['kickXPM'])) {
        $XPM = $_POST['kickXPM'];
    }
    if (isset($_POST['kickXPA'])) {
        $XPA = $_POST['kickXPA'];
    }
    if (isset($_POST['kickFGM'])) {
        $FGM = $_POST['kickFGM'];
    }
    if (isset($_POST['kickFGA'])) {
        $FGA = $_POST['kickFGA'];
    }
    if (isset($_POST['kickLong'])) {
        $Long = $_POST['kickLong'];
    }

    db_query("INSERT INTO `stats_kicking` (Game_ID, Player_ID, XPA, XPM, FGA, FGM, LongKick )
            VALUES ('{$gameID}','{$playerID}','{$XPA}','{$XPM}','{$FGA}','{$FGM}','{$Long}')");

    /* Check for and update aggregate kicking stats */
    if (doesAggExist($playerID, $gameID, $Category) === true) {

        $seasonID = getSeasonIDbyGameID($gameID);
        $getKickLong = db_query("SELECT * FROM `stats_kicking_agg` WHERE Player_ID={$playerID} AND Season_ID={$seasonID}");
        $fetchKickLong = $getKickLong->fetch_assoc();
        $currLongKick = $fetchKickLong['LongKick'];

        if ($currLongKick < $Long) {
            $LongKick = $Long;
        } else {
            $LongKick = $currLongKick;
        }

        db_query("Update `stats_kicking_agg` SET XPA=XPA + {$XPA}, XPM=XPM + {$XPM}, FGA=FGA + {$FGA}, FGM=FGM + {$FGM}, LongKick={$LongKick} WHERE Player_ID={$playerID} AND Season_ID={$seasonID}");
    } else {
        $seasonID = getSeasonIDbyGameID($gameID);
        db_query("INSERT INTO `stats_kicking_agg` (Player_ID, Season_ID, XPA, XPM, FGA, FGM, LongKick)
            VALUES ('{$playerID}','{$seasonID}','{$XPA}','{$XPM}','{$FGA}','{$FGM}','{$Long}')");
    }
}

if ($Category === 'punt') {

    if (isset($_POST['puntAtt'])) {
        $Attempts = $_POST['puntAtt'];
    }
    if (isset($_POST['puntYards'])) {
        $Yards = $_POST['puntYards'];
    }
    if (isset($_POST['puntLong'])) {
        $Long = $_POST['puntLong'];
    }

    db_query("INSERT INTO `stats_punting` (Game_ID, Player_ID, Att, Yards, LongPunt)
            VALUES ('{$gameID}','{$playerID}','{$Attempts}','{$Yards}','{$Long}')");

    /* Check for and update aggregate punting stats */
    if (doesAggExist($playerID, $gameID, $Category) === true) {

        $seasonID = getSeasonIDbyGameID($gameID);
        $getPuntLong = db_query("SELECT * FROM `stats_punting_agg` WHERE Player_ID={$playerID} AND Season_ID={$seasonID}");
        $fetchPuntLong = $getPuntLong->fetch_assoc();
        $currLongPunt = $fetchPuntLong['LongPunt'];

        if ($currLongPunt < $Long) {
            $LongPunt = $Long;
        } else {
            $LongPunt = $currLongPunt;
        }

        db_query("Update `stats_punting_agg` SET Att=Att + {$Attempts}, Yards=Yards + {$Yards}, LongPunt={$LongPunt} WHERE Player_ID={$playerID} AND Season_ID={$seasonID}");
    } else {
        $seasonID = getSeasonIDbyGameID($gameID);
        db_query("INSERT INTO `stats_punting_agg` (Player_ID, Season_ID, Att, Yards, LongPunt)
            VALUES ('{$playerID}','{$seasonID}','{$Attempts}','{$Yards}','{$Long}')");
    }
}

//Check if an aggregate stat row exists for the given stat category -- returns true or false
function doesAggExist($player, $game, $stat) {

    $seasonID = getSeasonIDbyGameID($game);

    if ($stat === 'pass') {
        $num_rows = mysqli_num_rows(db_query("SELECT * FROM `stats_passing_agg` WHERE Player_ID={$player} AND Season_ID={$seasonID}"));
        if ($num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    if ($stat === 'rush') {
        $num_rows = mysqli_num_rows(db_query("SELECT * FROM `stats_rushing_agg` WHERE Player_ID={$player} AND Season_ID={$seasonID}"));
        if ($num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    if ($stat === 'rec') {
        $num_rows = mysqli_num_rows(db_query("SELECT * FROM `stats_rec_agg` WHERE Player_ID={$player} AND Season_ID={$seasonID}"));
        if ($num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    if ($stat === 'def') {
        $num_rows = mysqli_num_rows(db_query("SELECT * FROM `stats_def_agg` WHERE Player_ID={$player} AND Season_ID={$seasonID}"));
        if ($num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    if ($stat === 'ret') {
        $num_rows = mysqli_num_rows(db_query("SELECT * FROM `stats_ret_agg` WHERE Player_ID={$player} AND Season_ID={$seasonID}"));
        if ($num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    if ($stat === 'kick') {
        $num_rows = mysqli_num_rows(db_query("SELECT * FROM `stats_kicking_agg` WHERE Player_ID={$player} AND Season_ID={$seasonID}"));
        if ($num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    if ($stat === 'punt') {
        $num_rows = mysqli_num_rows(db_query("SELECT * FROM `stats_punting_agg` WHERE Player_ID={$player} AND Season_ID={$seasonID}"));
        if ($num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}
