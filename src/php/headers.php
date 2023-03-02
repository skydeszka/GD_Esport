<?php
$configs = require $_SERVER['DOCUMENT_ROOT'] . "/config.php";
require_once $configs['paths']['php'] . "/string.php";

function RedirectTo(string $path): void{

    $URL = GetURL() . $path;

    header("Location: $URL");
}
?>