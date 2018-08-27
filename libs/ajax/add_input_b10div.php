<?php

include ("../../libs/db/common_db_functions.php");

$newDiv = $_POST['newDiv'];

$getMaxOrder = db_query("SELECT Max(`Div_Order`) as MaxOrder From `b10_divisions`");
$fetchMaxOrder = $getMaxOrder->fetch_assoc();
$nextMaxOrder = $fetchMaxOrder['MaxOrder'] + 1;

db_query("INSERT INTO `b10_divisions` (`Div_Order`, `Div_Name`) VALUES ('{$nextMaxOrder}','{$newDiv}')");