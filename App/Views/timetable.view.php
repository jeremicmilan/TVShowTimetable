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

    <div class="container" style="margin-top: 10px;>
        <div class = "row" style="margin-top:10px">
            <?php foreach($this->model->days as $day => $episodes) { ?>
                <div class = "row" style="font-weight:bold">
                    <div class="bg-info">
                        <h3>
                            <?php if ($day == date("Y-m-d")) { ?>
                                Today
                            <?php } elseif ($day == date("Y-m-d", strtotime(date("Y-m-d"). " + 1 days"))) { ?>
                                Tomorrow
                            <?php } else {
                                echo date("l", strtotime($day));
                            } ?>
                        </h3>
                    </div>
                    <div class = "row">
                        <?php foreach($episodes as $episode) { ?>
                            <a href="#" onclick="redirect('tvshow','index', ['<?php echo $episode["tvshow_id"];?>'])">
                                <div class = "col-md-2">
                                    <div class="title">
                                        <h4 align="center"><?php echo $episode["tvshow_name"]; ?></h4>
                                    </div>

                                    <div class = "thumbnail" style="height:250px; display:table-cell; vertical-align:middle; text-align:center">
                                        <img style="height:auto; width:100%" src="<?php echo $episode["picture"]; ?>">
                                    </div>

                                    <div class = "caption">
                                        <h4 align="center"><?php echo $episode["title"]; ?></h4>
                                    </div>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>

