<!-- Modal -->
<div class="modal fade" id="addSecondaryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Secondary <?php echo $InputPosGroup; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align: center">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="addSecondaryPosition" class="form-inline">
                            <?php displayExistingPlayersSelect($Season_ID,"addSecondary"); ?>
                            &nbsp;
                            <button id="submitSecondaryPosition" class="btn btn-success" type="submit">Add as <?php if ($InputPosGroup === 'OL' || $InputPosGroup === 'DL' || $InputPosGroup === 'LB') { echo ''; } else { echo $InputPosGroup; } ?></button>
                            &nbsp;
                            <?php displayPosGroupSelect($InputPosGroup); ?>
                            <input type="hidden" id="secondaryPos" value="<?php echo $InputPosGroup; ?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>