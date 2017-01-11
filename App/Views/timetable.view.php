<html>
    <head></head>
    <body>
        <div align = "right">
            <button type="button" onclick="document.location.href=\'pages/logout\';" >Log out</button>
        </div>

        <table>
            <?php foreach($shows as $i => $show) { ?>
                <tr>
                    <th><?php echo $show->getTitle(); ?> </th>
                    <th><?php echo $show->getDescription(); ?> </th>
                </tr>
            <?php } ?>
        </table>
    </body>
</html>

