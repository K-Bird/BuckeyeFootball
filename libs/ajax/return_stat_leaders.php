<?php

include ("../../libs/db/common_db_functions.php");

$stat = $_POST['stat'];
$start = $_POST['start'];
$end = $_POST['end'];


echo '<div id="leadersDiv">';
echo '<br><br>';
echo '<table id="leadersTable" class="table table-sm">';

echo '<thead>';
echo returnStatLeaderHeadings($stat);
echo '</thead>';

echo '<tbody>';
echo returnStatLeaderBody($stat, $start, $end);
echo '</tbody>';

echo '</table>';

echo '</div>';

function returnStatLeaderHeadings($stat) {

    /* Passing Stats */
    if ($stat === "passComp" || $stat === "passAtt" || $stat === "passYards" || $stat === "passTDs" || $stat === "passINTs" || $stat === "passPerc") {

        echo '<th>Rank</th>';
        echo '<th>Player</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'passComp') {
            echo ' class="table-secondary" ';
        }
        echo '>Completions</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'passAtt') {
            echo ' class="table-secondary" ';
        }
        echo '>Attempts</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'passPerc') {
            echo ' class="table-secondary" ';
        }
        echo '>Completion Percentage</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'passYards') {
            echo ' class="table-secondary" ';
        }
        echo '>Yards</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'passTDs') {
            echo ' class="table-secondary" ';
        }
        echo '>TDs</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'passINTs') {
            echo ' class="table-secondary" ';
        }
        echo '>INTs</th>';
    }
    /* Rushing Stats */
    if ($stat === "rushAtt" || $stat === "rushYards" || $stat === "rushTDs" || $stat === "rushYPC") {

        echo '<th>Rank</th>';
        echo '<th>Player</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'rushAtt') {
            echo ' class="table-secondary" ';
        }
        echo '>Attempts</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'rushYards') {
            echo ' class="table-secondary" ';
        }
        echo '>Yards</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'rushYPC') {
            echo ' class="table-secondary" ';
        }
        echo '>Yards Per Attempt</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'rushTDs') {
            echo ' class="table-secondary" ';
        }
        echo '>TDs</th>';
    }
    /* Recieving Stats */
    if ($stat === "recRec" || $stat === "recYards" || $stat === "recTDs" || $stat === "recYPC") {

        echo '<th>Rank</th>';
        echo '<th>Player</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'recRec') {
            echo ' class="table-secondary" ';
        }
        echo '>Receptions</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'recYards') {
            echo ' class="table-secondary" ';
        }
        echo '>Yards</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'recYPC') {
            echo ' class="table-secondary" ';
        }
        echo '>Yards Per Catch</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'recTDs') {
            echo ' class="table-secondary" ';
        }
        echo '>TDs</th>';
    }
    /* Defensive Stats */
    if ($stat === "defTackles" || $stat === "defForLoss" || $stat === "defSacks" || $stat === "defINTs" || $stat === "defINT_TDs" || $stat === "defPassDef" || $stat === "defQBHurries" || $stat === "defFumbleRec" || $stat === "defFumbleTDs") {

        echo '<th>Rank</th>';
        echo '<th>Player</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'defTackles') {
            echo ' class="table-secondary" ';
        }
        echo '>Tackles</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'defForLoss') {
            echo ' class="table-secondary" ';
        }
        echo '>For Loss</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'defSacks') {
            echo ' class="table-secondary" ';
        }
        echo '>Sacks</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'defINTs') {
            echo ' class="table-secondary" ';
        }
        echo '>INTs</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'defINT_TDs') {
            echo ' class="table-secondary" ';
        }
        echo '>INT TDs</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'defPassDef') {
            echo ' class="table-secondary" ';
        }
        echo '>Passes Defended</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'defQBHurries') {
            echo ' class="table-secondary" ';
        }
        echo '>QB Hurries</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'defFumbleRec') {
            echo ' class="table-secondary" ';
        }
        echo '>Fumble Recoveries</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'defFumbleTDs') {
            echo ' class="table-secondary" ';
        }
        echo '>Fumble TDs</th>';
    }
    /* Return Stats */
    if ($stat === "KR_Att" || $stat === "KR_Yards" || $stat === "KR_AVG" || $stat === "KR_TDs" || $stat === "PR_Att" || $stat === "PR_Yards" || $stat === "PR_AVG" || $stat === "PR_TDs") {

        echo '<th>Rank</th>';
        echo '<th>Player</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'KR_Att') {
            echo ' class="table-secondary" ';
        }
        echo '>Kick Returns</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'KR_Yards') {
            echo ' class="table-secondary" ';
        }
        echo '>Kick Return Yards</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'KR_AVG') {
            echo ' class="table-secondary" ';
        }
        echo '>Kick Return Average</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'KR_TDs') {
            echo ' class="table-secondary" ';
        }
        echo '>Kick Return TDs</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'PR_Att') {
            echo ' class="table-secondary" ';
        }
        echo '>Punt Returns</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'PR_Yards') {
            echo ' class="table-secondary" ';
        }
        echo '>Punt Return Yards</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'PR_AVG') {
            echo ' class="table-secondary" ';
        }
        echo '>Punt Return Average</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'PR_TDs') {
            echo ' class="table-secondary" ';
        }
        echo '>Punt Return TDs</th>';
    }
    /* Kicking Stats */
    if ($stat === "kickFGM" || $stat === 'kickFGA' || $stat == 'kickFGP' || $stat == 'kickLong') {

        echo '<th>Rank</th>';
        echo '<th>Player</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'kickFGM') {
            echo ' class="table-secondary" ';
        }
        echo '>Field Goals Made</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'kickFGA') {
            echo ' class="table-secondary" ';
        }
        echo '>Field Goal Attempts</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'kickFGP') {
            echo ' class="table-secondary" ';
        }
        echo '>Field Goal Percentage</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'kickLong') {
            echo ' class="table-secondary" ';
        }
        echo '>Longest Field Goal</th>';
    }
    /* Punting Stats */
    if ($stat === "puntYards" || $stat === "puntAtt" || $stat === "puntAVG" || $stat === "puntLong") {

        echo '<th>Rank</th>';
        echo '<th>Player</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'puntAtt') {
            echo ' class="table-secondary" ';
        }
        echo '>Punt Attempts</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'puntYards') {
            echo ' class="table-secondary" ';
        }
        echo '>Punt Yards</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'puntAVG') {
            echo ' class="table-secondary" ';
        }
        echo '>Punt Average</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($stat === 'puntLong') {
            echo ' class="table-secondary" ';
        }
        echo '>Punt Long</th>';
    }
    /* Misc Stats */
    if ($stat === "rushYardsQB") {

        echo '<th>Rank</th>';
        echo '<th>Player</th>';
        echo '<th data-sort="int" data-sort-default="desc">';
        echo 'Rush Yards';
        echo '</th>';
    }
    if ($stat === "rushTDsQB") {

        echo '<th>Rank</th>';
        echo '<th>Player</th>';
        echo '<th data-sort="int" data-sort-default="desc">';
        echo 'Rush TDs';
        echo '</th>';
    }
}

