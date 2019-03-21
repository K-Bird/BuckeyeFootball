<html>
    <head>
        <title>Buckeyes</title>
        <link rel="shortcut icon" href="http://www.iconj.com/ico/y/f/yfuwmmd6a8.ico" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="libs/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="libs/css/common.css">
        <script src="libs/js/jquery.js"></script>
        <script src="libs/js/bootstrap.js"></script>
        <script src="libs/js/tubular.js"></script>
    </head>
    <body>
        <!-- wrapper div enables tubular video to play over entire page minus the navigation bar -->
        <div id="wrapper">
            <!-- include main navigation bar at top of page -->
            <?php include ('nav/navBar.php'); ?>
        </div>
    </body>
</html>
<script>
    $(document).ready(function () {
        /* set options for tubular plugin video: video id of youtube video and start time in seconds */
        var options = {videoId: 'MI1qxsWnJJo', start: 0};
        /* player video in wrapper with the given options */
        $('#wrapper').tubular(options);
    });
</script>