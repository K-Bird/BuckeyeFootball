<?php
include ("libs/db/common_db_functions.php");
include ('parts/common_inputs.php');
?>
<html>
    <head>
        <title>OSU - Media</title>
        <link rel="stylesheet" type="text/css" href="libs/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="libs/css/nouislider.css">
        <link rel="stylesheet" type="text/css" href="libs/css/common.css">
        <link rel="stylesheet" type="text/css" href="libs/css/grid-gallery.css">
        <link rel="stylesheet" type="text/css" href="libs/css/lightbox.css">
        <link rel="stylesheet" type="text/css" href="libs/css/bootstrap-select.min.css">
        <script src="libs/js/jquery.js"></script>
        <script src="libs/js/bootstrap.js"></script>
        <script src="libs/js/nouislider.js"></script>
        <script src="libs/js/wNumb.js"></script>
        <script src="libs/js/bootstrap-select.min.js"></script>
        <script src="libs/js/grid-gallery.js"></script>
        <script src="libs/js/lightbox.js"></script>
        <script src="libs/js/commonFunctions.js"></script>
    </head>
    <body>
        <?php include ('nav/navBar.php'); ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
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

        //On page load, load the edit tags modal passing the last player photo ID from the database
        $('#editTagsModalContainer').load('parts/media/editTagsModal.php?playerID=' + getPhotoPlayerID());


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
                            $('#editTagsModalContainer').empty();
                            $('#editTagsModalContainer').load('parts/media/editTagsModal.php?playerID=' + getPhotoPlayerID());
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Content Could Not Be Loaded: " + errorThrown);
                        }
                    });

        });


        //On typing into player tag upload searchbox genterate the tag results as buttons
        $("#playerTagSearchUpload").keyup(function () {

            var name = $('#playerTagSearchUpload').val();

            if (name === '') {
                $('#playerTagResults').replaceWith('<div id="playerTagResults"></div>');
            } else {

                $.ajax(
                        {
                            url: "libs/ajax/search_player_tag.php",
                            type: "POST",
                            data: {name: name, type: "upload"},
                            success: function (data, textStatus, jqXHR)
                            {
                                $('#playerTagResults').replaceWith(data);
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                alert("Tags Could Not Be Loaded: " + errorThrown);
                            }
                        });
            }
        });

        //On typing into player tag existing searchbox genterate the tag results as buttons
        $(document).on("keyup",'.playerTagSearchDisplayed' , function () {

            var name = $(this).val();
            var number = $(this).attr('data-num');
            var photoID = $(this).attr('data-photoID');

            if (name === '') {
                $('#playerTagExistingResults' + number).empty();
            } else {
                $.ajax(
                        {
                            url: "libs/ajax/search_player_tag.php",
                            type: "POST",
                            data: {name: name, num : number, type: "existing", photoID : photoID},
                            success: function (data, textStatus, jqXHR)
                            {
                                $('#playerTagExistingResults' + number).replaceWith(data);
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                alert("Tags Could Not Be Loaded: " + errorThrown);
                            }
                        });
            }
        });

        //On upload tag button click post ajax rendering
        $(document).on("click", '.playerTagListItem', function (event) {

            //Get player ID of clicked player to tag
            var playerID = $(this).attr('id');
            //create array to capture current tags
            var newTagArray = [];
            //explode new playerPhotoTag values
            var tagString = $('#playerPhotoTag').val()
            newTagArray = tagString.split(",");
            //add new tag to array
            newTagArray.push(playerID);
            //filter out blank values
            newTagArray = newTagArray.filter(function (e) {
                return e
            });
            //set array as value for playerPhotoTag
            $('#playerPhotoTag').val(newTagArray);

            $.ajax(
                    {
                        url: "libs/ajax/return_selected_tag.php",
                        type: "POST",
                        data: {playerID: playerID},
                        success: function (data, textStatus, jqXHR)
                        {
                            $('#playerTagSelected').append(data);
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Selected Tag Could Not Be Loaded: " + errorThrown);
                        }
                    });

        });

        //On existing tag button click add the tag and render it
        $(document).on("click", '.playerTagListExistingItem', function (event) {

            //Get player ID of clicked player to tag
            var playerID = $(this).attr('id');
            
            //Get sequential number of editing controls
            var num = $(this).attr('data-num');
            
            //Get ID of photo being edited
            var photo_id = $(this).attr('data-photoID');

            $.ajax(
                    {
                        url: "libs/ajax/add_playerTag.php",
                        type: "POST",
                        data: {playerID: playerID, photo_id: photo_id},
                        success: function (data, textStatus, jqXHR)
                        {
                            $('#playerPhotoTags' + num).append(data);
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Selected Tag Could Not Be Loaded: " + errorThrown);
                        }
                    });
        });

        // When player existing tag X is clicked, remove the tag from the image
        $(document).on('click', '.playerTagRemove', function () {

            //Get value of clicked tags ID
            var playerID_pre = $(this).attr('id');
            var playerID = playerID_pre.slice(4);

            //get id of visible photo
            var photo_id = $(this).attr('data-photo');


            //remove selected tag from photo
            $.ajax(
                    {
                        url: "libs/ajax/remove_playerTag.php",
                        type: "POST",
                        data: {playerID: playerID, photo_id: photo_id},
                        success: function (data, textStatus, jqXHR)
                        {
                            //remove deleted tag
                            $('#' + playerID_pre).parent().remove();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Selected Tag Could Not Be Removed: " + errorThrown);
                        }
                    });

        });

        //When player upload tag X is clicked, alter the form value that contains the tags to upload
        $(document).on("click", '.playerUploadTagRemove', function (event) {

            //Get value of clicked tags ID
            var playerID = $(this).attr('id');

            var newTagArray = [];
            //explode new playerPhotoTag values
            var tagString = $('#playerPhotoTag').val()
            newTagArray = tagString.split(",");
            //removed matched tag from array
            var filteredArray = newTagArray.filter(function (value, index, arr) {

                return value != playerID;

            });
            //Set value of photo tags to be uploaded
            $('#playerPhotoTag').val(filteredArray);
            //remove the tag on screen
            $(this).parent().remove();

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

    //Attempt to get the active photo's ID. If not defined or set check a different carousel item class
    function currentlyDisplayedPhoto() {

        var photo_id = $('#playerPhotoIndicators .carousel-item.active').attr('id');

        if (photo_id == null || photo_id == "undefined") {
            var photo_id = $('#playerPhotoIndicators .carousel-itemactive').attr('id');
        }

        return photo_id;

    }

</script>