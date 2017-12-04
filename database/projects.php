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

    function insertProject($projTitle, $projDescription, $usernameCreator){
        global $dbh;

        $insertProjectQuery = 'INSERT INTO Project (projTitle, projDescription, usernameCreator) VALUES (:projTitle, :projDescription, :usernameCreator)';

        $stmtProject = $dbh->prepare($insertProjectQuery);
        $stmtProject->bindParam(':projTitle', $projTitle, PDO::PARAM_STR);
        $stmtProject->bindParam(':projDescription', $projDescription, PDO::PARAM_STR);
        $stmtProject->bindParam(':usernameCreator', $usernameCreator, PDO::PARAM_STR);
        $stmtProject->execute();

        $currProjectID = getProjectID($projTitle, $usernameCreator);

        addUserToProject($usernameCreator, $currProjectID, 'Administrator');

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

?>