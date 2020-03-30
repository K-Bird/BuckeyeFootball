<?php
$getPhotoPlayerID = db_query("SELECT * FROM `controls` WHERE Control='photo_player_id'");
$fetchPhotoPlayerID = $getPhotoPlayerID->fetch_assoc();
$player_photo_ID = $fetchPhotoPlayerID['Value'];

$getPhotoGameID = db_query("SELECT * FROM `controls` WHERE Control='photo_game_id'");
$fetchPhotoGameID = $getPhotoGameID->fetch_assoc();
$game_photo_ID = $fetchPhotoGameID['Value'];

$getPhotoMiscID = db_query("SELECT * FROM `controls` WHERE Control='photo_misc_id'");
$fetchPhotoMiscID = $getPhotoMiscID->fetch_assoc();
$misc_photo_ID = $fetchPhotoMiscID['Value'];
?>
<!-- gg-screen enables the lightbox effect -->
<div id="gg-screen"></div>
<br><br>
<div class="row">
    <div class="col-lg-2">
        <div class="nav flex-column nav-pills" id="photo-tab-subnav" role="tablist">
            <a class="nav-link" id="photo-tab-subnav-players" data-toggle="pill" href="#photoTabPlayers" role="tab" aria-controls="v-pills-home" aria-selected="true">Players</a>
            <a class="nav-link" id="photo-tab-subnav-games" data-toggle="pill" href="#photoTabGames" role="tab" aria-controls="v-pills-profile" aria-selected="false">Games</a>
            <a class="nav-link" id="photo-tab-subnav-misc" data-toggle="pill" href="#photoTabMisc" role="tab" aria-controls="v-pills-messages" aria-selected="false">Misc</a>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="tab-content" id="photo-tabContent">
            <div id="photoTabPlayers" class="tab-pane fade" role="tabpanel">
                <div class="row">
                    <div class="col-lg-8">
                        <?php displayPlayerPhotoSelect($player_photo_ID); ?>
                        <button id="editPlayerTagsBtn" class="btn btn-warning" data-toggle="modal" data-target="#editTagsModal">Edit Tags</button>
                        <br>
                        <br>
                        <div id="playerPhotoGallery">
                            <div id="playerPhotoGalleryBox" class="gg-box">
                                <?php buildPlayerPhotoGallery($player_photo_ID) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="photoTabGames" role="tabpanel">
                <div class="row">
                    <div class="col-lg-8">
                        <?php displayGamePhotoSelect($game_photo_ID); ?>
                        <button id="editGameTagsBtn" class="btn btn-warning" data-toggle="modal" data-target="#editTagsModal">Edit Tags</button>
                        <br>
                        <br>
                        <div id="gamePhotoGallery">
                            <div id="gamePhotoGalleryBox" class="gg-box">
                                <?php buildGamePhotoGallery($game_photo_ID) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="photoTabMisc" role="tabpanel">
                <div class="row">
                    <div class="col-lg-8">
                        <?php displayMiscPhotoSelect($misc_photo_ID); ?>
                        <button id="editMiscTagsBtn" class="btn btn-warning" data-toggle="modal" data-target="#editTagsModal">Edit Tags</button>
                        <br>
                        <br>
                        <div id="miscPhotoGallery">
                            <div id="miscPhotoGalleryBox" class="gg-box">
                                <?php buildMiscPhotoGallery($misc_photo_ID) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
        <form id="uploadPhotoForm" class="form-horizontal" action="libs/ajax/uploadPhoto.php" method="post" enctype="multipart/form-data">
            <div class="form-inline">
                Choose Photo:&nbsp;&nbsp;
                <input id="photoFile" class="form-control" type="file" name="myfile">
            </div>
            <div class="form-group">
                <br>
                Tag Player(s) In Uploaded Photo:&nbsp;&nbsp;
                <input type="text" class="form-control" id="playerTagSearchUpload" placeholder="Search for Player By Name"/>
                <div id="playerTagResults"></div>
                Tagged Players:&nbsp;&nbsp;
                <div id="playerTagSelected"></div>
                <br>
                <div id="GameTagLockStatus"></div>
                <input id="gamesSearchYear" class="form-control gamesSearchField" placeholder="Search Year">
                <input id="gamesSearchOpp" class="form-control gamesSearchField" placeholder="Search Opponent">
                <input id="gamesSearchLoc" class="form-control gamesSearchField" placeholder="Search Location">
                <div id="gameTagResults"></div>
                Tagged Games:&nbsp;&nbsp;
                <div id="gameTagSelected"></div>
                <br>
                Misc Tag(s) In Uploaded Photo:&nbsp;&nbsp;
                <input type="text" class="form-control" id="miscTagSearchUpload" placeholder="Search for Tag By Name"/>
                <div id="miscTagResults"></div>
                Misc Tag(s):&nbsp;&nbsp;
                <div id="miscTagSelected"></div>
                <br>
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit" name="submit">Upload File</button>
            </div>
            <input id="playerPhotoTag" type="hidden" name="playerPhotoTag[]" value=""/>
            <input id="gamePhotoTag" type="hidden" name="gamePhotoTag[]" value=""/>
            <input id="miscPhotoTag" type="hidden" name="miscPhotoTag[]" value=""/>
        </form>
    </div>
    <div class="col-lg-1">
        
    </div>
</div>
<div id="editTagsModalContainer">
</div>