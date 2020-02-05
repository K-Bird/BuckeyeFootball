<div id="depthContainer" class="container-fluid" style="text-align: center;   ">
    <div class="row">
        <div class="col">
            <span class="badge badge-secondary">Offense</span><br><br>  
            <?php return_depth_btn($season_ID, 'QB', 1); ?><br><br>
            <?php return_depth_btn($season_ID, 'RB', 1); ?><br><br>
            <?php return_depth_btn($season_ID, 'FB', 1); ?><br><br>
            <?php return_depth_btn($season_ID, 'WR', 1); ?><br><br>
            <?php return_depth_btn($season_ID, 'WR', 2); ?><br><br>
            <?php return_depth_btn($season_ID, 'TE', 1); ?><br><br>
            <hr />
            <?php return_depth_btn_starter($season_ID, 'OL', 1); ?><br><br>
            <?php return_depth_btn_starter($season_ID, 'OL', 2); ?><br><br>
            <?php return_depth_btn_starter($season_ID, 'OL', 3); ?><br><br>
            <?php return_depth_btn_starter($season_ID, 'OL', 4); ?><br><br>
            <?php return_depth_btn_starter($season_ID, 'OL', 5); ?><br><br>

        </div>
        <div class="col">
            <span class="badge badge-secondary">Defense</span><br><br>  
            <?php return_depth_btn_starter($season_ID, 'DL', 1); ?><br><br>
            <?php return_depth_btn_starter($season_ID, 'DL', 2); ?><br><br>
            <?php return_depth_btn_starter($season_ID, 'DL', 3); ?><br><br>
            <?php return_depth_btn_starter($season_ID, 'DL', 4); ?><br><br>
            <hr />
            <?php return_depth_btn_starter($season_ID, 'LB', 1); ?><br><br>
            <?php return_depth_btn_starter($season_ID, 'LB', 2); ?><br><br>
            <?php return_depth_btn_starter($season_ID, 'LB', 3); ?><br><br>
            <hr />
            <?php return_depth_btn_starter($season_ID, 'DB', 1); ?><br><br>
            <?php return_depth_btn_starter($season_ID, 'DB', 2); ?><br><br>
            <?php return_depth_btn_starter($season_ID, 'DB', 3); ?><br><br>
            <?php return_depth_btn_starter($season_ID, 'DB', 4); ?><br><br>
        </div>
        <div class="col">
            <span class="badge badge-secondary">Special Teams</span><br><br> 
            <?php return_depth_btn($season_ID, 'K', 1); ?><br><br>
            <?php return_depth_btn($season_ID, 'P', 1); ?><br><br>
            <?php return_depth_btn($season_ID, 'KR', 1); ?><br><br>
            <?php return_depth_btn($season_ID, 'PR', 1); ?><br><br>
        </div>
    </div>
</div>
<?php
//Build depth chart button for given position (starters)
function return_depth_btn_starter($Season_ID, $position, $depth_chart_num) {

    $getPlayerData = db_query("SELECT * FROM `Players` WHERE Season='{$Season_ID}' AND Position='{$position}' AND Depth='{$depth_chart_num}'");
    $fetchPlayerData = $getPlayerData->fetch_assoc();

    if (empty($fetchPlayerData)) {
        $getPlayerData = db_query("SELECT * FROM `Players` WHERE Season='{$Season_ID}' AND Position_2='{$position}' AND Depth_2='{$depth_chart_num}'");
        $fetchPlayerData = $getPlayerData->fetch_assoc();
    }

    $fname = $fetchPlayerData['First_Name'];
    $lname = $fetchPlayerData['Last_Name'];
    $fullName = $fname . " " . $lname;

    if ($position === 'KR' || $position === 'PR' || $position === 'LS' || $position === 'H') {
        echo '<span id="', $position . $depth_chart_num, '" class="btn btn-sm btn-secondary">';
        echo '<small>', $position . $depth_chart_num, " - ", $fullName, " - ", $fetchPlayerData['Class'], '</small>';
        echo '</span>';
    } else {

        echo '<span id="', $position . $depth_chart_num, '" class="btn btn-sm btn-secondary showDepthCard">';
        echo '<small>', $position . " - ", $fullName, " - ", $fetchPlayerData['Class'], '</small>';
        echo '</span>';
    }
}