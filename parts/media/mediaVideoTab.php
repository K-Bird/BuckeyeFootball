<br><br>
<?php
$getVideoID = db_query("SELECT * FROM `controls` WHERE Control='video_id'");
$fetchVideoID = $getVideoID->fetch_assoc();
$video_ID = $fetchVideoID['Value'];

$getVideoDisplayType = db_query("SELECT * FROM `controls` WHERE Control='video_display_type'");
$fetchVideoDisplayType = $getVideoDisplayType->fetch_assoc();
$display_type = $fetchVideoDisplayType['Value'];
?>
<div class="row" style="text-align: center">
    <div class="col-lg-4">
        <button id="displayAllVideos" class="btn btn-primary">Show All Videos</button>
    </div>
    <div class="col-lg-4">
        Filter By Game:
        <?php echo displayGameVideoSelect(); ?>
    </div>
    <div class="col-lg-4">
        Filter By Tag:
        <?php echo displayVideoMiscSelect(); ?>
    </div>
</div>
<br><br>
<div class="row">
    <div class="col-lg-2">

    </div>
    <div class="col-lg-8">
        <?php
        buildVideoGallery($video_ID, $display_type);
        ?>
    </div>
    <div class="col-lg-2">

    </div>
</div>