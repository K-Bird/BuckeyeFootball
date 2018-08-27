<?php

include ("../../libs/db/common_db_functions.php");

$coachID = $_POST['coachID'];

db_query("DELETE FROM `coaches` WHERE Coach_ID='{$coachID}'");