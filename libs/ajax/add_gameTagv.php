<?php

include ("../../libs/db/common_db_functions.php");

$gameID = $_POST['gameID'];
$video_id = $_POST['video_id'];

//get all existing game tags for the video ID
$getVideoTags = db_query("SELECT * FROM `videos` WHERE Video_ID='{$video_id}'");
$fetchVideotag = $getVideoTags->fetch_assoc();

$gameTags = $fetchVideotag['Game_Tags'];
$eachGameTag = explode(',', $gameTags);

$index = array_search('',$eachGameTag);
if($index !== FALSE){
    unset($eachGameTag[$index]);
}


//push new tag into tag array
array_push($eachGameTag, $gameID);


//reload remaining tags
$reloadedTags = '';
$i = 1;
$tagCount = count($eachGameTag);

foreach ($eachGameTag as $tag) {
    if ($i < $tagCount) {
        $reloadedTags = $reloadedTags . $tag . ',';
    } else {
        $reloadedTags = $reloadedTags . $tag;
    }
    $i++;
}

db_query("Update `videos` SET Game_Tags ='{$reloadedTags}' WHERE Video_ID='{$video_id}'");

$getGameData = db_query("SELECT * FROM `games` WHERE GM_ID='{$gameID}'");
$fetchGameData = $getGameData->fetch_assoc();

echo '&nbsp;<span class="badge badge-pill badge-secondary">';
echo $fetchGameData['Date'] . " " . opponentLookup($fetchGameData['Vs']);
echo '&nbsp;<span class="gameTagRemovev" data-tag="', $gameID, '" data-video="', $video_id, '">&times;</span>';
echo '</span>&nbsp;';
