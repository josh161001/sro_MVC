<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use Controllers\ReservaController;
use Controllers\APIController;
use Controllers\AdminController;
use Controllers\ServicioController;

use MVC\Router;

$router = new Router();

//inicio de sesion
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);

//cerrar sesion
$router->get('/exit', [LoginController::class, 'exit']);

//recuperar password
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);

//crear cuenta
$router->get('/crear', [LoginController::class, 'crear']);
$router->post('/crear', [LoginController::class, 'crear']);

// confirmar cuenta
$router->get('/confirmar', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

//area de reservacion
$router->get('/reservacion', [ReservaController::class, 'index']);
$router->get('/admin', [AdminController::class, 'index']);


//API  de reservacion
$router-> get('/api/servicios', [APIController::class, 'index']);
$router-> post('/api/reservaciones', [APIController::class, 'guardar']);
$router-> post('/api/eliminar', [APIController::class, 'eliminar']);

// CRUD servicios
$router->get('/servicios', [ServicioController::class, 'index']);
$router->get('/servicios/crear', [ServicioController::class, 'crear']);
$router->post('/servicios/crear', [ServicioController::class, 'crear']);
$router->get('/servicios/actualizar', [ServicioController::class, 'actualizar']);
$router->post('/servicios/actualizar', [ServicioController::class, 'actualizar']);
$router->post('/servicios/eliminar', [ServicioController::class, 'eliminar']);


// Comprueba y valida las rutas, asigna las funciones del Controlador
$router->comprobarRutas();