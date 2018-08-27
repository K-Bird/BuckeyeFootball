<?php include ("libs/db/common_db_functions.php"); ?>
<?php include ('parts/common_inputs.php'); ?>
<html>
    <head>
        <title>OSU - Input</title>
        <link rel="stylesheet" type="text/css" href="libs/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="libs/css/nouislider.css">
        <link rel="stylesheet" type="text/css" href="libs/css/bootstrap-datepicker.css">
        <link rel="stylesheet" type="text/css" href="libs/css/bootstrap-select.min.css">
        <link rel="stylesheet" type="text/css" href="libs/css/open-iconic-bootstrap.css">
        <script src="libs/js/jquery.js"></script>
        <script src="libs/js/bootstrap.js"></script>
        <script src="libs/js/nouislider.js"></script>
        <script src="libs/js/bootstrap-datepicker.js"></script>
        <script src="libs/js/bootstrap-select.min.js"></script>
        <script src="libs/js/wNumb.js"></script>
    </head>
    <body>
        <?php include ('nav/navBar.php'); ?>
        <div class="container-fluid" style="text-align: center">
            <br><br>
            <div class="row">
                <?php
                $get_InputView = db_query("SELECT * FROM `Controls` WHERE Control='Input_View'");
                $fetch_InputView = $get_InputView->fetch_assoc();
                $Input_View = $fetch_InputView['Value'];

                $get_InputSeason = db_query("SELECT * FROM `Controls` WHERE Control='Input_Season'");
                $fetch_InputSeason = $get_InputSeason->fetch_assoc();
                $Input_Season = $fetch_InputSeason['Value'];

                $Season_ID = getSeason_ID($Input_Season);

                $getSeasonData = db_query("SELECT * FROM `seasons` Where Season_ID='{$Season_ID}'");
                $fetchSeasonData = $getSeasonData->fetch_assoc();



                include ('parts/input/input_controls.php');
                ?>
            </div>
            <div class="row">
                <!-- Check Stat Input View Control -->          
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
                ?>
            </div>
        </div>
    </body>
</html>
<?php include ('parts/input/input_modal_addSeason.php'); ?>
<script>
    /* Interaction Functions */
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
    var timer = null;
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
    $('.postAP').keydown(function (e) {
        clearTimeout(timer);
        timer = setTimeout(function () {

            var gameID = $(e.target).attr('id');
            var newRK = $(e.target).val();
            $.ajax(
                    {
                        url: "libs/ajax/update_game_postAP.php",
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
    $(".removeWeek").click(function () {

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

    $('#addStatModal').on('show.bs.modal', function (event) {

        var addWeek = $(event.relatedTarget).data('week');
        var addfname = $(event.relatedTarget).data('fname');
        var addlname = $(event.relatedTarget).data('lname');
        var addseason = $(event.relatedTarget).data('season');
        var game_ID = $(event.relatedTarget).data('gameid');
        $("#Stat_GM_ID").val(game_ID);
        $('#AddStatTitle').append('Add Stat for ' + addfname + " " + addlname + " - " + addseason + ' - Week ' + addWeek);
        $('.statLabel').hide();
        $('.statInput').hide();
    });

    $('#addStatModal').on('hidden.bs.modal', function (event) {

        $('#AddStatTitle').empty();
    });

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

    $(".existingStat").hover(function () {
        $(this).addClass('existingStatHover');
        $(this).removeClass('existingStatHover');
    });

    //On Edit Stat Modal Show: Get data from clicked edit icon and update the control table
    $('#editStatModal').on('show.bs.modal', function (event) {

        var player_ID = $(event.relatedTarget).data('player');
        var game_ID = $(event.relatedTarget).data('game');
        var week = $(event.relatedTarget).data('week');
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
                        $('#EditStatTitle').prepend('Edit ' + category + ' for ' + fname + " " + lname + " " + season + " - Week " + week);
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
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
        e.preventDefault();

    });

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
                        data: {newValue : newValue, ID : ID, table : table, datacol : datacol, idcol : idcol},
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