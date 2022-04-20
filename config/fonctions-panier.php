<?php
function addTopanier($articles, $prix) {
   $item = [
       'id' => $articles['id'],
       'Name' => $articles['Name'],
       'ImageUrl' => $articles['ImageUrl'],
       'Quantity' => 1,
       'Price' => $articles['Price'],
       'formats' => $_POST['taille'],
       'finishes' => $_POST['finition_autre'],
       'frames' => $_POST['finition_cadre'], 
       'prix' => $prix,
    ];

   $_SESSION['panier'][] = $item;
}



function updatePanier($articles) {
    $indexToUpdate = null;

    foreach (panier() as $index => $panier) {
        if ($articles['Name'] === $panier['Name']) {
            $indexToUpdate = $index;
        }
    }

    $_SESSION['panier'][$indexToUpdate]['Quantity']++;
}


function checkPanier($articles) {
    foreach (panier() as $panier) {
        if ($articles['Name'] === $panier['Name']) {
            return true;
        }
    }

    return false;
}


function panier() {
    return $_SESSION['panier'] ?? [];
}


