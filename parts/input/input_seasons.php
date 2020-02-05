<?php
$get_CFP_RK_Start = db_query("SELECT * From `seasons` WHERE Season_ID={$Season_ID}");
$fetch_CFP_RK_Start = $get_CFP_RK_Start->fetch_assoc();
$CFP_RK_Start = $fetch_CFP_RK_Start['CFP_RK_Start'];
?>
<div class="container-fluid">
    <br><br>
    <div class="row">
        <div class="col-lg-12">
            <div id="seasonFields">
                <div class="form-row">                   
                    <div class="col-lg-1">
                        <div class="form-group">
                            <label for="DecadeSelect"><small>Season Decade:</small></label><br>
<?php displayDecadeSelect($fetchSeasonData['Decade_ID'], $Season_ID); ?>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="form-group">
                            <label for="ConfSelect"><small>Season Conference:</small></label><br>
<?php displayConfSelect($fetchSeasonData['Conf'], $Season_ID); ?>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="form-group">
                            <label for="DivSelect"><small>Season Division:</small></label><br>
<?php displayDivSelect($fetchSeasonData['Division'], $Season_ID); ?>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <label for="ConfChampSelect"><small>Conference Champs:</small></label><br>
<?php displayConfChampSelect($fetchSeasonData['Conf_Champ'], $Season_ID); ?>
                    </div>
                    <div class="col-lg-1">
                        <label for="ConfChampSelect"><small>National Champs:</small></label><br>
<?php displayNatChampSelect($fetchSeasonData['NationalChamp'], $Season_ID); ?>
                    </div>
                    <div class="col-lg-1">
                        <label for="seasonLosses"><small>Final AP Ranking:</small></label><br>
                        <input id="finalAP" data-season="<?php echo $Season_ID; ?>" type="text" name="seasonAPFinal" class="form-control" placeholder="<?php echo $fetchSeasonData['AP_Final']; ?>">
                    </div>
                    <div class="col-lg-1">
                        <label for="seasonTies"><small>Final CFP Ranking:</small></label><br>
                        <input id="finalCFP" data-season="<?php echo $Season_ID; ?>" type="text" name="seasonCFPFinal" class="form-control" placeholder="<?php echo $fetchSeasonData['CFP_Final']; ?>">
                    </div>
                    <div class="col-lg-2">
                        <label for="HCSelect"><small>Head Coach:</small></label><br>
<?php displayHCSelect($fetchSeasonData['HC'], $Season_ID); ?>
                    </div>
                    <div class="col-lg-1">
                        <label for="DepthSelect"><small>Depth Chart:</small></label><br>
<?php displayDepthSelect($fetchSeasonData['DepthChart'], $Season_ID); ?>
                    </div>
                    <div class="col-lg-1">
                        <label for="DepthSelect"><small>CFP RK Start:</small></label><br>
<?php echo '<input id="CFPStart" type="text" data-season="',$Season_ID,'" class="form-control" placeholder="',$CFP_RK_Start,'" style="width: 100px">'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-lg-4">
            <h3>Record 

<?php
echo "(", returnRecord($Season_ID, 'W', 'Ovr'), "-", returnRecord($Season_ID, 'L', 'Ovr'), "-", returnRecord($Season_ID, 'T', 'Ovr'), ")";
?>

            </h3>
        </div>
        <div class="col-lg-4">
            <h3>
                Points For:
<?php echo returnPTSfor($Season_ID); ?>
            </h3>
        </div>
        <div class="col-lg-4">
            <h3>
                Points Against:
<?php echo returnPTSaga($Season_ID); ?>
            </h3>
        </div>
    </div>
    <div class="row">
<?php $getGamesData = db_query("SELECT * FROM `games` WHERE Season_ID='{$Season_ID}' ORDER BY Week ASC"); ?>
        <form>
            <table id="seasonInputTable" class="table table-sm" style="text-align: center">
                <thead>
                <th>Week</th>
                <th>Date</th>
                <th>Home/Away</th>
                <th>Location</th>
                <th>Vs</th>
                <th>OSU AP RK</th>
<?php
if (getSeason_Year($Season_ID) >= 2014) {
    echo '<th>OSU CFP RK</th>';
}
?>
                <th>Opp AP RK</th>
                <?php
                if (getSeason_Year($Season_ID) >= 2014) {
                    echo '<th>Opp CFP RK</th>';
                }
                ?>
                <th>Game Type</th>
                <th>OSU Score</th>
                <th>Opp Score</th>
                <th>Conf GM</th>
                <th>Div GM</th>
                <th>OT</th>
                <th>OT#</th>
                <th></th>
                </thead>
                <tbody>
