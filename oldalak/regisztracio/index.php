<?php
    $configs = require_once "../../config.php";
    require_once $configs['paths']['php'] . "/authenticate.php";
    require_once $configs['paths']['php'] . "/headers.php";
    

    if(IsLoggedIn()){
        RedirectTo("/");
        exit();
    }

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

    <?php echo $configs['jquery']; ?>

    <link rel="stylesheet" href="/minden.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>

    </style>

    <title>Regisztráció</title>
</head>

<body>
<div class="bg"></div>
    <div class="bg bg2"></div>
    <div class="bg bg3"></div>
    <?php require $configs['paths']['templates'] . "/header.php"; ?>



    <!--maga a tartalom-->
    <div class="footer-miatt-padding">
    <script src="/src/javascript/regisztracio.js"></script>

        <div class="container-fluid d-flex justify-content-center">
            <div class="row">

                <!--Card-->
                <div class="card  mb-5 bg-dark text-white mt-5" style="max-width: 500px; margin: 0 auto;">
                    <div class="row no-gutters">

                        <section class="signup-form">
                            <h2 class="mb-4 mt-0 szoveg-arnyek">Regisztráció</h2>

                            <div class="card bg-danger text-light mt-3 mb-4">
                                <div class="row no-gutters">
                                    <h3 class="mb-3">FIGYELEM!</h3>
                                    <h6>A weboldal kapcsolata nem biztonságos. Kérjük a megadott jelszó ne legyen
                                        használt, mivel veszélynek rakja ki.</h6>
                                    <h6>Ez a weboldal csak egy informatikai verseny miatt jött létre, minden adatot
                                        törlünk a verseny vége után.</h6>
                                    <h6>A megadott adatoknak egyikének sem kell valósnak lennie.</h6>
                                    <h6>Ezek az adatok nem lesznek semmiféle különleges úton feldolgozva, csak az
                                        oldalon lehet őket megtekinteni.</h6>
                                    <h6>A regisztrációval elfogadja, az ezt a rövid adatkezelési tájékoztatót</h6>
                                </div>
                            </div>

                            <div class="signup-form-form">
                                <form action="./sikeres.php" method="POST" id="register-form">

                                    <div class="form-group mb-4">
                                        <label for="exampleInputEmail1">Teljes név</label>
                                        <input type="text" name="name" class="form-control arnyek"
                                            placeholder="Teljes név...">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="exampleInputEmail1">Születési idő</label><br>
                                        <input id="bday" type="date" name="birthdate" class="data-input">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="exampleInputEmail1">Megye</label>
                                        <select id="select" name="county" required>
                                            <option value="">Please select</option>
                                            <option value="budapest">Budapest</option>
                                            <option value="baranya">Baranya</option>
                                            <option value="bacskiskun">Bács-Kiskun</option>
                                            <option value="bekes">Békés</option>
                                            <option value="borsodabaujzemplen">Borsod-Abaúj-Zemplén</option>
                                            <option value="csongrad">Csongrád</option>
                                            <option value="fejer">Fejér</option>
                                            <option value="gyormosonsopron">Győr-Moson-Sopron</option>
                                            <option value="hajdubihar">Hajdú-Bihar</option>
                                            <option value="heves">Heves</option>
                                            <option value="jasznagykunszolnok">Jász-Nagykun-Szolnok</option>
                                            <option value="komaromesztergom">Komárom-Esztergom</option>
                                            <option value="nograd">Nógrád</option>
                                            <option value="pest">Pest</option>
                                            <option value="somogy">Somogy</option>
                                            <option value="szabolcsszatmarbereg">Szabolcs-Szatmár-Bereg</option>
                                            <option value="tolna">Tolna</option>
                                            <option value="vas">Vas</option>
                                            <option value="veszprem">Veszprém</option>
                                            <option value="zala">Zala</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="exampleInputEmail1">Felhasználónév</label>
                                        <input id="username" type="text" name="email" class="form-control arnyek"
                                            placeholder="pelda_felhasznalonev...">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="exampleInputEmail1">E-mail cím</label>
                                        <input id="mail" type="text" name="uid" class="form-control arnyek"
                                            placeholder="email@email.com...">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="exampleInputEmail1">Jelszó</label>
                                        <input type="password" name="pwd" class="form-control arnyek"
                                            placeholder="pelda_jelszo...">
                                    </div>

                                    <button id="registration" type="submit" name="submit"
                                        class="btn btn-info arnyek">Regisztráció</button>
                                </form>
                            </div>
                        </section>

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

</html>