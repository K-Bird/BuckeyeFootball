<?php

include ("../../libs/db/common_db_functions.php");
/*
  take a player master ID or game ID and create a player tag with it
 */

$type = $_POST['type'];

if ($type === 'game') {
    
    $gameID = $_POST['gameID'];
    
    $getGameData = db_query("SELECT * FROM `games` WHERE GM_ID='{$gameID}'");
    $fetchGameData = $getGameData->fetch_assoc();
    
    echo '&nbsp;<span class="badge badge-pill badge-secondary">';
    echo $fetchGameData['Date'] . " " . opponentLookup($fetchGameData['Vs']);
    echo '&nbsp;<span aria-hidden="true" id="', $gameID, '" class="gameUploadTagRemovev">&times;</span>';
    echo '</span>&nbsp;';
    
}

if ($type === 'misc') {

    $miscID = $_POST['miscID'];
    
    $getMiscData = db_query("SELECT * FROM `ref_misc_video_tags` WHERE Tag_ID='{$miscID}'");
    $fetchMiscData = $getMiscData->fetch_assoc();

    echo '&nbsp;<span class="badge badge-pill badge-secondary">';
    echo $fetchMiscData['Tag_Name'];
    echo '&nbsp;<span aria-hidden="true" id="', $miscID, '" class="miscUploadTagRemovev">&times;</span>';
    echo '</span>&nbsp;';
}
