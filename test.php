<html>
    <head>
        <title>PHP Test</title>
    </head>
    <body>
        <?php 
            include_once("database/colaborators.php");
            $cols = getColaborators('leonardomgt');

            print_r($cols);
        ?> 
    </body>
</html>