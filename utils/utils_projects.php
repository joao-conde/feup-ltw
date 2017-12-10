<?php

    include_once('database/list.php');
    include_once('utils/utils_lists.php');

    function calculateProjectCompletition($projId) {

        $projectLists = getTDListsOfProject($projId);

        $numberOfLists = count($projectLists);
        $totalCompleted = 0;

        foreach($todoLisprojectListstTasks as $list) {

            $totalCompleted += calculateTODOListCompletition($list['id']);

        }

        return (int) ($totalCompleted/$numberOfLists);
    }

?>