<?php

namespace Controllers;

use MVC\Router;

class ReservaController{
    
    public static function index(Router $router) { 
        session_start();

        $router->render('reservaciones/index', [
          'nombre'=> $_SESSION['nombre'] ,
          'id'=> $_SESSION['id'],
        ]);
    }
    
}

