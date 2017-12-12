<?php

    include('database/task.php');
    include('utils/utils_user.php');

    $task_title = $_POST['title'];
    $task_todo_list_id = $_POST['list_id'];
    $task_user = $_POST['user'];
    $task_desc = $_POST['desc'];
    $task_date_due = $_POST['deadline'];
    $task_percentage = $_POST['percentage'];


    if(insertTask($task_title, $task_todo_list_id, $task_user, $task_desc, $task_date_due, $task_percentage) == '00000') {

        $insertedTask = getLastTaskFromList($task_todo_list_id);
        $userPicturePath = getUserImagePathTN($task_user);

        $insertedTask['userPicturePath'] = $userPicturePath;


        echo json_encode($insertedTask);

    
    }

    

?>