function redirigirPagina(){
    if(document.getElementById("pestañaUsuarios")){
      let select = document.getElementById("pestañaUsuarios");
      let url = select.value;
      if (url) {
        window.location.href = url;
      }
    }if(document.getElementById("opcionesBuscador")){
        let select = document.getElementById("opcionesBuscador");
        let url = select.value;
        if (url) {
          window.location.href = url;
        }
    }if(document.getElementById("pestañaVehiculos")){
        let select = document.getElementById("pestañaVehiculos");
        let url = select.value;
        if (url) {
          window.location.href = url;
        }
    }if(document.getElementById("opcionesOrden")){
        let select = document.getElementById("opcionesOrden");
        let url = select.value;
        if (url) {
          window.location.href = url;
        }
    }if(document.getElementById("pestañaAlquileres")){
      let select = document.getElementById("pestañaAlquileres");
      let url = select.value;
      if (url) {
        window.location.href = url;
      }
  }
}

  function eliminarSeguro(){
    var confirmation = confirm('¿Estás seguro que quieres eliminar estos datos?');
    if (confirmation) {
            document.getElementById('permiso').value = '1';
    }else {
        document.getElementById('permiso').value = '0';
    }
  }

  function obtenerDatosSeguros() {
    let letra = document.getElementById("busqueda").value;
    let campo = document.getElementById("opcionesTablaBuscador").value;

    let xhr = new XMLHttpRequest();
    let url = "buscadorAdminSegurosAccesoDatos.php?letra=" + letra + "&campo=" + campo;
  
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        let datos = JSON.parse(this.responseText);
  
        let select = document.getElementById("opcionesBuscador");
  
        while (select.firstChild) {
          select.removeChild(select.firstChild);
        }
        let optionVacio = document.createElement("option");
        optionVacio.textContent = "";
        select.appendChild(optionVacio);
  
        for(let dato of datos){
          let option = document.createElement("option");
          option.value = "Administrador_Seguros_Gestion.php?id="+decodeURIComponent(dato.Id);
          option.textContent = dato.campo;
          select.appendChild(option);
        }
      }
    };
  
    xhr.open("GET", url, true);
    xhr.send();
  }