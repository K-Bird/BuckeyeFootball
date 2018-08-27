<?php include ("../../libs/db/common_db_functions.php"); 

$new_view = $_POST['new_view'];

db_query("UPDATE `Controls` SET Value ='{$new_view}' WHERE Control='Season_View'");