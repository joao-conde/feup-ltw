<?php

    include_once(dirname(__DIR__).'/database/connection.php');

    function getTasksOfTDList($todolistID) {

        global $dbh;

        $query = "SELECT * 
                  FROM Task JOIN User ON User.username = Task.userResponsable
                  WHERE Task.todoListID = :todoListId
                  ORDER BY Task.taskDateDue";

        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':todoListId', $todolistID, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();

    
    }


    function insertTask($taskTitle, $todolist, $userResponsable, $taskDesc, $taskDateDue, $percentage) {

        global $dbh;

        $query = 'INSERT INTO Task(userResponsable,todoListID,taskTitle,taskDescription,taskDateDue, percentageCompleted)
                    VALUES(:user, :todolist, :title, :descr, :datedue, :percentagec)';

        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':user', $userResponsable, PDO::PARAM_STR);
        $stmt->bindParam(':todolist', $todolist, PDO::PARAM_INT);
        $stmt->bindParam(':title', $taskTitle, PDO::PARAM_STR);
        $stmt->bindParam(':descr', $taskDesc, PDO::PARAM_STR);
        $stmt->bindParam(':datedue', $taskDateDue, PDO::PARAM_INT);
        $stmt->bindParam(':percentagec', $percentage, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->errorCode();

    }

    function getLastTaskFromList($list_id) {

        global $dbh;
        
        $query = 'SELECT Task.*, User.fullName
                  FROM Task
                  JOIN TodoList ON Task.todoListID = TodoList.id
                  JOIN User ON User.username = Task.userResponsable
                  WHERE TodoList.id = :tid
                  ORDER BY Task.id DESC';

        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':tid', $list_id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch();
        
    }

    function getUserTasksOrderedBy($username, $orderBy){

        global $dbh;
        
        $query='SELECT userResponsable, Task.id, taskTitle, taskDescription, taskDateDue, percentageCompleted, tdlTitle
                FROM Task
                JOIN TodoList ON Task.todoListID = TodoList.id
                JOIN User ON User.username = Task.userResponsable
                WHERE User.username = :username
                ORDER BY :orderBy ASC';

        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':orderBy', $orderBy, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

    }

    function getUserTasks($username){

        return getUserTasksOrderedBy($username, 'taskDateDue');

    }

    function updateTaskCompletion($taskID, $taskCompletion){

        global $dbh;

        $query='UPDATE Task SET percentageCompleted = :taskCompletion
                WHERE Task.id = :taskID';

        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':taskID', $taskID, PDO::PARAM_INT);
        $stmt->bindParam(':taskCompletion', $taskCompletion, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->errorCode();
    }

?>