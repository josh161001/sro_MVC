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

// funcion para saber si usuario esta autoenticado

function autoenticado() : void {
    
    if (!isset($_SESSION['login'])) {

        header('Location: /');

    }
}