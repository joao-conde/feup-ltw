<?php

    include_once("database/connection.php");

    function getColaborators($username) {

        global $dbh;

        $query='SELECT User_Project.username, Project.projTitle, User_Project.userRole FROM (
                    SELECT idProject FROM User_Project
                    WHERE username = :username
                ) AS Projects
                JOIN User_Project ON Projects.idProject = User_Project.idProject
                JOIN Project ON Project.id = User_Project.idProject
                WHERE User_Project.username != :username
                ORDER BY User_Project.username;';

        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $colaborators = $stmt->fetchAll();

        return $colaborators;
    }

?>