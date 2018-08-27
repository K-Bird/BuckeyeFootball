<?php

include ("../../libs/db/common_db_functions.php");

$oppID = $_POST['oppID'];

db_query("DELETE FROM `opponents` WHERE Team_ID='{$oppID}'");