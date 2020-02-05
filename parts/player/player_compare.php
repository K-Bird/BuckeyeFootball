<div class="row">  
    <div class="col-lg-1">
        <?php echo playerCompareAddYearsBtn(getSeason_ID($Player_Compare_Start), getSeason_ID($Player_Compare_End), "Left"); ?>
    </div>
    <div class="col-lg-10">
        <table id="playerCompareTable" class="table table-sm" style="text-align: center">
            <thead>
                <?php
                echo playerCompareHeader($Player_Compare_Start, $Player_Compare_End);
                ?>
            </thead>
            <tbody>
                <?php
                echo playerCompareBody(getSeason_ID($Player_Compare_Start), getSeason_ID($Player_Compare_End));
                ?>
            </tbody>
        </table>
    </div>
    <div class="col-lg-1">
        <?php echo playerCompareAddYearsBtn(getSeason_ID($Player_Compare_Start), getSeason_ID($Player_Compare_End), "Right"); ?>
    </div>
</div>
<?php
//Create the headings for the player compare page
function playerCompareHeader($startYear, $endYear) {

    $year = $startYear;

    echo '<tr>';

    do {

        echo '<th>';
        echo $year;
        echo '</th>';
        $year++;
    } while ($year <= $endYear);

    echo '</tr>';
}
//Create the main content for the player compare page
function playerCompareBody($startYear, $endYear) {

    $season = $startYear;

    $masterIDs = [];

    $getPlayerMasterIDs = db_query("SELECT DISTINCT Player_Master_ID FROM `players` WHERE Season BETWEEN '{$startYear}' AND '{$endYear}' ORDER BY Last_Name");

    while ($fetch = $getPlayerMasterIDs->fetch_assoc()) {

        array_push($masterIDs, $fetch['Player_Master_ID']);
    }

    foreach ($masterIDs as $ID) {
        echo '<tr>';

        while ($season <= $endYear) {

            $getPlayerData = db_query("SELECT * FROM `players` WHERE Player_Master_ID={$ID} AND Season={$season}");
            $fetchPlayerData = $getPlayerData->fetch_assoc();

            if (mysqli_num_rows($getPlayerData) === 0) {
                echo '<td>-</td>';
            } else {

                echo '<td>' . $fetchPlayerData['First_Name'] . " " . $fetchPlayerData['Last_Name'] . " - " . $fetchPlayerData['Class'] . " - " . $fetchPlayerData['Position'] . '</td>';
            }
            $season++;
        }

        $season = $startYear;

        echo '</tr>';
    }
}
//Create the buttons to add years to the compare page
function playerCompareAddYearsBtn($startYear, $endYear, $orientation) {

    $leftYear = $startYear - 1;
    $rightYear = $endYear + 1;

    if ($orientation === 'Left') {
        echo '<button id="nextCompareYearLeft" class="btn btn-success btn-sm" data-year="' . getSeason_Year($leftYear) . '"><span class="oi oi-plus"></span></button>';
    }
    if ($orientation === 'Right') {
        echo '<button id="nextCompareYearRight" class="btn btn-success btn-sm" data-year="' . getSeason_Year($rightYear) . '"><span class="oi oi-plus"></span></button>';
    }
}
