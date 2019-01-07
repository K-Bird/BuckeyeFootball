<?php

include ("../../libs/db/common_db_functions.php");

$name = $_POST['name'];

if (isset($_POST['num'])) {
    $num = $_POST['num'];
}
if (isset($_POST['photoID'])) {
    $photoID = $_POST['photoID'];
}

$search_type = $_POST['type'];

$returnFoundNames = db_query("SELECT * FROM `ref_misc_photo_tags` WHERE Tag_Name LIKE '%$name%' LIMIT 5");

if ($search_type === 'upload') {
    echo '<div id="miscTagResults">';
}

if ($search_type === 'existing') {
    echo '<div id="miscTagExistingResults' . $num . '">';
}


echo '<div class="list-group">';

echo '<button class="list-group-item list-group-item-action btn-sm addMiscTag" data-newTag="' . $name . '"';
       if ($search_type === 'upload') {
           echo ' data-type="upload" ';
       }
       if ($search_type === 'existing') {
           echo ' data-type="existing" ';
       }
        
echo '><span class="oi oi-plus"></span>&nbsp;&nbsp;&nbsp;&nbsp;Add "' . $name . '" as Misc Tag</button>';

while ($fetchFoundNames = $returnFoundNames->fetch_assoc()) {

    echo '<button id="', $fetchFoundNames['Tag_ID'], '" type="button"';

    if ($search_type === 'upload') {
        echo ' class="miscTagListItem list-group-item list-group-item-action btn-sm">';
    }
    if ($search_type === 'existing') {
        echo ' class="miscTagListExistingItem list-group-item list-group-item-action btn-sm" data-photoID="' . $photoID . '" data-num="' . $num . '">';
    }

    echo $fetchFoundNames['Tag_Name'];

    echo '</button>';
}

echo '<div>';

echo '<div>';

