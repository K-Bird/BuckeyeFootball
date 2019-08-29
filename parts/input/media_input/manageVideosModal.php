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