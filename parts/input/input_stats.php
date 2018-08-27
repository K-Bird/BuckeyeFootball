<?php $inputAddPlayer = getInputPlayerAddStat(); ?>
<div class="container-fluid" style="text-align: center">
    <br><br>
    <div class="row">
        <div class="col-lg-6">
            <h2><span class="badge badge-secondary">Add <?php ?> Stats For:
                    <?php
                    echo getPlayerField("Position", $inputAddPlayer) . " - ";
                    echo getPlayerField("First_Name", $inputAddPlayer) . " ";
                    echo getPlayerField("Last_Name", $inputAddPlayer);
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
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            Game
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
                        <th>

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
                        echo gameStatExists($fetchGameData['GM_ID'], $inputAddPlayer, 'passing', $fetchGameData['Week'], getPlayerField("First_Name", $inputAddPlayer), getPlayerField("Last_Name", $inputAddPlayer), $Input_Season);
                        echo '</td>';
                        echo '<td>';
                        echo gameStatExists($fetchGameData['GM_ID'], $inputAddPlayer, 'rushing', $fetchGameData['Week'], getPlayerField("First_Name", $inputAddPlayer), getPlayerField("Last_Name", $inputAddPlayer), $Input_Season);
                        echo '</td>';
                        echo '<td>';
                        echo gameStatExists($fetchGameData['GM_ID'], $inputAddPlayer, 'rec', $fetchGameData['Week'], getPlayerField("First_Name", $inputAddPlayer), getPlayerField("Last_Name", $inputAddPlayer), $Input_Season);
                        echo '</td>';
                        echo '<td>';
                        echo gameStatExists($fetchGameData['GM_ID'], $inputAddPlayer, 'def', $fetchGameData['Week'], getPlayerField("First_Name", $inputAddPlayer), getPlayerField("Last_Name", $inputAddPlayer), $Input_Season);
                        echo '</td>';
                        echo '<td>';
                        echo gameStatExists($fetchGameData['GM_ID'], $inputAddPlayer, 'ret', $fetchGameData['Week'], getPlayerField("First_Name", $inputAddPlayer), getPlayerField("Last_Name", $inputAddPlayer), $Input_Season);
                        echo '</td>';
                        echo '<td>';
                        echo gameStatExists($fetchGameData['GM_ID'], $inputAddPlayer, 'kicking', $fetchGameData['Week'], getPlayerField("First_Name", $inputAddPlayer), getPlayerField("Last_Name", $inputAddPlayer), $Input_Season);
                        echo '</td>';
                        echo '<td>';
                        echo gameStatExists($fetchGameData['GM_ID'], $inputAddPlayer, 'punting', $fetchGameData['Week'], getPlayerField("First_Name", $inputAddPlayer), getPlayerField("Last_Name", $inputAddPlayer), $Input_Season);
                        echo '</td>';
                        echo '<td>';
                        echo '<button
                                   class="btn btn-success" 
                                   data-gameID="', $fetchGameData['GM_ID'], '"
                                   data-week="', $fetchGameData['Week'], '" 
                                   data-fname="', getPlayerField("First_Name", $inputAddPlayer), '" 
                                   data-lname="', getPlayerField("Last_Name", $inputAddPlayer), '" 
                                   data-season="', $Input_Season, '"
                                   data-toggle="modal" 
                                   data-target="#addStatModal">
                                   <span class="oi oi-plus"></span>
                              </button>';
                        echo '</td>';

                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include ('input_modal_addStat.php'); ?>
<?php include ('input_modal_editStat.php'); ?>