<br><br>
<?php
$getVideoGameID = db_query("SELECT * FROM `controls` WHERE Control='video_game_id'");
$fetchVideoGameID = $getVideoGameID->fetch_assoc();
$game_video_ID = $fetchVideoGameID['Value'];

$getVideoMiscID = db_query("SELECT * FROM `controls` WHERE Control='video_misc_id'");
$fetchVideoMiscID = $getVideoMiscID->fetch_assoc();
$misc_video_ID = $fetchVideoMiscID['Value'];

$getVideoDisplayType = db_query("SELECT * FROM `controls` WHERE Control='video_display_type'");
$fetchVideoDisplayType = $getVideoDisplayType->fetch_assoc();
$display_type = $fetchVideoDisplayType['Value'];
?>
<div class="row">
    <div class="col-lg-1">
        
    </div>
    <div class="col-lg-5">
        <div class="row">
            <?php displayGameVideoSelect($game_video_ID) ?>
            &nbsp;&nbsp;
            <?php displayVideoMiscSelect() ?>
            &nbsp;&nbsp;
            <button class="btn btn-warning" data-toggle="modal" data-target="#manageVideosModal">Manage Videos</button>
        </div>
        <br><br>
        <div class="row">
            <?php
            if ($display_type === 'game') {
                buildVideosDisplay($display_type, $game_video_ID);
            }
            if ($display_type === 'misc') {
                buildVideosDisplay($display_type, $misc_video_ID);
            }
            ?>
        </div>
    </div>
    <div class="col-lg-1">
        
    </div>
    <div class="col-lg-3">
        <br><br><br>
        <form id="uploadVideoForm" class="form-horizontal" action="libs/ajax/uploadVideo.php" method="post" enctype="multipart/form-data">
            <div class="form-inline">
                Choose Video:&nbsp;&nbsp;
                <input id="videoFile" class="form-control" type="file" name="myfile">
            </div>
            <br>
            <div class="form-group">
                Tag Games(s) In Uploaded Video:&nbsp;&nbsp;
                <input id="gamesSearchYearv" class="form-control gamesSearchFieldv" placeholder="Search Year">
                <input id="gamesSearchOppv" class="form-control gamesSearchFieldv" placeholder="Search Opponent">
                <input id="gamesSearchLocv" class="form-control gamesSearchFieldv" placeholder="Search Location">
                <div id="gameTagResultsv"></div>
                Tagged Games:&nbsp;&nbsp;
                <div id="gameTagSelectedv"></div>
                <br>
                Misc Tag(s) In Uploaded Video:&nbsp;&nbsp;
                <input type="text" class="form-control" id="miscTagSearchUploadv" placeholder="Search for Tag By Name"/>
                <div id="miscTagResultsv"></div>
                Misc Tag(s):&nbsp;&nbsp;
                <div id="miscTagSelectedv"></div>
                <br>
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit" name="submit">Upload File</button>
            </div>
            <input id="gameVideoTag" type="hidden" name="gameVideoTag[]" value=""/>
            <input id="miscVideoTag" type="hidden" name="miscVideoTag[]" value=""/>
            <input type="hidden" value="myForm" name="<?php echo ini_get("session.upload_progress.name"); ?>">
        </form>
    </div>
    <div class="col-lg-2">
        
    </div>
</div>
<?php include ('manageVideosModal.php'); ?>