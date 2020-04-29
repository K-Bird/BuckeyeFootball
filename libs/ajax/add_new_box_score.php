<?php

include ("../../libs/db/common_db_functions.php");

$Game_ID = $_POST['Game_ID'];


db_query("INSERT INTO `games_box_scores` (GM_ID, Q1_OSU, Q1_Opp, Q2_OSU, Q2_Opp, Q3_OSU, Q3_Opp, Q4_OSU, Q4_Opp) VALUES ('{$Game_ID}','0','0','0','0','0','0','0','0')");
