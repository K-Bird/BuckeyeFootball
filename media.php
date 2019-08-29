<?php
include ("libs/db/common_db_functions.php");
include ('parts/common_inputs.php');
?>
<html>
    <head>
        <title>Buckeyes - Media</title>
        <link rel="shortcut icon" href="http://www.iconj.com/ico/y/f/yfuwmmd6a8.ico" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="libs/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="libs/css/nouislider.css">
        <link rel="stylesheet" type="text/css" href="libs/css/common.css">
        <link rel="stylesheet" type="text/css" href="libs/css/bootstrap-datepicker.css">
        <link rel="stylesheet" type="text/css" href="libs/css/grid-gallery.css">
        <link rel="stylesheet" type="text/css" href="libs/css/lightbox.css">
        <link rel="stylesheet" type="text/css" href="libs/css/bootstrap-select.min.css">
        <link rel="stylesheet" type="text/css" href="libs/css/open-iconic-bootstrap.css">
        <script src="libs/js/jquery.js"></script>
        <script src="libs/js/bootstrap.js"></script>
        <script src="libs/js/nouislider.js"></script>
        <script src="libs/js/wNumb.js"></script>
        <script src="libs/js/bootstrap-select.min.js"></script>
        <script src="libs/js/bootstrap-datepicker.js"></script>
        <script src="libs/js/grid-gallery.js"></script>
        <script src="libs/js/lightbox.js"></script>
        <script src="libs/js/commonFunctions.js"></script>
    </head>
    <body>
        <!-- include main navigation bar at top of page -->
        <?php include ('nav/navBar.php'); ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <!-- show the media navigation bar under the main nav bar -->
                    <?php include ('parts/media/topMediaNav.php'); ?>
                </div>
            </div>
        </div>
    </body>
