<?php
include ("../../libs/db/common_db_functions.php");

$Master_ID = $_POST['Master_ID'];
?>

<div class="row">
    <div class="col-lg-12">
<?php
if (oneStatRowExists('Passing', $Master_ID) === true) {
    echo returnPlayerDetailStatCard($Master_ID, 'Passing');
}

if (oneStatRowExists('Rushing', $Master_ID) === true) {
    echo '<br>';
    echo returnPlayerDetailStatCard($Master_ID, 'Rushing');
}
if (oneStatRowExists('rec', $Master_ID) === true) {
    echo '<br>';
    echo returnPlayerDetailStatCard($Master_ID, 'rec');
}
if (oneStatRowExists('def', $Master_ID) === true) {
    echo '<br>';
    echo returnPlayerDetailStatCard($Master_ID, 'def');
}
if (oneStatRowExists('ret', $Master_ID) === true) {
    echo '<br>';
    echo returnPlayerDetailStatCard($Master_ID, 'ret');
}
if (oneStatRowExists('Kicking', $Master_ID) === true) {
    echo '<br>';
    echo returnPlayerDetailStatCard($Master_ID, 'Kicking');
}
if (oneStatRowExists('Punting', $Master_ID) === true) {
    echo '<br>';
    echo returnPlayerDetailStatCard($Master_ID, 'Punting');
}
?>
    </div>
</div>