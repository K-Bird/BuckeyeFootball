<?php

include ("../../libs/db/common_db_functions.php");

$misc_tag = $_POST['misc_tag'];

$setPlayerVideoControl = db_query("UPDATE `controls` SET Value='misc' WHERE Control='video_display_type'");
$setPlayerVideoControl = db_query("UPDATE `controls` SET Value='{$misc_tag}' WHERE Control='video_misc_id'");