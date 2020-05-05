<?php include ("../../libs/db/common_db_functions.php"); 

$video_ID = $_POST['video_ID'];
$value = $_POST['value'];

db_query("UPDATE `videos` SET Des='{$value}' WHERE Video_ID='{$video_ID}'");