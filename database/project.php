<?php

    include_once("database/connection.php");

    function getUserCreatorProject($id) {

        global $dbh;

        $queryComments = 'SELECT user.username, user.encryptedPassword FROM user JOIN project ON user.id = project.userCreatorID WHERE project.id = :proj_id';

        $stmt = $dbh->prepare($queryComments);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $userCreator = $stmt->fetch();

        return $userCreator;
    }

    function insertProject($projTitle, $projDescription, $usernameCreator){
        global $dbh;

        $insertQuery = 'INSERT INTO Project (projTitle, projDescription, usernameCreator) VALUES (:projTitle, :projDescription, :usernameCreator)';

        $stmt = $dbh->prepare($insertQuery);
        $stmt->bindParam(':projTitle', $projTitle, PDO::PARAM_STR);
        $stmt->bindParam(':projDescription', $projDescription, PDO::PARAM_STR);
        $stmt->bindParam(':usernameCreator', $usernameCreator, PDO::PARAM_STR);

        $stmt->execute();
    }

    function addUserToProject($username, $projTitle, $userRole){
        global $dbh;

        $insertQuery = 'INSERT INTO User_Project (username, idProject, userRole) VALUES (:username, :idProject, :userRole)';

        $stmt = $dbh->prepare($insertQuery);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':idProject', $idProject, PDO::PARAM_INT);
        $stmt->bindParam(':userRole', $userRole, PDO::PARAM_STR);

        $stmt->execute();

    }

    function getProject($projectId) {

        global $dbh;
        
        $query = 'SELECT * FROM Project WHERE id = :id';

        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':id', $projectId, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch();


    }
   
    
    function getUserProjects($username) {
    
        global $dbh;
    
        $query = "SELECT * FROM Project
                  JOIN User ON User.username = Project.usernameCreator
                  WHERE Project.usernameCreator = :username
                  ORDER BY Project.projDateDue ASC";
    
        
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    
        $stmt->execute();
        return $stmt->fetchAll();
    
    }


    function getProjectFromList($list_id) {

        global $dbh;
        
        $query = "SELECT Project.* FROM TodoList
                  JOIN Project ON Project.id = TodoList.projectID
                  WHERE TodoList.id = :list_id";
    
        
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':list_id', $list_id, PDO::PARAM_INT);
    
        $stmt->execute();
        return $stmt->fetch();

    }
    

?>