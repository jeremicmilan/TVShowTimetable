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
    <?php
    if(!empty($this->model->database_results))

        foreach($this->model->database_results as $show) { ?>
            <a href="#" onclick="redirect('tvshow','index', [<?php echo $show["TVShow_id"];?>])">
                <div class = "col-md-2">
                    <div class = "thumbnail">
                        <img src="<?php echo $show["picture"] ?>" width="150">
                    </div>

                    <div class = "caption">
                        <h4 align="center"><?php echo $show["title"]; ?></h4>
                    </div>
                </div>
            </a>
        <?php } else { ?>
            <h4 align="center" style="color: red; margin: 20px;">No results found</h4>
    <?php } ?>

    <div style="margin-top: 10px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Add New TV Show</h4>
                    <div id="custom-search-input">
                        <div class="input-group col-md-6">
                            <input id="title" type="text" class="form-control input-lg" placeholder="Search..." />
                            <span class="input-group-btn">
                            <button class="btn btn-info btn-lg" type="button" onclick="redirect('search', 'searchOmdbByTitle', [document.getElementById('title').value])">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
</body>
</html>


