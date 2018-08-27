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

$get_PlayerComparePosGroup = db_query("SELECT * FROM `Controls` WHERE Control='player_compare_pos_grouped'");
$fetch_PlayerComparePosGroup = $get_PlayerComparePosGroup->fetch_assoc();
$Player_Compare_PosGroup = $fetch_PlayerComparePosGroup['Value'];
?>
<div class="row">
    <div class="col-lg-6">
        <button class="btn btn-secondary" data-toggle="collapse" href="#playerViewControls">Player View &nbsp;<span id="closedPlayerViewChev" class="oi oi-chevron-right" title="icon name"></span><span id="openPlayerViewChev" class="oi oi-chevron-bottom" title="icon name"></span></button>
    </div>
    <div class="col-lg-6">
        <button id="playerDataControlsBtn" class="btn btn-secondary" data-toggle="collapse" href="#playerDataControls">Player Data Controls &nbsp;<span id="closedPlayerDataChev" class="oi oi-chevron-right" title="icon name"></span><span id="openPlayerDataChev" class="oi oi-chevron-bottom" title="icon name"></span></button>
    </div>
</div>
<br>
<div id="playerViewControls" style="border: 1px solid black; border-radius: 5px; padding: 15px 15px 15px 15px">
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
            <div class="btn-group">
                <button id="decade2010s" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    2010s
                </button>
                <div class="dropdown-menu" aria-labelledby="decade2010s">
                    <?php
                    displayDecadeDropdownOptions('14', 'playerSeason');
                    ?>
                </div>
            </div>
            <div class="btn-group">
                <button id="decade2000s" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    2000s
                </button>
                <div class="dropdown-menu" aria-labelledby="decade2010s">
                    <?php
                    displayDecadeDropdownOptions('13', 'playerSeason');
                    ?>
                </div>
            </div>
            <div class="btn-group">
                <button id="decade1990s" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    1990s
                </button>
                <div class="dropdown-menu" aria-labelledby="decade1990s">
                    <?php
                    displayDecadeDropdownOptions('12', 'playerSeason');
                    ?>
                </div>
            </div>
            <div class="btn-group">
                <button id="decade1980ss" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    1980s
                </button>
                <div class="dropdown-menu" aria-labelledby="decade1980s">
                    <?php
                    displayDecadeDropdownOptions('11', 'playerSeason');
                    ?>
                </div>
            </div>
            <div class="btn-group">
                <button id="decade1970s" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    1970s
                </button>
                <div class="dropdown-menu" aria-labelledby="decade1970s">
                    <?php
                    displayDecadeDropdownOptions('10', 'playerSeason');
                    ?>
                </div>
            </div>
            <div class="btn-group">
                <button id="decade1960s" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    1960s
                </button>
                <div class="dropdown-menu" aria-labelledby="decade1960s">
                    <?php
                    displayDecadeDropdownOptions('9', 'playerSeason');
                    ?>
                </div>
            </div>
            <div class="btn-group">
                <button id="decade1950s" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    1950s
                </button>
                <div class="dropdown-menu" aria-labelledby="decade1950s">
                    <?php
                    displayDecadeDropdownOptions('8', 'playerSeason');
                    ?>
                </div>
            </div>
            <div class="btn-group">
                <button id="decade1940s" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    1940s
                </button>
                <div class="dropdown-menu" aria-labelledby="decade1940s">
                    <?php
                    displayDecadeDropdownOptions('7', 'playerSeason');
                    ?>
                </div>
            </div>
            <div class="btn-group">
                <button id="decade1930s" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    1930s
                </button>
                <div class="dropdown-menu" aria-labelledby="decade1930s">
                    <?php
                    displayDecadeDropdownOptions('6', 'playerSeason');
                    ?>
                </div>
            </div>
            <div class="btn-group">
                <button id="decade1920s" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    1920s
                </button>
                <div class="dropdown-menu" aria-labelledby="decade1920s">
                    <?php
                    displayDecadeDropdownOptions('5', 'playerSeason');
                    ?>
                </div>
            </div>
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
<div id="playerDataControls" style="border: 1px solid black; border-radius: 5px; padding: 15px 15px 15px 15px">
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