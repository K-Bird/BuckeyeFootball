<div class="container-fluid" style="text-align: center">
    <br><br>
    <div class="row">
        <div class="col-lg-12">
            <!-- show the media navigation bar under the main nav bar -->
            <?php include ('parts/input/media_input/topMediaInputNav.php'); ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {

        //Set defualts for localstorage for input navigation panels if values do not exist
        if (localStorage.getItem('OSU_Input_Top_Nav') === null) {
            localStorage.setItem('OSU_Input_Top_Nav', 'Photos');
        }
        if (localStorage.getItem('OSU_Input_Sub_Nav') === null) {
            localStorage.setItem('OSU_Input_Sub_Nav', 'Players');
        }

        //If last tab selected was photos open the photos tab
        if (localStorage.getItem('OSU_Input_Top_Nav') === 'Photos') {
            $('#photo-tab-mainnav').tab('show');
        }
        //If last tab selected was photos open the photos tab
        if (localStorage.getItem('OSU_Input_Top_Nav') === 'Video') {
            $('#video-tab-mainnav').tab('show');
        }
        //If last tab selected was photos open the photos tab
        if (localStorage.getItem('OSU_Input_Top_Nav') === 'Social') {
            $('#social-tab-mainnav').tab('show');
        }
        //If last tab selected was photos open the photos tab
        if (localStorage.getItem('OSU_Input_Top_Nav') === 'Web') {
            $('#web-tab-mainnav').tab('show');
        }

        //If last sub-tab selected was players open the photos-players tab
        if (localStorage.getItem('OSU_Input_Sub_Nav') === 'Players') {
            $('#photo-tab-subnav-players').tab('show');
        }
        if (localStorage.getItem('OSU_Input_Sub_Nav') === 'Games') {
            $('#photo-tab-subnav-games').tab('show');
        }
        if (localStorage.getItem('OSU_Input_Sub_Nav') === 'Misc') {
            $('#photo-tab-subnav-misc').tab('show');
        }

        //on any tab change
        $('a[data-toggle="tab"], a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
            var target = $(e.target).attr("href"); // activated tab

            if (target === '#inputPhotoTab') {
                localStorage.setItem('OSU_Input_Top_Nav', 'Photos');
            }
            if (target === '#inputVideoTab') {
                localStorage.setItem('OSU_Input_Top_Nav', 'Video');
            }

            if (target === '#inputSocialTab') {
                localStorage.setItem('OSU_Input_Top_Nav', 'Social');
            }

            if (target === '#inputWebTab') {
                localStorage.setItem('OSU_Input_Top_Nav', 'Web');
            }

            if (target === '#photoTabPlayers') {
                localStorage.setItem('OSU_Input_Sub_Nav', 'Players');
                $('#editTagsModalContainer').empty();
                $('#editTagsModalContainer').load('parts/input/media_input/editTagsModal.php?playerID=' + getPhotoPlayerID() + '&type=player');
            }

            if (target === '#photoTabGames') {
                localStorage.setItem('OSU_Input_Sub_Nav', 'Games');
                $('#editTagsModalContainer').empty();
                $('#editTagsModalContainer').load('parts/input/media_input/editTagsModal.php?gameID=' + getPhotoGameID() + '&type=game');
            }
            if (target === '#photoTabMisc') {
                localStorage.setItem('OSU_Input_Sub_Nav', 'Misc');
                $('#editTagsModalContainer').empty();
                $('#editTagsModalContainer').load('parts/input/media_input/editTagsModal.php?miscID=' + getPhotoMiscID() + '&type=misc');
            }


        });

        //On page load, load the edit tags modal passing the last player photo ID, game ID, or Misc ID from the database depending on which tab is active (players or games)
        if (localStorage.getItem('OSU_Media_Sub_Nav') === 'Players') {
            $('#editTagsModalContainer').load('parts/input/media_input/editTagsModal.php?playerID=' + getPhotoPlayerID() + '&type=player');
        }
        if (localStorage.getItem('OSU_Media_Sub_Nav') === 'Games') {
            $('#editTagsModalContainer').load('parts/input/media_input/editTagsModal.php?gameID=' + getPhotoGameID() + '&type=game');
        }
        if (localStorage.getItem('OSU_Media_Sub_Nav') === 'Misc') {
            $('#editTagsModalContainer').load('parts/input/media_input/editTagsModal.php?miscID=' + getPhotoMiscID() + '&type=misc');
        }

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
                            $('#editTagsModalContainer').load('parts/input/media_input/editTagsModal.php?playerID=' + getPhotoPlayerID() + '&type=player');
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
                            $('#editTagsModalContainer').empty();
                            $('#editTagsModalContainer').load('parts/input/media_input/editTagsModal.php?gameID=' + getPhotoGameID() + '&type=game');
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
                            $('#editTagsModalContainer').empty();
                            $('#editTagsModalContainer').load('parts/input/media_input/editTagsModal.php?miscID=' + getPhotoMiscID() + '&type=misc');
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

        //On typing into game tag upload searchbox for photos genterate the tag results as buttons
        $(".gamesSearchField").keyup(function () {

            var year = $('#gamesSearchYear').val();
            var opp = $('#gamesSearchOpp').val();
            var loc = $('#gamesSearchLoc').val();

            if (year === '' && opp === '' && loc === '') {
                $('#gameTagResults').replaceWith('<div id="gameTagResults"></div>');
            } else {

                $.ajax(
                        {
                            url: "libs/ajax/search_game_tag.php",
                            type: "POST",
                            data: {year: year, opp: opp, loc: loc, type: "upload"},
                            success: function (data, textStatus, jqXHR)
                            {
                                $('#gameTagResults').replaceWith(data);
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                alert("Tags Could Not Be Loaded: " + errorThrown);
                            }
                        });
            }

        });

        //On typing into game tag upload searchbox for videos genterate the tag results as buttons
        $(".gamesSearchFieldv").keyup(function () {

            var year = $('#gamesSearchYearv').val();
            var opp = $('#gamesSearchOppv').val();
            var loc = $('#gamesSearchLocv').val();

            if (year === '' && opp === '' && loc === '') {
                $('#gameTagResultsv').replaceWith('<div id="gameTagResultsv"></div>');
            } else {

                $.ajax(
                        {
                            url: "libs/ajax/search_game_tagv.php",
                            type: "POST",
                            data: {year: year, opp: opp, loc: loc, type: "upload"},
                            success: function (data, textStatus, jqXHR)
                            {
                                $('#gameTagResultsv').replaceWith(data);
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                alert("Tags Could Not Be Loaded: " + errorThrown);
                            }
                        });
            }

        });

        //On typing into misc tag upload searchbox genterate the tag results as buttons
        $("#miscTagSearchUpload").keyup(function () {

            var name = $('#miscTagSearchUpload').val();

            if (name === '') {
                $('#miscTagResults').replaceWith('<div id="miscTagResults"></div>');
            } else {

                $.ajax(
                        {
                            url: "libs/ajax/search_misc_tag.php",
                            type: "POST",
                            data: {name: name, type: "upload"},
                            success: function (data, textStatus, jqXHR)
                            {
                                $('#miscTagResults').replaceWith(data);
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                alert("Tags Could Not Be Loaded: " + errorThrown);
                            }
                        });
            }
        });

        //On typing into misc tag for video upload searchbox genterate the tag results as buttons
        $("#miscTagSearchUploadv").keyup(function () {

            var name = $('#miscTagSearchUploadv').val();

            if (name === '') {
                $('#miscTagResultsv').replaceWith('<div id="miscTagResultsv"></div>');
            } else {

                $.ajax(
                        {
                            url: "libs/ajax/search_misc_tagv.php",
                            type: "POST",
                            data: {name: name, type: "upload"},
                            success: function (data, textStatus, jqXHR)
                            {
                                $('#miscTagResultsv').replaceWith(data);
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                alert("Tags Could Not Be Loaded: " + errorThrown);
                            }
                        });
            }
        });

        //On typing into player tag existing searchbox genterate the tag results as buttons
        $(document).on("keyup", '.playerTagSearchDisplayed', function () {

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
                            data: {name: name, num: number, type: "existing", photoID: photoID},
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

        //On typing into game tag existing searchbox genterate the tag results as buttons
        $(document).on("keyup", '.gameSearchFieldExisting', function () {

            var number = $(this).attr('data-num');
            var photoID = $(this).attr('data-photoID');

            var year = $('#gamesSearchExistingYear' + number).val();
            var opp = $('#gamesSearchExistingOpp' + number).val();
            var loc = $('#gamesSearchExistingLoc' + number).val();


            if (year === '' && opp === '' && loc === '') {
                $('#gameTagExistingResults' + number).empty();
            } else {
                $.ajax(
                        {
                            url: "libs/ajax/search_game_tag.php",
                            type: "POST",
                            data: {year: year, opp: opp, loc: loc, num: number, type: "existing", photoID: photoID},
                            success: function (data, textStatus, jqXHR)
                            {
                                $('#gameTagExistingResults' + number).replaceWith(data);
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                alert("Tags Could Not Be Loaded: " + errorThrown);
                            }
                        });
            }
        });

        //On typing into game tag existing video searchbox genterate the tag results as buttons
        $(document).on("keyup", '.existingGamesSearchFieldv', function () {

            var videoID = $(this).attr('data-videoID');

            var year = $('#existingGamesSearchYearv' + videoID).val();
            var opp = $('#existingGamesSearchOppv' + videoID).val();
            var loc = $('#existingGamesSearchLocv' + videoID).val();


            if (year === '' && opp === '' && loc === '') {
                $('#existingGameTagResultsv' + videoID).empty();
            } else {
                $.ajax(
                        {
                            url: "libs/ajax/search_game_tagv.php",
                            type: "POST",
                            data: {year: year, opp: opp, loc: loc, type: "existing", videoID: videoID},
                            success: function (data, textStatus, jqXHR)
                            {
                                $('#existingGameTagResultsv' + videoID).replaceWith(data);
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                alert("Tags Could Not Be Loaded: " + errorThrown);
                            }
                        });
            }
        });

        //On typing into misc tag existing searchbox genterate the tag results as buttons
        $(document).on("keyup", '.miscTagSearchDisplayed', function () {

            var name = $(this).val();
            var number = $(this).attr('data-num');
            var photoID = $(this).attr('data-photoID');

            if (name === '') {
                $('#miscTagExistingResults' + number).empty();
            } else {
                $.ajax(
                        {
                            url: "libs/ajax/search_misc_tag.php",
                            type: "POST",
                            data: {name: name, num: number, type: "existing", photoID: photoID},
                            success: function (data, textStatus, jqXHR)
                            {
                                $('#miscTagExistingResults' + number).replaceWith(data);
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                alert("Tags Could Not Be Loaded: " + errorThrown);
                            }
                        });
            }
        });

        //On typing into misc tag existing video searchbox genterate the tag results as buttons
        $(document).on("keyup", '.miscTagSearchDisplayedv', function () {

            var name = $(this).val();
            var videoID = $(this).attr('data-videoID');

            if (name === '') {
                $('#miscTagExistingResultsv' + videoID).empty();
            } else {
                $.ajax(
                        {
                            url: "libs/ajax/search_misc_tagv.php",
                            type: "POST",
                            data: {name: name, type: "existing", videoID: videoID},
                            success: function (data, textStatus, jqXHR)
                            {
                                $('#miscTagExistingResultsv' + videoID).replaceWith(data);
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                alert("Tags Could Not Be Loaded: " + errorThrown);
                            }
                        });
            }
        });

        //On upload player tag button click post ajax rendering
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
                        data: {playerID: playerID, type: 'player'},
                        success: function (data, textStatus, jqXHR)
                        {
                            $('#playerTagSelected').append(data);
                            $('#playerTagResults').replaceWith('<div id="playerTagResults"></div>');
                            $('#playerTagSearchUpload').val('');
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Selected Tag Could Not Be Loaded: " + errorThrown);
                        }
                    });

        });

        //On upload game tag button click post ajax rendering
        $(document).on("click", '.gameTagListItem', function (event) {

            //Get game ID of clicked game to tag
            var gameID = $(this).attr('id');
            //create array to capture current tags
            var newTagArray = [];
            //explode new gamePhotoTag values
            var tagString = $('#gamePhotoTag').val()

            newTagArray = tagString.split(",");
            //add new tag to array
            newTagArray.push(gameID);
            //filter out blank values
            newTagArray = newTagArray.filter(function (e) {
                return e
            });
            //set array as value for gamePhotoTag
            $('#gamePhotoTag').val(newTagArray);

            $.ajax(
                    {
                        url: "libs/ajax/return_selected_tag.php",
                        type: "POST",
                        data: {gameID: gameID, type: 'game'},
                        success: function (data, textStatus, jqXHR)
                        {
                            $('#gameTagSelected').append(data);
                            $('#gameTagResults').replaceWith('<div id="gameTagResults"></div>');
                            $('.gamesSearchField').val('');

                            var lockStatus = localStorage.getItem('OSU_Game_Tag_Lock');
                            if (lockStatus === 'locked') {
                                updateTagLockValues('game');
                            } else {
                                enableTagLock('game');
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Selected Tag Could Not Be Loaded: " + errorThrown);
                        }
                    });

        });

        //On upload game tag for video button click post ajax rendering
        $(document).on("click", '.gameTagListItemv', function (event) {

            //Get game ID of clicked game to tag
            var gameID = $(this).attr('id');
            //create array to capture current tags
            var newTagArray = [];
            //explode new gamePhotoTag values
            var tagString = $('#gameVideoTag').val()

            newTagArray = tagString.split(",");
            //add new tag to array
            newTagArray.push(gameID);
            //filter out blank values
            newTagArray = newTagArray.filter(function (e) {
                return e
            });
            //set array as value for gamePhotoTag
            $('#gameVideoTag').val(newTagArray);

            $.ajax(
                    {
                        url: "libs/ajax/return_selected_tagv.php",
                        type: "POST",
                        data: {gameID: gameID, type: 'game'},
                        success: function (data, textStatus, jqXHR)
                        {
                            $('#gameTagSelectedv').append(data);
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Selected Tag Could Not Be Loaded: " + errorThrown);
                        }
                    });

        });

        //On upload misc tag button click post ajax rendering
        $(document).on("click", '.miscTagListItem', function (event) {

            //Get misc ID of clicked misc to tag
            var miscID = $(this).attr('id');
            //create array to capture current tags
            var newTagArray = [];
            //explode new miscPhotoTag values
            var tagString = $('#miscPhotoTag').val()

            newTagArray = tagString.split(",");
            //add new tag to array
            newTagArray.push(miscID);
            //filter out blank values
            newTagArray = newTagArray.filter(function (e) {
                return e
            });
            //set array as value for miscPhotoTag
            $('#miscPhotoTag').val(newTagArray);

            $.ajax(
                    {
                        url: "libs/ajax/return_selected_tag.php",
                        type: "POST",
                        data: {miscID: miscID, type: 'misc'},
                        success: function (data, textStatus, jqXHR)
                        {
                            $('#miscTagSelected').append(data);
                            $('#miscTagResults').replaceWith('<div id="miscTagResults"></div>');
                            $('#miscTagSearchUpload').val('');
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Selected Tag Could Not Be Loaded: " + errorThrown);
                        }
                    });

        });

        //On upload misc video tag button click post ajax rendering
        $(document).on("click", '.miscTagListItemv', function (event) {

            //Get misc ID of clicked misc to tag
            var miscID = $(this).attr('id');
            //create array to capture current tags
            var newTagArray = [];
            //explode new miscPhotoTag values
            var tagString = $('#miscVideoTag').val()

            newTagArray = tagString.split(",");
            //add new tag to array
            newTagArray.push(miscID);
            //filter out blank values
            newTagArray = newTagArray.filter(function (e) {
                return e
            });
            //set array as value for miscPhotoTag
            $('#miscVideoTag').val(newTagArray);

            $.ajax(
                    {
                        url: "libs/ajax/return_selected_tagv.php",
                        type: "POST",
                        data: {miscID: miscID, type: 'misc'},
                        success: function (data, textStatus, jqXHR)
                        {
                            $('#miscTagSelectedv').append(data);
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

        //On existing photo tag button click add the tag and render it
        $(document).on("click", '.gameTagListExistingItem', function (event) {

            //Get game ID of clicked game to tag
            var gameID = $(this).attr('id');

            //Get sequential number of editing controls
            var num = $(this).attr('data-num');

            //Get ID of photo being edited
            var photo_id = $(this).attr('data-photoID');

            $.ajax(
                    {
                        url: "libs/ajax/add_gameTag.php",
                        type: "POST",
                        data: {gameID: gameID, photo_id: photo_id},
                        success: function (data, textStatus, jqXHR)
                        {
                            $('#gamePhotoTags' + num).append(data);
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Selected Tag Could Not Be Loaded: " + errorThrown);
                        }
                    });
        });

        //On existing video tag button click add the tag and render it
        $(document).on("click", '.gameTagListExistingItemv', function (event) {

            //Get game ID of clicked game to tag
            var gameID = $(this).attr('id');

            //Get ID of video being edited
            var video_id = $(this).attr('data-videoID');

            $.ajax(
                    {
                        url: "libs/ajax/add_gameTagv.php",
                        type: "POST",
                        data: {gameID: gameID, video_id: video_id},
                        success: function (data, textStatus, jqXHR)
                        {
                            $('#gameTagsv' + video_id).append(data);
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Selected Tag Could Not Be Loaded: " + errorThrown);
                        }
                    });
        });

        //On existing misc tag button click add the tag and render it
        $(document).on("click", '.miscTagListExistingItem', function (event) {

            //Get misc ID of clicked misc to tag
            var miscID = $(this).attr('id');

            //Get sequential number of editing controls
            var num = $(this).attr('data-num');

            //Get ID of photo being edited
            var photo_id = $(this).attr('data-photoID');

            $.ajax(
                    {
                        url: "libs/ajax/add_miscTag.php",
                        type: "POST",
                        data: {miscID: miscID, photo_id: photo_id},
                        success: function (data, textStatus, jqXHR)
                        {
                            $('#miscPhotoTags' + num).append(data);
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Selected Tag Could Not Be Loaded: " + errorThrown);
                        }
                    });
        });

        //On existing video misc tag button click add the tag and render it
        $(document).on("click", '.miscTagListExistingItemv', function (event) {

            //Get misc ID of clicked misc to tag
            var miscID = $(this).attr('id');

            //Get ID of video being edited
            var video_id = $(this).attr('data-videoID');

            $.ajax(
                    {
                        url: "libs/ajax/add_miscTagv.php",
                        type: "POST",
                        data: {miscID: miscID, video_id: video_id},
                        success: function (data, textStatus, jqXHR)
                        {
                            $('#miscTagExistingResultsv' + video_id).append(data);
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

        // When game existing tag X is clicked, remove the tag from the image
        $(document).on('click', '.gameTagRemove', function () {

            //Get value of clicked tags ID
            var gameID_pre = $(this).attr('id');
            var gameID = gameID_pre.slice(4);

            //get id of visible photo
            var photo_id = $(this).attr('data-photo');


            //remove selected tag from photo
            $.ajax(
                    {
                        url: "libs/ajax/remove_gameTag.php",
                        type: "POST",
                        data: {gameID: gameID, photo_id: photo_id},
                        success: function (data, textStatus, jqXHR)
                        {
                            //remove deleted tag
                            $('#' + gameID_pre).parent().remove();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Selected Tag Could Not Be Removed: " + errorThrown);
                        }
                    });

        });

        // When game existing tag X is clicked, remove the tag from the image
        $(document).on('click', '.gameTagRemovev', function () {

            //Get value of clicked tags ID
            var gameID_pre = $(this).attr('id');
            var gameID = gameID_pre.slice(4);


            var video_id = $(this).attr('data-video');


            //remove selected tag from video
            $.ajax(
                    {
                        url: "libs/ajax/remove_gameTagv.php",
                        type: "POST",
                        data: {gameID: gameID, video_id: video_id},
                        success: function (data, textStatus, jqXHR)
                        {
                            //remove deleted tag
                            $('#' + gameID_pre).parent().remove();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Selected Tag Could Not Be Removed: " + errorThrown);
                        }
                    });

        });

        // When misc existing tag X is clicked, remove the tag from the image
        $(document).on('click', '.miscTagRemove', function () {

            //Get value of clicked tags ID
            var miscID_pre = $(this).attr('id');
            var miscID = miscID_pre.slice(4);

            //get id of visible photo
            var photo_id = $(this).attr('data-photo');


            //remove selected tag from photo
            $.ajax(
                    {
                        url: "libs/ajax/remove_miscTag.php",
                        type: "POST",
                        data: {miscID: miscID, photo_id: photo_id},
                        success: function (data, textStatus, jqXHR)
                        {
                            //remove deleted tag
                            $('#' + miscID_pre).parent().remove();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Selected Tag Could Not Be Removed: " + errorThrown);
                        }
                    });

        });

        // When misc existing tag X for a video is clicked, remove the tag from the image
        $(document).on('click', '.miscTagRemovev', function () {

            //Get value of clicked tags ID
            var miscID_pre = $(this).attr('id');
            var miscID = miscID_pre.slice(4);

            //get id of visible video
            var video_id = $(this).attr('data-video');


            //remove selected tag from video
            $.ajax(
                    {
                        url: "libs/ajax/remove_miscTagv.php",
                        type: "POST",
                        data: {miscID: miscID, video_id: video_id},
                        success: function (data, textStatus, jqXHR)
                        {
                            //remove deleted tag
                            $('#' + miscID_pre).parent().remove();
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

        //When game upload tag X is clicked, alter the form value that contains the tags to upload
        $(document).on("click", '.gameUploadTagRemove', function (event) {

            //Get value of clicked tags ID
            var gameID = $(this).attr('id');

            var newTagArray = [];
            //explode new gamePhotoTag values
            var tagString = $('#gamePhotoTag').val()
            newTagArray = tagString.split(",");
            //removed matched tag from array
            var filteredArray = newTagArray.filter(function (value, index, arr) {

                return value != gameID;

            });
            //Set value of photo tags to be uploaded
            $('#gamePhotoTag').val(filteredArray);
            //remove the tag on screen
            $(this).parent().remove();

            var lockStatus = localStorage.getItem('OSU_Game_Tag_Lock');
            if (lockStatus === 'locked') {
                updateTagLockValues('game');
            }
        });

        //When game upload tag X is clicked for video, alter the form value that contains the tags to upload
        $(document).on("click", '.gameUploadTagRemovev', function (event) {

            //Get value of clicked tags ID
            var gameID = $(this).attr('id');

            var newTagArray = [];
            //explode new gamePhotoTag values
            var tagString = $('#gameVideoTag').val()
            newTagArray = tagString.split(",");
            //removed matched tag from array
            var filteredArray = newTagArray.filter(function (value, index, arr) {

                return value != gameID;

            });
            //Set value of photo tags to be uploaded
            $('#gameVideoTag').val(filteredArray);
            //remove the tag on screen
            $(this).parent().remove();

        });

        //When misc upload tag X is clicked, alter the form value that contains the tags to upload
        $(document).on("click", '.miscUploadTagRemove', function (event) {

            //Get value of clicked tags ID
            var miscID = $(this).attr('id');

            var newTagArray = [];
            //explode new miscPhotoTag values
            var tagString = $('#miscPhotoTag').val()
            newTagArray = tagString.split(",");
            //removed matched tag from array
            var filteredArray = newTagArray.filter(function (value, index, arr) {

                return value != miscID;

            });
            //Set value of photo tags to be uploaded
            $('#miscPhotoTag').val(filteredArray);
            //remove the tag on screen
            $(this).parent().remove();

        });

        //When misc video upload tag X is clicked, alter the form value that contains the tags to upload
        $(document).on("click", '.miscUploadTagRemovev', function (event) {

            //Get value of clicked tags ID
            var miscID = $(this).attr('id');

            var newTagArray = [];
            //explode new miscPhotoTag values
            var tagString = $('#miscVideoTag').val()
            newTagArray = tagString.split(",");
            //removed matched tag from array
            var filteredArray = newTagArray.filter(function (value, index, arr) {

                return value != miscID;

            });
            //Set value of photo tags to be uploaded
            $('#miscVideoTag').val(filteredArray);
            //remove the tag on screen
            $(this).parent().remove();

        });

        //On Add Misc Tag Click, Add New Tag to Database and Append a Rendering to the Tag List
        $(document).on("click", '.addMiscTag', function (event) {
            event.preventDefault();
            var newTag = $(this).attr('data-newTag');

            $.ajax(
                    {
                        url: "libs/ajax/add_new_MiscTag.php",
                        type: "POST",
                        data: {newTag: newTag},
                        success: function (data, textStatus, jqXHR)
                        {
                            location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Selected Tag Could Not Be Removed: " + errorThrown);
                        }
                    });


        });

        //On Add Misc Video Tag Click, Add New Tag to Database and Append a Rendering to the Tag List
        $(document).on("click", '.addMiscTagv', function (event) {
            event.preventDefault();
            var newTag = $(this).attr('data-newTag');

            $.ajax(
                    {
                        url: "libs/ajax/add_new_MiscTagv.php",
                        type: "POST",
                        data: {newTag: newTag},
                        success: function (data, textStatus, jqXHR)
                        {
                            location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Selected Tag Could Not Be Removed: " + errorThrown);
                        }
                    });


        });

        //On add video button click, register the video in the database
        $(document).on("click", '.addVideo', function (event) {

            var filePath = $(this).attr('data-path');

            $.ajax(
                    {
                        url: "libs/ajax/addVideo.php",
                        type: "POST",
                        data: {filePath: filePath},
                        success: function (data, textStatus, jqXHR)
                        {
                            location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Video Could Not Be Added: " + errorThrown);
                        }
                    });

        });

        //On remove video button click, delete the video in db and file
        $(document).on("click", '.removeVideo', function (event) {

            var video_ID = $(this).attr('data-vidid');

            $.ajax(
                    {
                        url: "libs/ajax/removeVideo.php",
                        type: "POST",
                        data: {video_ID: video_ID},
                        success: function (data, textStatus, jqXHR)
                        {
                            alert(data);
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Video Could Not Be Added: " + errorThrown);
                        }
                    });

        });

        //On remove web link button click, delete the site
        $(document).on("click", '.removeWebLink', function (event) {
            event.preventDefault();
            var ID = $(this).attr('id');

            $.ajax(
                    {
                        url: "libs/ajax/removeExistingSite.php",
                        type: "POST",
                        data: {ID: ID},
                        success: function (data, textStatus, jqXHR)
                        {
                            location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("The Site Could Not Be Removed: " + errorThrown);
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

    function enableTagLock(type) {

        if (type === 'game') {

            var lockStatus = localStorage.getItem('OSU_Game_Tag_Lock');

            if (lockStatus === 'locked') {
                $('#GameTagLockStatus').replaceWith('<div id="GameTagLockStatus"><span id="gameTagLockIcon" data-status="locked" class="oi oi-lock-locked"></span>&nbsp;&nbsp;Tag Games(s) In Uploaded Photo:</div>');
            } else {
                $('#GameTagLockStatus').replaceWith('<div id="GameTagLockStatus"><span id="gameTagLockIcon" data-status="unlocked" class="oi oi-lock-unlocked"></span>&nbsp;&nbsp;Tag Games(s) In Uploaded Photo:</div>');
            }
        }


    }

    function updateTagLockValues(type) {

        if (type === 'game') {
            var gameTags = $('#gamePhotoTag').val();
            localStorage.setItem('OSU_Game_Tag_Lock_Value', gameTags);
        }
    }
</script>