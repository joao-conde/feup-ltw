<?php

    include_once("database/connection.php");

    function updateUserPassword($username,$encryptedPassword) {
        global $dbh;

        $updateQuery = 'UPDATE User SET encryptedPassword = :encryptedPassword WHERE username = :username';
        $stmt = $dbh->prepare($updateQuery);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':encryptedPassword', $encryptedPassword, PDO::PARAM_STR);
        
        $stmt->execute();
        
    }

    function insertUser($username, $encryptedPassword, $fullName, $shortDescription){

        global $dbh;
        
        $insertQuery = 'INSERT INTO User(username, encryptedPassword, fullName, shortDescription) VALUES (:username, :encryptedPassword, :fullName, :shortDescription)';

        $stmt = $dbh->prepare($insertQuery);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':encryptedPassword', $encryptedPassword, PDO::PARAM_STR);
        $stmt->bindParam(':fullName', $fullName, PDO::PARAM_STR);
        $stmt->bindParam(':shortDescription',$shortDescription, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->errorCode();
    }

    function updateUser($username,$fullname,$shortDescription,$old) {

        global $dbh;

        $updateQuery = 'UPDATE User 
                        SET username = :username, fullname = :fullname, shortDescription = :shortDescription  
                        WHERE username = :old';
    
        $stmt = $dbh->prepare($updateQuery);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
        $stmt->bindParam(':shortDescription',$shortDescription, PDO::PARAM_STR);
        $stmt->bindParam(':old', $old, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->errorCode();

    }

    function getUser($username) {

        global $dbh;

        $stmt = $dbh->prepare('SELECT * FROM User WHERE username = :user');
        $stmt->bindParam(':user', $username, PDO::PARAM_STR);
        $stmt->execute();
        $currentUser = $stmt->fetch();
        return $currentUser;
    
    }


    function findUsers($pattern) {

        global $dbh;

        $stmt = $dbh->prepare('SELECT User.username, User.fullName FROM User WHERE upper(fullName) LIKE upper(?)');
        
        $stmt->execute(array("%$pattern%"));

        return $stmt->fetchAll();

    }

    function findUsersOfProject($pattern, $project_id) {
        
        global $dbh;

        $stmt = $dbh->prepare('SELECT User.username, User.fullName 
                                FROM User JOIN User_Project ON User_Project.username = User.username
                                WHERE upper(fullName) LIKE upper(?)
                                AND User_Project.idProject = ?');
        
        $stmt->execute(array("%$pattern%", $project_id));

        return $stmt->fetchAll();

    }


    
?>