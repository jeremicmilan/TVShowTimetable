<html>
    <head>
        <title>TVShows Timetable</title>

        <?php include "include/scripts.php" ?>
    </head>
    <body>
        <?php include 'include/nav.php' ?>

        <table>
            <?php foreach($this->model->shows as $show) { ?>
                <tr>
                    <th><?php echo $show["title"]; ?> </th>
                    <th><?php echo $show["description"]; ?> </th>
                </tr>
            <?php } ?>
        </table>
    </body>
</html>

