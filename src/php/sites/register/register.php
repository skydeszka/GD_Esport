<?php
$configs = require "../../config.php";
$pdo = require $configs['root'] . "/db.php";
require $configs['paths']['types'] . "/team.php";
require $configs['paths']['php'] . "/authenticate.php";

function CheckForSubmit($post){
    return (
        isset( $post['fullname'])  && isset($post['birthdate'])   &&
        isset($post['county'])     && isset($post['username'])    &&
        isset($post['email'])      && isset($post['password'])
    );
}

function RegisterUser($post){
    global $pdo;

    if(session_status() != PHP_SESSION_ACTIVE)
        session_start();

        
    session_unset();

    $fullname = ucwords($post['fullname']);
    $birthdate = $post['birthdate'];
    $county = $post['county'];
    $username = $post['username'];
    $email = $post['email'];
    $hash = password_hash($post['password'], PASSWORD_DEFAULT);

    $id = "";
    while(true){
        $id = RandomString(10);
        
        $idquery = "SELECT `ID` FROM `users` WHERE `ID`= :id";

        $stmt = $pdo->prepare($idquery);
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->execute();

        if($stmt->rowCount() < 1)
            break;
    }


    $userquery =
        "INSERT INTO `users` (`ID`, `username`, `hash`, `email`, `fullname`, `county`, `birthdate`)" .
        "VALUES(:id, :username, :hash, :email, :fullname, :county, :birthdate);";

    $stmt = $pdo->prepare($userquery);
    $stmt->bindParam(":id", $id, PDO::PARAM_STR);
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->bindParam(":hash", $hash, PDO::PARAM_STR);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->bindParam(":fullname", $fullname, PDO::PARAM_STR);
    $stmt->bindParam(":county", $county, PDO::PARAM_STR);
    $stmt->bindParam(":birthdate", $birthdate, PDO::PARAM_STR);
    $stmt->execute();

    $dataId = "";
    while(true){
        $dataId = RandomString(10);
        
        $idquery = "SELECT `ID` FROM `userdata` WHERE `ID`= :id";

        $stmt = $pdo->prepare($idquery);
        $stmt->bindParam(":id", $dataId, PDO::PARAM_STR);
        $stmt->execute();

        if($stmt->rowCount() < 1)
            break;
    }

    $dataQuery = "INSERT INTO `userdata` (`ID`, `userID`) VALUES (:id, :userId);";

    $stmt = $pdo->prepare($dataQuery);
    $stmt->bindParam(":id", $dataId, PDO::PARAM_STR);
    $stmt->bindParam(":userId", $id, PDO::PARAM_STR);
    $stmt->execute();

    $data = $id . $hash;

    SetLoginData($data);
}
?>