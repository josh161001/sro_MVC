<div class="contenedor-app">
    <div class="imagen" >

    </div> 
        <div class="contenedor-app contenido">
              <h1 class="nombre-pagina">Iniciar Sesión</h1>
              <p class="descripcion-pagina">Inicia sesión con tus datos a continuacion para 
                acceder al sistema </p>
            <?php     
            include_once __DIR__ . "/../templates/alertas.php"
            ?>
                    <form class ="formulario" method = "POST" action = "/">
                       <div class="campo">
                            <input  type="email" id ="email" placeholder ="Tu email" name="email">
                       </div>
                          <div class="campo">
                              <input  type="password" id ="password" placeholder ="Tu password" name="password">
                          </div>
                              <div class="center">
                                  <input type="submit" class = "boton" value ="Iniciar Sesion">
                              </div>
                    </form>
                        <div class="acciones separacion1">  
                         <a href="/crear">¿Aún no tienes cuenta? <span>Crear una</span></a>
                         <a href="/olvide">¿Olvidaste tu contraseña?</a>
                        </div>         
        </div>

       