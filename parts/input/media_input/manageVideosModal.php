<div class="modal fade" id="manageVideosModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="max-width: 80%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Manage Videos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $fileList = glob(getcwd() . "/libs/video/uploaded/*");
                ?>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Video Name</th><th>Game Tags</th><th>Misc Tags</th><th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($fileList as $filename) {

                            $found = false;
                            $video_ID = '';

                            $getCheckVideos = db_query("SELECT * FROM `videos`");

                            while ($fetchCheckVideos = $getCheckVideos->fetch_assoc()) {

                                $checkVideo = $fetchCheckVideos['Video_Name'] . "." . $fetchCheckVideos['Extension'];

                                if (basename($filename) === $checkVideo) {
                                    $found = true;
                                    $video_ID = $fetchCheckVideos['Video_ID'];
                                }
                            }


                            echo '<tr>';
                            echo '<td id="manageVidName">';
                            echo basename($filename);
                            echo '</td>';
                            echo '<td id="gameTagsv'.$video_ID.'">';

                            if ($found) {
                                returnVideoTags($video_ID, 'game');
                            }

                            echo '</td>';
                            echo '<td>';

                            if ($found) {
                                returnVideoTags($video_ID, 'misc');
                            }

                            echo '</td>';
                            echo '<td>';

                            if ($found) {
                                echo '<button class="btn btn-danger removeVideo" data-vidid="'.$video_ID.'">Remove</button>';
                            } else {
                                echo '<button class="btn btn-success addVideo" data-path="'.$filename.'">Add</button>';
                            }

                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
//Build the tags for displaying on a video of any category
function returnVideoTags($video_id, $category) {

    $getVideoTags = db_query("SELECT * FROM `videos` WHERE Video_ID='{$video_id}'");
    $fetchVideotag = $getVideoTags->fetch_assoc();

    if ($category === 'game') {
        $gameTags = $fetchVideotag['Game_Tags'];

        if ($gameTags === '') {
            echo 'Tag Games(s) In Uploaded Video:&nbsp;&nbsp;';
            echo '<input id="existingGamesSearchYearv' . $video_id . '" class="form-control existingGamesSearchFieldv" data-videoID="' . $video_id . '" placeholder="Search Year">';
            echo '<input id="existingGamesSearchOppv' . $video_id . '" class="form-control existingGamesSearchFieldv" data-videoID="' . $video_id . '" placeholder="Search Opponent">';
            echo '<input id="existingGamesSearchLocv' . $video_id . '" class="form-control existingGamesSearchFieldv" data-videoID="' . $video_id . '" placeholder="Search Location">';
            echo '<div id="existingGameTagResultsv' . $video_id . '"></div>';
        } else {

            echo 'Tag Games(s) In Uploaded Video:&nbsp;&nbsp;';
            echo '<input id="existingGamesSearchYearv' . $video_id . '" class="form-control existingGamesSearchFieldv" data-videoID="' . $video_id . '" placeholder="Search Year">';
            echo '<input id="existingGamesSearchOppv' . $video_id . '" class="form-control existingGamesSearchFieldv" data-videoID="' . $video_id . '" placeholder="Search Opponent">';
            echo '<input id="existingGamesSearchLocv' . $video_id . '" class="form-control existingGamesSearchFieldv" data-videoID="' . $video_id . '" placeholder="Search Location">';
            echo '<div id="existingGameTagResultsv' . $video_id . '"></div>';

            $eachTag = explode(',', $gameTags);

            foreach ($eachTag as $tag) {
                echo '<span class="badge badge-pill badge-secondary">';

                $getGameData = db_query("SELECT * FROM `games` WHERE GM_ID='{$tag}'");
                $fetchGameData = $getGameData->fetch_assoc();

                echo $fetchGameData['Date'] . " - (" . HomeAwayLookup($fetchGameData ['H_A']) . ") Vs " . opponentLookup($fetchGameData['Vs']);

                echo '&nbsp;<span aria-hidden="true" data-video="', $video_id, '" id="gtag', $tag, '" class="gameTagRemovev">&times;</span>';
                echo '</span>';
            }
        }
    }

    if ($category === 'misc') {
        $miscTags = $fetchVideotag['Misc_Tags'];

        if ($miscTags === '') {

            echo '<br>Misc Tag(s) In This Photo:&nbsp;&nbsp;
              <input category="text" class="form-control miscTagSearchDisplayedv" id="editAddMiscTagSearchv', $video_id . '" data-videoID="' . $video_id . '" placeholder="Search for Misc Tag"/>
              <div id="miscTagExistingResultsv' . $video_id . '" class="editAddMiscTagResultsv"></div>';
        } else {

            echo '<br>Misc Tag(s) In This Photo:&nbsp;&nbsp;
              <input category="text" class="form-control miscTagSearchDisplayedv" id="editAddMiscTagSearchv', $video_id . '" data-videoID="' . $video_id . '" placeholder="Search for Misc Tag"/>
              <div id="miscTagExistingResultsv' . $video_id . '" class="editAddMiscTagResultsv"></div>';

            $eachTag = explode(',', $miscTags);

            foreach ($eachTag as $tag) {
                echo '<span class="badge badge-pill badge-secondary">';

                echo returnMiscTagNameByIDvideo($tag);

                echo '&nbsp;<span aria-hidden="true" data-video="', $video_id, '" id="gtag', $tag, '" class="miscTagRemovev">&times;</span>';
                echo '</span>';
            }
        }
    }
}