<?php
    require("../AccesoDatos/usuarioAccesoDatos.php");

    class UsuarioReglasNegocio {
        function __construct() {
        }
        function verificar($usuario, $clave) {
            $usuariosDAL = new UsuarioAccesoDatos();
            $res = $usuariosDAL->verificar($usuario,$clave);           
            return $res;            
        }
        function insertar($usuario, $clave, $nombre, $apellidos, $fechaNacimiento, $direccion, $DNI, $telefono, $email, $otro) {
            $usuariosDAL = new UsuarioAccesoDatos();
            $res = $usuariosDAL->insertar($usuario, $clave, $nombre, $apellidos, $fechaNacimiento, $direccion, $DNI, $telefono, $email, $otro);           
            return $res;            
        }
}