function obtenerDatosSinLogin() {
  let letra = document.getElementById("busqueda").value;

  let xhr = new XMLHttpRequest();
  let url = "../AccesoDatos/AccesoDatosBuscadores/buscadorAccesoDatos.php?letra=" + letra;

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

      for(let vehiculo of vehiculos){
        let option = document.createElement("option");
        option.value = "pantallaCompra_SinLoggin.php?id="+decodeURIComponent(vehiculo.Id);
        option.innerHTML = vehiculo.Nombre;
        select.appendChild(option);
      }
    }
  };

  xhr.open("GET", url, true);
  xhr.send();
}

function obtenerDatos() {
  let letra = document.getElementById("busqueda").value;

  let xhr = new XMLHttpRequest();
  let url = "../AccesoDatos/AccesoDatosBuscadores/buscadorAccesoDatos.php?letra=" + letra;

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

      for(let vehiculo of vehiculos){
        let option = document.createElement("option");
        option.value = "pantallaCompra_Loggin.php?id="+decodeURIComponent(vehiculo.Id);
        option.innerHTML = vehiculo.Nombre;
        select.appendChild(option);
      }
    }
  };

  xhr.open("GET", url, true);
  xhr.send();
}

function redirigirPagina(){
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
  if(document.getElementById("pestañaUsuarios")){
    let select = document.getElementById("pestañaUsuarios");
    let url = select.value;
    if (url) {
      window.location.href = url;
    }
  }
}

var urlActual = window.location.href;

var paginaActual = parseInt(getQueryStringValue("pagina"));

var totalDatosVehiculos = totalDatosVehiculosPhp;

if (isNaN(paginaActual)) {
    paginaActual = 1;
}

if (paginaActual > 1) {
    document.getElementById("anterior").href = updateQueryStringParameter(urlActual, "pagina", paginaActual - 1);
}

if(paginaActual < totalDatosVehiculos/9){
document.getElementById("siguiente").href = updateQueryStringParameter(urlActual, "pagina", paginaActual + 1);
}

function getQueryStringValue(key) {
    var urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(key);
}

function updateQueryStringParameter(uri, key, value) {
    var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
    var separator = uri.indexOf("?") !== -1 ? "&" : "?";
    if (uri.match(re)) {
    return uri.replace(re, "$1" + key + "=" + value + "$2");
    } else {
    return uri + separator + key + "=" + value;
    }
}
