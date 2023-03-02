<?php
    $configs = require "./config.php";
    $pdo = require "./db.php";
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="/styles/header.css">
    <link rel="stylesheet" href="/styles/footer.css">
    <link rel="stylesheet" href="/styles/global.css"> -->
    <link rel="stylesheet" href="minden.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
    </style>

    <title>Főoldal</title>
</head>

<body>
<div class="bg"></div>
    <div class="bg bg2"></div>
    <div class="bg bg3"></div>
<?php require_once $configs['paths']['templates'] . "/header.php"; ?>




    <!--maga a tartalom-->
    <div class="footer-miatt-padding mt-1">
        <div class="container-fluid">
            <div class="row d-flex align-items-stretch">


                <!--Card-->
                <div class="card col-12 col-lg-7 mb-2 bg-dark text-white mt-5 main" style="max-width: 80%; margin: 0 auto;">
                    <div class="row no-gutters">
                        <div class="col">
                            <div class="card-body">
                                

                                <?php
                            /*
                            <div class="news-post">
                                <h4 class="news-post-title">Hírnév</h4>
                                <h6 class="news-post-date">2022.09.29</h6>
                                <div class="news-post-content">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at nulla eu nunc rhoncus tincidunt vel blandit nisl. Proin venenatis velit sed est tincidunt vulputate. Quisque mi massa, posuere vel imperdiet at, vestibulum vitae nibh. Integer molestie dolor condimentum quam sagittis volutpat. Vivamus in eros in diam facilisis blandit. Cras sollicitudin tellus ut lorem ultricies interdum. In gravida sapien mauris, sit amet tristique odio volutpat eget. Duis non libero hendrerit, aliquam risus in, interdum nisi. Aenean sed bibendum eros, quis ullamcorper lacus. Mauris eu diam aliquet urna dictum dapibus in sed ex.
                                </div>
                                <div class="news-post-author blockquote-footer text-end">Skydeszka</div>
                            </div>
                            */

                            $newsquery = "SELECT * FROM news ORDER BY created DESC;";

                            $stmt = $pdo->prepare($newsquery);

                            if(!$stmt->execute() || $stmt->rowCount() <= 0){;
                                $htmltag =
                                    '<h2 class="card-title mb-5">Főoldal</h2>
                                    <p class="card-text">
                                    <h4>Milyen üres...</h4>
                                    Nem találtunk híreket.<br>
                                    Ha ezt az állapot sokáig fennmarad, kérünk jelezz a vezetőség felé.
                                    </p>';

                                echo $htmltag;

                            }else{

                                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                    echo '<div class="news-post mb-3 p-3">';
                                    echo '<h4 class="news-post-title">';
                                    echo strip_tags($row['title']);
                                    echo '</h4>';
                                    echo '<h6 class="news-post-date">';
                                    echo date("Y. m. d. H:i", strtotime($row['created']));
                                    echo '</h6>';
                                    echo '<div class="news-post-content">';
                                    echo $row['content'];
                                    echo '</div>';
                                    echo '<div class="news-post-author blockquote-footer text-end">';
                                    echo strip_tags($row['author']);
                                    echo '</div>';
                                    echo '</div>';
                                }
                            }
                        ?>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="card col-12 col-lg-4 mb-2 second text-white mt-5 main" style="max-width: 80%; margin: 0 auto;">
                    <div class="row no-gutters">
                        <div class="col">
                            <div class="card-body">
                                <h2 class="card-title mb-5">Regisztrált csapatok</h2>
                                <div id="registered-teams-data" class="px-2">
                                    <p class="card-text">

                                    <?php
                            /*
                            <div class="registered-post row gx-0">
                                <div class="col-8">
                                    Csapatnév
                                </div>
                                <div class="col-4 text-end pe-3">
                                    2022.09.21
                                </div>
                            </div>
                            */

                            $teamsquery = "SELECT ID, name, registered FROM teams ORDER BY registered DESC;";

                            $stmt = $pdo->prepare($teamsquery);

                            if(!$stmt->execute() || $stmt->rowCount() <= 0){
                                $htmltag =
                                    '<div class="registered-post row gx-0">
                                        <div class="col-8">
                                            Még nem jelentkezett egy csapat sem...
                                        </div>
                                    </div>';

                                echo $htmltag;

                            }else{

                                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                    $htmltag = '<div class="registered-post row gx-0">';
                                    $htmltag .= '<div class="col-8">';
                                    $htmltag .= '<a class="link" href="oldalak/csapatok/adatlap.php?ID=' . strip_tags($row['ID']). '">';
                                    $htmltag .= strip_tags($row['name']);
                                    $htmltag .= '</a>';
                                    $htmltag .= '</div>';
                                    $htmltag .= '<div class="col-4 text-end pe-3">';
                                    $htmltag .= strip_tags($row['registered']);
                                    $htmltag .= '</div>';
                                    $htmltag .= '</div>';

                                    echo $htmltag;
                                }

                            }
                        ?>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="card footer">
        <div class="card-body bg-dark text-white">
            <blockquote class="blockquote mb-0">
                <p>Minden jog fenntartva<br>Copyright ©2022</p>
            </blockquote>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>