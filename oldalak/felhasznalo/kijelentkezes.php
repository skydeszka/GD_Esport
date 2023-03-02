<?php
if(session_status() != PHP_SESSION_ACTIVE)
    session_start();

$configs = require_once "../../config.php";
require_once $configs['paths']['php'] . "/headers.php";

unset($_SESSION['user']);

setcookie("user", null, -1, "/");

RedirectTo("/oldalak/felhasznalo/bejelentkezes.php");
exit();
?>