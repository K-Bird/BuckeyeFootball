<?php

include ("../../libs/db/common_db_functions.php");

$miscID = $_POST['miscID'];
$video_id = $_POST['video_id'];

//get all existing misc tags for the video ID
$getVideoTags = db_query("SELECT * FROM `videos` WHERE Video_ID='{$video_id}'");
$fetchVideotag = $getVideoTags->fetch_assoc();

$miscTags = $fetchVideotag['Misc_Tags'];
$eachMiscTag = explode(',', $miscTags);

$index = array_search('',$eachMiscTag);
if($index !== FALSE){
    unset($eachMiscTag[$index]);
}

//push new tag into tag array
array_push($eachMiscTag,$miscID);


//reload remaining tags
$reloadedTags = '';
$i = 1;
$tagCount = count($eachMiscTag);

foreach ($eachMiscTag as $tag) {
    if ($i < $tagCount) {
        $reloadedTags = $reloadedTags . $tag . ',';
    } else {
        $reloadedTags = $reloadedTags . $tag;
    }
    $i++;
}

db_query("Update `Videos` SET Misc_Tags ='{$reloadedTags}' WHERE Video_ID='{$video_id}'");

echo '&nbsp;<span class="badge badge-pill badge-secondary">';
echo returnMiscTagNameByIDvideo($miscID);
echo '&nbsp;<span aria-hidden="true">&times;</span>';
echo '</span>&nbsp;';
