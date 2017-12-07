<?php
    include_once('utils/utils_user.php');
    session_start();
    if(!logged())
        header('Location: '.'login.php');

    else
        header('Location: '.'main.php');

?>