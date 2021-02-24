<?php
include ("libs/db/common_db_functions.php");
?>
<html>
    <head>
        <title>Buckeyes Data Integrity</title>
        <link rel="shortcut icon" href="http://www.iconj.com/ico/y/f/yfuwmmd6a8.ico" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="libs/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="libs/css/open-iconic-bootstrap.css">
        <link rel="stylesheet" type="text/css" href="libs/css/common.css">
        <script src="libs/js/jquery.js"></script>
        <script src="libs/js/bootstrap.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#"><img src="libs/images/logo_nav.png" height="55" width="55"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarDI">
                <div class="navbar-nav">
                    <span class="btn btn-dark btn-lg btn-block">Data Integrity Dashboard</span>
                </div>
                <a class="nav-item nav-link" href="index.php">Return to Main Site</a>
            </div>
        </nav>
        <br><br>
        <div class="row">
            <div class="col-lg-1">

            </div>
            <div class="col-lg-1">
                <div class="btn btn-lg btn-dark">Recruit Data</div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <h5 class="card-header">Recruit to Players Missing Master ID Link &nbsp; <span id="DI_Indicator_Recruit_Missing_ID"></span></h5>
                    <div class="card-body">
                        <div id="DI_Recruit_Missing_ID_Content">
                            <div class="elementLoader"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <h5 class="card-header">Recruit <-> Players Name Discrepancies &nbsp; <span id="DI_Indicator_Recruit_Name"></span></h5>
                    <div class="card-body">
                        <div id="DI_Recruit_Name_Content">
                            <div class="elementLoader"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <h5 class="card-header">In Recruits Not Players&nbsp; <span id="DI_Indicator_Recruit_Extra_ID"></span></h5>
                    <div class="card-body">
                        <div id="DI_Recruit_Extra_ID_Content">
                            <div class="elementLoader"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-lg-1">

            </div>
            <div class="col-lg-1">
                <div class="btn btn-lg btn-dark">Player Data</div>
            </div>
            <div class="col-lg-2">
                <div class="card">
                    <h5 class="card-header">First Name `players` &nbsp; <span id="DI_Indicator_First_Name"></span></h5>
                    <div class="card-body">
                        <div id="DI_First_Name_Disc_Content">
                            <div class="elementLoader"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="card">
                    <h5 class="card-header">Last Name `players` &nbsp; <span id="DI_Indicator_Last_Name"></span></h5>
                    <div class="card-body">
                        <div id="DI_Last_Name_Disc_Content">
                            <div class="elementLoader"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <h5 class="card-header">Players <-> Player Ref Discrepancy &nbsp; <span id="DI_Indicator_Player_Ref"></span></h5>
                    <div class="card-body">
                        <div id="DI_Player_Ref_Disc_Content">
                            <div class="elementLoader"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-lg-1">

            </div>
            <div class="col-lg-2">
                <div class="btn btn-lg btn-dark">Player Stat Data</div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <h5 class="card-header">Agg Stats Discrepancy (Non Max) &nbsp; <span id="DI_Indicator_Player_Stat_Agg"></span></h5>
                    <div class="card-body">
                        <div id="DI_Player_Stat_Agg_Disc_Content">
                            <div class="elementLoader"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
    </body>
</html>
<script>
    $(document).ready(function () {
        
        load_DI_content(load_DI_Indicators());

        function load_DI_content() {
            //Load DI Content
            $('#DI_Recruit_Missing_ID_Content').load('libs/ajax/DI/DI_Recruit_Missing_ID.php');
            $('#DI_Recruit_Name_Content').load('libs/ajax/DI/DI_Recruit_Name.php');
            $('#DI_Recruit_Extra_ID_Content').load('libs/ajax/DI/DI_Recruit_Extra_ID.php');
            $('#DI_First_Name_Disc_Content').load('libs/ajax/DI/DI_First_Name_Disc.php');
            $('#DI_Last_Name_Disc_Content').load('libs/ajax/DI/DI_Last_Name_Disc.php');
            $('#DI_Player_Ref_Disc_Content').load('libs/ajax/DI/DI_Player_Ref_Disc.php');
            $('#DI_Player_Stat_Agg_Disc_Content').load('libs/ajax/DI/DI_Player_Stat_Agg.php');
        }

        function load_DI_Indicators() {
            //Load DI Indicators
            $('#DI_Indicator_Recruit_Missing_ID').load('libs/ajax/DI/DI_Indicator_Recruit_Missing_ID.php');
            $('#DI_Indicator_Recruit_Name').load('libs/ajax/DI/DI_Indicator_Recruit_Name.php');
            $('#DI_Indicator_Recruit_Extra_ID').load('libs/ajax/DI/DI_Indicator_Recruit_Extra_ID.php');
            $('#DI_Indicator_First_Name').load('libs/ajax/DI/DI_Indicator_First_Name_Disc.php');
            $('#DI_Indicator_Last_Name').load('libs/ajax/DI/DI_Indicator_Last_Name_Disc.php');
            $('#DI_Indicator_Player_Ref').load('libs/ajax/DI/DI_Indicator_Player_Ref_Disc.php');
            $('#DI_Indicator_Player_Stat_Agg').load('libs/ajax/DI/DI_Indicator_Player_Stat_Agg.php');
        }
    });
</script>