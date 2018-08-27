<?php

include ("../../libs/db/common_db_functions.php");

$gameID = $_POST['gameID'];
$playerID = $_POST['playerID'];
$category = $_POST['category'];


db_query("DELETE FROM `stats_{$category}` WHERE Player_ID='{$playerID}' AND Game_ID='{$gameID}'");

