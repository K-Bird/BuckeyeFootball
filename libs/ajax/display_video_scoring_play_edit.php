<?php
include ("../../libs/db/common_db_functions.php");
include ('../../parts/common_inputs.php');

$Video_ID = $_POST['Video_ID'];
?>
<div id="editScoringPlayContent">
    <div class="row">
        <div class="col-lg-5">
            <?php
            $getDecades = db_query("SELECT * FROM `decades` ORDER BY Decade_Row DESC");
            while ($fetchDecades = $getDecades->fetch_assoc()) {

                echo '<span class="badge badge-dark">' . $fetchDecades['DecadeName'] . '</span>&nbsp;';

                $getSeasons = db_query("SELECT * FROM `seasons` WHERE Decade_ID='{$fetchDecades['Decade_Row']}' ORDER BY Year ASC");
                $num_years = mysqli_num_rows($getSeasons);
                $i = 0;
                while ($fetchSeasons = $getSeasons->fetch_assoc()) {
                    if (++$i === $num_years) {
                        echo '<a href="#" class="scorePlayYear" data-seasonID="', $fetchSeasons['Season_ID'], '">' . $fetchSeasons['Year'] . '</a>';
                    } else {
                        echo '<a href="#" class="scorePlayYear" data-seasonID="', $fetchSeasons['Season_ID'], '">' . $fetchSeasons['Year'] . '</a>&nbsp;&middot;&nbsp;';
                    }
                }
                echo '<br>';
            }
            ?>
        </div>
        <div class="col-lg-3">
            <div id="scorePlayGamesResults"></div>
        </div>
        <div class="col-lg-4">
            <div id="scoringPlayResults"></div>
        </div>
    </div>
</div>
