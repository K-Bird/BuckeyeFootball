<?php
include ("../../libs/db/common_db_functions.php");

$refreshType = $_GET['type'];

if ($refreshType === 'player') {
    $player_photo_ID = $_GET['playerID'];
}
if ($refreshType === 'game') {
    $game_photo_ID = $_GET['gameID'];
}
?>
<div class="modal fade" id="editTagsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Tags</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                if ($refreshType === 'player') {
                    buildEditTagsBody($player_photo_ID, 'player');
                }
                if ($refreshType === 'game') {
                    buildEditTagsBody($game_photo_ID, 'game');
                }
                ?>
            </div>
        </div>
    </div>
</div>