<?php
ob_start();
$title = "Mon compte";

require_once __DIR__ . '/partials/header.php';

if (!isset($_SESSION['user'])) {
    header('Location:partials/403.php');
}

$id = $_SESSION['user']['id'];

$query = $db->prepare('SELECT * FROM user WHERE id = :id');
$query->bindValue(':id', $id);
$query->execute();
$user = $query->fetch();



if (!empty($_POST['alias'])) {
    $alias = $_POST['alias'];
} else {
    $alias = $user['Alias'];
}

if (!empty($_POST['email'])) {
    $email = $_POST['email'];
} else {
    $email = $user['Email'];
}

if (!empty($_POST['gender'])) {
    $gender = $_POST['gender'];
} else {
    $gender = $user['Gender'];
}

if (!empty($_POST['prenom'])) {
    $prenom = $_POST['prenom'];
} else {
    $prenom = $user['FirstName'];
}

if (!empty($_POST['nom'])) {
    $nom = $_POST['nom'];
} else {
    $nom = $user['LastName'];
}

if (!empty($_POST['BirthDate'])) {
    $BirthDate = $_POST['BirthDate'];
} else {
    $BirthDate = $user['DateOfBirth'];
}

if (!empty($_POST['tel'])) {
    $tel = $_POST['tel'];
} else {
    $tel = $user['PhoneNumber'];
}

if (!empty($_POST['frdescription'])) {
    $frdescription = $_POST['frdescription'];
} else {
    $frdescription = $user['FrDescription'];
}

if (!empty($_POST['endescription'])) {
    $endescription = $_POST['endescription'];
} else {
    $endescription = $user['EnDescription'];
}

if (!empty($_POST['gerdescription'])) {
    $gerdescription = $_POST['gerdescription'];
} else {
    $gerdescription = $user['GerDescription'];
}

if (!empty($_POST['role'])) {
    $role = $_POST['role'];
} else {
    $role = $user['Role'];
}

if (!empty($_POST['twitter'])) {
    $twitter = $_POST['twitter'];
} else {
    $twitter = $user['Twitter'];
}

if (!empty($_POST['facebook'])) {
    $facebook = $_POST['facebook'];
} else {
    $facebook = $user['Facebook'];
}

if (!empty($_POST['website'])) {
    $website = $_POST['website'];
} else {
    $website = $user['WebSite'];
}

if (!empty($_POST['pinterest'])) {
    $pinterest = $_POST['pinterest'];
} else {
    $pinterest = $user['Pinterest'];
}

if (!empty($_POST['emailpro'])) {
    $emailpro = $_POST['emailpro'];
} else {
    $emailpro = $user['ProEmail'];
}


$oldpassword = $_POST['oldpassword'] ?? '';
$password = $_POST['password'] ?? '';
$cf_password = $_POST['cf-password'] ?? '';

$BirthDate2 = strtotime($BirthDate); //Converti la date en timestamp
$BirthDate2 += 7200; //Ajoute 2h pour éviter le décalage horaire.
$MoinsDe18 = (((time() - $BirthDate2) / 3600) / 24) / 365.25; //On enléve 18ans en timestamps pour vérifier si l'utilisateur est majeur
$errors = [];


$alias = htmlspecialchars($alias);
$oldpassword = htmlspecialchars($oldpassword);
$password = htmlspecialchars($password);
$cf_password = htmlspecialchars($cf_password);
$email = htmlspecialchars($email);
$gender = htmlspecialchars($gender);
$nom = htmlspecialchars($nom);
$prenom = htmlspecialchars($prenom);
$BirthDate = htmlspecialchars($BirthDate);
$tel = htmlspecialchars($tel);
$frdescription = htmlspecialchars($frdescription);
$endescription = htmlspecialchars($endescription);
$gerdescription = htmlspecialchars($gerdescription);
$role = htmlspecialchars($role);

$twitter = htmlspecialchars($twitter);
$facebook = htmlspecialchars($facebook);
$website = htmlspecialchars($website);
$pinterest = htmlspecialchars($pinterest);
$emailpro = htmlspecialchars($emailpro);



if (!empty($_POST)) {

    $query = $db->prepare('UPDATE user SET Alias = :alias, Gender = :gender, FirstName = :firstname, LastName = :lastname, DateOfBirth = :birthdate, PhoneNumber = :tel, FrDescription = :frdescription, EnDescription = :endescription, GerDescription = :gerdescription, Role = :role, Twitter = :twitter, Facebook = :facebook, Website = :website, Pinterest = :pinterest, Proemail = :emailpro WHERE id = :id');
    $query->bindValue(':alias', $alias);
    $query->bindValue(':gender', $gender);
    $query->bindValue(':firstname', $prenom);
    $query->bindValue(':lastname', $nom);
    $query->bindValue(':birthdate', $BirthDate);
    $query->bindValue(':tel', $tel);
    $query->bindValue(':frdescription', $frdescription);
    $query->bindValue(':endescription', $endescription);
    $query->bindValue(':gerdescription', $gerdescription);
    $query->bindValue(':role', $role);
    $query->bindValue(':twitter', $twitter);
    $query->bindValue(':facebook', $facebook);
    $query->bindValue(':website', $website);
    $query->bindValue(':pinterest', $pinterest);
    $query->bindValue(':emailpro', $emailpro);
    $query->bindValue(':id', $id);
    $query->execute();
}


?>





