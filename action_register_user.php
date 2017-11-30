<?php

    include('database/user.php');
    $options = ['cost' => 12];
    

    print_r($_POST);

    $username = strtolower($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT, $options);
    $fullname = strtolower($_POST['fullname']);
    $shortDescription = $_POST['shortDescription'];
    
    print_r($username);
    print_r($password);
    print_r($fullname);
    print_r($shortDescription);

    insertUser($username,$password,$fullname,$shortDescription);




?>