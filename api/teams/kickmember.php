<?php
/** @var array */
$config = require $_SERVER['DOCUMENT_ROOT'] . "/config.php";
/** @var PDO */
$pdo = require $config['root'] . "/db.php";
require $config['paths']['php'] . "/authenticate.php";

//TODO: add login security

$result = [
    "code" => 500,
    "message" => "Internal Server Error",
    "success" => false,
    "id" => null
];

if(!isset($_POST['ID'])){
    $result['code'] = 400;
    $result['message'] = "ID was not provided";
    echo json_encode($result);
    exit();
}

if(!isset($_POST['auth'])){
    $result['code'] = 401;
    $result['message'] = "Auth was not provided";
    echo json_encode($result);
    exit();
}

$authId = substr($_POST['auth'], 0, 10);
$authHash = substr($_POST['auth'], 10);

$user = GetUserDataWithID($authId, $authHash);

if(!$user){
    $result['code'] = 401;
    $result['message'] = "Authentication failed";
    echo json_encode($result);
    exit();
}

$ownerQuery = 
    "SELECT COUNT(owner)
    FROM `teammembers`
    WHERE `memberID` = ? AND `owner` = 1";

$ownerStmt = $pdo->prepare($ownerQuery);
$ownerStmt->execute([$authId]);

if($ownerStmt->fetch(PDO::FETCH_NUM)[0] == 0){
    $result['code'] = 403;
    $result['message'] = "Not an owner";
    echo json_encode($result);
    exit();
}

$query = "DELETE FROM `teammembers` WHERE `memberID`=:id;";

$stmt = $pdo->prepare($query);
$stmt->bindParam(":id", $_POST['ID'], PDO::PARAM_STR);

if($result['success'] = $stmt->execute()){
    $result['code'] = 200;
    $result['message'] = "Successfully deleted";
    $result['id'] = $_POST['ID'];
}


echo json_encode($result);
exit();
?>