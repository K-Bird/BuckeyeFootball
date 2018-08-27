<?php
include ("../../libs/db/common_db_functions.php");

$getEditStatGameID = db_query("SELECT * FROM `controls` WHERE Control='input_edit_stat_GM_ID'");
$fetchEditStatGameID = $getEditStatGameID->fetch_assoc();
$GameID = $fetchEditStatGameID['Value'];

$getEditStatPlayerID = db_query("SELECT * FROM `controls` WHERE Control='input_edit_stat_Player_ID'");
$fetchEditStatPlayerID = $getEditStatPlayerID->fetch_assoc();
$PlayerID = $fetchEditStatPlayerID['Value'];

$getEditStatCategory = db_query("SELECT * FROM `controls` WHERE Control='input_edit_stat_category'");
$fetchEditStatCategory = $getEditStatCategory->fetch_assoc();
$Category = $fetchEditStatCategory['Value'];

$getPlayerGameStats = db_query("SELECT * FROM `stats_{$Category}` WHERE Game_ID='{$GameID}' AND Player_ID='{$PlayerID}'");
$fetchPlayerGameStats = $getPlayerGameStats->fetch_assoc();

if ($Category === 'passing') {
    include ('editStatTables/input_edit_stat_table_passing.php');
}
if ($Category === 'rushing') {
    include ('editStatTables/input_edit_stat_table_rushing.php');
}
if ($Category === 'rec') {
    include ('editStatTables/input_edit_stat_table_rec.php');
}
if ($Category === 'def') {
    include ('editStatTables/input_edit_stat_table_def.php');
}
if ($Category === 'ret') {
    include ('editStatTables/input_edit_stat_table_ret.php');
}
if ($Category === 'kicking') {
    include ('editStatTables/input_edit_stat_table_kicking.php');
}
if ($Category === 'punting') {
    include ('editStatTables/input_edit_stat_table_punting.php');
}
?>