<?php include ("../../libs/db/common_db_functions.php"); 

$end = $_POST['end'];

db_query("UPDATE `Controls` SET Value ='{$end}' WHERE Control='player_compare_end'");