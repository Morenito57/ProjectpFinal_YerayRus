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
        function insertar($usuario, $clave, $perfil) {
            $usuariosDAL = new UsuarioAccesoDatos();
            $res = $usuariosDAL->insertar($usuario, $clave, $perfil);           
            return $res;            
        }
}