<div class="contenedor-app">
    <div class="imagen" >

    </div> 
        <div class="contenedor-app contenido">
              <h1 class="nombre-pagina">Recuperar Password</h1>
              <p class="descripcion-pagina">Ingresa tu nueva password a continuación e ingresa de nuevo <br>
              con nosotros
              </p>
            <?php     
            include_once __DIR__ . "/../templates/alertas.php"
            ?>
            <?php 
                if ($error) return; {
                    
                }
            ?>  
                    <form class ="formulario" method = "POST" >
                      
                          <div class="campo">
                              <input  type="password" id ="password" placeholder ="Tu nueva password" name="password">
                          </div>
                              <div class="center">
                                  <input type="submit" class = "boton" value ="Reestablecer password">
                              </div>
                    </form>
                        <div class="acciones separacion1" style = "padding-top: 60px">  
                        <a href="/">¿Ya tienes cuenta?<span> Iniciar Sesión</span></a>
                         <a href="/crear">¿Aún no tienes cuenta? <span>Crear una</span></a>
                        </div>         
        </div>

       