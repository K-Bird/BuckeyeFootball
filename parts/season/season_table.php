<div class="row" style="text-align: center">
    <div class="col-lg-12">
        <br>
        <h3><span class="badge badge-secondary"><div id="programWins"></div></span></h3>
        <br>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <table id="seasonTable" class="table-sm table-hover text-center tablesorter">
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Conference</th>
                    <th>Division</th>
                    <th>Wins</th>
                    <th>Losses</th>
                    <th>Ties</th>
                    <th>Conf Wins</th>
                    <th>Conf Losses</th>
                    <th>Conf Ties</th>
                    <th>Div Wins</th>
                    <th>Div Losses</th>
                    <th>Div Ties</th>
                    <th>Conf Champs</th>
                    <th>National Champs</th>
                    <th>Final AP Ranking</th>
                    <th>Final CFP Ranking</th>
                </tr>
            </thead>
            <tbody class="list">
                <?php
                $get_SeasonData = db_query("SELECT * FROM `seasons` ORDER BY Year ASC");

                while ($fetch_SeasonData = $get_SeasonData->fetch_assoc()) {

                    //Conference Lookup
                    $conf_ID = $fetch_SeasonData['Conf'];
                    $get_Conf = db_query("Select * from `conferences` where Conf_ID={$conf_ID}");
                    $fetch_Conf = $get_Conf->fetch_assoc();

                    //Division Lookup
                    $div_ID = $fetch_SeasonData['Division'];
                    $get_Div = db_query("Select * from `b10_divisions` where Div_ID={$div_ID}");
                    $fetch_Div = $get_Div->fetch_assoc();


                    echo '<tr id="', $fetch_SeasonData['Year'], '" class="seasonSearch">';
                    echo '<td class="season-sort-year">', $fetch_SeasonData['Year'], '</td>';
                    echo '<td class="season-filter-conf" data-confid="', $fetch_Conf['Conf_ID'], '">', $fetch_Conf['Conf_Abbrev'], '</td>';
                    echo '<td class="season-filter-div" data-divid="', $fetch_Div['Div_ID'], '">', $fetch_Div['Div_Name'], '</td>';
                    echo '<td class="season-sort-OvrW">', returnRecord($fetch_SeasonData['Season_ID'], 'W', 'Ovr'), '</td>';
                    echo '<td class="season-sort-OvrL">', returnRecord($fetch_SeasonData['Season_ID'], 'L', 'Ovr'), '</td>';
                    echo '<td class="season-sort-OvrT">', returnRecord($fetch_SeasonData['Season_ID'], 'T', 'Ovr'), '</td>';
                    echo '<td class="season-sort-ConfW">', returnRecord($fetch_SeasonData['Season_ID'], 'W', 'Conf'), '</td>';
                    echo '<td class="season-sort-ConfL">', returnRecord($fetch_SeasonData['Season_ID'], 'L', 'Conf'), '</td>';
                    echo '<td class="season-sort-ConfT">', returnRecord($fetch_SeasonData['Season_ID'], 'T', 'Conf'), '</td>';
                    echo '<td class="season-sort-DivW">', returnRecord($fetch_SeasonData['Season_ID'], 'W', 'Div'), '</td>';
                    echo '<td class="season-sort-DivL">', returnRecord($fetch_SeasonData['Season_ID'], 'L', 'Div'), '</td>';
                    echo '<td class="season-sort-DivT">', returnRecord($fetch_SeasonData['Season_ID'], 'T', 'Div'), '</td>';
                    echo '<td class="season-filter-confChamp" data-confchampval="', $fetch_SeasonData['Conf_Champ'], '">', $fetch_SeasonData['Conf_Champ'], '</td>';
                    echo '<td class="season-filter-natChamp" data-natchampval="', $fetch_SeasonData['NationalChamp'], '">', $fetch_SeasonData['NationalChamp'], '</td>';
                    echo '<td class="season-sort-FinalAP">', returnSeasonAP($fetch_SeasonData['AP_Final'], $fetch_SeasonData['Season_ID']), '</td>';
                    echo '<td class="season-sort-FinalCFP">', returnSeasonCFP($fetch_SeasonData['CFP_Final'], $fetch_SeasonData['Season_ID']), '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>