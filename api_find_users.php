<?php

include('database/user.php');
include('database/project.php');

$pattern = $_GET['pattern'];
$list_id = $_GET['list_id'];

$project = getProjectFromList($list_id);
$users = findUsersOfProject ($pattern, $project['id']);

//$owner = getUser($project['usernameCreator']);

//array_push($users,$owner);

echo(json_encode($users));


?>