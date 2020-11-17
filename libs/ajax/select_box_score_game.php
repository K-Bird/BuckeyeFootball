<?php
include ("../../libs/db/common_db_functions.php");

$Game_ID = $_POST['new_game'];

$getGameData = db_query("SELECT * FROM `games` WHERE GM_ID='{$Game_ID}'");
$fetchGameData = $getGameData->fetch_assoc();

$getBoxData = db_query("SELECT * FROM `games_box_scores` WHERE GM_ID='{$Game_ID}'");
$fetchBoxData = $getBoxData->fetch_assoc();

$curr_OSU_Total = $fetchBoxData['Q1_OSU'] + $fetchBoxData['Q2_OSU'] + $fetchBoxData['Q3_OSU'] + $fetchBoxData['Q4_OSU'] + $fetchBoxData['OT_OSU'];
$curr_Opp_Total = $fetchBoxData['Q1_Opp'] + $fetchBoxData['Q2_Opp'] + $fetchBoxData['Q3_Opp'] + $fetchBoxData['Q4_Opp'] + $fetchBoxData['OT_Opp'];

$OSU_Diff = $curr_OSU_Total - $fetchGameData['OSU_Score'];
$Opp_Diff = $curr_Opp_Total - $fetchGameData['Opp_Score'];

$exists = mysqli_num_rows($getBoxData);

if ($exists > 0) {
     include ('../../parts/input/input_box_exists.php');
} else {
    include ('../../parts/input/input_box_new.php');
}


?>


<div class="modal fade" id="addScoringPlayModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 40%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddScoringPlayTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align: center">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="addScoringPlayForm" class="form-group">
                            <label>Time Left: &nbsp;</label><input name="TimeLeft" type="text" class="form-control" placeholder="Format: ##:##" />
                            <br>
                            <label>Play Type: &nbsp;</label>
                            <select id="scoringPlayType" name="scoringPlayType" class="form-control">
                                <option value=""></option>
                                <option value="passTD">Pass TD</option>
                                <option value="rushTD">Rush TD</option>
                                <option value="FG">Field Goal</option>
                                <option value="INT">INT Return</option>
                                <option value="Fum">Fumble Rec</option>
                                <option value="KR">Kickoff Return</option>
                                <option value="PR">Punt Return</option>
                                <option value="Saf">Safety</option>
                            </select>
                            <br>
                            <label>Scoring Player: &nbsp;</label><input id="searchScoringPlayer" type="text" class="form-control" /><div id="scoringPlayerResults"></div><div id="scoringPlayerSelected"></div>
                            <br>
                            <label id="fromPlayerLabel">From Player: &nbsp;</label><input id="searchFromPlayer" type="text" class="form-control" /><div id="fromPlayerResults"></div><div id="fromPlayerSelected"></div>
                            <br>
                            <label>Distance: &nbsp;</label><input name="scoreDistance" type="text" class="form-control" />
                            <br>
                            <label>Points After Score: &nbsp;</label><input name="scorePoints" type="text" class="form-control" />
                            <input type="hidden" name="Game_ID" value="<?php echo $Game_ID; ?>" />
                            <input type="hidden" name="q" value="" />
                            <button type="submit" class="btn btn-success">Add Scoring Play</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addOppScoringPlayModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 40%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddOppScoringPlayTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align: center">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="addOppScoringPlayForm" class="form-group">
                            <label>Time Left: &nbsp;</label><input name="TimeLeft" type="text" class="form-control" placeholder="Format: ##:##" />
                            <br>
                            <label>Play Type: &nbsp;</label>
                            <select id="scoringPlayType" name="scoringPlayType" class="form-control">
                                <option value=""></option>
                                <option value="passTD">Pass TD</option>
                                <option value="rushTD">Rush TD</option>
                                <option value="FG">Field Goal</option>
                                <option value="INT">INT Return</option>
                                <option value="Fum">Fumble Rec</option>
                                <option value="KR">Kickoff Return</option>
                                <option value="PR">Punt Return</option>
                                <option value="Saf">Safety</option>
                            </select>
                            <br>
                            <label>Distance: &nbsp;</label><input name="scoreDistance" type="text" class="form-control" />
                            <br>
                            <label>Points After Score: &nbsp;</label><input name="scorePoints" type="text" class="form-control" />
                            <br>
                            <input type="hidden" name="Game_ID" value="<?php echo $Game_ID; ?>" />
                            <input type="hidden" name="q" value="" />
                            <button type="submit" class="btn btn-success">Add Opp Scoring Play</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>