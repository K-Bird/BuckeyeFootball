<?php
$xlists = array('Big Ten Divisions', 'Coaches', 'Conferences', 'Decades', 'Game Types', 'Locations', 'Opponents');

$lists = array(
    array(
        'Big Ten Divisions',
        'b10div'
    ),
    array(
        'Coaches',
        'coach'
    ),
    array(
        'Conferences',
        'conf'
    ),
    array(
        'Decades',
        'dec'
    ),
    array(
        'Game Types',
        'gmType'
    ),
    array(
        'Locations',
        'loc'
    ),
    array(
        'Opponents',
        'opp'
    ),
);

$getInputList = db_query("SELECT * FROM `controls` WHERE Control='input_list_edit'");
$fetchInputList = $getInputList->fetch_assoc();
$inputList = $fetchInputList['Value'];
?>
<div class="container-fluid">
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="btn-group">
                <button id="listDropDown" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Select List to Edit
                </button>
                <div class="dropdown-menu">
                    <?php
                    foreach ($lists as $listItem) {
                        echo '<a class="dropdown-item listEditDD" data-option="' . $listItem[1], '" href="#">' . $listItem[0] . '</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <br>
            <?php
            if ($inputList === 'b10div') {
                include ('parts/input/list_input/b10div.php');
            }
            if ($inputList === 'loc') {
                include ('parts/input/list_input/locations.php');
            }
            if ($inputList === 'opp') {
                include ('parts/input/list_input/opponents.php');
            }
            if ($inputList === 'coach') {
                include ('parts/input/list_input/coaches.php');
            }
            if ($inputList === 'conf') {
                include ('parts/input/list_input/conferences.php');
            }
            if ($inputList === 'dec') {
                include ('parts/input/list_input/decades.php');
            }
            if ($inputList === 'gmType') {
                include ('parts/input/list_input/gameTypes.php');
            }
            ?>
        </div>
    </div>
</div>