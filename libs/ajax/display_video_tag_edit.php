<?php
include ("../../libs/db/common_db_functions.php");

$Video_ID = $_POST['Video_ID'];
?>
<div id="editVideoTagsContent">
    <div class="row" style="text-align: center">
        <div class="col-lg-12">
            <table id="editVideoTagsTable" class="table" style="border: none">
                <thead>
                    <tr>
                        <th>Game Tags</th><th>Misc Tags</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php echo returnVideoTags($Video_ID, 'game'); ?>
                        </td>
                        <td>
                            <?php echo returnVideoTags($Video_ID, 'misc'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            echo 'Tag Games In Uploaded Video:&nbsp;&nbsp;';
                            echo '<input id="existingGamesSearchYearv' . $Video_ID . '" class="form-control existingGamesSearchFieldv" data-videoID="' . $Video_ID . '" placeholder="Search Year">';
                            echo '<input id="existingGamesSearchOppv' . $Video_ID . '" class="form-control existingGamesSearchFieldv" data-videoID="' . $Video_ID . '" placeholder="Search Opponent">';
                            echo '<input id="existingGamesSearchLocv' . $Video_ID . '" class="form-control existingGamesSearchFieldv" data-videoID="' . $Video_ID . '" placeholder="Search Location">';
                            echo '<div id="existingGameTagResultsv' . $Video_ID . '"></div>';
                            ?>
                        </td>
                        <td>
                            <?php
                            echo '<br>Add Misc Tag In Uploaded Video:&nbsp;&nbsp;
                                <input category="text" class="form-control miscTagSearchDisplayedv" id="editAddMiscTagSearchv', $Video_ID . '" data-videoID="' . $Video_ID . '" placeholder="Search for Misc Tag"/>
                                    <div id="miscTagExistingResultsv' . $Video_ID . '" class="editAddMiscTagResultsv"></div>';
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
