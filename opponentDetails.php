<?php
include ("libs/db/common_db_functions.php");

//Recieve Selected Opponents ID
$OppID = $_POST['OppID'];

//Get All Games Vs The Selected Opponent
$oppGMdata = db_query("SELECT * FROM `games` WHERE VS='{$OppID}'");
?>

<html>
    <head>
        <title>Vs Details</title>
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
        <?php include ('nav/navBar.php'); ?>
        <div class="container" style="text-align: center">
            <div class="row">
                <div class="col-lg-12">
                    <br>
                    <h1><span class="badge badge-secondary">Opponent Details - Ohio State vs <?php echo opponentLookup($OppID); ?></span></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4" style="text-align: right">
                    <button class="btn btn-secondary" data-toggle="collapse" href="#oppGMhistory">Games History &nbsp;<span id="closedOppHistoryChev" class="oi oi-chevron-right" title="icon name"></span><span id="openOppHistoryChev" class="oi oi-chevron-bottom" title="icon name"></span></button>
                </div>
                <div class="col-lg-4">
                    <span class="badge badge-secondary">Change Opponent:</span><br>
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
                    <button class="btn btn-secondary" data-toggle="collapse" href="#oppSummaryhistory">Series Summary &nbsp;<span id="closedOppSummaryChev" class="oi oi-chevron-right" title="icon name"></span><span id="openOppSummaryChev" class="oi oi-chevron-bottom" title="icon name"></span></button>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-6" style="text-align: right">
                    <h4><span class="badge badge-secondary">Series Record</span></h4>
                </div>
                <div class="col-lg-6" style="text-align: left">
                    <h4><span class="badge badge-secondary"><?php echo returnSeriesRecord($OppID); ?></span></h4>
                </div>
            </div>
            <br>
            <div id="oppGMhistory" class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Game History</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Vs <?php echo opponentLookup($OppID); ?></h6>
                            <?php
                            echo '<table class="table table-sm">';
                            echo '<thead>';
                            echo '<th>Season - Week</th><th>Date</th><th>Location</th><th>Home/Away</th><th>Result</th><th>OSU Score</th><th>' . opponentLookup($OppID) . ' Score</th>';
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
                            <h6 class="card-subtitle mb-2 text-muted">Vs <?php echo opponentLookup($OppID); ?></h6>
                            <table class="table table-sm" style="text-align: center">
                                <tr>
                                    <td colspan="4">Record</td>
                                </tr>
                                <tr>
                                    <td colspan="2">At Home<br><?php echo returnOppSummaryItem($OppID, 'HomeRec'); ?></td><td colspan="2">Away<br><?php echo returnOppSummaryItem($OppID, 'AwayRec'); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4">Points</td>
                                </tr>
                                <tr>
                                    <td>OSU Total<br><?php echo number_format(returnOppSummaryItem($OppID, 'OSUTotalFor')); ?></td>
                                    <td><?php opponentLookup($OppID); ?> Total<br><?php echo number_format(returnOppSummaryItem($OppID, 'OppTotalFor')); ?></td>
                                    <td>Average OSU<br><?php echo number_format(returnOppSummaryItem($OppID, 'OSUAvgFor'),1); ?></td>
                                    <td>Average <?php echo opponentLookup($OppID); ?><br><?php echo number_format(returnOppSummaryItem($OppID, 'OppAvgFor'),1); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4">#1 vs #2 Games</td>
                                </tr>
                                <tr>
                                    <td colspan="4"><?php echo returnSeriesGames($OppID, '1v2', opponentLookup($OppID)); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4">Top 5 Games</td>
                                </tr>
                                <tr>
                                    <td colspan="4"><?php echo returnSeriesGames($OppID, 'Top5', opponentLookup($OppID)); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4">Top 10 Games</td>
                                </tr>
                                <tr>
                                    <td colspan="4"><?php echo returnSeriesGames($OppID, 'Top10', opponentLookup($OppID)); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4">Both Ranked</td>
                                </tr>
                                <tr>
                                    <td colspan="4"><?php echo returnSeriesGames($OppID, 'Top25', opponentLookup($OppID)); ?></td>
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
