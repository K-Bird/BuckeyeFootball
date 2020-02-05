<br>
<table id="playerTable" class="table tablesorter">
    <thead>
        <tr>
            <th>Season</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Number</th>
            <th>Position</th>
            <th>Height</th>
            <th>Weight</th>
            <th>Class</th>
            <th>Hometown</th>
            <th>Season Status</th>
            <th>Offseason Status</th>
            <th>Details</th>
        </tr>
    </thead>
    <tbody class="list">
        <?php
        $get_PlayerData = db_query("SELECT * FROM `players` where `Season`='{$season_ID}' ORDER BY `Last_Name` ASC");

        while ($fetch_PlayerData = $get_PlayerData->fetch_assoc()) {

            $DepthPOS = '';

            if ($fetch_PlayerData['Depth'] === '0') {
                
            } else {
                $DepthPOS = $fetch_PlayerData['Depth'];
            }

            echo '<tr>';
            echo '<td>', getSeason_Year($season_ID), '</td>';
            echo '<td class="player-sort-fname">', $fetch_PlayerData['First_Name'], '</td>';
            echo '<td class="player-sort-lname">', $fetch_PlayerData['Last_Name'], '</td>';
            echo '<td class="player-sort-num">', $fetch_PlayerData['Number'], '</td>';
            echo '<td class="player-filter-pos" data-posval="', $fetch_PlayerData['Position'], '">', $fetch_PlayerData['Position'], $DepthPOS, '</td>';
            echo '<td class="player-sort-ht">', $fetch_PlayerData['Height'], '</td>';
            echo '<td class="player-sort-wt">', $fetch_PlayerData['Weight'], '</td>';
            echo '<td class="player-filter-class" data-classval="', $fetch_PlayerData['Class'], '">', $fetch_PlayerData['Class'], '</td>';
            echo '<td class="player-sort-hometown">', $fetch_PlayerData['Hometown'], '</td>';
            echo '<td class="player-filter-status" data-seasonval="', $fetch_PlayerData['Team_Status'], '">', $fetch_PlayerData['Team_Status'], '</td>';
            echo '<td class="player-filter-offseason" data-offseasonval="', $fetch_PlayerData['Post_Season_Status'], '">', $fetch_PlayerData['Post_Season_Status'], '</td>';
            echo '<td>';
            echo '<form id="playerDetailForm" action="playerDetails.php" method="POST">';
            echo '<button class="btn btn-secondary btn-sm playerDetailBtn" type="submit">View Details</button>';
            echo '<input type="hidden" name="Player_Master_ID" value="', $fetch_PlayerData['Player_Master_ID'], '"/>';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>