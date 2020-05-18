<?php
include ("../../libs/db/common_db_functions.php");

$seasonID = $_POST['new_season'];

$getGameData = db_query("SELECT * FROM `games` WHERE Season_ID='{$seasonID}' AND GM_Type <> 52 ORDER BY Week ASC");

echo '<div class="list-group small" style="text-align: left">';

while ($fetchGameData = $getGameData->fetch_assoc()) {
    
    echo '<a href="#" class="list-group-item list-group-item-action selectScorePlayGame" data-gmid="',$fetchGameData['GM_ID'],'">';
    echo 'Week ' . $fetchGameData['Week'] . ' - ' . HomeAwayLookup($fetchGameData['H_A']) . ' Vs ' . opponentLookup($fetchGameData['Vs']) . ' - (' . gameTypeLookup($fetchGameData['GM_Type']) . ')';
    echo '</a>';
    
    
}

echo '</div>';