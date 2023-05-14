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
<h1>Panel de Administracion</h1>
<p>Consulta tus servicios</p>
<h2>Administracion de servicios</h2>

<div class="listado-servicios">

<?php 
  foreach($servicios as $servicio ){ ?>

<div class="servicio">
<img src="<?php echo $servicio->img;?>" alt="">
        <p>Nombre: <span class="hola"><?php echo $servicio->nombre;?></span></p>
        <p>Precio: <span class="hola">$<?php echo $servicio->precio;?></span></p>

        <div >
        <a class="boton2" href="/servicios/actualizar?id=<?php
         echo $servicio->id; ?>">Actualizar Servicio</a>
         <form action="/servicios/eliminar"  method="POST">
         <input type="hidden" name="id" value="<?php
          echo $servicio->id;?>">
          <input type="submit" value="Eliminar" class="boton2">
         </form>      
        </div>
</div>

 <?php }?>
</div>

</div>
</section>