<?php
while ($fetchGamesData = $getGamesData->fetch_assoc()) {
    echo '<tr>';
    echo '<td>';
    echo '<h3><span class="badge badge-secondary">', $fetchGamesData['Week'], '</span></h3>';
    echo '</td>';
    echo '<td>';
    echo '<input id="', $fetchGamesData['GM_ID'], '" class="form-control weekDate" placeholder="', $fetchGamesData['Date'], '" data-provide="datepicker">';
    echo '</td>';
    echo '<td>';
    displayHorAselect($fetchGamesData['H_A'], $fetchGamesData['GM_ID']);
    echo '</td>';
    echo '<td>';
    displayLocSelect($fetchGamesData['Location'], $fetchGamesData['GM_ID']);
    echo '</td>';
    echo '<td>';
    displayOppSelect($fetchGamesData['Vs'], $fetchGamesData['GM_ID']);
    echo '</td>';
    echo '<td>';
    echo '<input id="', $fetchGamesData['GM_ID'], '" type="text" class="form-control osuAP" placeholder="', $fetchGamesData['OSU_AP_RK'], '" style="width: 50px">';
    echo '</td>';
    if (getSeason_Year($Season_ID) >= 2014) {
        if ($fetchGamesData['Week'] < $CFP_RK_Start) {
            echo '<td>';
            echo '<input disabled  class="form-control" style="width: 50px">';
            echo '</td>';
        } else {
            echo '<td>';
            echo '<input id="', $fetchGamesData['GM_ID'], '" type="text" class="form-control osuCFP" placeholder="', $fetchGamesData['OSU_CFP_RK'], '" style="width: 50px">';
            echo '</td>';
        }
    }
    echo '<td>';
    echo '<input id="', $fetchGamesData['GM_ID'], '" type="text" class="form-control oppAP" placeholder="', $fetchGamesData['Opp_AP_RK'], '" style="width: 50px">';
    echo '</td>';
    if (getSeason_Year($Season_ID) >= 2014) {
        if ($fetchGamesData['Week'] < $CFP_RK_Start) {
            echo '<td>';
            echo '<input disabled  class="form-control" style="width: 50px">';
            echo '</td>';
        } else {
            echo '<td>';
            echo '<input id="', $fetchGamesData['GM_ID'], '" type="text" class="form-control oppCFP" placeholder="', $fetchGamesData['Opp_CFP_RK'], '" style="width: 50px">';
            echo '</td>';
        }
    }
    echo '<td>';
    displayGMTypeSelect($fetchGamesData['GM_Type'], $fetchGamesData['GM_ID']);
    echo '</td>';
    echo '<td>';
    echo '<input id="', $fetchGamesData['GM_ID'], '" type="text" class="form-control OSUScore" placeholder="', $fetchGamesData['OSU_Score'], '" style="width: 50px">';
    echo '</td>';
    echo '<td>';
    echo '<input id="', $fetchGamesData['GM_ID'], '" type="text" class="form-control OppScore" placeholder="', $fetchGamesData['Opp_Score'], '" style="width: 50px">';
    echo '</td>';
    echo '<td>';
    displayConfGMCheckbox($fetchGamesData['Conf_GM'], $fetchGamesData['GM_ID']);
    echo '</td>';
    echo '<td>';
    displayDivGMCheckbox($fetchGamesData['Div_GM'], $fetchGamesData['GM_ID']);
    echo '</td>';
    echo '<td>';
    displayOTCheckbox($fetchGamesData['OT'], $fetchGamesData['GM_ID']);
    echo '</td>';
    echo '<td>';
    echo '<input id="', $fetchGamesData['GM_ID'], '" type="text" class="form-control OTNum" placeholder="', $fetchGamesData['OT_Num'], '" style="width: 50px">';
    echo '</td>';
}
?>
                </tbody>
            </table>
        </form>
    </div>
    <div clas="row">
        <div class="col-lg-12">
            <button 
                id ="addWeek"
                class="btn btn-success"
                data-season="<?php echo $Season_ID; ?>"

                >Add Week</button>
            <button id="removeWeek" class="btn btn-danger" data-game="<?php echo returnMaxGameID(); ?>">Remove Last Week</button>
            <br><br>
        </div>
    </div>
</div>
<?php include('parts/input/input_modal_addSeason.php'); ?>
