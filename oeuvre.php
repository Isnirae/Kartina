<?php


ob_start();

$title = "Oeuvres";
require_once __DIR__ . '/partials/header.php';

if (!isset($_SESSION['user'])) {
    header('Location:partials/403.php');
} else if ($_SESSION['user']['Role'] != 'artist') {
    header('Location:partials/403.php');
}

if (isset($_GET['success'])) { ?>
    <div class="alert alert-success">
        L'oeuvre a bien été ajoutée.
    </div>
<?php }


global $db;

$id = $_SESSION['user']['id'] ?? 0;
$title = $_POST['title'] ?? '';
$theme = $_POST['theme'] ?? '';
$image = $_FILES['image']['name'] ?? '';

$orientation = $_POST['orientation'] ?? '';
$errors = [];

//Tableau qui définit les orientations autorisées
$allowedOrientations = ['portrait', 'paysage', 'carre', 'panoramique'];
//Le tableau suivant défini le type d'image autorisé
$allowedTypes = ['image/jpg', 'image/jpeg'];

$date = date('Y-m-d');
$FrDescription = $_POST['FrDescription'] ?? '';
$EnDescription = $_POST['FrDescription'] ?? '';
$GerDescription = $_POST['FrDescription'] ?? '';
$price = $_POST['price'] ?? 30; //Si le prix n'est pas choisi par l'artiste, il est à 30€ . Ce prix inclus la TVA de 20%
$price = 1.3 * $price; //Prix de base majoré de 30%
$price = round($price, 0, PHP_ROUND_HALF_UP); //Prix majoré arrondi à l'euro supérieur

$FrDescription = htmlspecialchars($FrDescription);
$EnDescription = htmlspecialchars($EnDescription);
$GerDescription = htmlspecialchars($GerDescription);
$title = htmlspecialchars($title);
$theme = htmlspecialchars($theme);
$orientation = htmlspecialchars($orientation);

$themes = $db->query('SELECT * FROM themes')->fetchAll();


if (!empty($_POST)) {
    
    if (strlen($title) < 2) {
        $errors['title'] = 'Le titre est trop court';
    }
    
    if ($theme < 1 || $theme > 9 || !is_numeric($theme)) {
        $errors['theme'] = 'La categorie n\'est pas valide';
    }
    
    if (!in_array($orientation, $allowedOrientations)) {
        $errors['orientaion'] = 'L\'orientaion n\'est pas valide';
    }
    
    if (!is_numeric($price) || $price < 1 || $price > 195) {
        $errors['price'] = 'Le prix de base doit être compris entre 1 et 150€';
    }
    
    
    //Si on envoie une image 
    if (!empty($_FILES['image'])) {
        //S'il n'y a pas d'erreur et que c'est le bon type d'image
        if ($_FILES['image']['error'] === 0 && in_array($_FILES['image']['type'], $allowedTypes)) {

            $file = $_FILES['image']['tmp_name'];

            //On vérifie que le dossier image existe sinon on le crée
            if (!is_dir(__DIR__ . '/uploads/oeuvres')) {
                mkdir(__DIR__ . '/uploads/oeuvres');
            }
            //On récupére le nom du fichier
            $fileName = $_FILES['image']['name'];
            $fileName = uniqid().'-'.$fileName; // On ajoute un id unique
            
            //On déplace le fichier dans le dossier choisi
            move_uploaded_file($file, __DIR__ . '/uploads/oeuvres/' . $fileName);
        } else {
            $errors['image'] = 'Veuillez envoyer un fichier .jpeg ou .jpg';
        }
        
        
        $query = $db->prepare('INSERT INTO articles (Name, ImageUrl, Orientation, Date, FrDescription, EnDescription, GerDescription, Price, Themes_id , User_id) 
                                        VALUES (:Name, :ImageUrl, :Orientation, :Date, :FrDescription, :EnDescription, :GerDescription, :Price, :Themes_id, :User_id)');
        $query->bindValue(':Name', $title);
        $query->bindValue(':ImageUrl', $fileName);
        $query->bindValue(':Orientation', $orientation);
        $query->bindValue(':Date', $date);
        $query->bindValue(':FrDescription', $FrDescription);
        $query->bindValue(':EnDescription', $EnDescription);
        $query->bindValue(':GerDescription', $GerDescription);
        $query->bindValue(':Price', $price);
        $query->bindValue(':Themes_id', $theme);
        $query->bindValue(':User_id', $id);
        $query->execute();
        
        //redirection pour afficher un bandeau de succés de l'upload
        header('Location: oeuvre.php?success');
    }
}


?>


<h1 class="text-center mt-4">Ajouter une oeuvre</h1>
<form method="post" enctype="multipart/form-data">
    <div class="container">

        <label for="title">Titre de l'oeuvre</label>

        <input type="text" name="title" id="title" class="form-control <?= isset($errors['title']) ? 'is-invalid' : ''; ?>">

        <?php if (isset($errors['title'])) {
            echo '<div class="text-danger">' . $errors['title'] . '</div>';
        } ?>



        <label for="theme" class=" mt-3 ">Selectionner le theme de l'oeuvre</label>
        <select name="theme" id="theme" class="form-select <?= isset($errors['theme']) ? 'is-invalid' : ''; ?>">
            <option value=""></option>
            <?php foreach ($themes as $theme) { ?>
                <option value="<?= $theme['id'] ?>"> <?= $theme['FrName'] ?> </option>
            <?php } ?>


        </select>
        <?php if (isset($errors['theme'])) {
            echo '<div class="text-danger">' . $errors['theme'] . '</div>';
        } ?>



        <label for="orientation">Orientation</label>
        <select name="orientation" id="orientaion" class="form-select">
            <option value=""></option>
            <option value="portrait">Portrait</option>
            <option value="paysage">Paysage</option>
            <option value="carre">Carré</option>
            <option value="panoramique">Panoramique</option>
        </select>
        <?php if (isset($errors['orientation'])) {
            echo '<div class="text-danger">' . $errors['orientation'] . '</div>';
        } ?>


        <label for="price">Prix de base</label>
        <input type="number" name="price" id="price" class="form-control">
        <?php if (isset($errors['price'])) {
            echo '<div class="text-danger">' . $errors['price'] . '</div>';
        } ?>


        <label for="FrDescription">Description de l'oeuvre en français</label>
        <textarea name="FrDescription" id="FrDescription" cols="30" rows="5" class="form-control"></textarea>


        <label for="EnDescription">Description de l'oeuvre en Anglais</label>
        <textarea name="EnDescription" id="EnDescription" cols="30" rows="5" class="form-control"></textarea>


        <label for="GerDescription">Description de l'oeuvre en Allemand</label>
        <textarea name="GerDescription" id="GerDescription" cols="30" rows="5" class="form-control"></textarea>

        <label for="image" class="mt-3">Image</label>
        <input type="file" name="image" id="image" class="form-control <?= isset($errors['image']) ? 'is-invalid' : ''; ?>">

        <?php if (isset($errors['image'])) {
            echo '<div class="text-danger">' . $errors['image'] . '</div>';
        } ?>


        <button class="btn btn-warning mt-3">Ajouter</button>

    </div>
</form>






<?php
require_once __DIR__ . '/partials/footer.php';
exit;
?>