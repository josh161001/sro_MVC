<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;
 

class LoginController {

    public static function login(Router $router) {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
            $auth = new Usuario($_POST);  
            $alertas =  $auth-> validarLogin();

            if (empty($alertas)) {
                // comprobar que exista usuario por email

                $usuario = Usuario::where('email', $auth->email);
                if($usuario){
                      //verificar usuario por password
                    if ($usuario->comprobarPV($auth->password)) {
                        //autentica usuario
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        //redireccionar si es admin o usuario
                        if ($usuario->admin === '1') {
                         $_SESSION['admin'] = $usuario->admin ?? null;
                         header('Location: /admin');
                        }else{
                           header('Location: /reservacion');
                        }
                        // debuguear($_SESSION);
                    }
                }else{
                    Usuario::setAlerta('error', 'Usuario no encontrado');
                }
            }
    }
        $alertas = Usuario::getAlertas();

        $router->render('auth/login', [
            'alertas'=>$alertas
        ]);

    }
    public static function exit() {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }
    public static function olvide(Router $router) {

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();

            
            if (empty($alertas)) {
                $usuario = Usuario::where('email', $auth->email);

                if ($usuario && $usuario->confirmado === '1' ) {
                    //generar token
                     $usuario->crearToken();
                     $usuario->guardar();
                    // debuguear($usuario);

                    //enviar email 
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);

                    $email->enviarCodigo();


                    // alerta de exito
                    Usuario::setAlerta('exito', 'Se envio el codigo correctamente');


              }else{
                Usuario::setAlerta('error', 'El email no existe');

              }
            
            }

        }
        $alertas = Usuario::getAlertas();

        $router->render('auth/olvide', [
            'alertas'=>$alertas
        ]);

    }
    public static function recuperar(Router $router) {

        $alertas = [];
        $error = false;
        $token = s($_GET['token']);

        // buscar usuario por token

        $usuario  = Usuario::where('token', $token);

        if (empty($usuario)) {
                Usuario::setAlerta('error', 'Token no valido');
                $error = true;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
               $password = new Usuario($_POST);
               $alertas = $password->validarPassword();

               if (empty($alertas)) {
                $usuario->password = null;

                $usuario->password = $password->password;

                $usuario->hashPassword();
                $usuario->token = null;
                $resultado = $usuario->guardar();

                if ($resultado) {
                    header('Location: /');
                }
         
               }
         
        }


        // debuguear($usuario);
       $alertas = Usuario::getAlertas();

        $router->render('auth/recuperar', [
            'alertas'=>$alertas,
            'error'=>$error
        ]);
    }
    public static function crear(Router $router) {
        
        $usuario = new Usuario();

        //alertas vacias
        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarCuenta();
            // debuguear($alertas);

            // revisar que este vacio alertas
            if (empty($alertas)) {
                // verificar que el usuario no este registrado
             $resultado = $usuario->usuarioExistente();

                if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                } else {
                    //encriptar password
                    $usuario->hashPassword();
                    //generar token
                    $usuario->crearToken();

                    //enviar email
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);    

                    $email->enviarEmail();
                    // debuguear($usuario);
                    // crear usuario
                    $resultado = $usuario->guardar();
                  
                    if ($resultado) {
                       header('Location: /mensaje');
                    }
                    
                }
            }
        }
       $router->render('auth/crear', [
            'usuario' => $usuario,
            'alertas'=> $alertas
       ]);
       

    }
    public static function mensaje(Router $router) {
        $router->render('auth/mensaje');
    }
    public static function confirmar(Router $router) {

        $alertas = [];

        $token = s($_GET['token']);

       $usuario = Usuario::where('token', $token);

       if (empty($usuario)) {
        //error en confirmar usuario
        Usuario::setAlerta('error', 'Token no valido');
    
       }else{
        $usuario->confirmado = "1";
        $usuario->token = null;
        $usuario->guardar(); 
        Usuario::setAlerta('exito','Token confirmado correctamente');
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmar', [

            'alertas' => $alertas
        ]);
    }
   
}