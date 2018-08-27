<?php include ("../../libs/db/common_db_functions.php"); 

$start = $_POST['start'];

db_query("UPDATE `Controls` SET Value ='{$start}' WHERE Control='player_compare_start'");