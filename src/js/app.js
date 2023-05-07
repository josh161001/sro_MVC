let paso = 1;
let primeroPaso = 1;
let ultimoPaso = 3;

const reservacion = {
  id: "",
  nombre: "",
  fecha: "",
  hora: "",
  servicios: [],
};

document.addEventListener("DOMContentLoaded", function () {
  iniciar();
});

function iniciar() {
  // funciones para la pagina
  mostrarPagina(); //muestra y oculta las paginas
  navegador(); //funcion que cambia de paginacion
  botonesPaginas(); // Agrega o quita los botones del paginador
  paginaSiguiente(); //cambia a la pagina siguiente
  paginaAnterior(); // vuelve a la pagina anterior

  // funcion para el backend
  consultarAPI(); //consulta los datos en el php

  idCliente();
  nombreCliente(); //agrega el nombre al objeto
  seleccionarFecha(); //agrega la fecha al objeto
  seleccionarHora(); //agrega la hora al objeto

  mostrarCuentaFinal(); // muestra el resumen final de la cuenta
}
function mostrarPagina() {
  // ocultar la pagina con la clase de mostrar
  const paginasAnteriores = document.querySelector(".mostrar");
  if (paginasAnteriores) {
    paginasAnteriores.classList.remove("mostrar");
  }

  //seleccion pagina con el paso
  const pagina = `#paso-${paso}`;
  const paginas = document.querySelector(pagina);
  paginas.classList.add("mostrar");
}

function navegador() {
  const navegacion = document.querySelectorAll(".navegacion button");

  //   iterar navegacion mediante el paso
  navegacion.forEach((navegar) => {
    navegar.addEventListener("click", function (e) {
      paso = parseInt(e.target.dataset.paso);
      mostrarPagina();

      botonesPaginas();
    });
  });
}

function botonesPaginas() {
  const botonAnterior = document.querySelector("#anterior");
  const botonSiguiente = document.querySelector("#siguiente");

  if (paso === 1) {
    botonAnterior.classList.add("ocultar");
    botonSiguiente.classList.remove("ocultar");
  } else if (paso === 3) {
    botonAnterior.classList.remove("ocultar");
    botonSiguiente.classList.add("ocultar");

    mostrarCuentaFinal();
  } else {
    botonAnterior.classList.remove("ocultar");
    botonSiguiente.classList.remove("ocultar");
  }
  mostrarPagina();
}

function paginaAnterior() {
  const paginaAnterior = document.querySelector("#anterior");
  paginaAnterior.addEventListener("click", function () {
    if (paso <= primeroPaso) return;
    paso--;

    botonesPaginas();
  });
}

function paginaSiguiente() {
  const paginaSiguiente = document.querySelector("#siguiente");
  paginaSiguiente.addEventListener("click", function () {
    if (paso >= ultimoPaso) return;
    paso++;

    botonesPaginas();
  });
}

async function consultarAPI() {
  try {
    const url = "http://localhost:3000/api/servicios";
    const resultado = await fetch(url);
    const servicios = await resultado.json();
    mostrarServicios(servicios);
  } catch (error) {
    console.log("error");
  }
}

function mostrarServicios(servicios) {
  //iteramos cada servicio
  servicios.forEach((servicio) => {
    //destructuramos el servicio
    const { id, nombre, precio, img } = servicio;

    const nombreServicio = document.createElement("P");
    nombreServicio.classList.add("nombre-servicio");
    nombreServicio.textContent = nombre;

    const precioServicio = document.createElement("P");
    precioServicio.classList.add("precio-servicio");
    precioServicio.textContent = `$${precio}`;

    const servicioDIV = document.createElement("DIV");
    servicioDIV.classList.add("servicio");
    servicioDIV.dataset.idServicio = id;

    const imgServicio = document.createElement("IMG");
    imgServicio.classList.add("img-servicio");
    imgServicio.setAttribute("src", img);

    servicioDIV.onclick = function () {
      seleccionarServicio(servicio);
    };

    servicioDIV.appendChild(imgServicio);
    servicioDIV.appendChild(nombreServicio);
    servicioDIV.appendChild(precioServicio);

    // console.log(servicioDIV)

    document.querySelector("#servicios").appendChild(servicioDIV);
  });
}

function seleccionarServicio(servicio) {
  const { id } = servicio;
  const { servicios } = reservacion;
  // identificar al elemento seleccionado
  const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);

  // comprobar si un servicio es seleccionado
  if (servicios.some((seleccionados) => seleccionados.id === id)) {
    // eliminarlo
    reservacion.servicios = servicios.filter(
      (seleccionados) => seleccionados.id !== id
    );
    divServicio.classList.remove("seleccionado");
  } else {
    // agregarlo
    reservacion.servicios = [...servicios, servicio];
    divServicio.classList.add("seleccionado");
  }
}
function idCliente() {
  const id = document.querySelector("#id").value;
  reservacion.id = id;
}
function nombreCliente() {
  const nombre = document.querySelector("#nombre").value;
  reservacion.nombre = nombre;
}

