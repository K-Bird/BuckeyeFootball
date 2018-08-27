<?php include ("../../libs/db/common_db_functions.php"); 

$master_ID = $_POST['master_ID'];
$newLName = addslashes($_POST['newLName']);

db_query("UPDATE `players` SET Last_Name ='{$newLName}' WHERE Player_Master_ID='{$master_ID}'");