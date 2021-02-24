<?php
include ("../../libs/db/common_db_functions.php");

$season_year = $_POST['currYear'];

$checkSeasonExists = db_query("SELECT * FROM `seasons` WHERE Year='{$season_year}'");
    if (mysqli_num_rows($checkSeasonExists) > 0) {
        echo "TRUE";
    } else {
        echo "FALSE";
    }
