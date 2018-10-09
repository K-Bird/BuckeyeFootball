<?php include ("../../libs/db/common_db_functions.php"); 

$new_season = $_POST['season'];

db_query("UPDATE `Controls` SET Value ='{$new_season}' WHERE Control='Input_Season'");
db_query("UPDATE `Controls` SET Value = '' WHERE Control='Input_Stats_Player'");