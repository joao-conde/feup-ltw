<?php

    include('database/project.php');
    include('utils/utils_user.php');


    $project_title = $_POST['title'];
    $project_desc = $_POST['desc'];
    $project_user = $_POST['username'];
    $project_deadline = $_POST['deadline'];  


    $resultError = insertProject($project_title, $project_desc, $project_user, $project_deadline);


    if($resultError == '00000') {

        $insertedProject = getProject(getProjectID($project_title,$project_user));
        $userPicturePath = getUserImagePathTN($project_user);

        $insertedProject['userPicturePath'] = $userPicturePath;

        echo json_encode($insertedProject);
    }

    else {
        echo json_encode(array("error"=>$resultError));
    }
    

 
?>