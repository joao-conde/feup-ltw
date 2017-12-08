<?php

include_once("database/connection.php");

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





?>