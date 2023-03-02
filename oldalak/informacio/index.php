<?php
    $configs = require "../../config.php";
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="/styles/header.css">
    <link rel="stylesheet" href="/styles/footer.css">
    <link rel="stylesheet" href="/styles/global.css"> -->
    <link rel="stylesheet" href="/minden.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
    </style>

    <title>Információk</title>
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
                <div class="card col mb-2 bg-dark text-white mt-5 main" style="max-width: 500px; margin: 0 auto; text-align: center">
                    <div class="row no-gutters">
                        <div class="col">
                            <div class="card-body">
                                <h2 class="card-title mb-5">Információk</h2>
                                <p class="card-text">
                                <h4>Tartalomjegyzék</h4>
                                <div id="tableofcontent-list" class="text-start">
                                    <div id="table-of-context">
                                        <div id="rules-toc">
                                            <h4>
                                                <a href="#rules" style="color: white">Szabályzat</a>
                                            </h4>
                                            <ul class="pointed-list ps-4">
                                                <li>
                                                    <a href="#rules-register" style="color: white">Regisztráció szabályzata</a>
                                                </li>
                                                <li>
                                                    <a href="#rules-team" style="color: white">Csapat regisztráció szabályzata</a>
                                                </li>
                                                <li>
                                                    <a href="#rules-data" style="color: white">"Adatvédelmi nyilatkozat"</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div id="competetion-toc">
                                            <h4>
                                                <a href="#competetion" style="color: white">Bajnokság</a>
                                            </h4>
                                            <ul class="pointed-list ps-4">
                                                <li>
                                                    <a href="#competetion-rules" style="color: white">Verseny menete</a>
                                                </li>
                                                <li>
                                                    <a href="#competetion-season-times" style="color: white">Season ideje</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!------------------------------------------------------------------------->
                                <div id="rules" class="content-part mx-auto">
                                    <div id="rules-header" class="p-3 h1 mb-2 pb-0">
                                        Szabályzat
                                    </div>
                    
                                    <ul id="rules-list" class="info-list m-auto text-start">
                                        
                    
                                        <div id="rules-register">
                                            <h4>Regisztráció szabályzata</h4>
                                            <ul class="pointed-list ps-4">
                                                <li>A regisztrációhoz legalább 16 évesnek kell lenned</li>
                                                <li>A regisztrációval elfogadod a szabályzatot</li>
                                                <li>Az összes adat és a weboldal 2022. június 20. törlésre kerül</li>
                                                <li>A nevezéshez ajánlott semmilyen igazi adatot megadni</li>
                                                <li>A weblap csak verseny céljából készült, nincs semmilyen bajnokság</li>
                                                <li>A weblap nincs titkosítva, a jelszavak legyenek véletlenszerűek</li>
                                                <li>A felhasználónév legalább 6 maximum 255 karakterből kell, hogy álljón</li>
                    
                                            </ul>
                                        </div>
                                        <div id="rules-team">
                                            <h4>Csapat regisztráció szabályzata</h4>
                                            <ul class="pointed-list ps-4">
                                                <li>Egy csapat regisztrálásához legalább 18 évesnek kell lenned</li>
                                                <li>A regisztrációval elfogadod a szabályzatot</li>
                                                <li>A csapatok neve legalább 3 maximum 20 karakterből kell, hogy álljón</li>
                                                <li>A csapatvezető felelőséget vállal a csapattagok iránt</li>
                                                <li>A csapat bármikor törölhető, de ez véglegesen törli az összes adatot</li>
                                            </ul>
                                        </div>
                                        <div id="rules-data">
                                            <h4>"Adatvédelmi nyilatkozat"</h4>
                                            <ul class="pointed-list ps-4">
                                                <li>Semmilyen megadott adatnam <b>NEM</b> kell valósnak lennie</li>
                                                <li>Az összes megadott adat csak a verseny kezelése alatt van használva</li>
                                                <li>A valósan megadott adatokért nem vállalunk felelősséget</li>
                                                <li>A jelszó egyedi legyen, a weboldal csatlakozása nem titkosított</li>
                                            </ul>
                                        </div>
                                    </ul>
                                </div>
                                <!------------------------------------------------------------------------->
                                <div id="competetion" class="content-part mx-auto">
                                    <div id="competetion-header" class="p-3 h1 mb-2 pb-0">
                                        Bajnokság
                                    </div>
                    
                                    <ul id="competetion-list" class="info-list m-auto text-start">
                                        
                    
                                        <div id="competetion-rules">
                                            <h4>Verseny menete</h4>
                                            <ul class="pointed-list ps-4">
                                                <li>A verseny párhuzamosan játszódik le</li>
                                                <li>Fordulók helyett, "<i>Season</i>"-ok vannak</li>
                                                <li>A csapatok regisztrációja az első <i>Season</i>-ben lehetséges</li>
                                                <li>Az azonos meccseteket lejátszott csapatok mérkőznek meg egymás ellen</li>
                                                <li>
                                                    Egy csapat meccseiről mindig email-ben értesítjűk a tulajdonost,
                                                    a csapattagok értesítéséről, neki kell gondoskodnia
                                                </li>
                                                <li>Minden <i>Season</i> megjutalmazzuk a legtöbb nyeréssel rendelkező csapatot</li>
                                            </ul>
                                        </div>
                    
                                        <div id="competetion-season-times">
                                            <h4>Season ideje</h4>
                                            <div id="table-body">
                                                <table class="table" style="color: rgb(215, 249, 255)">
                                                    <thead id="table-head">
                                                        <tr>
                                                            <td>Season száma</td>
                                                            <td>Kezdet</td>
                                                            <td>Vége</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Season 1</td>
                                                            <td>2022. 02. 01</td>
                                                            <td>2022. 03. 01</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Season 2</td>
                                                            <td>2022. 03. 02</td>
                                                            <td>2022. 04. 01</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Season 3</td>
                                                            <td>2022. 04. 02</td>
                                                            <td>2022. 05. 01</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Season 4 - Elődöntő</td>
                                                            <td>2022. 05. 02</td>
                                                            <td>2022. 06. 01</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Season 5 - Finálé</td>
                                                            <td>2022. 07. 01</td>
                                                            <td>2022. 08. 01</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </ul>
                                </div>
                                <!------------------------------------------------------------------------->
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