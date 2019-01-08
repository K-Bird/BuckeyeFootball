<?php

include ("../../libs/db/common_db_functions.php");

$getPhotoGameID = db_query('SELECT * FROM `controls` WHERE Control="photo_game_id"');
$fetchPhotoGameID = $getPhotoGameID->fetch_assoc();
$value = $fetchPhotoGameID['Value'];

echo $value;