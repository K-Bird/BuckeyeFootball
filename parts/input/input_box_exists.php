<br>
<div id="boxScoreGameInput" >
    <div clas="row">
        <div class="col-lg-12">
            <h3><span class="badge badge-dark">
                    <?php echo 'Edit Box Score: ' . getSeason_Year(getSeasonIDbyGameID($fetchGameData['GM_ID'])) . ' - Week ' . $fetchGameData['Week'] . ' - ' . $fetchGameData['Date'] . ' ' . HomeAwayLookup($fetchGameData['H_A']) . ' Vs ' . opponentLookup($fetchGameData['Vs']) . ' - (' . gameTypeLookup($fetchGameData['GM_Type']) . ')'; ?>
                    &nbsp;
                    <button id="changeBoxGame" class="btn btn-warning btn-sm">Edit Different Game</button>
                </span></h3>

            <br>
        </div>
    </div>

    <div  class="row" style="text-align: center">
        <div class="col-lg-12">
            <table class="table">
                <thead>
                <th></th><th>Q1</th><th>Q2</th><th>Q3</th><th>Q4</th><th>Final</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Ohio State</td>
                        <td><input class="form-control boxPoints" type="text" placeholder="<?php echo $fetchBoxData['Q1_OSU'] ?>" data-field="Q1_OSU" data-gmid="<?php echo $fetchGameData['GM_ID']; ?>" /></td>
                        <td><input class="form-control boxPoints" type="text" placeholder="<?php echo $fetchBoxData['Q2_OSU'] ?>" data-field="Q2_OSU" data-gmid="<?php echo $fetchGameData['GM_ID']; ?>" /></td>
                        <td><input class="form-control boxPoints" type="text" placeholder="<?php echo $fetchBoxData['Q3_OSU'] ?>" data-field="Q3_OSU" data-gmid="<?php echo $fetchGameData['GM_ID']; ?>" /></td>
                        <td><input class="form-control boxPoints" type="text" placeholder="<?php echo $fetchBoxData['Q4_OSU'] ?>" data-field="Q4_OSU" data-gmid="<?php echo $fetchGameData['GM_ID']; ?>" /></td>
                        <td><?php
                            if ($curr_OSU_Total == $fetchGameData['OSU_Score']) {
                                echo '<span class="oi oi-circle-check" style="color: green"></span>';
                            } else {
                                echo '<span class="oi oi-circle-x" style="color: red"></span> (' . $OSU_Diff . ')';
                            }
                            ?></td>
                    </tr>
                    <tr>
                        <td><?php echo opponentLookup($fetchGameData['Vs']); ?></td>
                        <td><input class="form-control boxPoints" type="text" placeholder="<?php echo $fetchBoxData['Q1_Opp'] ?>" data-field="Q1_Opp" data-gmid="<?php echo $fetchGameData['GM_ID']; ?>" /></td>
                        <td><input class="form-control boxPoints" type="text" placeholder="<?php echo $fetchBoxData['Q2_Opp'] ?>" data-field="Q2_Opp" data-gmid="<?php echo $fetchGameData['GM_ID']; ?>" /></td>
                        <td><input class="form-control boxPoints" type="text" placeholder="<?php echo $fetchBoxData['Q3_Opp'] ?>" data-field="Q3_Opp" data-gmid="<?php echo $fetchGameData['GM_ID']; ?>" /></td>
                        <td><input class="form-control boxPoints" type="text" placeholder="<?php echo $fetchBoxData['Q4_Opp'] ?>" data-field="Q4_Opp" data-gmid="<?php echo $fetchGameData['GM_ID']; ?>" /></td>
                        <td><?php
                            if ($curr_Opp_Total == $fetchGameData['Opp_Score']) {
                                echo '<span class="oi oi-circle-check" style="color: green"></span>';
                            } else {
                                echo '<span class="oi oi-circle-x" style="color: red"></span> (' . $Opp_Diff . ')';
                            }
                            ?></td>
                    </tr>
                    <tr>
                        <td>Scoring Plays</td>
                        <?php
                        $i = 1;

                        while ($i <= 4) {
                            $getScoringPlays = db_query("SELECT * FROM `games_scoring_plays` WHERE GM_ID='{$Game_ID}' AND Q='{$i}' ORDER BY Time_Left DESC");

                            echo '<td><ul class="list-group">';
                            while ($fetchScoringPlays = $getScoringPlays->fetch_assoc()) {
                                if ($fetchScoringPlays['OSU_OPP'] === 'OSU') {
                                    echo displayOSUScoringPlay($fetchScoringPlays);
                                }
                                if ($fetchScoringPlays['OSU_OPP'] === 'OPP') {
                                    echo displayOPPScoringPlay($fetchScoringPlays, opponentLookup($fetchGameData['Vs']));
                                }
                            }
                            echo '</ul></td>';
                            $i++;
                        }
                        ?>

                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button class="btn btn-success" data-toggle="modal" data-target="#addScoringPlayModal" data-q="1"  data-year="<?php echo getSeason_Year(getSeasonIDbyGameID($fetchGameData['GM_ID'])); ?>" data-week="<?php echo $fetchGameData['Week']; ?>" data-opp="<?php echo opponentLookup($fetchGameData['Vs']); ?>">Add OSU Q1 Score</button>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#addOppScoringPlayModal" data-q="1"  data-year="<?php echo getSeason_Year(getSeasonIDbyGameID($fetchGameData['GM_ID'])); ?>" data-week="<?php echo $fetchGameData['Week']; ?>" data-opp="<?php echo opponentLookup($fetchGameData['Vs']); ?>">Add Opp Q1 Score</button>
                        </td>
                        <td>
                            <button class="btn btn-success" data-toggle="modal" data-target="#addScoringPlayModal" data-q="2"  data-year="<?php echo getSeason_Year(getSeasonIDbyGameID($fetchGameData['GM_ID'])); ?>" data-week="<?php echo $fetchGameData['Week']; ?>" data-opp="<?php echo opponentLookup($fetchGameData['Vs']); ?>">Add OSU Q2 Score</button>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#addOppScoringPlayModal" data-q="2"  data-year="<?php echo getSeason_Year(getSeasonIDbyGameID($fetchGameData['GM_ID'])); ?>" data-week="<?php echo $fetchGameData['Week']; ?>" data-opp="<?php echo opponentLookup($fetchGameData['Vs']); ?>">Add Opp Q2 Score</button>
                        </td>
                        <td>
                            <button class="btn btn-success" data-toggle="modal" data-target="#addScoringPlayModal" data-q="3"  data-year="<?php echo getSeason_Year(getSeasonIDbyGameID($fetchGameData['GM_ID'])); ?>" data-week="<?php echo $fetchGameData['Week']; ?>" data-opp="<?php echo opponentLookup($fetchGameData['Vs']); ?>">Add OSU Q3 Score</button>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#addOppScoringPlayModal" data-q="3"  data-year="<?php echo getSeason_Year(getSeasonIDbyGameID($fetchGameData['GM_ID'])); ?>" data-week="<?php echo $fetchGameData['Week']; ?>" data-opp="<?php echo opponentLookup($fetchGameData['Vs']); ?>">Add Opp Q3 Score</button>
                        </td>
                        <td>
                            <button class="btn btn-success" data-toggle="modal" data-target="#addScoringPlayModal" data-q="4"  data-year="<?php echo getSeason_Year(getSeasonIDbyGameID($fetchGameData['GM_ID'])); ?>" data-week="<?php echo $fetchGameData['Week']; ?>" data-opp="<?php echo opponentLookup($fetchGameData['Vs']); ?>">Add OSU Q4 Score</button>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#addOppScoringPlayModal" data-q="4"  data-year="<?php echo getSeason_Year(getSeasonIDbyGameID($fetchGameData['GM_ID'])); ?>" data-week="<?php echo $fetchGameData['Week']; ?>" data-opp="<?php echo opponentLookup($fetchGameData['Vs']); ?>">Add Opp Q4 Score</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>