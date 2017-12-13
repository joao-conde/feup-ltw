<?php

    include_once('database/task.php');

    function calculateTODOListCompletition($todoListId) {

        $todoListTasks = getTasksOfTDList($todoListId);

        $numberOfTasks = count($todoListTasks);
        $totalCompleted = 0;

        foreach($todoListTasks as $task) {

            $totalCompleted += $task['percentageCompleted'];

        }

        if($numberOfTasks == 0)
            return (int) $totalCompleted;

        return round(($totalCompleted/$numberOfTasks));
    }
?>

