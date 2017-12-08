<?php
    include_once('templates/common/header.php');
    include_once('utils/utils_general.php');

    if(!logged())
        redirect('index.php');

    $username = $_SESSION['username'];
    $fullname = $_SESSION['fullName'];
    $shortDescription = $_SESSION['bio'];
    $picture = getUserImagePath($username);

    if(isset($_SESSION['updateMessage']))
        $message = $_SESSION['updateMessage'];

?>

<script src="user_update.js" defer></script>
<section class="main_area" id="profile">
    <h1> User Profile </h1>
    <p class="messages"> 
            <?php 
                if(isset($_SESSION['updateMessage']))
                    echo $message;
                $_SESSION['updateMessage'] = '';
            ?>
    </p>

        <form id="registrationForm" action="action_update_user.php" method="post" enctype="multipart/form-data">

            <label for="username">Username</label>  
            <input type="text" name="username" id="username" value=<?='"'.$username.'"'?>/>
            <label for="oldpwd"> Old Password </label>
            <input type="password" name="oldpassword" id="oldpwd"/>
            <label for="pwd"> Password </label>
            <input type="password" name="password" id="pwd"/>
            <label for="repeatPassword"> Repeat Password </label>
            <input type="password" id="repeatPassword"/>
            <label for="fullname"> Full Name </label>
            <input type="text" name="fullname" id="fullname" value=<?='"'.$fullname.'"'?>>
            <label for="bio"> Bio </label>
            <textarea name="shortDescription" id="bio"><?=$shortDescription?></textarea>
            <label for="profileImage">Profile Picture</label>
            <input type="file" name="profileImage">
            <img id="profilePicture" alt="No Profile Picture" src=<?=$picture?>>
            <input type="submit" value="Save">

        </form>
</section>
    
<?php
    include_once('templates/common/footer.php');


?>