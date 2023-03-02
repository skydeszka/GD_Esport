<?php
    $configs = require "../../config.php";
    $pdo = require $configs['root'] . "/db.php";
    require_once $configs['paths']['php'] . "/authenticate.php";
    require_once $configs['paths']['php'] . "/headers.php";
    require_once $configs['paths']['php'] . "/string.php";

    $user = false;

    if(isset($_GET['ID'])){
        $query = "SELECT * FROM `users` WHERE `ID`= :id ;";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":id", $_GET['ID'], PDO::PARAM_STR);

        $data;

        if($stmt->execute() && $stmt->rowCount() == 1){
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $user = GetUserPublicData($data['ID']);
        }
    }
?>

<!DOCTYPE html>
<html lang="hu">
<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php

        if($user)
            echo "<title>" . $data['username'] . " adatlapja</title>";
        else
            echo "<title>Nincs ilyen felhasználó</title>";

    ?>

<link rel="stylesheet" href="/minden.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>

    </style>

    <link href="/public/styles/felhasznalo/adatlap.css" rel="stylesheet">
    <link href="/public/styles/global.css" rel="stylesheet">
    <?php echo $configs['bootstrap']['css']; ?>
    <?php echo $configs['bootstrap']['js']; ?>
</head>
<body>
    <?php require_once $configs['paths']['templates'] . "/header.php"; ?>

    <section id="content-root" class="container-fluid gx-0">
    <section class="container-fluid gx-0 d-flex align-items-center justify-content-center align-items-stretch align-self-stretch">

        <section id="left-bcg-img" class="flex-fill blur-2"></section>
        <section id="content-first" class="gx-0 text-centerw-50">

            <section id="content" class="p-5">
                <?php

                if($user){
                    
                    echo '<div id="user-profile" class="text-start">';
                    echo '<div id="user-profile-title" class="p-2 ps-4 fw-bold">';
                    echo $user->get_name();
                    echo '</div>';
                    echo '<div class="px-5">';
                    echo '<table id="user-profile-table" class="table">';
                    echo '<tbody>';
                    echo '<tr>';
                    echo '<td class="fw-bold">Teljes név</td>';
                    echo '<td>' . $user->get_fullname() . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td class="fw-bold">Megye:</td>';
                    echo '<td>' . ConvertCounty($user->get_county()) . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td class="fw-bold">Születési év:</td>';
                    echo '<td>' . $user->get_birthdate()->format('Y.m.d'). '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td class="fw-bold">Felhasználónév</td>';
                    echo '<td>' . $user->get_name() . '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td class="fw-bold">Csapat</td>';
                    echo '<td>';

                    if($team = $user->GetTeamName())
                        echo $team;
                    else
                        echo "Nincs";
                    
                    echo '</td>';
                    echo '</tr>';
                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                    echo '</div>';

                }
                else{
                    echo '<div id="user-profile" class="text-start">';
                    echo '<div id="user-profile-title" class="p-2 ps-4 fw-bold">';
                    echo '    Ez a felhasználó nem létezik';
                    echo '</div>';
                    echo '<div class="px-5">';
                    echo '    <table id="user-profile-table" class="table">';
                    echo '        <tbody>';
                    echo '            <tr>';
                    echo '                <td class="fw-bold">Teljes név</td>';
                    echo '                <td>Ismeretlen</td>';
                    echo '            </tr>';
                    echo '            <tr>';
                    echo '                <td class="fw-bold">Megye:</td>';
                    echo '                <td>Ismeretlen</td>';
                    echo '            </tr>';
                    echo '            <tr>';
                    echo '                <td class="fw-bold">Születési év:</td>';
                    echo '                <td>Ismeretlen</td>';
                    echo '            </tr>';
                    echo '            <tr>';
                    echo '                <td class="fw-bold">Felhasználónév</td>';
                    echo '                <td>Ismeretlen</td>';
                    echo '            </tr>';
                    echo '            <tr>';
                    echo '                <td class="fw-bold">Csapat</td>';
                    echo '                <td>Ismeretlen</td>';
                    echo '            </tr>';
                    echo '        </tbody>';
                    echo '    </table>';
                    echo '</div>';
                    echo '</div>';
                }

                ?>
            </section>
        </section>
        <section id="right-bcg-img" class="flex-fill blur-2"></section>
    </section>
    </section>
    <?php require $configs['paths']['templates'] . "/footer.php" ?>
</body>
</html>