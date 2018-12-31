<?php

include ("../../libs/db/common_db_functions.php");

$getPhotoPlayerID = db_query('SELECT * FROM `controls` WHERE Control="photo_player_id"');
$fetchPhotoPlayerID = $getPhotoPlayerID->fetch_assoc();
$value = $fetchPhotoPlayerID['Value'];

echo $value;