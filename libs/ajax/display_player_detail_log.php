<?php
include ("../../libs/db/common_db_functions.php");

$Master_ID = $_POST['Master_ID'];
?>

<div class="row">
    <div class="col-lg-12">
        <?php
            echo returnGameLog($Master_ID);
        ?>
    </div>
</div>
<?php
//Build game log history for given player
function returnGameLog($Master_ID) {

    $seasons = returnYearsPlayedArray($Master_ID);

    foreach ($seasons as $season) {

        $position = getPlayerFieldByMasterIDSeasonID('Position', $Master_ID, $season);
        $depth = getPlayerFieldByMasterIDSeasonID('Depth', $Master_ID, $season);
        if ($depth === '0') {
            $depth = "";
        }

        $getStatsSeasons = db_query(returnGameLogQuery($Master_ID, $position));
        $seasonArray = [];

        if ($position === 'LT' || $position === 'RT' || $position === 'LG' || $position === 'RG' || $position === 'C' || $position === 'OL' || $position === 'H' || $position === 'LS') {
            while ($checkSeason = $getStatsSeasons->fetch_assoc()) {

                $nextSeason = $checkSeason['Season'];
                array_push($seasonArray, $nextSeason);
            }
        } else {

            while ($checkSeason = $getStatsSeasons->fetch_assoc()) {

                $nextSeason = getSeasonIDbyGameID($checkSeason['Game_ID']);
                array_push($seasonArray, $nextSeason);
            }
        }

        echo '<div class="card">';
        echo '<div class="card-header">';
        echo getSeason_Year($season) . ' Season - ' . $position . $depth;
        echo '</div>';
        echo '<div class="card-body">';
        echo '<table class="table table-sm">';
        echo '<thead>';

        if (in_array($season, $seasonArray)) {


            if ($position === 'QB') {
                echo '<tr><td colspan="3"></td><td style="border-left: solid black 2px; text-align: center" colspan="6">Passing</td><td style="border-left: solid black 2px; text-align: center" colspan="3">Rushing</td></tr>';
                echo '<th>Date</th><th>Opponent</th><th>Result</th><th colspan="2" style="border-left: solid black 2px"></th><th>%</th><th>Yards</th><th>TDs</th><th>INTs</th><th style="border-left: solid black 2px">Att</th><th>Yards</th><th>TDs</th>';
            }
            if ($position === 'FB' || $position === 'H-B' || $position === 'RB') {
                echo '<tr><td colspan="3"></td><td style="border-left: solid black 2px; text-align: center" colspan="3">Rushing</td><td style="border-left: solid black 2px; text-align: center" colspan="3">Receiving</td></tr>';
                echo '<th>Date</th><th>Opponent</th><th>Result</th><th style="border-left: solid black 2px">Att</th><th>Yards</th><th>TDs</th><th style="border-left: solid black 2px">Rec</th><th>Yards</th><th>TDs</th>';
            }
            if ($position === 'WR' || $position === 'TE') {
                echo '<tr><td colspan="3"></td><td style="border-left: solid black 2px; text-align: center" colspan="3">Receiving</td><td style="border-left: solid black 2px; text-align: center" colspan="3">Rushing</td></tr>';
                echo '<th>Date</th><th>Opponent</th><th>Result</th><th style="border-left: solid black 2px">Rec</th><th>Yards</th><th>TDs</th><th style="border-left: solid black 2px">Att</th><th>Yards</th><th>TDs</th>';
            }
            if ($position === 'CB' || $position === 'DB' || $position === 'DE' || $position === 'DL' || $position === 'DT' || $position === 'LB' || $position === 'MLB' || $position === 'OLB' || $position === 'S') {
                echo '<tr><td colspan="3"></td><td style="border-left: solid black 2px; text-align: center" colspan="9">Defense</td></tr>';
                echo '<th>Date</th><th>Opponent</th><th>Result</th><th style="border-left: solid black 2px">Tackles</th><th>For Loss</th><th>Sacks</th><th>INTs</th><th>INT TDs</th><th>PD</th><th>QB Hurr</th><th>Fum Rec</th><th>Fum TDs</th>';
            }
            if ($position === 'K') {
                echo '<tr><td colspan="3"></td><td style="border-left: solid black 2px; text-align: center" colspan="7">Kicking</td></tr>';
                echo '<th>Date</th><th>Opponent</th><th>Result</th><th style="border-left: solid black 2px">XPM</th><th>XPA</th><th>XP%</th><th>FGM</th><th>FGA</th><th>FG%</th><th>FG Long</th>';
            }
            if ($position === 'P') {
                echo '<tr><td colspan="3"></td><td style="border-left: solid black 2px; text-align: center" colspan="4">Punting</td></tr>';
                echo '<th>Date</th><th>Opponent</th><th>Result</th><th style="border-left: solid black 2px">Punts</th><th>Yards</th><th>Avg</th>';
            }
            if ($position === 'LT' || $position === 'RT' || $position === 'LG' || $position === 'RG' || $position === 'C' || $position === 'OL' || $position === 'H' || $position === 'LS') {
                echo '<tr><td colspan="8"></td></tr>';
            }
        }
        echo '</thead>';
        echo '<tbody>';

        $getStats = db_query(returnGameLogQuery($Master_ID, $position));

        if (in_array($season, $seasonArray)) {

            while ($fetchStats = $getStats->fetch_assoc()) {

                if ($position === 'LT' || $position === 'RT' || $position === 'LG' || $position === 'RG' || $position === 'C' || $position === 'OL' || $position === 'H' || $position === 'LS') {
                    $seasonID = $fetchStats['Season'];
                } else {
                    $seasonID = getSeasonIDbyGameID($fetchStats['Game_ID']);
                }

                if ($seasonID === $season) {
                    echo '<tr>';
                    if ($position === 'LT' || $position === 'RT' || $position === 'LG' || $position === 'RG' || $position === 'C' || $position === 'OL' || $position === 'H' || $position === 'LS') {
                        
                    } else {
                        echo '<td>' . returnGameFieldByGameID('Date', $fetchStats['Game_ID']) . '</td>';
                        echo '<td>' . returnVsAtN(returnGameFieldByGameID('H_A', $fetchStats['Game_ID'])) . " " . opponentLookup(returnGameFieldByGameID('Vs', $fetchStats['Game_ID'])) . '</td>';
                        echo '<td>' . returnGameOutcomeAbbrev(returnGameFieldByGameID('OSU_Score', $fetchStats['Game_ID']), returnGameFieldByGameID('Opp_Score', $fetchStats['Game_ID'])) . " " . returnGameFieldByGameID('OSU_Score', $fetchStats['Game_ID']) . " - " . returnGameFieldByGameID('Opp_Score', $fetchStats['Game_ID']) . '</td>';
                    }
                    if ($position === 'QB') {

                        echo '<td colspan="2" style="border-left: solid black 2px">' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'passing', 'Comp') . "/" . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'passing', 'Att') . '</td>';
                        echo '<td>' . number_format(returnGameStat($fetchStats['Game_ID'], $Master_ID, 'passing', 'Comp') / returnGameStat($fetchStats['Game_ID'], $Master_ID, 'passing', 'Att'), 2) * 100 . '%</td>';
                        echo '<td>' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'passing', 'Yards') . '</td>';
                        echo '<td>' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'passing', 'TDs') . '</td>';
                        echo '<td>' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'passing', 'INTs') . '</td>';
                        echo '<td style="border-left: solid black 2px">' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'rushing', 'Att') . '</td>';
                        echo '<td>' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'rushing', 'Yards') . '</td>';
                        echo '<td>' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'rushing', 'TDs') . '</td>';
                    }
                    if ($position === 'FB' || $position === 'H-B' || $position === 'RB') {
                        echo '<td style="border-left: solid black 2px">' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'rushing', 'Att') . '</td>';
                        echo '<td>' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'rushing', 'Yards') . '</td>';
                        echo '<td>' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'rushing', 'TDs') . '</td>';
                        echo '<td style="border-left: solid black 2px">' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'rec', 'Rec') . '</td>';
                        echo '<td>' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'rec', 'Yards') . '</td>';
                        echo '<td>' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'rec', 'TDs') . '</td>';
                    }
                    if ($position === 'WR' || $position === 'TE') {
                        echo '<td style="border-left: solid black 2px">' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'rec', 'Rec') . '</td>';
                        echo '<td>' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'rec', 'Yards') . '</td>';
                        echo '<td>' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'rec', 'TDs') . '</td>';
                        echo '<td style="border-left: solid black 2px">' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'rushing', 'Att') . '</td>';
                        echo '<td>' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'rushing', 'Yards') . '</td>';
                        echo '<td>' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'rushing', 'TDs') . '</td>';
                    }
                    if ($position === 'CB' || $position === 'DB' || $position === 'DE' || $position === 'DL' || $position === 'DT' || $position === 'LB' || $position === 'MLB' || $position === 'OLB' || $position === 'S') {
                        echo '<td style="border-left: solid black 2px">' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'def', 'Tackles') . '</td>';
                        echo '<td>' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'def', 'ForLoss') . '</td>';
                        echo '<td>' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'def', 'Sacks') . '</td>';
                        echo '<td>' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'def', 'INTs') . '</td>';
                        echo '<td>' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'def', 'INT_TDs') . '</td>';
                        echo '<td>' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'def', 'PassDef') . '</td>';
                        echo '<td>' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'def', 'QBHurries') . '</td>';
                        echo '<td>' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'def', 'FumbleRec') . '</td>';
                        echo '<td>' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'def', 'FumbleTDs') . '</td>';
                    }
                    if ($position === 'K') {
                        echo '<td style="border-left: solid black 2px">' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'kicking', 'XPA') . '</td>';
                        echo '<td>' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'kicking', 'XPM') . '</td>';
                        if (returnGameStat($fetchStats['Game_ID'], $Master_ID, 'kicking', 'XPA') > 0) {
                            $XP_Perc = toPercent(returnGameStat($fetchStats['Game_ID'], $Master_ID, 'kicking', 'XPM') / returnGameStat($fetchStats['Game_ID'], $Master_ID, 'kicking', 'XPA'));
                        } else {
                            echo '<td></td>';
                        }
                        echo '<td>' . $XP_Perc . '</td>';
                        echo '<td>' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'kicking', 'FGM') . '</td>';
                        echo '<td>' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'kicking', 'FGA') . '</td>';
                        if (returnGameStat($fetchStats['Game_ID'], $Master_ID, 'kicking', 'FGA') > 0) {
                            $FG_Perc = toPercent(returnGameStat($fetchStats['Game_ID'], $Master_ID, 'kicking', 'FGM') / returnGameStat($fetchStats['Game_ID'], $Master_ID, 'kicking', 'FGA'));
                            echo '<td>' . $FG_Perc . '</td>';
                            echo '<td>' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'kicking', 'LongKick') . '</td>';
                        } else {
                            echo '<td></td>';
                            echo '<td></td>';
                        }
                    }
                    if ($position === 'P') {
                        echo '<td style="border-left: solid black 2px">' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'punting', 'Att') . '</td>';
                        echo '<td>' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'punting', 'Yards') . '</td>';
                        $Punt_AVG = number_format(returnGameStat($fetchStats['Game_ID'], $Master_ID, 'punting', 'Yards') / returnGameStat($fetchStats['Game_ID'], $Master_ID, 'punting', 'Att'), 1);
                        echo '<td>' . $Punt_AVG . '</td>';
                        echo '<td>' . returnGameStat($fetchStats['Game_ID'], $Master_ID, 'punting', 'LongPunt') . '</td>';
                    }
                    if ($position === 'LT' || $position === 'RT' || $position === 'LG' || $position === 'RG' || $position === 'C' || $position === 'OL' || $position === 'H' || $position === 'LS') {
                        echo '<td colspan="8" style="text-align: center"><h4>No Stats Tracked For ' . $position . '</h4></td>';
                    }
                    echo '</tr>';
                }
            }
        } else {
            echo '<tr style="text-align: center"><td colspan="12"><h4>No Stats Accumulated</h4></td></tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
        echo '</div>';
        echo '<br><br>';
    }
}
//Return appropriate game log query based on player and position
function returnGameLogQuery($Player_Master_ID, $position) {

    if ($position === 'QB') {

        return "SELECT * FROM `stats_passing` WHERE Player_ID={$Player_Master_ID}";
    }
    if ($position === 'FB' || $position === 'H-B' || $position === 'RB') {

        return "SELECT * FROM `stats_rushing` WHERE Player_ID={$Player_Master_ID}";
    }
    if ($position === 'WR' || $position === 'TE') {

        return "SELECT * FROM `stats_rec` WHERE Player_ID={$Player_Master_ID}";
    }
    if ($position === 'CB' || $position === 'DB' || $position === 'DE' || $position === 'DL' || $position === 'DT' || $position === 'LB' || $position === 'MLB' || $position === 'OLB' || $position === 'S') {

        return "SELECT * FROM `stats_def` WHERE Player_ID={$Player_Master_ID}";
    }
    if ($position === 'K') {

        return "SELECT * FROM `stats_kicking` WHERE Player_ID={$Player_Master_ID}";
    }
    if ($position === 'P') {

        return "SELECT * FROM `stats_punting` WHERE Player_ID={$Player_Master_ID}";
    }
    if ($position === 'LT' || $position === 'RT' || $position === 'LG' || $position === 'RG' || $position === 'C' || $position === 'OL' || $position === 'H' || $position === 'LS') {

        return "SELECT * FROM `players` WHERE Player_Player_Master_ID={$Player_Master_ID}";
    }
}
