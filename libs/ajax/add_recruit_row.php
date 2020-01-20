<?php

include ("../../libs/db/common_db_functions.php");

$class = $_POST['recClass'];

db_query("INSERT INTO `recruits` (

    `Last_Name`, 
    `First_Name`,
    `Position`,  
    `Height`, 
    `Weight`, 
    `Hometown`,
    `Stars`,
    `Score`,
    `Nat_RK`,
    `Pos_RK`,
    `State_RK`,
    `Class`,
    `Player_ID`)
    
VALUES 

('', '', '', '0', '0', '', '0', '0', '0','0', '0', '{$class}', '0')");