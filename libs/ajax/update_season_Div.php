<?php include ("../../libs/db/common_db_functions.php"); 

$seasonID = $_POST['seasonID'];
$newDiv = $_POST['newDiv'];

db_query("UPDATE `seasons` SET Division ='{$newDiv}' WHERE Season_ID='{$seasonID}'");