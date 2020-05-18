<?php

include ("../../libs/db/common_db_functions.php");

$Play_ID = $_POST['new_play'];
$Video_ID = $_POST['Video_ID'];

db_query("UPDATE `games_scoring_plays` SET video_ID = '{$Video_ID}' WHERE Play_ID='{$Play_ID}'");