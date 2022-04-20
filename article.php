<?php

ob_start();

$id = $_GET['id'] ?? 0;

require_once 'config/database.php';

if ($id == 0) {
    header('Location:partials/404.php');
}

global $db;
$query = $db->prepare('SELECT * FROM articles WHERE id = :id');
$query->bindValue(':id', $id);
$query->execute();
$article = $query->fetch();

$title = $article['Name'];

require __DIR__ . '/partials/header.php';


$query = $db->prepare('SELECT * FROM user WHERE id = :id ');
$query->bindValue(':id', $article['User_id']);
$query->execute();
$artist = $query->fetch();

$query = $db->prepare('SELECT * FROM themes WHERE id = :id ');
$query->bindValue(':id', $article['Themes_id']);
$query->execute();
$theme = $query->fetch();


if (!$article) {
    require 'partials/404.php';
}
?>

<div class="container my-4">
    <div class="row">
        <div class="col-lg-5">
            <img class="img-fluid" src="uploads/oeuvres/<?= $article['ImageUrl']; ?>" />
        </div>
        <div class="col-lg-7">
            <div class="card shadow">
                <div class="card-body">
                    <h1><?= $article['Name']; ?></h1>
                    <p class="card-text mt-4"><?= $article['FrDescription']; ?> </p>

                    <table class="table mt-4 ">
                        <tbody>
                            <tr>
                                <td>A partir de : <?= $article['Price']; ?> € </td>
                                <td>Stock : <?= $article['Stock']; ?> p </td>
                            </tr>
                            <tr>
                                <td>Thème : <a class="text-orange" href="./themes.php?theme_id=<?=$theme['id'] ?>"><?= $theme['FrName'] ?></a></td>
                                <td>Orientation : <?= $article['Orientation']; ?> </td>
                            </tr>
                            <tr>
                                <td>Oeuvre de : <a class="text-orange" href="artiste.php?artist_id=<?= $artist['id'] ?>"> <?= $artist['FirstName'] . ' ' . $artist['LastName']; ?> </a></td>
                            </tr>
                        </tbody>
                    </table>


                    <div class="text-center">
                        <a href="./achat.php?article_id=<?=$article['id']; ?>" class='btn back-orange'>Acheter</a>
                    </div>


                </div>
            </div>


        </div>
    </div>
</div>

<?php require 'partials/footer.php'; ?>