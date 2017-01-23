<div class = "container" style="margin-top: 10px">
    <div class="row">
        <?php
        if ($this->model->error == false)
        {
            $i = -1;
            foreach($this->model->search_results as $show) {
            $i++;
            if($i == 6) {
                $i = 0; ?>
                </div>
                <div class="row">
            <?php } ?>

            <a href="#" onclick="redirect('tvshow','index', ['<?php echo $show->imdbID;?>'])">
                <div class = "col-md-2">
                    <div class = "thumbnail" style="height:250px; width:200px; display:table-cell; vertical-align:middle; text-align:center">
                        <img style="height:auto; width:100%" src="<?php echo $show->Poster == "N/A" ? "/TVShowsTimetable/public/img/default_img.png" : $show->Poster; ?>"/>
                    </div>

                    <div class = "caption">
                        <h4 align="center"><?php echo $show->Title; ?></h4>
                    </div>
                </div>
            </a>
        <?php }
        } else { ?>
            <h4 align="center" style="color: red"><?php echo $this->model->error; ?></h4>
        <?php } ?>
    </div>
</div>