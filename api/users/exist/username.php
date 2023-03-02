<?php
    $conf = require '../../../config.php';
    $pdo = require $conf['root'] . "/db.php";

    $result = [
        "code" => 501,
        "message" => "The current API is not yet implemented.",
        "exists" => null
    ];

    if(!isset($_GET['username'])){
        $result['code'] = 400;
        $result['message'] = "Username was not given.";

        echo json_encode($result);
        exit();
    }

    $query = "SELECT `ID` FROM `users` WHERE `username` = :name;";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':name', $_GET['username'], PDO::PARAM_STR);

    if(!$stmt->execute()){
        $result['code'] = 500;
        $result['message'] = "Internal Server Error.";

        echo json_encode($result);
        exit();
    }

    $result['code'] = 200;
    $result['message'] = "OK";
    $result['exists'] = true;

    if($stmt->rowCount() == 0)
        $result['exists'] = false;

    echo json_encode($result);
    exit();
?>