<?php include ("libs/db/common_db_functions.php"); ?>
<?php include ('parts/common_inputs.php'); ?>
<html>
    <head>
        <title>Buckeyes - Input</title>
        <link rel="shortcut icon" href="http://www.iconj.com/ico/y/f/yfuwmmd6a8.ico" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="libs/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="libs/css/nouislider.css">
        <link rel="stylesheet" type="text/css" href="libs/css/bootstrap-datepicker.css">
        <link rel="stylesheet" type="text/css" href="libs/css/bootstrap-select.min.css">
        <link rel="stylesheet" type="text/css" href="libs/css/grid-gallery.css">
        <link rel="stylesheet" type="text/css" href="libs/css/lightbox.css">
        <link rel="stylesheet" type="text/css" href="libs/css/open-iconic-bootstrap.css">
        <link rel="stylesheet" type="text/css" href="libs/css/common.css">
        <script src="libs/js/jquery.js"></script>
        <script src="libs/js/bootstrap.js"></script>
        <script src="libs/js/nouislider.js"></script>
        <script src="libs/js/bootstrap-datepicker.js"></script>
        <script src="libs/js/bootstrap-select.min.js"></script>
        <script src="libs/js/grid-gallery.js"></script>
        <script src="libs/js/lightbox.js"></script>
        <script src="libs/js/wNumb.js"></script>
    </head>
    <body>
        <!-- include main navigation bar at top of page -->
        <?php include ('nav/navBar.php'); ?>
        <div class="container-fluid" style="text-align: center">
            <br><br>
            <div class="row">
                <?php
                //Get the current input view
                $get_InputView = db_query("SELECT * FROM `Controls` WHERE Control='Input_View'");
                $fetch_InputView = $get_InputView->fetch_assoc();
                $Input_View = $fetch_InputView['Value'];

                //get the current input season
                $get_InputSeason = db_query("SELECT * FROM `Controls` WHERE Control='Input_Season'");
                $fetch_InputSeason = $get_InputSeason->fetch_assoc();
                $Input_Season = $fetch_InputSeason['Value'];

                //Get the season ID of the input season
                $Season_ID = getSeason_ID($Input_Season);

                //Get all data for the input season using the season ID
                $getSeasonData = db_query("SELECT * FROM `seasons` Where Season_ID='{$Season_ID}'");
                $fetchSeasonData = $getSeasonData->fetch_assoc();

                //add the input controls to the page
                include ('parts/input/input_controls.php');
                ?>
            </div>
            <div class="row">
                <!-- check stat input view control and display the appropriate view -->          
                <?php
                if ($Input_View === 'Seasons') {
                    include ('parts/input/input_seasons.php');
                }
                if ($Input_View === 'Players') {
                    include ('parts/input/input_players.php');
                }
                if ($Input_View === 'Stats') {
                    include ('parts/input/input_stats.php');
                }
                if ($Input_View === 'Lists') {
                    include ('parts/input/input_lists.php');
                }
                if ($Input_View === 'Media') {
                    include ('parts/input/input_media.php');
                }
                ?>
            </div>
        </div>
    </body>