function returnStatLeaderBody($stat, $start, $end) {

    $rank = 0;
    $start_ID = getSeason_ID($start);
    $end_ID = getSeason_ID($end);

    $leaderQuery = "";

    //If a passing stat is selected create the leader table body in rank order of the stat
    if ($stat == "passComp" || $stat === "passAtt" || $stat === "passYards" || $stat === "passTDs" || $stat === "passINTs" || $stat === "passPerc") {
        $leaderQuery = "select Player_ID,sum(Comp) as passComp, sum(Att) as passAtt, sum(Yards) as passYards, sum(TDs) as passTDs, sum(INTs) as passINTs, sum(Comp) / sum(Att) as passPerc
        from stats_passing_agg
        where Season_ID between {$start_ID} AND {$end_ID}
        group by Player_ID order by {$stat} DESC limit 50";

        $getLeaders = db_query($leaderQuery);
        while ($fetchLeaders = $getLeaders->fetch_assoc()) {
            $rank++;
            echo '<tr>';
            echo '<td>';
            echo $rank;
            echo '</td>';
            echo '<td>';
            echo '<form action="playerDetails.php" method="POST" name="playerDetailForm">';
            echo '<span><h6><button type="submit" class="playerDetailLink btn btn-sm" style="font-size : small">', returnPlayerName($fetchLeaders['Player_ID']), '</button></h6></span>';
            echo '<input type="hidden" name="Player_Master_ID" value="', $fetchLeaders['Player_ID'], '"/>';
            echo '</form>';
            echo '</td>';
            echo '<td';
            if ($stat === 'passComp') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchLeaders['passComp'];
            echo '</td>';
            echo '<td';
            if ($stat === 'passAtt') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchLeaders['passAtt'];
            echo '</td>';
            echo '<td';
            if ($stat === 'passPerc') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo number_format($fetchLeaders['passPerc'] * 100, 1) . "%";
            echo '</td>';
            echo '<td';
            if ($stat === 'passYards') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchLeaders['passYards'];
            echo '</td>';
            echo '<td';
            if ($stat === 'passTDs') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchLeaders['passTDs'];
            echo '</td>';
            echo '<td';
            if ($stat === 'passINTs') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchLeaders['passINTs'];
            echo '</td>';
        }
    }
    //If a rushing stat is selected create the leader table body in rank order of the stat
    if ($stat == "rushAtt" || $stat === "rushYards" || $stat === "rushTDs" || $stat === "rushYPC") {
        $leaderQuery = "select Player_ID, sum(Att) as rushAtt, sum(Yards) as rushYards, sum(TDs) as rushTDs, (sum(Yards) / sum(Att)) as rushYPC
        from stats_rushing_agg
        where Season_ID between {$start_ID} AND {$end_ID}
        group by Player_ID order by {$stat} DESC limit 50";

        $getRush = db_query($leaderQuery);
        while ($fetchRush = $getRush->fetch_assoc()) {
            $rank++;
            echo '<tr>';
            echo '<td>';
            echo $rank;
            echo '</td>';
            echo '<td>';
            echo '<form action="playerDetails.php" method="POST" name="playerDetailForm">';
            echo '<span><h6><button type="submit" class="playerDetailLink btn btn-sm" style="font-size : small">', returnPlayerName($fetchRush['Player_ID']), '</button></h6></span>';
            echo '<input type="hidden" name="Player_Master_ID" value="', $fetchRush['Player_ID'], '"/>';
            echo '</form>';
            echo '</td>';
            echo '<td';
            if ($stat === 'rushAtt') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchRush['rushAtt'];
            echo '</td>';
            echo '<td';
            if ($stat === 'rushYards') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchRush['rushYards'];
            echo '</td>';
            echo '<td';
            if ($stat === 'rushYPC') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo number_format($fetchRush['rushYPC'], 1);
            echo '</td>';
            echo '<td';
            if ($stat === 'rushTDs') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchRush['rushTDs'];
            echo '</td>';
        }
    }
    //If a recieving stat is selected create the leader table body in rank order of the stat
    if ($stat == "recRec" || $stat === "recYards" || $stat === "recTDs" || $stat === "recYPC") {
        $leaderQuery = "select Player_ID, sum(Rec) as recRec, sum(Yards) as recYards, sum(TDs) as recTDs, (sum(Yards) / sum(Rec)) as recYPC
        from stats_rec_agg
        where Season_ID between {$start_ID} AND {$end_ID}
        group by Player_ID order by {$stat} DESC limit 50";

        $getRec = db_query($leaderQuery);
        while ($fetchRec = $getRec->fetch_assoc()) {
            $rank++;
            echo '<tr>';
            echo '<td>';
            echo $rank;
            echo '</td>';
            echo '<td>';
            echo '<form action="playerDetails.php" method="POST" name="playerDetailForm">';
            echo '<span><h6><button type="submit" class="playerDetailLink btn btn-sm" style="font-size : small">', returnPlayerName($fetchRec['Player_ID']), '</button></h6></span>';
            echo '<input type="hidden" name="Player_Master_ID" value="', $fetchRec['Player_ID'], '"/>';
            echo '</form>';
            echo '</td>';
            echo '<td';
            if ($stat === 'recRec') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchRec['recRec'];
            echo '</td>';
            echo '<td';
            if ($stat === 'recYards') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchRec['recYards'];
            echo '</td>';
            echo '<td';
            if ($stat === 'recYPC') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo number_format($fetchRec['recYPC'], 1);
            echo '</td>';
            echo '<td';
            if ($stat === 'recTDs') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchRec['recTDs'];
            echo '</td>';
        }
    }
    //If a defensive stat is selected create the leader table body in rank order of the stat
    if ($stat === "defTackles" || $stat === "defForLoss" || $stat === "defSacks" || $stat === "defINTs" || $stat === "defINT_TDs" || $stat === "defPassDef" || $stat === "defQBHurries" || $stat === "defFumbleRec" || $stat === "defFumbleTDs") {
        $leaderQuery = "select Player_ID, sum(Tackles) as defTackles, sum(ForLoss) as defForLoss, sum(Sacks) as defSacks, sum(INTs) as defINTs, sum(INT_TDs) as defINT_TDs, sum(PassDef) as defPassDef, sum(QBHurries) as defQBHurries, sum(FumbleRec) as defFumbleRec, sum(FumbleTDs) as defFumbleTDs
        from stats_def_agg
        where Season_ID between {$start_ID} AND {$end_ID}
        group by Player_ID order by {$stat} DESC limit 50";

        $getDef = db_query($leaderQuery);
        while ($fetchDef = $getDef->fetch_assoc()) {
            $rank++;
            echo '<tr>';
            echo '<td>';
            echo $rank;
            echo '</td>';
            echo '<td>';
            echo '<form action="playerDetails.php" method="POST" name="playerDetailForm">';
            echo '<span><h6><button type="submit" class="playerDetailLink btn btn-sm" style="font-size : small">', returnPlayerName($fetchDef['Player_ID']), '</button></h6></span>';
            echo '<input type="hidden" name="Player_Master_ID" value="', $fetchDef['Player_ID'], '"/>';
            echo '</form>';
            echo '</td>';
            echo '<td';
            if ($stat === 'defTackles') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchDef['defTackles'];
            echo '</td>';
            echo '<td';
            if ($stat === 'defForLoss') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchDef['defForLoss'];
            echo '</td>';
            echo '<td';
            if ($stat === 'defSacks') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo number_format($fetchDef['defSacks'], 1);
            echo '</td>';
            echo '<td';
            if ($stat === 'defINTs') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchDef['defINTs'];
            echo '</td>';
            echo '<td';
            if ($stat === 'defINT_TDs') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchDef['defINT_TDs'];
            echo '</td>';
            echo '<td';
            if ($stat === 'defPassDef') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchDef['defPassDef'];
            echo '</td>';
            echo '<td';
            if ($stat === 'defQBHurries') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchDef['defQBHurries'];
            echo '</td>';
            echo '<td';
            if ($stat === 'defFumbleRec') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchDef['defFumbleRec'];
            echo '</td>';
            echo '<td';
            if ($stat === 'defFumbleTDs') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchDef['defFumbleTDs'];
            echo '</td>';
        }
    }
    //If a return stat is selected create the leader table body in rank order of the stat
    if ($stat === "KR_Att" || $stat === "KR_Yards" || $stat === "KR_AVG" || $stat === "KR_TDs" || $stat === "PR_Att" || $stat === "PR_Yards" || $stat === "PR_AVG" || $stat === "PR_TDs") {
        $leaderQuery = "select Player_ID, sum(KR_Ret) as KR_Att, sum(KR_Yards) as KR_Yards, sum(KR_Yards) / sum(KR_Ret) as KR_AVG, sum(KR_TDs) as KR_TDs, sum(PR_Ret) as PR_Att, sum(PR_Yards) as PR_Yards, sum(PR_Yards) / sum(PR_Ret) as PR_AVG, sum(PR_TDs) as PR_TDs
        from stats_ret_agg
        where Season_ID between {$start_ID} AND {$end_ID}
        group by Player_ID order by {$stat} DESC limit 50";

        $getReturns = db_query($leaderQuery);
        while ($fetchReturns = $getReturns->fetch_assoc()) {
            $rank++;
            echo '<tr>';
            echo '<td>';
            echo $rank;
            echo '</td>';
            echo '<td>';
            echo '<form action="playerDetails.php" method="POST" name="playerDetailForm">';
            echo '<span><h6><button type="submit" class="playerDetailLink btn btn-sm" style="font-size : small">', returnPlayerName($fetchReturns['Player_ID']), '</button></h6></span>';
            echo '<input type="hidden" name="Player_Master_ID" value="', $fetchReturns['Player_ID'], '"/>';
            echo '</form>';
            echo '</td>';
            echo '<td';
            if ($stat === 'KR_Att') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchReturns['KR_Att'];
            echo '</td>';
            echo '<td';
            if ($stat === 'KR_Yards') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchReturns['KR_Yards'];
            echo '</td>';
            echo '<td';
            if ($stat === 'KR_AVG') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo number_format($fetchReturns['KR_AVG'], 1);
            echo '</td>';
            echo '<td';
            if ($stat === 'KR_TDs') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchReturns['KR_TDs'];
            echo '</td>';
            echo '<td';
            if ($stat === 'PR_Att') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchReturns['PR_Att'];
            echo '</td>';
            echo '<td';
            if ($stat === 'PR_Yards') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchReturns['PR_Yards'];
            echo '</td>';
            echo '<td';
            if ($stat === 'PR_AVG') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo number_format($fetchReturns['PR_AVG'], 1);
            echo '</td>';
            echo '<td';
            if ($stat === 'PR_TDs') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchReturns['PR_TDs'];
            echo '</td>';
        }
    }
    //If a kicking stat is selected create the leader table body in rank order of the stat
    if ($stat === "kickFGM" || $stat === "kickFGA" || $stat == 'kickFGP' || $stat == 'kickLong') {
        $leaderQuery = "select Player_ID, sum(FGM) as kickFGM, sum(FGA) as kickFGA, sum(FGM) / sum(FGA) as kickFGP, max(LongKick) as kickLong
        from stats_kicking_agg
        where Season_ID between {$start_ID} AND {$end_ID}
        group by Player_ID order by {$stat} DESC limit 50";

        $getKicking = db_query($leaderQuery);
        while ($fetchKicking = $getKicking->fetch_assoc()) {
            $rank++;
            echo '<tr>';
            echo '<td>';
            echo $rank;
            echo '</td>';
            echo '<td>';
            echo '<form action="playerDetails.php" method="POST" name="playerDetailForm">';
            echo '<span><h6><button type="submit" class="playerDetailLink btn btn-sm" style="font-size : small">', returnPlayerName($fetchKicking['Player_ID']), '</button></h6></span>';
            echo '<input type="hidden" name="Player_Master_ID" value="', $fetchKicking['Player_ID'], '"/>';
            echo '</form>';
            echo '</td>';
            echo '<td';
            if ($stat === 'kickFGM') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchKicking['kickFGM'];
            echo '</td>';
            echo '<td';
            if ($stat === 'kickFGA') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchKicking['kickFGA'];
            echo '</td>';
            echo '<td';
            if ($stat === 'kickFGP') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo number_format($fetchKicking['kickFGP'] * 100, 0) . "%";
            echo '</td>';
            echo '<td';
            if ($stat === 'kickLong') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchKicking['kickLong'];
            echo '</td>';
        }
    }
    //If a punting stat is selected create the leader table body in rank order of the stat
    if ($stat === "puntYards" || $stat === "puntAtt" || $stat === "puntAVG" || $stat === "puntLong") {
        $leaderQuery = "select Player_ID, sum(Yards) as puntYards, sum(Att) as puntAtt, sum(Yards) / sum(Att) as puntAVG, max(LongPunt) as puntLong
        from stats_punting_agg
        where Season_ID between {$start_ID} AND {$end_ID}
        group by Player_ID order by {$stat} DESC limit 50";

        $getPunting = db_query($leaderQuery);
        while ($fetchPunting = $getPunting->fetch_assoc()) {
            $rank++;
            echo '<tr>';
            echo '<td>';
            echo $rank;
            echo '</td>';
            echo '<td>';
            echo '<form action="playerDetails.php" method="POST" name="playerDetailForm">';
            echo '<span><h6><button type="submit" class="playerDetailLink btn btn-sm" style="font-size : small">', returnPlayerName($fetchPunting['Player_ID']), '</button></h6></span>';
            echo '<input type="hidden" name="Player_Master_ID" value="', $fetchPunting['Player_ID'], '"/>';
            echo '</form>';
            echo '</td>';
            echo '<td';
            if ($stat === 'puntAtt') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchPunting['puntAtt'];
            echo '</td>';
            echo '<td';
            if ($stat === 'puntYards') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchPunting['puntYards'];
            echo '</td>';
            echo '<td';
            if ($stat === 'puntAVG') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo number_format($fetchPunting['puntAVG'], 1);
            echo '</td>';
            echo '<td';
            if ($stat === 'puntLong') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchPunting['puntLong'];
            echo '</td>';
        }
    }
    //If a misc stat is selected create the leader table body in rank order of the stat
    if ($stat == "rushYardsQB") {
        $leaderQuery = "select Player_ID, sum(Yards) as rushYards
        from stats_rushing_agg
        where Season_ID between {$start_ID} AND {$end_ID}
        group by Player_ID order by rushYards DESC limit 50";

        $getRush = db_query($leaderQuery);
        while ($fetchRush = $getRush->fetch_assoc()) {
            
            if (playerWasQB($fetchRush['Player_ID']) === false) {
                
            } else {

                $rank++;
                echo '<tr>';
                echo '<td>';
                echo $rank;
                echo '</td>';
                echo '<td>';
                echo '<form action="playerDetails.php" method="POST" name="playerDetailForm">';
                echo '<span><h6><button type="submit" class="playerDetailLink btn btn-sm" style="font-size : small">', returnPlayerName($fetchRush['Player_ID']), '</button></h6></span>';
                echo '<input type="hidden" name="Player_Master_ID" value="', $fetchRush['Player_ID'], '"/>';
                echo '</form>';
                echo '</td>';
                echo '<td>';
                echo $fetchRush['rushYards'];
                echo '</td>';
            }
        }
    }
    if ($stat == "rushTDsQB") {
        $leaderQuery = "select Player_ID, sum(TDs) as rushTDs
        from stats_rushing_agg
        where Season_ID between {$start_ID} AND {$end_ID}
        group by Player_ID order by rushTDs DESC limit 50";

        $getRush = db_query($leaderQuery);
        while ($fetchRush = $getRush->fetch_assoc()) {

            if (playerWasQB($fetchRush['Player_ID']) === false) {
                
            } else {

                $rank++;
                echo '<tr>';
                echo '<td>';
                echo $rank;
                echo '</td>';
                echo '<td>';
                echo '<form action="playerDetails.php" method="POST" name="playerDetailForm">';
                echo '<span><h6><button type="submit" class="playerDetailLink btn btn-sm" style="font-size : small">', returnPlayerName($fetchRush['Player_ID']), '</button></h6></span>';
                echo '<input type="hidden" name="Player_Master_ID" value="', $fetchRush['Player_ID'], '"/>';
                echo '</form>';
                echo '</td>';
                echo '<td>';
                echo $fetchRush['rushTDs'];
                echo '</td>';
            }
        }
    }
}
