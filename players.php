<?php
include ("libs/db/common_db_functions.php");
include ('parts/common_inputs.php');

$get_controlData = db_query("SELECT * FROM `controls` WHERE `Control`='Player_Season'");
$fetch_playerSeason = $get_controlData->fetch_assoc();
$playerSeason = $fetch_playerSeason['Value'];

$season_ID = getSeason_ID($playerSeason);

$getDepthForm = db_query("SELECT * FROM `Seasons` WHERE Season_ID={$season_ID}");
$fetchDepthForm = $getDepthForm->fetch_assoc();
$DepthForm = $fetchDepthForm['DepthChart'];
?>
<html>
    <head>
        <title>Buckeyes - Players</title>
        <link rel="shortcut icon" href="http://www.iconj.com/ico/y/f/yfuwmmd6a8.ico" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="libs/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="libs/css/nouislider.css">
        <link rel="stylesheet" type="text/css" href="libs/css/open-iconic-bootstrap.css">
        <link rel="stylesheet" type="text/css" href="libs/css/tablesorter-default.css">
        <link rel="stylesheet" type="text/css" href="libs/css/common.css">
        <script src="libs/js/jquery.js"></script>
        <script src="libs/js/bootstrap.js"></script>
        <script src="libs/js/nouislider.js"></script>
        <script src="libs/js/tablesorter.js"></script>
        <script src="libs/js/tablesorter-widgets.js"></script>
        <script src="libs/js/wNumb.js"></script>
        <script src="libs/js/commonFunctions.js"></script>
    </head>
    <body>
        <?php include ('nav/navBar.php'); ?>
        <div class="loaderText" style="text-align: center"><br><br><h2><span class="badge badge-secondary">Loading Player Data</span></h2></div>
        <div class="loaderIcon"></div>
        <div id="playerContent" class="container-fluid" style="text-align: center">
            <?php include ('parts/player/player_controls.php'); ?>
            <div class="row">
                <div class="col">
                    <!-- Check Player View Control -->          
                    <?php
                    $get_PlayerView = db_query("SELECT * FROM `Controls` WHERE Control='Player_View'");
                    $fetch_PlayerView = $get_PlayerView->fetch_assoc();
                    $Player_View = $fetch_PlayerView['Value'];

                    if ($Player_View === 'Table') {
                        include ('parts/player/player_table.php');
                    }
                    if ($Player_View === 'Depth') {
                        if ($DepthForm === 'iform') {
                            include ('parts/player/player_depth_iform.php');
                        }
                        if ($DepthForm === 'spread') {
                            include ('parts/player/player_depth_spread.php');
                        }
                        if ($DepthForm === 'starters') {
                            include ('parts/player/player_depth_starters.php');
                        }
                        if ($DepthForm === 'none') {

                            echo '<div class="card">
                                    <div class="card-body">
                                        Roster Data Not Avalaible Prior to 1953
                                    </div>
                                 </div>';
                        }
                    }
                    if ($Player_View === 'Compare') {
                        include ('parts/player/player_compare.php');
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    $(document).ready(function () {

        /* Page Loading */
        //When page is ready hide the loading text and icon then display the content
        $('#playerContent').fadeIn(2000);
        $('.loaderIcon').hide();
        $('.loaderText').hide();

        /* Page Display */
        //Set localstorage values for player view and player data panels if they don't exist
        if (localStorage.getItem('OSU_Player_View_Controls') === null) {
            localStorage.setItem('OSU_Player_View_Controls', 'closed');
        }
        if (localStorage.getItem('OSU_Player_Data_Controls') === null) {
            localStorage.setItem('OSU_Player_Data_Controls', 'closed');
        }

        if (localStorage.getItem('OSU_Player_View_Controls') === 'closed') {
            //Collapse the player view controls area
            $('#playerViewControls').addClass('collapse');
            //Show the closed chevron icon on player view button
            $('#closedPlayerViewChev').show();
            //Hide the open chevron icon on the player view button
            $('#openPlayerViewChev').hide();
        }
        if (localStorage.getItem('OSU_Player_View_Controls') === 'open') {
            $('#playerViewControls').addClass('show');
            //Show the closed chevron icon on player view button
            $('#closedPlayerViewChev').hide();
            //Hide the open chevron icon on the player view button
            $('#openPlayerViewChev').show();
        }
        //When the player view controls are hidden show the closed icon and hide the open icon and remember it being closed
        $('#playerViewControls').on('hidden.bs.collapse', function () {
            $('#closedPlayerViewChev').show();
            $('#openPlayerViewChev').hide();
            localStorage.setItem('OSU_Player_View_Controls', 'closed');

        });
        //When the player view controls are shown show the open icon and hide the closed icon and remember it being open
        $('#playerViewControls').on('shown.bs.collapse', function () {
            $('#closedPlayerViewChev').hide();
            $('#openPlayerViewChev').show();
            localStorage.setItem('OSU_Player_View_Controls', 'open');
        });

        if (localStorage.getItem('OSU_Player_Data_Controls') === 'closed') {
            //Collapse the player view controls area
            $('#playerDataControls').addClass('collapse');
            //Show the closed chevron icon on player view button
            $('#closedPlayerDataChev').show();
            //Hide the open chevron icon on the player view button
            $('#openPlayerDataChev').hide();
        }
        if (localStorage.getItem('OSU_Player_Data_Controls') === 'open') {
            //Collapse the player view controls area
            $('#playerDataControls').addClass('show');
            //Show the closed chevron icon on player view button
            $('#closedPlayerDataChev').hide();
            //Hide the open chevron icon on the player view button
            $('#openPlayerDataChev').show();
        }
        //When the player data controls are hidden show the closed icon and hide the open icon and remember it being closed
        $('#playerDataControls').on('hidden.bs.collapse', function () {
            $('#closedPlayerDataChev').show();
            $('#openPlayerDataChev').hide();
            localStorage.setItem('OSU_Player_Data_Controls', 'closed');
        });
        //When the player data controls are shown show the open icon and hide the closed icon
        $('#playerDataControls').on('shown.bs.collapse', function () {
            $('#closedPlayerDataChev').hide();
            $('#openPlayerDataChev').show();
            localStorage.setItem('OSU_Player_Data_Controls', 'open');
        });

        //Check to see if player table exists (if not, depth chart or compare view is shown), if is does not then disable to player data controls button and don't show data ctrols if they were open
        if ($('#playerTable').length > 0) {

        } else {
            $('#playerDataControlsBtn').prop("disabled", true);
            $('#playerDataControls').hide();
        }

        /* Player Table Sorting and Filtering */
        //Use tablesorting plugin to sort table columns
        $("#playerTable").tablesorter({
            theme: "default",
        });

        //Apply filtering and sorting plugin to the player table
        $('#playerTableSearch').on('input', function () {
            var searchText = $(this).val();

            $('#playerTable tbody tr').each(function () {
                if (searchText === '') {
                    $(this).show();
                } else {
                    if ($(this).is(':contains(' + searchText + ')')) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                }
            });
        });

        //Filter Player Table By Position Once a Dropdown Item Is Selected
        $('#playerPosFilter').change(function () {

            //Filter elements on selected option
            $('#playerTable tr td.player-filter-pos').each(function (e) {
                $(this).closest('tr').show();
            });
            var selectedPos = $(this).val();

            if (selectedPos === '0') {
                $('#playerTable tr td.player-filter-pos').each(function (e) {
                    $(this).closest('tr').show();
                });
            } else {

                $('#playerTable tr td.player-filter-pos').each(function (e) {
                    var rowPos = $(this).data('posval');

                    if (rowPos === selectedPos) {
                    } else {
                        $(this).closest('tr').hide();
                    }
                });
            }
        });

        //Filter Player Table By Status Status Once a Dropdown Item Is Selected
        $('#playerStatusFilter').change(function () {

            //Filter elements on selected option
            $('#playerTable tr td.player-filter-status').each(function (e) {
                $(this).closest('tr').show();
            });
            var selectedStatus = $(this).val();

            if (selectedStatus === '0') {
                $('#playerTable tr td.player-filter-status').each(function (e) {
                    $(this).closest('tr').show();
                });
            } else {

                $('#playerTable tr td.player-filter-status').each(function (e) {
                    var rowStatus = $(this).data('seasonval');

                    if (rowStatus === selectedStatus) {
                    } else {
                        $(this).closest('tr').hide();
                    }
                });
            }
        });

        //Filter Player Table By Offseason Status Once a Dropdown Item Is Selected
        $('#playerOffseasonFilter').change(function () {

            //Filter elements on selected option
            $('#playerTable tr td.player-filter-offseason').each(function (e) {
                $(this).closest('tr').show();
            });
            var selectedStatus = $(this).val();

            if (selectedStatus === '0') {
                $('#playerTable tr td.player-filter-offseason').each(function (e) {
                    $(this).closest('tr').show();
                });
            } else {

                $('#playerTable tr td.player-filter-offseason').each(function (e) {
                    var rowStatus = $(this).data('offseasonval');

                    if (rowStatus === selectedStatus) {
                    } else {
                        $(this).closest('tr').hide();
                    }
                });
            }
        });

        //Filter Player Table By Class Once a Dropdown Item Is Selected
        $('#playerClassFilter').change(function () {

            //Filter elements on selected option
            $('#playerTable tr td.player-filter-class').each(function (e) {
                $(this).closest('tr').show();
            });
            var selectedClass = $(this).val();

            if (selectedClass === '0') {
                $('#playerTable tr td.player-filter-class').each(function (e) {
                    $(this).closest('tr').show();
                });
            } else {

                $('#playerTable tr td.player-filter-class').each(function (e) {
                    var rowClass = $(this).data('classval');

                    if (rowClass === selectedClass) {
                    } else {
                        $(this).closest('tr').hide();
                    }
                });
            }
        });

        //Filter Player Table By Status Once a Dropdown Item Is Selected
        $('#playerStatusFilter').change(function () {

            //Filter elements on selected option
            $('#playerTable tr td.player-filter-status').each(function (e) {
                $(this).closest('tr').show();
            });
            var selectedClass = $(this).val();

            if (selectedClass === '0') {
                $('#playerTable tr td.player-filter-status').each(function (e) {
                    $(this).closest('tr').show();
                });
            } else {

                $('#playerTable tr td.player-filter-status').each(function (e) {
                    var rowClass = $(this).data('classval');

                    if (rowClass === selectedClass) {
                    } else {
                        $(this).closest('tr').hide();
                    }
                });
            }
        });

    });
    //When group players by position checkbox is checked or unchecked group or ungroup visable compare players
    $('#playerComparePosGroup').change(function () {

        var group = '';

        if (this.checked) {
            group = 'Yes';
        } else {
            group = 'No';
        }

        $.ajax(
                {
                    url: "libs/ajax/update_player_compare_pos_group.php",
                    type: "POST",
                    data: {group: group},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });

    });
    /* Interaction Functions */
    //Update the season that is viewed
    $(".playerSeason").click(function () {

        var season = this.id;

        $.ajax(
                {
                    url: "libs/ajax/update_player_season.php",
                    type: "POST",
                    data: {season: season},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
    });
    //Update the player view to table
    $("#player_table_btn").click(function () {
        $.ajax(
                {
                    url: "libs/ajax/update_player_view.php",
                    type: "POST",
                    data: {new_view: "Table"},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
    });
    //Update the player view to depth
    $("#player_depth_btn").click(function () {
        $.ajax(
                {
                    url: "libs/ajax/update_player_view.php",
                    type: "POST",
                    data: {new_view: "Depth"},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
    });
    //Update the player view to compare
    $("#player_compare_btn").click(function () {
        $.ajax(
                {
                    url: "libs/ajax/update_player_view.php",
                    type: "POST",
                    data: {new_view: "Compare"},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
    });
    //When a depth chart player is hovered on, show the position detail popover
    $(".showDepthCard").on({
        mouseenter: function () {

            var id = this.id
            var popID = id.slice(0, -1);

            $("#" + this.id).popover({
                html: true,
                content: function () {
                    return  $("#depthPopover" + popID).html();
                }
            });
            $("#" + this.id).popover('show');
        },
        mouseleave: function () {
            $("#" + this.id).popover('hide');
        }
    });
    //Set the years to compare players between
    $("#changeCompareYearsForm").submit(function () {

        var startYear = $("input[name=playerCompareStart]").val();
        var endYear = $("input[name=playerCompareEnd]").val();

        $.ajax(
                {
                    url: "libs/ajax/update_player_compare_years.php",
                    type: "POST",
                    data: {start: startYear, end: endYear},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
    });
    //When the add year to left side of comparison is clicked set the start year back one year
    $("#nextCompareYearLeft").click(function () {

        var start = $(this).data('year');

        $.ajax(
                {
                    url: "libs/ajax/update_player_compare_start.php",
                    type: "POST",
                    data: {start: start},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
    });
    //When the add year to right side of comparison is clicked set the end year one in the future
    $("#nextCompareYearRight").click(function () {

        var end = $(this).data('year');

        $.ajax(
                {
                    url: "libs/ajax/update_player_compare_end.php",
                    type: "POST",
                    data: {end: end},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
    });
</script>
<!-- Create Player Detail Popovers for each position and hide them  -->
<div id="depthPopoverQB" style="display: none">
    <?php return_depth_table($season_ID, "QB") ?>
</div>
<div id="depthPopoverRB" style="display: none">
    <?php return_depth_table($season_ID, "RB") ?>
</div>
<div id="depthPopoverH-B" style="display: none">
    <?php return_depth_table($season_ID, "HB") ?>
</div>
<div id="depthPopoverFB" style="display: none">
    <?php return_depth_table($season_ID, "FB") ?>
</div>
<div id="depthPopoverC" style="display: none">
    <?php return_depth_table($season_ID, "C") ?>
</div>
<div id="depthPopoverRT" style="display: none">
    <?php return_depth_table($season_ID, "RT") ?>
</div>
<div id="depthPopoverRG" style="display: none">
    <?php return_depth_table($season_ID, "RG") ?>
</div>
<div id="depthPopoverLG" style="display: none">
    <?php return_depth_table($season_ID, "LG") ?>
</div>
<div id="depthPopoverLT" style="display: none">
    <?php return_depth_table($season_ID, "LT") ?>
</div>
<div id="depthPopoverTE" style="display: none">
    <?php return_depth_table($season_ID, "TE") ?>
</div>
<div id="depthPopoverWR" style="display: none">
    <?php return_depth_table($season_ID, "WR") ?>
</div>
<div id="depthPopoverDE" style="display: none">
    <?php return_depth_table($season_ID, "DE") ?>
</div>
<div id="depthPopoverDT" style="display: none">
    <?php return_depth_table($season_ID, "DT") ?>
</div>
</div>
<div id="depthPopoverCB" style="display: none">
    <?php return_depth_table($season_ID, "CB") ?>
</div>
<div id="depthPopoverMLB" style="display: none">
    <?php return_depth_table($season_ID, "MLB") ?>
</div>
<div id="depthPopoverOLB" style="display: none">
    <?php return_depth_table($season_ID, "OLB") ?>
</div>
<div id="depthPopoverS" style="display: none">
    <?php return_depth_table($season_ID, "S") ?>
</div>
<div id="depthPopoverK" style="display: none">
    <?php return_depth_table($season_ID, "K") ?>
</div>
<div id="depthPopoverP" style="display: none">
    <?php return_depth_table($season_ID, "P") ?>
</div>
<div id="depthPopoverOL" style="display: none">
    <?php return_depth_table_starter($season_ID, "OL") ?>
</div>
<div id="depthPopoverDL" style="display: none">
    <?php return_depth_table_starter($season_ID, "DL") ?>
</div>
<div id="depthPopoverLB" style="display: none">
    <?php return_depth_table_starter($season_ID, "LB") ?>
</div>
<div id="depthPopoverDB" style="display: none">
    <?php return_depth_table_starter($season_ID, "DB") ?>
</div>
<?php
//Build table for depth chart button popover displaying positional depth chart (I formation and spread)
function return_depth_table($season, $posGroup) {

    if ($posGroup === 'QB') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND Position='QB' ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }
    if ($posGroup === 'RB') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND Position='RB' ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }
    if ($posGroup === 'HB') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND Position='H-B' ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }
    if ($posGroup === 'FB') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND Position='FB' ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }
    if ($posGroup === 'C' || $posGroup === 'RT' || $posGroup === 'RG' || $posGroup === 'LG' || $posGroup === 'LT') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND (Position='{$posGroup}' OR Position='OL') ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }
    if ($posGroup === 'TE') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND Position='TE' ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }
    if ($posGroup === 'WR') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND Position='WR' ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }
    if ($posGroup === 'DE' || $posGroup === 'DT') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND (Position='{$posGroup}' OR Position='DL') ORDER BY FIELD(Depth,'1','2','3','4','5','6','0')");
    }
    if ($posGroup === 'CB') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND (Position='CB' OR Position='DB') ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }
    if ($posGroup === 'MLB' || $posGroup === 'OLB') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND (Position='{$posGroup}' OR Position='LB') ORDER BY FIELD(Depth,'1','2','3','4','5','6','0')");
    }
    if ($posGroup === 'S') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND (Position='S' OR Position='DB') ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }
    if ($posGroup === 'K') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND Position='K' ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }
    if ($posGroup === 'P') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND Position='P' ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }

    echo '<table class="table table-sm" style="font-size: small">';
    echo '<thead>';
    echo '<th></th><th>Name</th><th>Class</th>';
    echo '</thead>';
    echo '<tbody>';

    while ($fetchPOSdata = $getPOSdata->fetch_assoc()) {

        $depthNum = formatDepthNumber($fetchPOSdata['Depth']);

        echo '<tr>';
        echo '<td>', $fetchPOSdata['Position'], $depthNum, '</td>';
        echo '<td>', $fetchPOSdata['First_Name'], " ", $fetchPOSdata['Last_Name'], '</td>';
        echo '<td>', $fetchPOSdata['Class'], '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
}
//Build table for depth chart button popover displaying positional depth chart (starters)
function return_depth_table_starter($season, $posGroup) {


    if ($posGroup === 'OL') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND Position='OL' ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }
    if ($posGroup === 'DL') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND Position='DL' ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }
    if ($posGroup === 'LB') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND Position='LB' ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }
    if ($posGroup === 'DB') {

        $getPOSdata = db_query("SELECT * FROM `Players` WHERE Season='{$season}' AND Position='DB' ORDER BY FIELD(Depth,'1','2','3','4','5','0')");
    }



    echo '<table class="table table-sm" style="font-size: small">';
    echo '<thead>';
    echo '<th></th><th>Name</th><th>Class</th>';
    echo '</thead>';
    echo '<tbody>';

    while ($fetchPOSdata = $getPOSdata->fetch_assoc()) {

        $depthNum = formatDepthNumber($fetchPOSdata['Depth']);

        echo '<tr>';
        echo '<td>', $fetchPOSdata['Position'];
        if (checkForStarter($posGroup, $depthNum) === true) {
            echo '*';
        }
        echo '</td>';
        echo '<td>', $fetchPOSdata['First_Name'], " ", $fetchPOSdata['Last_Name'], '</td>';
        echo '<td>', $fetchPOSdata['Class'], '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
}
//Format the given depth chart number
function formatDepthNumber($DepthNum) {

    if ($DepthNum === '0') {
        return '';
    } else {
        return $DepthNum;
    }
}
?>