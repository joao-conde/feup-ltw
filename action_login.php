<?php
    session_start();

    print_r($_SESSION);

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $user = getUser($username,$password);

    print_r($user);

    if(!empty($user)) {
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $user['fullname'];

    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);


?>