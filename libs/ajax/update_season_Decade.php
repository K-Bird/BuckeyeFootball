<?php include ("../../libs/db/common_db_functions.php"); 

$seasonID = $_POST['seasonID'];
$newDecade = $_POST['newDecade'];

db_query("UPDATE `seasons` SET Decade_ID ='{$newDecade}' WHERE Season_ID='{$seasonID}'");