<?php

    include_once("database/connection.php");

    function getUserCreatorProject($id) {

        global $dbh;

        $queryComments = 'SELECT user.username, user.encryptedPassword FROM user JOIN project ON user.id = project.userCreatorID WHERE project.id = :proj_id';

        $stmt = $dbh->prepare($queryComments);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $usernameCreator = $stmt->fetch();

        return $usernameCreator;
    }

    function getProjectID($projTitle, $usernameCreator){
        global $dbh;

        $selectQuery = 'SELECT id FROM Project WHERE Project.projTitle = :projTitle AND Project.usernameCreator = :usernameCreator';

        $stmt = $dbh->prepare($selectQuery);
        $stmt->bindParam(':projTitle', $projTitle, PDO::PARAM_STR);
        $stmt->bindParam(':usernameCreator', $usernameCreator, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch();

        return $result['id'];
    }

    function insertProject($projTitle, $projDescription, $usernameCreator, $projDeadline){
        global $dbh;

        $insertProjectQuery = 'INSERT INTO Project (projTitle, projDescription, usernameCreator, projDateDue) VALUES (:projTitle, :projDescription, :usernameCreator, :projDeadline)';

        $stmtProject = $dbh->prepare($insertProjectQuery);
        $stmtProject->bindParam(':projTitle', $projTitle, PDO::PARAM_STR);
        $stmtProject->bindParam(':projDescription', $projDescription, PDO::PARAM_STR);
        $stmtProject->bindParam(':usernameCreator', $usernameCreator, PDO::PARAM_STR);
        $stmtProject->bindParam(':projDeadline', $projDeadline, PDO::PARAM_INT);        
        $stmtProject->execute();
     
        return $stmtProject->errorCode();
    }

    function addUserToProject($username, $idProject, $userRole){
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
                    WHERE Project.usernameCreator = :username
                    ORDER BY Project.projDateDue ASC";
        
          $stmt = $dbh->prepare($query);
          $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        
          $stmt->execute();
          return $stmt->fetchAll();
        
    }   
    
    function getUserProjectIsWorking($username) {
    
        global $dbh;
    
        $query="SELECT DISTINCT Project.projTitle, Project.projDateDue, User_Project.userRole, Project.id, Project.usernameCreator, Project.projDescription FROM Project
                JOIN User_Project ON Project.id = User_Project.idProject
                WHERE User_Project.username = :username
                AND Project.usernameCreator <> :username
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


    function addCollaboratorsToProject($users_list, $proj_id) {

        global $dbh;

        $insertQuery = 'INSERT INTO User_Project (username, idProject) VALUES (:username, :idProject)';
        $stmt = $dbh->prepare($insertQuery);

        foreach($users_list as $username) {

            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':idProject', $proj_id, PDO::PARAM_INT);

            $stmt->execute();

        }
        
    }


    function updateProject($proj_id, $proj_title, $proj_deadline, $proj_description) {

        global $dbh;
        
        $query = 'UPDATE Project 
                    SET projTitle = :proj_title,
                        projDescription = :proj_description,
                        projDateDue = :proj_deadline
                    WHERE id = :proj_id';
        
        $stmt = $dbh->prepare($query);

        $stmt->bindParam(':proj_id', $proj_id, PDO::PARAM_INT);
        $stmt->bindParam(':proj_title', $proj_title, PDO::PARAM_STR);
        $stmt->bindParam(':proj_deadline', $proj_deadline, PDO::PARAM_INT);
        $stmt->bindParam(':proj_description', $proj_description, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->errorCode();
            

    }


    
?>