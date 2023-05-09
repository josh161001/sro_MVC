
<section class="col-2">
<div class="colmn1">
<nav class="navegacion">
    <div class="perfil">
        <div class="perfil-datos">
        <?php echo " <h1>Bienvenido <br>$nombre</h1>" ?>
        <p>Verifica reservaciones, servicios y añade mas</p>
        </div>
    
    <ul>
        <li>
        <i class="fi fi-rs-search-alt"></i>
        <button class="boton actual"  data-paso="1">Reservaciones</button>
        </li>

       
        <li>
        <i class="fi fi-rr-exit"></i>
        <a  class="boton" href="/exit">Cerrar Sesion</a>
        </li>
    </ul>
</nav>
</div>
    <div class="colmn2">
    <h1 >Panel de Administracion</h1>
    <p>Consulta a tus clientes en este Panel</p>
    <h2>Buscar Reservacion</h2>
   
    <div id="busqueda">

    <form class="formulario">

    <div class="campo center">
    <input  type="date" id="fecha" name="fecha">
    </div>

    </form>
    </div>
    <div class="reservacion-admin">
        <ul class="reservacion">
        <?php
        $idReserva = 0;
            foreach ($reservacion as $reserva) {
                if ($idReserva !== $reserva->id) {
         ?>
         <li>
            <p>Id: <span> <?php echo $reserva->id; ?></span></p>
            <p>Hora: <span> <?php echo $reserva->hora; ?></span></p>
            <p>Cliente: <span> <?php echo $reserva->cliente; ?></span></p>
            <p>Email: <span> <?php echo $reserva->email; ?></span></p>
            <p>Telefono: <span> <?php echo $reserva->telefono; ?></span></p>

            <h3>Servicios</h3>
       
                <?php
            $idReserva = $reserva->id;
            }?>
            <div class="servicios-li">
            <p>Servicios: <span> <?php echo $reserva->servicio; ?></span></p>
            <p>Precio: <span> <?php echo $reserva->precio; ?></span></p>
            <img src="<?php echo $reserva->imagen; ?>" alt="servicio">
            </div>
          
         </li>

         <?php }?>
        </ul>
   
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


