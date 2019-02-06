<?php

include ("../../libs/db/common_db_functions.php");

$game_tag = $_POST['game_tag'];

$setPlayerVideoControl = db_query("UPDATE `controls` SET Value='game' WHERE Control='video_display_type'");
$setPlayerVideoControl = db_query("UPDATE `controls` SET Value='{$game_tag}' WHERE Control='video_game_id'");