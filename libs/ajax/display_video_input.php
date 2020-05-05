<?php

include ("../../libs/db/common_db_functions.php");

$Video_ID = $_POST['Video_ID'];

$getVideoInfo = db_query("SELECT * FROM `videos` WHERE Video_ID={$Video_ID}");
$fetchVideoInfo = $getVideoInfo->fetch_assoc();

echo '<div id="viewVideoContent">';

if ($fetchVideoInfo['Extension'] === 'gif') {
    echo '<img src="/buckeyefootball/libs/video/uploaded/' . $fetchVideoInfo['Video_Name'] . '.' . $fetchVideoInfo['Extension'] . '" >';
} else {

    echo '<video controls height="500px" width="800px">';
    echo '<source src="/buckeyefootball/libs/video/uploaded/' . $fetchVideoInfo['Video_Name'] . '.' . $fetchVideoInfo['Extension'] . '" type=video/' . $fetchVideoInfo['Extension'] . '">';
    echo '</video>';
}
echo '</div>';
?>

