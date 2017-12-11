<?php

    include_once('database/task.php');

    function calculateTODOListCompletition($todoListId) {

        $todoListTasks = getTasksOfTDList($todoListId);

        $numberOfTasks = count($todoListTasks);
        $totalCompleted = 0;

        foreach($todoListTasks as $task) {

            $totalCompleted += $task['percentageCompleted'];

        }

        return (int) ($totalCompleted/$numberOfTasks);

    }
?>

