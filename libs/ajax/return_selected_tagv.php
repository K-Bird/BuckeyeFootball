<?php

include ("../../libs/db/common_db_functions.php");

$type = $_POST['type'];
$video_id = $_POST['video_id'];

if ($type === 'game') {
    
    $gameID = $_POST['gameID'];
    
    $getGameData = db_query("SELECT * FROM `games` WHERE GM_ID='{$gameID}'");
    $fetchGameData = $getGameData->fetch_assoc();
    
    echo '&nbsp;<span class="badge badge-pill badge-secondary">';
    echo $fetchGameData['Date'] . " " . opponentLookup($fetchGameData['Vs']);
    echo '&nbsp;<span aria-hidden="true" class="gameTagRemovev" data-tag="', $gameID, '" data-videoid="', $video_id, '">&times;</span>';
    echo '</span>&nbsp;';
    
}

if ($type === 'misc') {

    $miscID = $_POST['miscID'];
    
    $getMiscData = db_query("SELECT * FROM `ref_misc_video_tags` WHERE Tag_ID='{$miscID}'");
    $fetchMiscData = $getMiscData->fetch_assoc();

    echo '&nbsp;<span class="badge badge-pill badge-secondary">';
    echo $fetchMiscData['Tag_Name'];
    echo '&nbsp;<span aria-hidden="true" class="miscTagRemovev" data-tag="', $miscID, '" data-videoid="', $video_id, '">&times;</span>';
    echo '</span>&nbsp;';
}
