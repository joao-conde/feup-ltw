<?php
    include_once('database/user.php');
    include_once('utils/utils_user.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    $_SESSION['username'] = $username;
    $user = getUser($username);

    if(empty($user)) {
        setNoUserSession();
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }

    else {

        if(verifyPassword($user,$password)) {
            setUserSession($user);
            header('Location: '.'index.php');
        
        }

        else {

            setWrongPassword();
            header('Location: '.$_SERVER['HTTP_REFERER']);

        }

    }

?>