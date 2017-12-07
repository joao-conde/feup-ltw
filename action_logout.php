<?php 
    include_once('utils/utils_user.php');
    session_start();
    if (logout())
        header('Location: '. 'login.php');
?>