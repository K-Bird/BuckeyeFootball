<?php

include ("../../libs/db/common_db_functions.php");

$date = $_POST['date'];

if (isset($_POST['num'])) {
    $num = $_POST['num'];
}
if (isset($_POST['photoID'])) {
    $photoID = $_POST['photoID'];
}

$search_type = $_POST['type'];

$returnFoundDates = db_query("SELECT * FROM `games` WHERE Date LIKE '%$date%' LIMIT 20");

if ($search_type === 'upload') {
    echo '<div id="gameTagResults">';
}

if ($search_type === 'existing') {
    echo '<div id="gameTagExistingResults' . $num . '">';
}


echo '<div class="list-group">';

while ($fetchFoundDates = $returnFoundDates->fetch_assoc()) {

    echo '<button id="', $fetchFoundDates['GM_ID'], '" type="button"';

    if ($search_type === 'upload') {
        echo ' class="gameTagListItem list-group-item list-group-item-action btn-sm">';
    }
    if ($search_type === 'existing') {
        echo ' class="gameTagListExistingItem list-group-item list-group-item-action btn-sm" data-photoID="' . $photoID . '" data-num="' . $num . '">';
    }

    echo $fetchFoundDates['Date'] . " - (" . HomeAwayLookup($fetchFoundDates ['H_A']) . ") Vs " . opponentLookup($fetchFoundDates['Vs']);

    echo '</button>';
}

echo '<div>';

echo '<div>';

