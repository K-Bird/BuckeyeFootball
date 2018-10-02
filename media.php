<?php
include ("libs/db/common_db_functions.php");
include ('parts/common_inputs.php');
?>
<html>
    <head>
        <title>OSU - Media</title>
        <link rel="stylesheet" type="text/css" href="libs/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="libs/css/nouislider.css">
        <link rel="stylesheet" type="text/css" href="libs/css/common.css">
        <link rel="stylesheet" type="text/css" href="libs/css/bootstrap-select.min.css">
        <script src="libs/js/jquery.js"></script>
        <script src="libs/js/bootstrap.js"></script>
        <script src="libs/js/nouislider.js"></script>
        <script src="libs/js/wNumb.js"></script>
        <script src="libs/js/bootstrap-select.min.js"></script>
        <script src="libs/js/commonFunctions.js"></script>
    </head>
    <body>
        <?php include ('nav/navBar.php'); ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php include ('parts/media/topMediaNav.php'); ?>
                </div>
            </div>
        </div>
    </body>
</html>
<script>

    $(document).ready(function () {
       
       //When New Player is Selected From the Player Photo Dropdown set the new
       $('#playerPhotoSelect').change(function () {
           
           alert ($(this).val());
           
       });

    });
</script>