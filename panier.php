<?php

ob_start();


$title = 'Panier';
require __DIR__ . '/partials/header.php';

// On vide le panier ?
$clear = isset($_GET['clear']) ? true : false;

if ($clear) {
    unset($_SESSION['panier']);

    header('Location: panier.php');
}

?>

<div class="container container_panier">
    <h1>Panier</h1>

    <?php if (empty(panier())) { ?>
        <h2>Votre panier est vide...</h2>
    <?php } ?>

    <?php if (!empty(panier())) { ?>
        <table class="table bg-white">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Dimmension</th>
                    <th>Cadre</th>
                    <th>Finition</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (panier() as $panier) { ?>
                    <tr>
                        <td>
                            <img class="img-fluid img-oeuvre" width="75" src="./uploads/oeuvres/<?= $panier['ImageUrl']; ?>" alt="<?= $panier['Name']; ?>">
                        </td>
                        <td class="align-middle">
                            <a class="text-orange" href="./article.php?id=<?= $panier['id']; ?>">
                                <?= $panier['Name']; ?>
                            </a>
                        </td>
                        <td class="align-middle"> <label>
                                <input type="radio" name="taille" id="format_grand" value="grand">
                                <img class="icon_achat" src="./uploads/images/photo.svg" alt="" style="height: 2.25rem; ">
                                <p><?= $panier['formats']; ?> </p>
                            </label></td>
                        <td class="align-middle">
                            <img class="img-fluid" width="75" src="./uploads/cadres/<?= $panier['frames']; ?>.jpg " alt="<?= $panier['frames']; ?>">
                        </td>
                        <td class="align-middle">
                            <img class="img-fluid" width="75" src="./uploads/finitions/<?= $panier['finishes']; ?>.jpg " alt="<?= $panier['finishes']; ?>">
                        </td>
                        <td class="align-middle"><?= $panier['Quantity']; ?></td>
                        <td class="align-middle"><?= round($panier['prix'], 2, 2) * $panier['Quantity']; ?> €</td>
                    </tr>
                <?php } ?>
                <tr>
                    <td class="align-text-bottom"><a class="btn btn-warning" href="panier.php?clear">Vider le panier</a></td>
                    <td class="align-text-bottom"></td>
                    <td class="align-text-bottom"></td>
                    <td class="align-text-bottom"></td>
                    <td class="align-text-bottom"></td>
                    <td class="align-text-bottom">Prix Total TTC</td>


                    <?php
                    $total = 0;

                    if (count($_SESSION['panier']) == 1) {
                        $total = round($panier['prix'], 2) * $panier['Quantity'];
                    } else {
                        for ($i = 1; $i < count($_SESSION['panier']); $i++) {
                            foreach (panier() as $panier) {
                                $total += round($panier['prix'], 2) * $panier['Quantity'];
                            }
                        }
                    }
                    ?> <td class="align-text-bottom"> <?php echo $total . '€'; ?></td> <?php  ?>
                </tr>
            </tbody>

            </form>
        </table>
    <?php } if (!empty(panier())) { ?>
                <form action="./paiement.php" method="POST">
                <script src="https://checkout.stripe.com/checkout.js" 
                class="stripe-button" 
                data-key="pk_test_51IdclQCkQm4xBprFP5JCxtIgZG3CA3yePFnWrXqUesOwxK4eKQUU1sO3lO29wuUZ9WWhy4FprM4i41Hn2PiY9bWM00gioTrzal" 
                data-amount="<?= $total*100 ?>" 
                data-name="Kartina" 
                data-description="<?php foreach (panier() as $panier) { echo $panier['Name']; ?> / <?php } ?>" 
                data-image="./uploads/images/K.jpg" 
                data-locale="auto" 
                data-currency="eur" 
                data-label="Achat par Carte <?= $total ?>€">
                </script> <?php } ?>
</div>

<?php require __DIR__ . '/partials/footer.php';
if (!empty(panier())) {
$_SESSION['total'] = $total*100;}
