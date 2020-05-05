<br><br>
<?php
$getVideoID = db_query("SELECT * FROM `controls` WHERE Control='input_video_id'");
$fetchVideoID = $getVideoID->fetch_assoc();
$video_ID = $fetchVideoID['Value'];

$getVideoDisplayType = db_query("SELECT * FROM `controls` WHERE Control='input_video_display_type'");
$fetchVideoDisplayType = $getVideoDisplayType->fetch_assoc();
$display_type = $fetchVideoDisplayType['Value'];
?>
<div class="row">
    <div class="col-lg-3">
        <button id="displayAllVideos" class="btn btn-primary">Show All Videos</button>
    </div>
    <div class="col-lg-3">
        Filter By Game:
        <?php echo displayGameVideoSelect(); ?>
    </div>
    <div class="col-lg-3">
        Filter By Tag:
        <?php echo displayVideoMiscSelect(); ?>
    </div>
    <div class="col-lg-3">
        <button id="displayNotAddedVideos" class="btn btn-primary">Show Not Added Videos</button>
    </div>
</div>
<br><br>
<div class="row">
    <div class="col-lg-1">

    </div>
    <div class="col-lg-10">
        <table id="allVideosTable" class="table table-sm table-hover">
            <thead>
                <tr>
                    <th>ID</th><th>Description</th><th>Game Tags</th><th>Misc Tags</th><th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($display_type === 'not') {

                   echo displayNotAdded();
                }

                if ($display_type === 'game') {

                    $taggedVideos = taggedVideoIDs($video_ID, 'game');

                    foreach ($taggedVideos as $video_id) {

                        $getVideoResult = db_query("SELECT * FROM `videos` WHERE Video_ID='{$video_id}'");
                        $fetchVideoResult = $getVideoResult->fetch_assoc();
                        displayVideoRow($fetchVideoResult);
                    }
                }

                if ($display_type === 'misc') {
                    $taggedVideos = taggedVideoIDs($video_ID, 'misc');

                    foreach ($taggedVideos as $video_id) {

                        $getVideoResult = db_query("SELECT * FROM `videos` WHERE Video_ID='{$video_id}'");
                        $fetchVideoResult = $getVideoResult->fetch_assoc();
                        displayVideoRow($fetchVideoResult);
                    }
                }

                if ($display_type === 'all') {

                    echo displayNotAdded();

                    //display all uploaded/connected videos
                    $getAllVideos = db_query("SELECT * from `videos`");
                    while ($fetchAllVideos = $getAllVideos->fetch_assoc()) {

                        echo '<tr>';
                        echo '<td>';
                        echo $fetchAllVideos['Video_ID'];
                        echo '</td>';
                        echo '<td>';
                        echo '<input id="' . $fetchAllVideos['Video_ID'] . '" type="text" placeholder="' . $fetchAllVideos['Des'] . '" class="form-control videoDes" />';
                        echo '</td>';
                        echo '<td>';
                        echo returnVideoTags($fetchAllVideos['Video_ID'], 'game');
                        echo '</td>';
                        echo '<td>';
                        echo returnVideoTags($fetchAllVideos['Video_ID'], 'misc');
                        echo '</td>';
                        echo '<td>';
                        echo '<button id="viewVideoBtn" class="btn btn-outline-primary" data-toggle="modal" data-target="#viewVideoModal" data-videoID="', $fetchAllVideos['Video_ID'], '" data-des="', $fetchAllVideos['Des'], '">View Video</button>';
                        echo '&nbsp;';
                        echo '<button id="manageVideoTagsBtn" class="btn btn-warning" data-toggle="modal" data-target="#manageVideoTagsModal" data-videoID="', $fetchAllVideos['Video_ID'], '" data-des="', $fetchAllVideos['Des'], '">Manage Tags</button>';
                        echo '&nbsp;';
                        echo '<button class="btn btn-danger removeVideo" data-vidid="' . $fetchAllVideos['Video_ID'] . '">Remove</button>';
                        echo '</td>';
                        echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="col-lg-1">

    </div>
</div>
<?php
include ('manageVideoTagsModal.php');
include ('viewVideoModal.php');

function displayVideoRow($videoResult) {

    echo '<tr>';
    echo '<td>';
    echo $videoResult['Video_ID'];
    echo '</td>';
    echo '<td>';
    echo '<input id="' . $videoResult['Video_ID'] . '" type="text" placeholder="' . $videoResult['Des'] . '" class="form-control videoDes" />';
    echo '</td>';
    echo '<td>';
    echo returnVideoTags($videoResult['Video_ID'], 'game');
    echo '</td>';
    echo '<td>';
    echo returnVideoTags($videoResult['Video_ID'], 'misc');
    echo '</td>';
    echo '<td>';
    echo '<button id="viewVideoBtn" class="btn btn-outline-primary" data-toggle="modal" data-target="#viewVideoModal" data-videoID="', $videoResult['Video_ID'], '" data-des="', $videoResult['Des'], '">View Video</button>';
    echo '&nbsp;';
    echo '<button id="manageVideoTagsBtn" class="btn btn-warning" data-toggle="modal" data-target="#manageVideoTagsModal" data-videoID="', $videoResult['Video_ID'], '" data-des="', $videoResult['Des'], '">Manage Tags</button>';
    echo '&nbsp;';
    echo '<button class="btn btn-danger removeVideo" data-vidid="' . $videoResult['Video_ID'] . '">Remove</button>';
    echo '</td>';
    echo '</tr>';
}

function displayNotAdded() {

    $fileList = glob(getcwd() . "/libs/video/uploaded/*");

    foreach ($fileList as $filename) {

        $found = false;

        $getCheckVideos = db_query("SELECT * from `videos`");

        while ($fetchCheckVideos = $getCheckVideos->fetch_assoc()) {

            $checkVideo = $fetchCheckVideos['Video_Name'] . "." . $fetchCheckVideos['Extension'];

            if (basename($filename) === $checkVideo) {
                $found = true;
            }
        }
        if ($found === false) {
            echo '<tr class="table-danger">';
            echo '<td>';
            echo '</td>';
            echo '<td id="manageVidName">';
            echo 'Not Added: ' . basename($filename);
            echo '</td>';
            echo '<td colspan="2">';
            echo '</td>';
            echo '<td>';
            echo '<button class="btn btn-success addVideo" data-path="' . $filename . '">Add Video</button>';
            echo '</td>';
            echo '</tr>';
        }
    }
}
