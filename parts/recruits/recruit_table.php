<div id="maniuplateRecruitTable">
    <br>
    <table id="recruitTable" class="table tablesorter">
        <thead>
            <tr>
                <th>National Rank</th>
                <th>State Rank</th>
                <th>Position Rank</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Position</th>
                <th>Height</th>
                <th>Weight</th>
                <th>Hometown</th>
                <th>Stars</th>
                <th>Score</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="list">
            <?php
            //Select Nationally Ranked Recruits First for Display
            $get_RecruitData = db_query("SELECT * FROM `recruits` where `Class`='{$Recruit_View}' ORDER BY Nat_RK=0, Nat_RK");

            while ($fetch_RecruitData = $get_RecruitData->fetch_assoc()) {

                echo '<tr>';
                echo '<td class="recruit-sort-natrk">', $fetch_RecruitData['Nat_RK'], '</td>';
                echo '<td class="recruit-sort-strk">', $fetch_RecruitData['Pos_RK'], '</td>';
                echo '<td class="recruit-sort-posrk">', $fetch_RecruitData['State_RK'], '</td>';
                echo '<td class="recruit-sort-fname">', $fetch_RecruitData['First_Name'], '</td>';
                echo '<td class="recruit-sort-lname">', $fetch_RecruitData['Last_Name'], '</td>';
                echo '<td class="recruit-filter-pos" data-posval="', $fetch_RecruitData['Position'], '">', $fetch_RecruitData['Position'], '</td>';
                echo '<td class="recruit-sort-ht">', $fetch_RecruitData['Height'], '</td>';
                echo '<td class="recruit-sort-wt">', $fetch_RecruitData['Weight'], '</td>';
                echo '<td class="recruit-sort-hometown">', $fetch_RecruitData['Hometown'], '</td>';
                echo '<td class="recruit-sort-stars">', $fetch_RecruitData['Stars'], '</td>';
                echo '<td class="recruit-sort-score">', number_format($fetch_RecruitData['Score'], 4), '</td>';
                echo '<td>';

                if ($fetch_RecruitData['Player_ID'] === '0') {
                    echo '<form>';
                    echo '<button class="btn btn-danger btn-sm disabled" type="submit">Not On Team</button>';
                    echo '</form>';
                } else {
                    echo '<form action="playerDetails.php" method="POST">';
                    echo '<button class="btn btn-secondary btn-sm" type="submit">View Player</button>';
                    echo '<input type="hidden" name="Player_Master_ID" value="', $fetch_RecruitData['Player_ID'], '"/>';
                    echo '</form>';
                }
                echo '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>