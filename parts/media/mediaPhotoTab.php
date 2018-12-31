<?php
$getPhotoPlayerID = db_query("SELECT * FROM `controls` WHERE Control='photo_player_id'");
$fetchPhotoPlayerID = $getPhotoPlayerID->fetch_assoc();
$player_photo_ID = $fetchPhotoPlayerID['Value'];
?>
<br><br>
<div class="row">
    <div class="col-lg-2">
        <div class="nav flex-column nav-pills" id="photo-tab-subnav" role="tablist">
            <a class="nav-link" id="photo-tab-subnav-players" data-toggle="pill" href="#photoTabPlayers" role="tab" aria-controls="v-pills-home" aria-selected="true">Players</a>
            <a class="nav-link" id="photo-tab-subnav-games" data-toggle="pill" href="#photoTabGames" role="tab" aria-controls="v-pills-profile" aria-selected="false">Games</a>
            <a class="nav-link" id="photo-tab-subnav-misc" data-toggle="pill" href="#photoTabMisc" role="tab" aria-controls="v-pills-messages" aria-selected="false">Misc</a>
        </div>
    </div>
    <div class="col-lg-10">
        <div class="tab-content" id="photo-tabContent">
            <div id="photoTabPlayers" class="tab-pane fade" role="tabpanel">
                <div class="row">
                    <div class="col-lg-8">
                        <?php displayPlayerPhotoSelect($player_photo_ID); ?>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#editTagsModal">Edit Tags</button>
                        <br>
                        <br>
                        <!-- gg-screen enables the lightbox effect -->
                        <div id="gg-screen"></div>
                        <div id="playerPhotoGallery">
                            <div id="playerPhotoGalleryBox" class="gg-box">
                                <?php buildPlayerPhotoGallery($player_photo_ID) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <br><br><br>
                        <form id="uploadPhotoForm" class="form-horizontal" action="libs/ajax/uploadPhoto.php" method="post" enctype="multipart/form-data">
                            <div class="form-inline">
                                Choose Photo:&nbsp;&nbsp;
                                <input id="photoFile" class="form-control" type="file" name="myfile">
                            </div>
                            <div class="form-group">
                                <br>
                                Tag Player(s) In Uploaded Photo:&nbsp;&nbsp;
                                <input type="text" class="form-control" id="playerTagSearchUpload" placeholder="Search for Player"/>
                                <div id="playerTagResults"></div>
                            </div>
                            <div class="form-group">
                                Tagged Players:&nbsp;&nbsp;
                                <div id="playerTagSelected"></div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit" name="submit">Upload File</button>
                            </div>
                            <input id="playerPhotoTag" type="hidden" name="playerPhotoTag[]" value=""/>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="photoTabGames" role="tabpanel">2</div>
            <div class="tab-pane fade" id="photoTabMisc" role="tabpanel">3</div>
        </div>
    </div>
</div>
<div id="editTagsModalContainer">
</div>