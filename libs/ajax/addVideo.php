<?php

include ("../../libs/db/common_db_functions.php");

 $filePath = $_POST['filePath'];
 
 //Get the max video identifier, increment by 1
$getMaxVideoName = db_query("SELECT Max(Video_Name) as MaxName FROM `videos`");
$fetchMaxName = $getMaxVideoName->fetch_assoc();
$maxName = $fetchMaxName['MaxName'];
$nextName = $maxName + 1;

$extension = pathinfo($filePath,PATHINFO_EXTENSION);
$newName = "../video/uploaded/" . $nextName . "." . $extension;

rename($filePath,$newName);

$addNewVideo = db_query("INSERT INTO `videos` (Video_Name, Extension) VALUES ('{$nextName}','{$extension}')");