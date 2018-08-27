<?php include ("../../libs/db/common_db_functions.php"); 

$start = $_POST['start'];
$end = $_POST['end'];

db_query("UPDATE `Controls` SET Value ='{$start}' WHERE Control='player_compare_start'");
db_query("UPDATE `Controls` SET Value ='{$end}' WHERE Control='player_compare_end'");