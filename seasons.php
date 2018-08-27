<?php
include ("libs/db/common_db_functions.php");
include ("parts/common_inputs.php");
?>
<html>
    <head>
        <title>OSU - SEA</title>
        <link rel="stylesheet" type="text/css" href="libs/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="libs/css/nouislider.css">
        <link rel="stylesheet" type="text/css" href="libs/css/open-iconic-bootstrap.css">
        <link rel="stylesheet" type="text/css" href="libs/css/tablesorter-default.css">
        <script src="libs/js/jquery.js"></script>
        <script src="libs/js/bootstrap.js"></script>
        <script src="libs/js/nouislider.js"></script>
        <script src="libs/js/tablesorter.js"></script>
        <script src="libs/js/tablesorter-widgets.js"></script>
        <script src="libs/js/wNumb.js"></script>
        <style>
            /* Slider Color Outside Of Handles */
            .noUi-target {
                background-color: gray
            }
            /* Slider Color Inside Of Handles */
            .noUi-connect {

                background-color: red 
            }
            /* Loading Icon Look and Animation */
            .loaderIcon {
                position: absolute;
                top:0;
                bottom: 0;
                left: 0;
                right: 0;
                margin: auto;
                z-index: 9999;
                border: 16px solid #666666; /* Light grey */
                border-top: 16px solid #BB0000; /* Blue */
                border-radius: 50%;
                width: 120px;
                height: 120px;
                animation: spin 2s linear infinite;
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
            /* Start the entire page below the navbar as hidden, once page loads is shown */
            #seasonContent {
                display: none;
            }
        </style>
    </head>
    <body>
        <?php include ('nav/navBar.php'); ?>
        <div class="loaderText" style="text-align: center"><br><br><h2><span class="badge badge-secondary">Loading Season Data</span></h2></div>
        <div class="loaderIcon"></div>
        <div id="seasonContent" class="container-fluid" style="width: 75%">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <br>
                    <?php include ('parts/season/season_controls.php'); ?>
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <br>
                    <!-- Check Season View Control -->          
                    <?php
                    $get_SeasonView = db_query("SELECT * FROM `Controls` WHERE Control='Season_View'");
                    $fetch_SeasonView = $get_SeasonView->fetch_assoc();
                    $Season_View = $fetch_SeasonView['Value'];

                    if ($Season_View === 'Games') {
                        include ('parts/season/season_games.php');
                    }
                    if ($Season_View === 'Table') {
                        include ('parts/season/season_table.php');
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    $(document).ready(function () {
        /* Page Loading */
        //When page is ready hide the loading text and icon then display the content
        $('#seasonContent').fadeIn(2000);
        $('.loaderIcon').hide();
        $('.loaderText').hide();

        /* Year Slider  */
        //If there is no start year, set it to 1990
        var startYear = localStorage['startYear'];
        if (!startYear) {
            localStorage['startYear'] = 1990;
        }
        //If there is no start year, set it to this year
        var endYear = localStorage['endYear'];
        if (!endYear) {
            localStorage['endYear'] = new Date().getFullYear();
        }

        /* Page Display */
        //If table view is shown, hide the appropriate years
        showhideTable();
        //If games view is shown hide the appropriate years
        showhideGames();
        //Calculate the program record for year slider years
        calcProgramRecord(localStorage['startYear'], localStorage['endYear']);

        /* Controls */
        //Build the year slider 
        var slider = document.getElementById('YearSlider');

        noUiSlider.create(slider, {
            start: [startYear, endYear],
            connect: true,
            range: {
                'min': 1890,
                'max': (new Date()).getFullYear()
            },
            step: 1,
            tooltips: [wNumb({decimals: 0}), wNumb({decimals: 0})],
        });
        //When slider handle is moved set the years, display appropriate years and recalculate the program record
        slider.noUiSlider.on('end', function () {

            var yearArray = this.get();
            var startYear = Math.trunc(yearArray[0]);
            var endYear = Math.trunc(yearArray[1]);

            localStorage.setItem('startYear', startYear);
            localStorage.setItem('endYear', endYear);

            showhideTable();
            showhideGames();
            calcProgramRecord(localStorage['startYear'], localStorage['endYear']);

        });
        //Set the data points for the decade buttons and upon click show/hide appropriate years and recalculate program record
        $(".seasonDecadeSlider").click(function () {

            var slider = document.getElementById('YearSlider');
            var decade = $(this).data('decade');

            if (decade === '1890s') {
                slider.noUiSlider.set([1890, 1899]);
                localStorage['startYear'] = 1890;
                localStorage['endYear'] = 1899;

            }
            if (decade === '1900s') {
                slider.noUiSlider.set([1900, 1909]);
                localStorage['startYear'] = 1900;
                localStorage['endYear'] = 1909;

            }
            if (decade === '1910s') {
                slider.noUiSlider.set([1910, 1919]);
                localStorage['startYear'] = 1910;
                localStorage['endYear'] = 1919;

            }
            if (decade === '1920s') {
                slider.noUiSlider.set([1920, 1929]);
                localStorage['startYear'] = 1920;
                localStorage['endYear'] = 1929;

            }
            if (decade === '1930s') {
                slider.noUiSlider.set([1930, 1939]);
                localStorage['startYear'] = 1930;
                localStorage['endYear'] = 1939;

            }
            if (decade === '1940s') {
                slider.noUiSlider.set([1940, 1949]);
                localStorage['startYear'] = 1940;
                localStorage['endYear'] = 1949;

            }
            if (decade === '1950s') {
                slider.noUiSlider.set([1950, 1959]);
                localStorage['startYear'] = 1950;
                localStorage['endYear'] = 1959;

            }
            if (decade === '1960s') {
                slider.noUiSlider.set([1960, 1969]);
                localStorage['startYear'] = 1960;
                localStorage['endYear'] = 1969;

            }
            if (decade === '1970s') {
                slider.noUiSlider.set([1970, 1979]);
                localStorage['startYear'] = 1970;
                localStorage['endYear'] = 1979;

            }
            if (decade === '1980s') {
                slider.noUiSlider.set([1980, 1989]);
                localStorage['startYear'] = 1980;
                localStorage['endYear'] = 1989;

            }
            if (decade === '1990s') {
                slider.noUiSlider.set([1990, 1999]);
                localStorage['startYear'] = 1990;
                localStorage['endYear'] = 1999;

            }
            if (decade === '2000s') {
                slider.noUiSlider.set([2000, 2009]);
                localStorage['startYear'] = 2000;
                localStorage['endYear'] = 2009;

            }
            if (decade === '2010s') {

                var currYear = (new Date()).getFullYear()

                slider.noUiSlider.set([2010, currYear]);
                localStorage['startYear'] = 2010;
                localStorage['endYear'] = currYear;

            }
            showhideGames();
            showhideTable();
            calcProgramRecord(localStorage['startYear'], localStorage['endYear']);
        });

        //Set localstorage values for season view and season data panels if they don't exist
        if (localStorage.getItem('OSU_Season_View_Controls') === null) {
            localStorage.setItem('OSU_Season_View_Controls', 'closed');
        }
        if (localStorage.getItem('OSU_Season_Data_Controls') === null) {
            localStorage.setItem('OSU_Season_Data_Controls', 'closed');
        }

        if (localStorage.getItem('OSU_Season_View_Controls') === 'closed') {
            //Collapse the season view controls area
            $('#seasonViewControls').addClass('collapse');
            //Show the closed chevron icon on season view button
            $('#closedSeasonViewChev').show();
            //Hide the open chevron icon on the season view button
            $('#openSeasonViewChev').hide();
        }
        if (localStorage.getItem('OSU_Season_View_Controls') === 'open') {
            $('#seasonViewControls').addClass('show');
            //Show the closed chevron icon on season view button
            $('#closedSeasonViewChev').hide();
            //Hide the open chevron icon on the season view button
            $('#openSeasonViewChev').show();
        }
        //When the season view controls are hidden show the closed icon and hide the open icon and remember it being closed
        $('#seasonViewControls').on('hidden.bs.collapse', function () {
            $('#closedSeasonViewChev').show();
            $('#openSeasonViewChev').hide();
            localStorage.setItem('OSU_Season_View_Controls', 'closed');

        });
        //When the season view controls are shown show the open icon and hide the closed icon and remember it being open
        $('#seasonViewControls').on('shown.bs.collapse', function () {
            $('#closedSeasonViewChev').hide();
            $('#openSeasonViewChev').show();
            localStorage.setItem('OSU_Season_View_Controls', 'open');
        });

        if (localStorage.getItem('OSU_Season_Data_Controls') === 'closed') {
            //Collapse the season view controls area
            $('#seasonDataControls').addClass('collapse');
            //Show the closed chevron icon on season view button
            $('#closedSeasonDataChev').show();
            //Hide the open chevron icon on the season view button
            $('#openSeasonDataChev').hide();
        }
        if (localStorage.getItem('OSU_Season_Data_Controls') === 'open') {
            //Collapse the season view controls area
            $('#seasonDataControls').addClass('show');
            //Show the closed chevron icon on season view button
            $('#closedSeasonDataChev').hide();
            //Hide the open chevron icon on the season view button
            $('#openSeasonDataChev').show();
        }
        //When the season data controls are hidden show the closed icon and hide the open icon and remember it being closed
        $('#seasonDataControls').on('hidden.bs.collapse', function () {
            $('#closedSeasonDataChev').show();
            $('#openSeasonDataChev').hide();
            localStorage.setItem('OSU_Season_Data_Controls', 'closed');
        });
        //When the season data controls are shown show the open icon and hide the closed icon
        $('#seasonDataControls').on('shown.bs.collapse', function () {
            $('#closedSeasonDataChev').hide();
            $('#openSeasonDataChev').show();
            localStorage.setItem('OSU_Season_Data_Controls', 'open');
        });

        //Check to see if season table exists (if not, depth chart or compare view is shown), if is does not then disable to season data controls button and don't show data ctrols if they were open
        if ($('#seasonTable').length > 0) {

        } else {
            $('#seasonDataControlsBtn').prop("disabled", true);
            $('#seasonDataControls').hide();
        }

        //Loop through season table and hide years that are outside of start and end
        function showhideTable() {
            $('#seasonTable > tbody  > tr').each(function () {

                var checkYear = this.id;

                if (checkYear < localStorage['startYear'] || checkYear > localStorage['endYear']) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        }
        //Loop through games table and hide years that are outside of start and end
        function showhideGames() {
            $('#Season_Panels > div.card').each(function () {

                var checkYear = this.id;

                if (checkYear < localStorage['startYear'] || checkYear > localStorage['endYear']) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        }

        /* Season Table Sorting and Filtering */
        //Use tablesorting plugin to sort table columns
         $("#seasonTable").tablesorter({
             theme : "default",             
         });
        
        
        $('#seasonTableSearch').on('input', function () {
            var searchText = $(this).val();

            $('#seasonTable tbody tr').each(function () {
                if (searchText === '') {
                    $(this).show();
                } else {
                    if ($(this).is(':contains(' + searchText + ')')) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                }
            });
        });

        //Filter Season Table By Conference Once a Dropdown Item Is Selected
        $('#confFilter').change(function () {

            //Filter elements on selected option
            $('#seasonTable tr td.season-filter-conf').each(function (e) {
                $(this).closest('tr').show();
            });
            showhideTable();
            var selectedConf = $(this).val();

            if (selectedConf === '0') {
                $('#seasonTable tr td.season-filter-conf').each(function (e) {
                    $(this).closest('tr').show();
                    showhideTable();

                });
            } else {

                $('#seasonTable tr td.season-filter-conf').each(function (e) {
                    var rowConf = $(this).data('confid');

                    if (rowConf - selectedConf === 0) {
                    } else {
                        $(this).closest('tr').hide();
                    }
                });
            }
        });

        //Filter Season Table By Division Once a Dropdown Item Is Selected
        $('#divFilter').change(function () {

            //Filter elements on selected option
            $('#seasonTable tr td.season-filter-div').each(function (e) {
                $(this).closest('tr').show();
            });
            showhideTable();
            var selectedDiv = $(this).val();

            if (selectedDiv === '0') {
                $('#seasonTable tr td.season-filter-div').each(function (e) {
                    $(this).closest('tr').show();
                    showhideTable();

                });
            } else {

                $('#seasonTable tr td.season-filter-div').each(function (e) {
                    var rowDiv = $(this).data('divid');

                    if (rowDiv - selectedDiv === 0) {
                    } else {
                        $(this).closest('tr').hide();
                    }
                });
            }
        });

        //Filter Season Table By Conf Champ Value Once a Dropdown Item Is Selected
        $('#confchampFilter').change(function () {

            //Filter elements on selected option
            $('#seasonTable tr td.season-filter-confChamp').each(function (e) {
                $(this).closest('tr').show();
            });
            showhideTable();
            var selectedConfChamp = $(this).val();

            if (selectedConfChamp === '0') {
                $('#seasonTable tr td.season-filter-confChamp').each(function (e) {
                    $(this).closest('tr').show();
                    showhideTable();

                });
            } else {

                $('#seasonTable tr td.season-filter-confChamp').each(function (e) {
                    var rowConfChamp = $(this).data('confchampval');

                    if (rowConfChamp === selectedConfChamp) {
                    } else {
                        $(this).closest('tr').hide();
                    }
                });
            }
        });

        //Filter Season Table By National Champ Value Once a Dropdown Item Is Selected
        $('#natchampFilter').change(function () {

            //Filter elements on selected option
            $('#seasonTable tr td.season-filter-natChamp').each(function (e) {
                $(this).closest('tr').show();
            });
            showhideTable();
            var selectedNatChamp = $(this).val();

            if (selectedNatChamp === '0') {
                $('#seasonTable tr td.season-filter-natChamp').each(function (e) {
                    $(this).closest('tr').show();
                    showhideTable();

                });
            } else {

                $('#seasonTable tr td.season-filter-natChamp').each(function (e) {
                    var rowNatChamp = $(this).data('natchampval');

                    if (rowNatChamp === selectedNatChamp) {
                    } else {
                        $(this).closest('tr').hide();
                    }
                });
            }
        });

        /* Interaction Functions */
        //Change the season view to table
        $("#season_table_btn").click(function () {
            $.ajax(
                    {
                        url: "libs/ajax/update_season_view.php",
                        type: "POST",
                        data: {new_view: "Table"},
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
        //Change the season view to games
        $("#season_games_btn").click(function () {
            $.ajax(
                    {
                        url: "libs/ajax/update_season_view.php",
                        type: "POST",
                        data: {new_view: "Games"},
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
        //Go to opponent detail page and send which opponent should be displayed
        $('.oppDetail').click(function (e) {
            var OppID = $(e.target).data("oppid");
            var form = document.createElement('form');
            document.body.appendChild(form);
            form.method = 'post';
            form.action = 'opponentDetails.php';
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = "OppID";
            input.value = OppID;
            form.appendChild(input);
            form.submit();
        });
    });

    /* Support Functions */
    //Take a start year and end year and calculate the win, loss and ties for that span
    //Used AJAX because it is called via javascript and result needs to be displayed client side
    function calcProgramRecord(startYear, endYear) {

        var start = startYear;
        var end = endYear;

        $.ajax(
                {
                    url: "libs/ajax/calc_program_record.php",
                    type: "POST",
                    data: {start: start, end: end},
                    success: function (data, textStatus, jqXHR)
                    {
                        $('#programWins').text(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Form Did Not Process: " + errorThrown);
                    }
                });




    }
</script>