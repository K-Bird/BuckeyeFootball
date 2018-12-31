<?php

include ("../../libs/db/common_db_functions.php");

$name = $_POST['name'];
if (isset($_POST['num'])) {
    $num = $_POST['num'];
}
if (isset($_POST['photoID'])) {
    $photoID = $_POST['photoID'];
}

$search_type = $_POST['type'];

$returnFoundNames = db_query("SELECT * FROM `ref_player_lookup` WHERE concat(First_Name, ' ', Last_Name) LIKE '%$name%' LIMIT 5");

if ($search_type === 'upload') {
    echo '<div id="playerTagResults">';
}

if ($search_type === 'existing') {
    echo '<div id="playerTagExistingResults' . $num . '">';
}


echo '<div class="list-group">';

while ($fetchFoundNames = $returnFoundNames->fetch_assoc()) {

    echo '<button id="', $fetchFoundNames['Player_Master_ID'], '" type="button"';

    if ($search_type === 'upload') {
        echo ' class="playerTagListItem list-group-item list-group-item-action btn-sm">';
    }
    if ($search_type === 'existing') {
        echo ' class="playerTagListExistingItem list-group-item list-group-item-action btn-sm" data-photoID="' . $photoID . '" data-num="' . $num . '">';
    }

    echo $fetchFoundNames['First_Name'] . " " . $fetchFoundNames ['Last_Name'] . " " . returnYearsPlayed($fetchFoundNames['Player_Master_ID']);

    echo '</button>';
}

echo '<div>';

echo '<div>';

