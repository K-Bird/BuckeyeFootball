<div class="row">  
    <div class="col-lg-1">
        <?php echo playerCompareYearsBtns(getSeason_ID($Player_Compare_Start), getSeason_ID($Player_Compare_End), "Left"); ?>
    </div>
    <div class="col-lg-10">
        <div id="legendCollapse">
            <div class="card">
                <h5 class="card-header" data-toggle="collapse" data-target="#legendContent">
                    <span class="badge badge-dark">Legend</span>
                </h5>
                <div class="card-body" id="legendContent" data-parent="#legendCollapse">
                    <div class="row">
                        <div class="col-lg-1">

                        </div>
                        <div class="col-lg-4 controlContainer" style="text-align: left">
                            <span class="oi oi-circle-check"></span>&nbsp;<span class="badge badge-dark">On Team From Previous Year</span><br>
                            <span class="oi oi-person"></span>&nbsp;<span class="badge badge-dark">Recruited in Year's Class</span><br>
                            <span class="oi oi-transfer"></span>&nbsp;<span class="badge badge-dark">Transferred to Team</span><br>
                            <span class="oi oi-arrow-right"></span>&nbsp;<span class="badge badge-dark">Walked on to the Team</span><br>
                            <span class="oi oi-home"></span>&nbsp;<span class="badge badge-dark">Came From Junior College</span><br>
                            <span class="oi oi-medical-cross"></span>&nbsp;<span class="badge badge-dark">Injured and Out for the Season</span><br>
                            <span class="oi oi-x"></span>&nbsp;<span class="badge badge-dark">Dismissed from Team</span><br>
                        </div>
                        <div class="col-lg-2">

                        </div>
                        <div class="col-lg-4 controlContainer" style="text-align: left">
                            <span class="oi oi-arrow-circle-right"></span>&nbsp;<span class="badge badge-dark">Stayed on Team for Following Year</span><br>
                            <span class="oi oi-script"></span>&nbsp;<span class="badge badge-dark">Graduated Program</span><br>
                            <span class="oi oi-map-marker"></span>&nbsp;<span class="badge badge-dark">Left Early for NFL Draft</span><br>
                            <span class="oi oi-transfer"></span>&nbsp;<span class="badge badge-dark">Transferred In the Offseason</span><br>
                            <span class="oi oi-flag"></span>&nbsp;<span class="badge badge-dark">Elected to Redshirt</span><br>
                            <span class="oi oi-circle-x"></span>&nbsp;<span class="badge badge-dark">Will Not be on Team Following Year</span><br>
                        </div>
                        <div class="col-lg-1">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <?php
        echo buildPlayerCompareControls();
        echo '<br>';

//get current position groups
        $getPosGroups = db_query("SELECT * FROM `controls` WHERE Control='player_compare_pos_groups'");
        $fetchPosGroups = $getPosGroups->fetch_assoc();

        $posGroups = $fetchPosGroups['Value'];
        $eachPosGroup = explode(',', $posGroups);

        echo buildCompareYearDisplay(getSeason_ID($Player_Compare_Start), getSeason_ID($Player_Compare_End));
        echo '<br>';

        foreach ($eachPosGroup as $pos) {
            echo buildPositionCard($pos, getSeason_ID($Player_Compare_Start), getSeason_ID($Player_Compare_End));
            echo '<br>';
        }
        ?>
    </div>
    <div class="col-lg-1">
        <?php echo playerCompareYearsBtns(getSeason_ID($Player_Compare_Start), getSeason_ID($Player_Compare_End), "Right"); ?>
    </div>
</div>
<?php

//Create the buttons to add years to the compare page
function playerCompareYearsBtns($startYear, $endYear, $orientation) {

    //Add Year Calcuations
    $addLeftYear = $startYear - 1;
    $addRightYear = $endYear + 1;

    //Subtract Year Calculations
    $subLeftYear = $startYear + 1;
    $subRightYear = $endYear - 1;


    if ($orientation === 'Left') {
        echo '<button id="nextCompareYearLeft" class="btn btn-success btn-sm" data-year="' . getSeason_Year($addLeftYear) . '"><span class="oi oi-plus"></span></button>';
        echo '<br><br>';
        echo '<button id="prevCompareYearLeft" class="btn btn-danger btn-sm" data-year="' . getSeason_Year($subLeftYear) . '"><span class="oi oi-minus"></span></button>';
    }
    if ($orientation === 'Right') {
        echo '<button id="nextCompareYearRight" class="btn btn-success btn-sm" data-year="' . getSeason_Year($addRightYear) . '"><span class="oi oi-plus"></span></button>';
        echo '<br><br>';
        echo '<button id="prevCompareYearRight" class="btn btn-danger btn-sm" data-year="' . getSeason_Year($subRightYear) . '"><span class="oi oi-minus"></span></button>';
    }
}

