<?php
include ("libs/db/common_db_functions.php");

//Recieve Selected Opponents ID
$opp_ID = $_POST['OppID'];

//Get All Games Vs The Selected Opponent
$oppGMdata = db_query("SELECT * FROM `games` WHERE VS='{$opp_ID}'");
?>

<html>
    <head>
        <title>Buckeyes - Opponent Details</title>
        <link rel="shortcut icon" href="http://www.iconj.com/ico/y/f/yfuwmmd6a8.ico" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="libs/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="libs/css/nouislider.css"s>
        <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.0-beta/css/bootstrap-select.min.css">
        <link rel="stylesheet" type="text/css" href="libs/css/open-iconic-bootstrap.css">
        <script src="libs/js/jquery.js"></script>
        <script src="libs/js/bootstrap.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.0-beta/js/bootstrap-select.min.js"></script>
        <script src="libs/js/nouislider.js"></script>
        <script src="libs/js/wNumb.js"></script>
        <script src="libs/js/commonFunctions.js"></script>
    </head>
    <body>
        <!-- include main navigation bar at top of page -->
        <?php include ('nav/navBar.php'); ?>
        <div class="container" style="text-align: center">
            <div class="row">
                <div class="col-lg-12">
                    <br>
                    <!-- create page title based on the opponent -->
                    <h1><span class="badge badge-secondary">Opponent Details - Ohio State vs <?php echo opponentLookup($opp_ID); ?></span></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4" style="text-align: right">
                    <button id="oppGMhistorybtn" class="btn btn-secondary" data-toggle="collapse" href="#oppGMhistory">Games History &nbsp;<span id="closedOppHistoryChev" class="oi oi-chevron-right" title="icon name"></span><span id="openOppHistoryChev" class="oi oi-chevron-bottom" title="icon name"></span></button>
                </div>
                <div class="col-lg-4">
                    <span class="badge badge-secondary">Change Opponent:</span><br>
                    <!-- display dropdown of opponents that ohio state has played -->
                    <select id="changeOppSelect" class="selectpicker" data-live-search="true"  name="ChageOppSelect">
                        <?php
                        $getPlayedOpps = db_query("SELECT DISTINCT Vs FROM `games` ORDER BY VS ASC");

                        while ($fetchUniqueOpps = $getPlayedOpps->fetch_assoc()) {
                            echo '<option value="' . $fetchUniqueOpps['Vs'] . '">' . opponentLookup($fetchUniqueOpps['Vs']) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-lg-4" style="text-align: left">
                    <button id="oppGMsummarybtn" class="btn btn-secondary" data-toggle="collapse" href="#oppSummaryhistory">Series Summary &nbsp;<span id="closedOppSummaryChev" class="oi oi-chevron-right" title="icon name"></span><span id="openOppSummaryChev" class="oi oi-chevron-bottom" title="icon name"></span></button>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-6" style="text-align: right">
                    <h4><span class="badge badge-secondary">Series Record</span></h4>
                </div>
                <div class="col-lg-6" style="text-align: left">
                    <h4><span class="badge badge-secondary"><?php echo returnSeriesRecord($opp_ID); ?></span></h4>
                </div>
            </div>
            <br>
            <div id="oppGMhistory" class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Game History</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Vs <?php echo opponentLookup($opp_ID); ?></h6>
                            <?php
                            echo '<table class="table table-sm">';
                            echo '<thead>';
                            echo '<th>Season - Week</th><th>Date</th><th>Location</th><th>Home/Away</th><th>Result</th><th>OSU Score</th><th>' . opponentLookup($opp_ID) . ' Score</th>';
                            echo '</thead>';
                            echo '<tbody>';

                            while ($fetchOppGMdata = $oppGMdata->fetch_assoc()) {
                                echo '<tr class="' . returnGameOutcomeClass($fetchOppGMdata['OSU_Score'], $fetchOppGMdata['Opp_Score']) . '">';
                                echo '<td>' . getSeason_Year($fetchOppGMdata['Season_ID']) . ' - Week ' . $fetchOppGMdata['Week'] . '</td>';
                                echo '<td>' . $fetchOppGMdata['Date'] . '</td>';
                                echo '<td>' . locationLookup($fetchOppGMdata['Location']) . '</td>';
                                echo '<td>' . HomeAwayLookup($fetchOppGMdata['H_A']) . '</td>';
                                echo '<td>' . returnGameOutcome($fetchOppGMdata['OSU_Score'], $fetchOppGMdata['Opp_Score']) . '</td>';
                                echo '<td>' . $fetchOppGMdata['OSU_Score'] . '</td>';
                                echo '<td>' . $fetchOppGMdata['Opp_Score'] . '</td>';
                                echo '</tr>';
                            }
                            echo '</tbody>';
                            echo '</table>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div id="oppSummaryhistory" class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Series Summary</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Vs <?php echo opponentLookup($opp_ID); ?></h6>
                            <table class="table table-sm" style="text-align: center">
                                <tr>
                                    <td colspan="4">Record</td>
                                </tr>
                                <tr>
                                    <td colspan="2">At Home<br><?php echo returnOppSummaryItem($opp_ID, 'HomeRec'); ?></td><td colspan="2">Away<br><?php echo returnOppSummaryItem($opp_ID, 'AwayRec'); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4">Points</td>
                                </tr>
                                <tr>
                                    <td>OSU Total<br><?php echo number_format(returnOppSummaryItem($opp_ID, 'OSUTotalFor')); ?></td>
                                    <td><?php opponentLookup($opp_ID); ?> Total<br><?php echo number_format(returnOppSummaryItem($opp_ID, 'OppTotalFor')); ?></td>
                                    <td>Average OSU<br><?php echo number_format(returnOppSummaryItem($opp_ID, 'OSUAvgFor'), 1); ?></td>
                                    <td>Average <?php echo opponentLookup($opp_ID); ?><br><?php echo number_format(returnOppSummaryItem($opp_ID, 'OppAvgFor'), 1); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4">#1 vs #2 Games</td>
                                </tr>
                                <tr>
                                    <td colspan="4"><?php echo returnSeriesGames($opp_ID, '1v2', opponentLookup($opp_ID)); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4">Top 5 Games</td>
                                </tr>
                                <tr>
                                    <td colspan="4"><?php echo returnSeriesGames($opp_ID, 'Top5', opponentLookup($opp_ID)); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4">Top 10 Games</td>
                                </tr>
                                <tr>
                                    <td colspan="4"><?php echo returnSeriesGames($opp_ID, 'Top10', opponentLookup($opp_ID)); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4">Both Ranked</td>
                                </tr>
                                <tr>
                                    <td colspan="4"><?php echo returnSeriesGames($opp_ID, 'Top25', opponentLookup($opp_ID)); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    $(document).ready(function () {

        /* Start The Opponent Details View Controls hidden */
        //Collapse the opponent games area
        $('#oppGMhistory').addClass('collapse');
        //Show the closed chevron icon on season view button
        $('#closedOppHistoryChev').show();
        //Hide the open chevron icon on the season view button
        $('#openOppHistoryChev').hide();
        //When the season view controls are hidden show the closed icon and hide the open icon
        $('#oppGMhistory').on('hidden.bs.collapse', function () {
            $('#closedOppHistoryChev').show();
            $('#openOppHistoryChev').hide();

        });
        //When the season view controls are shown show the open icon and hide the closed icon
        $('#oppGMhistory').on('shown.bs.collapse', function () {
            $('#closedOppHistoryChev').hide();
            $('#openOppHistoryChev').show();
        });

        /* Start The Series History Controls hidden */
        //Collapse the season view controls area
        $('#oppSummaryhistory').addClass('collapse');
        //Show the closed chevron icon on season view button
        $('#closedOppSummaryChev').show();
        //Hide the open chevron icon on the season view button
        $('#openOppSummaryChev').hide();
        //When the season view controls are hidden show the closed icon and hide the open icon
        $('#oppSummaryhistory').on('hidden.bs.collapse', function () {
            $('#closedOppSummaryChev').show();
            $('#openOppSummaryChev').hide();
        });
        //When the season view controls are shown show the open icon and hide the closed icon
        $('#oppSummaryhistory').on('shown.bs.collapse', function () {
            $('#closedOppSummaryChev').hide();
            $('#openOppSummaryChev').show();
        });

    });

    //When a new oppoenent is selected to view reload the page with the new opponents details
    $('#changeOppSelect').change(function () {

        var newOpp = $(this).val();

        var form = document.createElement('form');
        document.body.appendChild(form);
        form.method = 'post';
        form.action = 'opponentDetails.php';
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = "OppID";
        input.value = newOpp;
        form.appendChild(input);
        form.submit();
    });

</script>
<?php
//Returns the series record with an opponent
function returnSeriesRecord($opp_ID) {

    $oppGMdata = db_query("SELECT * FROM `games` WHERE VS='{$opp_ID}'");

    $wins = 0;
    $losses = 0;
    $ties = 0;

    while ($fetchoppGMdata = $oppGMdata->fetch_assoc()) {

        if ($fetchoppGMdata['OSU_Score'] > $fetchoppGMdata['Opp_Score']) {
            $wins++;
        }
        if ($fetchoppGMdata['OSU_Score'] < $fetchoppGMdata['Opp_Score']) {
            $losses++;
        }
        if ($fetchoppGMdata['OSU_Score'] === $fetchoppGMdata['Opp_Score']) {
            $ties++;
        }
    }

    return '( ' . $wins . ' - ' . $losses . ' - ' . $ties . ' )';
}
//Returns the requested opponent detail item
function returnOppSummaryItem($opp_ID, $category) {

    if ($category === 'HomeRec') {
        $oppGMdata = db_query("SELECT * FROM `games` WHERE VS='{$opp_ID}' AND H_A='H'");

        $wins = 0;
        $losses = 0;
        $ties = 0;

        while ($fetchoppGMdata = $oppGMdata->fetch_assoc()) {

            if ($fetchoppGMdata['OSU_Score'] > $fetchoppGMdata['Opp_Score']) {
                $wins++;
            }
            if ($fetchoppGMdata['OSU_Score'] < $fetchoppGMdata['Opp_Score']) {
                $losses++;
            }
            if ($fetchoppGMdata['OSU_Score'] === $fetchoppGMdata['Opp_Score']) {
                $ties++;
            }
        }
        return '( ' . $wins . ' - ' . $losses . ' - ' . $ties . ' )';
    }
    if ($category === 'AwayRec') {
        $oppGMdata = db_query("SELECT * FROM `games` WHERE VS='{$opp_ID}' AND H_A='A'");

        $wins = 0;
        $losses = 0;
        $ties = 0;

        while ($fetchoppGMdata = $oppGMdata->fetch_assoc()) {

            if ($fetchoppGMdata['OSU_Score'] > $fetchoppGMdata['Opp_Score']) {
                $wins++;
            }
            if ($fetchoppGMdata['OSU_Score'] < $fetchoppGMdata['Opp_Score']) {
                $losses++;
            }
            if ($fetchoppGMdata['OSU_Score'] === $fetchoppGMdata['Opp_Score']) {
                $ties++;
            }
        }
        return '( ' . $wins . ' - ' . $losses . ' - ' . $ties . ' )';
    }

    if ($category === 'OSUTotalFor') {
        return OSUseriesTotal($opp_ID);
    }

    if ($category === 'OppTotalFor') {
        return OppSeriesTotal($opp_ID);
    }
    if ($category === 'OSUAvgFor') {
        $OSUTotal = OSUseriesTotal($opp_ID);
        $gameCount = countSeriesGames($opp_ID);

        return $OSUTotal / $gameCount;
    }
    if ($category === 'OppAvgFor') {
        $OppTotal = OppseriesTotal($opp_ID);
        $gameCount = countSeriesGames($opp_ID);

        return $OppTotal / $gameCount;
    }
}
//Returns the total OSU points scored vs an opponent
function OSUseriesTotal($opp_ID) {

    $oppGMdata = db_query("SELECT * FROM `games` WHERE VS='{$opp_ID}'");

    $OSUTotal = 0;

    while ($fetchoppGMdata = $oppGMdata->fetch_assoc()) {

        $OSUTotal = $OSUTotal + $fetchoppGMdata['OSU_Score'];
    }
    return $OSUTotal;
}
//Returns the total Opponent points scored vs an opponent
function OppSeriesTotal($opp_ID) {
    $oppGMdata = db_query("SELECT * FROM `games` WHERE VS='{$opp_ID}'");

    $OppTotal = 0;

    while ($fetchoppGMdata = $oppGMdata->fetch_assoc()) {

        $OppTotal = $OppTotal + $fetchoppGMdata['Opp_Score'];
    }
    return $OppTotal;
}
//Counts the number of games played vs and opponent
function countSeriesGames($opp_ID) {

    $oppGMdata = db_query("SELECT * FROM `games` WHERE VS='{$opp_ID}'");

    $gameCount = 0;

    while ($fetchoppGMdata = $oppGMdata->fetch_assoc()) {

        $gameCount++;
    }
    return $gameCount;
}
//Displays the games vs an opponent based on given category
function returnSeriesGames($opp_ID, $category, $OppName) {

    if ($category === '1v2') {
        $oppGMdata = db_query("SELECT * FROM `games` WHERE VS='{$opp_ID}' AND (Opp_AP_RK = 1 OR OSU_AP_RK = 1) AND (Opp_AP_RK = 2 OR OSU_AP_RK = 2)");

        $rows = mysqli_num_rows($oppGMdata);

        if ($rows < 1) {
            echo 'None';
        } else {
            while ($fetchOppGMdata = $oppGMdata->fetch_assoc()) {
                echo '<tr class="' . returnGameOutcomeClass($fetchOppGMdata['OSU_Score'], $fetchOppGMdata['Opp_Score']) . '">';
                echo '<td>' . getSeason_Year($fetchOppGMdata['Season_ID']) . ' - Week ' . $fetchOppGMdata['Week'] . '</td>';
                echo '<td>' . $fetchOppGMdata['Date'] . '</td>';
                echo '<td>' . locationLookup($fetchOppGMdata['Location']) . '</td>';
                echo '<td><span class="badge badge-secondary">#' . $fetchOppGMdata['OSU_AP_RK'] . '</span> OSU - ' . $fetchOppGMdata['OSU_Score'] . ' <span class="badge badge-secondary">#' . $fetchOppGMdata['Opp_AP_RK'] . '</span> ' . $OppName . '- ' . $fetchOppGMdata['Opp_Score'] . '</td>';
                echo '</tr>';
            }
        }
    }
    if ($category === 'Top5') {
        $oppGMdata = db_query("SELECT * FROM `games` WHERE (VS='{$opp_ID}' AND (Opp_AP_RK <= 5 AND Opp_AP_RK > 0 AND OSU_AP_RK <=5 AND OSU_AP_RK > 0))");

        $rows = mysqli_num_rows($oppGMdata);

        if ($rows < 1) {
            echo 'None';
        } else {

            while ($fetchOppGMdata = $oppGMdata->fetch_assoc()) {
                echo '<tr class="' . returnGameOutcomeClass($fetchOppGMdata['OSU_Score'], $fetchOppGMdata['Opp_Score']) . '">';
                echo '<td>' . getSeason_Year($fetchOppGMdata['Season_ID']) . ' - Week ' . $fetchOppGMdata['Week'] . '</td>';
                echo '<td>' . $fetchOppGMdata['Date'] . '</td>';
                echo '<td>' . locationLookup($fetchOppGMdata['Location']) . '</td>';
                echo '<td><span class="badge badge-secondary">#' . $fetchOppGMdata['OSU_AP_RK'] . '</span> OSU - ' . $fetchOppGMdata['OSU_Score'] . ' <span class="badge badge-secondary">#' . $fetchOppGMdata['Opp_AP_RK'] . '</span> ' . $OppName . '- ' . $fetchOppGMdata['Opp_Score'] . '</td>';
                echo '</tr>';
            }
        }
    }
    if ($category === 'Top10') {
        $oppGMdata = db_query("SELECT * FROM `games` WHERE (VS='{$opp_ID}' AND (Opp_AP_RK <= 10 AND Opp_AP_RK > 0 AND OSU_AP_RK <=10 AND OSU_AP_RK > 0))");

        $rows = mysqli_num_rows($oppGMdata);

        if ($rows < 1) {
            echo 'None';
        } else {

            while ($fetchOppGMdata = $oppGMdata->fetch_assoc()) {
                echo '<tr class="' . returnGameOutcomeClass($fetchOppGMdata['OSU_Score'], $fetchOppGMdata['Opp_Score']) . '">';
                echo '<td>' . getSeason_Year($fetchOppGMdata['Season_ID']) . ' - Week ' . $fetchOppGMdata['Week'] . '</td>';
                echo '<td>' . $fetchOppGMdata['Date'] . '</td>';
                echo '<td>' . locationLookup($fetchOppGMdata['Location']) . '</td>';
                echo '<td><span class="badge badge-secondary">#' . $fetchOppGMdata['OSU_AP_RK'] . '</span> OSU - ' . $fetchOppGMdata['OSU_Score'] . ' <span class="badge badge-secondary">#' . $fetchOppGMdata['Opp_AP_RK'] . '</span> ' . $OppName . '- ' . $fetchOppGMdata['Opp_Score'] . '</td>';
                echo '</tr>';
            }
        }
    }
    if ($category === 'Top25') {
        $oppGMdata = db_query("SELECT * FROM `games` WHERE (Opp_AP_RK <= 25 AND Opp_AP_RK > 0 AND OSU_AP_RK <=25 AND OSU_AP_RK > 0) AND Vs='{$opp_ID}'");

        $rows = mysqli_num_rows($oppGMdata);

        if ($rows < 1) {
            echo 'None';
        } else {

            while ($fetchOppGMdata = $oppGMdata->fetch_assoc()) {
                echo '<tr class="' . returnGameOutcomeClass($fetchOppGMdata['OSU_Score'], $fetchOppGMdata['Opp_Score']) . '">';
                echo '<td>' . getSeason_Year($fetchOppGMdata['Season_ID']) . ' - Week ' . $fetchOppGMdata['Week'] . '</td>';
                echo '<td>' . $fetchOppGMdata['Date'] . '</td>';
                echo '<td>' . locationLookup($fetchOppGMdata['Location']) . '</td>';
                echo '<td><span class="badge badge-secondary">#' . $fetchOppGMdata['OSU_AP_RK'] . '</span> OSU - ' . $fetchOppGMdata['OSU_Score'] . ' <span class="badge badge-secondary">#' . $fetchOppGMdata['Opp_AP_RK'] . '</span> ' . opponentLookup($fetchOppGMdata['Vs']) . '- ' . $fetchOppGMdata['Opp_Score'] . '</td>';
                echo '</tr>';
            }
        }
    }
}
//Returns the appropriate class to color the games played vs an opponent table based on outcome of game
function returnGameOutcomeClass($OSU_Score, $Opp_Score) {

    if ($OSU_Score > $Opp_Score) {
        return "table-success";
    }
    if ($OSU_Score === $Opp_Score) {
        return "table-warning";
    }
    if ($OSU_Score < $Opp_Score) {
        return "table-danger";
    }
}