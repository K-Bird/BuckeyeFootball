<?php

include ("../../libs/db/common_db_functions.php");

$locID = $_POST['locID'];

db_query("DELETE FROM `locations` WHERE Loc_ID='{$locID}'");