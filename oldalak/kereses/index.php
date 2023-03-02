<?php
    $configs = require_once "../../config.php";
    /** @var PDO $pdo */
    $pdo = require $configs['root'] . "/db.php";

    $keyword = isset($_GET['kulcsszo']) ? $_GET['kulcsszo'] : "";
    $foundCount = 0;
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
    <title>Keresés</title>
    <?php echo $configs['bootstrap']['css']; ?>
    <?php echo $configs['bootstrap']['js']; ?>
    <?php echo $configs['jquery']; ?>
    <link href="/public/styles/global.css" rel="stylesheet">
    <link href="/public/styles/kereses/styles.css" rel="stylesheet">

</head>
<body>
    <?php require $configs['paths']['templates'] . "/header.php"; ?>
    <section id="content-root" class="container-fluid gx-0">
    <section class="container-fluid gx-0 d-flex align-items-center justify-content-center align-items-stretch align-self-stretch">

        <section id="left-bcg-img" class="flex-fill blur-2"></section>
        <section id="content-first" class="gx-0 text-center">

            <section id="content" class="p-5">
                <div id="user-profile" class="text-start">
                    <div id="user-profile-title" class="p-2 ps-4 fw-bold">
                        <?php
                            echo 'Keresés: "' . $keyword . '"';
                        ?>
                    </div>
                    <div class="px-5">
                        <table id="user-profile-table" class="table">
                            <tbody>
                                <?php

                                    $userQuery =
                                        "SELECT `ID`, `username` as `name` FROM `users` WHERE `username` LIKE ?;";

                                    $teamQuery = 
                                        "SELECT `ID`, `name` FROM `teams` WHERE `name` LIKE ?;";

                                    $newkey = $keyword . '%';

                                    $userStmt = $pdo->prepare($userQuery);
                                    $userStmt->execute([$newkey]);
                                    $teamStmt = $pdo->prepare($teamQuery);
                                    $teamStmt->execute([$newkey]);


                                    while($row = $userStmt->fetch(PDO::FETCH_ASSOC)){
                                        ++$foundCount;
                                        echo '<tr>';
                                        echo '<td>';
                                        echo '<a href="/oldalak/felhasznalo/adatlap.php?ID=' . $row['ID'] . '">' . $row['name'] . '</a>';
                                        echo '</td>';
                                        echo '<td>Felhasználó</td>';
                                        echo '</tr>';
                                    }

                                    while($row = $teamStmt->fetch(PDO::FETCH_ASSOC)){
                                        ++$foundCount;
                                        echo '<tr>';
                                        echo '<td>';
                                        echo '<a href="/oldalak/csapatok/adatlap.php?ID=' . $row['ID'] . '">' . $row['name'] . '</a>';
                                        echo '</td>';
                                        echo '<td>Csapat</td>';
                                        echo '</tr>';
                                    }

                                    if($foundCount == 0){
                                        echo '<tr>';
                                        echo '<td>';
                                        echo 'Nincs ilyen találat';
                                        echo '</td>';
                                        echo '</tr>';
                                    }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </section>
        <section id="right-bcg-img" class="flex-fill blur-2"></section>
    </section>
    </section>
    <?php require $configs['paths']['templates'] . "/footer.php" ?>
</body>
</html>