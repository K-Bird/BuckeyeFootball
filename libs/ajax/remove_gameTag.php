<?php

include ("../../libs/db/common_db_functions.php");

$gameID = $_POST['gameID'];
$photo_id = $_POST['photo_id'];

//get all existing game tags for the photo ID
$getPhotoTags = db_query("SELECT * FROM `photos` WHERE Photo_ID='{$photo_id}'");
$fetchPhototag = $getPhotoTags->fetch_assoc();

$gameTags = $fetchPhototag['Game_Tags'];
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

db_query("Update `Photos` SET Game_Tags ='{$reloadedTags}' WHERE Photo_ID='{$photo_id}'");

echo $gameID;