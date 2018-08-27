<?php include ("../../libs/db/common_db_functions.php"); 

$seasonID = $_POST['seasonID'];
$newConf = $_POST['newConf'];

db_query("UPDATE `seasons` SET Conf ='{$newConf}' WHERE Season_ID='{$seasonID}'");