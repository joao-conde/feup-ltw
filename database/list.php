<?php

include_once("database/connection.php");

function getTDListsOfProject($projID){

    global $dbh;
    
    $query = "SELECT * 
              FROM TodoList JOIN Project ON Project.id = TodoList.projectID
              WHERE TodoList.projectID = :projId
              ORDER BY TodoList.tdlDateDue"; 
    
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':projId', $projID, PDO::PARAM_INT);
    
    $stmt->execute(); 
    
    return $stmt->fetchAll();
}

function getUserLists($username) {

    global $dbh;

    $query = "SELECT ToDolist.*, Project.id id_project, Project.projTitle, Project.projDescription, Project.usernameCreator, Project.projDateDue  FROM TodoList
              JOIN Project ON TodoList.projectId = Project.id
              WHERE Project.usernameCreator = :username
              ORDER BY TodoList.tdlDateDue ASC";

    
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);

    $stmt->execute();
    return $stmt->fetchAll();

}

function getUserListIsWorking($username) {

    global $dbh;

    $query = "SELECT DISTINCT ToDolist.*, Project.id id_project, Project.projTitle, Project.projDescription, Project.usernameCreator, Project.projDateDue FROM Task 
              JOIN ToDoList ON ToDoList.id = Task.todoListID  
              JOIN Project ON Project.id = ToDoList.projectID
              WHERE Task.userResponsable = :username
              AND Project.usernameCreator <> :username
              ORDER BY TodoList.tdlDateDue ASC";

    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);

    $stmt->execute();
    return $stmt->fetchAll();

}

function updateList($list_id, $list_title, $list_desc, $list_deadline) {

    global $dbh;

    $query = 'UPDATE ToDoList SET tdlTitle = :title, tdlDescription = :description, tdlDateDue = :deadline WHERE id = :id';


    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':id', $list_id, PDO::PARAM_INT);
    $stmt->bindParam(':title', $list_title, PDO::PARAM_STR);
    $stmt->bindParam(':description', $list_desc, PDO::PARAM_STR);
    $stmt->bindParam(':deadline', $list_deadline, PDO::PARAM_INT);

    $stmt->execute();
    return $stmt->errorCode();

}

function getListFromId($list_id) {
    
    global $dbh;

    $query = 'SELECT * FROM TodoList WHERE id = :id';


    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':id', $list_id, PDO::PARAM_INT);

    $stmt->execute();
    return $stmt->fetch();
    
}


function deleteList($list_id) {
    
    global $dbh;
    
    $query = 'DELETE FROM TodoList 
                WHERE id = :id';

    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':id', $list_id, PDO::PARAM_INT);

    $stmt->execute();

    return $stmt->errorCode();

}



?>