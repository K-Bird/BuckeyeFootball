<?php include ("../../libs/db/common_db_functions.php"); 

$Master_ID = $_POST['Master_ID'];
$Rec_ID = $_POST['Rec_ID'];

db_query("UPDATE `recruits` SET Player_ID ='{$Master_ID}' WHERE Recruit_ID ='{$Rec_ID}'");