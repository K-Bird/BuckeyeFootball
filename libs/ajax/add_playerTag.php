<?php

include ("../../libs/db/common_db_functions.php");

$playerID = $_POST['playerID'];
$photo_id = $_POST['photo_id'];

//get all existing player tags for the photo ID
$getPhotoTags = db_query("SELECT * FROM `photos` WHERE Photo_ID='{$photo_id}'");
$fetchPhototag = $getPhotoTags->fetch_assoc();

$playerTags = $fetchPhototag['Player_Tags'];
$eachPlayerTag = explode(',', $playerTags);

//push new tag into tag array
array_push($eachPlayerTag,$playerID);


//reload remaining tags
$reloadedTags = '';
$i = 1;
$tagCount = count($eachPlayerTag);

foreach ($eachPlayerTag as $tag) {
    if ($i < $tagCount) {
        $reloadedTags = $reloadedTags . $tag . ',';
    } else {
        $reloadedTags = $reloadedTags . $tag;
    }
    $i++;
}

db_query("Update `Photos` SET Player_Tags ='{$reloadedTags}' WHERE Photo_ID='{$photo_id}'");

echo '&nbsp;<span class="badge badge-pill badge-secondary">';
echo getPlayerFieldByMasterID('First_Name', $playerID) . " " . getPlayerFieldByMasterID('Last_Name', $playerID);
echo '&nbsp;<span aria-hidden="true">&times;</span>';
echo '</span>&nbsp;';
