<?php
include ("../../libs/db/common_db_functions.php");

$GM_ID = $_POST['GM_ID'];

?>
<div class="row" style="text-align: center">
    <div class="col-lg-12">
        <?php
        buildVideoGallery($GM_ID, 'game');
        ?>
    </div>
</div>
