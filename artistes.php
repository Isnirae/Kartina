<?php

$title = "Artistes";

require_once __DIR__ . '/partials/header.php';

global $db;



$artists = $db->query('SELECT * FROM user WHERE Role = "artist" ')->fetchAll();




?>



<h1 class="text-center">Artistes</h1>


<div class="row container_index">

    <?php foreach ($artists as $artist) { ?>

        <div class="card shadow m-4 col-3 p-2">

            <?php $query = $db->prepare('SELECT * FROM articles WHERE User_id = :id ORDER BY id DESC');
            $query->bindValue(':id', $artist['id']);
            $query->execute();
            $articles = $query->fetch(); //fecth et non fetchAll car on ne souhaite qu'une seule image ici
            ?>

            <img src="uploads/oeuvres/<?= $articles['ImageUrl']; ?>" class="card-img-top" alt="">

            <div class="card-body">
                <h2 class="card-title text-center"><?= $artist['FirstName'] . ' ' . $artist['LastName']; ?></h2>
                <p class="card-text"><?= substr($artist['FrDescription'], 0, 60) . "..."; ?></p>
            </div>
            <div class='text-center'>
                <a href="artiste.php?artist_id=<?= $artist['id'] ?>" class='btn back-orange'> Voir l'artiste</a>

            </div>
        </div>

    <?php } ?>


</div>


<?php
require_once __DIR__ . '/partials/footer.php';
exit;
?>