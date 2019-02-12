<?php
include ("../../libs/db/common_db_functions.php");

$Master_ID = $_POST['Master_ID'];
?>
<!-- gg-screen enables the lightbox effect -->
<div id="gg-screen"></div>
<div id="playerDetailsPhotoGallery">
    <div id="playerDetailsPhotoGalleryBox" class="gg-box">
        <?php buildPlayerPhotoGallery($Master_ID); ?>   
    </div>
</div>

