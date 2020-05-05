<?php

include ("../../libs/db/common_db_functions.php");

$year = $_POST['year'];
$opp = $_POST['opp'];
$loc = $_POST['loc'];

if (isset($_POST['videoID'])) {
    $videoID = $_POST['videoID'];
}

$search_type = $_POST['type'];

$returnFoundGames = db_query("SELECT * FROM `ref_game_lookup` WHERE Date LIKE '%$year%' AND Opp LIKE '%$opp%' AND Loc LIKE '%$loc%' LIMIT 10");

if ($search_type === 'upload') {
    echo '<div id="gameTagResultsv">';
}

if ($search_type === 'existing') {
    echo '<div id="existingGameTagResultsv' . $videoID . '" class="editAddGameTagResultsv" data-videoID="' . $videoID . '">';
}


echo '<div class="list-group">';

while ($fetchFoundGames = $returnFoundGames->fetch_assoc()) {
    
    $getGameData = db_query("SELECT * FROM `games` WHERE GM_ID={$fetchFoundGames['GM_ID']}");
    $fetchGameData = $getGameData->fetch_assoc();

    echo '<button id="', $fetchGameData['GM_ID'], '" type="button"';

    if ($search_type === 'upload') {
        echo ' class="gameTagListItemv list-group-item list-group-item-action btn-sm">';
    }
    if ($search_type === 'existing') {
        echo ' class="gameTagListExistingItemv list-group-item list-group-item-action btn-sm" data-videoID="' . $videoID . '">';
    }

    echo $fetchGameData['Date'] . " - (" . HomeAwayLookup($fetchGameData ['H_A']) . ") Vs " . opponentLookup($fetchGameData['Vs']);

    echo '</button>';
}

echo '<div>';

echo '<div>';

