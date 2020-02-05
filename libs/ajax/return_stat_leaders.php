<?php

include ("../../libs/db/common_db_functions.php");

$category = $_POST['stat'];
$startYear = $_POST['start'];
$endYear = $_POST['end'];


echo '<div id="leadersDiv">';
echo '<br><br>';
echo '<table id="leadersTable" class="table table-sm">';

echo '<thead>';
echo returnStatLeaderHeadings($category);
echo '</thead>';

echo '<tbody>';
echo returnStatLeaderBody($category, $startYear, $endYear);
echo '</tbody>';

echo '</table>';

echo '</div>';

function returnStatLeaderHeadings($category) {

    /* Passing Stats */
    if ($category === "passComp" || $category === "passAtt" || $category === "passYards" || $category === "passTDs" || $category === "passINTs" || $category === "passPerc") {

        echo '<th>Rank</th>';
        echo '<th>Player</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'passComp') {
            echo ' class="table-secondary" ';
        }
        echo '>Completions</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'passAtt') {
            echo ' class="table-secondary" ';
        }
        echo '>Attempts</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'passPerc') {
            echo ' class="table-secondary" ';
        }
        echo '>Completion Percentage</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'passYards') {
            echo ' class="table-secondary" ';
        }
        echo '>Yards</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'passTDs') {
            echo ' class="table-secondary" ';
        }
        echo '>TDs</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'passINTs') {
            echo ' class="table-secondary" ';
        }
        echo '>INTs</th>';
    }
    /* Rushing Stats */
    if ($category === "rushAtt" || $category === "rushYards" || $category === "rushTDs" || $category === "rushYPC") {

        echo '<th>Rank</th>';
        echo '<th>Player</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'rushAtt') {
            echo ' class="table-secondary" ';
        }
        echo '>Attempts</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'rushYards') {
            echo ' class="table-secondary" ';
        }
        echo '>Yards</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'rushYPC') {
            echo ' class="table-secondary" ';
        }
        echo '>Yards Per Attempt</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'rushTDs') {
            echo ' class="table-secondary" ';
        }
        echo '>TDs</th>';
    }
    /* Recieving Stats */
    if ($category === "recRec" || $category === "recYards" || $category === "recTDs" || $category === "recYPC") {

        echo '<th>Rank</th>';
        echo '<th>Player</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'recRec') {
            echo ' class="table-secondary" ';
        }
        echo '>Receptions</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'recYards') {
            echo ' class="table-secondary" ';
        }
        echo '>Yards</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'recYPC') {
            echo ' class="table-secondary" ';
        }
        echo '>Yards Per Catch</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'recTDs') {
            echo ' class="table-secondary" ';
        }
        echo '>TDs</th>';
    }
    /* Defensive Stats */
    if ($category === "defTackles" || $category === "defForLoss" || $category === "defSacks" || $category === "defINTs" || $category === "defINT_TDs" || $category === "defPassDef" || $category === "defQBHurries" || $category === "defFumbleRec" || $category === "defFumbleTDs") {

        echo '<th>Rank</th>';
        echo '<th>Player</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'defTackles') {
            echo ' class="table-secondary" ';
        }
        echo '>Tackles</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'defForLoss') {
            echo ' class="table-secondary" ';
        }
        echo '>For Loss</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'defSacks') {
            echo ' class="table-secondary" ';
        }
        echo '>Sacks</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'defINTs') {
            echo ' class="table-secondary" ';
        }
        echo '>INTs</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'defINT_TDs') {
            echo ' class="table-secondary" ';
        }
        echo '>INT TDs</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'defPassDef') {
            echo ' class="table-secondary" ';
        }
        echo '>Passes Defended</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'defQBHurries') {
            echo ' class="table-secondary" ';
        }
        echo '>QB Hurries</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'defFumbleRec') {
            echo ' class="table-secondary" ';
        }
        echo '>Fumble Recoveries</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'defFumbleTDs') {
            echo ' class="table-secondary" ';
        }
        echo '>Fumble TDs</th>';
    }
    /* Return Stats */
    if ($category === "KR_Att" || $category === "KR_Yards" || $category === "KR_AVG" || $category === "KR_TDs" || $category === "PR_Att" || $category === "PR_Yards" || $category === "PR_AVG" || $category === "PR_TDs") {

        echo '<th>Rank</th>';
        echo '<th>Player</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'KR_Att') {
            echo ' class="table-secondary" ';
        }
        echo '>Kick Returns</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'KR_Yards') {
            echo ' class="table-secondary" ';
        }
        echo '>Kick Return Yards</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'KR_AVG') {
            echo ' class="table-secondary" ';
        }
        echo '>Kick Return Average</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'KR_TDs') {
            echo ' class="table-secondary" ';
        }
        echo '>Kick Return TDs</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'PR_Att') {
            echo ' class="table-secondary" ';
        }
        echo '>Punt Returns</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'PR_Yards') {
            echo ' class="table-secondary" ';
        }
        echo '>Punt Return Yards</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'PR_AVG') {
            echo ' class="table-secondary" ';
        }
        echo '>Punt Return Average</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'PR_TDs') {
            echo ' class="table-secondary" ';
        }
        echo '>Punt Return TDs</th>';
    }
    /* Kicking Stats */
    if ($category === "kickFGM" || $category === 'kickFGA' || $category == 'kickFGP' || $category == 'kickLong') {

        echo '<th>Rank</th>';
        echo '<th>Player</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'kickFGM') {
            echo ' class="table-secondary" ';
        }
        echo '>Field Goals Made</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'kickFGA') {
            echo ' class="table-secondary" ';
        }
        echo '>Field Goal Attempts</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'kickFGP') {
            echo ' class="table-secondary" ';
        }
        echo '>Field Goal Percentage</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'kickLong') {
            echo ' class="table-secondary" ';
        }
        echo '>Longest Field Goal</th>';
    }
    /* Punting Stats */
    if ($category === "puntYards" || $category === "puntAtt" || $category === "puntAVG" || $category === "puntLong") {

        echo '<th>Rank</th>';
        echo '<th>Player</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'puntAtt') {
            echo ' class="table-secondary" ';
        }
        echo '>Punt Attempts</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'puntYards') {
            echo ' class="table-secondary" ';
        }
        echo '>Punt Yards</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'puntAVG') {
            echo ' class="table-secondary" ';
        }
        echo '>Punt Average</th>';
        echo '<th data-sort="int" data-sort-default="desc"';
        if ($category === 'puntLong') {
            echo ' class="table-secondary" ';
        }
        echo '>Punt Long</th>';
    }
    /* Misc Stats */
    if ($category === "rushYardsQB") {

        echo '<th>Rank</th>';
        echo '<th>Player</th>';
        echo '<th data-sort="int" data-sort-default="desc">';
        echo 'Rush Yards';
        echo '</th>';
    }
    if ($category === "rushTDsQB") {

        echo '<th>Rank</th>';
        echo '<th>Player</th>';
        echo '<th data-sort="int" data-sort-default="desc">';
        echo 'Rush TDs';
        echo '</th>';
    }
}

