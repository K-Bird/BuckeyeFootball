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
    <div class="col-lg-1">
        <div class="nav flex-column nav-pills" id="photo-tab-subnav" role="tablist">
            <a class="nav-link" id="photo-tab-subnav-players" data-toggle="pill" href="#photoTabPlayers" role="tab" aria-controls="v-pills-home" aria-selected="true">Players</a>
            <a class="nav-link" id="photo-tab-subnav-games" data-toggle="pill" href="#photoTabGames" role="tab" aria-controls="v-pills-profile" aria-selected="false">Games</a>
            <a class="nav-link" id="photo-tab-subnav-misc" data-toggle="pill" href="#photoTabMisc" role="tab" aria-controls="v-pills-messages" aria-selected="false">Misc</a>
        </div>
    </div>
    <div class="col-lg-11">
        <div class="tab-content" id="photo-tabContent">
            <div id="photoTabPlayers" class="tab-pane fade" role="tabpanel">
                <div class="row">
                    <div class="col-lg-8">
                        <?php displayPlayerPhotoSelect($player_photo_ID); ?>
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
</div>
<div id="editTagsModalContainer">
</div>