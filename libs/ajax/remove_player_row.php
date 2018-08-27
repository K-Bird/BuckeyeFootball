<?php

include ("../../libs/db/common_db_functions.php");

$rowID = $_POST['playerRow'];
$PorS = $_POST['PorS'];

if ($PorS === 'Primary') {

    db_query("DELETE FROM `players` WHERE Player_Row='{$rowID}'");
}

if ($PorS === 'Secondary') {

    db_query("UPDATE `players` SET Position_2='' AND Depth_2=0 WHERE Player_Row='{$rowID}'");
}