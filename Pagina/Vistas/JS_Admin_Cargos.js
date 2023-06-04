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

function eliminarCargo(){
    let estado = document.getElementById("estado").value;
    var confirmation = confirm('¿Estás seguro que quieres eliminar estos datos?');
    if (confirmation) {
      if(estado == 1 || estado == "1" || estado == null || estado == '/'){
        alert("Este cargo no ha finalizado y no se puede borrar.");
        document.getElementById('permiso').value = '0';
      }else{
        document.getElementById('permiso').value = '1';
      }
    }else {
        document.getElementById('permiso').value = '0';
    }
  }

  function entrgaCoche(){
    let estado = document.getElementById('estado').value;
    if(estado == ''){
        let resultado = prompt('En que fecha se ha entregado el vehiculo, escribelo con el siguiente formato: yyyy-mm-dd');
        let resultadoFecha = Date.parse(resultado);
        if(isNaN(resultadoFecha)){
            alert('El formato de la fecha no es el correcto');
            document.getElementById('permiso').value = '0';
        }else{
            document.getElementById('permiso').value = '1';
            document.getElementById('fechaDevolucion').value = resultado;
        }
    }else{
        alert('Ya hay una fecha establecida');
    }
    
  }

  function obtenerDatosCargos() {
    let letra = document.getElementById("busqueda").value;
    let campo = document.getElementById("opcionesTablaBuscador").value;

    let xhr = new XMLHttpRequest();
    let url = "buscadorAdminCargosAccesoDatos.php?letra=" + letra + "&campo=" + campo;
  
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
          option.value = "Administrador_Cargos_Gestion.php?id="+decodeURIComponent(dato.Id);
          option.textContent = dato.Id;
          select.appendChild(option);
        }
      }
    };
  
    xhr.open("GET", url, true);
    xhr.send();
  }