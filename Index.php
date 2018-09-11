<html>
    <head>
        <title>OSU - DEV</title>
        <link rel="stylesheet" type="text/css" href="libs/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="libs/css/common.css">
        <script src="libs/js/jquery.js"></script>
        <script src="libs/js/bootstrap.js"></script>
        <script src="libs/js/tubular.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <?php include ('nav/navBar.php'); ?>
        </div>

    </body>
</html>
<script>
    $(document).ready(function () {
        var options = {videoId: 'MI1qxsWnJJo', start: 3};
        $('#wrapper').tubular(options);

    });
</script>