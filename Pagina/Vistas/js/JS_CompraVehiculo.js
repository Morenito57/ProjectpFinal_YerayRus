document.getElementById('diasAlquiler').addEventListener('input', actualizarTexto);
document.getElementById('extras').addEventListener('change', actualizarTexto);
document.getElementById('seguros').addEventListener('change', actualizarTexto);

function actualizarTexto() {
    var precioAlquilerPHP = precioAlquiler;

    var precioDiasAlquiler = document.getElementById('diasAlquiler').value;

    var extrasSelect = document.getElementById('extras');
    var precioExtras = Array.from(extrasSelect.options).filter(option => option.selected).reduce((prev, option) => prev + Number(option.getAttribute('data-precio') || 0), 0);

    var segurosSelect = document.getElementById('seguros');
    var precioSeguros = Array.from(segurosSelect.options).filter(option => option.selected).reduce((prev, option) => prev + Number(option.getAttribute('data-precio') || 0), 0);

    precioAlquilerPHP = Number(precioAlquilerPHP);
    precioDiasAlquiler = Number(precioDiasAlquiler);

    var preciosDias = precioDiasAlquiler * precioAlquilerPHP;
    var precioTotal = preciosDias + precioExtras + precioSeguros;
    var textoDinamico = document.getElementById('textoDinamico');
    var totalDelPrecio = document.getElementById('TotalDelPrecio');
    totalDelPrecio.value = precioTotal;
    textoDinamico.textContent = "Precio total es: " + precioTotal;
}

function Dia() {
    var fecha = prompt('¿Que dia te gustiria que empezara tu alquiler? escribelo con el siguiente formato: dd-mm-yyyy');
    var partes = fecha.split('-');
    if (partes.length != 3) {
        alert('El formato de la fecha no es el correcto');
        document.getElementById('permiso').value = '0';
    } else {
        fecha = partes[2] + '-' + partes[1] + '-' + partes[0];
        let fechaDate = Date.parse(fecha);
        if (isNaN(fechaDate)) {
            alert('El formato de la fecha no es el correcto');
            document.getElementById('permiso').value = '0';
        } else {
            var fechaActual = new Date();
            var fechaSeleccionada = new Date(fecha);

            if (fechaSeleccionada.getTime() < fechaActual.getTime()) {
                alert('La fecha seleccionada es anterior a la fecha actual o es la fecha actual.');
                document.getElementById('permiso').value = '0';
            } else {
                document.getElementById('permiso').value = '1';
                document.getElementById('FechaInicio').value = fecha;
            }
        }
    }
}