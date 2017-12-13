<?php

include('database/user.php');
include('database/project.php');
include('utils/utils_user.php');

$pattern = $_GET['pattern'];
$list_id = $_GET['list_id'];

if($list_id != "null") {

    $project = getProjectFromList($list_id);
    $users = findUsersOfProject ($pattern, $project['id']);

}

else
    $users = findUsers($pattern);

for($i = 0; $i < count($users); $i++)
    $users[$i]['userPicturePath'] = getUserImagePathTN($users[$i]['username']);


echo(json_encode($users));


?>