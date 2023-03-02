<?php
    $configs = require "../../../config.php";
    require $configs['paths']['php'] . "/authenticate.php";
    require $configs['paths']['php'] . "/headers.php";

    $user = GetUserData();

    if(!$user){
        RedirectTo("/oldalak/felhasznalo/bejelentkezes.php");
        exit();
    }

    if($user->GetAge() < 18){
        RedirectTo("/");
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
    <?php echo $configs['bootstrap']['js']; ?>
    <?php echo $configs['jquery']; ?>
    <script src="/src/javascript/csapatok/regisztracio.js"></script>
    <link href="/public/styles/csapatok/regisztracio.css" rel="stylesheet">
</head>
<body>
    <?php require_once $configs['paths']['templates'] . "/header.php"; ?>
    <section id="content-root" class="container-fluid gx-0 d-flex align-items-center justify-content-center align-items-stretch">
        <section id="left-bcg-img" class="flex-fill blur-2"></section>
        <section id="content" class="gx-0 mx-5 my-2 text-center">
            <h1 id="content-header" class="h-25 p-5">Csapat regisztrácio</h1>



            <div id="contact" class="content-part p-5 w-75 mx-auto">
                <form id="register-form" class="form-inline" role="form" method="post" action="./sikeres.php">

                <div id="teamname-input" class="pb-3">
                    <label for="register-teamname">Csapatnév</label>
                    <input id="register-teamname" name="teamname" type="text" maxlength="255" pattern="[A-z._]+">
                </div>
                
                <input class="btn btn-secondary" type="submit" value="Létrehozás" name="submit">
                
                </form>
            </div>
        </section>
        <section id="right-bcg-img" class="flex-fill blur-2"></section>
    </section>
    

</body>
</html>