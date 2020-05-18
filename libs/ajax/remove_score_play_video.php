<?php

include ("../../libs/db/common_db_functions.php");

$Play_ID = $_POST['new_play'];

db_query("UPDATE `games_scoring_plays` SET video_ID = '0' WHERE Play_ID='{$Play_ID}'");