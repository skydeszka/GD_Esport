<?php
    $configs = require "../../config.php";
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="/public/styles/header.css">
    <link rel="stylesheet" href="/public/styles/footer.css">
    <link rel="stylesheet" href="/public/styles/global.css"> -->
    <link rel="stylesheet" href="/public/styles/minden.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
    </style>

    <title>Segítség</title>
</head>

<body>
<div class="bg"></div>
    <div class="bg bg2"></div>
    <div class="bg bg3"></div>
<?php require_once $configs['paths']['templates'] . "/header.php"; ?>




    <!--maga a tartalom-->
    <div class="footer-miatt-padding mt-1">
        <div class="container-fluid">
            <div class="row d-flex align-items-stretch">


                <!--Card-->
                <div class="card col mb-2 bg-dark text-white mt-5 main" style="max-width: 80%; margin: 0 auto;">
                    <div class="row no-gutters">
                        <div class="col">
                            <div class="card-body" style="text-align: center">
                                <h2 class="card-title mb-5">Segítségek tárháza</h2>
                                <h2 class="card-title mb-1">Elérhetőségek</h2>
                                <p class="card-text">
                                    <div class="card bg-danger text-light mt-3 mb-4">
                                        <div class="row no-gutters">
                                            <h3 class="mb-3">FIGYELEM!</h3>
                                            <h6>A megadott telefonszám nem igazi, csak az oldal valóságához ad hozzá.</h6>
                                            <h6>Kérjük NE próbálják meg felhívni</h6>    
                                        </div>
                                    </div>
                                <h6>Telefonszám: +36 55 230 833</h6>
                                <h6>Email: 
                                    <a href="mailto:ormandi.norbert@diak.szbi-pg.hu" style="color: white;">ormandi.norbert@diak.szbi-pg.hu</a>
                                </h6>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
                

            </div>
        </div>
    </div>


    <div class="card footer">
        <div class="card-body bg-dark text-white">
            <blockquote class="blockquote mb-0">
                <p>Minden jog fenntartva<br>Copyright ©2022</p>
            </blockquote>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>