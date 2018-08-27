<?php include ("../../libs/db/common_db_functions.php"); 

$seasonID = $_POST['seasonID'];
$newDepth = $_POST['newDepth'];

db_query("UPDATE `seasons` SET DepthChart ='{$newDepth}' WHERE Season_ID='{$seasonID}'");