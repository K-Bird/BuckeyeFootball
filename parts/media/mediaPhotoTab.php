<?php

$getPhotoPlayerID = db_query("SELECT * FROM `controls` WHERE Control='photo_player_id'");
$fetchPhotoPlayerID = $getPhotoPlayerID->fetch_assoc();
$player_photo_ID = $fetchPhotoPlayerID['Value'];

?>
<br><br>
<div class="row">
    <div class="col-lg-2">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist">
            <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#photoTabPlayers" role="tab" aria-controls="v-pills-home" aria-selected="true">Players</a>
            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#photoTabGames" role="tab" aria-controls="v-pills-profile" aria-selected="false">Games</a>
            <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#photoTabMisc" role="tab" aria-controls="v-pills-messages" aria-selected="false">Misc</a>
        </div>
    </div>
    <div class="col-lg-10">
        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade" id="photoTabPlayers" role="tabpanel">
                <div class="row">
                    <div class="col-lg-10">
                        <?php displayPlayerPhotoSelect('$currentPlayer'); ?>
                        <br>
                        <?php echo buildCarousel('playerPhotos'); ?>
                    <!-- <input type="file" id="fileinput" multiple="multiple" accept="image/*" /> -->
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="photoTabGames" role="tabpanel">2</div>
            <div class="tab-pane fade" id="photoTabMisc" role="tabpanel">3</div>
        </div>
    </div>
</div>