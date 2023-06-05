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