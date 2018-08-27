<?php

include ("../../libs/db/common_db_functions.php");

$divID = $_POST['divID'];

db_query("DELETE FROM `b10_divisions` WHERE Div_ID='{$divID}'");