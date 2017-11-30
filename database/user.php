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
    }

    function getUser($username, $password) {

        global $dbh;

        $stmt = $dbh->prepare('SELECT username FROM User WHERE username = :user AND password = :pass');
        $stmt->bindParam(':user', $username, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $password, PDO::PARAM_STR);
        $stmt->execute();
        $currentUser = $stmt->fetch();
        return $currentUser;
    
    }
    
?>