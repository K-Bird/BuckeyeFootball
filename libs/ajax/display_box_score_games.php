<?php

include ("../../libs/db/common_db_functions.php");

$seasonID = $_POST['new_season'];

$getGameData = db_query("SELECT * FROM `games` WHERE Season_ID='{$seasonID}' AND GM_Type <> 52 ORDER BY Week ASC");

echo '<div class="list-group small" style="text-align: left">';

while ($fetchGameData = $getGameData->fetch_assoc()) {

    $getBoxData = db_query("SELECT * FROM `games_box_scores` WHERE GM_ID='{$fetchGameData['GM_ID']}'");
    $fetchBoxData = $getBoxData->fetch_assoc();
    $exists = mysqli_num_rows($getBoxData);    

    echo '<a href="#" class="list-group-item list-group-item-action selectBoxScoreGame" data-gmid="', $fetchGameData['GM_ID'], '">';
    echo 'Week ' . $fetchGameData['Week'] . ' - ' . $fetchGameData['Date'] . ' ' . HomeAwayLookup($fetchGameData['H_A']) . ' Vs ' . opponentLookup($fetchGameData['Vs']) . ' - (' . gameTypeLookup($fetchGameData['GM_Type']) . ')';
    if ($exists > 0) {
        echo '&nbsp;&nbsp;<span class="oi oi-box"></span>';
    }
    
    echo '</a>';
}

echo '</div>';
