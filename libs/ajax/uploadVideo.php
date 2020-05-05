<?php

include ("../../libs/db/common_db_functions.php");

$combinedGameTags = '';
$combinedMiscTags = '';

if (isset($_POST['videoDesc'])) {
    $videoDesc = $_POST['videoDesc'];
}

if (isset($_POST['gameVideoTag'])) {
    $tagCount = count($_POST['gameVideoTag']);

    $i = 1;
    foreach ($_POST['gameVideoTag'] as $tag) {
        if ($i < $tagCount) {
            $combinedGameTags = $combinedGameTags . $tag . ',';
        } else {
            $combinedGameTags = $combinedGameTags . $tag;
        }
        $i++;
    }
}

if (isset($_POST['miscVideoTag'])) {
    $tagCount = count($_POST['miscVideoTag']);

    $i = 1;
    foreach ($_POST['miscVideoTag'] as $tag) {
        if ($i < $tagCount) {
            $combinedMiscTags = $combinedMiscTags . $tag . ',';
        } else {
            $combinedMiscTags = $combinedMiscTags . $tag;
        }
        $i++;
    }
}


//Get the max video identifier, increment by 1
$getMaxVideoName = db_query("SELECT Max(Video_Name) as MaxName FROM `videos`");
$fetchMaxName = $getMaxVideoName->fetch_assoc();
$maxName = $fetchMaxName['MaxName'];
$nextName = $maxName + 1;



$currentDir = getcwd();
$uploadDirectory = dirname(__DIR__) . "/video/uploaded/";

$errors = []; // Store all foreseen and unforseen errors here

//$fileExtensions = ['mp4', 'mov']; // Get all the file extensions

$fileName = $_FILES['myfile']['name'];
$fileSize = $_FILES['myfile']['size'];
$fileTmpName = $_FILES['myfile']['tmp_name'];
$fileType = $_FILES['myfile']['type'];
$fileExtension = strtolower(end(explode('.', $fileName)));

$uploadPath = $uploadDirectory . $nextName . "." . $fileExtension;

echo $uploadPath;

$addNewVideo = db_query("INSERT INTO `videos` (Video_Name, Des, Extension, Game_Tags, Misc_Tags) VALUES ('{$nextName}','{$videoDesc}','{$fileExtension}','{$combinedGameTags}','{$combinedMiscTags}')");

if (isset($_POST['submit'])) {

    /*if (!in_array($fileExtension, $fileExtensions)) {
        $errors[] = "This file extension is not allowed. Please upload a MOV or MP4 file";
    }
    if ($fileSize > 2000000) {
        $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
    }
    */
    if (empty($errors)) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if ($didUpload) {
            echo "The file " . $nextName . "." . $fileExtension . " has been uploaded";
        } else {
            echo "An error occurred somewhere. Try again or contact the admin";
        }
    } else {
        foreach ($errors as $error) {
            echo $error . "These are the errors" . "\n";
        }
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
