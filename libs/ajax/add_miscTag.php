<?php

include ("../../libs/db/common_db_functions.php");

$miscID = $_POST['miscID'];
$photo_id = $_POST['photo_id'];

//get all existing misc tags for the photo ID
$getPhotoTags = db_query("SELECT * FROM `photos` WHERE Photo_ID='{$photo_id}'");
$fetchPhototag = $getPhotoTags->fetch_assoc();

$miscTags = $fetchPhototag['Misc_Tags'];
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

db_query("Update `Photos` SET Misc_Tags ='{$reloadedTags}' WHERE Photo_ID='{$photo_id}'");

echo '&nbsp;<span class="badge badge-pill badge-secondary">';
echo returnMiscTagNameByIDphoto($miscID);
echo '&nbsp;<span aria-hidden="true">&times;</span>';
echo '</span>&nbsp;';
