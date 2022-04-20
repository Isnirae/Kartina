<?php 
ob_start();
$title = "Inscription" ;
require_once __DIR__.'/partials/header.php'; 


$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$cf_password = $_POST['cf-password'] ?? '';
$tel = $_POST['tel'] ?? '';
$biographie = $_POST['biographie'] ?? '';
$nom = $_POST['nom'] ?? '';
$prenom = $_POST['prenom'] ?? '';
$alias = $_POST['alias'] ?? '';
$gender = $_POST['gender'] ?? '';
$BirthDate = $_POST['BirthDate'] ?? '';
$role = $_POST['role'] ?? 'user';
$BirthDate2 = strtotime($BirthDate); //Converti la date en timestamp
$BirthDate2 += 7200 ; //Ajoute 2h pour éviter le décalage horaire.
$MoinsDe18 = (((time() - $BirthDate2)/3600)/24)/365.25 ; //On enléve 18ans en timestamps pour vérifier si l'utilisateur est majeur
$errors = [];


$email = htmlspecialchars($email);
$password = htmlspecialchars($password);
$nom = htmlspecialchars($nom);
$prenom = htmlspecialchars($prenom);
$biographie = htmlspecialchars($biographie);
$tel = htmlspecialchars($tel);

$alias = htmlspecialchars($alias);
$gender = htmlspecialchars($gender);
$role = htmlspecialchars($role);

$cf_password = htmlspecialchars($cf_password);


if (!empty($_POST)) {
    // Vérifier l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'L\'email n\'est pas valide';
    }

    // Le nom doit faire 1 caractère minimum
    if (empty($nom)) {
        $errors['nom'] = 'Entrez votre nom';
    }
    // Le prenom doit faire 1 caractère minimum
    if (empty($prenom)) {
        $errors['prenom'] = 'Entrez votre prénom';
    }
    // Le pseudo doit faire 1 caractère minimum
    if (empty($alias)) {
        $errors['alias'] = 'Entrez votre pseudo';
    }
    // Le genre doit être "Mr" ou "Mme"
    if ($gender != 'Mr' && $gender != 'Mme') {
        $errors['gender'] = 'Entrez votre civilité';
    }
    // Le client doit avoir 18ans
    if ($MoinsDe18 < 18) {
        $errors['BirthDate'] = 'Vous devez avoir plus de 18ans pour vous inscrire';
    }
    // Le mot de passe doit faire 6 caractères minimum
    if (strlen($password) < 6) {
        $errors['password'] = 'Le mot de passe est trop court';
    }
    
    //le role doit étre user ou artist
    if ($role != 'user' && $role != 'artist') {
        $errors['role'] = 'Le role est incorrect';
    }
    
    // Vérifier que l'email est unique
    global $db;
    $query = $db->prepare('SELECT * FROM user WHERE email = :email');
    $query->execute([':email' => $email]);
    $user = $query->fetch();

    if ($user) {
        $errors['email'] = 'L\'email existe déjà';
    }

    // On va vérifier que les 2 mots de passe correspondent
    if ($password !== $cf_password) {
        $errors['passwords'] = 'Les mots de passe ne correspondent pas';
    }


    // Si aucune erreur, on inscrit l'utilisateur
    if (empty($errors)) {
        $query = $db->prepare(
            'INSERT INTO user (Alias, Password, Email, Gender, FirstName, LastName, DateOfBirth, Role) VALUES (:Alias, :Password, :Email, :Gender, :FirstName, :LastName, :DateOfBirth, :Role)'
        );
        $query->bindValue(':Alias', $alias );
        $query->bindValue(':Password', password_hash($password, PASSWORD_DEFAULT));
        $query->bindValue(':Email', $email);
        $query->bindValue(':Gender', $gender);
        $query->bindValue(':FirstName', $prenom); 
        $query->bindValue(':LastName', $nom);
        $query->bindValue(':DateOfBirth', $BirthDate);
        $query->bindValue(':Role', $role);
        $query->execute();

        //Connecter l'utilisateur quans il s'inscrit
        $user = $db->query('SELECT * FROM user WHERE email = "'.$email.'"')->fetch();
        $_SESSION['user'] = $user;


        header('Location: index.php');
    } 
}

?>


<div class="container" >
    <h1 class="text-center mt-4">Inscription</h1>

    <form method="post">
        <div >
            <label for="nom">Nom</label>

            <input type="text" name="nom" id="nom" class="form-control <?= isset($errors['nom']) ? 'is-invalid' : ''; ?>" value="<?=$nom?>">

        </div>
        <?php if (isset($errors['nom'])) {
            echo '<div class="text-danger">' . $errors['nom'] . '</div>';
        } ?>

        <div class="mt-3">
            <label for="prenom">Prénom</label>

            <input type="text" name="prenom" id="prenom" class="form-control <?= isset($errors['prenom']) ? 'is-invalid' : ''; ?>" value="<?=$prenom?>">
        </div>
        <?php if (isset($errors['prenom'])) {
            echo '<div class="text-danger">' . $errors['prenom'] . '</div>';
        } ?>

        <div class="mt-3">
            <label for="alias">Pseudo</label>
            <input type="text" name="alias" id="alias" class="form-control <?= isset($errors['alias']) ? 'is-invalid' : ''; ?>" value="<?=$alias?>">
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

            <input type="text" name="email" id="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : ''; ?>" value="<?= $email ?>">

        </div>
        <?php if (isset($errors['email'])) {
            echo '<div class="text-danger">' . $errors['email'] . '</div>';
        } ?>
        

        <div class="mt-3">
            <label for="password">Mot de passe</label>

            <input type="password" name="password" id="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : ''; ?>" value="<?= $password ?>">

        </div>
        <?php if (isset($errors['password'])) {
            echo '<div class="text-danger">' . $errors['password'] . '</div>';
        } ?>

        <div class="mt-3">
            <label for="cf-password">Confirmer le mot de passe</label>

            <input type="password" name="cf-password" id="cf-password" class="form-control <?= isset($errors['passwords']) ? 'is-invalid' : ''; ?>" value="<?= $cf_password ?>">

        </div>
        <?php if (isset($errors['passwords'])) {
            echo '<div class="text-danger">' . $errors['passwords'] . '</div>';
        } ?>

        <div class="mt-3">
            <label for="tel">N° de téléphone</label>
            <input type="text" name="tel" id="tel" class="form-control" value="<?= $tel ?>">
        </div>


        <div class="mt-3">
            <label for="BirthDate">Date de naissance</label>
            <input type="date" max="2010-01-01" name="BirthDate" id="BirthDate" class="form-control <?= isset($errors['BirthDate']) ? 'is-invalid' : ''; ?>" value="<?= $BirthDate ?>">
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
        

        <button class="btn btn-dark btn-outline-warning btn-lg mt-4 " style="display:block; margin:auto ;">Inscription</button>
    </form>
</div>

<?php 
require_once __DIR__.'/partials/footer.php'; 
exit; 
?>