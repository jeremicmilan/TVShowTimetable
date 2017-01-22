<html>
    <head>
        <title>TVShows Timetable</title>

        <?php include "include/stylesheets.php" ?>
        <?php include "include/scripts.php" ?>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body onload="onloadSearch('<?php echo $this->model->keyword; ?>')">
        <?php include 'include/nav.php' ?>

        <div class="container">
            <div class = "row" style="margin-top: 10px">
                <div class="col-md-12">
                    <div id="custom-search-input">
                        <div class="input-group col-md-6">
                            <input id="omdb_title" type="text" class="form-control input-lg" placeholder="Search..." value="<?php echo $this->model->keyword; ?>" />
                            <span class="input-group-btn">
                                <button class="btn btn-info btn-lg" type="submit" onclick="search()">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include "include/loading.php" ?>

        <div id="db_results"></div>

        <div id="omdb_results"></div>
    </body>
</html>


