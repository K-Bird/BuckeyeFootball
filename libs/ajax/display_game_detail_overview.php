<?php
include ("../../libs/db/common_db_functions.php");

$GM_ID = $_POST['GM_ID'];

$getGameData = db_query("SELECT * FROM `games` WHERE GM_ID='{$GM_ID}'");
$fetchGameData = $getGameData->fetch_assoc();
?>
<div class="row" style="text-align: center">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <?php echo getGameYear($GM_ID) . " Season on " . returnGameDate($GM_ID) . " " . HomeAwayLookup($fetchGameData['H_A']) . " Vs " . opponentLookup($fetchGameData['Vs']); ?>
                <br>
                <?php echo locationLookup($fetchGameData['Location']); ?>
                <br><br>
                <?php
                echo gameTypeLookup($fetchGameData['GM_Type']) . " ";
                if (isGameConf($GM_ID)) {
                    echo ' | Conference Game';
                }
                if (isGameDiv($GM_ID)) {
                    echo ' | Divisional Game';
                }
                ?>
                <br><br>
                <?php echo returnGameOutcome($fetchGameData['OSU_Score'], $fetchGameData['Opp_Score']) . " " . $fetchGameData['OSU_Score'] . " - " . $fetchGameData['Opp_Score'] . " " . checkOT($GM_ID); ?>
                <br>
                <?php echo "Pre Game AP Ranking: " . returnOSURk($GM_ID); ?>
                <br>
                <?php echo " Post Game AP Ranking: " . calc_AP_RK_Diff($fetchGameData['Season_ID'], $fetchGameData['Week']); ?>
            </div>
        </div>
    </div>
</div>
<?php
//Determine if a game is a divisional game
function isGameConf($GM_ID) {

    $getGameDate = db_query("SELECT * FROM `games` WHERE GM_ID='{$GM_ID}'");
    $fetchGameDate = $getGameDate->fetch_assoc();
    $Conf_GM = $fetchGameDate['Conf_GM'];

    if ($Conf_GM === 'Y') {
        return true;
    } else {
        return false;
    }
}
///Determine if a game is a conference game
function isGameDiv($GM_ID) {

    $getGameDate = db_query("SELECT * FROM `games` WHERE GM_ID='{$GM_ID}'");
    $fetchGameDate = $getGameDate->fetch_assoc();
    $Div_GM = $fetchGameDate['Div_GM'];

    if ($Div_GM === 'Y') {
        return true;
    } else {
        return false;
    }
}