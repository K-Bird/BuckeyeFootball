<?php
include ("../../libs/db/common_db_functions.php");

$GM_ID = $_POST['GM_ID'];
?>
<!-- gg-screen enables the lightbox effect -->
<div id="gg-screen"></div>
<div id="GMdetailsPhotoGallery">
    <div id="GMdetailsPhotoGalleryBox" class="gg-box">
        <?php buildGamePhotoGallery($GM_ID); ?>   
    </div>
</div>

