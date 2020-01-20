<?php include ("../../libs/db/common_db_functions.php"); 

$new_class = $_POST['recClass'];

db_query("UPDATE `controls` SET Value ='{$new_class}' WHERE Control='recruit_season'");
