<div id="Season_Panels">

    <?php
    $get_SeasonData = db_query("SELECT * FROM `seasons` ORDER BY Year DESC");

    while ($fetch_SeasonData = $get_SeasonData->fetch_assoc()) {

        //Conference Lookup
        $conf_ID = $fetch_SeasonData['Conf'];
        $get_Conf = db_query("Select * from `conferences` where Conf_ID={$conf_ID}");
        $fetch_Conf = $get_Conf->fetch_assoc();

        //Division Lookup
        $div_ID = $fetch_SeasonData['Division'];
        $get_Div = db_query("Select * from `b10_divisions` where Div_ID={$div_ID}");
        $fetch_Div = $get_Div->fetch_assoc();


        echo '<div id="', $fetch_SeasonData['Year'], '" class="card">';
        echo '<div class="card-header" id="', $fetch_SeasonData['Year'], 'Header">';
        echo '<h5 class="mb-0">';
        echo '<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#', $fetch_SeasonData['Year'], 'Body" aria-expanded="false" aria-controls="', $fetch_SeasonData['Year'], 'Header">';
        echo '<span id="season_games_record" class="badge badge-secondary">';
        echo $fetch_SeasonData['Year'], ' ( ', returnRecord($fetch_SeasonData['Season_ID'], 'W', 'Ovr'), '-', returnRecord($fetch_SeasonData['Season_ID'], 'L', 'Ovr'), '-', returnRecord($fetch_SeasonData['Season_ID'], 'T', 'Ovr'), ' ) ';
        echo $fetch_Conf['Conf_Abbrev'], ' [ ', $fetch_Div['Div_Name'], ' ]';
        echo '</span>';
        echo '</button>';
        echo '</h5>';
        echo '</div>';
        echo '<div id="', $fetch_SeasonData['Year'], 'Body" class="collapse" aria-labeledby="', $fetch_SeasonData['Year'], 'Header" data-parent="', $fetch_SeasonData['Year'], 'Header">';
        echo '<div class="card-body">';


        echo '<table class="table-sm" style="font-size:small">';
        echo '<thead><th>Week</th><th>Date</th><th>Location</th><th>Game Type</th><th>Home/Away</th><th>Opponent</th><th>Result</th><th>Score</th><th>Running Record</th><th>New AP Rank</th><th>New CFP Rank</th><th></th></thead>';

        //Grab Each Season's Games
        $get_GameData = db_query("SELECT * FROM `games` WHERE Season_ID={$fetch_SeasonData['Season_ID']} ORDER BY WEEK ASC");

        //Set W-L-T Counters
        $SeasonWins = 0;
        $SeasonLosses = 0;
        $SeasonTies = 0;

        //Build Each Game Panel
        while ($fetch_gameData = $get_GameData->fetch_assoc()) {

            if ($fetch_gameData['Vs'] === '129') {
                echo '<tr>';
                echo '<td>', $fetch_gameData['Week'], '</td>';
                echo '<td colspan="7">BYE</td>';
                echo '</tr>';
            } else {

                //Home or Away Lookup
                $HorA = '';
                if ($fetch_gameData['H_A'] === 'H') {
                    $HorA = 'Vs';
                }
                if ($fetch_gameData['H_A'] === 'A') {
                    $HorA = 'At';
                }
                if ($fetch_gameData['H_A'] === 'N') {
                    $HorA = 'Neutral Site Vs';
                }

                //Opponent Lookup
                $opp_ID = $fetch_gameData['Vs'];
                $get_Opp = db_query("Select * from `opponents` where Team_ID={$opp_ID}");
                $fetch_Opp = $get_Opp->fetch_assoc();

                //Calculate Result and Record
                $OSU_Score = $fetch_gameData['OSU_Score'];
                $Opp_Score = $fetch_gameData['Opp_Score'];

                if ($fetch_gameData['GM_Type'] === '52') {
                    
                } else {
                    $game_Result = '';
                    if ($OSU_Score > $Opp_Score) {
                        $game_Result = 'Won';
                        $SeasonWins++;
                    }
                    if ($OSU_Score < $Opp_Score) {
                        $game_Result = 'Lost';
                        $SeasonLosses++;
                    }
                    if ($OSU_Score === $Opp_Score) {
                        if ($OSU_Score === '0' && $Opp_Score === '0') {
                            $game_Result = 'Not Played';
                        } else {
                            $game_Result = 'Tied';
                            $SeasonTies++;
                        }
                    }
                }


                //Lookup Overtime Results
                $OT = checkOT($fetch_gameData['GM_ID']);

                if ($fetch_gameData['GM_Type'] === '52') {
                    echo '<tr>';
                    echo '<td>', $fetch_gameData['Week'], '</td>';
                    echo '<td>', $fetch_gameData['Date'], '</td>';
                    echo '<td></td>';
                    echo '<td>', gameTypeLookup($fetch_gameData['GM_Type']), '</td>';
                    echo '<td colspan="4"></td>';
                    echo '<td>( ', $SeasonWins, ' - ', $SeasonLosses, ' - ', $SeasonTies, ' )</td>';
                    echo '<td>', calc_AP_RK_Diff($fetch_SeasonData['Season_ID'], $fetch_gameData['Week']), '</td>';
                    echo '<td>', calc_CFP_RK_Diff($fetch_SeasonData['Season_ID'], $fetch_gameData['Week'], $fetch_gameData['GM_ID']), '</td>';
                    echo '</tr>';
                } else {
                    echo '<tr>';
                    echo '<td>', $fetch_gameData['Week'], '</td>';
                    echo '<td>', $fetch_gameData['Date'], '</td>';
                    echo '<td>', locationLookup($fetch_gameData['Location']), '</td>';
                    echo '<td>', gameTypeLookup($fetch_gameData['GM_Type']), '</td>';
                    echo '<td style="text-align: center"><span class="badge badge-secondary">', returnOSURk($fetch_gameData['GM_ID']), '</span> ', $HorA, '</td>';
                    echo '<td>';
                    echo '<span class="badge badge-secondary">', returnOppRk($fetch_gameData['GM_ID']), '</span><a href="#" class="badge badge-secondary oppDetail" data-oppid="', $fetch_Opp['Team_ID'], '">', $fetch_Opp['School'], '</a>';
                    echo '</td>';
                    echo '<td>', $game_Result, ' ', $OT, '</td>';
                    echo '<td>', $OSU_Score, '-' ,$Opp_Score, '</td>';
                    echo '<td>( ', $SeasonWins, ' - ', $SeasonLosses, ' - ', $SeasonTies, ' )</td>';
                    echo '<td>', calc_AP_RK_Diff($fetch_SeasonData['Season_ID'], $fetch_gameData['Week']), '</td>';
                    echo '<td>', calc_CFP_RK_Diff($fetch_SeasonData['Season_ID'], $fetch_gameData['Week'], $fetch_gameData['GM_ID']), '</td>';
                    echo '<td><span class="badge badge-secondary"><a href="#" class="badge badge-secondary gameDetail" data-gmid="', $fetch_gameData['GM_ID'], '">Details</a></span><td>';
                    echo '</tr>';
                }
            }
        }


        echo '</table>';

        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    ?>

</div>

