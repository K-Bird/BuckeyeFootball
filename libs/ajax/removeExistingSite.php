<?php

include ("../../libs/db/common_db_functions.php");

$ID = $_POST['ID'];

db_query("DELETE FROM `web_links` WHERE Link_ID='{$ID}'");