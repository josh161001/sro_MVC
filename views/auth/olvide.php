<div class="contenedor-app">
        <div class="imagen" >

        </div>

        <div class="contenedor-app contenido">
        <h1 class="nombre-pagina">Recuperar Cuenta</h1>
            <p class="descripcion-pagina">Para reestablacer tu contraseña 
                escribe tu email a continuación</p>
            <?php     
            include_once __DIR__ . "/../templates/alertas.php"
            ?>
            <form class ="formulario" method = "POST" action = "/olvide">

                <div class="campo">
                     <input  type="email" id ="email" placeholder ="Tu email" name="email">
                </div>
                 <div class="center">
                     <input type="submit" class = "boton" value ="Enviar código ">
                </div>

            </form>

            <div class="acciones separacion3 ">
                 <a href="/">¿Ya tienes cuenta? <span>Iniciar Sesión</span></a>
                 <a href="/crear">¿Aún no tienes cuenta? <span>Crear una</span></a>
            </div>


        </div>
         
</div>

            