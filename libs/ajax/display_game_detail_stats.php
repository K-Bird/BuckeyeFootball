<?php

include ("../../libs/db/common_db_functions.php");

$GM_ID = $_POST['GM_ID'];

echo returnGameDetailStatCard($GM_ID, 'Passing') . '<br>';
echo returnGameDetailStatCard($GM_ID, 'Rushing') . '<br>';
echo returnGameDetailStatCard($GM_ID, 'rec') . '<br>';
echo returnGameDetailStatCard($GM_ID, 'def') . '<br>';
echo returnGameDetailStatCard($GM_ID, 'ret') . '<br>';
echo returnGameDetailStatCard($GM_ID, 'Kicking') . '<br>';
echo returnGameDetailStatCard($GM_ID, 'Punting');
