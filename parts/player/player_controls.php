<br>
<!-- Check Player View Controls -->          
<?php
$get_PlayerView = db_query("SELECT * FROM `Controls` WHERE Control='Player_View'");
$fetch_PlayerView = $get_PlayerView->fetch_assoc();
$Player_View = $fetch_PlayerView['Value'];

$get_PlayerSeason = db_query("SELECT * FROM `Controls` WHERE Control='Player_Season'");
$fetch_PlayerSeason = $get_PlayerSeason->fetch_assoc();
$Player_Season = $fetch_PlayerSeason['Value'];

$get_PlayerCompareStart = db_query("SELECT * FROM `Controls` WHERE Control='player_compare_start'");
$fetch_PlayerCompareStart = $get_PlayerCompareStart->fetch_assoc();
$Player_Compare_Start = $fetch_PlayerCompareStart['Value'];

$get_PlayerCompareEnd = db_query("SELECT * FROM `Controls` WHERE Control='player_compare_end'");
$fetch_PlayerCompareEnd = $get_PlayerCompareEnd->fetch_assoc();
$Player_Compare_End = $fetch_PlayerCompareEnd['Value'];

$get_PlayerComparePosGroup = db_query("SELECT * FROM `Controls` WHERE Control='player_compare_pos_groups'");
$fetch_PlayerComparePosGroup = $get_PlayerComparePosGroup->fetch_assoc();
$Player_Compare_PosGroup = $fetch_PlayerComparePosGroup['Value'];
?>
<div class="row">
    <div class="col-lg-6">
        <button id="playerViewBtn" class="btn btn-secondary" data-toggle="collapse" href="#playerViewControls">Player View &nbsp;<span id="closedPlayerViewChev" class="oi oi-chevron-right" title="icon name"></span><span id="openPlayerViewChev" class="oi oi-chevron-bottom" title="icon name"></span></button>
    </div>
    <div class="col-lg-6">
        <button id="playerDataControlsBtn" class="btn btn-secondary" data-toggle="collapse" href="#playerDataControls">Player Data Controls &nbsp;<span id="closedPlayerDataChev" class="oi oi-chevron-right" title="icon name"></span><span id="openPlayerDataChev" class="oi oi-chevron-bottom" title="icon name"></span></button>
    </div>
</div>
<br>
<div id="playerViewControls" class="controlContainer">
    <div class="row" style="text-align: center">
        <div class="col-lg-3">
            <span class="badge badge-dark">Change Player View:</span><br>
            <div id="player_view_group" class="btn-group" role="group">
                <button id="player_table_btn" type="button" class="btn btn-secondary <?php
                if ($Player_View === 'Table') {
                    echo 'bg-dark';
                }
                ?>"  >Table</button>
                <button id="player_depth_btn"type="button" class="btn btn-secondary" <?php
                if ($Player_View === 'Depth') {
                    echo 'bg-dark';
                }
                ?> >Depth</button>
                <button id="player_compare_btn"type="button" class="btn btn-secondary" <?php
                if ($Player_View === 'Compare') {
                    echo 'bg-dark';
                }
                ?> >Compare</button>
            </div>
        </div>
        <div class="col-lg-9" <?php
        if ($Player_View === 'Compare') {
            echo 'style="display : none"';
        }
        ?>>
            <span class="badge badge-dark">Select Season to View - Currently Viewing: <?php echo $Player_Season; ?></span>
            <br>
            <?php echo buildDecadeDropdowns('playerSeason'); ?>
        </div>
        <div class="col-lg-3" <?php
        if ($Player_View != 'Compare') {
            echo 'style="display : none"';
        }
        ?>>
        </div>
        <div class="col-lg-6" <?php
        if ($Player_View != 'Compare') {
            echo 'style="display : none"';
        }
        ?>>
            <br>
            <form class="form-inline" id="changeCompareYearsForm">
                <div class="input-group input-group-sm mb-3" style="width : 700px">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Enter Years to Compare &nbsp; <span class="oi oi-caret-right"></span></span>
                    </div>
                    <input name="playerCompareStart" type="text" class="form-control" placeholder="Start Year: <?php echo $Player_Compare_Start ?>" minlength="4">
                    <input name="playerCompareEnd" type="text" class="form-control" placeholder="End Year: <?php echo $Player_Compare_End ?>" minlength="4">
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" type="submit">Compare</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<br>
<div id="playerDataControls" class="controlContainer">
    <div class="row" <?php
    if ($Player_View === 'Compare') {
        echo 'style="display : none"';
    }
    ?>>
        <div class="col-lg-12">
            <input id="playerTableSearch" class="search form-control" placeholder="Search Table" />
        </div>
    </div>
    <br>
    <div class="row" <?php
    if ($Player_View === 'Compare') {
        echo 'style="display : none"';
    }
    ?>>
        <div class="col-lg-12">
            <div class="input-group">
                <?php
                displayPlayerPositionFilterSelect();
                displayPlayerClassFilterSelect();
                displayPlayerStatusFilterSelect();
                displayPlayerOffseasonFilterSelect();
                ?>
            </div>
        </div>
    </div>
    <div class="row" <?php
    if ($Player_View != 'Compare') {
        echo 'style="display : none"';
    }
    ?>>
        <div class="col-lg-12">

        </div>
    </div>
</div>
<br>