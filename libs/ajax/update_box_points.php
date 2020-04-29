<?php
include ("../../libs/db/common_db_functions.php");

$Game_ID = $_POST['Game_ID'];
$value = $_POST['value'];
$field = $_POST['field'];

db_query("UPDATE `games_box_scores` SET `{$field}`='{$value}' WHERE GM_ID='{$Game_ID}'");
