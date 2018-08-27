<?php include ("../../libs/db/common_db_functions.php"); 

$master_ID = $_POST['master_ID'];
$newHometown = $_POST['newHometown'];

db_query("UPDATE `players` SET Hometown ='{$newHometown}' WHERE Player_Master_ID='{$master_ID}'");