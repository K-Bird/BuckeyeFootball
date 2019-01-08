<?php

include ("../../libs/db/common_db_functions.php");

$gameID = $_POST['gameID'];
$photo_id = $_POST['photo_id'];

//get all existing game tags for the photo ID
$getPhotoTags = db_query("SELECT * FROM `photos` WHERE Photo_ID='{$photo_id}'");
$fetchPhototag = $getPhotoTags->fetch_assoc();

$gameTags = $fetchPhototag['Game_Tags'];
$eachGameTag = explode(',', $gameTags);

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

db_query("Update `Photos` SET Game_Tags ='{$reloadedTags}' WHERE Photo_ID='{$photo_id}'");

$getGameData = db_query("SELECT * FROM `games` WHERE GM_ID='{$gameID}'");
$fetchGameData = $getGameData->fetch_assoc();

echo '&nbsp;<span class="badge badge-pill badge-secondary">';
echo $fetchGameData['Date'] . " " . opponentLookup($fetchGameData['Vs']);
echo '&nbsp;<span aria-hidden="true" id="', $gameID, '">&times;</span>';
echo '</span>&nbsp;';
