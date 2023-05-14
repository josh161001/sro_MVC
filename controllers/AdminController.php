<?php 
namespace Controllers;

use MVC\Router;

use Model\AdminReservacion;

class AdminController {

    public static function index (Router $router) {

        session_start();
        admin();

        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $fechas = explode('-', $fecha);
        if( !checkdate($fechas[1], $fechas[2], $fechas[0])){
            header('location: /404');
        }

       
        // consultar base de datos
        $consulta = "SELECT reservacion.id, reservacion.hora, CONCAT (usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio, servicios.img as imagen ";
        $consulta .= " FROM reservacion ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON reservacion.usuarioId = usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN reservacionservicios ";
        $consulta .= " ON reservacionservicios.reservacionId = reservacion.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id = reservacionservicios.servicioId ";
        $consulta .= " WHERE fecha =  '${fecha}' "; 

        $reservacion =   AdminReservacion::SQL($consulta);


        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'],
            'reservacion' => $reservacion,
            'fecha' => $fecha
            
        ]);
    }
}