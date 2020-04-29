<div id="boxScoreGameInput">
    <div clas="row">
        <div class="col-lg-12">
            <h3><span class="badge badge-dark">
                    <?php echo 'No Box Score For: ' . getSeason_Year(getSeasonIDbyGameID($fetchGameData['GM_ID'])) . ' - Week ' . $fetchGameData['Week'] . ' - ' . $fetchGameData['Date'] . ' ' . HomeAwayLookup($fetchGameData['H_A']) . ' Vs ' . opponentLookup($fetchGameData['Vs']) . ' - (' . gameTypeLookup($fetchGameData['GM_Type']) . ')'; ?>
                    &nbsp;
                    <button id="changeBoxGameNew" class="btn btn-warning btn-sm">Edit Different Game</button>
                </span></h3>

            <br>
        </div>
    </div>
    <div clas="row">
        <div class="col-lg-12">
            <button id="addBoxScore" data-gmid="<?php echo $Game_ID; ?>" class="btn btn-success">Add Box Score</button>
        </div>
    </div>
</div>