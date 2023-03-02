<?php
$config = require $_SERVER['DOCUMENT_ROOT'] . "/config.php";
require_once $config['paths']['php'] . "/string.php";
require_once $config['paths']['php'] . "/authenticate.php";

if(session_status() != PHP_SESSION_ACTIVE)
  session_start();

$userController = "../../../oldalak/felhasznalo";

$loggedIn = IsLoggedIn();
?>


    <div class="banner">
        <div>
            <h1>Rainbow Six Siege bajnokság</h1>
            <p>Mutasd meg, melyik a legjobb Rainbow Osztag</p>
            <div id="search">
                <form class="d-flex" action="/oldalak/kereses/" method="get">
                    <input id="search-text" class="form-control me-2" type="search" placeholder="Search"
                        aria-label="Search">
                    <button id="search-button" class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/">Főoldal</a>
                    </li>
                    <li class="nav-item">
                    <?php
                    if($loggedIn)
                      echo '<a class="nav-link" href="/oldalak/csapatok/kezelo.php">Csapat kezelő</a>';
                    else
                      echo '<a class="nav-link" href="/oldalak/regisztracio">Regisztráció</a>'
                  ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/oldalak/informacio">Információ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/oldalak/segitseg">Segítség</a>
                    </li>
                     <li>
                     <?php
                  if(IsAdmin()){

                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="/admin">Admin panel</a>';
                    echo '</li>';

                  }
                ?>
                     </li>
                     <li>
                     <?php

if($loggedIn)
  echo '<a id="loginButton" class="nav-link ms-5 me-3" href="' . $userController . '/kijelentkezes.php">Kijelentkezés</a>';
else
  echo '<a id="loginButton" class="nav-link ms-5 me-3" href="' . $userController . '/bejelentkezes.php">Bejelentkezés</a>';
?>
                     </li>
                </ul>
            </div>
        </div>
    </nav>