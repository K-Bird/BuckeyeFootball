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
    <div class="col-lg-2">
        Select Video By Game:<br>
        <?php displayGameVideoSelect($game_video_ID) ?>
    </div>
    <div class="col-lg-6">
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
    <div class="col-lg-2">
        Select Video By Tag:<br>
        <?php displayVideoMiscSelect() ?>
    </div>
    <div class="col-lg-1">

    </div>
</div>