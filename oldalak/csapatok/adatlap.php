<?php
    $configs = require "../../config.php";
    $pdo = require $configs['root'] . "/db.php";
    require_once $configs['paths']['php'] . "/authenticate.php";
    require_once $configs['paths']['php'] . "/headers.php";
    require_once $configs['paths']['php'] . "/string.php";
    require_once $config['paths']['types'] . "/team.php";


    $team = false;

    if(isset($_GET['ID'])){
        $query = "SELECT `ID` FROM `teams` WHERE `ID`= :id ;";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":id", $_GET['ID'], PDO::PARAM_STR);

        if($stmt->execute() && $stmt->rowCount() == 1){
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $team = Team::CreateFromID($_GET['ID']);
        }
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php

        if($team)
            echo "<title>" . $data['name'] . " adatlapja</title>";
        else
            echo "<title>Nincs ilyen csapat</title>";

    ?>
    <link href="/public/styles/csapatok/adatlap.css" rel="stylesheet">
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

                <div id="team-profile" class="text-start">
                    
                    <?php
                    if($team){
                        echo '<div id="team-profile-title" class="p-2 ps-4 fw-bold">';
                        echo $team->get_name();
                        echo '</div>';
                        echo '<div class="px-5">';
                        echo '<table id="team-profile-table" class="table">';
                        echo '<tbody>';
                        echo '<tr>';
                        echo '<td class="fw-bold">Tulajdonos</td>';
                        echo '<td>' . $team->get_leader()->get_name() . '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td class="fw-bold">Regisztrálva</td>';
                        echo '<td>' . $team->Registered() . '</td>';
                        echo '</tr>';
                        echo '<tr>';
                        
                        
                        for($members = $team->get_members(), $size = count($members), $i = 0; $i < 5; ++$i){

                            echo '<tr>';

                            if($i == 0)
                                echo '<td class="fw-bold">Tagok</td>';
                            else
                                echo '<td class="fw-bold"></td>';

                            if($i < $size){
                                echo '<td>' . $members[$i]->get_name() . '</td>';
                            }else{
                                echo '<td> Nincs' . $i + 1 . '. tag</td>';
                            }

                            echo '</tr>';

                            
                        }
                        
                        echo '</tr>';
                        echo '<tr>';
                        echo '<td class="fw-bold">Nyerések</td>';
                        echo '<td>' . $team->get_win() . '</td>';
                        echo '<tr>';
                        echo '<td class="fw-bold">Vesztések</td>';
                        echo '<td>' . $team->get_lose() . '</td>';
                        echo '</tr>';
                        echo '</tr>';
                        echo '</tbody>';
                        echo '</table>';
                        echo '</div>';
                    }
                    else{
                    echo '<div id="team-profile-title" class="p-2 ps-4 fw-bold">';
                    echo 'Ez a csapat nem létezik';
                    echo '</div>';
                    echo '<div class="px-5">';
                    echo '<table id="team-profile-table" class="table">';
                    echo '<tbody>';
                    echo '<tr>';
                    echo '<td class="fw-bold">Tulajdonos</td>';
                    echo '<td>Ismeretlen</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td class="fw-bold">Regisztrálva</td>';
                    echo '<td>Ismeretlen</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td class="fw-bold">Tagok</td>';
                    echo '<td>Ismeretlenek</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td class="fw-bold">Nyerések</td>';
                    echo '<td>Ismeretlen</td>';
                    echo '<tr>';
                    echo '<td class="fw-bold">Vesztések</td>';
                    echo '<td>Ismeretlen</td>';
                    echo '</tr>';
                    echo '</tr>';
                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                    }

                    ?>

                </div>
            </section>
        </section>
        <section id="right-bcg-img" class="flex-fill blur-2"></section>
    </section>
    </section>
    <?php require $configs['paths']['templates'] . "/footer.php" ?>
</body>
</html>