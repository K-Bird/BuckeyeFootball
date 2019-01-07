<?php

/*
  take a player master ID and create a player tag with it
 */

include ("../../libs/db/common_db_functions.php");

$playerID = $_POST['playerID'];

echo '&nbsp;<span class="badge badge-pill badge-secondary">';
echo getPlayerFieldByMasterID('First_Name', $playerID) . " " . getPlayerFieldByMasterID('Last_Name', $playerID);
echo '&nbsp;<span aria-hidden="true" id="',$playerID,'" class="playerUploadTagRemove">&times;</span>';
echo '</span>&nbsp;';

