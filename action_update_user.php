<?php

    include('database/user.php');
    include('utils/utils_user.php');
    include('utils/utils_general.php');

    $username = strtolower($_POST['username']);
    $oldusername = $_SESSION['username'];
    $user = getUser($oldusername);
    $oldpassword = $_POST['oldpassword'];

    if(!verifyPassword($user,$oldpassword)) {

        setWrongPasswordUserUpdate();
        redirect('profile.php');
    
    }

    $options = ['cost' => 12];    
    $password = $_POST['password'] == "" ? "" : password_hash($_POST['password'], PASSWORD_DEFAULT, $options);
    $fullnamelc = strtolower($_POST['fullname']);
    $fullname = ucwords($fullnamelc);
    $shortDescription = $_POST['shortDescription'];
    
    $resultError = updateUser($username,$fullname,$shortDescription,$_SESSION['username']);

    if($oldusername != $username)
        updateProfilePicture($username,$oldusername);

    $logout = false;

    if($_POST['password'] != '') {

        updateUserPassword($username,$password);
        $logout = true;
    }

    if($oldusername != $username)
        $logout = true;

    
    if($resultError=='00000') {

        if($logout == true)
            setGoodUpdatedUserWLO($username);
        else
            setGoodUpdatedUserWWLO($username);

        uploadProfilePicture($username);
    }
    else if($resultError=='23000') {
        setRepeatedUserUpdate($fullname,$shortDescription);
    }

    if($logout == true) {
        logout();
        redirect('login.php?username='.$username);
    }

    else
        redirect('profile.php');

    print_r($resultError);

    print_r($fullname);

    print_r($oldpassword);
    

?>