<?php

$title = "Nouveautés";

require_once __DIR__ . '/partials/header.php';

$query = $db->prepare('SELECT * FROM articles ORDER BY id DESC LIMIT 8');
$query->execute();
$last_oeuvres = $query->fetchAll();

?>

<div class="container_index mx-5 my-5">
    <h1 class="text-center mb-5">Nouveautés</h1>

    <div class="row">

        <?php foreach ($last_oeuvres as $last) { ?>
            <?php
            $query = $db->prepare('SELECT * FROM user WHERE id = :id ');
            $query->bindValue(':id', $last['User_id']);
            $query->execute();
            $User = $query->fetch();

            $query = $db->prepare('SELECT * FROM user WHERE id = :id ');
            $query->bindValue(':id', $last['User_id']);
            $query->execute();
            $artist = $query->fetch();

            $query = $db->prepare('SELECT * FROM themes WHERE id = :id ');
            $query->bindValue(':id', $last['Themes_id']);
            $query->execute();
            $theme = $query->fetch();
            ?>
            <div class="col-3">
                <div class="card shadow mb-4">
                    <img class="card-img-top" src="uploads/oeuvres/<?= $last['ImageUrl']; ?>" />
                    <div class="card-body">

                        <h3 class="card-title"><?= $last['Name']; ?></h3>
                        
                        <table class="table my-4 ">
                            <tbody>
                                <tr>
                                    <td class="card-text">Edition limitée</td>
                                    <td class="card-text">Créer en <?= substr($last['Date'], 0, 4); ?></td>
                                </tr>
                                <tr>
                                    <td>A partir de <?= $last['Price']; ?> €</td>
                                    <td>Thème : <a class="text-orange" href="./themes.php?theme_id=<?= $theme['id'] ?>"><?= $theme['FrName'] ?></a></td>
                                </tr>
                                <tr>
                                    <td>Orientation : <?= $last['Orientation']; ?> </td>
                                    <td>Oeuvre de : <a class="text-orange" href="artiste.php?artist_id=<?= $artist['id'] ?>"> <?= $artist['FirstName'] . ' ' . $artist['LastName'] . ' - ' . $artist['Alias']; ?> </a></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="d-grid">
                            <a href="./article.php?id=<?= $last['id']; ?>" class="btn btn-warning">Voir l'oeuvre</a>
                        </div>

                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>

<?php
require_once __DIR__ . '/partials/footer.php';
exit;
?>