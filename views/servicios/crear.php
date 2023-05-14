<section class="col-2">
<div class="colmn1">
    <?php if(isset($_SESSION['admin'])) { ?>
    <nav class="navegacion">
        <div class="perfil">
            <div class="perfil-datos">
                <?php echo "<h1>Bienvenido <br>$nombre</h1>" ?>
                <p>Verifica reservaciones, servicios y añade mas</p>
            </div>
            <ul>
                <li>
                    <i class="fi fi-rs-search-alt"></i>
                    <a class="boton actual" href="/admin">Reservaciones</a>
                </li>
                <li>
                    <i class="fi fi-rs-user-time"></i>
                    <a class="boton" href="/servicios">Servicios</a>
                </li>
                <li>
                    <i class="fi fi-rs-user-time"></i>
                    <a class="boton" href="/servicios/crear">Nuevo Servicio</a>
                </li>
                <li>
                    <i class="fi fi-rr-exit"></i>
                    <a class="boton" href="/exit">Cerrar Sesion</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php } ?>  
</div>
<div class="colmn2">
<h1>Crear Servicio</h1>
<p>Crear nuevo servicios</p>
<h2>Ingresa los siguientes datos de tu servicio</h2>

<form action="/servicios/crear" method="POST" class="formulario">
<?php include_once __DIR__ . '/formulario.php'?>
<?php  include_once __DIR__ . '/../templates/alertas.php';?>
<input type="submit" class="boton" value="Crear Servicio">


</div>
 
    


</form>
</div>
</section>