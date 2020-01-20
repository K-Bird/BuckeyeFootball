<?php

include ("../../libs/db/common_db_functions.php");

$rowID = $_POST['recruitRow'];

db_query("DELETE FROM `recruits` WHERE Recruit_ID='{$rowID}'");

