<?php 
    include_once('utils/utils_user.php');
    if (logout())
        header('Location: '. 'login.php');
?>