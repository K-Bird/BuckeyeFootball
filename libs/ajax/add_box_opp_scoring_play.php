<?php

include ("../../libs/db/common_db_functions.php");

$Game_ID = $_POST['Game_ID'];
$Quarter = $_POST['q'];

if (isset($_POST['scoringPlayType'])) {
    $scoringPlayType= $_POST['scoringPlayType'];
}
if (isset($_POST['TimeLeft'])) {
    $TimeLeft = $_POST['TimeLeft'];
}
if (isset($_POST['scoreDistance'])) {
    $scoreDistance = $_POST['scoreDistance'];
}
if (isset($_POST['scorePoints'])) {
    $scorePoints = $_POST['scorePoints'];
}

db_query("INSERT INTO `games_scoring_plays` (GM_ID, OSU_OPP, Q, Time_Left, Play_Type, Scoring_Player, From_Player, Distance, Post_Play_Points) VALUES ('{$Game_ID}','OPP','{$Quarter}','{$TimeLeft}','{$scoringPlayType}','0','0','{$scoreDistance}','{$scorePoints}')");
