<html>
    <head>
        <title>TVShows Timetable</title>

        <?php include "include/stylesheets.php" ?>
        <?php include "include/scripts.php" ?>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>
    <body>
        <?php include 'include/nav.php' ?>
        <?php include 'include/search_bar.php' ?>

        <div class = "row" style="margin-top: 10px">
            <?php foreach($this->model->shows as $show) { ?>
                <a href="#" onclick="redirect('tvshow','index', ['<?php echo $show["tvshow_id"];?>'])">
                    <div class = "col-md-2">
                        <div class = "thumbnail">
                            <img src="<?php echo $show["picture"] ?>" width="150">
                        </div>

                        <div class = "caption">
                            <h4 align="center"><?php echo $show["title"]; ?></h4>
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>
    </body>
</html>

