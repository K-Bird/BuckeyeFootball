<?php include ("../../libs/db/common_db_functions.php"); 

$newPosGroup = $_POST['posGroup'];

db_query("UPDATE `Controls` SET Value ='{$newPosGroup}' WHERE Control='Input_Player_PosGroup'");