<?php
require("D:\Clase\laragon\laragon\www\TrabajoFinal\Pagina\AccesoDatos\vehiculoAccesoDatos.php");
require("D:\Clase\laragon\laragon\www\TrabajoFinal\Pagina\AccesoDatos\tipoVehiculoAccesoDatos.php");
require("D:\Clase\laragon\laragon\www\TrabajoFinal\Pagina\AccesoDatos\usuarioAccesoDatos.php");
function test_alta_usuario()
{
    $u = new UsuarioAccesoDatos();
    //return $u->insertar('yes','12345a', 'yes', 'su', '2000-11-30', 'la calle', '46397584Y', '46397584Y', '601180116', 'yerayrusmartinez@gmail.com', 'otro');
}

function test_verificar_usuario_encontrado()
{
    $perfil_esperado = 'Normal';
    $u = new UsuarioAccesoDatos();
    $perfil = $u->verificar('yes','12345a');
    return $perfil === $perfil_esperado;
}

function test_sacar_vehiculo()
{
    $u = new VehiculosAccesoDatos();
    return $u->obtenerVehiculoConcreto(1);
}

function test_sacar_tipovehiculo()
{
    $u = new TipoVehiculoAccesoDatos();
    return $u->obtenerTipoVehiculo(1);
}




var_dump(test_alta_usuario());
var_dump(test_verificar_usuario_encontrado());
var_dump(test_sacar_vehiculo());
var_dump(test_sacar_tipovehiculo());
