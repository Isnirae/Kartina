<?php require_once __DIR__ . '/partials/header.php';

global $db;
$Articles = $db->query('SELECT * FROM Articles')->fetchAll();
$carouselArticles = $db->query('SELECT * FROM Articles ORDER BY Date DESC LIMIT 9')->fetchAll();

?>

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner">
        <?php foreach ([0, 3, 6] as $key) { ?>
            <div class="carousel-item <?= $key === 0 ? 'active' : ''; ?>">
                <div class="d-flex">
                    <img src="uploads/oeuvres/<?= $carouselArticles[$key]['ImageUrl']; ?>" class="d-block" alt="<?= $carouselArticles[$key]['Name']; ?>">
                    <img src="uploads/oeuvres/<?= $carouselArticles[$key + 1]['ImageUrl']; ?>" class="d-block" alt="<?= $carouselArticles[$key + 1]['Name']; ?>">
                    <img src="uploads/oeuvres/<?= $carouselArticles[$key + 2]['ImageUrl']; ?>" class="d-block" alt="<?= $carouselArticles[$key + 2]['Name']; ?>">
                </div>
            </div>
        <?php } ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<div class="container container_index">


    <?php
    $randomArticles = $db->query('SELECT * FROM Articles ORDER BY RAND() LIMIT 6');
    ?>
    
    <div class="container mt-4 mb-5">
        <h2 class="">Photographies d’art</h2>
        <h5 class="">Oeuvres en édition limitée et numérotée avec certificat d'authenticité</h5>

        <div class="row">
                <?php foreach ($randomArticles as $Article) { ?>
                    <?php 
                        $query = $db->prepare('SELECT * FROM user WHERE id = :id ');
                        $query->bindValue(':id', $Article['User_id']);
                        $query->execute();
                        $User = $query->fetch();
                        ?>
                    <div class="col-4">
                        <div class="card shadow mb-4 ">
                            <img class="card-img-top" src="uploads/oeuvres/<?= $Article['ImageUrl']; ?>" />
                            <div class="card-body">

                                <a href="./artiste.php?artist_id=<?= $User['id']; ?>" class="text-orange">
                                    <h3 class="card-title"><?= $User['Alias']; ?></h3>
                                </a>


                                <h3 class="card-title"><?= $Article['Name']; ?></h3>
                                <p class="card-text">Edition limitée</p>
                                <p class="card-text">
                                    Créer en <?= substr($Article['Date'], 0, 4); ?>
                                </p>
                                <p class="card-text">
                                    à partir de <?= $Article['Price']; ?> €
                                </p>

                                <div class="d-grid">
                                    <a href="./article.php?id=<?= $Article['id']; ?>" class="btn btn-warning">Voir l'oeuvre</a>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php }?>

        </div>
    </div>

    <div class="d-flex justify-content-sm-center">
        <h1><a href="./Article.php" class="link-dark">Explorer la collection</a></h1>
    </div>

    <br>
    <br>

    <div class="card-group">

    <?php 
                        $query = $db->prepare('SELECT * FROM themes
                        INNER JOIN articles ON themes.id = articles.themes_id
                        WHERE articles.themes_id = :id');
                        $query->bindValue(':id', 2);
                        $query->execute();
                        $Voyage = $query->fetch();
                        ?>

        <div class="card bg-dark text-grey">
            <img src="uploads/oeuvres/<?= $Voyage['ImageUrl']; ?>" class="card-img" alt="...">
            <div class="card-img-overlay">
                <h4 class="card-title">Voyages</h4>
                <h4 class="card-title">Vivez vos rêves</h4>
                <h6 class="card-text"> <a class="link-dark" href="./themes.php?theme_id=<?= $Voyage['Themes_id']?>">Parcourir la collection</a></h6>
            </div>
        </div>

        <div class="card text-end bg-dark text-white">
            <img src="uploads/oeuvres/<?= $Article['ImageUrl']; ?>" class="card-img" alt="...">
            <div class="card-img-overlay">
                <h4 class="card-title"><?= $User['Alias'] ?> </h4>
                <h4 class="card-title"><?= $Article['Name']; ?></h4>
                <h6 class="card-text"> <a class="link-light" href="./artiste.php?artist_id=<?= $User['id']; ?>">Découvrir l’artiste</a></h6>
            </div>
        </div>

    </div>

    <div class="card-group">

    <?php 
                        $query = $db->prepare('SELECT * FROM themes
                        INNER JOIN articles ON themes.id = articles.themes_id
                        WHERE articles.themes_id = :id');
                        $query->bindValue(':id', 3);
                        $query->execute();
                        $bandw = $query->fetch();
                        ?>

        <div class="card bg-dark text-grey">
            <img src="uploads/oeuvres/<?= $bandw['ImageUrl']; ?>" class="card-img" alt="...">
            <div class="card-img-overlay">
                <h4 class="card-title">Noir & Blanc</h4>
                <h4 class="card-title">Des oeuvres intemporelles</h4>
                <h6 class="card-text"> <a class="link-dark" href="./themes.php?theme_id=<?= $bandw['Themes_id'] ?>">Découvrir la collection</a></h6>
            </div>
        </div>

<?php $randone = $db->query('SELECT * FROM Articles ORDER BY Stock LIMIT 1')->fetch(); ?>

        <div class="card text-end bg-dark text-white">
            <img src="uploads/oeuvres/<?= $randone['ImageUrl']; ?>" class="card-img" alt="...">
            <div class="card-img-overlay">
                <h4 class="card-title">Derniers exemplaires</h4>
                <h4 class="card-title">Ne passer pas à côté de votre oeuvre</h4>
                <h6 class="card-text"> <a class="link-light" href="./article.php?id=<?= $randone['id']; ?>">Découvrir notre dernière oeuvre</a></h6>
            </div>
        </div>
    </div>

</div>




<?php require_once __DIR__ . '/partials/footer.php'; ?>