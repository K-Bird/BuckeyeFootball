<?php
include ("libs/db/common_db_functions.php");

//Get posted Game ID
$GM_ID = $_POST['GM_ID'];


//Get all of the game's data from the games table
$getGameData = db_query("SELECT * FROM `games` WHERE GM_ID='{$GM_ID}'");
$fetchGameData = $getGameData->fetch_assoc();
?>
<html>
    <head>
        <title>Game Details</title>
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
                    <h1><span class="badge badge-secondary"><?php echo $fetchGameData['Date'] . " Vs " . opponentLookup($fetchGameData['Vs']); ?> - Game Details</span></h1>
                    <br>
                    <h2><span class="badge badge-secondary"><?php echo returnGameOutcome($fetchGameData['OSU_Score'],$fetchGameData['Opp_Score']) . " " . $fetchGameData['OSU_Score'] . " - " .$fetchGameData['Opp_Score']; ?></span></h2>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12">
                    <?php 
                    echo returnGameDetailStatCard($GM_ID, 'Passing'). '<br>';
                    echo returnGameDetailStatCard($GM_ID, 'Rushing'). '<br>';
                    echo returnGameDetailStatCard($GM_ID, 'rec'). '<br>';
                    echo returnGameDetailStatCard($GM_ID, 'def'). '<br>';
                    echo returnGameDetailStatCard($GM_ID, 'ret'). '<br>';
                    echo returnGameDetailStatCard($GM_ID, 'Kicking'). '<br>';
                    echo returnGameDetailStatCard($GM_ID, 'Punting');
                    ?>
                </div>
            </div>