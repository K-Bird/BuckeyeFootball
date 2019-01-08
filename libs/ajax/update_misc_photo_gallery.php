<?php

include ("../../libs/db/common_db_functions.php");

$misc_tag = $_POST['misc_tag'];

$setPlayerPhotoControl = db_query("UPDATE `controls` SET Value='{$misc_tag}' WHERE Control='photo_misc_id'");

echo buildMiscPhotoGallery($misc_tag);