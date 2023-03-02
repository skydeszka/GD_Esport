<?php
/** @var array */
$config = require $_SERVER['DOCUMENT_ROOT'] . "/config.php";
/** @var PDO */
$pdo = require $config['root'] . "/db.php";
require $config['paths']['php'] . "/authenticate.php";
require $config['paths']['php'] . "/headers.php";

//TODO: add login security

if(!isset($_POST['ID'])){
    RedirectTo("");
    exit();
}

$user = GetUserData();

if(!$user){
    RedirectTo("");
    exit();
}

$ownerQuery = 
    "SELECT COUNT(owner)
    FROM `teammembers`
    WHERE `memberID` = ? AND `owner` = 1";

$ownerStmt = $pdo->prepare($ownerQuery);
$ownerStmt->execute([$user->get_id()]);

if($ownerStmt->fetch(PDO::FETCH_NUM)[0] == 0){
    RedirectTo("");
    exit();
}

$query = "DELETE FROM `teammembers` WHERE `teamID`=:id;";

$stmt = $pdo->prepare($query);
$stmt->bindParam(":id", $_POST['ID'], PDO::PARAM_STR);
$stmt->execute();

$delQuery = "DELETE FROM `teams` WHERE `ID` = :id;";
$delStmt = $pdo->prepare($delQuery);
$delStmt->bindParam(":id", $_POST['ID'], PDO::PARAM_STR);
$delStmt->execute();

RedirectTo("");
exit();
?>