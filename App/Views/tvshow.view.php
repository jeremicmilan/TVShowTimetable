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

        <div class="container">
            <div class="row" style="margin-top: 10px">

                <div class="col-md-4">
                    <img src="<?php echo $this->model->tvshow_info["picture"] ?>">
                </div>
                    <div class="col-md-8">
                        <h2 ><?php echo $this->model->tvshow_info["title"]; ?></h2>
                        <h5 ><?php echo $this->model->tvshow_info["description"]; ?></h5>
                    </div>
                    <?php if ($this->model->isFollowed) { ?>
                        <button onclick="redirect('tvshow','unfollow', ['<?php echo $this->model->tvshow_info["tvshow_id"] ?>'])">Unfollow</button>
                    <?php } else { ?>
                        <button onclick="redirect('tvshow','follow', ['<?php echo $this->model->tvshow_info["tvshow_id"] ?>'])">Follow</button>
                    <?php } ?>
            </div>


            <?php for($i=0; $i < $this->model->season_count; $i++) { ?>
                <div class="panel-group" style="margin-top: 10px">
                    <div class="panel panel-default">
                        <a data-toggle="collapse" href="#collapse<?php echo $i; ?>" >
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    Season <?php echo $i+1; ?>
                                </h4>
                            </div>
                        </a>
                        <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse">
                            <div class="panel-body">
                                <?php foreach($this->model->seasons[$i]["episodes"] as $episode) { ?>
                                        <table>
                                            <tr><td><?php echo $episode["title"]; ?></td><td><?php echo $episode["airdate"]; ?></td></tr>
                                        </table>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </body>
</html>
