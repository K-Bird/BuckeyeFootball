<?php include ("../../libs/db/common_db_functions.php"); 

$row = $_POST['row'];

db_query("UPDATE `Controls` SET Value ='{$row}' WHERE Control='Input_Stats_Player'");