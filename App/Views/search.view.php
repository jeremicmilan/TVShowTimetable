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

        <div class="container" style="margin-top: 80px;>
            <div class = "row" style="margin-top: 10px">
                <div class="col-md-12">
                    <div id="custom-search-input">
                        <div class="col-md-3"></div>
                        <div class="input-group col-md-6">
                            <input id="search_keyword" onkeypress="enter(event)" type="text" class="form-control input-lg" placeholder="Search..." value="<?php echo $this->model->keyword; ?>" style="height:40px;"/>
                            <span class="input-group-btn">
                                <button id="search_button" class="btn btn-info btn-lg" type="button" onclick="getFromServer(search, 'search', 'index', [document.getElementById('search_keyword').value])">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </span>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
        </div>

        <?php include "include/loading.php" ?>

        <div id="db_results"></div>

        <div id="omdb_results"></div>
    </body>
</html>


