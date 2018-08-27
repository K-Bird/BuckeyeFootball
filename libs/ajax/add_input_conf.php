<?php

include ("../../libs/db/common_db_functions.php");

$name = $_POST['name'];
$abbrev = $_POST['abbrev'];

db_query("INSERT INTO `conferences` (`Conf_Name`, `Conf_Abbrev`) VALUES ('{$name}','{$abbrev}')");