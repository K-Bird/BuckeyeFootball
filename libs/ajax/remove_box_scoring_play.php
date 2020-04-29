<?php

include ("../../libs/db/common_db_functions.php");

$play_ID = $_POST['play_ID'];

db_query("DELETE FROM `games_scoring_plays` WHERE Play_ID='{$play_ID}'");