<?php
    $configs = require "../config.php";
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
    <title>Csapatok</title>
    <link href="/public/styles/global.css" rel="stylesheet">
    <?php echo $configs['bootstrap']['css']; ?>
</head>
<body>
    <?php require_once $configs['paths']['templates'] . "/header.php"; ?>
    <?php require $configs['paths']['templates'] . "/footer.php" ?>
</body>
</html>