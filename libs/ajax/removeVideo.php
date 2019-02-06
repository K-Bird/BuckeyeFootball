<?php

include ("../../libs/db/common_db_functions.php");

 $video_ID = $_POST['video_ID'];
 
 $getVideoInfo = db_query("SELECT * FROM `videos` WHERE Video_ID={$video_ID}");
 $fetchVideoInfo = $getVideoInfo->fetch_assoc();
 
 $path = "../video/uploaded/" . $fetchVideoInfo['Video_Name'] . "." . $fetchVideoInfo['Extension'];
 unlink($path);
 
$removeVideo = db_query("DELETE FROM `videos` WHERE Video_ID={$video_ID}");