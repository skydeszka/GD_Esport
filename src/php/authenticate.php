<?php
$config = require $_SERVER['DOCUMENT_ROOT'] . "/config.php";
require_once $config['paths']['types'] . "/seconds.php";
require_once $config['paths']['types'] . "/user.php";
/** @var PDO $pdo */
$pdo = require $_SERVER['DOCUMENT_ROOT'] . "/db.php";

//TODO: SECURE EVERYTHING

/**
 * Checks if the logged in user is an admin
 * @return bool If the user is an admin
*/
function IsAdmin(): bool{
    global $pdo;    

    if(!IsLoggedIn())
        return false;

    $userId = "";
    $hash = "";
    
    if(isset($_SESSION['user'])){
        $userId = substr($_SESSION['user'], 0, 10);
        $hash = substr($_SESSION['user'], 10);
    }
    else if(isset($_COOKIE['user'])){
        $userId = substr($_COOKIE['user'], 0, 10);
        $hash = substr($_COOKIE['user'], 10);
    }else{
        return false;
    }

    $sql = "SELECT `admin` FROM `users` WHERE `ID`=:userId AND `hash`=:hash;";

    $statement = $pdo->prepare($sql);
    $statement->bindParam(":userId", $userId, PDO::PARAM_STR);
    $statement->bindParam(":hash", $hash, PDO::PARAM_STR);

    if(!$statement->execute())
        return false;

    if($statement->rowCount() != 1)
        return false;

    return $statement->fetch(PDO::FETCH_ASSOC)['admin'];
}

/**
 * Check if the user is logged in
 * @return bool If the user is logged in
 */
function IsLoggedIn(): bool{
    /** @var PDO $pdo */
    global $pdo;

    if(session_status() != PHP_SESSION_ACTIVE)
        session_start();

    $userId = "";
    $hash = "";
    $found = false;
    
    if(isset($_SESSION['user'])){
        $userId = substr($_SESSION['user'], 0, 10);
        $hash = substr($_SESSION['user'], 10);
        $found = true;
    }
    else if(isset($_COOKIE['user'])){
        $userId = substr($_COOKIE['user'], 0, 10);
        $hash = substr($_COOKIE['user'], 10);
        $found = true;
    }
    
    if($found){
        $userId = mb_convert_encoding($userId, 'UTF-8', 'UTF-8');
        $hash = mb_convert_encoding($hash, 'UTF-8', 'UTF-8');

        $sql = "SELECT `ID` FROM `users` WHERE `ID`=:userId AND `hash`=:hash";

        $statement = $pdo->prepare($sql);
        $statement->bindParam(":userId", $userId, PDO::PARAM_STR);
        $statement->bindParam(":hash", $hash, PDO::PARAM_STR);

        if(!$statement->execute())
            return false;

        if($statement->rowCount() != 1)
            return false;

        return true;
    }

    return false;
}

function SetLoginData(string $loginData, bool $rememberMe = false): void{

    if(session_status() != PHP_SESSION_ACTIVE)
        session_start();

    $_SESSION['user'] = $loginData;

    if($rememberMe)
        setcookie("user", $loginData, time() + Seconds::Month(), "/", "", false, false);

}

/**
 * Returns the ID of the currently logged in user.
 * @return string The ID of the user
 * @return null If the user is not logged in
 */
function GetID(): string|bool {
    if(isset($_SESSION['user']))
        return substr($_SESSION['user'], 0, 10);
    
    if(isset($_COOKIE['user']))
        return substr($_SESSION['user'], 0, 10);

    return false;
}

/**
* Creates a Used object of the currently logged in user.
* @return User|bool Returns User if there is a logged in user, false otherwise
*/
function GetUserData(): User|bool {
    /** @var PDO $pdo */
    global $pdo;
    if(!IsLoggedIn())
        return false;

    $id = GetID();

    $query = "SELECT * FROM `users` WHERE `ID`=:id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $id, PDO::PARAM_STR);
    
    if($stmt->execute() && $row = $stmt->fetch(PDO::FETCH_ASSOC)){
        return new User(
            $row['ID'], $row['username'], $row['hash'], $row['email'],
            $row['fullname'], $row['county'], $row['birthdate'], $row['admin']);
    }
    return false;
}

/**
* Creates a User object of the users ID and hash
* @return User|bool Returns User if the creditentals are correct, false otherwise
*/
function GetUserDataWithID(string $id, string $hash): User|bool {
    /** @var PDO $pdo */
    global $pdo;

    $query = "SELECT * FROM `users` WHERE `ID`= ? AND `hash` = ?";
    $stmt = $pdo->prepare($query);
    
    if($stmt->execute([$id, $hash]) && $row = $stmt->fetch(PDO::FETCH_ASSOC)){
        return new User(
            $row['ID'], $row['username'], $row['hash'], $row['email'],
            $row['fullname'], $row['county'], $row['birthdate'], $row['admin']);
    }
    return false;
}

/**
 * Creates a User object of the users ID
 * * @return User|bool Returns User if the creditentals are correct, false otherwise
 */
function GetUserPublicData(string $id): User|bool {
    /** @var PDO $pdo */
    global $pdo;

    $query =
        "SELECT `birthdate` as `bd`, `username` as `name`, `fullname`, `county`
        FROM `users`
        WHERE `ID`= ?;";

    $stmt = $pdo->prepare($query);

    if($stmt->execute([$id]) && $row = $stmt->fetch(PDO::FETCH_ASSOC)){
        return new User(
            $id, $row['name'], "unknown", "unknown",
            $row['fullname'], $row['county'], $row['bd'], false);
    }

    return false;
}
?>