<?php

namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ServicioController {

    // Método para mostrar la página de inicio de LOS SERVICIOS
    public static function index(Router $router) {

            session_start();
            admin();

            $servicios = Servicio::all();

            $router->render('servicios/index', [

                'nombre' => $_SESSION['nombre'],
                'servicios' => $servicios


     ]);
    }

    // Método para procesar la creación de un servicio
    public static function crear(Router $router) {
        session_start();
        admin();

        $servicio = new Servicio;
        $alertas = [];


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();

            if(empty($alertas)){
                $servicio->guardar();
                header('Location: /servicios');
            }
        }
        $router->render('servicios/crear', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    // Método para procesar la actualización de un servicio
    public static function actualizar(Router $router) {
     
        session_start();
        admin();

        if(!is_numeric($_GET['id'])) return;

        $servicio = Servicio::find($_GET['id']);
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $servicio->sincronizar($_POST);

            $alertas = $servicio->validar();

            if(empty($alertas)){
                $servicio->guardar();
                header('Location: /servicios');
            }
        }

        $router->render('servicios/actualizar', [

            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas

        ]);
    }
    public static function eliminar(Router $router){
        session_start();
        admin();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $id = $_POST['id'];
            $servicio = Servicio::find($id);
            $servicio->eliminar();
            header('Location: /servicios');
        }
    }

}
