<?php 
namespace Controllers;

use Model\Servicio;
use Model\Reservacion;
use Model\ReservacionServicios;

class APIController {

    public static function index () {

       $servicios = Servicio::All();
       echo json_encode($servicios);

    }
    public static function guardar() {
      // almacena la cita
      $reservacion = new Reservacion($_POST);
      $resultado = $reservacion-> guardar();

      $id = $resultado['id'];

      // almacena la cita y servicio
      $idServicios = explode(",", $_POST['servicios']);

      // almacena servicios
      foreach($idServicios as $idServicio) {
        $args = [
            'reservacionId' => $id,
            'servicioId' => $idServicio
        ];
        $reservacionServicios =  new ReservacionServicios($args);
        $reservacionServicios->guardar();
      }
      $respuesta = [
        'resultado' => $resultado
      ];

      echo json_encode($respuesta);
    }

    public static function eliminar() {
      
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
          $id = $_POST['id'];

          $reservacion = Reservacion::find($id);

          $reservacion->eliminar();
          header('Location:' . $_SERVER["HTTP_REFERER"]);
        }
  }

}

