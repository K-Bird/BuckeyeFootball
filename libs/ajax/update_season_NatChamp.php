<?php include ("../../libs/db/common_db_functions.php"); 

$seasonID = $_POST['seasonID'];
$newChamp = $_POST['newChamp'];

db_query("UPDATE `seasons` SET NationalChamp ='{$newChamp}' WHERE Season_ID='{$seasonID}'");