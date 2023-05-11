<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function ultimo(string $actual, string $proximo) :bool{
     if($actual !== $proximo) {
        return true;
     }
     return false;
}

// funcion para saber si usuario esta autoenticado

function autoenticado() : void {
    
    if (!isset($_SESSION['login'])) {

        header('Location: /');

    }
}

function admin() : void {

    if(!isset($_SESSION['admin'])){
        header('Location: /');
    }
}

