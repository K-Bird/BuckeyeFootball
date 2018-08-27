<?php include ("../../libs/db/common_db_functions.php"); 

$player_row = $_POST['row'];
$newDepth = $_POST['newDepth'];
$PorS = $_POST['PorS'];

if ($PorS === 'Primary') {
    db_query("UPDATE `players` SET Depth ='{$newDepth}' WHERE Player_Row='{$player_row}'");
}
if ($PorS === 'Secondary') {
    db_query("UPDATE `players` SET Depth_2 ='{$newDepth}' WHERE Player_Row='{$player_row}'");
}


