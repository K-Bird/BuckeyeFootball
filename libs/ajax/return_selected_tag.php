<?php

include ("../../libs/db/common_db_functions.php");
/*
  take a player master ID or game ID and create a player tag with it
 */

$type = $_POST['type'];

if ($type === 'player') {

    $playerID = $_POST['playerID'];

    echo '&nbsp;<span class="badge badge-pill badge-secondary">';
    echo getPlayerFieldByMasterID('First_Name', $playerID) . " " . getPlayerFieldByMasterID('Last_Name', $playerID);
    echo '&nbsp;<span aria-hidden="true" id="', $playerID, '" class="playerUploadTagRemove">&times;</span>';
    echo '</span>&nbsp;';
}

if ($type === 'game') {
    
    $gameID = $_POST['gameID'];
    
    $getGameData = db_query("SELECT * FROM `games` WHERE GM_ID='{$gameID}'");
    $fetchGameData = $getGameData->fetch_assoc();
    
    echo '&nbsp;<span class="badge badge-pill badge-secondary">';
    echo $fetchGameData['Date'] . " " . opponentLookup($fetchGameData['Vs']);
    echo '&nbsp;<span aria-hidden="true" id="', $gameID, '" class="gameUploadTagRemove">&times;</span>';
    echo '</span>&nbsp;';
    
}