<div class="container">
    <h1 class="text-center">Modifier vos informations personnelles</h1>
    <form method="post">

        <div>
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control <?= isset($errors['nom']) ? 'is-invalid' : ''; ?>">
        </div>
        <?php if (isset($errors['nom'])) {
            echo '<div class="text-danger">' . $errors['nom'] . '</div>';
        } ?>

        <div class="mt-3">
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" class="form-control <?= isset($errors['prenom']) ? 'is-invalid' : ''; ?>">
        </div>
        <?php if (isset($errors['prenom'])) {
            echo '<div class="text-danger">' . $errors['prenom'] . '</div>';
        } ?>

        <div class="mt-3">
            <label for="alias">Pseudo</label>
            <input type="text" name="alias" id="alias" class="form-control <?= isset($errors['alias']) ? 'is-invalid' : ''; ?>">
        </div>
        <?php if (isset($errors['alias'])) {
            echo '<div class="text-danger">' . $errors['alias'] . '</div>';
        } ?>

        <div class="mt-3">
            <label for="gender">Civilité</label>
            <select name="gender" id="gender" class="form-select <?= isset($errors['gender']) ? 'is-invalid' : ''; ?>">
                <option value=""></option>
                <option value="Mr">Mr</option>
                <option value="Mme">Mme</option>
            </select>
        </div>
        <?php if (isset($errors['gender'])) {
            echo '<div class="text-danger">' . $errors['gender'] . '</div>';
        } ?>

        <div class="mt-3">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : ''; ?>">
        </div>
        <?php if (isset($errors['email'])) {
            echo '<div class="text-danger">' . $errors['email'] . '</div>';
        } ?>


        <div class="mt-3">
            <label for="oldpassword">Ancien mot de passe</label>
            <input type="password" name="oldpassword" id="oldpassword" class="form-control <?= isset($errors['oldpassword']) ? 'is-invalid' : ''; ?>">
        </div>
        <?php if (isset($errors['password'])) {
            echo '<div class="text-danger">' . $errors['password'] . '</div>';
        } ?>

        <div class="mt-3">
            <label for="password">Nouveau mot de passe</label>
            <input type="password" name="password" id="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : ''; ?>">
        </div>
        <?php if (isset($errors['password'])) {
            echo '<div class="text-danger">' . $errors['password'] . '</div>';
        } ?>

        <div class="mt-3">
            <label for="cf-password">Confirmer le mot de passe</label>
            <input type="password" name="cf-password" id="cf-password" class="form-control <?= isset($errors['passwords']) ? 'is-invalid' : ''; ?>">
        </div>
        <?php if (isset($errors['passwords'])) {
            echo '<div class="text-danger">' . $errors['passwords'] . '</div>';
        } ?>

        <div class="mt-3">
            <label for="tel">N° de téléphone</label>
            <input type="text" name="tel" id="tel" class="form-control">
        </div>


        <div class="mt-3">
            <label for="BirthDate">Date de naissance</label>
            <input type="date" max="2010-01-01" name="BirthDate" id="BirthDate" class="form-control <?= isset($errors['BirthDate']) ? 'is-invalid' : ''; ?>">
        </div>
        <?php if (isset($errors['BirthDate'])) {
            echo '<div class="text-danger">' . $errors['BirthDate'] . '</div>';
        } ?>


        <div class="mt-3">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-select <?= isset($errors['role']) ? 'is-invalid' : ''; ?>">
                <option value="user">Client</option>
                <option value="artist">Artiste</option>
            </select>
        </div>
        <?php if (isset($errors['role'])) {
            echo '<div class="text-danger">' . $errors['role'] . '</div>';
        } ?>




        <?php if (isArtist()) { ?>



            <div class="mt-3">
                <label for="frdescription">Description en français</label>
                <textarea name="frdescription" id="frdescription" cols="30" rows="5" class="form-control"></textarea>
            </div>


            <div class="mt-3">
                <label for="endescription">Description en anglais</label>
                <textarea name="endescription" id="endescription" cols="30" rows="5" class="form-control"></textarea>
            </div>


            <div class="mt-3">
                <label for="gerdescription">Description en allemand</label>
                <textarea name="gerdescription" id="gerdescription" cols="30" rows="5" class="form-control"></textarea>
            </div>


            <div class="mt-3">
                <label for="twitter">Twitter</label>
                <input type="url" name="twitter" id="twitter" class="form-control">
            </div>


            <div class="mt-3">
                <label for="facebook">Facebook</label>
                <input type="url" name="facebook" id="facebook" class="form-control">
            </div>


            <div class="mt-3">
                <label for="pinterest">Pinterest</label>
                <input type="url" name="pinterest" id="pinterest" class="form-control">
            </div>


            <div class="mt-3">
                <label for="website">Site personnel</label>
                <input type="url" name="website" id="website" class="form-control">
            </div>


            <div class="mt-3">
                <label for="emailpro">Email professionnel</label>
                <input type="text" name="emailpro" id="emailpro" class="form-control <?= isset($errors['emailpro']) ? 'is-invalid' : ''; ?>">
            </div>
            <?php if (isset($errors['emailpro'])) {
                echo '<div class="text-danger">' . $errors['emailpro'] . '</div>';
            } ?>


        <?php } ?>
        <button class="btn btn-dark btn-outline-warning btn-lg mt-4 " style="display:block; margin:auto ;">Modifier</button>

</div>
</form>









<?php
require_once __DIR__ . '/partials/footer.php';
exit;
?>