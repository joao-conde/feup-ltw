<?php

include('database/project.php');

$proj_id = $_POST['proj_id'];
$username = array($_POST['username']);
$add_del = (int) $_POST['add_del'];

if($add_del == 0)
    $errorCode = removeUserFromProject($username[0],$proj_id);


else {
    addCollaboratorsToProject($username,$proj_id);
    $errorCode = '00000';

}

echo json_encode(array("error" => $errorCode, "add_del" => $add_del, "username" => $username[0]));


?>