function returnStatLeaderBody($category, $startYear, $endYear) {

    $rank = 0;
    $startYear_ID = getSeason_ID($startYear);
    $endYear_ID = getSeason_ID($endYear);

    $leaderQuery = "";

    //If a passing stat is selected create the leader table body in rank order of the stat
    if ($category == "passComp" || $category === "passAtt" || $category === "passYards" || $category === "passTDs" || $category === "passINTs" || $category === "passPerc") {
        $leaderQuery = "select Player_ID,sum(Comp) as passComp, sum(Att) as passAtt, sum(Yards) as passYards, sum(TDs) as passTDs, sum(INTs) as passINTs, sum(Comp) / sum(Att) as passPerc
        from stats_passing_agg
        where Season_ID between {$startYear_ID} AND {$endYear_ID}
        group by Player_ID order by {$category} DESC limit 50";

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
            if ($category === 'passComp') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchLeaders['passComp'];
            echo '</td>';
            echo '<td';
            if ($category === 'passAtt') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchLeaders['passAtt'];
            echo '</td>';
            echo '<td';
            if ($category === 'passPerc') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo number_format($fetchLeaders['passPerc'] * 100, 1) . "%";
            echo '</td>';
            echo '<td';
            if ($category === 'passYards') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchLeaders['passYards'];
            echo '</td>';
            echo '<td';
            if ($category === 'passTDs') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchLeaders['passTDs'];
            echo '</td>';
            echo '<td';
            if ($category === 'passINTs') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchLeaders['passINTs'];
            echo '</td>';
        }
    }
    //If a rushing stat is selected create the leader table body in rank order of the stat
    if ($category == "rushAtt" || $category === "rushYards" || $category === "rushTDs" || $category === "rushYPC") {
        $leaderQuery = "select Player_ID, sum(Att) as rushAtt, sum(Yards) as rushYards, sum(TDs) as rushTDs, (sum(Yards) / sum(Att)) as rushYPC
        from stats_rushing_agg
        where Season_ID between {$startYear_ID} AND {$endYear_ID}
        group by Player_ID order by {$category} DESC limit 50";

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
            if ($category === 'rushAtt') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchRush['rushAtt'];
            echo '</td>';
            echo '<td';
            if ($category === 'rushYards') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchRush['rushYards'];
            echo '</td>';
            echo '<td';
            if ($category === 'rushYPC') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo number_format($fetchRush['rushYPC'], 1);
            echo '</td>';
            echo '<td';
            if ($category === 'rushTDs') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchRush['rushTDs'];
            echo '</td>';
        }
    }
    //If a recieving stat is selected create the leader table body in rank order of the stat
    if ($category == "recRec" || $category === "recYards" || $category === "recTDs" || $category === "recYPC") {
        $leaderQuery = "select Player_ID, sum(Rec) as recRec, sum(Yards) as recYards, sum(TDs) as recTDs, (sum(Yards) / sum(Rec)) as recYPC
        from stats_rec_agg
        where Season_ID between {$startYear_ID} AND {$endYear_ID}
        group by Player_ID order by {$category} DESC limit 50";

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
            if ($category === 'recRec') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchRec['recRec'];
            echo '</td>';
            echo '<td';
            if ($category === 'recYards') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchRec['recYards'];
            echo '</td>';
            echo '<td';
            if ($category === 'recYPC') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo number_format($fetchRec['recYPC'], 1);
            echo '</td>';
            echo '<td';
            if ($category === 'recTDs') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchRec['recTDs'];
            echo '</td>';
        }
    }
    //If a defensive stat is selected create the leader table body in rank order of the stat
    if ($category === "defTackles" || $category === "defForLoss" || $category === "defSacks" || $category === "defINTs" || $category === "defINT_TDs" || $category === "defPassDef" || $category === "defQBHurries" || $category === "defFumbleRec" || $category === "defFumbleTDs") {
        $leaderQuery = "select Player_ID, sum(Tackles) as defTackles, sum(ForLoss) as defForLoss, sum(Sacks) as defSacks, sum(INTs) as defINTs, sum(INT_TDs) as defINT_TDs, sum(PassDef) as defPassDef, sum(QBHurries) as defQBHurries, sum(FumbleRec) as defFumbleRec, sum(FumbleTDs) as defFumbleTDs
        from stats_def_agg
        where Season_ID between {$startYear_ID} AND {$endYear_ID}
        group by Player_ID order by {$category} DESC limit 50";

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
            if ($category === 'defTackles') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchDef['defTackles'];
            echo '</td>';
            echo '<td';
            if ($category === 'defForLoss') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchDef['defForLoss'];
            echo '</td>';
            echo '<td';
            if ($category === 'defSacks') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo number_format($fetchDef['defSacks'], 1);
            echo '</td>';
            echo '<td';
            if ($category === 'defINTs') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchDef['defINTs'];
            echo '</td>';
            echo '<td';
            if ($category === 'defINT_TDs') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchDef['defINT_TDs'];
            echo '</td>';
            echo '<td';
            if ($category === 'defPassDef') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchDef['defPassDef'];
            echo '</td>';
            echo '<td';
            if ($category === 'defQBHurries') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchDef['defQBHurries'];
            echo '</td>';
            echo '<td';
            if ($category === 'defFumbleRec') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchDef['defFumbleRec'];
            echo '</td>';
            echo '<td';
            if ($category === 'defFumbleTDs') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchDef['defFumbleTDs'];
            echo '</td>';
        }
    }
    //If a return stat is selected create the leader table body in rank order of the stat
    if ($category === "KR_Att" || $category === "KR_Yards" || $category === "KR_AVG" || $category === "KR_TDs" || $category === "PR_Att" || $category === "PR_Yards" || $category === "PR_AVG" || $category === "PR_TDs") {
        $leaderQuery = "select Player_ID, sum(KR_Ret) as KR_Att, sum(KR_Yards) as KR_Yards, sum(KR_Yards) / sum(KR_Ret) as KR_AVG, sum(KR_TDs) as KR_TDs, sum(PR_Ret) as PR_Att, sum(PR_Yards) as PR_Yards, sum(PR_Yards) / sum(PR_Ret) as PR_AVG, sum(PR_TDs) as PR_TDs
        from stats_ret_agg
        where Season_ID between {$startYear_ID} AND {$endYear_ID}
        group by Player_ID order by {$category} DESC limit 50";

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
            if ($category === 'KR_Att') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchReturns['KR_Att'];
            echo '</td>';
            echo '<td';
            if ($category === 'KR_Yards') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchReturns['KR_Yards'];
            echo '</td>';
            echo '<td';
            if ($category === 'KR_AVG') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo number_format($fetchReturns['KR_AVG'], 1);
            echo '</td>';
            echo '<td';
            if ($category === 'KR_TDs') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchReturns['KR_TDs'];
            echo '</td>';
            echo '<td';
            if ($category === 'PR_Att') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchReturns['PR_Att'];
            echo '</td>';
            echo '<td';
            if ($category === 'PR_Yards') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchReturns['PR_Yards'];
            echo '</td>';
            echo '<td';
            if ($category === 'PR_AVG') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo number_format($fetchReturns['PR_AVG'], 1);
            echo '</td>';
            echo '<td';
            if ($category === 'PR_TDs') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchReturns['PR_TDs'];
            echo '</td>';
        }
    }
    //If a kicking stat is selected create the leader table body in rank order of the stat
    if ($category === "kickFGM" || $category === "kickFGA" || $category == 'kickFGP' || $category == 'kickLong') {
        $leaderQuery = "select Player_ID, sum(FGM) as kickFGM, sum(FGA) as kickFGA, sum(FGM) / sum(FGA) as kickFGP, max(LongKick) as kickLong
        from stats_kicking_agg
        where Season_ID between {$startYear_ID} AND {$endYear_ID}
        group by Player_ID order by {$category} DESC limit 50";

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
            if ($category === 'kickFGM') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchKicking['kickFGM'];
            echo '</td>';
            echo '<td';
            if ($category === 'kickFGA') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchKicking['kickFGA'];
            echo '</td>';
            echo '<td';
            if ($category === 'kickFGP') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo number_format($fetchKicking['kickFGP'] * 100, 0) . "%";
            echo '</td>';
            echo '<td';
            if ($category === 'kickLong') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchKicking['kickLong'];
            echo '</td>';
        }
    }
    //If a punting stat is selected create the leader table body in rank order of the stat
    if ($category === "puntYards" || $category === "puntAtt" || $category === "puntAVG" || $category === "puntLong") {
        $leaderQuery = "select Player_ID, sum(Yards) as puntYards, sum(Att) as puntAtt, sum(Yards) / sum(Att) as puntAVG, max(LongPunt) as puntLong
        from stats_punting_agg
        where Season_ID between {$startYear_ID} AND {$endYear_ID}
        group by Player_ID order by {$category} DESC limit 50";

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
            if ($category === 'puntAtt') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchPunting['puntAtt'];
            echo '</td>';
            echo '<td';
            if ($category === 'puntYards') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchPunting['puntYards'];
            echo '</td>';
            echo '<td';
            if ($category === 'puntAVG') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo number_format($fetchPunting['puntAVG'], 1);
            echo '</td>';
            echo '<td';
            if ($category === 'puntLong') {
                echo ' class="table-secondary" ';
            }
            echo '>';
            echo $fetchPunting['puntLong'];
            echo '</td>';
        }
    }
    //If a misc stat is selected create the leader table body in rank order of the stat
    if ($category == "rushYardsQB") {
        $leaderQuery = "select Player_ID, sum(Yards) as rushYards
        from stats_rushing_agg
        where Season_ID between {$startYear_ID} AND {$endYear_ID}
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
    if ($category == "rushTDsQB") {
        $leaderQuery = "select Player_ID, sum(TDs) as rushTDs
        from stats_rushing_agg
        where Season_ID between {$startYear_ID} AND {$endYear_ID}
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
//Determine if given player was ever a QB
function playerWasQB($Player_Master_ID) {

    $was = false;

    $getWasQB = db_query("SELECT * FROM `players` WHERE Player_Master_ID='{$Player_Master_ID}'");
    while ($fetchWasQB = $getWasQB->fetch_assoc()) {
        if ($fetchWasQB['Position'] === 'QB') {
            $was = true;
        } else {
            
        }
    }
    return $was;
}