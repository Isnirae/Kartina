<?php
ob_start();

require __DIR__ . './config/database.php';

$theme_id = $_GET['theme_id'] ?? '10';

if ($theme_id >= 10) {
    $oeuvres = $db->query('SELECT * FROM articles')->fetchAll();
} else {
    $query = $db->prepare('SELECT * FROM articles WHERE Themes_id = :id');
    $query->bindValue(':id', $theme_id);
    $query->execute();
    $oeuvres = $query->fetchAll();
}


$query = $db->prepare('SELECT * FROM themes WHERE id = :id');
$query->bindValue(':id', $theme_id);
$query->execute();
$theme_name = $query->fetch();


$title = $theme_name['FrName'];

require_once __DIR__ . '/partials/header.php';

global $db;





?>

<?php if ($theme_id >= 10) { ?>
    <h1 class="text-center mb-4 mt-4">Toutes les oeuvres</h1>

<?php } else { ?>
    <h1 class="text-center mb-4 mt-4">Toutes les oeuvres de la catégorie <?= $theme_name['FrName'] ?></h1>
<?php } ?>

<div class="row container themes_left mt-4 container_index">

    <?php foreach ($oeuvres as $oeuvre) { ?>

        <div class="card shadow m-4 col-3 p-2 bg-secondary text-light">

            <img src="uploads/oeuvres/<?= $oeuvre['ImageUrl']; ?>" class="card-img-top" alt="">
            <h5 class="text-center m-4"><?= $oeuvre['Name']; ?></h5>

            <table class="table mt-4 text-light">
                <tbody>
                    <tr>
                        <td>A partir de :</td>
                        <td><?= $oeuvre['Price'] ?> €</td>
                    </tr>
                    <tr>
                        <td>Stock :</td>
                        <td><?= $oeuvre['Stock'] ?></td>
                    </tr>
                </tbody>
            </table>

            <div>
                <p> <?= $oeuvre['FrDescription'] ?></p>
            </div>
            <div class="text-center vertical_bottom">
                <a href="./achat.php?article_id=<?=$oeuvre['id']; ?>" class="btn back-orange">Acheter</a>
                <a href="./artiste.php?artist_id=<?=$oeuvre['User_id']; ?>" class="btn back-orange">Voir l'artiste</a>
            </div>
        </div>

    <?php } ?>

</div>


<?php
require_once __DIR__ . '/partials/footer.php';
exit;
?>