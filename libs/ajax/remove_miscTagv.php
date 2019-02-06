<?php

include ("../../libs/db/common_db_functions.php");

$miscID = $_POST['miscID'];
$video_id = $_POST['video_id'];

//get all existing misc tags for the video ID
$getVideoTags = db_query("SELECT * FROM `videos` WHERE Video_ID='{$video_id}'");
$fetchVideotag = $getVideoTags->fetch_assoc();

$miscTags = $fetchVideotag['Misc_Tags'];
$eachMiscTag = explode(',', $miscTags);

//remove matching miscTag from array
$newMiscTags = array_diff($eachMiscTag, array($miscID));


//reload remaining tags
$reloadedTags = '';
$i = 1;
$tagCount = count($newMiscTags);

foreach ($newMiscTags as $tag) {
    if ($i < $tagCount) {
        $reloadedTags = $reloadedTags . $tag . ',';
    } else {
        $reloadedTags = $reloadedTags . $tag;
    }
    $i++;
}

db_query("Update `Videos` SET Misc_Tags ='{$reloadedTags}' WHERE Video_ID='{$video_id}'");