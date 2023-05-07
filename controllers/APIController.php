<?php 
namespace Controllers;

use Model\Servicio;
use Model\Reservacion;

class APIController {

    public static function index () {

       $servicios = Servicio::All();
       echo json_encode($servicios);

    }
    public static function guardar() {

      $reservacion = new Reservacion($_POST);
      $resultado = $reservacion-> guardar();
      echo json_encode($resultado);
    }

}