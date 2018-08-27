<?php

include ("../../libs/db/common_db_functions.php");

$ID = $_POST['ID'];

db_query("DELETE FROM `game_types` WHERE Type_ID='{$ID}'");