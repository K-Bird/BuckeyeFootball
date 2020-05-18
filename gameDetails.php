<?php
include ("libs/db/common_db_functions.php");

//Get posted Game ID
$GM_ID = $_POST['GM_ID'];

//Get all of the game's data from the games table   
$getGameData = db_query("SELECT * FROM `games` WHERE GM_ID='{$GM_ID}'");
$fetchGameData = $getGameData->fetch_assoc();
?>
<html>
    <head>
        <title>Buckeyes - Game Details</title>
        <link rel="shortcut icon" href="http://www.iconj.com/ico/y/f/yfuwmmd6a8.ico" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="libs/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="libs/css/nouislider.css">
        <link rel="stylesheet" type="text/css" href="libs/css/grid-gallery.css">
        <link rel="stylesheet" type="text/css" href="libs/css/lightbox.css">
        <link rel="stylesheet" type="text/css" href="libs/css/open-iconic-bootstrap.css">
        <link rel="stylesheet" type="text/css" href="libs/css/common.css">
        <script src="libs/js/jquery.js"></script>
        <script src="libs/js/bootstrap.js"></script>
        <script src="libs/js/nouislider.js"></script>
        <script src="libs/js/wNumb.js"></script>
        <script src="libs/js/grid-gallery.js"></script>
        <script src="libs/js/lightbox.js"></script>
        <script src="libs/js/commonFunctions.js"></script>
    </head>
    <body>
        <!-- include main navigation bar at top of page -->
        <?php include ('nav/navBar.php'); ?>
        <div class="container-fluid">
            <div class="row" style="text-align: center">
                <div class="col-lg-12">
                    <br>
                    <!-- Page heading for the game being detailed -->
                    <h1><span class="badge badge-secondary"><?php echo returnGameDate($GM_ID) . " Vs " . opponentLookup($fetchGameData['Vs']); ?> - Game Details</span></h1>
                </div>
            </div>
            <br>
            <div class="row" style="text-align: center">
                <div class="col-lg-12">
                    <!-- Button group to change the game details view -->
                    <div class="btn-group" role="group">
                        <button id="gmdetailsOverview" class="btn btn-secondary gmDetailNav">Overview</button>
                        <button id="gmdetailsBox" class="btn btn-secondary gmDetailNav">Box Score</button>
                        <button id="gmdetailsStats" class="btn btn-secondary gmDetailNav">Stats</button>
                        <button id="gmdetailsPhotos" class="btn btn-secondary gmDetailNav">Photos</button>
                        <button id="gmdetailsVideos" class="btn btn-secondary gmDetailNav">Videos</button> 
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Based on the detail view selected the gameDetailsContent div content is created -->
                    <div id="gameDetailsContent" data-gmid="<?php echo $GM_ID; ?>">
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script>

    $(document).ready(function () {

        //Set defaults for localstorage for navigation
        if (localStorage.getItem('OSU_Game_Detail_View') === null) {
            localStorage.setItem('OSU_Game_Detail_View', 'Overall');
        }

        if (localStorage.getItem('OSU_Game_Detail_View') === 'Overall') {
            $('#gmdetailsOverview').addClass('active');
            displayGameDetailContent('overview', getGameID());
        }
        if (localStorage.getItem('OSU_Game_Detail_View') === 'Box') {
            $('#gmdetailsBox').addClass('active');
            displayGameDetailContent('box', getGameID());
        }
        if (localStorage.getItem('OSU_Game_Detail_View') === 'Stats') {
            $('#gmdetailsStats').addClass('active');
            displayGameDetailContent('stats', getGameID());
        }
        if (localStorage.getItem('OSU_Game_Detail_View') === 'Photos') {
            $('#gmdetailsPhotos').addClass('active');
            displayGameDetailContent('photos', getGameID());
        }
        if (localStorage.getItem('OSU_Game_Detail_View') === 'Videos') {
            $('#gmdetailsVideos').addClass('active');
            displayGameDetailContent('videos', getGameID());
        }

        //update navigation when nav button is clicked
        $("#gmdetailsOverview").click(function () {

            localStorage.setItem('OSU_Game_Detail_View', 'Overall');
            removeGmDetailNavActive();
            $('#gmdetailsOverview').addClass('active');
            displayGameDetailContent('overview', getGameID());
        });
        $("#gmdetailsBox").click(function () {

            localStorage.setItem('OSU_Game_Detail_View', 'Box');
            removeGmDetailNavActive();
            $('#gmdetailsBox').addClass('active');
            displayGameDetailContent('box', getGameID());
        });
        $("#gmdetailsStats").click(function () {

            localStorage.setItem('OSU_Game_Detail_View', 'Stats');
            removeGmDetailNavActive();
            $('#gmdetailsStats').addClass('active');
            displayGameDetailContent('stats', getGameID());
        });

        $("#gmdetailsPhotos").click(function () {

            localStorage.setItem('OSU_Game_Detail_View', 'Photos');
            removeGmDetailNavActive();
            $('#gmdetailsPhotos').addClass('active');
            displayGameDetailContent('photos', getGameID());

        });

        $("#gmdetailsVideos").click(function () {

            localStorage.setItem('OSU_Game_Detail_View', 'Videos');
            removeGmDetailNavActive();
            $('#gmdetailsVideos').addClass('active');
            displayGameDetailContent('videos', getGameID());

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

    });

    //active class on all game detail navs removed
    function removeGmDetailNavActive() {

        $('.gmDetailNav').removeClass("active");
    }

    //based on the detail view selected call the appropriate detail sub page and populate the content
    function displayGameDetailContent(display, GM_ID) {

        $.ajax(
                {
                    url: "libs/ajax/display_game_detail_" + display + ".php",
                    type: "POST",
                    data: {GM_ID: GM_ID},
                    success: function (data, textStatus, jqXHR)
                    {
                        $("#gameDetailsContent").html(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Content Could Not Load: " + errorThrown);
                    }
                });

    }

    //grab the game id from the content div data attribute
    function getGameID() {

        return $('#gameDetailsContent').attr('data-gmid');
    }

</script>