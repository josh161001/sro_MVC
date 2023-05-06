<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function comprobarRutas()
    {
        
        // Proteger Rutas...
        session_start();

        // Arreglo de rutas protegidas...
        // $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];

        // $auth = $_SESSION['login'] ?? null;

        $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $fn = $this->getRoutes[$currentUrl] ?? null;
        } else {
            $fn = $this->postRoutes[$currentUrl] ?? null;
        }


        if ( $fn ) {
            // Call user fn va a llamar una función cuando no sabemos cual sera
            call_user_func($fn, $this); // This es para pasar argumentos
        } else {

          echo '<!DOCTYPE html>
          <html lang="en">
          <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;300;400;600&display=swap" rel="stylesheet">
           
            <title>SRO | NOT FOUND</title>

           <style>
         .title-php{
            text-align: center;
            font-family: "Raleway", sans-serif;
            padding-top: 20px;
          }
          a{
            text-decoration: none;
          }
          .boton {
            background-color:  #ff7a01;
            color: white;
            padding: 1rem 5rem;
            font-size: 2rem;
            font-family: "Raleway", sans-serif;
            font-weight: bold;
            border-radius: 0;
          }
          .center{
            text-align: center;
          }
          img{
            width : 25%;
            text-align: center;
          }
          h2{
            padding-bottom:20px;
            font-size: 30px;
          }
           </style>
          </head>
          <body>
          <h1 class = "title-php">Este contenido no esta disponible en este momento o no existe</h1>
          <div class="center">
          <img src = "https://static.vecteezy.com/system/resources/previews/011/824/059/non_2x/cute-taco-mascot-with-sad-expression-vector.jpg">   
          </div>
          <h2 class = "title-php">404 Pagina no encontrada</h2>
            <div class="center">
            <a href="/" class="boton">Ir a la seccion de inicio de sesion</a>
              </div>
            </body>
          </html>
          ';
        }
    }

    public function render($view, $datos = [])
    {

        // Leer lo que le pasamos  a la vista
        foreach ($datos as $key => $value) {
            $$key = $value;  // Doble signo de dolar significa: variable variable, básicamente nuestra variable sigue siendo la original, pero al asignarla a otra no la reescribe, mantiene su valor, de esta forma el nombre de la variable se asigna dinamicamente
        }

        ob_start(); // Almacenamiento en memoria durante un momento...

        
        // entonces incluimos la vista en el layout
        include_once __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); // Limpia el Buffer
        include_once __DIR__ . '/views/layout.php';
    }
}