//Build position controls
function buildPlayerCompareControls() {

    $getPosGroups = db_query("SELECT * FROM `controls` WHERE Control='player_compare_pos_groups'");
    $fetchPosGroups = $getPosGroups->fetch_assoc();
    $posGroups = $fetchPosGroups['Value'];
    $eachPosGroup = explode(',', $posGroups);

    echo '<div class="row controlContainer">';

    $posArray = returnPositionArray();

    echo '<div class="input-group">';

    foreach ($posArray as $pos) {

        echo '<span class="badge badge-dark">' . $pos . '</span><input type="checkbox" class="form-control comparePosCheck" data-pos="' . $pos . '"';

        if (in_array($pos, $eachPosGroup)) {

            echo ' checked';
        }

        echo '>';
    }

    echo '</div>';
    echo '</div>';
}

//Build the player compare years display
function buildCompareYearDisplay($startYear, $endYear) {

    $season = $startYear;
    echo '<div class="row">';

    while ($season <= $endYear) {

        echo '<div class="col">';
        echo '<span class="list-group-item list-group-item-action" style="text-align: center"><h2><span class="badge badge-dark">' . getSeason_Year($season) . '</span></h2></span>';
        echo '</div>';
        $season++;
    }
    echo '</div>';
}

//Build the player compare positional display
function buildPositionCard($pos, $startYear, $endYear) {

    $season = $startYear;

    echo '<div class="row">';

    while ($season <= $endYear) {

        echo '<div class="col">';
        echo '<table class="table table-dark table-sm">';
        echo '<thead>';
        echo '<th><span class="list-group-item list-group-item-action" style="text-align: center">' . $pos . '</span></th>';
        echo '</thead>';
        echo '<tbody>';

        $getPosByYear = db_query("SELECT * FROM `players` WHERE Position='{$pos}' AND Season='{$season}' ORDER BY FIELD(Depth,'1','2','3','4','5','0')");



        while ($fetchPosByYear = $getPosByYear->fetch_assoc()) {
            echo '<tr>';
            echo '<td><span class="list-group-item list-group-item-action">';
            echo '<small>';
            echo seasonStatusDisplay($fetchPosByYear['Team_Status']) . ' ';
            echo $pos;

            if ($fetchPosByYear['Depth'] === '0') {
                echo " - ";
            } else {
                echo $fetchPosByYear['Depth'] . " - ";
            }
            echo $fetchPosByYear['First_Name'] . " ";
            echo $fetchPosByYear['Last_Name'] . " - ";
            echo $fetchPosByYear['Class'];
            echo ' ' . offseasonStatusDisplay($fetchPosByYear['Post_Season_Status']);
            echo '</small></span></td>';
            echo '</tr>';
        }

        $season++;

        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    }
    echo '</div>';
}

function seasonStatusDisplay($status) {

    if ($status === 'On Team') {
        return '<span class="oi oi-circle-check" data-toggle="tooltip" data-placement="bottom" title="On Team"></span>';
    }
    if ($status === 'Recruit') {
        return '<span class="oi oi-person" data-toggle="tooltip" data-placement="bottom" title="Recruit"></span>';
    }
    if ($status === 'Transfer') {
        return '<span class="oi oi-transfer" data-toggle="tooltip" data-placement="bottom" title="Transferred"></span>';
    }
    if ($status === 'Walk On') {
        return '<span class="oi oi-arrow-right" data-toggle="tooltip" data-placement="bottom" title="Walk On"></span>';
    }
    if ($status === 'JUCO') {
        return '<span class="oi oi-home" data-toggle="tooltip" data-placement="bottom" title="Junior College"></span>';
    }
    if ($status === 'Injured') {
        return '<span class="oi oi-medical-cross" data-toggle="tooltip" data-placement="bottom" title="Injured"></span>';
    }
    if ($status === 'Dismissed') {
        return '<span class="oi oi-x" data-toggle="tooltip" data-placement="bottom" title="Dismissed"></span>';
    }
}

function offseasonStatusDisplay($status) {

    if ($status === 'Stayed') {
        return '<span class="oi oi-arrow-circle-right" data-toggle="tooltip" data-placement="bottom" title="Stayed On Team"></span>';
    }
    if ($status === 'Redshirt') {
        return '<span class="oi oi-flag" data-toggle="tooltip" data-placement="bottom" title="Stayed On Team"></span>';
    }
    if ($status === 'Transferred') {
        return '<span class="oi oi-transfer" data-toggle="tooltip" data-placement="bottom" title="Transferred"></span>';
    }
    if ($status === 'Left For Draft') {
        return '<span class="oi oi-map-marker" data-toggle="tooltip" data-placement="bottom" title="Draft"></span>';
    }
    if ($status === 'Not On Team') {
        return '<span class="oi oi-circle-x" data-toggle="tooltip" data-placement="bottom" title="Not On Team"></span>';
    }
    if ($status === 'Graduated') {
        return '<span class="oi oi-script" data-toggle="tooltip" data-placement="bottom" title="Graduated"></span>';
    }
}
