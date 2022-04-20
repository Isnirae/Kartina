<?php 

$title = "Contact" ;

require_once __DIR__.'/partials/header.php'; ?>



<div class="container" id="divContact">
        <h1 class="text-center">Besoin d'aide ?</h1>

        <?php

        $civ = $_POST['civilite'] ?? '';
        $prenom = $_POST['prenom'] ?? '';
        $nom = $_POST['nom'] ?? '';
        $email = $_POST['email'] ?? '';
        $tel = $_POST['tel'] ?? '';
        $sujet = $_POST['sujet'] ?? '';
        $message = $_POST['message'] ?? '';

        // protéger les variables contree les balises html
        $civ = htmlspecialchars($civ);
        $prenom = htmlspecialchars($prenom) ;
        $nom = htmlspecialchars($nom) ;
        $email = htmlspecialchars($email) ;
        $tel = htmlspecialchars($tel) ;
        $sujet = htmlspecialchars($sujet) ;
        $message = htmlspecialchars($message) ;



        $errors = [];
        if (!empty($_POST) && isset($_POST['contact'])) {
            if ($civ == '') {
                $errors['civilite'] = 'Selectionner votre civilité';
            }

            if ($prenom == '') {
                $errors['prenom'] = 'Entrez votre prénom';
            }

            if ($nom == '') {
                $errors['nom'] = 'Entrez votre nom';
            }

            if (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'L\'email n\'est pas valide';
            }

            if ($sujet == '') {
                $errors['sujet'] = 'Selectionner un sujet';
            }

            if (strlen($message) < 10) {
                $errors['message'] = 'Le message est trop court';
            }
        }

        ?>

        <form action="" method="post">
            <div>
                <div class="form-group">

                    <label for="civilite">Civilité*</label>
                    <select name="civilite" id="civilite" class="form-select <?= isset($errors['civilite']) ? 'is-invalid' : ''; ?>">
                        <option value=""></option>
                        <option value="Mr" <?= $civ === 'Mr' ? 'selected' : ''; ?>>Mr</option>
                        <option value="Mme" <?= $civ === 'Mme' ? 'selected' : ''; ?>>Mme</option>
                    </select>
                    <?php if (isset($errors['civilite'])) {
                        echo '<span class="text-danger">' . $errors['civilite'] . '</span>';
                    } ?>

                </div>

                <div class="form-group">

                    <label for="nom">Nom*</label>
                    <input type="text" name="nom" id="nom" pattern="[a-zA-Z]{1,}" class="form-control  <?= isset($errors['nom']) ? 'is-invalid' : ''; ?>" value="<?= $nom; ?>" placeholder="Wilson">
                    <?php if (isset($errors['nom'])) {
                        echo '<span class="text-danger">' . $errors['nom'] . '</span>';
                    } ?>

                </div>


                <div class="form-group">

                    <label for="prenom">Prénom*</label>
                    <input type="text" name="prenom" id="prenom" pattern="[a-zA-Z]{1,}" class="form-control  <?= isset($errors['prenom']) ? 'is-invalid' : ''; ?>" value="<?= $prenom; ?>" placeholder="wade">
                    <?php if (isset($errors['prenom'])) {
                        echo '<span class="text-danger">' . $errors['prenom'] . '</span>';
                    } ?>

                </div>

                <div class="form-group">
                    <label for="email">Email*</label>
                    <input type="email" name="email" id="email" class="form-control  <?= isset($errors['email']) ? 'is-invalid' : ''; ?>" value="<?= $email; ?>" placeholder="MercwithaMouth@mercenary.com">
                    <?php if (isset($errors['email'])) {
                        echo '<span class="text-danger">' . $errors['email'] . '</span>';
                    } ?>

                </div>

                <div class="form-group">
                    <label for="tel">Téléphone</label>
                    <input type="tel" name="tel" id="tel" class="form-control  " value="<?= $tel; ?>">

                </div>

                <div class="form-group">

                    <label for="sujet">Sujet*</label>
                    <select name="sujet" id="sujet" class="form-select <?= isset($errors['sujet']) ? 'is-invalid' : ''; ?>">
                        <option value=""></option>
                        <option value="Aide pour commander" <?= $sujet === 'Aide pour commander' ? 'selected' : ''; ?>>Aide pour commander</option>
                        <option value="Après-vente, échange et retour" <?= $sujet === 'Après-vente, échange et retour' ? 'selected' : ''; ?>>Après-vente, échange et retour</option>
                        <option value="Problème technique" <?= $sujet === 'Problème technique' ? 'selected' : ''; ?>>Problème technique</option>
                        <option value="Autres sujets" <?= $sujet === 'Autres sujets' ? 'selected' : ''; ?>>Autres sujets</option>
                    </select>
                    <?php if (isset($errors['sujet'])) {
                        echo '<span class="text-danger">' . $errors['sujet'] . '</span>';
                    } ?>

                </div>

                <div class="form-group">
                    <label for="message">Message*</label>
                    <textarea name="message" id="message" class="form-control  <?= isset($errors['message']) ? 'is-invalid' : ''; ?>"><?= $message; ?></textarea>
                    <?php if (isset($errors['message'])) {
                        echo '<span class="text-danger">' . $errors['message'] . '</span>';
                    } ?>

                </div>



                <div class="d-grid gap-2 col-6 mx-auto mt-5">

                    <button name="contact" class="btn btn-dark btn-outline-warning">Envoyez</button>
                </div>
                <div>
                    <?php
                    if (!empty($_POST) && empty($errors) && isset($_POST['contact'])) {
                        echo "Bonjour $prenom, votre requête à bien été envoyée avec le message : <p> $message </p>";
                    }
                    ?>
                </div>

            </div>
        </form>

    </div>







<?php 
require_once __DIR__.'/partials/footer.php'; 
exit; 
?>