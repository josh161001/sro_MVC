<div class="contenedor-app">
        <div class="imagen" >

        </div>
        <div class="contenedor-app contenido">  

            <h1 class="nombre-pagina">Crear Cuenta</h1>
            <p class="descripcion-pagina">Llena el siguiente formulario con tus datos</p>
            <?php     
            include_once __DIR__ . "/../templates/alertas.php"
            ?>
                <form class ="formulario" method = "POST" action = "/crear">
                    <div class="campo">
                        <input  type="text" id ="nombre" placeholder ="Tu nombre" name="nombre" value = "<?php echo s($usuario->nombre); ?>">
                        <input  type="text" id ="apellido" placeholder ="Tu apellido" name="apellido" value = "<?php echo s($usuario->apellido); ?>">
                    </div>

                        <div class="campo">
                            <input  type="tel" id ="telefono" placeholder ="Tu teléfono" name="telefono" value = "<?php echo s($usuario->telefono); ?>">
                        </div>
                        <div class="campo">
                            <input  type="email" id ="email" placeholder ="Tu email" name="email" value = "<?php echo s($usuario->email); ?>">
                        </div>
                        <div class="campo">
                            <input  type="password" id ="password" placeholder ="Tu password" name="password" value = "<?php echo s($usuario->password); ?>">
                        </div>
                        <div class ="center">
                            <input type="submit" class = "boton" value ="Crear Cuenta">

                        </div>
                </form>

                    <div class="acciones separacion2 juntar">
                        <a href="/">¿Ya tienes cuenta?<span> Iniciar Sesión</span></a>
                        <a href="/olvide">¿Olvidaste tu contraseña?</a>
                    </div>

        </div>