<?php

ob_start();

$id = $_GET['article_id'] ?? 0;

require_once 'config/database.php';

if ($id == 0) {
    header('Location:partials/404.php');
}

global $db;
$query = $db->prepare('SELECT * FROM Articles WHERE id = :id');
$query->bindValue(':id', $id);
$query->execute();
$article = $query->fetch();

$title = $article['Name'];

require __DIR__ . '/partials/header.php';

if (!isset($_SESSION['user'])) {
    header('Location:login.php?achat_connexion');
}
if (!$article) {
    require 'partials/404.php';
}

$query = $db->prepare('SELECT * FROM user WHERE id = :id ');
$query->bindValue(':id', $article['User_id']);
$query->execute();
$artist = $query->fetch();

$query = $db->prepare('SELECT * FROM themes WHERE id = :id ');
$query->bindValue(':id', $article['Themes_id']);
$query->execute();
$theme = $query->fetch();

$formats = $_POST['taille'] ?? '';
$finishes = $_POST['finition_autre'] ?? '';
$frames = $_POST['finition_cadre'] ?? '';

$errors = [];

if (!empty($_POST)) {

    if ($formats === 'grand') {
        $prix_format = 2;
    } elseif ($formats === 'géant') {
        $prix_format = 4;
    } elseif ($formats === 'collector') {
        $prix_format = 10;
    } elseif ($formats === 'classique') {
        $prix_format = 1;
    }

    if ($finishes === 'support aluminium') {
        $prix_finition = 1.6;
    } elseif ($finishes === 'support aluminium verre') {
        $prix_finition = 2.35;
    } elseif ($finishes === 'support papier photo' || $finishes === 'support passe partout noir') {
        $prix_finition = 0;
    } elseif ($finishes === 'support passe partout blanc') {
        $prix_finition = 0.4;
    }

    if ($frames === 'sans encadrement' || $frames === 'aluminium noir' || $frames === 'aluminium blanc' || $frames === 'acajou mat' || $frames === 'bois blanc') {
        $prix_cadre = 0;
    } elseif ($frames === 'encadrement noir satin' || $frames === 'encadrement chêne' || $frames === 'encadrement blanc satin' || $frames === 'encadrement noyer') {
        $prix_cadre = 0.45;
    }


    if ($formats === '') {
        $errors['formats'] = "Vous n'avez pas séléctionné de format";
    }

    if ($finishes === "") {
        $errors['finishes'] = "Vous n'avez pas séléctionné de finishes";
    }

    if ($frames === "") {
        $errors['frames'] = "Vous n'avez pas séléctionné de frames";
    }

    if($formats != "" && $finishes != "" && $frames != ""){
        $prix = ($article['Price']*$prix_format) + ($article['Price']*$prix_finition) + ($article['Price']*$prix_cadre);
        var_dump($prix); 
        var_dump($prix_format); 
        var_dump($prix_finition); 
        var_dump($prix_cadre); 
    }
    
    if (!empty($_POST) && isset($_POST['panier'])) {
        
        
        if (empty($errors)) {
            if (checkPanier($article, $prix)) {
                updatePanier($article, $prix);
            } else {
                addToPanier($article, $prix);
            }
            
            header('Location: panier.php');
        }
    }
    
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
                    <form action="" method="POST" name="panier">


                        <div class="row text-center" id="taille_depart">
                            <h4 class="my-4">Selectionner une taille : </h4>

                            <div class="col-3">
                                <label>
                                    <input type="radio" name="taille" id="format_classique" value="classique">
                                    <img class="icon_achat" src="./uploads/images/photo.svg" alt="" style="height: 1.5rem;">
                                    <p>classique</p>
                                </label>
                            </div>

                            <div class="col-3">
                                <label>
                                    <input type="radio" name="taille" id="format_grand" value="grand">
                                    <img class="icon_achat" src="./uploads/images/photo.svg" alt="" style="height: 2.25rem; ">
                                    <p>Grand</p>
                                </label>
                            </div>

                            <div class="col-3">
                                <label>
                                    <input type="radio" name="taille" id="format_géant" value="géant">
                                    <img class="icon_achat" src="./uploads/images/photo.svg" alt="" style="height: 3rem;">
                                    <p>Géant</p>
                                </label>
                            </div>

                            <div class="col-3">
                                <label>
                                    <input type="radio" name="taille" id="format_collector" value="collector">
                                    <img class="icon_achat" src="./uploads/images/photo.svg" alt="" style="height: 3.75rem;">
                                    <p>Collector</p>
                                </label>
                            </div>

                            

                            <div class="text-center">
                                <button type="button" onclick="cache_finition()" class='btn back-orange' name="panier">Suivant</button>
                            </div>

                        </div>
                        <div class="row text-center" id="finition_grand_format">
                            <h4 class="my-4">Selectionner un support : </h4>

                            <div class="col-4">
                                <label>
                                    <input type="radio" name="finition_autre" id="support_aluminium" value="support aluminium">
                                    <img class="icon_achat" src="./uploads/finitions/SUPPORT-ALUMINIUM.jpg" alt="" style="height: 3rem;">
                                    <p>Support Aluminium</p>
                                </label>
                            </div>

                            <div class="col-4">
                                <label>
                                    <input type="radio" name="finition_autre" id="support_aluminium_verre" value="support aluminium verre">
                                    <img class="icon_achat" src="./uploads/finitions/SUPPORT-ALUMINIUM-AVEC-VERRE-ACRYLIQUE.jpg" alt="" style="height: 3rem; ">
                                    <p>Support aluminium avec verre acrylique</p>
                                </label>
                            </div>

                            <div class="col-4">
                                <label>
                                    <input type="radio" name="finition_autre" id="support_papier_photo" value="support papier photo">
                                    <img class="icon_achat" src="./uploads/finitions/PAPIER-PHOTO.jpg" alt="" style="height: 3rem;">
                                    <p>Tirage sur papier photo</p>
                                </label>
                            </div>

                            <div class="text-center">
                                <button type="reset" onclick="back()" class='btn btn-secondary mx-4' name="panier">Retour</button>
                                <button type="button" onclick="cache_cadre()" class='btn back-orange' name="panier">Suivant</button>
                            </div>

                        </div>

                        <div class="row text-center" id="finition_petit_format">
                            <h4 class="my-4">Selectionner un support : </h4>

                            <div class="col-6">
                                <label>
                                    <input type="radio" name="finition_autre" id="support_passe_partout_noir" value="support passe partout noir">
                                    <img class="icon_achat" src="./uploads/finitions/ARTSHOT.jpg" alt="" style="height: 3rem;">
                                    <p>Blackout</p>
                                </label>
                            </div>

                            <div class="col-6">
                                <label>
                                    <input type="radio" name="finition_autre" id="support_passe_partout_blanc" value="support passe partout blanc">
                                    <img class="icon_achat" src="./uploads/finitions/ARTSHOT.jpg" alt="" style="height: 3rem; ">
                                    <p>Artshot</p>
                                </label>
                            </div>

                            <div class="text-center">
                                <button type="reset" onclick="back()" class='btn btn-secondary mx-4' name="panier">Retour</button>
                                <button type="button" onclick="cache_cadre()" class='btn back-orange' name="panier">Suivant</button>
                            </div>

                        </div>

                        <div class="row text-center mx-auto" id="cadre_grand_format">
                            <h4 class="my-4">Selectionner un encadrement : </h4>

                            <div class="col-2" style="margin-left: 3.5rem;">
                                <label>
                                    <input type="radio" name="finition_cadre" id="sans_encadrement" value="sans encadrement">
                                    <img class="icon_achat" src="./uploads/cadres/SANS-ENCADREMENT.jpg" alt="" style="height: 3rem;">
                                    <p>Sans encadrement</p>
                                </label>
                            </div>

                            <div class="col-2">
                                <label>
                                    <input type="radio" name="finition_cadre" id="encadrement_noir_satin" value="encadrement noir satin">
                                    <img class="icon_achat" src="./uploads/cadres/ENCADREMENT-NOIR-SATIN.jpg" alt="" style="height: 3rem; ">
                                    <p>Encadrement noir satin</p>
                                </label>
                            </div>

                            <div class="col-2">
                                <label>
                                    <input type="radio" name="finition_cadre" id="encadrement_blanc_satin" value="encadrement blanc satin">
                                    <img class="icon_achat" src="./uploads/cadres/ENCADREMENT-BLANC-SATIN.jpg" alt="" style="height: 3rem; ">
                                    <p>Encadrement blanc satin</p>
                                </label>
                            </div>

                            <div class="col-2">
                                <label>
                                    <input type="radio" name="finition_cadre" id="encadrement_noyer" value="encadrement noyer">
                                    <img class="icon_achat" src="./uploads/cadres/ENCADREMENT-NOYER.jpg" alt="" style="height: 3rem; ">
                                    <p>Encadrement en noyer</p>
                                </label>
                            </div>

                            <div class="col-2">
                                <label>
                                    <input type="radio" name="finition_cadre" id="encadrement_chêne" value="encadrement chêne">
                                    <img class="icon_achat" src="./uploads/cadres/ENCADREMENT-CHENE.jpg" alt="" style="height: 3rem; ">
                                    <p>Encadrement en chêne</p>
                                </label>
                            </div>

                            <div class="text-center">
                                <button type="reset" onclick="back()" class='btn btn-secondary mx-4'>Retour</button>
                                <button type="button" onclick="recap()" class='btn back-orange'>Récapitulatif de la commande</button>
                            </div>

                        </div>

                        <div class="row text-center" id="cadre_petit_format">
                            <h4 class="my-4">Selectionner un encadrement : </h4>

                            <div class="col-3">
                                <label>
                                    <input type="radio" name="finition_cadre" id="aluminium_noir" value="aluminium noir">
                                    <img class="icon_achat" src="./uploads/cadres/ALUMINIUM-NOIR.jpg" alt="" style="height: 3rem;">
                                    <p>Aluminium noir</p>
                                </label>
                            </div>

                            <div class="col-3">
                                <label>
                                    <input type="radio" name="finition_cadre" id="bois_blanc" value="bois blanc">
                                    <img class="icon_achat" src="./uploads/cadres/BOIS-BLANC.jpg" alt="" style="height: 3rem;">
                                    <p>Bois blanc</p>
                                </label>
                            </div>

                            <div class="col-3">
                                <label>
                                    <input type="radio" name="finition_cadre" id="acajou_mat" value="acajou mat">
                                    <img class="icon_achat" src="./uploads/cadres/ACAJOU-MAT.jpg" alt="" style="height: 3rem;">
                                    <p>Acajou mat</p>
                                </label>
                            </div>

                            <div class="col-3">
                                <label>
                                    <input type="radio" name="finition_cadre" id="aluminium_blanc" value="aluminium blanc">
                                    <img class="icon_achat" src="./uploads/cadres/BOIS-BLANC.jpg" alt="" style="height: 3rem;">
                                    <p>Aluminium blanc</p>
                                </label>
                            </div>

                            <div class="text-center">
                                <button type="reset" onclick="back()" class='btn btn-secondary mx-4' name="panier">Retour</button>
                                <button type="button" onclick="recap()" class='btn back-orange' name="panier">Récapitulatif de la commande</button>
                            </div>

                        </div>

                        <div id="recap">
                            <p id="recap_taille"></p>
                            <p id="recap_finition"></p>
                            <p id="recap_cadre"></p>
                        </div>
                        
                        <div id="button_recap">
                            <button name="panier" class="btn btn-dark btn-outline-warning btn-lg mt-4 " style="display:none; margin:auto ;" id="button_finaliser">Acheter</button>



                        </div>

                        <table class="table my-4 ">
                                <tbody>
                                    <tr>
                                        <td>Classique : 24 x 30 cm</td>
                                        <td>A partir de : <?= $article['Price']; ?> € </td>
                                    </tr>
                                    <tr>
                                        <td>Grand : 60 x 75 cm</td>
                                        <td>A partir de : <?= $article['Price'] * 2; ?> € </td>
                                    </tr>
                                    <tr>
                                        <td>Géant : 100 x 125 cm</td>
                                        <td>A partir de : <?= $article['Price'] * 2 * 2; ?> € </td>
                                    </tr>
                                    <tr>
                                        <td>Collector : 120 x 150 cm</td>
                                        <td>A partir de : <?= $article['Price'] * 2 * 2 * 2.5; ?> € </td>
                                    </tr>
                                </tbody>
                            </table>

                        <table class="table my-4 ">
                            <tbody>
                                <tr>
                                    <td>Stock : <?= $article['Stock']; ?> p </td>
                                    <td>Thème : <a class="text-orange" href="./themes.php?theme_id=<?= $theme['id'] ?>"><?= $theme['FrName'] ?></a></td>
                                </tr>
                                <tr>
                                    <td>Orientation : <?= $article['Orientation']; ?> </td>
                                    <td>Oeuvre de : <a class="text-orange" href="artiste.php?artist_id=<?= $artist['id'] ?>"> <?= $artist['FirstName'] . ' ' . $artist['LastName'] . ' - ' . $artist['Alias']; ?> </a></td>
                                </tr>
                            </tbody>
                        </table>

                        
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require 'partials/footer.php'; ?>