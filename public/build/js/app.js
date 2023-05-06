let paso=1,primeroPaso=1,ultimoPaso=3;const reservacion={nombre:"",fecha:"",hora:"",servicios:[]};function iniciar(){mostrarPagina(),navegador(),botonesPaginas(),paginaSiguiente(),paginaAnterior(),consultarAPI(),nombreCliente(),seleccionarFecha(),seleccionarHora(),mostrarCuentaFinal()}function mostrarPagina(){const e=document.querySelector(".mostrar");e&&e.classList.remove("mostrar");const t="#paso-"+paso;document.querySelector(t).classList.add("mostrar")}function navegador(){document.querySelectorAll(".navegacion button").forEach(e=>{e.addEventListener("click",(function(e){paso=parseInt(e.target.dataset.paso),mostrarPagina(),botonesPaginas()}))})}function botonesPaginas(){const e=document.querySelector("#anterior"),t=document.querySelector("#siguiente");1===paso?(e.classList.add("ocultar"),t.classList.remove("ocultar")):3===paso?(e.classList.remove("ocultar"),t.classList.add("ocultar"),mostrarCuentaFinal()):(e.classList.remove("ocultar"),t.classList.remove("ocultar")),mostrarPagina()}function paginaAnterior(){document.querySelector("#anterior").addEventListener("click",(function(){paso<=primeroPaso||(paso--,botonesPaginas())}))}function paginaSiguiente(){document.querySelector("#siguiente").addEventListener("click",(function(){paso>=ultimoPaso||(paso++,botonesPaginas())}))}async function consultarAPI(){try{const e="http://localhost:3000/api/servicios",t=await fetch(e);mostrarServicios(await t.json())}catch(e){console.log("error")}}function mostrarServicios(e){e.forEach(e=>{const{id:t,nombre:n,precio:o,img:a}=e,r=document.createElement("P");r.classList.add("nombre-servicio"),r.textContent=n;const c=document.createElement("P");c.classList.add("precio-servicio"),c.textContent="$"+o;const s=document.createElement("DIV");s.classList.add("servicio"),s.dataset.idServicio=t;const i=document.createElement("IMG");i.classList.add("img-servicio"),i.setAttribute("src",a),s.onclick=function(){seleccionarServicio(e)},s.appendChild(i),s.appendChild(r),s.appendChild(c),document.querySelector("#servicios").appendChild(s)})}function seleccionarServicio(e){const{id:t}=e,{servicios:n}=reservacion,o=document.querySelector(`[data-id-servicio="${t}"]`);n.some(e=>e.id===t)?(reservacion.servicios=n.filter(e=>e.id!==t),o.classList.remove("seleccionado")):(reservacion.servicios=[...n,e],o.classList.add("seleccionado"))}function nombreCliente(){const e=document.querySelector("#nombre").value;reservacion.nombre=e}function seleccionarFecha(){document.querySelector("#fecha").addEventListener("input",(function(e){const t=new Date(e.target.value).getUTCDay();[1,2].includes(t)?(e.target.value="",mostrarAlerta("Lunes y martes no abrimos","error",".formulario")):reservacion.fecha=e.target.value}))}function seleccionarHora(){document.querySelector("#hora").addEventListener("input",(function(e){const t=e.target.value.split(":")[0];t<=8||t>=23?(e.target.value="",mostrarAlerta("Hora no valida, tiene que ser entre las 9AM y 10PM","error",".formulario")):reservacion.hora=e.target.value}))}function mostrarCuentaFinal(){const e=document.querySelector(".contenido-cuenta");for(;e.firstChild;)e.removeChild(e.firstChild);if(Object.values(reservacion).includes("")||0===reservacion.servicios.length)return void mostrarAlerta("Faltan datos o servicios","error",".contenido-cuenta",!1);const{nombre:t,fecha:n,hora:o,servicios:a}=reservacion,r=document.createElement("H3");r.textContent="Total de Servicios",e.appendChild(r),a.forEach(t=>{const{nombre:n,precio:o,img:a}=t,r=document.createElement("DIV");r.classList.add("contenedor-servicio");const c=document.createElement("IMG");c.classList.add("img-servicio"),c.setAttribute("src",a);document.createElement("DIV").classList.add("contenedor-nombre-precio");const s=document.createElement("P");s.textContent=n;const i=document.createElement("P");i.innerHTML=`<span>$${o}</span>`,r.appendChild(c),r.appendChild(s),r.appendChild(i),e.appendChild(r)});const c=document.createElement("H3");c.textContent="Detalles del cliente",e.appendChild(c);const s=document.createElement("P");s.innerHTML="<span>Nombre: </span>"+t;const i=new Date(n),l=i.getMonth(),d=i.getDate()+2,u=i.getFullYear(),m=new Date(Date.UTC(u,l,d)).toLocaleDateString("es-MX",{weekday:"long",year:"numeric",month:"long",day:"numeric"}),v=document.createElement("P");v.innerHTML="<span>fecha: </span>"+m;const p=document.createElement("P");p.innerHTML=`<span>hora: </span>${o} Horas`;const g=document.createElement("BUTTON");g.classList.add("boton"),g.textContent="Reservar",g.onclick=reservarReservacion,e.appendChild(s),e.appendChild(v),e.appendChild(p),e.appendChild(g)}function reservarReservacion(){console.log("reservar")}function mostrarAlerta(e,t,n,o=!0){const a=document.querySelector(".alerta");a&&a.remove();const r=document.createElement("DIV");r.textContent=e,r.classList.add("alerta"),r.classList.add(t);document.querySelector(n).appendChild(r),o&&setTimeout(()=>{r.remove()},3e3)}document.addEventListener("DOMContentLoaded",(function(){iniciar()}));