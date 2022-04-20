<?php 
ob_start();
$title = "Ajout d'une oeuvre" ;
require_once __DIR__.'/partials/header.php'; 


?>




<div class="container " style="height: 1000px;">
    <h1 class="text-center mt-4">Ajouter une oeuvre</h1>

    <form method="post">
        <div class="mb-3">
            <label for="title">Titre</label>
            <input type="text" name="title" id="title" class="form-control">
        </div>

        <div class="mb-3">
            <label for="theme">Choississez un thème</label>
            <select name="theme" id="theme">
                <option value="mode">Mode</option>
                <option value="urban">Urban</option> 
                <option value="noir_et_blanc">Noir et Blanc</option> 
                <option value="nature">Nature</option> 
                <option value="voyage">Voyage</option> 
                <option value="paysage">Paysage</option> 
                <option value="reve_et_creation">Rêve et Création</option> 
                <option value="sport_et_technique">Sport et Technique</option> 
                <option value="celebrites_et_histoire">Célébrités et Histoire</option> 
            </select>
        </div>

        
        <button class="btn btn-dark btn-outline-warning btn-lg mt-4 " style="display:block; margin:auto ;">Inscription</button>
    </form>
</div>

<?php 
require_once __DIR__.'/partials/footer.php'; 
exit; 
?>