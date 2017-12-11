<?php

    include_once(dirname(__DIR__)."\database\connection.php");

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
        $stmtProject->bindParam(':projDateDue', $projDeadline, PDO::PARAM_INT);        
        $stmtProject->execute();

        /* $currProjectID = getProjectID($projTitle, $usernameCreator);

        addUserToProject($usernameCreator, $currProjectID, 'Administrator');
 */     
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
    
        $query="SELECT Project.projTitle, Project.projDateDue, User_Project.userRole, Project.id, Project.usernameCreator, Project.projDescription FROM Project
                JOIN User_Project ON Project.id = User_Project.idProject
                WHERE User_Project.username = :username
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