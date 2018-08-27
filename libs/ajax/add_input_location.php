<?php

include ("../../libs/db/common_db_functions.php");

$newStadium = $_POST['stadium'];
$newCity = $_POST['city'];
$newState = $_POST['state'];

db_query("INSERT INTO `locations` (`Stadium`, `City`, `State`) VALUES ('{$newStadium}','{$newCity}','{$newState}')");