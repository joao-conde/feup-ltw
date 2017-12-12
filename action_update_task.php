<?php 
    include('database/task.php');
    include('utils/utils_general.php');
    session_start();

    $task_id = $_POST['task_id'];
    $task_title = trim($_POST['title']);
    $task_desc = trim($_POST['description']);
    $task_deadline = strtotime($_POST['deadline']);
    $task_responsible = $_POST['username_responsible'];
    $list_id = $_POST['list_id'];


    $error = updateTask($task_id, $task_responsible, $task_title, $task_desc, $task_deadline);

    if($error == '00000') {

        $_SESSION['updateListMessage'] = 'Task '.$task_title.' correctly updated';
        redirect("edit_list.php?list_id=".$list_id);

    }

?>