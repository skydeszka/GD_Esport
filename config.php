<?php

return [
    'database' => [
        'host' => "localhost",
        'username' => "deszka",
        'password' => "admin",
        'database' => "gd-esport",
    ],

    'email' => [
        'user' => 'esport',
        'domain' => 'gabordenes.fejlessz.hu',
        'password' => 'IstenAlldMegAMagyart'
    ],

    "paths" => [
        "sites" =>  __DIR__ . "/src/php/sites",
        "types" => __DIR__ . "/src/php/types",
        "php" => __DIR__ . "/src/php",
        "templates" => __DIR__ . "/src/templates"
    ],

    'root' => __DIR__ . "/",

    'bootstrap' => [
        "css" => '<link href="/public/styles/bootstrap/bootstrap.min.css" rel="stylesheet">',
        "js" => '<script src="/src/javascript/bootstrap/bootstrap.min.js"></script>'
    ],
    'jquery' => '<script src="/src/javascript/jquery.js"></script>',
    'cookies' => '<script src="/src/javascript/cookies/js.cookie.js"></script>'
];

?>