<?php 
ob_start();
$title = "Connexion" ;

require_once __DIR__.'/partials/header.php'; 

if (isset($_GET['achat_connexion'])) { ?>
    <div class="alert alert-success">
        Veuillez vous connecter pour pouvoir passer commande
    </div>
<?php } 

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$errors = [];

if (!empty($_POST)){
    $query= $db->prepare('SELECT * FROM user WHERE email = :email');
    $query->bindValue(':email', $email);
    $query -> execute();

    $user = $query -> fetch(); // Pour récupérer le user qui souhaite se co

    if($user && password_verify($password, $user['Password'])){
        $_SESSION['user'] = $user;
        header('Location: index.php');
    }else {
        $errors['login'] = 'Email ou mot de passe incorrect';
    }

}

?>

<div class="container">
    <h1>Connexion</h1>

    <form method="post">
        <div>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control <?= isset($errors['login']) ? 'is-invalid' : ''; ?>">
        </div>

        <div class="mt-3">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control <?= isset($errors['login']) ? 'is-invalid' : ''; ?>">
        </div>
        <?php if (isset($errors['login'])) {
            echo '<div class="text-danger">' . $errors['login'] . '</div>';
        } ?>

        <button class="btn btn-dark btn-outline-warning btn-lg mt-3 " style="display:block; margin:auto ;">Connexion</button>
    </form>
</div>


<?php 
require_once __DIR__.'/partials/footer.php'; 
exit; 
?>