</html>
<script>

    $(document).ready(function () {

        //Set defualts for localstorage for media navigation panels if values do not exist
        if (localStorage.getItem('OSU_Media_Top_Nav') === null) {
            localStorage.setItem('OSU_Media_Top_Nav', 'Photos');
        }
        if (localStorage.getItem('OSU_Media_Sub_Nav') === null) {
            localStorage.setItem('OSU_Media_Sub_Nav', 'Players');
        }

        //If last tab selected was photos open the photos tab
        if (localStorage.getItem('OSU_Media_Top_Nav') === 'Photos') {
            $('#photo-tab-mainnav').tab('show');
        }
        //If last tab selected was photos open the photos tab
        if (localStorage.getItem('OSU_Media_Top_Nav') === 'Video') {
            $('#video-tab-mainnav').tab('show');
        }
        //If last tab selected was photos open the photos tab
        if (localStorage.getItem('OSU_Media_Top_Nav') === 'Social') {
            $('#social-tab-mainnav').tab('show');
        }
        //If last tab selected was photos open the photos tab
        if (localStorage.getItem('OSU_Media_Top_Nav') === 'Web') {
            $('#web-tab-mainnav').tab('show');
        }

        //If last sub-tab selected was players open the photos-players tab
        if (localStorage.getItem('OSU_Media_Sub_Nav') === 'Players') {
            $('#photo-tab-subnav-players').tab('show');
        }
        if (localStorage.getItem('OSU_Media_Sub_Nav') === 'Games') {
            $('#photo-tab-subnav-games').tab('show');
        }
        if (localStorage.getItem('OSU_Media_Sub_Nav') === 'Misc') {
            $('#photo-tab-subnav-misc').tab('show');
        }

        //on any tab change
        $('a[data-toggle="tab"], a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
            var target = $(e.target).attr("href"); // activated tab

            if (target === '#mediaPhotoTab') {
                localStorage.setItem('OSU_Media_Top_Nav', 'Photos');
            }
            if (target === '#mediaVideoTab') {
                localStorage.setItem('OSU_Media_Top_Nav', 'Video');
            }

            if (target === '#mediaSocialTab') {
                localStorage.setItem('OSU_Media_Top_Nav', 'Social');
            }

            if (target === '#mediaWebTab') {
                localStorage.setItem('OSU_Media_Top_Nav', 'Web');
            }

            if (target === '#photoTabPlayers') {
                localStorage.setItem('OSU_Media_Sub_Nav', 'Players');
            }

            if (target === '#photoTabGames') {
                localStorage.setItem('OSU_Media_Sub_Nav', 'Games');
            }
            if (target === '#photoTabMisc') {
                localStorage.setItem('OSU_Media_Sub_Nav', 'Misc');
            }


        });
        //When New Player is Selected From the Player Photo Dropdown Set Them to View
        $('#playerPhotoSelect').change(function () {

            var player_tag = $(this).val();
            $.ajax(
                    {
                        url: "libs/ajax/update_player_photo_gallery.php",
                        type: "POST",
                        data: {player_tag: player_tag},
                        success: function (data, textStatus, jqXHR)
                        {
                            $('#playerPhotoGalleryBox').empty();
                            $('#playerPhotoGalleryBox').append(data);
                            //$('#editTagsModalContainer').empty();
                            //$('#editTagsModalContainer').load('parts/media/editTagsModal.php?playerID=' + getPhotoPlayerID() + '&type=player');
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Content Could Not Be Loaded: " + errorThrown);
                        }
                    });
        });
        //When New Game is Selected From the Game Photo Dropdown Set Them to View
        $('#gamePhotoSelect').change(function () {

            var game_tag = $(this).val();
            $.ajax(
                    {
                        url: "libs/ajax/update_game_photo_gallery.php",
                        type: "POST",
                        data: {game_tag: game_tag},
                        success: function (data, textStatus, jqXHR)
                        {
                            $('#gamePhotoGalleryBox').empty();
                            $('#gamePhotoGalleryBox').append(data);
                            //$('#editTagsModalContainer').empty();
                            //$('#editTagsModalContainer').load('parts/media/editTagsModal.php?gameID=' + getPhotoGameID() + '&type=game');
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Content Could Not Be Loaded: " + errorThrown);
                        }
                    });
        });
        //When New Game is Selected From the Game Video Dropdown Set it to View
        $('#gameVideoSelect').change(function () {

            var game_tag = $(this).val();
            $.ajax(
                    {
                        url: "libs/ajax/update_game_video.php",
                        type: "POST",
                        data: {game_tag: game_tag},
                        success: function (data, textStatus, jqXHR)
                        {
                            location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Content Could Not Be Loaded: " + errorThrown);
                        }
                    });
        });
        //When New Misc Tag is Selected From the Misc Tag Video Dropdown Set it to View
        $('#miscVideoSelect').change(function () {

            var misc_tag = $(this).val();
            $.ajax(
                    {
                        url: "libs/ajax/update_misc_video.php",
                        type: "POST",
                        data: {misc_tag: misc_tag},
                        success: function (data, textStatus, jqXHR)
                        {
                            location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Content Could Not Be Loaded: " + errorThrown);
                        }
                    });
        });
        //When New Misc is Selected From the Misc Photo Dropdown Set Them to View
        $('#miscPhotoSelect').change(function () {

            var misc_tag = $(this).val();
            $.ajax(
                    {
                        url: "libs/ajax/update_misc_photo_gallery.php",
                        type: "POST",
                        data: {misc_tag: misc_tag},
                        success: function (data, textStatus, jqXHR)
                        {
                            $('#miscPhotoGalleryBox').empty();
                            $('#miscPhotoGalleryBox').append(data);
                            //$('#editTagsModalContainer').empty();
                            //$('#editTagsModalContainer').load('parts/media/editTagsModal.php?miscID=' + getPhotoMiscID() + '&type=misc');
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Content Could Not Be Loaded: " + errorThrown);
                        }
                    });
        });

    });
    function getPhotoPlayerID() {

        var playerID = "";
        $.ajax(
                {
                    async: false,
                    url: "libs/ajax/returnControl-PhotoPlayerID.php",
                    type: "POST",
                    data: {},
                    success: function (data, textStatus, jqXHR)
                    {
                        playerID = data.toString();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("DB Control Could Not Be Loaded: " + errorThrown);
                    }
                });
        return playerID;
    }

    function getPhotoGameID() {

        var gameID = "";
        $.ajax(
                {
                    async: false,
                    url: "libs/ajax/returnControl-PhotoGameID.php",
                    type: "POST",
                    data: {},
                    success: function (data, textStatus, jqXHR)
                    {
                        gameID = data.toString();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("DB Control Could Not Be Loaded: " + errorThrown);
                    }
                });
        return gameID;
    }

    function getPhotoMiscID() {

        var miscID = "";
        $.ajax(
                {
                    async: false,
                    url: "libs/ajax/returnControl-PhotoMiscID.php",
                    type: "POST",
                    data: {},
                    success: function (data, textStatus, jqXHR)
                    {
                        miscID = data.toString();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("DB Control Could Not Be Loaded: " + errorThrown);
                    }
                });
        return miscID;
    }

    //Attempt to get the active photo's ID. If not defined or set check a different carousel item class
    function currentlyDisplayedPhoto() {

        var photo_id = $('#playerPhotoIndicators .carousel-item.active').attr('id');
        if (photo_id == null || photo_id == "undefined") {
            var photo_id = $('#playerPhotoIndicators .carousel-itemactive').attr('id');
        }

        return photo_id;
    }

</script>