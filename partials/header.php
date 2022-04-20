<?php
session_start();
require __DIR__ . '/../config/config.php';

require __DIR__ . '/../config/database.php';


require __DIR__ . '/../config/function.php';

require __DIR__ . '/../config/fonctions-panier.php';

$themes = $db->query('SELECT * FROM themes')->fetchAll();


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="./asset/scss/header.css">
    <link rel="stylesheet" href="./asset/scss/footer.css">
    <link rel="stylesheet" href="./asset/scss/html.css">
    <link rel="stylesheet" href="./asset/scss/contact.css">
    <script src="./asset/js/kartina.js"></script>
    <style>


    </style>
    <title><?= $title; ?></title>

</head>

<body class="front">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar1">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <h1>Kartina</h1>
                </a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <?php if (isset($_SESSION['user'])) { ?>

                            <li class="nav-item <?= $page === 'login.php' ? 'active' : ''; ?>">
                                <a class="nav-link text-light" href="./logout.php">Déconnexion

                                    <?= $_SESSION['user']['Alias'] ?></a>
                            </li>

                            <li class="nav-item <?= $page === 'account.php' ? 'active' : ''; ?>">
                                <a class="nav-link text-light" href="./account.php">Mon compte</a>
                            </li>

                        <?php } else { ?>


                            <li class="nav-item <?= $page === 'inscription.php' ? 'active' : ''; ?>">
                                <a class="nav-link text-light" href="./inscription.php">Inscription</a>
                            </li>
                            <li class="nav-item <?= $page === 'login.php' ? 'active' : ''; ?>">
                                <a class="nav-link text-light" href="./login.php">Connexion</a>
                            </li>

                        <?php } ?>

                        <?php if (isArtist()) { ?>

                            <li class="nav-item <?= $page === 'oeuvre.php' ? 'active' : ''; ?>">
                                <a class="nav-link text-light" href="./oeuvre.php">Oeuvres</a>
                            </li>

                        <?php } ?>


                        <li class="nav-item <?= $page === 'contact.php' ? 'active' : ''; ?>">
                            <a class="nav-link text-light" href="./contact.php">Contact</a>
                        </li>
                        <li class="nav-item <?= $page === 'panier.php' ? 'active' : ''; ?>">
                            <a class="nav-link text-light" href="./panier.php">Panier (<?= count(panier()) ?>)</a>
                        </li>
                    </ul>
                </div>
            </div>




        </nav>
        <nav class="navbar navbar-expand-lg navbar-dark navbar2" id="navbar2">
            <div class="dropdown collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item dropdown">
                        <button class="btn text-dark dropdown-toggle nav-link mx-4" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" style="background-color: #fea918;">
                            Photographies
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="./themes.php?theme_id=10">Tous nos thèmes</a></li>
                            <?php foreach ($themes as $theme) { ?>
                                <li><a class="dropdown-item" href="./themes.php?theme_id=<?=$theme['id'] ?>"><?= $theme['FrName'] ?></a></li>
                            <?php } ?>
                        </ul>
                    <li class="nav-item mx-4  <?= $page === 'new.php' ? 'active' : ''; ?>">
                        <a class="nav-link text-dark" href="./new.php">Nouveautés</a>
                    </li>
                    <li class="nav-item mx-4 <?= $page === 'artistes.php' ? 'active' : ''; ?>">
                        <a class="nav-link text-dark" href="./artistes.php">Artistes</a>
                    </li>
                    <li class="nav-item mx-4 <?= $page === 'last_item.php' ? 'active' : ''; ?>">
                        <a class="nav-link text-dark" href="./last_item.php">Derniers exemplaires</a>
                    </li>
                </ul>
                </li>
            </div>
        </nav>
    </header>

<?php if ( $title == 'Kartina' ) {

} else {
 require_once __DIR__ . '/fil_d_arianne.php';}?>

    <div style="margin-bottom: 200px;">

