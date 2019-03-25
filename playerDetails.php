<?php
include ("libs/db/common_db_functions.php");

//Get posted Master Player ID
$Master_ID = $_POST['Player_Master_ID'];

//Get data for the player at Master Player ID
$getPlayerDataHeader = db_query("SELECT * From `Players` WHERE Player_Master_ID ={$Master_ID}");
$fetch_PlayerDataHeader = $getPlayerDataHeader->fetch_assoc();
?>
<html>
    <head>
        <title>Buckeyes - Player Details</title>
        <link rel="shortcut icon" href="http://www.iconj.com/ico/y/f/yfuwmmd6a8.ico" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="libs/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="libs/css/nouislider.css">
        <link rel="stylesheet" type="text/css" href="libs/css/grid-gallery.css">
        <link rel="stylesheet" type="text/css" href="libs/css/lightbox.css">
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
        <div class="container">
            <div class="row" style="text-align: center">
                <div class="col-lg-12">
                    <br>
                    <h1><span class="badge badge-secondary"><?php echo $fetch_PlayerDataHeader['First_Name'] . " " . $fetch_PlayerDataHeader['Last_Name']; ?> - Player Details</span></h1>
                </div>
            </div>
            <br>
            <div class="row" style="text-align: center">
                <div class="col-lg-12">
                    <div class="btn-group" role="group">
                        <button id="playerdetailsOverview" class="btn btn-secondary playerDetailNav">Overview</button>
                        <button id="playerdetailsStats" class="btn btn-secondary playerDetailNav">Stats</button>
                        <button id="playerdetailsPhotos" class="btn btn-secondary playerDetailNav">Photos</button>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12">
                    <div id="playerDetailsContent" data-playerid="<?php echo $Master_ID; ?>">
                    </div>
                </div>
            </div>
    </body>
</html>
<script>

    $(document).ready(function () {

        //Set defualts for localstorage for navigation
        if (localStorage.getItem('OSU_Player_Detail_View') === null) {
            localStorage.setItem('OSU_Player_Detail_View', 'Overall');
        }

        if (localStorage.getItem('OSU_Player_Detail_View') === 'Overall') {
            $('#playerdetailsOverview').addClass('active');
            displayPlayerDetailContent('overview', getPlayerID());
        }
        if (localStorage.getItem('OSU_Player_Detail_View') === 'Stats') {
            $('#playerdetailsStats').addClass('active');
            displayPlayerDetailContent('stats', getPlayerID());
        }
        if (localStorage.getItem('OSU_Player_Detail_View') === 'Photos') {
            $('#playerdetailsPhotos').addClass('active');
            displayPlayerDetailContent('photos', getPlayerID());
        }

        //update navigation when nav button is clicked
        $("#playerdetailsOverview").click(function () {

            localStorage.setItem('OSU_Player_Detail_View', 'Overall');
            removePlayerDetailNavActive();
            $('#playerdetailsOverview').addClass('active');
            displayPlayerDetailContent('overview', getPlayerID());
        });

        $("#playerdetailsStats").click(function () {

            localStorage.setItem('OSU_Player_Detail_View', 'Stats');
            removePlayerDetailNavActive();
            $('#playerdetailsStats').addClass('active');
            displayPlayerDetailContent('stats', getPlayerID());
        });

        $("#playerdetailsPhotos").click(function () {

            localStorage.setItem('OSU_Player_Detail_View', 'Photos');
            removePlayerDetailNavActive();
            $('#playerdetailsPhotos').addClass('active');
            displayPlayerDetailContent('photos', getPlayerID());

        });

        $("#playerdetailsVideos").click(function () {

            localStorage.setItem('OSU_Player_Detail_View', 'Videos');
            removePlayerDetailNavActive();
            $('#playerdetailsVideos').addClass('active');
            displayPlayerDetailContent('videos', getPlayerID());

        });

    });
    
    //remove active class from all player detail nav buttons
    function removePlayerDetailNavActive() {

        $('.playerDetailNav').removeClass("active");
    }

    //display the player deail view content based on nav selection
    function displayPlayerDetailContent(display, Master_ID) {

        $.ajax(
                {
                    url: "libs/ajax/display_player_detail_" + display + ".php",
                    type: "POST",
                    data: {Master_ID: Master_ID},
                    success: function (data, textStatus, jqXHR)
                    {
                        $("#playerDetailsContent").html(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Content Could Not Load: " + errorThrown);
                    }
                });

    }

    //return the player ID from the selected player's detail button
    function getPlayerID() {

        return $('#playerDetailsContent').attr('data-playerid');
    }
</script>