<?php include ("../../libs/db/common_db_functions.php"); 

$seasonID = $_POST['seasonID'];
$newHC = $_POST['newHC'];

db_query("UPDATE `seasons` SET HC ='{$newHC}' WHERE Season_ID='{$seasonID}'");