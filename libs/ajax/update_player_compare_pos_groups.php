<?php

include ("../../libs/db/common_db_functions.php");

$position = $_POST['position'];
$change = $_POST['change'];

//get current position groups
$getPosGroups = db_query("SELECT * FROM `controls` WHERE Control='player_compare_pos_groups'");
$fetchPosGroups = $getPosGroups->fetch_assoc();

$posGroups = $fetchPosGroups['Value'];
$eachPosGroup = explode(',',$posGroups);

$index = array_search('',$eachPosGroup);
if($index !== FALSE){
    unset($eachPosGroup[$index]);
}

//If the change is adding the position group
if ($change === 'Check') {
    //push new pos group into tag array
array_push($eachPosGroup, $position);
}
if ($change === 'Uncheck') {
    //remove unchecked pos group from array
    $eachPosGroup = array_diff($eachPosGroup, array($position));
}

//reload remaining pos groups
$reloadedGroups = '';
$i = 1;
$groupCount = count($eachPosGroup);

foreach ($eachPosGroup as $pos) {
    if ($i < $groupCount) {
        $reloadedGroups = $reloadedGroups . $pos . ',';
    } else {
        $reloadedGroups = $reloadedGroups . $pos;
    }
    $i++;
}

db_query("Update `controls` SET Value='{$reloadedGroups}' WHERE Control='player_compare_pos_groups'");
