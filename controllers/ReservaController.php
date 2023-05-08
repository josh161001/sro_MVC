<?php

namespace Controllers;

use MVC\Router;

class ReservaController{
    
    public static function index(Router $router) { 
      
        session_start();
        autoenticado();

        $router->render('reservaciones/index', [
          'nombre'=> $_SESSION['nombre'] ,
          'id'=> $_SESSION['id'],
        ]);
    }
    
}

