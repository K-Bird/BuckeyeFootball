<?php

include ("../../libs/db/common_db_functions.php");

$name = $_POST['name'];
$type = $_POST['type'];
$subtype = $_POST['subtype'];

db_query("INSERT INTO `game_types` (`Name`, `Type`,`Sub_Type`) VALUES ('{$name}','{$type}','{$subtype}')");