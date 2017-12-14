<?php
    include_once('database/user.php');
    session_start();
    
    function logged() {
        return isset($_SESSION['username']) && !empty($_SESSION['username']) && isset($_SESSION['pwd']) && $_SESSION['pwd'];
    }

    function resetSessionVariables() {
        $_SESSION = array();
    }

    function getUserFullName() {
        return $_SESSION['fullName'];
    }

    function getUserImagePathTN($username) {
        $path = "user_profile_images/".$username."_tn.jpg";

        if(file_exists($path))
            return $path;
        
        else
            return "images/anonymous-user.svg"; 

    }

    function getUserImagePath($username) {
        $path = "user_profile_images/".$username.".jpg";

        if(file_exists($path))
            return $path;
        
        else
            return ""; 

    }



    function verifyPassword($user, $password) {
        return !empty($user) && password_verify($password,$user['encryptedPassword']);
    }

    function setUserSession($user) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['fullName'] = $user['fullName'];
        $_SESSION['bio'] = $user['shortDescription'];
        $_SESSION['pwd'] = 1;
    }

    function setNoUserSession() {
        $_SESSION['errorMessageLogin'] = '*Oops, there is no user with this username! Please Try Again.';
    }

    function setWrongPassword() {
        $_SESSION['errorMessageLogin'] = '*Oops, password wrong for this user! Please Try Again.';
    }

    function setGoodRegistrationUser($username) {
        $_SESSION['registerMessage'] = '*Registration Successful! Please login.';
    }

    function setGoodUpdatedUserWLO($username) {
        $_SESSION['updateMessage'] = '*Profile Updated Successful!';
    }

    function setGoodUpdatedUserWWLO($username) {
        $_SESSION['updateMessage'] = '*Profile Updated Successful!';
        $user = getUser($username);
        setUserSession($user);
    }

    function setRepeatedUser($fullname,$shortDescription) {
        $_SESSION['fullname'] = $fullname;
        $_SESSION['shortDescription'] = $shortDescription;
        $_SESSION['registerMessage'] = '*Duplicated username! Please choose a different one.';
    }

    function setRepeatedUserUpdate($fullname,$shortDescription) {
        $_SESSION['fullname'] = $fullname;
        $_SESSION['shortDescription'] = $shortDescription;
        $_SESSION['updateMessage'] = '*Duplicated username! Please choose a different one.';
    }

    function setWrongPasswordUserUpdate() {
        $_SESSION['updateMessage'] = '*Oops, password wrong for this user! Please Try Again.';
    }

    function updateProfilePicture($username, $oldusername) {

        $oldfilename = "user_profile_images/".$oldusername.".jpg";
        $oldfilename_tn = "user_profile_images/".$oldusername."_tn.jpg";

        if(!file_exists($oldfilename))
            return false;

        $newfilename = "user_profile_images/".$username.".jpg";
        $newfilename_tn = "user_profile_images/".$username."_tn.jpg";

        rename($oldfilename,$newfilename);
        rename($oldfilename_tn,$newfilename_tn);

        return true;


    }



    function uploadProfilePicture($username) {

        $file = $_FILES['profileImage'];
        $goodImage = false;
        $extension = ".jpg";
        
        if($file['type'] == "image/jpeg") {
            $goodImage = true;
        
            $original = imagecreatefromjpeg($file['tmp_name']);
            $width = imagesx($original);   
            $height = imagesy($original);
        }

        else if($file['type'] == "image/png") {
            $goodImage = true;

            $original = imagecreatefrompng($file['tmp_name']);
            $width = imagesx($original);   
            $height = imagesy($original);

        }

        else if($file['type'] == "image/gif") {
            $goodImage = true;

            $original = imagecreatefromgif($file['tmp_name']);
            $width = imagesx($original);   
            $height = imagesy($original);

        }
 
        if($goodImage) {

            $normalPath = "user_profile_images/".$username.$extension;
            $thumbnailPath = "user_profile_images/".$username."_tn".$extension;


            $normal = imagecreatetruecolor(300, 300);
            imagecopyresized($normal, $original, 0, 0, 0, 0, 300, 300, $width, $height);

            $thumbnail = imagecreatetruecolor(80, 80);
            imagecopyresized($thumbnail, $original, 0, 0, 0, 0, 80, 80, $width, $height);

            imagejpeg($normal,$normalPath);
            imagejpeg($thumbnail,$thumbnailPath);

        }

    }

    function logout() {

        if (logged()) {
            
            $params = session_get_cookie_params();
            
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]);
            
            session_destroy();
            resetSessionVariables();
            
            return true;
    
        }
        return false;

    }

?>