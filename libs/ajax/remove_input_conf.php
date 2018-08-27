<?php

include ("../../libs/db/common_db_functions.php");

$confID = $_POST['confID'];

db_query("DELETE FROM `conferences` WHERE Conf_ID='{$confID}'");