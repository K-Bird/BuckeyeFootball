<?php

include ("../../libs/db/common_db_functions.php");

$player_tag = $_POST['player_tag'];

$setPlayerPhotoControl = db_query("UPDATE `controls` SET Value='{$player_tag}' WHERE Control='photo_player_id'");

echo buildPlayerPhotoGallery($player_tag);