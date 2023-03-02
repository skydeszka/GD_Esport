<?php
    $configs = require "../../config.php";
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
    <title>Szerver hiba</title>
    <?php echo $configs['bootstrap']['css']; ?>
    <?php echo $configs['bootstrap']['js']; ?>
    <link href="/public/styles/global.css" rel="stylesheet">
    <link href="/public/styles/informacio/styles.css" rel="stylesheet">
    <link href="/public/styles/informacio/table.css" rel="stylesheet">
</head>
<body>
    <?php require_once $configs['paths']['templates'] . "/header.php"; ?>
    <section id="content-root" class="container-fluid gx-0 d-flex align-items-center justify-content-center align-items-stretch">
        <section id="left-bcg-img" class="flex-fill blur-2"></section>
        <section id="content" class="px-5 gx-0 mx-5 my-2 text-center" style="width: 60%"> 
            <h1 id="content-header" style="font-size: 3.5em;">Szerver hiba</h1>

            <h2>Váratlan szerver hiba történt.</h2>

        </section>
        <section id="right-bcg-img" class="flex-fill blur-2"></section>
    </section>
    <?php require $configs['paths']['templates'] . "/footer.php" ?>

</body>
</html>