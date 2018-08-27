<?php

include ("../../libs/db/common_db_functions.php");

$startYear = $_POST['start'];
$endYear = $_POST['end'];

$startYearID = getSeason_ID($startYear);
$endYearID = getSeason_ID($endYear);

$wins = 0;
$losses = 0;
$ties = 0;

$getGames = db_query("SELECT * FROM `games` WHERE Season_ID >= '{$startYearID}' AND Season_ID <= '{$endYearID}'");

while ($fetchGames = $getGames->fetch_assoc()) {
    if ($fetchGames['OSU_Score'] > $fetchGames['Opp_Score']) {
        $wins++;
    }
    if ($fetchGames['OSU_Score'] < $fetchGames['Opp_Score']) {
        $losses++;
    }
    if ($fetchGames['OSU_Score'] === $fetchGames['Opp_Score']) {
        $ties++;
    }
}


echo 'Record During Displayed Years: '. $wins . ' Wins - ' . $losses . ' Losses - ' . $ties . ' Ties';
