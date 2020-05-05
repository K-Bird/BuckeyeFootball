<?php

include ("../../libs/db/common_db_functions.php");

if (isset($_POST['game_tag'])) {
    $ID = $_POST['game_tag'];
}
if (isset($_POST['misc_tag'])) {
    $ID = $_POST['misc_tag'];
}

$type = $_POST['type'];

$setInputTypeVideoControl = db_query("UPDATE `controls` SET Value='{$type}' WHERE Control='video_display_type'");
$setInputIDVideoControl = db_query("UPDATE `controls` SET Value='{$ID}' WHERE Control='video_id'");
