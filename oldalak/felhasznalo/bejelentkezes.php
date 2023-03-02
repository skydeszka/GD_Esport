<?php
    if(session_status() != PHP_SESSION_ACTIVE)
        session_start();

    $configs = require_once "../../config.php";
    $pdo = require $configs['root'] . "/db.php";
    require_once $configs['paths']['php'] . "/authenticate.php";
    require_once $configs['paths']['php'] . "/headers.php";
    require_once $configs['paths']['types'] . "/seconds.php";
    $loggedIn = IsLoggedIn();

    function CheckSubmit(): bool{
        return isset($_POST['email'], $_POST['password']);
    }

    if($loggedIn){
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
    <link rel="stylesheet" href="/minden.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>

    </style>

    <title>Bejelentkezés</title>
</head>

<body>
<div class="bg"></div>
    <div class="bg bg2"></div>
    <div class="bg bg3"></div>
<?php require $configs['paths']['templates'] . "/header.php"; ?>


    <!--maga a tartalom-->
    <div class="footer-miatt-padding">
        <div class="container-fluid d-flex justify-content-center">
            <div class="row">

                <!--Card-->
                <div class="card  mb-5 bg-dark text-white mt-5" style="max-width: 500px; margin: 0 auto;">
                    <div class="row no-gutters">

                        <section class="signup-form">
                            <h2 class="mb-4 mt-0 szoveg-arnyek">Regisztráció</h2>

                            <div class="signup-form-form">
                                <form action="includes/signup.inc.php" method="POST">

                                    <div class="form-group mb-4">
                                        <label for="exampleInputEmail1">E-mail cím</label>
                                        <input type="text" name="uid" class="form-control arnyek"
                                            placeholder="email@email.com...">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="exampleInputEmail1">Jelszó</label>
                                        <input type="password" name="pwd" class="form-control arnyek"
                                            placeholder="pelda_jelszo..."><br>
                                            Emlékezz rám <input type="checkbox">
                                            <button id="registration" type="submit" name="submit"
                                        class="btn btn-info arnyek">Mutasd</button>
                                    </div>

                                    <?php

$error = false;

if(CheckSubmit()){


    $query = "SELECT ID, hash FROM `users` WHERE `email`= :mail;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":mail", $_POST['email'], PDO::PARAM_STR);

    if($stmt->execute()){

        if($stmt->rowCount() <= 0)
            $error = true;
        else{


            $row = $stmt->fetch(PDO::FETCH_ASSOC);


            if(!password_verify($_POST['password'], $row['hash']))
                $error = true;
            else{

                $useCookie = false;
                $data = $row['ID'] . $row['hash'];

                if(isset($_POST['remember']) && $_POST['remember'] == "on")
                    $useCookie = true;

                SetLoginData($data, $useCookie);

                RedirectTo("/");
                exit();

            }
        }
    }

    if($error){
        echo '<div class="alert alert-danger data-error mx-auto mt-4" role="alert">';
        echo '<div class="fs-3">Hiba!</div>';
        echo '<div class="error-message">';
        echo 'Helytelen felhasználónév vagy jelszó!';
        echo '</div>';
        echo '</div>';
    }
}
?>
                                    
                                    <button id="registration" type="submit" name="submit"
                                        class="btn btn-info arnyek">Bejelentkezés</button>
                                        <button id="registration" type="submit" name="submit"
                                        class="btn btn-danger arnyek">Elfelejtett jelszó</button>
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