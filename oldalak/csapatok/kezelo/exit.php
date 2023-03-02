<?php
/** @var array */
$config = require $_SERVER['DOCUMENT_ROOT'] . "/config.php";
/** @var PDO */
$pdo = require $config['root'] . "/db.php";
require $config['paths']['php'] . "/authenticate.php";
require $config['paths']['php'] . "/headers.php";

$user = GetUserData();

if(!$user){
    RedirectTo("");
    exit();
}

$query = "DELETE FROM `teammembers` WHERE `memberID`=:id;";

$stmt = $pdo->prepare($query);
$stmt->bindParam(":id", $user->get_id(), PDO::PARAM_STR);
$stmt->execute();

RedirectTo("");
exit();
?>