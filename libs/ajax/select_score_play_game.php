<?php

include ("../../libs/db/common_db_functions.php");

$Game_ID = $_POST['new_game'];
$Video_ID = $_POST['Video_ID'];

$getGameData = db_query("SELECT * FROM `games` WHERE GM_ID='{$Game_ID}'");
$fetchScoreData = $getGameData->fetch_assoc();

$getScoreData = db_query("SELECT * FROM `games_scoring_plays` WHERE GM_ID='{$Game_ID}' AND OSU_OPP='OSU' ORDER BY Q,SUBSTR(Time_Left,0,1) DESC");

$exists = mysqli_num_rows($getScoreData);

if ($exists > 0) {
    echo '<div class="list-group small" style="text-align: left">';

    while ($fetchScoreData = $getScoreData->fetch_assoc()) {

        echo '<li data-videoid="', $Video_ID, '" data-playid="' . $fetchScoreData['Play_ID'] . '" class="list-group-item selectScorePlay" style="background-color : #BB0000; color: white">';
        if ($fetchScoreData['video_ID'] != '0') {
            echo '<span class="oi oi-check"></span>';
        }
        echo " (Q" . $fetchScoreData['Q'] . ": " . $fetchScoreData['Time_Left'] . " Remaining)&nbsp;";
        echo getPlayerFieldByMasterID('First_Name', $fetchScoreData['Scoring_Player']) . " ";
        echo getPlayerFieldByMasterID('Last_Name', $fetchScoreData['Scoring_Player']) . " ";
        echo $fetchScoreData['Distance'] . " Yard";
        echo returnScoringPlayTypeVerb($fetchScoreData['Play_Type'], $fetchScoreData['OSU_OPP']);

        if ($fetchScoreData['Play_Type'] === 'passTD') {

            echo getPlayerFieldByMasterID('First_Name', $fetchScoreData['From_Player']) . " ";
            echo getPlayerFieldByMasterID('Last_Name', $fetchScoreData['From_Player']) . " ";
        }
        if ($fetchScoreData['video_ID'] != '0' && $fetchScoreData['video_ID'] === $Video_ID) {
            echo '&nbsp;<span class=" btn btn-danger btn-sm oi oi-link-broken removeScorePlay" data-videoid="', $Video_ID, '" data-playid="' . $fetchScoreData['Play_ID'] . '"></span>';
        }
        echo '</li>';
    }
    echo '</div>';
} else {
    echo 'No Scoring Plays Exist';
}
?>