

function obtenerDatos() {
  let letra = document.getElementById("busqueda").value;

  let xhr = new XMLHttpRequest();
  let url = "buscadorAccesoDatos.php?letra=" + letra;

  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      let vehiculos = JSON.parse(this.responseText);

      let select = document.getElementById("opcionesBuscador");

      while (select.firstChild) {
        select.removeChild(select.firstChild);
      }
      let optionVacio = document.createElement("option");
      optionVacio.innerHTML = "";
      select.appendChild(optionVacio);

      // Crear y agregar las opciones al elemento select
      for(let vehiculo of vehiculos){
        let option = document.createElement("option");
        option.value = "pantallaCompra_Loggin.php?id="+vehiculo.Id;
        option.innerHTML = vehiculo.Nombre;
        select.appendChild(option);
      }
    }
  };

  xhr.open("GET", url, true);
  xhr.send();
}

function redirigirPagina(){
  console.log('va');
  if(document.getElementById("opcionesBuscador")){
    let select = document.getElementById("opcionesBuscador");
    let url = select.value;
    if (url) {
      window.location.href = url;
    }
  }
  if(document.getElementById("opcionesOrden")){
    let select = document.getElementById("opcionesOrden");
    let url = select.value;
    if (url) {
      window.location.href = url;
    }
  }
  if(document.getElementById("opcionesTipoVehiculo")){
    let select = document.getElementById("opcionesTipoVehiculo");
    let url = select.value;
    if (url) {
      window.location.href = url;
    }
  }
}
