<?php

include('database/project.php');
include('utils/utils_general.php');
session_start();

$proj_id = $_POST['id'];
$proj_title = $_POST['title'];
$proj_deadline = strtotime($_POST['deadline']);
$proj_description = $_POST['description'];

$errorCode = updateProject($proj_id, $proj_title, $proj_deadline, $proj_description);

if($errorCode == '00000') {

    $_SESSION['updateProjectMessage'] = 'Project '.$proj_title.' correctly updated';
    redirect('edit_project.php?project_id='.$proj_id);

}


?>