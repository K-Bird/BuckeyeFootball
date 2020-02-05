<?php
include ("../../libs/db/common_db_functions.php");

$Master_ID = $_POST['Master_ID'];
?>

<div class="row">
    <div class="col-lg-12">
<?php
if (oneStatRowExists('Passing', $Master_ID) === true) {
    echo returnPlayerDetailStatCard($Master_ID, 'Passing');
}

if (oneStatRowExists('Rushing', $Master_ID) === true) {
    echo '<br>';
    echo returnPlayerDetailStatCard($Master_ID, 'Rushing');
}
if (oneStatRowExists('rec', $Master_ID) === true) {
    echo '<br>';
    echo returnPlayerDetailStatCard($Master_ID, 'rec');
}
if (oneStatRowExists('def', $Master_ID) === true) {
    echo '<br>';
    echo returnPlayerDetailStatCard($Master_ID, 'def');
}
if (oneStatRowExists('ret', $Master_ID) === true) {
    echo '<br>';
    echo returnPlayerDetailStatCard($Master_ID, 'ret');
}
if (oneStatRowExists('Kicking', $Master_ID) === true) {
    echo '<br>';
    echo returnPlayerDetailStatCard($Master_ID, 'Kicking');
}
if (oneStatRowExists('Punting', $Master_ID) === true) {
    echo '<br>';
    echo returnPlayerDetailStatCard($Master_ID, 'Punting');
}
?>
    </div>
