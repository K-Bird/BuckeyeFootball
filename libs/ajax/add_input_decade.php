<?php

include ("../../libs/db/common_db_functions.php");

$name = $_POST['name'];
$start = $_POST['start'];
$end = $_POST['end'];

db_query("INSERT INTO `decades` (`DecadeName`, `DecadeStart`, `DecadeEnd`) VALUES ('{$name}','{$start}','{$end}')");