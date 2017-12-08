<?php include_once('templates/common/header.php'); 

    if(isset($_SESSION['registerMessage'])) {
        $message = $_SESSION['registerMessage'];
    }
    else 
        $message = '';

    if(isset($_SESSION['fullname'])) {
        $fullname = '"'.$_SESSION['fullname'].'"';
    }
    else 
        $fullname = '';
    if(isset($_SESSION['shortDescription'])) {
        $shortDescription = $_SESSION['shortDescription'];
    }
    else 
        $shortDescription = '';

?>

<script src="user_reg.js" defer></script>
<section class="main_area" id="register">
    <h1> User Registration </h1>
    <p class="messages"> 
            <?php 
                echo $message;
                resetSessionVariables();
            ?>
    </p>

        <form id="registrationForm" action="action_register_user.php" method="post" enctype="multipart/form-data">

            <label for="username">Username</label>  
            <input type="text" name="username" id="username"/>
            <label for="pwd"> Password </label>
            <input type="password" name="password" id="pwd"/>
            <label for="repeatPassword"> Repeat Password </label>
            <input type="password" id="repeatPassword"/>
            <label for="fullname"> Full Name </label>
            <input type="text" name="fullname" id="fullname" value=<?=$fullname?>>
            <label for="bio"> Bio </label>
            <textarea name="shortDescription" id="bio"><?=$shortDescription?></textarea>
            <label for="profileImage">Profile Picture</label>
            <input type="file" name="profileImage">
            <img id="profilePicture">
            <input type="submit" value="Register"/>

        </form>
</section>

<?php include_once('templates/common/footer.php'); ?>