<script src="user_reg.js" defer></script>
<h1> User Registration </h1>

<form id="registrationForm" action="action_register_user.php" method="post">

    <label> Username <input type="text" name="username"/></label>
    <label> Password <input type="password" name="password"/></label>
    <label> Repeat Password <input type="password" id="repeatPassword"/></label>
    <label> Full Name <input type="text" name="fullname"/></label>
    <label> Bio <textarea name="shortDescription"></textarea></label>
    <input type="submit" value="Register"/>

</form>