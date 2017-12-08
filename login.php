<?php 
    include_once('templates/common/header.php'); 

    if(isset($_GET['username']))
        $username = htmlentities($_GET['username']);
    else
        $username = '';

    if(isset($_SESSION['errorMessageLogin'])) {
        $message = $_SESSION['errorMessageLogin'];
    }
    else if(isset($_SESSION['registerMessage'])) {
        $message = $_SESSION['registerMessage'];
    }

    else if(isset($_SESSION['updateMessage'])) {
        $message = $_SESSION['updateMessage'];
    }

    else 
        $message = '';

?>
<section class="main_area" id="login">
    <h1> Welcome to Task Manager</h1>
    <h2> Login </h2>
    <p class="messages"> 
            <?php 
                echo $message;
                resetSessionVariables();
            ?>
    </p>
    <form action="action_login.php" method="post">

        <label for="username"> Username </label>
        <input type="text" id="username" name="username" value=<?php echo('"'.$username.'"'); ?>/>
        <label for="password"> Password </label>
        <input type="password" id="password" name="password"/>
        <input type="submit" value="login"/>

    </form>
    <footer>
        <p>Do not have account? Register <a href="register.php"> Here</a>!</p>
    </footer>
</section>
<!-- <?php include_once('templates/common/footer.php'); ?> -->