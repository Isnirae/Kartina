<?php

/**
 * Ici, on fait la connexion avec la base de données.
 */

$db = new PDO('mysql:host=localhost;dbname=kartina;charset=UTF8','root','',[
//activer les erreurs SQL ( optionnel)
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    //On récupére les résultat au format associatif
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);