function seleccionarFecha() {
  const inputFecha = document.querySelector("#fecha");

  inputFecha.addEventListener("input", function (e) {
    const dia = new Date(e.target.value).getUTCDay();

    if ([1, 2].includes(dia)) {
      e.target.value = "";
      mostrarAlerta("Lunes y martes no abrimos", "error", ".formulario");
    } else {
      reservacion.fecha = e.target.value;
    }
  });
}

function seleccionarHora() {
  const inputHora = document.querySelector("#hora");
  inputHora.addEventListener("input", function (e) {
    const horaReservacion = e.target.value;
    const hora = horaReservacion.split(":")[0];

    if (hora <= 8 || hora >= 23) {
      e.target.value = "";
      mostrarAlerta(
        "Hora no valida, tiene que ser entre las 9AM y 10PM",
        "error",
        ".formulario"
      );
    } else {
      reservacion.hora = e.target.value;
    }
  });
}

function mostrarCuentaFinal() {
  const cuenta = document.querySelector(".contenido-cuenta");

  // limpiar contenido de cuenta
  while (cuenta.firstChild) {
    cuenta.removeChild(cuenta.firstChild);
  }

  if (
    Object.values(reservacion).includes("") ||
    reservacion.servicios.length === 0
  ) {
    mostrarAlerta(
      "Faltan datos o servicios",
      "error",
      ".contenido-cuenta",
      false
    );
    return;
  }

  const { nombre, fecha, hora, servicios } = reservacion;

  // heading
  const headingServicios = document.createElement("H3");
  headingServicios.textContent = "Total de Servicios";
  cuenta.appendChild(headingServicios);

  servicios.forEach((servicio) => {
    const { nombre, precio, img } = servicio;
    const serviciosCliente = document.createElement("DIV");
    serviciosCliente.classList.add("contenedor-servicio");

    const imagenServicio = document.createElement("IMG");
    imagenServicio.classList.add("img-servicio");
    imagenServicio.setAttribute("src", img);
    const divNombrePrecio = document.createElement("DIV");
    divNombrePrecio.classList.add("contenedor-nombre-precio");
    const textoServicio = document.createElement("P");
    textoServicio.textContent = nombre;

    const preciosServicio = document.createElement("P");
    preciosServicio.innerHTML = `<span>$${precio}</span>`;

    serviciosCliente.appendChild(imagenServicio);
    serviciosCliente.appendChild(textoServicio);
    serviciosCliente.appendChild(preciosServicio);
    cuenta.appendChild(serviciosCliente);
  });

  const headingReservacion = document.createElement("H3");
  headingReservacion.textContent = "Detalles del cliente";
  cuenta.appendChild(headingReservacion);

  // formatear resumen

  const nombreCliente = document.createElement("P");
  nombreCliente.innerHTML = `<span>Nombre: </span>${nombre}`;

  // formatear fecha

  const fechaObj = new Date(fecha);
  const mes = fechaObj.getMonth();
  const dia = fechaObj.getDate() + 2;
  const year = fechaObj.getFullYear();

  const fechaUTC = new Date(Date.UTC(year, mes, dia));

  const opciones = {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
  };

  const fechaFormatter = fechaUTC.toLocaleDateString("es-MX", opciones);

  const fechaCliente = document.createElement("P");
  fechaCliente.innerHTML = `<span>Fecha de reservacion: </span>${fechaFormatter}`;

  const horaCliente = document.createElement("P");
  horaCliente.innerHTML = `<span>Hora de reservacion: </span>${hora} horas`;
  // BOTON PARA ENVIAR LOS DATOS AL BACKEND
  const botonReservar = document.createElement("BUTTON");
  botonReservar.classList.add("boton");
  botonReservar.textContent = "Reservar";
  botonReservar.onclick = reservarReservacion;

  cuenta.appendChild(nombreCliente);
  cuenta.appendChild(fechaCliente);
  cuenta.appendChild(horaCliente);

  cuenta.appendChild(botonReservar);
}

async function reservarReservacion() {
  const { nombre, fecha, hora, servicios } = reservacion;

  const idServicios = servicios.map((servicio) => servicio.id);

  const datos = new FormData();
  datos.append("nombre", nombre);
  datos.append("fecha", fecha);
  datos.append("hora", hora);
  datos.append("servicios", idServicios);

  // pedir peticion a la api
  const url = "http://localhost:3000/api/reservaciones";

  const respuesta = await fetch(url, {
    method: "POST",
    body: datos,
  });

  const resultado = await respuesta.json();

  console.log(resultado);
}
function mostrarAlerta(mensaje, tipo, elemento, desaparece = true) {
  // ya no se genera alerta
  const alertaPrevia = document.querySelector(".alerta");
  if (alertaPrevia) {
    alertaPrevia.remove();
  }

  // crea alerta con js
  const alerta = document.createElement("DIV");
  alerta.textContent = mensaje;
  alerta.classList.add("alerta");
  alerta.classList.add(tipo);

  const formulario = document.querySelector(elemento);
  formulario.appendChild(alerta);

  if (desaparece) {
    setTimeout(() => {
      alerta.remove();
    }, 3000);
  }
  // elimina alerta despues de 3s
}
