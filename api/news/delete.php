<?php
/** @var array */
$config = require $_SERVER['DOCUMENT_ROOT'] . "/config.php";
/** @var PDO */
$pdo = require $config['root'] . "/db.php";
require $config['paths']['php'] . "/authenticate.php";

$result = [
    "code" => 500,
    "message" => "Internal Server Error",
    "success" => false,
];

if(!isset($_POST['ID'])){
    $result['code'] = 400;
    $result['message'] = "ID was not provided";
    echo json_encode($result);
    exit();
}

if(!isset($_POST['auth'])){
    $result['code'] = 400;
    $result['message'] = "No auth provided";
    echo json_encode($result);
    exit();
}

$userId = substr($_POST['auth'], 0, 10);
$hash = substr($_POST['auth'], 10);

$authQuery = "SELECT COUNT(*) FROM `users` WHERE `ID` = ? AND `hash` = ?;";

$authStmt = $pdo->prepare($authQuery);
$authStmt->execute([$userId, $hash]);
$num = $authStmt->fetch(PDO::FETCH_NUM)[0];

if($num != 1){
    $result['code'] = 403;
    $result['message'] = "No privileges";
    echo json_encode($result);
    exit();
}


$query = "DELETE FROM `news` WHERE `ID`=:id;";

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