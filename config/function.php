<?php

function isAdmin(){
    global $db;
$admins = ['M1593201513@hotmail.fr'];
$user = $_SESSION['user'] ?? false;

if($user){
    $_SESSION['user'] = $db
        ->query('SELECT * FROM user WHERE id ='.$user['id'])
        ->fetch();
        $user = $_SESSION['user'];
    }


    if($user && in_array($user['Email'], $admins)){
        return true;  //L'utilisateur est un admin d'après le tableau plus haut ( $admins )
    }

    if($user && $user['Role'] === 'admin'){

        return true; //L'utilisateur est un admin d'après la BDD
    }

    return false ; // L'utilisateur n'est pas un admin
}


function isArtist(){
    global $db;
$artist = ['t.fourot@laposte.net'];
$user = $_SESSION['user'] ?? false;

if($user){
    $_SESSION['user'] = $db
        ->query('SELECT * FROM user WHERE id ='.$user['id'])
        ->fetch();
        $user = $_SESSION['user'];
    }


    if($user && in_array($user['Email'], $artist)){
        return true;  //L'utilisateur est un admin d'après le tableau plus haut ( $artist )
    }

    if($user && $user['Role'] === 'artist'){
        return true; //L'utilisateur est un artist d'après la BDD
    }

    if (isAdmin()){
        return true; //L'utilisateur est un admin et possède donc aussi les droits des artistes
    }

    return false ; // L'utilisateur n'est pas un artist
}