</div>
<?php
//Build the player detail stat card for the category sent
function returnPlayerDetailStatCard($master_ID, $category) {

    $getPlayerStatRows = db_query("SELECT * FROM `stats_{$category}` WHERE Player_ID='{$master_ID}'");

    $yearArray = [];

    while ($fetchPlayerStatRows = $getPlayerStatRows->fetch_assoc()) {

        $rowYear = getGameYear($fetchPlayerStatRows['Game_ID']);

        if (!in_array($rowYear, $yearArray)) {

            array_push($yearArray, $rowYear);
        }
    }
    $rowCount = mysqli_num_rows($getPlayerStatRows);


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
    foreach ($yearArray as $year) {
        echo '<tr>';
        //Build each year's stat summary based on the year, category and player master ID
        echo playerStatCardrow($category, $year, $master_ID);
        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';
    echo '</div>';
}
//Build the table rows for the player stat summary
function playerStatCardrow($category, $year, $master_ID) {

    if ($category === 'Passing') {

        $comp = 0;
        $att = 0;
        $yards = 0;
        $TDs = 0;
        $INTs = 0;
        $Rate = 0;
        $RateCount = 0;

        $getPassingStats = db_query("SELECT * FROM `stats_passing` WHERE Player_ID='{$master_ID}'");
        while ($fetchPassingStats = $getPassingStats->fetch_assoc()) {

            if (getGameYear($fetchPassingStats['Game_ID']) === $year) {

                $comp = $comp + $fetchPassingStats['Comp'];
                $att = $att + $fetchPassingStats['Att'];
                $yards = $yards + $fetchPassingStats['Yards'];
                $TDs = $TDs + $fetchPassingStats['TDs'];
                $INTs = $INTs + $fetchPassingStats['INTs'];
                $Rate = $Rate + $fetchPassingStats['Rate'];
                $RateCount++;
            }
        }

        $CompPercentage = $comp / $att;
        $RateAVG = $Rate / $RateCount;

        echo '<td>' . $year . '</td><td>' . $comp . '</td><td>' . $att . '</td><td>' . toPercent($CompPercentage) . '</td><td>' . number_format($yards) . '</td><td>' . $TDs . '</td><td>' . $INTs . '</td><td>' . number_format($RateAVG, 1) . '</td>';
    }

    if ($category === 'Rushing') {

        $att = 0;
        $yards = 0;
        $TDs = 0;

        $getRushingStats = db_query("SELECT * FROM `stats_rushing` WHERE Player_ID='{$master_ID}'");
        while ($fetchRushingStats = $getRushingStats->fetch_assoc()) {

            if (getGameYear($fetchRushingStats['Game_ID']) === $year) {

                $att = $att + $fetchRushingStats['Att'];
                $yards = $yards + $fetchRushingStats['Yards'];
                $TDs = $TDs + $fetchRushingStats['TDs'];
            }
        }

        echo '<td>' . $year . '</td><td>' . $att . '</td><td>' . number_format($yards) . '</td><td>' . $TDs . '</td>';
    }

    if ($category === 'rec') {

        $rec = 0;
        $yards = 0;
        $TDs = 0;

        $getReceivingStats = db_query("SELECT * FROM `stats_rec` WHERE Player_ID='{$master_ID}'");
        while ($fetchReceivingStats = $getReceivingStats->fetch_assoc()) {

            if (getGameYear($fetchReceivingStats['Game_ID']) === $year) {

                $rec = $rec + $fetchReceivingStats['Rec'];
                $yards = $yards + $fetchReceivingStats['Yards'];
                $TDs = $TDs + $fetchReceivingStats['TDs'];
            }
        }

        echo '<td>' . $year . '</td><td>' . $rec . '</td><td>' . number_format($yards) . '</td><td>' . $TDs . '</td>';
    }

    if ($category === 'def') {

        $tak = 0;
        $forloss = 0;
        $sacks = 0;
        $INTs = 0;
        $INTTDs = 0;
        $passDef = 0;
        $ff = 0;
        $fumRec = 0;
        $fumTDs = 0;

        $getDefStats = db_query("SELECT * FROM `stats_def` WHERE Player_ID='{$master_ID}'");
        while ($fetchDefStats = $getDefStats->fetch_assoc()) {

            if (getGameYear($fetchDefStats['Game_ID']) === $year) {

                $tak = $tak + $fetchDefStats['Tackles'];
                $forloss = $forloss + $fetchDefStats['ForLoss'];
                $sacks = $sacks + $fetchDefStats['Sacks'];
                $INTs = $INTs + $fetchDefStats['INTs'];
                $INTTDs = $INTTDs + $fetchDefStats['INT_TDs'];
                $passDef = $passDef + $fetchDefStats['PassDef'];
                $fumRec = $fumRec + $fetchDefStats['FumbleRec'];
                $fumTDs = $fumTDs + $fetchDefStats['FumbleTDs'];
            }
        }

        echo '<td>' . $year . '</td><td>' . $tak . '</td><td>' . $forloss . '</td><td>' . $sacks . '</td><td>' . $INTs . '</td><td>' . $INTTDs . '</td><td>' . $passDef . '</td><td>' . $ff . '</td><td>' . $fumRec . '</td><td>' . $fumTDs . '</td>';
    }

    if ($category === 'ret') {

        $KRs = 0;
        $KRyards = 0;
        $KRTDs = 0;
        $PRs = 0;
        $PRyards = 0;
        $PRTDs = 0;

        $getRetStats = db_query("SELECT * FROM `stats_ret` WHERE Player_ID='{$master_ID}'");
        while ($fetchRetStats = $getRetStats->fetch_assoc()) {

            if (getGameYear($fetchRetStats['Game_ID']) === $year) {

                $KRs = $KRs + $fetchRetStats['KR_Ret'];
                $KRyards = $KRyards + $fetchRetStats['KR_Yards'];
                $KRTDs = $KRTDs + $fetchRetStats['KR_TDs'];
                $PRs = $PRs + $fetchRetStats['PR_Ret'];
                $PRyards = $PRyards + $fetchRetStats['PR_Yards'];
                $PRTDs = $PRTDs + $fetchRetStats['PR_TDs'];
            }
        }

        echo '<td>' . $year . '</td><td>' . $KRs . '</td><td>' . $KRyards . '</td><td>' . $KRTDs . '</td><td>' . $PRs . '</td><td>' . $PRyards . '</td><td>' . $PRTDs . '</td>';
    }

    if ($category === 'Kicking') {

        $XPM = 0;
        $XPA = 0;
        $FGM = 0;
        $FGA = 0;
        $FGL = 0;

        $getKickingStats = db_query("SELECT * FROM `stats_kicking` WHERE Player_ID='{$master_ID}'");
        while ($fetchKickingStats = $getKickingStats->fetch_assoc()) {

            if (getGameYear($fetchKickingStats['Game_ID']) === $year) {

                $XPM = $XPM + $fetchKickingStats['XPM'];
                $XPA = $XPA + $fetchKickingStats['XPA'];
                $FGM = $FGM + $fetchKickingStats['FGM'];
                $FGA = $FGA + $fetchKickingStats['FGA'];
                if ($fetchKickingStats['LongKick'] > $FGL) {
                    $FGL = $fetchKickingStats['LongKick'];
                }
            }
        }

        $XP_Percent = $XPM / $XPA;
        $FG_Percent = $FGM / $FGA;

        echo '<td>' . $year . '</td><td>' . $XPM . '</td><td>' . $XPA . '</td><td>' . toPercent($XP_Percent) . '</td><td>' . $FGM . '</td><td>' . $FGA . '</td><td>' . toPercent($FG_Percent) . '</td><td>' . $FGL . '</td>';
    }

    if ($category === 'Punting') {

        $punts = 0;
        $puntYards = 0;
        $puntLong = 0;

        $getPuntingStats = db_query("SELECT * FROM `stats_punting` WHERE Player_ID='{$master_ID}'");
        while ($fetchPuntingStats = $getPuntingStats->fetch_assoc()) {

            if (getGameYear($fetchPuntingStats['Game_ID']) === $year) {

                $punts = $punts + $fetchPuntingStats['Att'];
                $puntYards = $puntYards + $fetchPuntingStats['Yards'];
                if ($fetchPuntingStats['LongPunt'] > $puntLong) {
                    $puntLong = $fetchPuntingStats['LongPunt'];
                }
            }
        }

        $punt_Avg = $puntYards / $punts;

        echo '<td>' . $year . '</td><td>' . $punts . '</td><td>' . $puntYards . '</td><td>' . number_format($punt_Avg, 1) . '</td><td>' . $puntLong . '</td>';
    }
}
//Check to see if the player has at least one row for the provided category || If so return true, If not return false
function oneStatRowExists($category, $master_ID) {

    $checkStatRow = db_query("SELECT * FROM `stats_{$category}` WHERE Player_ID='{$master_ID}'");
    $num_rows = mysqli_num_rows($checkStatRow);

    if ($num_rows > 0) {
        return true;
    } else {
        return false;
    }
}