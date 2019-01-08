<?php

include ("../../libs/db/common_db_functions.php");

$getPhotoMiscID = db_query('SELECT * FROM `controls` WHERE Control="photo_misc_id"');
$fetchPhotoMiscID = $getPhotoMiscID->fetch_assoc();
$value = $fetchPhotoMiscID['Value'];

echo $value;