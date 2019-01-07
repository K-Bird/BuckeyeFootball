<?php

include ("../../libs/db/common_db_functions.php");

$miscID = $_POST['miscID'];
$photo_id = $_POST['photo_id'];

//get all existing misc tags for the photo ID
$getPhotoTags = db_query("SELECT * FROM `photos` WHERE Photo_ID='{$photo_id}'");
$fetchPhototag = $getPhotoTags->fetch_assoc();

$miscTags = $fetchPhototag['Misc_Tags'];
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

db_query("Update `Photos` SET Misc_Tags ='{$reloadedTags}' WHERE Photo_ID='{$photo_id}'");

echo $miscID;
