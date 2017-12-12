<?php

    include_once('database/connection.php');

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

    function getTaskFromId($task_id) {
        
        global $dbh;
        
        $query = 'SELECT Task.* FROM Task WHERE id = :id';

        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':id', $task_id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch();
        
    }

    function updateTask($id, $user, $title, $desc, $deadline) {

        global $dbh;
        
        $query = 'UPDATE Task 
                  SET userResponsable = :user,
                      taskTitle = :title,
                      taskDescription = :tdesc,
                      taskDateDue = :deadline
                  WHERE id = :id';

        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':user', $user, PDO::PARAM_STR);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':tdesc', $desc, PDO::PARAM_STR);
        $stmt->bindParam(':deadline', $deadline, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->errorCode();


    }
    
    function deleteTask($task_id) {

        global $dbh;
        
        $query = 'DELETE FROM Task 
                  WHERE id = :id';

        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':id', $task_id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->errorCode();

    }
?>