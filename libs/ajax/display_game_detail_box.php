<?php
include ("../../libs/db/common_db_functions.php");
include ('../../parts/viewVideoModal.php');

$GM_ID = $_POST['GM_ID'];

$getGameData = db_query("SELECT * FROM `games` WHERE GM_ID='{$GM_ID}'");
$fetchGameData = $getGameData->fetch_assoc();

$getBoxData = db_query("SELECT * FROM `games_box_scores` WHERE GM_ID='{$GM_ID}'");
$fetchBoxData = $getBoxData->fetch_assoc();

$getScoringData = db_query("SELECT * FROM `games_scoring_plays` WHERE GM_ID='{$GM_ID}'");
$fetchScoringData = $getScoringData->fetch_assoc();
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Box Score</h5>
                <table class="table" style="text-align: center">
                    <thead>
                        <tr>
                            <th></th><th>Q1</th><th>Q2</th><th>Q3</th><th>Q4</th><th>Final</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Ohio State</td>
                            <td>
                                <?php echo $fetchBoxData['Q1_OSU']; ?>
                            </td>
                            <td>
                                <?php echo $fetchBoxData['Q2_OSU']; ?>
                            </td>
                            <td>
                                <?php echo $fetchBoxData['Q3_OSU']; ?>
                            </td>
                            <td>
                                <?php echo $fetchBoxData['Q4_OSU']; ?>
                            </td>
                            <td>
                                <?php echo $fetchGameData['OSU_Score']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo opponentLookup($fetchGameData['Vs']); ?></td>
                            <td>
                                <?php echo $fetchBoxData['Q1_Opp']; ?>
                            </td>
                            <td>
                                <?php echo $fetchBoxData['Q2_Opp']; ?>
                            </td>
                            <td>
                                <?php echo $fetchBoxData['Q3_Opp']; ?>
                            </td>
                            <td>
                                <?php echo $fetchBoxData['Q4_Opp']; ?>
                            </td>
                            <td>
                                <?php echo $fetchGameData['Opp_Score']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Scoring Plays</td>
                            <?php
                            $i = 1;

                            while ($i <= 4) {
                                $getScoringPlays = db_query("SELECT * FROM `games_scoring_plays` WHERE GM_ID='{$GM_ID}' AND Q='{$i}' ORDER BY SUBSTR(Time_Left,0,1) DESC");

                                echo '<td><ul class="list-group">';
                                while ($fetchScoringPlays = $getScoringPlays->fetch_assoc()) {
                                    if ($fetchScoringPlays['OSU_OPP'] === 'OSU') {
                                        echo displayOSUScoringPlay($fetchScoringPlays, 'full');
                                    }
                                    if ($fetchScoringPlays['OSU_OPP'] === 'OPP') {
                                        echo displayOPPScoringPlay($fetchScoringPlays, opponentLookup($fetchGameData['Vs']), 'full');
                                    }
                                }
                                echo '</ul></td>';
                                $i++;
                            }
                            ?> 
                        </tr>
                    </tbody>
                </table>
                <br><br><br>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Game Flow</h5>
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th colspan="5" style="text-align: left">First Quarter</th><th>Ohio State</th><th><?php echo opponentLookup($fetchGameData['Vs']); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $game_flow_OSU_Points = 0;
                        $game_flow_OPP_Points = 0;
                        $game_flow_OSU_Score = 0;
                        $game_flow_OPP_Score = 0;
                        $getScoringPlays = db_query("SELECT * FROM `games_scoring_plays` WHERE GM_ID='{$GM_ID}' AND Q='1' ORDER BY SUBSTR(Time_Left,0,1) DESC");
                        while ($fetchScoringPlays = $getScoringPlays->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>';
                            if ($fetchScoringPlays['OSU_OPP'] === 'OSU') {
                                echo '<img src="libs/images/logo_nav.png" height="30" width="30">';
                            }
                            echo '</td>';
                            echo '<td>', displayFlowScoreType($fetchScoringPlays['Play_Type']), '</td>';
                            echo '<td><ul class="list-group">';

                            if ($fetchScoringPlays['OSU_OPP'] === 'OSU') {
                                echo displayOSUScoringPlay($fetchScoringPlays, 'lite');
                                $game_flow_OSU_Points = 0;
                                $game_flow_OSU_Points = calculateGameFlowPoints($fetchScoringPlays['Play_Type'], $fetchScoringPlays['Post_Play_Points']);
                                $game_flow_OSU_Score = $game_flow_OSU_Score + $game_flow_OSU_Points;
                            }
                            if ($fetchScoringPlays['OSU_OPP'] === 'OPP') {
                                echo displayOPPScoringPlay($fetchScoringPlays, opponentLookup($fetchGameData['Vs']),'lite');
                                $game_flow_OPP_Points = calculateGameFlowPoints($fetchScoringPlays['Play_Type'], $fetchScoringPlays['Post_Play_Points']);
                                $game_flow_OPP_Score = $game_flow_OPP_Score + $game_flow_OPP_Points;
                            }
                            echo '<td>';
                            if ($fetchScoringPlays['video_ID'] != '0') {
                                displayVideoModalIcon($fetchScoringPlays['video_ID'],returnScoringPlayVideoDesc($fetchScoringPlays));
                            }
                            echo '</td>';
                            echo '<td>', $fetchScoringPlays['Time_Left'], ' Left</td>';
                            echo '<td>', $game_flow_OSU_Score, '</td>';
                            echo '<td>', $game_flow_OPP_Score, '</td>';
                        }
                        echo '</ul></td>';
                        echo '</tr>';
                        ?> 
                        <tr>
                            <th colspan="6" style="text-align: left">Second Quarter</th>
                        </tr>
                        <?php
                        $getScoringPlays = db_query("SELECT * FROM `games_scoring_plays` WHERE GM_ID='{$GM_ID}' AND Q='2' ORDER BY SUBSTR(Time_Left,0,1) DESC");
                        while ($fetchScoringPlays = $getScoringPlays->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>';
                            if ($fetchScoringPlays['OSU_OPP'] === 'OSU') {
                                echo '<img src="libs/images/logo_nav.png" height="30" width="30">';
                            }
                            echo '</td>';
                            echo '<td>', displayFlowScoreType($fetchScoringPlays['Play_Type']), '</td>';
                            echo '<td><ul class="list-group">';

                            if ($fetchScoringPlays['OSU_OPP'] === 'OSU') {
                                echo displayOSUScoringPlay($fetchScoringPlays, 'lite');
                                $game_flow_OSU_Points = 0;
                                $game_flow_OSU_Points = calculateGameFlowPoints($fetchScoringPlays['Play_Type'], $fetchScoringPlays['Post_Play_Points']);
                                $game_flow_OSU_Score = $game_flow_OSU_Score + $game_flow_OSU_Points;
                            }
                            if ($fetchScoringPlays['OSU_OPP'] === 'OPP') {
                                echo displayOPPScoringPlay($fetchScoringPlays, opponentLookup($fetchGameData['Vs']),'lite');
                                $game_flow_OPP_Points = calculateGameFlowPoints($fetchScoringPlays['Play_Type'], $fetchScoringPlays['Post_Play_Points']);
                                $game_flow_OPP_Score = $game_flow_OPP_Score + $game_flow_OPP_Points;
                            }
                            echo '<td>';
                            if ($fetchScoringPlays['video_ID'] != '0') {
                                displayVideoModalIcon($fetchScoringPlays['video_ID'],returnScoringPlayVideoDesc($fetchScoringPlays));
                            }
                            echo '</td>';
                            echo '<td>', $fetchScoringPlays['Time_Left'], ' Left</td>';
                            echo '<td>', $game_flow_OSU_Score, '</td>';
                            echo '<td>', $game_flow_OPP_Score, '</td>';
                        }
                        echo '</ul></td>';
                        echo '</tr>';
                        ?> 
                        <tr>
                            <th colspan="6" style="text-align: left">Third Quarter</th>
                        </tr>
                        <?php
                        $getScoringPlays = db_query("SELECT * FROM `games_scoring_plays` WHERE GM_ID='{$GM_ID}' AND Q='3' ORDER BY SUBSTR(Time_Left,0,1) DESC");
                        while ($fetchScoringPlays = $getScoringPlays->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>';
                            if ($fetchScoringPlays['OSU_OPP'] === 'OSU') {
                                echo '<img src="libs/images/logo_nav.png" height="30" width="30">';
                            }
                            echo '</td>';
                            echo '<td>', displayFlowScoreType($fetchScoringPlays['Play_Type']), '</td>';
                            echo '<td><ul class="list-group">';

                            if ($fetchScoringPlays['OSU_OPP'] === 'OSU') {
                                echo displayOSUScoringPlay($fetchScoringPlays, 'lite');
                                $game_flow_OSU_Points = 0;
                                $game_flow_OSU_Points = calculateGameFlowPoints($fetchScoringPlays['Play_Type'], $fetchScoringPlays['Post_Play_Points']);
                                $game_flow_OSU_Score = $game_flow_OSU_Score + $game_flow_OSU_Points;
                            }
                            if ($fetchScoringPlays['OSU_OPP'] === 'OPP') {
                                echo displayOPPScoringPlay($fetchScoringPlays, opponentLookup($fetchGameData['Vs']),'lite');
                                $game_flow_OPP_Points = calculateGameFlowPoints($fetchScoringPlays['Play_Type'], $fetchScoringPlays['Post_Play_Points']);
                                $game_flow_OPP_Score = $game_flow_OPP_Score + $game_flow_OPP_Points;
                            }
                            echo '<td>';
                            if ($fetchScoringPlays['video_ID'] != '0') {
                                displayVideoModalIcon($fetchScoringPlays['video_ID'],returnScoringPlayVideoDesc($fetchScoringPlays));
                            }
                            echo '</td>';
                            echo '<td>', $fetchScoringPlays['Time_Left'], ' Left</td>';
                            echo '<td>', $game_flow_OSU_Score, '</td>';
                            echo '<td>', $game_flow_OPP_Score, '</td>';
                        }
                        echo '</ul></td>';
                        echo '</tr>';
                        ?> 
                        <tr>
                            <th colspan="6" style="text-align: left">Fourth Quarter</th>
                        </tr>
                        <?php
                        $getScoringPlays = db_query("SELECT * FROM `games_scoring_plays` WHERE GM_ID='{$GM_ID}' AND Q='4' ORDER BY SUBSTR(Time_Left,0,1) DESC");
                        while ($fetchScoringPlays = $getScoringPlays->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>';
                            if ($fetchScoringPlays['OSU_OPP'] === 'OSU') {
                                echo '<img src="libs/images/logo_nav.png" height="30" width="30">';
                            }
                            echo '</td>';
                            echo '<td>', displayFlowScoreType($fetchScoringPlays['Play_Type']), '</td>';
                            echo '<td><ul class="list-group">';

                            if ($fetchScoringPlays['OSU_OPP'] === 'OSU') {
                                echo displayOSUScoringPlay($fetchScoringPlays, 'lite');
                                $game_flow_OSU_Points = 0;
                                $game_flow_OSU_Points = calculateGameFlowPoints($fetchScoringPlays['Play_Type'], $fetchScoringPlays['Post_Play_Points']);
                                $game_flow_OSU_Score = $game_flow_OSU_Score + $game_flow_OSU_Points;
                            }
                            if ($fetchScoringPlays['OSU_OPP'] === 'OPP') {
                                echo displayOPPScoringPlay($fetchScoringPlays, opponentLookup($fetchGameData['Vs']),'lite');
                                $game_flow_OPP_Points = calculateGameFlowPoints($fetchScoringPlays['Play_Type'], $fetchScoringPlays['Post_Play_Points']);
                                $game_flow_OPP_Score = $game_flow_OPP_Score + $game_flow_OPP_Points;
                            }
                            echo '<td>';
                            if ($fetchScoringPlays['video_ID'] != '0') {
                                displayVideoModalIcon($fetchScoringPlays['video_ID'],returnScoringPlayVideoDesc($fetchScoringPlays));
                            }
                            echo '</td>';
                            echo '<td>', $fetchScoringPlays['Time_Left'], ' Left</td>';
                            echo '<td>', $game_flow_OSU_Score, '</td>';
                            echo '<td>', $game_flow_OPP_Score, '</td>';
                        }
                        echo '</ul></td>';
                        echo '</tr>';
                        ?> 
                    </tbody>
                </table>             
            </div>
        </div>
    </div>
</div>
<?php