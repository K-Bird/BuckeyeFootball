<?php
include ("libs/db/common_db_functions.php");

//Get posted Master Player ID
$Master_ID = $_POST['Player_Master_ID'];

//Get data for the player at Master Player ID
$getPlayerDataHeader = db_query("SELECT * From `Players` WHERE Player_Master_ID ={$Master_ID}");
$fetch_PlayerDataHeader = $getPlayerDataHeader->fetch_assoc();
?>
<html>
    <head>
        <title>Player Details</title>
        <link rel="stylesheet" type="text/css" href="libs/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="libs/css/nouislider.css">
        <script src="libs/js/jquery.js"></script>
        <script src="libs/js/bootstrap.js"></script>
        <script src="libs/js/nouislider.js"></script>
        <script src="libs/js/wNumb.js"></script>
        <script src="libs/js/commonFunctions.js"></script>
    </head>
    <body>
        <?php include ('nav/navBar.php'); ?>
        <div class="container">
            <div class="row" style="text-align: center">
                <div class="col-lg-12">
                    <br>
                    <h1><span class="badge badge-secondary"><?php echo $fetch_PlayerDataHeader['First_Name'] . " " . $fetch_PlayerDataHeader['Last_Name']; ?> - Player Details</span></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <br>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Year</th><th>Class</th><th>Position</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $getPlayerData = db_query("SELECT * From `Players` WHERE Player_Master_ID ={$Master_ID} ORDER BY Season DESC");

                            while ($fetch_PlayerData = $getPlayerData->fetch_assoc()) {

                                $DepthPOS = '';

                                if ($fetch_PlayerData['Depth'] === '0') {
                                    
                                } else {
                                    $DepthPOS = $fetch_PlayerData['Depth'];
                                }


                                echo '<tr>';
                                echo '<td>';
                                echo getSeason_Year($fetch_PlayerData['Season']);
                                echo '</td>';
                                echo '<td>';
                                echo $fetch_PlayerData['Class'];
                                echo '</td>';
                                echo '<td>';
                                if (checkForStarter($fetch_PlayerData['Position'], $fetch_PlayerData['Depth']) === true) {
                                    echo $fetch_PlayerData['Position'] . '*';
                                } else {
                                    echo $fetch_PlayerData['Position'] . $DepthPOS;
                                }
                                echo '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
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
        </div>
    </body>
</html>