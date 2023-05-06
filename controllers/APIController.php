<?php 
namespace Controllers;

use Model\Servicio;

class APIController {

    public static function index () {

       $servicios = Servicio::All();
       echo json_encode($servicios);

    }
}