<?php
ob_start();

require __DIR__ . './config/database.php';

$id = $_GET['artist_id'] ?? 0;
//Récupére l'id dans l'url pour l'associer au bon artiste


global $db;

$query = $db->prepare('SELECT * FROM user WHERE id = :id');
$query->bindValue(':id', $id);
$query->execute();
$artist = $query->fetch();

$query = $db->prepare('SELECT * FROM articles WHERE User_id = :id');
$query->bindValue(':id', $id);
$query->execute();
$oeuvres = $query->fetchAll();

$query = $db->prepare('SELECT * FROM articles WHERE User_id = :id ORDER BY id DESC');
$query->bindValue(':id', $id);
$query->execute();
$last_oeuvre = $query->fetch();


$title = $artist['FirstName'] . ' ' . $artist['LastName'];

require_once __DIR__ . '/partials/header.php';

?>

<div class="container mt-4 container_index">
    <div class="row">
        <div class="col-6">
            <h1> <?= $artist['FirstName'] . ' ' . $artist['LastName']; ?></h1>
            <div class='mt-4 div_biographie' id='div_biographie'>
                <h4>Biographie</h4>
                <p>
                    <?= $artist['FrDescription'] ?>
                </p>
            </div>
            <button onclick="hideText()" id="btn_biographie" class="btn back-orange">Voir plus</button>
        </div>

        <div class="col-5 card shadow m-4 p-2 bg-secondary text-light container_index">
            <h4 class='m-4 text-center'>Dernière oeuvre</h4>
            <img src="uploads/oeuvres/<?= $last_oeuvre['ImageUrl']; ?>" class="card-img-top" alt="">
            <h5 class="text-center m-4"><?= $last_oeuvre['Name']; ?></h5>
            <div class='row'>
                <div class='col-6 text-center'>
                    <p>A partir de : </p>
                </div>
                <div class="col-6 text-center">
                    <p> <?= $last_oeuvre['Price']; ?> €</p>
                </div>
            </div>
            <div class='row'>
                <div class='col-6 text-center'>
                    <p>Stock : </p>
                </div>
                <div class="col-6 text-center">
                    <p> <?= $last_oeuvre['Stock']; ?></p>
                </div>
            </div>
            <div>
                <p> <?= $last_oeuvre['FrDescription'] ?></p>
            </div>
            <div class="text-center">

                <a href="./achat.php?article_id=<?=$last_oeuvre['id']; ?>" class="btn back-orange">Acheter</a>

            </div>
        </div>
    </div>

    <div class="row">
        <h4 class='m-4 text-center'>Oeuvres </h4>
        <?php foreach ($oeuvres as $oeuvre) { ?>

            <div class="col-3 card shadow m-4 p-2 bg-secondary text-light">
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
                <div class="text-center">

                    <a href="./achat.php?article_id=<?=$oeuvre['id']; ?>" class="btn back-orange">Acheter</a>

                </div>
            </div>

        <?php } ?>







    </div>




</div>

<script>
    function hideText() {

        if (document.getElementById('div_biographie').style.overflowY == "hidden") {
            document.getElementById('div_biographie').style.overflowY = "";
            document.getElementById('div_biographie').style.height = "auto";
            document.getElementById('btn_biographie').innerHTML = "Voir moins";

        } else {
            document.getElementById('div_biographie').style.overflowY = "hidden";
            document.getElementById('div_biographie').style.height = "400px";
            document.getElementById('btn_biographie').innerHTML = "Voir plus";
        }
    }
</script>












<?php
require_once __DIR__ . '/partials/footer.php';
exit;
?>