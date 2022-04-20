<?php 

$scripts = explode('/', $_SERVER['SCRIPT_NAME']);
$page = array_pop($scripts);

if(!isset($title)){
    $title = 'Kartina';

}

