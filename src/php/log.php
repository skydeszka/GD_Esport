<?php
    $config = require "../../config.php";
    require_once $config['paths']['php'] . "/string.php";

    function ConsoleLog($message){

        $log = SanitizeQuotes($message);

        echo "<script>console.log('" . $log . "')</script>";
    }

    
?>