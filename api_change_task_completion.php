<?php

    include('database/task.php');

    $task_new_completion = $_POST['percentage'];
    $task_id = $_POST['taskID'];

    updateTaskCompletion($task_id, $task_new_completion);

?>