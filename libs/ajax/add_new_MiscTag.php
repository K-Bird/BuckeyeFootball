<?php
include ("../../libs/db/common_db_functions.php");

$newTag = $_POST['newTag'];

db_query("INSERT INTO `ref_misc_photo_tags` (Tag_Name) VALUES ('{$newTag}')");