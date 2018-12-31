<?php

include ("../../libs/db/common_db_functions.php");

$playerID = $_POST['playerID'];
$photo_id = $_POST['photo_id'];

//get all existing player tags for the photo ID
$getPhotoTags = db_query("SELECT * FROM `photos` WHERE Photo_ID='{$photo_id}'");
$fetchPhototag = $getPhotoTags->fetch_assoc();

$playerTags = $fetchPhototag['Player_Tags'];
$eachPlayerTag = explode(',', $playerTags);

//remove matching playerTag from array
$newPlayerTags = array_diff($eachPlayerTag, array($playerID));


//reload remaining tags
$reloadedTags = '';
$i = 1;
$tagCount = count($newPlayerTags);

foreach ($newPlayerTags as $tag) {
    if ($i < $tagCount) {
        $reloadedTags = $reloadedTags . $tag . ',';
    } else {
        $reloadedTags = $reloadedTags . $tag;
    }
    $i++;
}

db_query("Update `Photos` SET Player_Tags ='{$reloadedTags}' WHERE Photo_ID='{$photo_id}'");

echo $playerID;
