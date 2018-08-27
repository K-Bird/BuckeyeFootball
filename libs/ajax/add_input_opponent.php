<?php

include ("../../libs/db/common_db_functions.php");

$newSchool = $_POST['school'];
$newNickname = $_POST['nickname'];
$newState = $_POST['state'];

db_query("INSERT INTO `opponents` (`School`, `Nickname`, `State`) VALUES ('{$newSchool}','{$newNickname}','{$newState}')");