</html>
<!-- include the modal that allows for adding a season -->
<?php include ('parts/input/input_modal_addSeason.php'); ?>
<script>
    /* Interaction Functions */
    //When input view seasons button is clicked update the database to the new view
    $("#input_seasons_btn").click(function () {
        $.ajax(
                {
                    url: "libs/ajax/update_input_view.php",
                    type: "POST",
                    data: {new_view: "Seasons"},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();
    });
    //When input view players button is clicked update the database to the new view
    $("#input_players_btn").click(function () {
        $.ajax(
                {
                    url: "libs/ajax/update_input_view.php",
                    type: "POST",
                    data: {new_view: "Players"},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();
    });
    //When input view stats button is clicked update the database to the new view
    $("#input_stats_btn").click(function () {
        $.ajax(
                {
                    url: "libs/ajax/update_input_view.php",
                    type: "POST",
                    data: {new_view: "Stats"},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();
    });
    //When input view lists button is clicked update the database to the new view
    $("#input_lists_btn").click(function () {
        $.ajax(
                {
                    url: "libs/ajax/update_input_view.php",
                    type: "POST",
                    data: {new_view: "Lists"},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();
    });
    //When input view lists button is clicked update the database to the new view
    $("#input_media_btn").click(function () {
        $.ajax(
                {
                    url: "libs/ajax/update_input_view.php",
                    type: "POST",
                    data: {new_view: "Media"},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();
    });
    //When a new season is clicked update the database to the new season
    $(".inputSeason").click(function () {

        var season = this.id;
        $.ajax(
                {
                    url: "libs/ajax/update_input_season.php",
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
        e.preventDefault();
    });
    //When a new date is selected for a game update the database
    $('.weekDate').change(function (e) {

        var gameID = this.id;
        var newDate = $(this).val();
        $.ajax(
                {
                    url: "libs/ajax/update_game_date.php",
                    type: "POST",
                    data: {gmID: gameID, newDate: newDate},
                    success: function (data, textStatus, jqXHR)
                    {
                        $(this).html(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();
    });
    //When home or away is selected for a game update the database
    $('.gameHA').change(function () {

        var gameID = this.id;
        var newHA = $(this).val();
        $.ajax(
                {
                    url: "libs/ajax/update_game_HA.php",
                    type: "POST",
                    data: {gmID: gameID, newHA: newHA},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();
    });
    //When a new location is selected for a game update the database
    $('.gameLoc').change(function () {

        var gameID = this.id;
        var newLoc = $(this).val();
        $.ajax(
                {
                    url: "libs/ajax/update_game_Loc.php",
                    type: "POST",
                    data: {gmID: gameID, newLoc: newLoc},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();
    });
    //When a new opponent is selected for a game update the database
    $('.gameOpp').change(function () {

        var gameID = this.id;
        var newOpp = $(this).val();
        $.ajax(
                {
                    url: "libs/ajax/update_game_Opp.php",
                    type: "POST",
                    data: {gmID: gameID, newOpp: newOpp},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();
    });
    //When a new game type is selected for a game update the database
    $('.gameType').change(function () {

        var gameID = this.id;
        var newType = $(this).val();
        $.ajax(
                {
                    url: "libs/ajax/update_game_Type.php",
                    type: "POST",
                    data: {gmID: gameID, newType: newType},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();
    });

    //create a timer to track time for keboard related events
    var timer = null;

    //When OSU score is entered for a game update the database
    $('.OSUScore').keydown(function (e) {
        clearTimeout(timer);
        timer = setTimeout(function () {

            var gameID = $(e.target).attr('id');
            var newScore = $(e.target).val();
            $.ajax(
                    {
                        url: "libs/ajax/update_game_OSUScore.php",
                        type: "POST",
                        data: {gmID: gameID, newScore: newScore},
                        success: function (data, textStatus, jqXHR)
                        {
                            location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Form Did Not Process: " + errorThrown);
                        }
                    });
            e.preventDefault();
        }, 1000);
    });
    //When Opponent score is entered for a game update the database
    $('.OppScore').keydown(function (e) {
        clearTimeout(timer);
        timer = setTimeout(function () {

            var gameID = $(e.target).attr('id');
            var newScore = $(e.target).val();
            $.ajax(
                    {
                        url: "libs/ajax/update_game_OppScore.php",
                        type: "POST",
                        data: {gmID: gameID, newScore: newScore},
                        success: function (data, textStatus, jqXHR)
                        {
                            location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Form Did Not Process: " + errorThrown);
                        }
                    });
            e.preventDefault();
        }, 1000);
    });
    //When OSU AP rank is entered for a game update the database
    $('.osuAP').keydown(function (e) {
        clearTimeout(timer);
        timer = setTimeout(function () {

            var gameID = $(e.target).attr('id');
            var newOSUAP = $(e.target).val();
            $.ajax(
                    {
                        url: "libs/ajax/update_game_osuAP.php",
                        type: "POST",
                        data: {gmID: gameID, newOSUAP: newOSUAP},
                        success: function (data, textStatus, jqXHR)
                        {
                            location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Form Did Not Process: " + errorThrown);
                        }
                    });
            e.preventDefault();
        }, 1000);
    });
    //When OSU CFP rank is entered for a game update the database
    $('.osuCFP').keydown(function (e) {
        clearTimeout(timer);
        timer = setTimeout(function () {

            var gameID = $(e.target).attr('id');
            var newOSUCFP = $(e.target).val();
            $.ajax(
                    {
                        url: "libs/ajax/update_game_osuCFP.php",
                        type: "POST",
                        data: {gmID: gameID, newOSUCFP: newOSUCFP},
                        success: function (data, textStatus, jqXHR)
                        {
                            location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Form Did Not Process: " + errorThrown);
                        }
                    });
            e.preventDefault();
        }, 1000);
    });
    //When opponent AP rank is entered for a game update the database
    $('.oppAP').keydown(function (e) {
        clearTimeout(timer);
        timer = setTimeout(function () {

            var gameID = $(e.target).attr('id');
            var newOppAP = $(e.target).val();
            $.ajax(
                    {
                        url: "libs/ajax/update_game_OppAP.php",
                        type: "POST",
                        data: {gmID: gameID, newOppAP: newOppAP},
                        success: function (data, textStatus, jqXHR)
                        {
                            location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Form Did Not Process: " + errorThrown);
                        }
                    });
            e.preventDefault();
        }, 1000);
    });
    //When opponent CPF rank is entered for a game update the database
    $('.oppCFP').keydown(function (e) {
        clearTimeout(timer);
        timer = setTimeout(function () {

            var gameID = $(e.target).attr('id');
            var newOppCFP = $(e.target).val();
            $.ajax(
                    {
                        url: "libs/ajax/update_game_OppCFP.php",
                        type: "POST",
                        data: {gmID: gameID, newOppCFP: newOppCFP},
                        success: function (data, textStatus, jqXHR)
                        {
                            location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Form Did Not Process: " + errorThrown);
                        }
                    });
            e.preventDefault();
        }, 1000);
    });
    //When conference game status is selected for a game update the database
    $('.confGM').change(function () {

        var change = '';
        var gameID = $(this).attr('id');
        if (this.checked) {
            change = 'Y';
        } else {
            change = 'N';
        }

        $.ajax(
                {
                    url: "libs/ajax/update_game_Conf.php",
                    type: "POST",
                    data: {gmID: gameID, confChg: change},
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
    //When divisional game status is selected for a game update the database
    $('.divGM').change(function () {

        var change = '';
        var gameID = $(this).attr('id');
        if (this.checked) {
            change = 'Y';
        } else {
            change = 'N';
        }

        $.ajax(
                {
                    url: "libs/ajax/update_game_Div.php",
                    type: "POST",
                    data: {gmID: gameID, divChg: change},
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
    //When OSU post game CFP rank is entered for a game update the database
    $('.postCFP').keydown(function (e) {
        clearTimeout(timer);
        timer = setTimeout(function () {

            var gameID = $(e.target).attr('id');
            var newRK = $(e.target).val();
            $.ajax(
                    {
                        url: "libs/ajax/update_game_postCFP.php",
                        type: "POST",
                        data: {gmID: gameID, newRK: newRK},
                        success: function (data, textStatus, jqXHR)
                        {
                            location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Form Did Not Process: " + errorThrown);
                        }
                    });
            e.preventDefault();
        }, 1000);
    });
    //When the button to add a new week is clicked add the game row to the database
    $("#addWeek").click(function () {

        var season = $(this).attr("data-season");
        $.ajax(
                {
                    url: "libs/ajax/add_game_week.php",
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
        e.preventDefault();
    });
    //When the button to remove a week is clicked remove the game row from the database
    $("#removeWeek").click(function () {

        var gmID = $(this).attr("data-game");
        $.ajax(
                {
                    url: "libs/ajax/remove_game_week.php",
                    type: "POST",
                    data: {gmID: gmID},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();
    });
    //When setting the displayed seasons details: when a new decade is selected update the database
    $('#DecadeSelect').change(function () {

        var seasonID = $(this).attr('data-season');
        var newDecade = $(this).val();
        $.ajax(
                {
                    url: "libs/ajax/update_season_Decade.php",
                    type: "POST",
                    data: {seasonID: seasonID, newDecade: newDecade},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();
    });
    //When setting the displayed seasons details: when a new conference is selected update the database
    $('#ConfSelect').change(function () {

        var seasonID = $(this).attr('data-season');
        var newConf = $(this).val();
        $.ajax(
                {
                    url: "libs/ajax/update_season_Conf.php",
                    type: "POST",
                    data: {seasonID: seasonID, newConf: newConf},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();
    });
    //When setting the displayed seasons details: when a new division is selected update the database
    $('#DivSelect').change(function () {

        var seasonID = $(this).attr('data-season');
        var newDiv = $(this).val();
        $.ajax(
                {
                    url: "libs/ajax/update_season_Div.php",
                    type: "POST",
                    data: {seasonID: seasonID, newDiv: newDiv},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();
    });
    //When setting the displayed seasons details: when conference champions is changed update the database
    $('#ConfChampSelect').change(function () {

        var seasonID = $(this).attr('data-season');
        var newChamp = $(this).val();
        $.ajax(
                {
                    url: "libs/ajax/update_season_ConfChamp.php",
                    type: "POST",
                    data: {seasonID: seasonID, newChamp: newChamp},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();
    });
    //When setting the displayed seasons details: when national champions is changed update the database
    $('#NatChampSelect').change(function () {

        var seasonID = $(this).attr('data-season');
        var newChamp = $(this).val();
        $.ajax(
                {
                    url: "libs/ajax/update_season_NatChamp.php",
                    type: "POST",
                    data: {seasonID: seasonID, newChamp: newChamp},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();
    });
    //When setting the displayed seasons details: when final AP rank is changed update the database
    $('#finalAP').keydown(function (e) {
        clearTimeout(timer);
        timer = setTimeout(function () {

            var seasonID = $(e.target).attr('data-season');
            var newRK = $(e.target).val();
            $.ajax(
                    {
                        url: "libs/ajax/update_season_finalAP.php",
                        type: "POST",
                        data: {seasonID: seasonID, newRK: newRK},
                        success: function (data, textStatus, jqXHR)
                        {
                            location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Form Did Not Process: " + errorThrown);
                        }
                    });
            e.preventDefault();
        }, 1000);
    });
    //When setting the displayed seasons details: when final CFP rank is changed update the database
    $('#finalCFP').keydown(function (e) {
        clearTimeout(timer);
        timer = setTimeout(function () {

            var seasonID = $(e.target).attr('data-season');
            var newRK = $(e.target).val();
            $.ajax(
                    {
                        url: "libs/ajax/update_season_finalCFP.php",
                        type: "POST",
                        data: {seasonID: seasonID, newRK: newRK},
                        success: function (data, textStatus, jqXHR)
                        {
                            location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Form Did Not Process: " + errorThrown);
                        }
                    });
            e.preventDefault();
        }, 1000);
    });
    //When setting the displayed seasons details: when head coach is changed update the database
    $('#HCSelect').change(function () {

        var seasonID = $(this).attr('data-season');
        var newHC = $(this).val();
        $.ajax(
                {
                    url: "libs/ajax/update_season_HC.php",
                    type: "POST",
                    data: {seasonID: seasonID, newHC: newHC},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();
    });
    //When setting the displayed seasons details: when the type of depth chart is changed update the database
    $('#DepthSelect').change(function () {

        var seasonID = $(this).attr('data-season');
        var newDepth = $(this).val();
        $.ajax(
                {
                    url: "libs/ajax/update_season_Depth.php",
                    type: "POST",
                    data: {seasonID: seasonID, newDepth: newDepth},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();
    });
    //When entering player input details: when player first name is changed update the database
    $('.playerFirstName').keydown(function (e) {
        clearTimeout(timer);
        timer = setTimeout(function () {

            var player_master_ID = $(e.target).attr('id');
            var newName = $(e.target).val();
            $.ajax(
                    {
                        url: "libs/ajax/update_player_firstName.php",
                        type: "POST",
                        data: {master_ID: player_master_ID, newFName: newName},
                        success: function (data, textStatus, jqXHR)
                        {
                            location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Form Did Not Process: " + errorThrown);
                        }
                    });
            e.preventDefault();
        }, 1000);
    });
    //When entering player input details: when player last name is changed update the database
    $('.playerLastName').keydown(function (e) {
        clearTimeout(timer);
        timer = setTimeout(function () {

            var player_master_ID = $(e.target).attr('id');
            var newName = $(e.target).val();
            $.ajax(
                    {
                        url: "libs/ajax/update_player_lastName.php",
                        type: "POST",
                        data: {master_ID: player_master_ID, newLName: newName},
                        success: function (data, textStatus, jqXHR)
                        {
                            location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Form Did Not Process: " + errorThrown);
                        }
                    });
            e.preventDefault();
        }, 1000);
    });
    //When entering player input details: when player number is changed update the database
    $('.playerNum').keydown(function (e) {
        clearTimeout(timer);
        timer = setTimeout(function () {

            var player_row = $(e.target).attr('id');
            var newNum = $(e.target).val();
            $.ajax(
                    {
                        url: "libs/ajax/update_player_Num.php",
                        type: "POST",
                        data: {row: player_row, newNum: newNum},
                        success: function (data, textStatus, jqXHR)
                        {
                            location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Form Did Not Process: " + errorThrown);
                        }
                    });
            e.preventDefault();
        }, 1000);
    });
    //When entering player input details: when player depth chart position is changed update the database
    $('.playerDepth').keydown(function (e) {
        clearTimeout(timer);
        timer = setTimeout(function () {

            var player_row = $(e.target).attr('id');
            var PorS = $(e.target).attr('data-pors');
            var newDepth = $(e.target).val();
            $.ajax(
                    {
                        url: "libs/ajax/update_player_Depth.php",
                        type: "POST",
                        data: {row: player_row, newDepth: newDepth, PorS: PorS},
                        success: function (data, textStatus, jqXHR)
                        {
                            location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Form Did Not Process: " + errorThrown);
                        }
                    });
            e.preventDefault();
        }, 1000);
    });
    //When entering player input details: when player height is changed update the database
    $('.playerHt').keydown(function (e) {
        clearTimeout(timer);
        timer = setTimeout(function () {

            var player_row = $(e.target).attr('id');
            var newHt = $(e.target).val();
            $.ajax(
                    {
                        url: "libs/ajax/update_player_Ht.php",
                        type: "POST",
                        data: {row: player_row, newHt: newHt},
                        success: function (data, textStatus, jqXHR)
                        {
                            location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Form Did Not Process: " + errorThrown);
                        }
                    });
            e.preventDefault();
        }, 1000);
    });
    //When entering player input details: when player weight is changed update the database
    $('.playerWt').keydown(function (e) {
        clearTimeout(timer);
        timer = setTimeout(function () {

            var player_row = $(e.target).attr('id');
            var newWt = $(e.target).val();
            $.ajax(
                    {
                        url: "libs/ajax/update_player_Wt.php",
                        type: "POST",
                        data: {row: player_row, newWt: newWt},
                        success: function (data, textStatus, jqXHR)
                        {
                            location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Form Did Not Process: " + errorThrown);
                        }
                    });
            e.preventDefault();
        }, 1000);
    });
    //When entering player input details: when player class is changed update the database
    $('.playerClass').change(function () {

        var player_row = this.id;
        var newClass = $(this).val();
        $.ajax(
                {
                    url: "libs/ajax/update_player_Class.php",
                    type: "POST",
                    data: {row: player_row, newClass: newClass},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();
    });
    //When entering player input details: when player hometown is changed update the database
    $('.playerHometown').keydown(function (e) {
        clearTimeout(timer);
        timer = setTimeout(function () {

            var player_master_ID = $(e.target).attr('id');
            var newHometown = $(e.target).val();
            $.ajax(
                    {
                        url: "libs/ajax/update_player_Hometown.php",
                        type: "POST",
                        data: {master_ID: player_master_ID, newHometown: newHometown},
                        success: function (data, textStatus, jqXHR)
                        {
                            location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Form Did Not Process: " + errorThrown);
                        }
                    });
            e.preventDefault();
        }, 1000);
    });
    //When entering player input details: when the remove player button is clicked remove the player row from the database
    $(".removePlayer").click(function () {

        var playerRow = $(this).attr('data-playerRow');
        var PorS = $(this).attr('data-PorS');
        $.ajax(
                {
                    url: "libs/ajax/remove_player_row.php",
                    type: "POST",
                    data: {playerRow: playerRow, PorS: PorS},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();
    });
    //When entering player input details: when add player button for in focus position is clicked add the player row to the database
    $(".addPlayer").click(function () {

        var season = $(this).attr('data-season');
        var pos = $(this).attr('data-pos');
        $.ajax(
                {
                    url: "libs/ajax/add_player_row.php",
                    type: "POST",
                    data: {season: season, pos: pos},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();
    });
    //When entering player input details: when player position group is changed update the database
    $(".chgPosGroup").click(function () {

        var posGroup = this.id;
        $.ajax(
                {
                    url: "libs/ajax/update_player_posGroup.php",
                    type: "POST",
                    data: {posGroup: posGroup},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();
    });
    //When entering player input details: when player secondary position group is changed update the database
    $("#addSecondaryPosition").submit(function (e) {

        e.preventDefault();
        var playerRow = $("#existingPlayeraddSecondary").val();
        var pos = $("#secondaryPos").val();
        var pos_2 = $("#secondaryPosSelect").val();
        $.ajax(
                {
                    url: "libs/ajax/add_player_secondary_pos.php",
                    type: "POST",
                    data: {row: playerRow, pos: pos, pos_2: pos_2},
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
    //When the add season button on the add seson modal is clicked add the season to the database
    $("#addSeasonBtn").click(function (e) {

        var season = $("#addSeasonSelect").val();
        $.ajax(
                {
                    url: "libs/ajax/add_season.php",
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
    //When entering player input details: when player primary position is changed update the database
    $('.playerPOSPrimary').change(function () {

        var player_row = this.id;
        var newPOS = $(this).val();
        $.ajax(
                {
                    url: "libs/ajax/update_player_primaryPOS.php",
                    type: "POST",
                    data: {row: player_row, newPOS: newPOS},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();
    });
    //When entering player input details: when player secondary position is changed update the database
    $('.playerPOSSecondary').change(function () {

        var player_row = this.id;
        var newPOS = $(this).val();
        $.ajax(
                {
                    url: "libs/ajax/update_player_secondaryPOS.php",
                    type: "POST",
                    data: {row: player_row, newPOS: newPOS},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();
    });
    //When entering player stats: when add a new player is selected for current year update the database control
    $('#existingPlayeraddStats').change(function () {

        var player_row = $(this).val();
        $.ajax(
                {
                    url: "libs/ajax/update_player_addstat.php",
                    type: "POST",
                    data: {row: player_row},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();
    });
    //When the add stat modal is shown populate the title and check for existing statas
    $('#addStatModal').on('show.bs.modal', function (event) {

        //grab data attributes from add stat button
        var addWeek = $(event.relatedTarget).data('week');
        var addfname = $(event.relatedTarget).data('fname');
        var opp = $(event.relatedTarget).data('opp');
        var masterID = $(event.relatedTarget).data('playerid');
        var addlname = $(event.relatedTarget).data('lname');
        var addseason = $(event.relatedTarget).data('season');
        var game_ID = $(event.relatedTarget).data('gameid');

        //update hidden form value to the game stats are being added for
        $("#Stat_GM_ID").val(game_ID);
        //update modal title
        $('#AddStatTitle').append('Add Stat for ' + addfname + " " + addlname + " - " + addseason + ' - Week ' + addWeek + ' Vs ' + opp);
        //hide all stat labels so the chosen stat cateogry's labels will be shown
        $('.statLabel').hide();
        $('.statInput').hide();

        //If a stat already exists in a stat category for the given player and game then disable the ability to select that stat category
        if ($('#passing' + game_ID + masterID).length) {
            $('#statOptionPassing').prop("disabled", true);
        }
        if ($('#rushing' + game_ID + masterID).length) {
            $('#statOptionRushing').prop("disabled", true);
        }
        if ($('#rec' + game_ID + masterID).length) {
            $('#statOptionRec').prop("disabled", true);
        }
        if ($('#def' + game_ID + masterID).length) {
            $('#statOptionDef').prop("disabled", true);
        }
        if ($('#ret' + game_ID + masterID).length) {
            $('#statOptionRet').prop("disabled", true);
        }
        if ($('#kicking' + game_ID + masterID).length) {
            $('#statOptionKicking').prop("disabled", true);
        }
        if ($('#punting' + game_ID + masterID).length) {
            $('#statOptionPunting').prop("disabled", true);
        }
    });

    //When add stat modal is closed clear the title and reset the disabled stat categories
    $('#addStatModal').on('hidden.bs.modal', function (event) {

        $('#AddStatTitle').empty();
        $('#statOptionPassing').prop("disabled", false);
        $('#statOptionRushing').prop("disabled", false);
        $('#statOptionRec').prop("disabled", false);
        $('#statOptionDef').prop("disabled", false);
        $('#statOptionRet').prop("disabled", false);
        $('#statOptionKicking').prop("disabled", false);
        $('#statOptionPunting').prop("disabled", false);
    });

    //When a stat category on the add stat model is selected show the appropriate labels and inputs
    $('#statCategory').change(function () {

        var newCategory = $(this).val();
        if (newCategory === 'pass') {
            $('.statLabel').hide();
            $('.statInput').hide();
            $('.passLabel').show();
            $('.passInput').show();
        }
        if (newCategory === 'rush') {
            $('.statLabel').hide();
            $('.statInput').hide();
            $('.rushLabel').show();
            $('.rushInput').show();
        }
        if (newCategory === 'rec') {
            $('.statLabel').hide();
            $('.statInput').hide();
            $('.recLabel').show();
            $('.recInput').show();
        }
        if (newCategory === 'def') {
            $('.statLabel').hide();
            $('.statInput').hide();
            $('.defLabel').show();
            $('.defInput').show();
            $('.defInput').val("0");
        }
        if (newCategory === 'ret') {
            $('.statLabel').hide();
            $('.statInput').hide();
            $('.retLabel').show();
            $('.retInput').show();
        }
        if (newCategory === 'kick') {
            $('.statLabel').hide();
            $('.statInput').hide();
            $('.kickLabel').show();
            $('.kickInput').show();
        }
        if (newCategory === 'punt') {
            $('.statLabel').hide();
            $('.statInput').hide();
            $('.puntLabel').show();
            $('.puntInput').show();
        }
    });

    //When the add stat form is submitted send data to the database to create a new stat row for that player and game
    $("#addStatCategoryForm").submit(function (e) {

        $statFormData = $(this).serialize();
        $.ajax(
                {
                    url: "libs/ajax/add_stat_row.php",
                    type: "POST",
                    data: $statFormData,
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process");
                    }
                });
        e.preventDefault();
    });

    //On Edit Stat Modal Show: Get data from clicked edit icon and update the control table
    $('#editStatModal').on('show.bs.modal', function (event) {

        var player_ID = $(event.relatedTarget).data('player');
        var game_ID = $(event.relatedTarget).data('game');
        var week = $(event.relatedTarget).data('week');
        var opp = $(event.relatedTarget).data('opp');
        var category = $(event.relatedTarget).data('cat');
        var fname = $(event.relatedTarget).data('fname');
        var lname = $(event.relatedTarget).data('lname');
        var season = $(event.relatedTarget).data('season');

        $.ajax(
                {
                    url: "libs/ajax/input_edit_stat_controls.php",
                    type: "POST",
                    data: {playerID: player_ID, gameID: game_ID, category: category},
                    success: function (data, textStatus, jqXHR)
                    {
                        //After control update then load the edit table and Update the Modal Title
                        $('#editStatBody').load('parts/input/input_edit_stat_body.php');
                        $('#EditStatTitle').prepend('Edit ' + category + ' for ' + fname + " " + lname + " " + season + " - Week " + week + " Vs " + opp);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process");
                    }
                });
    });

    //On Edit Stat Model Close, Empty the Title Field
    $('#editStatModal').on('hidden.bs.modal', function (event) {

        $('#EditStatTitle').empty();
    });

    //On the Edit Passing Stats form submit: send new values to db
    $(document).on('submit', 'form.editStatForm', function (e) {

        $editStatFormData = $(this).serialize();
        $.ajax(
                {
                    url: "libs/ajax/update_stat_row.php",
                    type: "POST",
                    data: $editStatFormData,
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process");
                    }
                });
        e.preventDefault();

    });

    //when the remove stat button for a player game combo is selected remove the stat row from the database
    $(".removeStat").click(function () {

        var gameID = $(this).data("game");
        var playerID = $(this).data("player");
        var category = $(this).data("cat");

        $.ajax(
                {
                    url: "libs/ajax/remove_stat_row.php",
                    type: "POST",
                    data: {gameID: gameID, playerID: playerID, category: category},
                    success: function (data, textStatus, jqXHR)
                    {
                        alert(data);
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();

    });
    //On the input lists section: when a new list is selected from the list dropdown update the database control
    $(".listEditDD").click(function () {

        var option = $(this).data('option');

        $.ajax(
                {
                    url: "libs/ajax/update_input_list.php",
                    type: "POST",
                    data: {option: option},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();

    });
    //On the input lists section: when the remove big ten division button is clicked remove the division row from the database
    $(".removeb10Div").click(function (e) {

        var divID = $(e.target).data('id');

        $.ajax(
                {
                    url: "libs/ajax/remove_input_b10div.php",
                    type: "POST",
                    data: {divID},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();

    });
    //On the input lists section: when the add big ten division button is clicked add the division row to the database
    $("#addb10div").click(function (e) {

        var newDiv = $("#addb10divName").val();

        $.ajax(
                {
                    url: "libs/ajax/add_input_b10div.php",
                    type: "POST",
                    data: {newDiv: newDiv},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();

    });
    //On the input lists section: when the add a new location form button is clicked add the new location to the database
    $("#addLocationForm").submit(function (e) {

        e.preventDefault();
        var Stadium = $("input[name=addLocStadium]").val();
        var City = $("input[name=addLocCity]").val();
        var State = $("input[name=addLocState]").val();


        $.ajax(
                {
                    url: "libs/ajax/add_input_location.php",
                    type: "POST",
                    data: {stadium: Stadium, city: City, state: State},
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
    //On the input lists section: when the remove a location button is clicked remove the location from the database
    $(".removeLoc").click(function (e) {

        var locID = $(e.target).data('id');

        $.ajax(
                {
                    url: "libs/ajax/remove_input_location.php",
                    type: "POST",
                    data: {locID: locID},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();

    });
    //On the input lists section: when the add a new opponent form button is clicked add the new opponent to the database
    $("#addOppForm").submit(function (e) {

        e.preventDefault();
        var School = $("input[name=addOppSchool]").val();
        var Nickname = $("input[name=addOppNickname]").val();
        var State = $("input[name=addOppState]").val();


        $.ajax(
                {
                    url: "libs/ajax/add_input_opponent.php",
                    type: "POST",
                    data: {school: School, nickname: Nickname, state: State},
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
    //On the input lists section: when the remove a opponent button is clicked remove the opponent from the database
    $(".removeOpp").click(function (e) {

        var oppID = $(e.target).data('id');

        $.ajax(
                {
                    url: "libs/ajax/remove_input_opponent.php",
                    type: "POST",
                    data: {oppID: oppID},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();

    });
    //When entering game details: when the overtime checkbox is changed update the overtime status of the game in the database
    $('.OTGM').change(function () {

        var change = '';
        var gameID = $(this).attr('id');
        if (this.checked) {
            change = 'Y';
        } else {
            change = 'N';
        }

        $.ajax(
                {
                    url: "libs/ajax/update_game_OT.php",
                    type: "POST",
                    data: {gmID: gameID, confChg: change},
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
    //When entering game details: when the overtime number input is changed update the overtime status of the game in the database
    $('.OTNum').keydown(function (e) {
        clearTimeout(timer);
        timer = setTimeout(function () {

            var gameID = $(e.target).attr('id');
            var newOTNum = $(e.target).val();
            $.ajax(
                    {
                        url: "libs/ajax/update_game_OTNum.php",
                        type: "POST",
                        data: {gmID: gameID, newOTNum: newOTNum},
                        success: function (data, textStatus, jqXHR)
                        {
                            location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Form Did Not Process: " + errorThrown);
                        }
                    });
            e.preventDefault();
        }, 1000);
    });
    //On the input lists section: when the add a new coach form button is clicked add the new coach to the database
    $("#addCoachForm").submit(function (e) {

        e.preventDefault();
        var FName = $("input[name=addCoachFName]").val();
        var LName = $("input[name=addCoachLName]").val();
        var Type = $("#addCoachType option:selected").text();


        $.ajax(
                {
                    url: "libs/ajax/add_input_coach.php",
                    type: "POST",
                    data: {FName: FName, LName: LName, Type: Type},
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
    //On the input lists section: when the remove a coach button is clicked remove the coach from the database
    $(".removeCoach").click(function (e) {

        var coachID = $(e.target).data('id');

        $.ajax(
                {
                    url: "libs/ajax/remove_input_coach.php",
                    type: "POST",
                    data: {coachID: coachID},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();

    });
    //On the input lists section: when the add a new conference form button is clicked add the new conference to the database
    $("#addConfForm").submit(function (e) {

        e.preventDefault();
        var Conf_Name = $("input[name=addConfName]").val();
        var Conf_Abbrev = $("input[name=addConfAbbrev]").val();


        $.ajax(
                {
                    url: "libs/ajax/add_input_conf.php",
                    type: "POST",
                    data: {name: Conf_Name, abbrev: Conf_Abbrev},
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
    //On the input lists section: when the remove a conference button is clicked remove the conference from the database
    $(".removeConf").click(function (e) {

        var confID = $(e.target).data('id');

        $.ajax(
                {
                    url: "libs/ajax/remove_input_conf.php",
                    type: "POST",
                    data: {confID: confID},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();

    });
    //On the input lists section: when the add a new decade form button is clicked add the new decade to the database
    $("#addDecadeForm").submit(function (e) {

        e.preventDefault();
        var Decade_Name = $("input[name=addDecadeName]").val();
        var Decade_Start = $("input[name=addDecadeStart]").val();
        var Decade_End = $("input[name=addDecadeEnd]").val();

        $.ajax(
                {
                    url: "libs/ajax/add_input_decade.php",
                    type: "POST",
                    data: {name: Decade_Name, start: Decade_Start, end: Decade_End},
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
    //On the input lists section: when the remove a decade button is clicked remove the decade from the database
    $(".removeDecade").click(function (e) {

        var ID = $(e.target).data('id');

        $.ajax(
                {
                    url: "libs/ajax/remove_input_decade.php",
                    type: "POST",
                    data: {ID: ID},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();

    });
    //On the input lists section: when the add a new game type form button is clicked add the new game type to the database
    $("#addGameTypeForm").submit(function (e) {

        e.preventDefault();
        var Name = $("input[name=addGameTypeName]").val();
        var Type = $("input[name=addGameType]").val();
        var SubType = $("#addGameSubType option:selected").text();


        $.ajax(
                {
                    url: "libs/ajax/add_input_gameType.php",
                    type: "POST",
                    data: {name: Name, type: Type, subtype: SubType},
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
    //On the input lists section: when the remove a game type button is clicked remove the game type from the database
    $(".removeGMtype").click(function (e) {

        var ID = $(e.target).data('id');

        $.ajax(
                {
                    url: "libs/ajax/remove_input_gametype.php",
                    type: "POST",
                    data: {ID: ID},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();

    });
    //On the input lists section: when any field is updated from any list then update the database
    $('.editListItem').keydown(function (e) {
        clearTimeout(timer);
        timer = setTimeout(function () {


            var newValue = $(e.target).val();
            var ID = $(e.target).data('id');
            var table = $(e.target).data('table');
            var datacol = $(e.target).data('datacol');
            var idcol = $(e.target).data('idcol');

            $.ajax(
                    {
                        url: "libs/ajax/update_input_ListItem.php",
                        type: "POST",
                        data: {newValue: newValue, ID: ID, table: table, datacol: datacol, idcol: idcol},
                        success: function (data, textStatus, jqXHR)
                        {
                            location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Form Did Not Process: " + errorThrown);
                        }
                    });
            e.preventDefault();

        }, 1000);
    });
</script>