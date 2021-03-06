<?php $inputAddPlayer = getInputPlayerAddStat(); ?>
<div class="container-fluid" style="text-align: center">
    <br><br>
    <div class="row">
        <div class="col-lg-6">
            <h2><span class="badge badge-secondary">Add <?php ?> Stats For:
                    <?php
                    echo getPlayerFieldByRow("Position", $inputAddPlayer) . " - ";
                    echo getPlayerFieldByRow("First_Name", $inputAddPlayer) . " ";
                    echo getPlayerFieldByRow("Last_Name", $inputAddPlayer);
                    echo " ( " . $Input_Season . " )";
                    ?>
                </span></h2>
        </div>
        <div class="col-lg-6">
            <h2 style="display: inline"><span class="badge badge-secondary">Change Player for <?php echo $Input_Season; ?> Season: <?php echo displayExistingPlayersSelect($Season_ID, "addStats"); ?></span></h2>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-lg-12">
            <table id="inputStatsTable" class="table">
                <thead>
                    <tr>
                        <th>
                            Game
                        </th>
                        <th>

                        </th>
                        <th>
                            Passing
                        </th>
                        <th>
                            Rushing
                        </th>
                        <th>
                            Receiving
                        </th>
                        <th>
                            Defense
                        </th>
                        <th>
                            Returns
                        </th>
                        <th>
                            Kicking
                        </th>
                        <th>
                            Punting
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $getGameData = db_query("SELECT * FROM `games` WHERE Season_ID='{$Season_ID}' ORDER BY Week ASC");

                    while ($fetchGameData = $getGameData->fetch_assoc()) {
                        echo '<tr>';

                        echo '<td>';
                        echo "Week " . $fetchGameData['Week'] . " vs " . opponentLookup($fetchGameData['Vs']);
                        echo '</td>';
                        echo '<td>';
                        echo '<button
                                   class="btn btn-success addStatBtn" 
                                   data-gameID="', $fetchGameData['GM_ID'], '"
                                   data-week="', $fetchGameData['Week'], '" 
                                   data-opp="', opponentLookup($fetchGameData['Vs']), '"
                                   data-playerID="', getPlayerFieldByRow("Player_Master_ID", $inputAddPlayer), '"
                                   data-fname="', getPlayerFieldByRow("First_Name", $inputAddPlayer), '" 
                                   data-lname="', getPlayerFieldByRow("Last_Name", $inputAddPlayer), '" 
                                   data-season="', $Input_Season, '"
                                   data-toggle="modal" 
                                   data-target="#addStatModal"';
                        
                        if (opponentLookup($fetchGameData['Vs']) === 'BYE') {
                            echo ' disabled';
                        }
                        
                        
                                    echo '>
                                   <span class="oi oi-plus"></span>
                              </button>';
                        echo '</td>';
                        echo '<td>';
                        echo gameStatExists($fetchGameData['GM_ID'], $inputAddPlayer, 'passing', $fetchGameData['Week'], getPlayerFieldByRow("First_Name", $inputAddPlayer), getPlayerFieldByRow("Last_Name", $inputAddPlayer), $fetchGameData['Vs'], $Input_Season);
                        echo '</td>';
                        echo '<td>';
                        echo gameStatExists($fetchGameData['GM_ID'], $inputAddPlayer, 'rushing', $fetchGameData['Week'], getPlayerFieldByRow("First_Name", $inputAddPlayer), getPlayerFieldByRow("Last_Name", $inputAddPlayer), $fetchGameData['Vs'], $Input_Season);
                        echo '</td>';
                        echo '<td>';
                        echo gameStatExists($fetchGameData['GM_ID'], $inputAddPlayer, 'rec', $fetchGameData['Week'], getPlayerFieldByRow("First_Name", $inputAddPlayer), getPlayerFieldByRow("Last_Name", $inputAddPlayer), $fetchGameData['Vs'], $Input_Season);
                        echo '</td>';
                        echo '<td>';
                        echo gameStatExists($fetchGameData['GM_ID'], $inputAddPlayer, 'def', $fetchGameData['Week'], getPlayerFieldByRow("First_Name", $inputAddPlayer), getPlayerFieldByRow("Last_Name", $inputAddPlayer), $fetchGameData['Vs'], $Input_Season);
                        echo '</td>';
                        echo '<td>';
                        echo gameStatExists($fetchGameData['GM_ID'], $inputAddPlayer, 'ret', $fetchGameData['Week'], getPlayerFieldByRow("First_Name", $inputAddPlayer), getPlayerFieldByRow("Last_Name", $inputAddPlayer), $fetchGameData['Vs'], $Input_Season);
                        echo '</td>';
                        echo '<td>';
                        echo gameStatExists($fetchGameData['GM_ID'], $inputAddPlayer, 'kicking', $fetchGameData['Week'], getPlayerFieldByRow("First_Name", $inputAddPlayer), getPlayerFieldByRow("Last_Name", $inputAddPlayer), $fetchGameData['Vs'], $Input_Season);
                        echo '</td>';
                        echo '<td>';
                        echo gameStatExists($fetchGameData['GM_ID'], $inputAddPlayer, 'punting', $fetchGameData['Week'], getPlayerFieldByRow("First_Name", $inputAddPlayer), getPlayerFieldByRow("Last_Name", $inputAddPlayer), $fetchGameData['Vs'], $Input_Season);
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php 

include ('input_modal_addStat.php');
include ('input_modal_editStat.php');
//If a stat exists for the given category for the given player and game build an indicator
function gameStatExists($gm_ID, $player_ID, $category, $week, $fname, $lname, $opp, $season) {

    $player_ID = returnPlayerMasterID($player_ID);

    $getStatRow = db_query("SELECT * FROM `stats_{$category}` WHERE Game_ID='{$gm_ID}' AND Player_ID='{$player_ID}'");

    $RowCount = mysqli_num_rows($getStatRow);

    if ($RowCount >= 1) {
        return '<button id="' . $category . $gm_ID . $player_ID . '" class="btn btn-sm btn-secondary"><span 
           class="oi oi-comment-square existingStat"
           data-toggle="modal" 
           data-target="#editStatModal"
           data-game=' . $gm_ID . ' data-player=' . $player_ID . ' data-cat=' . $category . ' data-week=' . $week . ' data-fname=' . $fname . ' data-lname=' . $lname . ' data-opp=' . opponentLookup($opp) . ' data-season=' . $season .
                '></span ></button>
           <button class="btn btn-sm btn-danger removeStat" data-cat="' . $category . '" data-game="' . $gm_ID . '" data-player="' . $player_ID . '"><span class="oi oi-minus"></span></button> ';
    } else {
        return '';
    }
}
