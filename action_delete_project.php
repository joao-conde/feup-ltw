<?php
session_start();
include('database/project.php');
include('utils/utils_general.php');


$proj_id = $_POST['project_id'];

$error = deleteProject($proj_id);

if($error == '00000')
    $_SESSION['deleteProjMessage'] = 'Project correctly deleted';

else
    $$_SESSION['deleteProjMessage'] = 'Error deleting project';


redirect('projects.php');


?>