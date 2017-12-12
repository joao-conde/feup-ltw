<?php

    include_once('database/list.php');
    include_once('utils/utils_lists.php');

    function calculateProjectCompletition($projId) {

        $projectLists = getTDListsOfProject($projId);

        $numberOfLists = count($projectLists);
        $totalCompleted = 0;

        foreach($projectLists as $list) {

            $totalCompleted += calculateTODOListCompletition($list['id']);

        }

        

        return (int) ($totalCompleted == 0) ? 100 : ($totalCompleted/$numberOfLists);
    }

?>