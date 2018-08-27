<?php include ("../../libs/db/common_db_functions.php"); 

$ID = $_POST['ID'];
$newValue = addslashes($_POST['newValue']);
$table = $_POST['table'];
$datacol = $_POST['datacol'];
$idcol = $_POST['idcol'];

db_query("UPDATE {$table} SET {$datacol}='{$newValue}' WHERE {$idcol}={$ID}");