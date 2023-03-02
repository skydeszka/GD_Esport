<?php
    $configs = require "../../config.php";
    /** @var PDO */
    $pdo = $configs['root'] . "/db.php";
    require $configs['paths']['php'] . "/headers.php";
    require $configs['paths']['php'] . "/authenticate.php";

    $IsDisplayingPage = false;

    $user = GetUserData();

    if(!$user){
        RedirectTo("/oldalak/felhasznalo/bejelentkezes.php");
        exit();
    }

    $id = $user->get_id();
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
    <title>Csapat kezelő</title>
    <link href="/public/styles/global.css" rel="stylesheet">
    <?php echo $configs['bootstrap']['css']; ?>
    <?php echo $configs['bootstrap']['js']; ?>
    <?php echo $configs['jquery']; ?>
    <?php echo $configs['cookies']; ?>
    <script src="/src/javascript/csapatok/kezelo.js"></script>
    <link href="/public/styles/csapatok/kezelo.css" rel="stylesheet">
</head>
<body>
    <?php require_once $configs['paths']['templates'] . "/header.php"; ?>

    <section id="content-root" class="container-fluid gx-0 d-flex align-items-center justify-content-center align-items-stretch">
        <section id="left-bcg-img" class="flex-fill blur-2"></section>
        <section id="content" class="p-5 gx-0 mx-5 my-2 text-center" style="width: 60%">
            <h1 id="content-header" class="mx-auto">Csapat kezelő</h1>

            <div class="mx-auto" id="data-menu">

                <?php
                    $currentTeamID = $user->GetTeamID();

                    // creator
                    if(!$IsDisplayingPage && !$currentTeamID){
                        $query =
                        "SELECT `users`.`ID`, `birthdate`as `bd`
                        FROM `users`
                        LEFT JOIN `teammembers` as `members`
                            ON `users`.`ID` = `members`.`memberID`
                        WHERE `members`.`memberID` IS NULL AND `users`.`ID` = :id;";

                        $stmt = $pdo->prepare($query);
                        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
                        $stmt->execute();

                        if($stmt->rowCount() > 0 && $row = $stmt->fetch(PDO::FETCH_ASSOC)){

                            $anyErrors = false;

                            $birth = strtotime($row['bd']);

                            $on18 = strtotime("+18 years", $birth);

                            if(time() < $on18)
                                $anyErrors = true;
                            
                            if(!$anyErrors){
                                    echo "<h3>";
                                    echo '<a href="./regisztracio">Csapat létrehozása</a>';
                                    echo '</h3>';
                                $IsDisplayingPage = true;
                            }
                        }
                    }

                    if(!$IsDisplayingPage && $currentTeamID){

                        $userData = 
                            "SELECT `owner`
                            FROM `teammembers`
                            WHERE `memberID` = ?;";

                        $userStmt = $pdo->prepare($userData);
                        $userStmt->execute([$user->get_id()]);
                        $userIsOwner = $userStmt->fetch(PDO::FETCH_ASSOC)['owner'];

                        $teamQuery = 
                            "SELECT
                                `t`.`name`, `t`.`registered`, `t`.`invite`, 
                                `m`.`memberID`, `m`.`owner`,
                                `u`.`username`, `u`.`fullname`, `u`.`email`, `u`.`ID` as `userID`
                            FROM `teams` as `t`, `teammembers` as `m`
                            LEFT JOIN `users` as `u`
                                ON `u`.`ID` = `m`.`memberID`
                            WHERE `t`.`ID` = ? AND `m`.`teamID` = `t`.`ID`
                            ORDER BY  `m`.`owner` DESC;";

                        $teamStmt = $pdo->prepare($teamQuery);

                        if($teamStmt->execute([$currentTeamID]) && $teamStmt->rowCount() > 0){
                            $datas = $teamStmt->fetchAll(PDO::FETCH_ASSOC);

                            echo '<div id="data-menu-title" class="d-block me-auto">' . $datas[0]['name'] . ' csapatkezelő</div>';
                            echo '<div class="p-5 d-block text-start w-100">';
                            echo '<ul id="menu-list">';
                            echo '<li>Rang: ' . ($userIsOwner ? "Vezér" : "Tag") . '</li>';
                            echo '<li>Csapatregisztrálva: ' . $datas[0]['registered'] . '</li>';
                            echo '<li>';
                            echo 'Meghívó link: <a href="/oldalak/csapatok/jelentkezes?meghivo=' . $datas[0]['invite'] . '">';
						    echo GetURL() . "/oldalak/csapatok/jelentkezes?meghivo=" . $datas[0]['invite'];
                    	    echo '</a>';
                            echo '</li>';

                            if($userIsOwner){
                                echo '<li>';
                                echo '<form method="POST" action="' . "./kezelo/delete.php" . '">';
                                echo '<input type="hidden" name="ID" value="' . $currentTeamID . '">';
                                echo '<input class="btn" style="background-color: #434648;" type="submit" value="Csapat törlése">';
                                echo '</form>';
                                echo '</li>';
                            }
                            else{
                                echo '<li>';
                                echo '<form method="POST" action="' . "./kezelo/exit.php" . '">';
                                echo '<input type="submit" value="Kilépés">';
                                echo '</form>';
                                echo '</li>';   
                            }

                            
                            echo '</ul>';
                            echo '<table class="table table-dark table-bordered">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<td>Felhasználónév</td>';
                            echo '<td>Név</td>';
                            echo '<td>Email</td>';
                            echo '<td>Rang</td>';
                            echo '<td>Akciók</td>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody id="member-rows">';
                            
                            foreach($datas as $data){
                                echo '<tr>';
                                echo '<td class="selectable">' . $data['username'] . '</td>';
                                echo '<td class="selectable">' . $data['fullname'] . '</td>';
                                echo '<td class="selectable">' . $data['email']    . '</td>';
                                echo '<td>' . ($data['owner'] == 1 ? "Vezér" : "Tag") . '</td>';
                                echo '<td>';

                                echo '<a href="/oldalak/felhasznalo/adatlap.php?ID=' . $data['userID'] . '"> Megtekintés </a>';
                                echo '<br />';
                                
                                if($userIsOwner && $data['userID'] != $user->get_id())
                                    echo '<span data-id="' . $data['userID'] . '" class="kick-member-btn" role="button"> Kirúgás </span>';

                                echo '</td>';
                                echo '</tr>';
                            }

                            echo '</tbody>';
                            echo '</table>';
                            echo '</div>';
                        }
                    }

                    
                ?>

            </div>

        </section>
        <section id="right-bcg-img" class="flex-fill blur-2"></section>
    </section>
    <?php require $configs['paths']['templates'] . "/footer.php" ?>
</body>
</html>