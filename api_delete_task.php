<?php 

    include('database/task.php');

    $task_id = $_POST['task_id'];

    $error = array("error" => deleteTask($task_id), "task_id" => $task_id);

    echo json_encode($error);



?>