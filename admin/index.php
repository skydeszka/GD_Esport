<?php
    $configs = require "../config.php";
    require_once $configs['paths']['php'] . "/authenticate.php";
    require_once $configs['paths']['php'] . "/headers.php";
    $dbconf = $configs['database'];

    if(!IsAdmin()){
        RedirectTo("/");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="/public/styles/index/index.css" rel="stylesheet">
    <link href="/public/styles/global.css" rel="stylesheet">
    <?php echo $configs['bootstrap']['css']; ?>
</head>
<body>
    <?php require_once $configs['paths']['templates'] . "/header.php"; ?>

    <section id="content-root" class="container-fluid gx-0">
        <section id="content" class="row gx-0 m-2">
            <a href="./hirkezelo.php">Hírkezelő</a>
        </section>
    </section>
    <?php require $configs['paths']['templates'] . "/footer.php" ?>

</body>
</html>