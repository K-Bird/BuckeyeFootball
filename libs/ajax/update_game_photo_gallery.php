<?php

include ("../../libs/db/common_db_functions.php");

$game_tag = $_POST['game_tag'];

$setPlayerPhotoControl = db_query("UPDATE `controls` SET Value='{$game_tag}' WHERE Control='photo_game_id'");

echo buildGamePhotoGallery($game_tag);