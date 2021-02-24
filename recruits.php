<?php include ("libs/db/common_db_functions.php"); ?>
<?php include ('parts/common_inputs.php'); ?>        
<?php
$get_RecruitView = db_query("SELECT * FROM `Controls` WHERE Control='recruit_season'");
$fetch_RecruitView = $get_RecruitView->fetch_assoc();
$Recruit_View = $fetch_RecruitView['Value'];
?>
<html>
    <head>
        <title>Buckeyes - Recruits</title>
        <link rel="shortcut icon" href="http://www.iconj.com/ico/y/f/yfuwmmd6a8.ico" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="libs/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="libs/css/bootstrap-select.min.css">
        <link rel="stylesheet" type="text/css" href="libs/css/tablesorter-default.css">
        <link rel="stylesheet" type="text/css" href="libs/css/common.css">
        <script src="libs/js/jquery.js"></script>
        <script src="libs/js/bootstrap.js"></script>
        <script src="libs/js/bootstrap-select.min.js"></script>
        <script src="libs/js/tablesorter.js"></script>
        <script src="libs/js/tablesorter-widgets.js"></script>
        <script src="libs/js/stupidtable.js"></script>
    </head>
    <body>
        <?php include ('nav/navBar.php'); ?>
        <div class="row">
            <div class="col-lg-12">
                <?php include ('parts/recruits/recruit_controls.php'); ?>
            </div>
            <div class="col-lg-12">
                <?php include ('parts/recruits/recruit_table.php'); ?>
            </div>
        </div>
    </body>
</html>
<script>
    $(document).ready(function () {
        
        //Initate table sort on recruits tabl
        $("#recruitTable").tablesorter({
            theme: "default"
        });
        
        //When a new class is selected update the database to the new class view
        $(".recruitClass").change(function () {

            var recClass = $(this).val();

            $.ajax(
                    {
                        url: "libs/ajax/update_recruit_class_view.php",
                        type: "POST",
                        data: {recClass: recClass},
                        success: function (data, textStatus, jqXHR)
                        {
                            location.reload();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("Form Did Not Process: " + errorThrown);
                        }
                    });
        });
    });
</script>
<?php

function display_Not_Ranked($Rank) {
    
    if ($Rank === '0') {
        echo 'Not Ranked';
    } else {
        echo $Rank;
    }
    
}


?>