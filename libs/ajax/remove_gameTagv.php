<?php

include ("../../libs/db/common_db_functions.php");

$gameID = $_POST['gameID'];
$video_id = $_POST['video_id'];

//get all existing game tags for the video ID
$getVideoTags = db_query("SELECT * FROM `videos` WHERE Video_ID='{$video_id}'");
$fetchVideotag = $getVideoTags->fetch_assoc();

$gameTags = $fetchVideotag['Game_Tags'];
$eachGameTag = explode(',', $gameTags);

//remove matching gameTag from array
$newGameTags = array_diff($eachGameTag, array($gameID));


//reload remaining tags
$reloadedTags = '';
$i = 1;
$tagCount = count($newGameTags);

foreach ($newGameTags as $tag) {
    if ($i < $tagCount) {
        $reloadedTags = $reloadedTags . $tag . ',';
    } else {
        $reloadedTags = $reloadedTags . $tag;
    }
    $i++;
}

db_query("Update `videos` SET Game_Tags ='{$reloadedTags}' WHERE Video_ID='{$video_id}'");