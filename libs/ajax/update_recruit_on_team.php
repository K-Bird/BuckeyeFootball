<?php include ("../../libs/db/common_db_functions.php"); 

$rec_ID = $_POST['recID'];
$change = $_POST['recChg'];

db_query("UPDATE `recruits` SET On_Team='{$change}' WHERE Recruit_ID='{$rec_ID}'");