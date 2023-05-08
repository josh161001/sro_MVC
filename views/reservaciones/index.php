
<section class="col-2">
<div class="colmn1">
<nav class="navegacion">
    <div class="perfil">
        <div class="perfil-datos">
        <?php echo " <h1>Bienvenido <br>$nombre</h1>" ?>
        <p>Selecciona tus servicios, crea tu reservación y verifica tu resumen</p>
        </div>
    
    <ul>
        <li>
        <i class="fi fi-rs-search-alt"></i>
        <button class="boton actual"  data-paso="1">servicios</button>
        </li>

        <li>
        <i class="fi fi-rs-user-time"></i>
        <button class="boton"  data-paso="2">Reservaciones</button>
        </li>

        <li>
        <i class="fi fi-rr-file-invoice-dollar"></i>
        <button class="boton"  data-paso="3">Cuenta Final</button>
        </li>

        <li>
        <i class="fi fi-rr-exit"></i>
        <a  class="boton" href="/exit">Cerrar Sesion</a>
        </li>
    </ul>
</nav>
</div>
    <div class="colmn2">
    <h1 >Crear Nueva Reservacion</h1>
    <p>Coloca tus datos y detalles de tu reservacion</p>
   
    <div id="app">
    <div id="paso-1" class="seccion">
    <h2>servicios</h2>
    <p>Eligue tus servicios</p>
    <div id="servicios" class="listado-servicios"></div>
    </div>
    <div id="paso-2" class="seccion">
    <h2>Datos y reservacion</h2>
    <p>Coloca tus datos y fecha de tu  reservacion</p>
    <form class="formulario">
    <div class="campo center">
    <input  type="text" id ="nombre" placeholder ="Tu nombre" name="nombre"
    value ="<?php echo $nombre; ?>" disabled>
    </div>
    <div class="campo center">
    <input  type="date" id="fecha"  min="<?php echo date('Y-m-d', strtotime('+1 day'));?>" >
    </div>
    <div class="campo center">
    <input  type="time" id ="hora" >
    </div>
    <input type="hidden" value="<?php echo $id ?>" id="id">
</form>
</div>
<div id="paso-3" class="seccion contenido-cuenta">
<h2>Detalles de tu cuenta</h2>
<p class="salto">Verifica que la informacion este correctamente</p>
</div>
<div class="paginacion">
    <button class="boton" id="anterior">
    &laquo;Anterior</button>
    <button class="boton" id="siguiente">
    Siguiente &raquo;</button>

</div>
</div>
</div>
</section>

<?php 
    $script = "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>

    <script src='build/js/app.js'></script>
    ";
?>


