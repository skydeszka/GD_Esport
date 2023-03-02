<?php
    $configs = require_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
    require_once $configs["paths"]["php"] . "/authenticate.php";
	require_once $configs['paths']['php'] . "/string.php";
	require_once $configs["paths"]["php"] . "/headers.php";
    /** @var PDO */
    $pdo = require $configs['root'] . "/db.php";

    if(!IsLoggedIn()){
        RedirectTo("/oldalak/felhasznalo/bejelentkezes.php");
        exit();
    }

    if(isset($_POST['teamname'])){

        $id = GetId();

        $nameQuery = 
            "SELECT COUNT(*) as `count`
            FROM `teams` as `t`, `teammembers` as `m`
            WHERE `t`.`name` = :name OR `m`.`memberID` = :id";
        
        $nameStmt = $pdo->prepare($nameQuery);
        $nameStmt->bindParam(":name", $_POST['teamname']);
        $nameStmt->bindParam(":id", $id);

        if($nameStmt->execute() && $nameStmt->fetch(PDO::FETCH_ASSOC)["count"] == 0){

            $id = "";
            while(true){
                $id = RandomString(32);

                $idquery = "SELECT `ID` FROM `teams` WHERE `ID`= :id";

                $stmt = $pdo->prepare($idquery);
                $stmt->bindParam(":id", $id, PDO::PARAM_STR);
                $stmt->execute();

                if($stmt->rowCount() < 1)
                    break;
            }

            $invite = "";
            while(true){
                $invite = RandomString(10);

                $idquery = "SELECT `ID` FROM `teams` WHERE `invite`= :inv";

                $stmt = $pdo->prepare($idquery);
                $stmt->bindParam(":inv", $invite, PDO::PARAM_STR);
                $stmt->execute();

                if($stmt->rowCount() < 1)
                    break;
            }

            $query = "INSERT INTO `teams` (`ID`, `name`, `registered`, `invite`) VALUES (:id, :name, :register, :invite);";

            $date = date("Y-m-d");

            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_STR);
            $stmt->bindParam(":name", $_POST['teamname'], PDO::PARAM_STR);
            $stmt->bindParam(":register", $date, PDO::PARAM_STR);
            $stmt->bindParam(":invite", $invite, PDO::PARAM_STR);

            if($stmt->execute() && $user = GetUserData()){

                $memberId = "";
                while(true){
                    $memberId = RandomString(10);

                    $idquery = "SELECT `ID` FROM `teammembers` WHERE `ID`= :id";
                
                    $stmt = $pdo->prepare($idquery);
                    $stmt->bindParam(":id", $memberId, PDO::PARAM_STR);
                    $stmt->execute();
                
                    if($stmt->rowCount() < 1)
                        break;
                }

                $memberQuery = "INSERT INTO `teammembers` (`ID`, `teamID`, `memberID`, `owner`)" .
                                "VALUES (:id, :teamID, :memberID, :owner);";

                $userId= $user->get_id();
                $teamId = $id;
                $isOwner = true;

                $stmt = $pdo->prepare($memberQuery);
                $stmt->bindParam(":id", $memberId, PDO::PARAM_STR);
                $stmt->bindParam(":teamID", $teamId, PDO::PARAM_STR);
                $stmt->bindParam(":memberID", $userId, PDO::PARAM_STR);
                $stmt->bindParam(":owner", $isOwner, PDO::PARAM_STR);

		    	$_POST = [];

                if(!$stmt->execute()){
                    RedirectTo("/");
                    exit();
                }
            }

        }
        else{
            RedirectTo("/");
            exit();
        }
    }
    else{
        RedirectTo("/oldalak/csapatok/kezelo.php");
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
    <title>Regisztráció</title>
    <?php echo $configs['bootstrap']['css']; ?>
    <?php echo $configs['bootstrap']['js']; ?>
    <?php echo $configs['jquery']; ?>
    <link href="/public/styles/regisztracio/regisztracio.css" rel="stylesheet">
    <link href="/public/styles/regisztracio/datas.css" rel="stylesheet">
    <link href="/public/styles/global.css" rel="stylesheet">
</head>
<body>
    <?php require $configs['paths']['templates'] . "/header.php"; ?>

    <section id="content-root" class="container-fluid gx-0 d-flex align-items-center justify-content-center align-items-stretch">
        <section id="left-bcg-img" class="flex-fill blur-2"></section>
        <section id="content" class="row gx-0 mx-5 my-2 text-center">
            <h1>Sikeres regisztrácio!</h1>
            <div class="fs-5">
                <div class="mb-5">
                    Csapat sikeresen regisztrálva!

                    Ezzel a linkkel tudnak az emberek belépni a csapatba.
                    <?php

						echo '<a href="/oldalak/csapatok/jelentkezes?meghivo=' . $invite . '">';
						echo GetURL() . "/oldalak/csapatok/jelentkezes?meghivo=$invite";
                    	echo '</a>';
                    ?>
                </div>
            </div>
        </section>
        <section id="right-bcg-img" class="flex-fill blur-2"></section>
    </section>
</body>
</html>