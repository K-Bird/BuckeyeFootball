<!-- Check Season View Controls -->          
<?php
$get_SeasonView = db_query("SELECT * FROM `Controls` WHERE Control='Season_View'");
$fetch_SeasonView = $get_SeasonView->fetch_assoc();
$Season_View = $fetch_SeasonView['Value'];
?>
<div class="row">
    <div class="col-lg-6">
        <button id="seasonViewBtn" class="btn btn-secondary" data-toggle="collapse" href="#seasonViewControls">Season View &nbsp;<span id="closedSeasonViewChev" class="oi oi-chevron-right" title="icon name"></span><span id="openSeasonViewChev" class="oi oi-chevron-bottom" title="icon name"></span></button>
    </div>
    <div class="col-lg-6">
        <button id="seasonDataControlsBtn" class="btn btn-secondary" data-toggle="collapse" href="#seasonDataControls">Season Data Controls &nbsp;<span id="closedSeasonDataChev" class="oi oi-chevron-right" title="icon name"></span><span id="openSeasonDataChev" class="oi oi-chevron-bottom" title="icon name"></span></button>
    </div>
</div>
<br>
<div id="seasonViewControls" class="controlContainer">
    <div class="row">
        <div class="col-lg-3">
            <span class="badge badge-dark">Season View:</span><br><br>
            <div id="season_view_group" class="btn-group" role="group" aria-label="Basic example">
                <button id="season_table_btn" type="button" class="btn btn-secondary <?php
                if ($Season_View === 'Table') {
                    echo 'bg-dark';
                }
                ?>"  >Table</button>
                <button id="season_games_btn"type="button" class="btn btn-secondary <?php
                if ($Season_View === 'Games') {
                    echo 'bg-dark';
                }
                ?>" >Games</button>
            </div>
        </div>
        <div class="col-lg-9">
            <br>
            <span class="badge badge-dark">Select Seasons to View</span><br><br>
            <div id="YearSlider"></div>
            <?php echo buildDecadeButtons('seasonDecadeSlider'); ?>
        </div>
    </div>
</div>
<br>
<div id="seasonDataControls" class="controlContainer">
    <div class="row" style="text-align: center">
        <div class="col-lg-12">
            <input id="seasonTableSearch" class="form-control" placeholder="Search Table">
            <br>
            <div class="input-group">
                <?php
                displayConfFilterSelect();
                displayDivFilterSelect();
                displayConfChampFilterSelect();
                displayNationalChampFilterSelect();
                ?>
            </div>
        </div>
    </div>
</div>