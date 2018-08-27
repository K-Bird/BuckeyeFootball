<?php include ("../../libs/db/common_db_functions.php"); 

$option = $_POST['option'];

db_query("UPDATE `Controls` SET Value ='{$option}' WHERE Control='input_list_edit'");