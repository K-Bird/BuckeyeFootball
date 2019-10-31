<?php
include ("../../libs/db/common_db_functions.php");

$Master_ID = $_POST['Master_ID'];
?>

<div class="row">
    <div class="col-lg-12">
        <?php
            echo returnGameLog($Master_ID);
        ?>
    </div>
</div>