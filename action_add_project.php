<?php

include('database/project.php');
include('utils/utils_user.php');
include('utils/utils_general.php');

if(!logged())
    redirect('index.php');  



$projTitle = $_POST['title'];
$projDescription = $_POST['description'];
$usernameCreator = $_SESSION['username'];
$projDeadline = strtotime($_POST['deadline']);

$dbh->beginTransaction();

$errorInsertingProject = insertProject($projTitle, $projDescription, $usernameCreator, $projDeadline);



$projId = $dbh->lastInsertId();

if($errorInsertingProject == '00000') {

    addCollaboratorsToProject($_POST['selectCollaborator'], $projId);
    $dbh->commit();

    $_SESSION['insertProjectMessage'] = 'Project '.$projTitle.' correctly created!';
    redirect('edit_project.php?project_id='.$projId);

}

?>