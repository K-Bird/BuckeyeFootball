<html>
    <head>
        <title>Buckeyes - Data</title>
        <link rel="shortcut icon" href="http://www.iconj.com/ico/y/f/yfuwmmd6a8.ico" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="libs/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="libs/css/nouislider.css">
        <link rel="stylesheet" type="text/css" href="libs/css/open-iconic-bootstrap.css">
        <link rel="stylesheet" type="text/css" href="libs/css/common.css">
        <script src="libs/js/jquery.js"></script>
        <script src="libs/js/bootstrap.js"></script>
        <script src="libs/js/nouislider.js"></script>
        <script src="libs/js/wNumb.js"></script>
        <script src="libs/js/stupidtable.js"></script>
        <script src="libs/js/commonFunctions.js"></script>
    </head>
    <body>
        <?php include ('nav/navBar.php'); ?>
        <div class="container-fluid" style="text-align: center">
            <div class="row">
                <div class="col-lg-12">
                    <!-- show the media navigation bar under the main nav bar -->
                    <?php include ('parts/data/topDataNav.php'); ?>
                </div>
            </div>
    </body>
</html>
<script>
    $(document).ready(function () {

        //Set defualts for localstorage for data navigation panels if values do not exist
        if (localStorage.getItem('OSU_Data_Top_Nav') === null) {
            localStorage.setItem('OSU_Data_Top_Nav', 'Program');
        }

        //If last tab selected was photos open the photos tab
        if (localStorage.getItem('OSU_Data_Top_Nav') === 'Program') {
            $('#program-tab-mainnav').tab('show');
        }
        //If last tab selected was photos open the photos tab
        if (localStorage.getItem('OSU_Data_Top_Nav') === 'Leaders') {
            $('#leaders-tab-mainnav').tab('show');
        }
        //If last tab selected was photos open the photos tab
        if (localStorage.getItem('OSU_Data_Top_Nav') === 'Explore') {
            $('#explore-tab-mainnav').tab('show');
        }

        //on any tab change
        $('a[data-toggle="tab"], a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
            var target = $(e.target).attr("href"); // activated tab

            if (target === '#dataProgramTab') {
                localStorage.setItem('OSU_Data_Top_Nav', 'Program');
            }
            if (target === '#dataLeadersTab') {
                localStorage.setItem('OSU_Data_Top_Nav', 'Leaders');
            }

            if (target === '#dataExploreTab') {
                localStorage.setItem('OSU_Data_Top_Nav', 'Explore');
            }
        });

        /* Year Slider  */
        //If there is no start year, set it to 1990
        var startYearData = localStorage['startYearData'];
        if (!startYearData) {
            localStorage['startYearData'] = 1990;
        }
        //If there is no start year, set it to this year
        var endYearData = localStorage['endYearData'];
        if (!endYearData) {
            localStorage['endYearData'] = new Date().getFullYear();
        }

        /* Controls */
        //Build the year slider 
        var slider = document.getElementById('DataYearSlider');

        noUiSlider.create(slider, {
            start: [startYearData, endYearData],
            connect: true,
            range: {
                'min': 1890,
                'max': (new Date()).getFullYear()
            },
            step: 1,
            tooltips: [wNumb({decimals: 0}), wNumb({decimals: 0})],
        });
        //When slider handle is moved set the years, display appropriate years and reload leaders for given timeframe
        slider.noUiSlider.on('end', function () {

            var yearArray = this.get();
            var startYearData = Math.trunc(yearArray[0]);
            var endYearData = Math.trunc(yearArray[1]);

            localStorage.setItem('startYearData', startYearData);
            localStorage.setItem('endYearData', endYearData);
            var stat = localStorage['dataLeaderStat'];
            returnStatLeaders(stat, startYearData, endYearData);


        });
        //Set the data points for the decade buttons and upon click show/hide appropriate years and recalculate program record
        $(".dataDecadeSlider").click(function () {

            var slider = document.getElementById('DataYearSlider');
            var decade = $(this).data('decade');
            var currentYear = new Date().getFullYear();

            if (decade === 'all') {
                slider.noUiSlider.set([1890, currentYear]);
                localStorage['startYearData'] = 1890;
                localStorage['endYearData'] = currentYear;

            }
            if (decade === '1890s') {
                slider.noUiSlider.set([1890, 1899]);
                localStorage['startYearData'] = 1890;
                localStorage['endYearData'] = 1899;

            }
            if (decade === '1900s') {
                slider.noUiSlider.set([1900, 1909]);
                localStorage['startYearData'] = 1900;
                localStorage['endYearData'] = 1909;

            }
            if (decade === '1910s') {
                slider.noUiSlider.set([1910, 1919]);
                localStorage['startYearData'] = 1910;
                localStorage['endYearData'] = 1919;

            }
            if (decade === '1920s') {
                slider.noUiSlider.set([1920, 1929]);
                localStorage['startYearData'] = 1920;
                localStorage['endYearData'] = 1929;

            }
            if (decade === '1930s') {
                slider.noUiSlider.set([1930, 1939]);
                localStorage['startYearData'] = 1930;
                localStorage['endYearData'] = 1939;

            }
            if (decade === '1940s') {
                slider.noUiSlider.set([1940, 1949]);
                localStorage['startYearData'] = 1940;
                localStorage['endYearData'] = 1949;

            }
            if (decade === '1950s') {
                slider.noUiSlider.set([1950, 1959]);
                localStorage['startYearData'] = 1950;
                localStorage['endYearData'] = 1959;

            }
            if (decade === '1960s') {
                slider.noUiSlider.set([1960, 1969]);
                localStorage['startYearData'] = 1960;
                localStorage['endYearData'] = 1969;

            }
            if (decade === '1970s') {
                slider.noUiSlider.set([1970, 1979]);
                localStorage['startYearData'] = 1970;
                localStorage['endYearData'] = 1979;

            }
            if (decade === '1980s') {
                slider.noUiSlider.set([1980, 1989]);
                localStorage['startYearData'] = 1980;
                localStorage['endYearData'] = 1989;

            }
            if (decade === '1990s') {
                slider.noUiSlider.set([1990, 1999]);
                localStorage['startYearData'] = 1990;
                localStorage['endYearData'] = 1999;

            }
            if (decade === '2000s') {
                slider.noUiSlider.set([2000, 2009]);
                localStorage['startYearData'] = 2000;
                localStorage['endYearData'] = 2009;

            }
            if (decade === '2010s') {

                var currYear = (new Date()).getFullYear()

                slider.noUiSlider.set([2010, currYear]);
                localStorage['startYearData'] = 2010;
                localStorage['endYearData'] = currYear;

            }
            returnStatLeaders(localStorage['dataLeaderStat'], localStorage['startYearData'], localStorage['endYearData']);

        });

        /*Interactions*/
        //When New Stat is Selected From a leaders dropdown
        $('.dataSelect').change(function () {

            var stat = $(this).val();
            var startYear = localStorage['startYearData'];
            var endYear = localStorage['endYearData'];
            localStorage.setItem('dataLeaderStat', stat);
            $(this)[0].selectedIndex = 0;
            $("#leadersTitle").replaceWith(returnLeadersTitle(stat));
            returnStatLeaders(stat, startYear, endYear);

        });

    });

    function returnLeadersTitle(stat) {
        
        /* Passing Stats */
        if (stat === "passComp") {
            return '<div id="leadersTitle" class="card"><div class="card-body"><h6>Passing Completion Leaders</h6></div></div>';
        }
        if (stat === "passAtt") {
            return '<div id="leadersTitle" class="card"><div class="card-body"><h6>Passing Attempts Leaders</h6></div></div>';
        }
        if (stat === "passYards") {
            return '<div id="leadersTitle" class="card"><div class="card-body"><h6>Passing Yards Leaders</h6></div></div>';
        }
        if (stat === "passTDs") {
            return '<div id="leadersTitle" class="card"><div class="card-body"><h6>Passing TDs Leaders</h6></div></div>';
        }
        if (stat === "passINTs") {
            return '<div id="leadersTitle" class="card"><div class="card-body"><h6>Passing INTs Leaders</h6></div></div>';
        }
        /* Rushing Stats */
        if (stat === "rushAtt") {
            return '<div id="leadersTitle" class="card"><div class="card-body"><h6>Rush Attempts Leaders</h6></div></div>';
        }
        if (stat === "rushYards") {
            return '<div id="leadersTitle" class="card"><div class="card-body"><h6>Rush Yards Leaders</h6></div></div>';
        }
        if (stat === "rushTDs") {
            return '<div id="leadersTitle" class="card"><div class="card-body"><h6>Rush TDs Leaders</h6></div></div>';
        }
        /* Recieving Stats */
        if (stat === "recRec") {
            return '<div id="leadersTitle" class="card"><div class="card-body"><h6>Receptions Leaders</h6></div></div>';
        }
        if (stat === "recYards") {
            return '<div id="leadersTitle" class="card"><div class="card-body"><h6>Receiving Yards Leaders</h6></div></div>';
        }
        if (stat === "recTDs") {
            return '<div id="leadersTitle" class="card"><div class="card-body"><h6>Receiving TDs Leaders</h6></div></div>';
        }
        /* Defensive Stats */
        if (stat === "defTackles") {
            return '<div id="leadersTitle" class="card"><div class="card-body"><h6>Tackle Leaders</h6></div></div>';
        }
        if (stat === "defForLoss") {
            return '<div id="leadersTitle" class="card"><div class="card-body"><h6>Tackles For Loss Leaders</h6></div></div>';
        }
        if (stat === "defSacks") {
            return '<div id="leadersTitle" class="card"><div class="card-body"><h6>Sack Leaders</h6></div></div>';
        }
        /* Kicking Stats */
        if (stat === "kickFGM") {
            return '<div id="leadersTitle" class="card"><div class="card-body"><h6>Most Field Goals Made</h6></div></div>';
        }
        /* Punting Stats */
        if (stat === "puntYards") {
            return '<div id="leadersTitle" class="card"><div class="card-body"><h6>Punt Yard Leaders</h6></div></div>';
        }
    }

    function returnStatLeaders(stat, startYear, endYear) {

        $.ajax(
                {
                    url: "libs/ajax/return_stat_leaders.php",
                    type: "POST",
                    data: {stat: stat, start: startYear, end: endYear},
                    success: function (data, textStatus, jqXHR)
                    {
                        $('#leadersDiv').replaceWith(data);
                        $('#leadersTitle').replaceWith(returnLeadersTitle(stat));
                        $('#leadersTable').stupidtable();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert("Stats Could Not Be Loaded: " + errorThrown);
                    }
                });


    }
</script>