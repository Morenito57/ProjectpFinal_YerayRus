<?php

require("AccesoDatos/usuarioAccesoDatos.php");

function test_alta_usuario()
{
    $u = new UsuarioAccesoDatos();
    return $u->insertar('yeray','12345678','Administrador');
}

function test_verificar_usuario_encontrado()
{
    $perfil_esperado = 'Administrador';
    $u = new UsuarioAccesoDatos();
    $perfil = $u->verificar('yeray','12345678');
    return $perfil === $perfil_esperado;
}


var_dump(test_alta_usuario());
var_dump(test_verificar_usuario_encontrado());
