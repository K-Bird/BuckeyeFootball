<?php

include ("../../libs/db/common_db_functions.php");

$combinedPlayerTags = '';
$combinedGameTags = '';

if (isset($_POST['playerPhotoTag'])) {
    $tagCount = count($_POST['playerPhotoTag']);

    $i = 1;
    foreach ($_POST['playerPhotoTag'] as $tag) {
        if ($i < $tagCount) {
            $combinedPlayerTags = $combinedPlayerTags . $tag . ',';
        } else {
            $combinedPlayerTags = $combinedPlayerTags . $tag;
        }
        $i++;
    }
}

if (isset($_POST['gamePhotoTag'])) {
    $tagCount = count($_POST['gamePhotoTag']);

    $i = 1;
    foreach ($_POST['gamePhotoTag'] as $tag) {
        if ($i < $tagCount) {
            $combinedGameTags = $combinedGameTags . $tag . ',';
        } else {
            $combinedGameTags = $combinedGameTags . $tag;
        }
        $i++;
    }
}


//Get the max photo identifier, increment by 1
$getMaxPhotoName = db_query("SELECT Max(Photo_Name) as MaxName FROM `photos`");
$fetchMaxName = $getMaxPhotoName->fetch_assoc();
$maxName = $fetchMaxName['MaxName'];
$nextName = $maxName + 1;



$currentDir = getcwd();
$uploadDirectory = dirname(__DIR__) . "/images/uploaded/";

$errors = []; // Store all foreseen and unforseen errors here

$fileExtensions = ['jpeg', 'jpg', 'png']; // Get all the file extensions

$fileName = $_FILES['myfile']['name'];
$fileSize = $_FILES['myfile']['size'];
$fileTmpName = $_FILES['myfile']['tmp_name'];
$fileType = $_FILES['myfile']['type'];
$fileExtension = strtolower(end(explode('.', $fileName)));

$uploadPath = $uploadDirectory . $nextName . "." . $fileExtension;

$addNewPhoto = db_query("INSERT INTO `photos` (Photo_Name, Extension, Player_Tags, Game_Tags) VALUES ('{$nextName}','{$fileExtension}','{$combinedPlayerTags}','{$combinedGameTags}')");

if (isset($_POST['submit'])) {

    if (!in_array($fileExtension, $fileExtensions)) {
        $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
    }

    if ($fileSize > 2000000) {
        $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
    }

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
