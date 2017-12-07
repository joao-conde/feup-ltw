<?php

    include('database/user.php');
    include('utils/utils_user.php');

    $options = ['cost' => 12];
    $username = strtolower($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT, $options);
    $fullnamelc = strtolower($_POST['fullname']);
    $fullname = ucwords($fullnamelc);
    $shortDescription = $_POST['shortDescription'];
    
    $resultError = insertUser($username,$password,$fullname,$shortDescription);

    if($resultError=='00000') {
        setGoodRegistrationUser($username);
        uploadProfilePicture();
        header('Location: '.'login.php?username='.$username);
    }
    else if($resultError=='23000') {
        setRepeatedUser($fullname,$shortDescription);
        header('Location: '.'register.php');
    }
    

?>