<html>
<head>
    <title>TVShows Timetable</title>

    <?php include "include/scripts.php" ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<?php include 'include/nav.php' ?>
<div style="margin-top: 10px">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="custom-search-input">
                    <div class="input-group col-md-6">
                        <input type="text" class="form-control input-lg" placeholder="Search..." />
                        <span class="input-group-btn">
                        <button class="btn btn-info btn-lg" type="button">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="container">
    <div class="row" style="margin-top: 10px">

        <div class="col-md-4">
            <img src="<?php echo $this->model->tvshow_info["picture"] ?>">
        </div>


        <div class="col-md-8">
            <h2 ><?php echo $this->model->tvshow_info["title"]; ?></h2>
            <h5 ><?php echo $this->model->tvshow_info["description"]; ?></h5>
        </div>

    </div>
</div>

    <?php foreach($this->model->episodes_info as $episode) { ?>

    <?php } ?>

</div>
</body>
</html>
