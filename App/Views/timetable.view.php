<html>
    <head></head>
    <body>
        <?php include 'include/nav.php' ?>

        <table>
            <?php foreach($shows as $show) { ?>
                <tr>
                    <th><?php echo $show["title"]; ?> </th>
                    <th><?php echo $show["description"]; ?> </th>
                </tr>
            <?php } ?>
        </table>
    </body>
</html>

