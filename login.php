<?php 
session_start();
if(empty($_SESSION['username'])) { ?>
<h1> Login </h1>
<form action="action_login.php" method="post">

    <label> Username <input type="text" name="username"/></label>
    <label> Password <input type="password" name="password"/></label>
    <input type="submit" value="login"/>

</form>
<?php } ?>