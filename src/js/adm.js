document.addEventListener("DOMContentLoaded", function () {
  iniciarAdm();
});

function iniciarAdm() {
  mostrarPorFecha();
}

function mostrarPorFecha() {
  const fechaInput = document.querySelector("#fecha");

  fechaInput.addEventListener("input", function (e) {
    const fechaInputSeleccionada = e.target.value;
    console.log(fechaInputSeleccionada);
    window.location = `?fecha=${fechaInputSeleccionada}`;
  });
}
