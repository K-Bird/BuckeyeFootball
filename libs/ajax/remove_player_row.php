<?php

include ("../../libs/db/common_db_functions.php");

$rowID = $_POST['playerRow'];
$PorS = $_POST['PorS'];

if ($PorS === 'Primary') {

    $Master_ID = returnPlayerMasterID($rowID);
    db_query("DELETE FROM `players` WHERE Player_Row='{$rowID}'");
    $checkForMasterID = db_query("SELECT * FROM `players` WHERE Player_Master_ID='{$Master_ID}'");
    if ($checkForMasterID->num_rows == 0) {
        db_query("DELETE FROM `ref_player_lookup` WHERE Player_Master_ID='{$Master_ID}'");
    }
}

if ($PorS === 'Secondary') {

    db_query("UPDATE `players` SET Position_2='' AND Depth_2=0 WHERE Player_Row='{$rowID}'");
}