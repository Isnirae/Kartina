<?php

$title = "Bientôt en rupture";

require_once __DIR__ . '/partials/header.php';

global $db;

$articles = $db->query('SELECT * FROM articles WHERE Stock BETWEEN 1 AND 500  ')->fetchAll();

?>


<div class="container mt-4 mb-5 container_index">

<h1 class="text-center">Nos articles bientôt en rupture</h1>

        <div class="row">
                <?php foreach ($articles as $article) { ?>
                    <?php 
                        $query = $db->prepare('SELECT * FROM user WHERE id = :id ');
                        $query->bindValue(':id', $article['User_id']);
                        $query->execute();
                        $User = $query->fetch();
                        ?>
                    <div class="col-4">
                        <div class="card shadow mb-4 ">
                            <img class="card-img-top" src="uploads/oeuvres/<?= $article['ImageUrl']; ?>" />
                            <div class="card-body">

                                <a href="./artiste.php?artist_id=<?= $User['id']; ?>" class="text-orange">
                                    <h3 class="card-title"><?= $User['Alias']; ?></h3>
                                </a>


                                <h3 class="card-title"><?= $article['Name']; ?></h3>
                                <p class="card-text">Edition limitée</p>
                                <p class="card-text">
                                    Créer en <?= substr($article['Date'], 0, 4); ?>
                                </p>
                                <p class="card-text">
                                    à partir de <?= $article['Price']; ?> €
                                </p>

                                <div class="d-grid">
                                    <a href="./article.php?id=<?= $article['id']; ?>" class="btn btn-warning">Voir l'oeuvre</a>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php }?>

        </div>
    </div>


<?php
require_once __DIR__ . '/partials/footer.php';
exit;
?>