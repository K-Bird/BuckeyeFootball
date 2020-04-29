<?php

include ("../../libs/db/common_db_functions.php");

$player_ID = $_POST['player_ID'];

echo '<div id="scoringPlayerResults">';
echo '<span class="badge badge-dark">' . getPlayerFieldByMasterID('First_Name', $player_ID) . ' ' . getPlayerFieldByMasterID('Last_Name', $player_ID) . '&nbsp;<span aria-hidden="true" id="', $player_ID, '" class="selectedScoringPlayerRemove">&times;</span></span>';
echo '</div>';