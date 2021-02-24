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

                //Get the current recruiting class input view
                $get_ClassView = db_query("SELECT * FROM `Controls` WHERE Control='recruit_input_season'");
                $fetch_ClassView = $get_ClassView->fetch_assoc();
                $Class_View = $fetch_ClassView['Value'];

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
                if ($Input_View === 'Recruits') {
                    include ('parts/input/input_recruits.php');
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
                if ($Input_View === 'Box') {
                    include ('parts/input/input_box_scores.php');
                }
                ?>
            </div>
        </div>
    </body>
</html>
<!-- include the modal that allows for adding a season -->
<?php include ('parts/input/input_modal_addSeason.php'); ?>
<script>

    //Set localstorage values for game tag lock
    if (localStorage.getItem('OSU_Game_Tag_Lock') === null) {
        localStorage.setItem('OSU_Game_Tag_Lock', 'unlocked');
        localStorage.removeItem('OSU_Game_Tag_Lock_Value');
    }
    if (localStorage.getItem('OSU_Game_Tag_Lock') === 'unlocked') {
        $('#GameTagLockStatus').replaceWith('<div id="GameTagLockStatus">Tag Games(s) In Uploaded Photo:</div>');
        localStorage.removeItem('OSU_Game_Tag_Lock_Value');
    }
    if (localStorage.getItem('OSU_Game_Tag_Lock') === 'locked') {
        $('#GameTagLockStatus').replaceWith('<div id="GameTagLockStatus"><span id="gameTagLockIcon" data-status="locked" class="oi oi-lock-locked"></span>&nbsp;&nbsp;Tag Games(s) In Uploaded Photo:</div>');
        var lockedGameTags = localStorage.getItem('OSU_Game_Tag_Lock_Value');
        //update locked game tag(s) value on image upload form
        $('#gamePhotoTag').val(lockedGameTags);
        //display the game tag(s) that are locked
        $.ajax(
                {
                    url: "libs/ajax/return_selected_tag.php",
                    type: "POST",
                    data: {gameID: lockedGameTags, type: 'game'},
                    success: function (data, textStatus, jqXHR)
                    {
                        $('#gameTagSelected').append(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Selected Tag Could Not Be Loaded: " + errorThrown);
                    }
                });
    }

    //Set localstorage for box score editing
    if (localStorage.getItem('OSU_Input_Box_View') === null) {
        localStorage.setItem('OSU_Input_Box_View', 'controls');
    }
    if (localStorage.getItem('OSU_Input_Box_View') === 'controls') {

        $.ajax(
                {
                    url: "libs/ajax/display_box_score_controls.php",
                    type: "POST",
                    data: {},
                    success: function (data, textStatus, jqXHR)
                    {
                        $('#boxEditContent').replaceWith(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });

    }
    if (localStorage.getItem('OSU_Input_Box_View') === 'game') {

        var Game_ID = localStorage.getItem('OSU_Input_Box_Game');
        $.ajax(
                {
                    url: "libs/ajax/select_box_score_game.php",
                    type: "POST",
                    data: {new_game: Game_ID},
                    success: function (data, textStatus, jqXHR)
                    {
                        $('#boxEditContent').replaceWith(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });

    }

    $(document).ready(function () {

        //When the game tag lock icon is clicked, update the status in local storage and redisplay the icon
        $(document).on('click', '#gameTagLockIcon', function () {

            var status = $(this).data('status');

            if (status === 'unlocked') {
                $('#GameTagLockStatus').replaceWith('<div id="GameTagLockStatus"><span id="gameTagLockIcon" data-status="locked" class="oi oi-lock-locked"></span>&nbsp;&nbsp;Tag Games(s) In Uploaded Photo:</div>');
                localStorage.setItem('OSU_Game_Tag_Lock', 'locked');

                updateTagLockValues('game');
            }
            if (status === 'locked') {
                $('#GameTagLockStatus').replaceWith('<div id="GameTagLockStatus"><span id="gameTagLockIcon" data-status="unlocked" class="oi oi-lock-unlocked"></span>&nbsp;&nbsp;Tag Games(s) In Uploaded Photo:</div>');
                localStorage.setItem('OSU_Game_Tag_Lock', 'unlocked');
            }

        });

        //When an input view button is clicked update the database to the new view
        $(".inputViewBtn").click(function () {

            var view = $(this).data('view');

            $.ajax(
                    {
                        url: "libs/ajax/update_input_view.php",
                        type: "POST",
                        data: {new_view: view},
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
        //When setting the displayed seasons details: when CFP rankings start week is changed update the database
        $('#CFPStart').keydown(function (e) {
            clearTimeout(timer);
            timer = setTimeout(function () {

                var seasonID = $(e.target).attr('data-season');
                var newStart = $(e.target).val();
                $.ajax(
                        {
                            url: "libs/ajax/update_season_CFPStart.php",
                            type: "POST",
                            data: {seasonID: seasonID, newStart: newStart},
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
        //When updating a players season status, send new status to the db
        $('.playerStatusSelect').change(function () {

            var player_row = $(this).attr('id');
            var newStatus = $(this).val();
            $.ajax(
                    {
                        url: "libs/ajax/update_player_season_status.php",
                        type: "POST",
                        data: {player_row: player_row, newStatus: newStatus},
                        success: function (data, textStatus, jqXHR)
                        {
                            $(this).val(newStatus);
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Form Did Not Process: " + errorThrown);
                        }
                    });

        });
        //When updating a players offseason status, send new status to the db
        $('.playerOffseasonSelect').change(function () {

            var player_row = $(this).attr('id');
            var newStatus = $(this).val();
            $.ajax(
                    {
                        url: "libs/ajax/update_player_offseason_status.php",
                        type: "POST",
                        data: {player_row: player_row, newStatus: newStatus},
                        success: function (data, textStatus, jqXHR)
                        {
                            $(this).val(newStatus);
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Form Did Not Process: " + errorThrown);
                        }
                    });

        });

        //When a new input recruiting class is selected update the database to the new class view
        $(".recruitClass").change(function () {

            var recClass = $(this).val();

            $.ajax(
                    {
                        url: "libs/ajax/update_recruit_input_class_view.php",
                        type: "POST",
                        data: {recClass: recClass},
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

        //When entering recruit input details: when recruit field is changed update the database
        $('.changeRecruit').keydown(function (e) {
            clearTimeout(timer);
            timer = setTimeout(function () {

                var recruit_row = $(e.target).attr('id');
                var field = $(e.target).data('field');
                var newValue = $(e.target).val();

                $.ajax(
                        {
                            url: "libs/ajax/update_recruit.php",
                            type: "POST",
                            data: {row: recruit_row, field: field, newValue: newValue},
                            success: function (data, textStatus, jqXHR)
                            {
                                location.reload();
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                alert("Form Did Not Process: " + errorThrown);
                            }
                        });
            }, 1000);
        });

        //When entering recruit input details: when add recruit button is clicked add the recruit row to the database for the in focus class
        $("#addRecruitBtn").click(function () {

            var recClass = $(this).attr('data-class');

            $.ajax(
                    {
                        url: "libs/ajax/add_recruit_row.php",
                        type: "POST",
                        data: {recClass: recClass},
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
        //When entering recruit input details: when the remove recruit button is clicked remove the recruit row from the database
        $(".removeRecruit").click(function () {

            var recruitRow = $(this).attr('id');

            $.ajax(
                    {
                        url: "libs/ajax/remove_recruit_row.php",
                        type: "POST",
                        data: {recruitRow: recruitRow},
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
        //When entering recruit input details: when import class button is clicked import the class in focus 
        $("#importClass").click(function () {

            var recClass = $(this).attr('data-class');

            $.ajax(
                    {
                        url: "libs/ajax/import_class.php",
                        type: "POST",
                        data: {recClass: recClass},
                        success: function (data, textStatus, jqXHR)
                        {
                            alert(data);
                            location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Class Not Imported: " + errorThrown);
                        }
                    });
        });

        //When link recruit to player modal is open pass recruit id
        $('#recruitLinkModal').on('show.bs.modal', function (e) {
            var recID = $(e.relatedTarget).data('recid');
            $('#linkRecruitSearch').attr('data-recid', recID);
        })

        //On typing into link recruit to player searchbox genterate the tag results as buttons
        $("#linkRecruitSearch").keyup(function () {

            var name = $(this).val();
            var recID = $(this).data('recid');

            if (name === '') {
                $("#linkRecruitSearchResults").replaceWith('<div id="linkRecruitSearchResults"></div>');
            } else {

                $.ajax(
                        {
                            url: "libs/ajax/search_existing_player_recruit.php",
                            type: "POST",
                            data: {name: name, recID: recID},
                            success: function (data, textStatus, jqXHR)
                            {
                                $('#linkRecruitSearchResults').replaceWith(data);
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                alert("Results Could Not Be Loaded: " + errorThrown);
                            }
                        });
            }
        });

        //When link recruit to player button is clicked, link them together
        $(document).on("click", '.recruitLinkListItem', function (e) {

            var Master_ID = $(this).attr('id');
            var Rec_ID = $(this).data('recid');

            $.ajax(
                    {
                        url: "libs/ajax/link_recruit_to_player.php",
                        type: "POST",
                        data: {Master_ID: Master_ID, Rec_ID: Rec_ID},
                        success: function (data, textStatus, jqXHR)
                        {
                            location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Link Unsuccessful: " + errorThrown);
                        }
                    });

        });

        //When manage video tags modal is shown update the title
        $(document).on("show.bs.modal", '#manageVideoTagsModal', function (event) {

            var desc = $(event.relatedTarget).data('des');
            var Video_ID = $(event.relatedTarget).data('videoid');

            $('#manageVideoTagsTitle').append('Manage Tags For: ' + desc);

            $.ajax(
                    {
                        url: "libs/ajax/display_video_tag_edit.php",
                        type: "POST",
                        data: {Video_ID: Video_ID},
                        success: function (data, textStatus, jqXHR)
                        {
                            $('#editVideoTagsContent').replaceWith(data);
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Form Did Not Process: " + errorThrown);
                        }
                    });

        });

        //When manage video tags modal is hidden update the title
        $(document).on("hide.bs.modal", '#manageVideoTagsModal', function (event) {

            $('#manageVideoTagsTitle').replaceWith('<h5 class="modal-title" id="manageVideoTagsTitle"></h5>');
            $('#editVideoTagsContent').replaceWith('<div id="editVideoTagsContent"></div>');

        });
    });

    //When manage video tags modal is shown update the title
    $(document).on("show.bs.modal", '#manageScoringPlayModal', function (event) {

        var desc = $(event.relatedTarget).data('des');
        var Video_ID = $(event.relatedTarget).data('videoid');
        $('#scorePlayVideoID').val(Video_ID);

        $('#manageScoringPlayTitle').append('Add Scoring Play: ' + desc);

        $.ajax(
                {
                    url: "libs/ajax/display_video_scoring_play_edit.php",
                    type: "POST",
                    data: {Video_ID: Video_ID},
                    success: function (data, textStatus, jqXHR)
                    {
                        $('#editScoringPlayContent').replaceWith(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });

    });

    //When manage video tags modal is hidden update the title
    $(document).on("hide.bs.modal", '#manageScoringPlayModal', function (event) {

        $('#manageScoringPlayTitle').replaceWith('<h5 class="modal-title" id="manageScoringPlayTitle"></h5>');
        $('#editScoringPlayContent').replaceWith('<div id="editScoringPlayContent"></div>');
    });

    //When view viedo modal is shown update the title
    $(document).on("show.bs.modal", '#viewVideoModal', function (event) {

        var desc = $(event.relatedTarget).data('des');
        var Video_ID = $(event.relatedTarget).data('videoid');

        $('#viewVideoTitle').append('View: ' + desc);

        $.ajax(
                {
                    url: "libs/ajax/display_video_input.php",
                    type: "POST",
                    data: {Video_ID: Video_ID},
                    success: function (data, textStatus, jqXHR)
                    {
                        $('#viewVideoContent').replaceWith(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });

    });

    //When manage video tags modal is hidden update the title
    $(document).on("hide.bs.modal", '#viewVideoModal', function (event) {

        $('#viewVideoTitle').replaceWith('<h5 class="modal-title" id="viewVideoTitle"></h5>');
        $('#viewVideoContent').replaceWith('<div id="viewVideoContent"></div>');
    });


    //When a box score year is clicked, display the selectable games for that season
    $(document).on("click", '.boxYear', function (e) {

        var seasonID = $(this).attr('data-seasonID');

        $.ajax(
                {
                    url: "libs/ajax/display_box_score_games.php",
                    type: "POST",
                    data: {new_season: seasonID},
                    success: function (data, textStatus, jqXHR)
                    {
                        $('#boxGamesResults').replaceWith('<div id="boxGamesResults">' + data + '</div>');
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
    });

    //When a box score game is clicked, display the game's box score for editing
    $(document).on("click", '.selectBoxScoreGame', function (e) {

        var Game_ID = $(this).attr('data-gmID');
        localStorage.setItem('OSU_Input_Box_Game', Game_ID);
        localStorage.setItem('OSU_Input_Box_View', 'game');

        $.ajax(
                {
                    url: "libs/ajax/select_box_score_game.php",
                    type: "POST",
                    data: {new_game: Game_ID},
                    success: function (data, textStatus, jqXHR)
                    {
                        $('#boxScoreControls').replaceWith(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
    });

    //When change game for box score editing button is clicked, redisplay box edit controls
    $(document).on("click", '#changeBoxGame, #changeBoxGameNew', function (e) {

        localStorage.setItem('OSU_Input_Box_View', 'controls');

        $.ajax(
                {
                    url: "libs/ajax/display_box_score_controls.php",
                    type: "POST",
                    data: {},
                    success: function (data, textStatus, jqXHR)
                    {
                        $('#boxScoreGameInput').replaceWith(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
    });
    var boxPointsTimer;
    //When box score points is changed, update the points for the game being edited
    $(document).on("keydown", '.boxPoints', function (e) {

        var _this = $(this);

        clearTimeout(boxPointsTimer);
        boxPointsTimer = setTimeout(function () {

            var Game_ID = _this.attr('data-gmid');
            var field = _this.attr('data-field');
            var value = _this.val();

            $.ajax(
                    {
                        url: "libs/ajax/update_box_points.php",
                        type: "POST",
                        data: {Game_ID: Game_ID, field: field, value: value},
                        success: function (data, textStatus, jqXHR)
                        {
                            location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Form Did Not Process: " + errorThrown);
                        }
                    });

        }, 1000);
    });
    //When box OSU scoring play modal is opened update data and contents
    $(document).on("show.bs.modal", '#addScoringPlayModal', function (event) {

        var opp = $(event.relatedTarget).data('opp');
        var year = $(event.relatedTarget).data('year');
        var week = $(event.relatedTarget).data('week');
        var quarter = $(event.relatedTarget).data('q');

        if (quarter === 1) {
            display_quarter = 'First Quarter';
        }
        if (quarter === 2) {
            display_quarter = 'Second Quarter';
        }
        if (quarter === 3) {
            display_quarter = 'Third Quarter';
        }
        if (quarter === 4) {
            display_quarter = 'Fourth Quarter';
        }
        if (quarter === 5) {
            display_quarter = 'Overtime';
        }

        //update form quarter value
        $('input[name=q]').val(quarter);
        //update modal title
        $('#AddScoringPlayTitle').append('Add Scoring Play: ' + year + " - Week " + week + " - Vs " + opp + ' |  ' + display_quarter);
        //If an overtime quarter disable the time left field
        if (quarter === 5) {
            $('input[name=TimeLeft]').prop('placeholder', 'N/A for OT');
            $('input[name=TimeLeft]').prop('disabled', true);
        }

    });
    //When box opp scoring play modal is opened update data and contents
    $(document).on("show.bs.modal", '#addOppScoringPlayModal', function (event) {

        var opp = $(event.relatedTarget).data('opp');
        var year = $(event.relatedTarget).data('year');
        var week = $(event.relatedTarget).data('week');
        var quarter = $(event.relatedTarget).data('q');

        if (quarter === 1) {
            display_quarter = 'First Quarter';
        }
        if (quarter === 2) {
            display_quarter = 'Second Quarter';
        }
        if (quarter === 3) {
            display_quarter = 'Third Quarter';
        }
        if (quarter === 4) {
            display_quarter = 'Fourth Quarter';
        }

        //update form quarter value
        $('input[name=q]').val(quarter);
        //update modal title
        $('#AddOppScoringPlayTitle').append('Add ' + opp + ' Scoring Play: ' + year + " - Week " + week + ' |  ' + display_quarter);

    });
    //When box OSU scoring play modal is closed clear contents
    $(document).on("hide.bs.modal", '#addScoringPlayModal', function (event) {

        //update modal title
        $('#AddScoringPlayTitle').replaceWith('<h5 class="modal-title" id="AddScoringPlayTitle"></h5>');

    });
    //When box Opp scoring play modal is closed clear contents
    $(document).on("hide.bs.modal", '#addOppScoringPlayModal', function (event) {

        //update modal title
        $('#AddOppScoringPlayTitle').replaceWith('<h5 class="modal-title" id="AddOppScoringPlayTitle"></h5>');

    });

    //On typing into select player for scoring play searchbox genterate the player tags results as buttons
    $(document).on("keyup", '#searchScoringPlayer', function (e) {

        var name = $(this).val();
        var type = 'scoring';

        if (name === '') {
            $("#scoringPlayerResults").replaceWith('<div id="scoringPlayerResults"></div>');
        } else {

            $.ajax(
                    {
                        url: "libs/ajax/search_existing_player_scoring.php",
                        type: "POST",
                        data: {name: name, type: type},
                        success: function (data, textStatus, jqXHR)
                        {
                            $('#scoringPlayerResults').replaceWith(data);
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Results Could Not Be Loaded: " + errorThrown);
                        }
                    });
        }
    });
    //On typing into select from player for scoring play searchbox genterate the player tags results as buttons
    $(document).on("keyup", '#searchFromPlayer', function (e) {

        var name = $(this).val();

        if (name === '') {
            $("#fromPlayerResults").replaceWith('<div id="fromPlayerResults"></div>');
        } else {

            $.ajax(
                    {
                        url: "libs/ajax/search_existing_player_from.php",
                        type: "POST",
                        data: {name: name},
                        success: function (data, textStatus, jqXHR)
                        {
                            $('#fromPlayerResults').replaceWith(data);
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Results Could Not Be Loaded: " + errorThrown);
                        }
                    });
        }
    });

    //When a scoring player is selected from scoring play editing display the player and update the scoring play form
    $(document).on("click", '.scoringPlayerListItem', function (e) {

        var player_ID = this.id;

        $('#scoringPlayerResults').hide();
        $('#searchScoringPlayer').hide();
        $('#addScoringPlayForm').append('<input type="hidden" name="scoringPlayerID" value="' + player_ID + '" />');

        $.ajax(
                {
                    url: "libs/ajax/display_box_selected_scoring_player.php",
                    type: "POST",
                    data: {player_ID: player_ID},
                    success: function (data, textStatus, jqXHR)
                    {
                        $('#scoringPlayerResults').replaceWith(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Results Could Not Be Loaded: " + errorThrown);
                    }
                });
    });

    //When a from player is selected from from play editing display the player and update the from play form
    $(document).on("click", '.fromPlayerListItem', function (e) {

        var player_ID = this.id;

        $('#fromPlayerResults').hide();
        $('#searchFromPlayer').hide();
        $('#addScoringPlayForm').append('<input type="hidden" name="fromPlayerID" value="' + player_ID + '" />');

        $.ajax(
                {
                    url: "libs/ajax/display_box_selected_from_player.php",
                    type: "POST",
                    data: {player_ID: player_ID},
                    success: function (data, textStatus, jqXHR)
                    {
                        $('#fromPlayerResults').replaceWith(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Results Could Not Be Loaded: " + errorThrown);
                    }
                });
    });

    //When remove a scoring player is selected from scoring play remove the player and form value, redisplay form fields
    $(document).on("click", '.selectedFromPlayerRemove', function (e) {

        $('#fromPlayerSelected').replaceWith('<div id="fromPlayerSelected"></div>');
        $('#searchFromPlayer').val('');
        $('#searchFromPlayer').show();
        $('#fromPlayerResults').show();
        $('input[name=fromPlayerID').remove();
        $(this).parent().remove();

    });
    //When a scoring play type is selected enable the from player field, if any other type disable the field
    $(document).on("change", '#scoringPlayType', function (e) {

        var newCategory = $(this).val();

        if (newCategory === 'passTD') {
            $('#searchFromPlayer').prop('disabled', false);
        } else {
            $('#searchFromPlayer').prop('disabled', true);
        }

    });
    //When OSU scoring play form is submitted, serialize data and add scoring play to the database
    $(document).on("submit", '#addScoringPlayForm', function (e) {

        $formData = $(this).serialize();
        $.ajax(
                {
                    url: "libs/ajax/add_box_scoring_play.php",
                    type: "POST",
                    data: $formData,
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process");
                    }
                });


    });
    //When Opp scoring play form is submitted, serialize data and add scoring play to the database
    $(document).on("submit", '#addOppScoringPlayForm', function (e) {

        $formData = $(this).serialize();
        $.ajax(
                {
                    url: "libs/ajax/add_box_opp_scoring_play.php",
                    type: "POST",
                    data: $formData,
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process");
                    }
                });


    });

    //When a remove scoring play icon is clicked, remove the scoring play from the game
    $(document).on("click", '.removeScoringPlay', function (e) {

        var element = $(this).closest('li');
        var play_ID = this.id;

        $.ajax(
                {
                    url: "libs/ajax/remove_box_scoring_play.php",
                    type: "POST",
                    data: {play_ID: play_ID},
                    success: function (data, textStatus, jqXHR)
                    {
                        element.remove();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Results Could Not Be Loaded: " + errorThrown);
                    }
                });
    });
    //When add a new box score button is clicked, add new blank box score for given game
    $(document).on("click", '#addBoxScore', function (e) {

        var Game_ID = $(this).attr('data-gmID');

        $.ajax(
                {
                    url: "libs/ajax/add_new_box_score.php",
                    type: "POST",
                    data: {Game_ID: Game_ID},
                    success: function (data, textStatus, jqXHR)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Cannot add new box score: " + errorThrown);
                    }
                });
    });

    //When a box score year is clicked, display the selectable games for that season
    $(document).on("click", '.scorePlayYear', function (e) {

        var seasonID = $(this).attr('data-seasonID');

        $.ajax(
                {
                    url: "libs/ajax/display_score_play_games.php",
                    type: "POST",
                    data: {new_season: seasonID},
                    success: function (data, textStatus, jqXHR)
                    {
                        $('#scorePlayGamesResults').replaceWith('<div id="scorePlayGamesResults">' + data + '</div>');
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
    });

    //When a box score game is clicked, display the game's box score for editing
    $(document).on("click", '.selectScorePlayGame', function (e) {

        var Game_ID = $(this).attr('data-gmID');
        var Video_ID = $('#scorePlayVideoID').val();

        $.ajax(
                {
                    url: "libs/ajax/select_score_play_game.php",
                    type: "POST",
                    data: {new_game: Game_ID, Video_ID: Video_ID},
                    success: function (data, textStatus, jqXHR)
                    {
                        $('#scoringPlayResults').replaceWith(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
    });

    //When a box score game is clicked, display the game's box score for editing
    $(document).on("click", '.selectScorePlay', function (e) {

        var Play_ID = $(this).attr('data-playid');
        var Video_ID = $('#scorePlayVideoID').val();

        $.ajax(
                {
                    url: "libs/ajax/select_score_play_video.php",
                    type: "POST",
                    data: {new_play: Play_ID, Video_ID: Video_ID},
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

    //When a box score game is clicked, display the game's box score for editing
    $(document).on("click", '.removeScorePlay', function (e) {

        var Play_ID = $(this).attr('data-playid');

        $.ajax(
                {
                    url: "libs/ajax/remove_score_play_video.php",
                    type: "POST",
                    data: {new_play: Play_ID},
                    success: function (data, textStatus, jqXHR)
                    {
                        alert(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
    });

    //When recruit on team status is changed update the database
    $('.recOnTeam').change(function () {

        var change = '';
        var recID = $(this).attr('id');
        if (this.checked) {
            change = 'N';
        } else {
            change = '';
        }

        $.ajax(
                {
                    url: "libs/ajax/update_recruit_on_team.php",
                    type: "POST",
                    data: {recID: recID, recChg: change},
                    success: function (data, textStatus, jqXHR)
                    {
                        alert(data);
                        //location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });
    });
</script>