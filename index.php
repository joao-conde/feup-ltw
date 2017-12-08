<?php
    include_once('utils/utils_user.php');
    var_dump($_SESSION);

    if(!logged())
        header('Location: '.'login.php');

    else
        header('Location: '.'main.php');

?>