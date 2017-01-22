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
                    <img style="height:auto; width:75%" src="<?php echo $this->model->tvshow_info["picture"] ?>">
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-10">
                            <h1 ><?php echo $this->model->tvshow_info["title"]; ?></h1>
                        </div>
                        <div class="col-md-2">
                            <?php if ($this->model->isFollowed) { ?>
                                <button class="btn btn-info" onclick="redirect('tvshow','unfollow', ['<?php echo $this->model->tvshow_info["tvshow_id"] ?>'])">Unfollow</button>
                            <?php } else { ?>
                                <button class="btn btn-primary" onclick="redirect('tvshow','follow', ['<?php echo $this->model->tvshow_info["tvshow_id"] ?>'])">Follow</button>
                            <?php } ?>
                        </div>
                    </div>
                    <h5 ><?php echo $this->model->tvshow_info["description"]; ?></h5>
                </div>
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
                                <table>
                                <?php foreach($this->model->seasons[$i]["episodes"] as $episode) { ?>
                                        <td>
                                            <div class = "thumbnail" style="height:235px; display:table-cell; vertical-align:middle; text-align:center">
                                                <img src="<?php echo $episode["picture"]; ?>">
                                            </div>
                                        </td>
                                        <td style="padding-left:10px; border-bottom: 1px solid #DDDDDD; border-top: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD"">
                                            <div style="padding-right:10px"><?php echo $episode["title"]; ?></div>
                                        </td>
                                        <td style="padding-left:10px; border-bottom: 1px solid #DDDDDD; border-top: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD"">
                                            <div style="padding-right:10px"><?php echo $episode["airdate"]; ?></div>
                                        </td>
                                        <td style="padding-left:10px; width:450px; border-bottom: 1px solid #DDDDDD; border-top: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD">
                                            <div style="text-align: justify; padding-right:10px"> <?php echo $episode["description"]; ?> </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </body>
</html>
