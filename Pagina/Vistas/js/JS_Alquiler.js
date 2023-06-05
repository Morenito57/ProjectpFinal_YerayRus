function pagarCargos() {

    var cargoActivo = cargoActivoPhp;
    var valorCargo = valorCargoPhp;
    var fechaDevuelto = fechaDevueltoPhp;

    if(cargoActivo == true){
        var confirmation = confirm('Estas apunto de pagar su cargo por valor de ' + valorCargo +'€, asegurese de pagar si solo a entregado el vehixulo.');
        if (confirmation) {
            if (fechaDevuelto === null || fechaDevuelto === "" || fechaDevuelto === "null") {
                alert("No has entregado el vehiculo");
                document.getElementById('permisoParaPagar').value = '0';
            }else if(fechaDevuelto !== null){
                document.getElementById('permisoParaPagar').value = '1';
            }
        }
    }else{
        alert("No tienes cargos por pagar.");
        document.getElementById('permisoParaPagar').value = '0';
    }
}

function actualizarDias() {
    var fechaFinal = fechaFinalPhp;
    fechaFinal.toISOString().substring(0, 10);

    var fechaDevuelto = fechaDevueltoPhp;
    var precioVehiculoDia = precioVehiculoDiaPhp;

    var fechaActual = fechaActualPhp;
    fechaActual.toISOString().substring(0, 10);

    if (fechaDevuelto != "null" && fechaDevuelto !== "") {
        var mensaje = 'Este alquiler ya ha sido finalizado y el vehículo ha sido devuelto.';
        alert(mensaje);
    }else if (fechaActual.toISOString().substring(0,10) === fechaFinal.toISOString().substring(0,10)) {
        var mensaje = 'El alquiler finalizó hoy entregalo ya.';
        alert(mensaje);
    }else if (fechaActual > fechaFinal) {
        var mensaje = 'El alquiler finalizó el día ' + fechaFinal.toISOString().substring(0,10) + ' entregalo ya antes de tener mas cargos.';
        alert(mensaje);
    }else {
        var dias = prompt('¿Cuántos días más te gustaría tener el vehículo?' + fechaFinal.toISOString().substring(0,10));
        if (dias != null && Number.isInteger(parseInt(dias)) && dias >= 0) {
            var confirmation = confirm('¿Estás seguro de que quieres alquilar el vehículo por ' + dias + ' días más por ' + (precioVehiculoDia * dias) + '€?');
            if (confirmation) {
                document.getElementById('TotalDias').value = dias;
                document.getElementById('TotalPago').value = precioVehiculoDia * dias;
            } 
        } else {
            alert("Por favor, introduce un número válido.");
    }
    }
}