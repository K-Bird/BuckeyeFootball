<?php

include ("../../libs/db/common_db_functions.php");

$GM_ID = $_POST['GM_ID'];

echo returnGameDetailStatCard($GM_ID, 'Passing') . '<br>';
echo returnGameDetailStatCard($GM_ID, 'Rushing') . '<br>';
echo returnGameDetailStatCard($GM_ID, 'rec') . '<br>';
echo returnGameDetailStatCard($GM_ID, 'def') . '<br>';
echo returnGameDetailStatCard($GM_ID, 'ret') . '<br>';
echo returnGameDetailStatCard($GM_ID, 'Kicking') . '<br>';
echo returnGameDetailStatCard($GM_ID, 'Punting');

//Build a game detail stat card for given stat category
function returnGameDetailStatCard($GM_ID, $category) {

    echo '<div class="card">';
    echo '<div class="card-header">';
    echo categoryToTitle($category);
    echo '</div>';
    echo '<div class="card-body">';
    echo '<table class="table">';
    echo '<thead><tr>';
    //Build table header based on category
    echo playerStatCardthead($category);
    echo '<tr></thead>';
    //Build each year's stat summary based on the year, category and player master ID
    echo gameStatCardRows($category, $GM_ID);
    echo '</table>';
    echo '</div>';
    echo '</div>';
}

//Build the rows for a game detail stat category
function gameStatCardRows($category, $GM_ID) {

    $getPlayerStatRows = db_query("SELECT * FROM `stats_{$category}` WHERE Game_ID='{$GM_ID}'");

    if (mysqli_num_rows($getPlayerStatRows) < 1) {
        echo '<tr><td>No ' . $category . ' Stats</td></tr>';
    } else {
        while ($fetchPlayerStatRows = $getPlayerStatRows->fetch_assoc()) {
            $master_ID = $fetchPlayerStatRows['Player_ID'];

            if ($category === 'Passing') {
                $comp = $fetchPlayerStatRows['Comp'];
                $att = $fetchPlayerStatRows['Att'];
                $yards = $fetchPlayerStatRows['Yards'];
                $TDs = $fetchPlayerStatRows['TDs'];
                $INTs = $fetchPlayerStatRows['INTs'];
                $Rate = $fetchPlayerStatRows['Rate'];

                $CompPercentage = $comp / $att;

                echo '<tr><td>' . returnPlayerName($master_ID) . '</td><td>' . $comp . '</td><td>' . $att . '</td><td>' . toPercent($CompPercentage) . '</td><td>' . number_format($yards) . '</td><td>' . $TDs . '</td><td>' . $INTs . '</td><td>' . number_format($Rate, 1) . '</td></tr>';
            }
            if ($category === 'Rushing') {
                $att = $fetchPlayerStatRows['Att'];
                $yards = $fetchPlayerStatRows['Yards'];
                $TDs = $fetchPlayerStatRows['TDs'];
                echo '<tr><td>' . returnPlayerName($master_ID) . '</td><td>' . $att . '</td><td>' . number_format($yards) . '</td><td>' . $TDs . '</td></tr>';
            }
            if ($category === 'rec') {
                $rec = $fetchPlayerStatRows['Rec'];
                $yards = $fetchPlayerStatRows['Yards'];
                $TDs = $fetchPlayerStatRows['TDs'];
                echo '<tr><td>' . returnPlayerName($master_ID) . '</td><td>' . $rec . '</td><td>' . number_format($yards) . '</td><td>' . $TDs . '</td></tr>';
            }
            if ($category === 'def') {
                $tak = $fetchPlayerStatRows['Tackles'];
                $forloss = $fetchPlayerStatRows['ForLoss'];
                $sacks = $fetchPlayerStatRows['Sacks'];
                $INTs = $fetchPlayerStatRows['INTs'];
                $INTTDs = $fetchPlayerStatRows['INT_TDs'];
                $passDef = $fetchPlayerStatRows['PassDef'];
                $QBHurries = $fetchPlayerStatRows['QBHurries'];
                $fumRec = $fetchPlayerStatRows['FumbleRec'];
                $fumTDs = $fetchPlayerStatRows['FumbleTDs'];
                echo '<tr><td>' . returnPlayerName($master_ID) . '</td><td>' . $tak . '</td><td>' . $forloss . '</td><td>' . $sacks . '</td><td>' . $INTs . '</td><td>' . $INTTDs . '</td><td>' . $passDef . '</td><td>' . $QBHurries . '</td><td>' . $fumRec . '</td><td>' . $fumTDs . '</td></tr>';
            }
            if ($category === 'ret') {
                $KRs = $fetchPlayerStatRows['KR_Ret'];
                $KRyards = $fetchPlayerStatRows['KR_Yards'];
                $KRTDs = $fetchPlayerStatRows['KR_TDs'];
                $PRs = $fetchPlayerStatRows['PR_Ret'];
                $PRyards = $fetchPlayerStatRows['PR_Yards'];
                $PRTDs = $fetchPlayerStatRows['PR_TDs'];
                echo '<tr><td>' . returnPlayerName($master_ID) . '</td><td>' . $KRs . '</td><td>' . $KRyards . '</td><td>' . $KRTDs . '</td><td>' . $PRs . '</td><td>' . $PRyards . '</td><td>' . $PRTDs . '</td></tr>';
            }
            if ($category === 'Kicking') {
                $XPM = $fetchPlayerStatRows['XPM'];
                $XPA = $fetchPlayerStatRows['XPA'];
                $FGM = $fetchPlayerStatRows['FGM'];
                $FGA = $fetchPlayerStatRows['FGA'];
                $Long = $fetchPlayerStatRows['LongKick'];

                if ($XPA > 0) {
                    $XP_Percent = $XPM / $XPA;
                } else {
                    $XP_Percent = 0;

                    if ($FGA > 0) {
                        $FG_Percent = $FGM / $FGA;
                    } else {
                        $FG_Percent = 0;

                        echo '<td>' . returnPlayerName($master_ID) . '</td><td>' . $XPM . '</td><td>' . $XPA . '</td><td>' . toPercent($XP_Percent) . '</td><td>' . $FGM . '</td><td>' . $FGA . '</td><td>' . toPercent($FG_Percent) . '</td><td>' . $Long . '</td>';
                    }
                    if ($category === 'Punting') {
                        $punts = $fetchPlayerStatRows['Att'];
                        $puntYards = $fetchPlayerStatRows['Yards'];
                        $Long = $fetchPlayerStatRows['LongPunt'];
                        $punt_Avg = $puntYards / $punts;

                        echo '<td>' . returnPlayerName($master_ID) . '</td><td>' . $punts . '</td><td>' . $puntYards . '</td><td>' . number_format($punt_Avg, 1) . '</td><td>' . $Long . '</td>';
                    }
                }
            }
        }
    }
}