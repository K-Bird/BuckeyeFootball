<?php

include ("../../libs/db/common_db_functions.php");

$gmID = $_POST['gmID'];

db_query("DELETE FROM `games` WHERE GM_ID='{$gmID}'");

db_query("DELETE FROM `ref_game_lookup` WHERE GM_ID='{$gmID}'");