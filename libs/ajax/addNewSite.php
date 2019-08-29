<?php

include ("../../libs/db/common_db_functions.php");

$name = $_POST['SiteName'];
$link = $_POST['SiteLink'];
$cat = $_POST['SiteCat'];

db_query("INSERT INTO `web_links` (Title, URL, Category) VALUES ('{$name}','{$link}','{$cat}')");

header("Location: {$_SERVER["HTTP_REFERER"]}");
