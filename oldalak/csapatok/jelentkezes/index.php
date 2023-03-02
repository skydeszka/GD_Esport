<?php
    $configs = require $_SERVER['DOCUMENT_ROOT'] . "/config.php";
    require $configs['paths']['php'] . "/authenticate.php";
    require $configs['paths']['php'] . "/headers.php";
    /** @var PDO $pdo */
    $pdo = require $configs['root'] . "/db.php";

    $user = GetUserData();

    if(!$user){
        RedirectTo("/oldalak/felhasznalo/bejelentkezes.php");
        exit();
    }
    
    if(!isset($_GET['meghivo'])){
        RedirectTo("/oldalak/csapatok/kezelo.php");
        exit();
    }

    $inviteQuery = 
        "SELECT `name`, `ID`
        FROM `teams`
            WHERE `invite` = :invite;";

    $invStmt = $pdo->prepare($inviteQuery);
    $invStmt->bindParam(":invite", $_GET['meghivo'], PDO::PARAM_STR);
    $invStmt->execute();

    $invData = $invStmt->fetch(PDO::FETCH_ASSOC);

    if($invStmt->rowCount() == 0){
        RedirectTo("/oldalak/csapatok/jelentkezés/sikertelen.php");
        exit();
    }

    $membersQuery = 
        "SELECT COUNT(memberID) as `members`
        FROM `teammembers`
            WHERE `teamID` = :teamID;";

    $membersStmt = $pdo->prepare($membersQuery);
    $membersStmt->bindParam(":teamID", $invData['ID'], PDO::PARAM_STR);
    $membersStmt->execute();

    if($membersStmt->fetch(PDO::FETCH_NUM)[0] >= 5){
        RedirectTo("/oldalak/csapatok/jelentkezes/sikertelen.php");
        exit();
    }

    $youQuery = 
        "SELECT COUNT(*) as `members`
        FROM `teammembers`
            WHERE `memberID` = :id;";

    $yourID = $user->get_id();
    $youStmt = $pdo->prepare($youQuery);
    $youStmt->bindParam(":id", $yourID, PDO::PARAM_STR);
    $youStmt->execute();

    if($youStmt->fetch(PDO::FETCH_ASSOC)['members'] != 0){
        RedirectTo("/oldalak/csapatok/jelentkezes/sikertelen.php");
        exit();
    }

    $teamMemberID = "";
    while(true){
        $teamMemberID = RandomString(10);

        $idquery = "SELECT COUNT(ID) FROM `teammembers` WHERE `ID`= ?";

        $stmt = $pdo->prepare($idquery);
        $stmt->execute([$teamMemberID]);

        if($stmt->fetch(PDO::FETCH_NUM)[0] == 0)
            break;
    }

    $insertQuery =
        "INSERT INTO `teammembers` (`ID`, `teamID`, `memberID`)
        VALUES (?, ?, ?);";

    $insertStmt = $pdo->prepare($insertQuery);
    if(!$insertStmt->execute([$teamMemberID, $invData['ID'], $yourID])){
        RedirectTo("/oldalak/hibak/500.php");
        exit();
    }
?>


<!DOCTYPE html>
<html lang="hu">
<head>
<link rel="stylesheet" href="/minden.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<style>

</style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Információ</title>
    <link href="/public/styles/global.css" rel="stylesheet">
    <?php echo $configs['bootstrap']['css']; ?>
</head>
<body>
    <?php require_once $configs['paths']['templates'] . "/header.php"; ?>

    <section id="content-root" class="container-fluid gx-0 d-flex align-items-center justify-content-center align-items-stretch">
        <section id="left-bcg-img" class="flex-fill blur-2"></section>
        <section id="content" class="row gx-0 mx-5 my-2 text-center">
            <h1>Sikeres jelentkezés</h1>
            <div class="fs-5">
                <div class="mb-5">
                    <?php
                        $teamName = $invData['name'];
                        $teamID = $invData['ID'];

                        echo "Sikeresen jelentkeztél a ";
                        echo '<a href="/oldalak/csapatok/adatlap.php?ID=' . $teamID . '">';
                        echo $teamName;
                    	echo '</a> ';
                        echo "csapatba!";
                    ?>
                </div>  
            </div>
        </section>
        <section id="right-bcg-img" class="flex-fill blur-2"></section>
    </section>
</body>
</html>