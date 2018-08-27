<?php

include ("../../libs/db/common_db_functions.php");

$First_Name = $_POST['FName'];
$Last_Name = $_POST['LName'];
$Type = $_POST['Type'];

db_query("INSERT INTO `Coaches` (`First_Name`, `Last_Name`, `Type`) VALUES ('{$First_Name}','{$Last_Name}','{$Type}')");