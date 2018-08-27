<?php include ("../../libs/db/common_db_functions.php"); 

$gm_ID = $_POST['gameID'];
$player_ID = $_POST['playerID'];
$category = $_POST['category'];


db_query("UPDATE `Controls` SET Value ='{$gm_ID}' WHERE Control='input_edit_stat_GM_ID'");
db_query("UPDATE `Controls` SET Value ='{$player_ID}' WHERE Control='input_edit_stat_Player_ID'");
db_query("UPDATE `Controls` SET Value ='{$category}' WHERE Control='input_edit_stat_category'");