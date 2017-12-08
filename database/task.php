<?php

    include_once('database/connection.php');

    function getTasksOfTDList($todolistID) {

        global $dbh;

        $query = "SELECT * 
                  FROM Task
                  WHERE Task.todoListID = :todoListId";

        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':todoListId', $todolistID, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();

        

    }

?>