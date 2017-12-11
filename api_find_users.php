<?php

include('database/user.php');
$pattern = $_GET['pattern'];
$users = findUsers($pattern);

echo(json_encode($users));

?>