<?php
    $configs = require $_SERVER['DOCUMENT_ROOT'] . "/config.php";
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
    <title>Sikertelen jelentkezés</title>
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
            <h1>Sikertelen jelentkezés</h1>
            <div class="fs-5">
                <div class="mb-5">
                    Ez nem egy érvényes meghívó, a csapat már megtelt vagy már egy csapat tagja vagy.
                </div>
            </div>
        </section>
        <section id="right-bcg-img" class="flex-fill blur-2"></section>
    </section>
</body>
</html>