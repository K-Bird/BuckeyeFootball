<?php
include ("../../libs/db/common_db_functions.php");
include ('../../parts/common_inputs.php');
?>

<div  id="boxScoreControls" class="row" style="text-align: center">
    <div class="col-lg-6">
        <span class="badge badge-dark">Select Game By Season:</span><br><br>
        <?php echo buildYearSelector(); ?>
    </div>
    <div class="col-lg-4">
        <div id="boxGamesResults"></div>
    </div>
    <div class="col-lg-2">

    </div>
</div>