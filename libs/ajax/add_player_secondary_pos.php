<?php

include ("../../libs/db/common_db_functions.php");

$row = $_POST['row'];
$pos = $_POST['pos'];
$pos_2 = $_POST['pos_2'];

if ($pos_2 === "N-A") {
    db_query("UPDATE `players` SET Position_2='{$pos}' WHERE Player_Row='{$row}'");
} else {
    db_query("UPDATE `players` SET Position_2='{$pos_2}' WHERE Player_Row='{$row}'");
}


