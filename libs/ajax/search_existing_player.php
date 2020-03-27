<?php

include ("../../libs/db/common_db_functions.php");

$name = $_POST['name'];
$recID = $_POST['recID'];

$returnFoundNames = db_query("SELECT DISTINCT * FROM `players` WHERE concat(First_Name, ' ', Last_Name) LIKE '%$name%' GROUP BY First_Name ORDER BY Last_Name, First_Name LIMIT 20");

echo '<div id="linkRecruitSearchResults">';
echo '<div class="list-group">';

while ($fetchFoundNames = $returnFoundNames->fetch_assoc()) {

    echo '<button id="', $fetchFoundNames['Player_Master_ID'], '" type="button" class="recruitLinkListItem list-group-item list-group-item-action btn-sm" data-recid=' . $recID .'>';
        
    echo '<span class="oi oi-link-intact" style="float: left"></span>';
    echo "   " . $fetchFoundNames['First_Name'] . " " . $fetchFoundNames ['Last_Name'] . " [" . $fetchFoundNames ['Position'] . "] - "  . returnYearsPlayed($fetchFoundNames ['Player_Master_ID']);

    echo '</button>';
}

echo '<div>';
echo '</div>';