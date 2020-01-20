<?php include ("../../libs/db/common_db_functions.php"); 

$recruit_row = $_POST['row'];
$newValue = addslashes($_POST['newValue']);
$field = $_POST['field'];

db_query("UPDATE `recruits` SET `{$field}`='{$newValue}' WHERE Recruit_ID='{$recruit_row}'");