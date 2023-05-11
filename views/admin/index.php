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
                        <a class="boton" href="/servicios/crear" >Nuevo Servicio</a>
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
        <h1>Panel de Administracion</h1>
        <p>Consulta a tus clientes en este Panel</p>
        <h2>Buscar Reservacion</h2>
        <div id="busqueda">
            <form class="formulario">
                <div class="campo center">
                    <input type="date" id="fecha" name="fecha"
                    value="<?php echo $fecha ?>">
                </div>
            </form>
        </div>
        <?php 
        if (count($reservacion) === 0) {
            echo '<h1>No hay reservaciones pendientes</h1>';
        }?>
        <div class="reservacion-admin">
            <ul class="reservacion">
                <?php 
                foreach ($reservacion as $key => $reserva) {
                    if ($idReserva !== $reserva->id) {
                        $total = 0;
                        $idReserva = $reserva->id;
                ?>
                <li>
                    <h3>Informacion del cliente</h3>
                    <p>Id: <span> <?php echo $reserva->id; ?></span></p>
                    <p>Cliente: <span> <?php echo $reserva->cliente; ?></span></p>
                    <p>Email: <span> <?php echo $reserva->email; ?></span></p>
                    <p>Telefono: <span> <?php echo $reserva->telefono; ?></span></p>
                    <p>Hora: <span> <?php echo $reserva->hora; ?></span></p>
                    <h3>Servicios</h3>


                <?php } // fin del if
                            $total += $reserva->precio;                
                ?>
                    
                </li>
                <div class="servicios-li">
                        <img src="<?php echo $reserva->imagen; ?>" alt="servicio">
                        <p>Servicio: <span> <?php echo $reserva->servicio; ?></span></p>
                        <p>Precio: <span> $<?php echo $reserva->precio; ?></span></p>
                    </div>
            
                <?php 

                    $actual = $reserva->id;
                    $proximo = $reservacion[$key + 1]->id ?? 0;

                    if (ultimo($actual, $proximo)) { ?>
                        <p class="total">total: <span>$<?php echo $total ?></span></p>
                     <form action="/api/eliminar" method="POST">
                    <input type="hidden" name="id"
                    value="<?php echo $reserva->id; ?>">
                    <input type="submit" class="boton" value="Eliminar">
                </form>
                   <?php
                    
                    }
                    
                
                ?>

                
                <?php } // fin del foreach ?>
              
            </ul>
        </div>
    </div>
</section>

<?php 
    $script = "
        <script src='build/js/adm.js'></script>
    ";
?>
